<?php
include 'db_connection.php';

// Read the JSON request
$data = json_decode(file_get_contents("php://input"), true);
$user_message = strtolower(trim($data["message"]));

// Simple keyword-based response (Modify based on database queries)
$response = "Sorry, I don't understand.";

if (strpos($user_message, "recommend") !== false) {
    $sql = "SELECT food_name FROM food_recommendations ORDER BY RAND() LIMIT 1";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $response = "I recommend: " . $row["food_name"];
    } else {
        $response = "No recommendations available.";
    }
}

// Return JSON response
echo json_encode(["message" => $response]);

$conn->close();
?>
