<?php
session_start();
include("./common/connection.php");

// Read the JSON input
$json = file_get_contents('php://input');
$data = json_decode($json, true);

// Check if JSON decoding was successful
if (json_last_error() !== JSON_ERROR_NONE) {
    // Return an error response if JSON decoding failed.
    $response = ["status" => "error", "message" => "Invalid JSON data received"];
    echo json_encode($response);
    exit();
}

$_SESSION['genericSections'] = $json;
$order = 0;
$sql = "INSERT INTO section (user_id, ord, sectiondata) VALUES (?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iis", $_SESSION['user_id'], $order, $json);
$stmt->execute();
$stmt->close();

// Initialize default sections if they are not set in the incoming data.
$genericSections = isset($data['genericSections']) ? $data['genericSections'] : [];

// Sending a JSON response back to the client
$response = ["status" => "success", "message" => "Form submitted successfully"];
echo json_encode($response);


