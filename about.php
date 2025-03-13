<?php 
session_start();
include 'db_connection.php'; 
// Stops the user in interacting with FAI
if (!isset($_SESSION['first_name'])) {
    echo "<div style='display: flex; justify-content: center; align-items: center; height: 100vh; 
                background: url(\"img/warningbg.png\") no-repeat center center; 
                background-size: cover;'>
            <div style='text-align: center; padding: 30px; border-radius: 10px; background: rgba(255, 255, 255, 0.9); 
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); max-width: 400px;'>
                <h2 style='color: #721c24; margin-bottom: 15px;'>Access Denied</h2>
                <p style='color: #721c24; font-size: 18px; margin-bottom: 20px;'>Login to chat with FAI</p>
                <a href='index.php'><button style='font-size: 18px; padding: 10px 20px; margin: 5px;' class='btn btn-secondary'>Back to Home</button></a>
                <a href='login.php'><button style='font-size: 18px; padding: 10px 20px; margin: 5px;' class='btn btn-primary'>Login</button></a>
            </div>
          </div>";
    exit(); // Stop further execution
}
?>

// Get user info
$user_id = $_SESSION['user_id'];
$first_name = $_SESSION['first_name'];

// Get chat history if we want to display it
$chat_history = [];
if(isset($conn)) {
    $query = "SELECT message, response, timestamp FROM chat_history WHERE user_id = ? ORDER BY timestamp ASC";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while($row = $result->fetch_assoc()) {
        $chat_history[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat with FAI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background: url('https://images.unsplash.com/photo-1534796636912-3b95b3ab5986?ixlib=rb-1.2.1&auto=format&fit=crop&w=1951&q=80') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: relative;
        }
        
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            z-index: -1;
        }
        
        .chat-container {
            max-width: 1200px;
            margin: 30px auto;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            height: 85vh;
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        
        .chat-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        .chat-header h2 {
            margin: 0;
            font-size: 1.8rem;
            font-weight: 700;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
        }
        
        .user-info {
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.2);
            padding: 5px 15px;
            border-radius: 50px;
            backdrop-filter: blur(5px);
        }
        
        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(45deg, #ff9a9e 0%, #fad0c4 99%, #fad0c4 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-weight: bold;
            font-size: 1.2rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 2px solid white;
        }
        
        .chat-messages {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            background: url('https://www.transparenttextures.com/patterns/cubes.png');
        }
        
        .message {
            max-width: 75%;
            padding: 15px 20px;
            border-radius: 20px;
            position: relative;
            word-wrap: break-word;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.3s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .message-user {
            background: linear-gradient(120deg, #a1c4fd 0%, #c2e9fb 100%);
            color: #333;
            align-self: flex-end;
            border-bottom-right-radius: 5px;
            margin-right: 10px;
        }
        
        .message-ai {
            background: linear-gradient(120deg, #d4fc79 0%, #96e6a1 100%);
            color: #333;
            align-self: flex-start;
            border-bottom-left-radius: 5px;
            margin-left: 10px;
        }
        
        .message::before {
            content: "";
            position: absolute;
            width: 20px;
            height: 20px;
            bottom: 0;
        }
        
        .message-user::before {
            right: -10px;
            background: radial-gradient(circle at top right, transparent 70%, #c2e9fb 71%);
        }
        
        .message-ai::before {
            left: -10px;
            background: radial-gradient(circle at top left, transparent 70%, #96e6a1 71%);
        }
        
        .message-time {
            font-size: 0.75rem;
            color: rgba(0, 0, 0, 0.5);
            position: absolute;
            bottom: -20px;
            right: 10px;
        }
        
        .chat-input {
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-top: 1px solid rgba(255, 255, 255, 0.18);
        }
        
        .input-group {
            position: relative;
            background: white;
            border-radius: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 5px;
        }
        
        .form-control {
            border-radius: 30px;
            padding: 15px 25px;
            font-size: 1rem;
            border: none;
            background: transparent;
        }
        
        .form-control:focus {
            box-shadow: none;
        }
        
        .btn-send {
            border-radius: 50%;
            width: 50px;
            height: 50px;
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }
        
        .btn-send:hover {
            transform: translateY(-50%) scale(1.05);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
        }
        
        .typing-indicator {
            display: flex;
            padding: 15px;
            gap: 5px;
            align-self: flex-start;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 20px;
            margin-left: 10px;
        }
        
        .typing-dot {
            width: 10px;
            height: 10px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            animation: typing-animation 1.5s infinite ease-in-out;
        }
        
        .typing-dot:nth-child(2) {
            animation-delay: 0.2s;
        }
        
        .typing-dot:nth-child(3) {
            animation-delay: 0.4s;
        }
        
        @keyframes typing-animation {
            0%, 60%, 100% { transform: translateY(0); }
            30% { transform: translateY(-10px); }
        }
        
        .chat-options {
            padding: 0 20px 10px;
            display: flex;
            gap: 10px;
        }
        
        .option-btn {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(5px);
            border: none;
            border-radius: 20px;
            padding: 8px 20px;
            color: #666;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        
        .option-btn:hover {
            background: rgba(255, 255, 255, 0.95);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }
        
        .option-btn i {
            margin-right: 5px;
        }
        
        .navbar {
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(10px);
            padding: 15px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .navbar-brand {
            color: white;
            font-weight: bold;
            font-size: 1.8rem;
            display: flex;
            align-items: center;
        }
        
        .navbar-brand i {
            margin-right: 10px;
            font-size: 2rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
            padding: 8px 15px;
            margin: 0 5px;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            transition: width 0.3s ease;
        }
        
        .nav-link:hover {
            color: white;
        }
        
        .nav-link:hover::after {
            width: 80%;
        }
        
        /* Custom scrollbar */
        .chat-messages::-webkit-scrollbar {
            width: 8px;
        }
        
        .chat-messages::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.4);
            border-radius: 10px;
        }
        
        .chat-messages::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
        }
        
        /* Floating particles */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            pointer-events: none;
        }
        
        .particle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            animation: float 15s infinite linear;
        }
        
        @keyframes float {
            0% { transform: translateY(0) rotate(0deg); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-100vh) rotate(360deg); opacity: 0; }
        }
        
        /* For mobile responsiveness */
        @media (max-width: 768px) {
            .chat-container {
                margin: 10px;
                height: calc(100vh - 20px);
                border-radius: 15px;
            }
            
            .chat-header {
                border-radius: 15px 15px 0 0;
                padding: 15px;
            }
            
            .message {
                max-width: 85%;
            }
            
            .navbar-brand {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Floating Particles -->
    <div class="particles" id="particles"></div>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-robot"></i> FAI Chat
            </a>
            <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php"><i class="fas fa-user"></i> Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Chat Container -->
    <div class="container flex-grow-1 d-flex align-items-center">
        <div class="chat-container">
            <div class="chat-header">
                <h2><i class="fas fa-comment-dots me-2"></i> Chat with FAI</h2>
                <div class="user-info">
                    <div class="user-avatar">
                        <?php echo substr($first_name, 0, 1); ?>
                    </div>
                    <span><?php echo $first_name; ?></span>
                </div>
            </div>
            
            <div class="chat-messages" id="chatMessages">
                <!-- Welcome message -->
                <div class="message message-ai">
                    <p>Hello <?php echo $first_name; ?>! How can I assist you today? 👋</p>
                    <span class="message-time"><?php echo date('h:i A'); ?></span>
                </div>
                
                <!-- Load chat history if available -->
                <?php foreach($chat_history as $chat): ?>
                <div class="message message-user">
                    <p><?php echo htmlspecialchars($chat['message']); ?></p>
                    <span class="message-time"><?php echo date('h:i A', strtotime($chat['timestamp'])); ?></span>
                </div>
                <div class="message message-ai">
                    <p><?php echo nl2br(htmlspecialchars($chat['response'])); ?></p>
                    <span class="message-time"><?php echo date('h:i A', strtotime($chat['timestamp'])); ?></span>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div class="chat-options">
                <button class="option-btn"><i class="fas fa-trash-alt"></i> Clear Chat</button>
                <button class="option-btn"><i class="fas fa-question-circle"></i> Help</button>
                <button class="option-btn"><i class="fas fa-download"></i> Save Chat</button>
            </div>
            
            <div class="chat-input">
                <form id="chatForm" action="process_chat.php" method="post">
                    <div class="input-group">
                        <input type="text" class="form-control" id="messageInput" name="message" placeholder="Type your message here..." required>
                        <button type="submit" class="btn btn-send">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Create floating particles
            const particlesContainer = document.getElementById('particles');
            const particleCount = 20;
            
            for (let i = 0; i < particleCount; i++) {
                const size = Math.random() * 20 + 5;
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.top = `${Math.random() * 100}%`;
                particle.style.opacity = Math.random() * 0.5;
                particle.style.animationDuration = `${Math.random() * 20 + 10}s`;
                particle.style.animationDelay = `${Math.random() * 5}s`;
                particlesContainer.appendChild(particle);
            }
            
            // Scroll to bottom of chat
            function scrollToBottom() {
                const chatMessages = document.getElementById('chatMessages');
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }
            
            scrollToBottom();
            
            // Submit form using AJAX
            $("#chatForm").submit(function(e) {
                e.preventDefault();
                
                const messageInput = $("#messageInput");
                const message = messageInput.val().trim();
                
                if (message === '') return;
                
                // Add user message to chat
                const currentTime = new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
                $("#chatMessages").append(`
                    <div class="message message-user">
                        <p>${message}</p>
                        <span class="message-time">${currentTime}</span>
                    </div>
                `);
                
                // Add typing indicator
                $("#chatMessages").append(`
                    <div class="typing-indicator" id="typingIndicator">
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
                    </div>
                `);
                
                scrollToBottom();
                messageInput.val('').focus();
                
                // Send message to server
                $.ajax({
                    url: "process_chat.php",
                    type: "POST",
                    data: { message: message },
                    success: function(response) {
                        // Remove typing indicator
                        $("#typingIndicator").remove();
                        
                        // Add AI response
                        $("#chatMessages").append(`
                            <div class="message message-ai">
                                <p>${response}</p>
                                <span class="message-time">${currentTime}</span>
                            </div>
                        `);
                        
                        scrollToBottom();
                    },
                    error: function() {
                        // Remove typing indicator
                        $("#typingIndicator").remove();
                        
                        // Show error message
                        $("#chatMessages").append(`
                            <div class="message message-ai">
                                <p>Sorry, I'm having trouble connecting. Please try again.</p>
                                <span class="message-time">${currentTime}</span>
                            </div>
                        `);
                        
                        scrollToBottom();
                    }
                });
            });
            
            // Clear chat functionality
            $(".option-btn").eq(0).click(function() {
                if(confirm("Are you sure you want to clear this chat?")) {
                    $.ajax({
                        url: "clear_chat.php",
                        type: "POST",
                        success: function() {
                            // Clear chat messages except the welcome message
                            $("#chatMessages").html(`
                                <div class="message message-ai">
                                    <p>Hello <?php echo $first_name; ?>! How can I assist you today? 👋</p>
                                    <span class="message-time">${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</span>
                                </div>
                            `);
                        }
                    });
                }
            });
            
            // Help button functionality
            $(".option-btn").eq(1).click(function() {
                $("#chatMessages").append(`
                    <div class="message message-ai">
                        <p>Here are some things you can ask me about:<br>
                        - General information and knowledge 📚<br>
                        - Writing assistance ✍️<br>
                        - Coding help 💻<br>
                        - Math and problem solving 🧮<br>
                        - Creative ideas 💡<br>
                        <br>Just type your question in the chat box below!</p>
                        <span class="message-time">${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</span>
                    </div>
                `);
                scrollToBottom();
            });
            
            // Save chat functionality
            $(".option-btn").eq(2).click(function() {
                $.ajax({
                    url: "export_chat.php",
                    type: "POST",
                    success: function(response) {
                        // Create a download link
                        const blob = new Blob([response], {type: 'text/plain'});
                        const url = window.URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.style.display = 'none';
                        a.href = url;
                        a.download = 'chat_history.txt';
                        document.body.appendChild(a);
                        a.click();
                        window.URL.revokeObjectURL(url);
                        
                        // Show success message
                        $("#chatMessages").append(`
                            <div class="message message-ai">
                                <p>Chat history has been saved to your downloads folder! 📥</p>
                                <span class="message-time">${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</span>
                            </div>
                        `);
                        scrollToBottom();
                    },
                    error: function() {
                        // Show error message
                        $("#chatMessages").append(`
                            <div class="message message-ai">
                                <p>Sorry, I couldn't save the chat history. Please try again later.</p>
                                <span class="message-time">${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</span>
                            </div>
                        `);
                        scrollToBottom();
                    }
                });
            });
        });
    </script>
</body>
</html>
