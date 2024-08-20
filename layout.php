<?php
include("./common/bootstrap.php");
include("./common/connection.php");

// $json = file_get_contents("data.json");
// if ($json === false) {
//     echo "Could not read file";
// } else {
//     $data = json_decode($json, true);
//     $section = $data["section"];
//     $navbar = $data["navbar"];
//     $otherLinks = $navbar["other-links"];
//     $hero = $data["hero"];
//     $footer = $data["footer"];
//     $class = ($section["alignment"] == "center")
//         ? "text-center"
//         : (($section["alignment"] == "right")
//             ? "text-end"
//             : "");
// }

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

include("./components/_navbar.php");
include("./components/_hero.php");
include("./components/_section.php");
include("./components/_footer.php");