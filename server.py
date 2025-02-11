from flask import Flask, request, jsonify
from flask_cors import CORS
import requests

app = Flask(__name__)
CORS(app)  # Allow frontend requests

OLLAMA_URL = "http://localhost:11434/api/generate"  # Ollama local API

@app.route("/chat", methods=["POST"])
def chat():
    data = request.json
    user_message = data.get("message", "")

    if not user_message:
        return jsonify({"error": "No message provided"}), 400

    # Use llama3.2:1b model
    payload = {
        "model": "llama3.2:1b",  
        "prompt": user_message,
        "stream": False
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
