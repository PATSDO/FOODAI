from flask import Flask, request, jsonify
from flask_cors import CORS
import requests

app = Flask(__name__)
CORS(app)  # Allow frontend requests

OLLAMA_URL = "http://localhost:11434/api/generate"  # Ollama local API

def load_knowledge():
    """Load the knowledge base from fai.txt"""
    try:
        with open("fai.txt", "r", encoding="utf-8") as file:
            return file.read()
    except FileNotFoundError:
        return "Error: Knowledge file not found."
    except Exception as e:
        return f"Error loading knowledge file: {str(e)}"

@app.route("/chat", methods=["POST"])
def chat():
    data = request.json
    user_message = data.get("message", "")

    if not user_message:
        return jsonify({"error": "No message provided"}), 400

    # Load Fai's knowledge base
    fai_knowledge = load_knowledge()

    # Format the prompt to include the knowledge file first
    full_prompt = f"{fai_knowledge}\n\nUser: {user_message}\nFai:"

    # Use llama3.2:1b model with injected knowledge
    payload = {
        "model": "llama3.2:1b",  
        "prompt": full_prompt,
        "stream": False,
        "temperature": 0.9,
        "top_k": 40,  
        "top_p": 0.9, 
        "system": "You are Fai, a food allergy assistant helping users find safe meals at fast food restaurants."
    }

    try:
        response = requests.post(OLLAMA_URL, json=payload)
        response_json = response.json()
        chatbot_reply = response_json.get("response", "Error getting response.")
    except Exception as e:
        chatbot_reply = f"Error: {str(e)}"

    return jsonify({"message": chatbot_reply})

if __name__ == "__main__":
    app.run(debug=True, port=5000)  # Runs locally on port 5000
