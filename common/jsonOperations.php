<?php
include('connection.php');

function fetchData($conn)
{

    if (isset($_SESSION["user_id"])) {
        $sql = "SELECT site_data FROM users WHERE user_id= ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $_SESSION["user_id"]);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        $json = $result->fetch_assoc();
        $data = json_decode($json["site_data"], true);
        return $data;
    }
}

function updateSection($conn, $section, $section_name, $data)
{
    $data[$section_name] = $section;
    $upload_data = json_encode($data);
    if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST['submit'])) {
        $sql = "UPDATE users SET site_data = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $upload_data, $_SESSION['user_id']);
        $stmt->execute();
        $stmt->close();
    }
}