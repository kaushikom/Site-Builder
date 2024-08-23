<?php
function insertDefaultData($conn)
{

    $default_data = file_get_contents("data.json");

    if (isset($_SESSION['user_id'])) {

        $check_sql = "SELECT site_data FROM users WHERE user_id = ?";
        $stmt = $conn->prepare($check_sql);
        $stmt->bind_param("i", $_SESSION['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (empty($row['site_data'])) {

                $update_sql = "UPDATE users SET site_data = ? WHERE user_id = ?";
                $update_stmt = $conn->prepare($update_sql);
                $update_stmt->bind_param("si", $default_data, $_SESSION['user_id']);
                $update_stmt->execute();
                $update_stmt->close();
                echo "Default data inserted for existing user";

            } else {
                echo "User has existing non-empty site_data";
            }
        }
    }
}