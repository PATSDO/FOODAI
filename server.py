import csv
from flask import Flask, request, jsonify
from flask_cors import CORS
import requests

app = Flask(__name__)
CORS(app)

OLLAMA_URL = "http://localhost:11434/api/generate"

# Load instructions from text file
INSTRUCTIONS = ""
ALLERGEN_DATA = {}

def load_instructions():
    global INSTRUCTIONS
    try:
        with open("fai.txt", "r", encoding="utf-8") as file:
            INSTRUCTIONS = file.read()
    except Exception as e:
        print(f"Error loading instructions: {e}")

def load_allergen_data():
    global ALLERGEN_DATA
    ALLERGEN_DATA = {}
    try:
        with open("menu.csv", "r", encoding="utf-8") as file:
            reader = csv.DictReader(file)
            for row in reader:
                food_name = row["food_name"].strip().lower()
                allergen = row["allergen"].strip().lower()
                ALLERGEN_DATA[food_name] = allergen
    except Exception as e:
        print(f"Error loading allergen data: {e}")

load_instructions()
load_allergen_data()

@app.route('/chat', methods=['POST'])
def chat_handler():
    user_message = request.json.get('message', '').lower()
    
    prompt = f"{INSTRUCTIONS}\n\nKnown allergen information:\n"
    for food, allergens in ALLERGEN_DATA.items():
        prompt += f"{food}: {allergens}\n"
    
    prompt += f"\nUser says: {user_message}. Respond as Fai, a food allergy assistant, using the above knowledge." 
    
    ollama_response = requests.post(OLLAMA_URL, json={
        "model": "llama3.2:1b",
        "prompt": prompt,
        "stream": False,
        "temperature": 0.9
    }).json().get('response', '')
    
    return jsonify({"message": ollama_response})

if __name__ == '__main__':
    app.run(debug=True, port=5000)
