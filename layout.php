<?php
include("./common/bootstrap.php");
include("./common/connection.php");


$data = fetchData($conn);

if (!$data) {
    echo "Could not read file";
} else {
    $section = $data["section"];
    $navbar = $data["navbar"];
    $otherLinks = $navbar["other-links"];
    $hero = $data["hero"];
    $footer = $data["footer"];
    $class = ($section["alignment"] == "center")
        ? "text-center"
        : (($section["alignment"] == "right")
            ? "text-end"
            : "");
}

function getImage($conn)
{
    if (isset($_SESSION['user_id'])) {
        $sql = 'SELECT image FROM users WHERE user_id = ?';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $_SESSION['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<img src='" . htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8') . "' alt='User Image'>";
        }
    } else {
        echo " <span class=\"fs-1 fw-light text-body-secondary\">Placeholder</span>";
    }
}

include("./components/_navbar.php");
include("./components/_hero.php");
include("./components/_section.php");
include("./components/_footer.php");