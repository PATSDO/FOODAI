FOODAI INSTALLATION GUIDE
-------------------------
Step 1: Download the GitHub Repository Files

=> Visit the Repository using this link: https://github.com/PATSDO/FOODAI

=> In the main page, click the green dropdown button labeled "Code"

=> Select "Download ZIP" to start the Download process

=> After downloading, extract the files



Step 2: Download Ollama Model on your Local Computer

=> Visit the Ollama website using this link: https://ollama.com/library/llama3.2:1b

=> After downloading, go to your Computer's Terminal/Command Prompt and run the command "ollama run llama3.2:1b"



Step 3: Download XAMPP Control Panel

=> Visit the XAMPP website using this link: https://www.apachefriends.org/download.html

=> After downloading, complete the installation process with the XAMPP installer



Step 4: Transfer GitHub Files to the "htdocs" Folder

=> In the XAMPP Control Panel, press the "Explorer" button at the side of the control panel to open the "xampp" folder on your computer

=> Navigate to the "htdocs" folder and create a new folder named "FOODAI"

=> Inside the "FOODAI" folder, paste the extracted GitHub files

=> The file path should look something like this: C:\xampp\htdocs\FOODAI\



Step 5: Setup MySQL Database using PHPmyadmin

=> In the XAMPP Control Panel, start the "Apache" and "MySQL" services

=> Click the "Admin" button next to the "MySQL" button to access the PHPmyadmin dashboard

=> In the dashboard, press the "Import" button and import the SQL file found in the FOODAI folder named "food_ai_db"



Step 6: Start the FOODAI Server

=> Open a new Terminal/Command Prompt on your Computer

=> Navigate to the "FOODAI" folder in the "htdocs" directory. The command should look something like this: "cd C:\xampp\htdocs\FOODAI\"

=> In this directory, type the command "python server.py" to start the server


Step 6: Open the Website

=> In your local browser, navigate to: http://localhost/FOODAI/index.php

=> This should open the FOODAI website's home page

