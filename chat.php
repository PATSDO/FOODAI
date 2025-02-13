<?php
include 'db_connection.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// Read the JSON request
$data = json_decode(file_get_contents("php://input"), true);
$user_message = strtolower(trim($data["message"]));

$response = "Sorry, I don't understand.";

// Extract food name and allergens from user message
if (preg_match('/i want to eat (.+?) but i\'?m allergic to (.+)/i', $user_message, $matches)) {
    $desired_food = trim($matches[1]);
    $allergic_to = array_map('trim', explode(',', strtolower($matches[2])));

    // Check if the desired food contains allergens
    $stmt = $conn->prepare("SELECT allergens FROM menu WHERE LOWER(food_name) = ?");
    $stmt->bind_param("s", $desired_food);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $food_allergens = array_map('trim', explode(',', strtolower($row["allergens"])));

        // Check if any allergen matches
        if (array_intersect($allergic_to, $food_allergens)) {
            $response = "You are allergic to $desired_food! Let me recommend something else.";

            // Suggest a random food that does NOT contain the specified allergens
            $placeholders = implode(',', array_fill(0, count($allergic_to), '?'));
            $query = "SELECT food_name FROM menu WHERE NOT (";
            foreach ($allergic_to as $index => $allergen) {
                if ($index > 0) $query .= " OR ";
                $query .= "FIND_IN_SET(?, allergens) > 0";
            }
            $query .= ") ORDER BY RAND() LIMIT 1";

            $stmt = $conn->prepare($query);
            $stmt->bind_param(str_repeat('s', count($allergic_to)), ...$allergic_to);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $response .= " How about: " . $row["food_name"] . "?";
            } else {
                $response .= " Unfortunately, I couldn't find a safe recommendation.";
            }
        } else {
            $response = "You can safely eat $desired_food!";
        }
    } else {
        $response = "Sorry, I couldn't find $desired_food in the menu.";
    }

    $stmt->close();
}

echo json_encode(["message" => $response]);
$conn->close();
?>
