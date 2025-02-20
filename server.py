import csv
import json
from flask import Flask, request, jsonify
from flask_cors import CORS
import requests

app = Flask(__name__)
CORS(app)  # Important for handling requests from your PHP frontend

OLLAMA_URL = "http://localhost:11434/api/generate"

class FoodAssistant:
    def __init__(self):
        self.config = {}
        self.menu_data = []
        self.load_config()
        self.load_menu_data()

    def load_config(self):
        try:
            with open("config.json", "r", encoding="utf-8") as file:
                self.config = json.load(file)
        except Exception as e:
            print(f"Error loading config: {e}")
            self.config = {}

    def load_menu_data(self):
        try:
            with open("menu.csv", "r", encoding="utf-8") as file:
                reader = csv.DictReader(file)
                self.menu_data = list(reader)
        except Exception as e:
            print(f"Error loading menu data: {e}")
            self.menu_data = []

    def build_context(self):
        """Build the context for the AI model"""
        context = {
            "assistant": self.config.get("assistant", {}),
            "menu_items": {}
        }
        
        # Group menu items by restaurant
        for item in self.menu_data:
            rest = item.get("restaurant_name", "Unknown")
            if rest not in context["menu_items"]:
                context["menu_items"][rest] = []
            
            context["menu_items"][rest].append({
                "name": item.get("food_name", "Unknown"),
                "allergens": item.get("allergens", "").split(","),
                "description": item.get("description", "No description available.")
            })
        
        return context

assistant = FoodAssistant()

@app.route('/chat', methods=['POST'])
def chat_handler():
    try:
        data = request.json
        if not data or 'message' not in data:
            return jsonify({"message": "Please provide a message"}), 400

        user_message = data['message'].strip()
        
        if not user_message:
            return jsonify({"message": "Please provide a non-empty message"}), 400

        # Build context
        context = assistant.build_context()

        # Ensure assistant name is always present
        assistant_name = context.get("assistant", {}).get("name", "Food Assistant")

        if not context["menu_items"]:
            return jsonify({"message": "Error: No menu data available. Please check menu.csv"}), 500

        # Construct prompt safely
        prompt = (
            f"You are {assistant_name}, a friendly food assistant. "
            f"Your purpose is to help users navigate food allergies at McDonald's, Jollibee, and KFC.\n\n"
            "Rules:\n"
            "- Never recommend meals containing user's allergens\n"
            "- Only suggest items from the provided menu\n"
            "- Keep responses brief (max 5 sentences)\n"
            "- Be friendly and direct\n\n"
            f"Available menu items and allergen information:\n{json.dumps(context['menu_items'], indent=2)}\n\n"
            f"User message: {user_message}"
        )

        # Make request to Ollama with error handling
        try:
            response = requests.post(
                OLLAMA_URL,
                json={"model": "llama3.2:1b", "prompt": prompt, "stream": False, "temperature": 0.60},
                timeout=10  # Add timeout for network stability
            )
            response.raise_for_status()  # Raise error for non-2xx HTTP status codes
            response_data = response.json()
        except requests.exceptions.RequestException as e:
            return jsonify({"message": f"AI server error: {e}"}), 500
        except ValueError:
            return jsonify({"message": "AI response is not in valid JSON format."}), 500

        ai_response = response_data.get('response', 'I am unable to generate a response at this moment.')

        return jsonify({"message": ai_response})

    except Exception as e:
        print(f"Error in chat_handler: {str(e)}")  # For debugging
        return jsonify({"message": f"An unexpected error occurred: {str(e)}"}), 500

if __name__ == '__main__':
    app.run(debug=True, port=5000)
