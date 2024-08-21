<?php
include("./common/connection.php");


if (isset($_POST['submit'])) {
    $userId = $_SESSION['user_id'];

    $targetDir = "images/";
    $imageName = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $imageName;



    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {

        $sql = "UPDATE users SET image = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $targetFilePath, $userId);
        if ($stmt->execute()) {
            echo "Image uploaded successfully.";
        } else {
            echo "Database error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error moving the uploaded file.";
    }

}

header("Location: editor.php");


