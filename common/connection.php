<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sitebuilder";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Failed to connect" . $conn->connect_error);
}
if (!isset($_SESSION["status"])) {
    session_start();
    $_SESSION['status'] = true;
}
