<?php
include('connection.php');

function fetchData($conn, $query = "SELECT site_data FROM users WHERE user_id= ?", $columnName = "site_data")
{

    if (isset($_SESSION["user_id"])) {
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $_SESSION["user_id"]);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        $json = $result->fetch_assoc();
        $data = json_decode($json[$columnName], true);
        return $data;
    }
}

function updateSection($conn, $section, $section_name, $data)
{
    $data[$section_name] = $section;
    $upload_data = json_encode($data);
    if (($_SERVER["REQUEST_METHOD"] == 'POST')) {
        try {
            $sql = "UPDATE users SET site_data = ? WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $upload_data, $_SESSION['user_id']);
            $stmt->execute();
            $stmt->close();
            echo "updateSection() executed";
        } catch (Error $e) {
            echo '' . $e->getMessage() . '';
        }
    }
}

function fetchSection($conn)
{
    if (isset($_SESSION["user_id"])) {
        $query = 'SELECT sectiondata FROM section WHERE user_id = ?';
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $_SESSION["user_id"]);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        $collection = [];
        while ($row = $result->fetch_assoc()) {
            $collection[] = json_decode($row['sectiondata'], true);
        }



    }
    $genericSections = [];
    foreach ($collection as $outerArray) {
        foreach ($outerArray as $innerArray) {
            $genericSections[] = $innerArray;
        }
    }
    return $genericSections;
}