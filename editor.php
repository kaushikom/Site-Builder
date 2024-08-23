<?php session_start();
include("./common/connection.php");
include("./common/jsonOperations.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

$default_data = file_get_contents("data.json");
$prevData = fetchData($conn);
$prevNav = $prevData['navbar'];
$prevHero = $prevData['hero'];
$prevSection = $prevData['section'];
$prevFooter = $prevData['footer'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['navbar_submit'])) {
        $navbar = [
            'header' => $_POST['navbar_heading'],
            'header-alignment' => $_POST['navbar_position'],
            'other-links' => explode(',', $_POST['navbar-links']),
            'searchbar' => isset($_POST['navbar-search']),
            'darkmode' => isset($_POST['navbar_darkmode']),
        ];
        updateSection($conn, $navbar, 'navbar', $prevData);

        header('Location: editor.php');
    }
    if (isset($_POST['hero_submit'])) {
        $hero = [
            'heading' => $_POST['hero_heading'],
            'description' => $_POST['hero_description'],
            'btn-text' => $_POST['hero_btn_text'],
            'alignment' => $_POST['hero_position'],
            'btn-color' => $_POST['hero_btn_color'],
        ];
        updateSection($conn, $hero, 'hero', $prevData);
        header('Location: editor.php');
    }
    if (isset($_POST['section_submit'])) {
        $section = [
            'heading' => $_POST['section_heading'],
            'description' => $_POST['section_description'],
            'alignment' => $_POST['section_position'],
            'pointers' => $prevSection['pointers']
        ];
        updateSection($conn, $section, 'section', $prevData);

        header('Location: editor.php');
    }
    if (isset($_POST['load-default'])) {
        // Loading the default json
        $update_sql = "UPDATE users SET site_data = ? WHERE user_id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("si", $default_data, $_SESSION['user_id']);
        $update_stmt->execute();
        $update_stmt->close();
        // // Deleting additional sections added by the user
        $delete_sql = "DELETE FROM section WHERE user_id =?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param("i", $_SESSION['user_id']);
        $delete_stmt->execute();
        $delete_stmt->close();
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="script.js" defer></script>
</head>

<body>
    <form action="logout.php" method="post">
        <button name="logout" class="btn btn-dark m-2 d-block ms-auto">Logout</button>
    </form>
    <h1 class="text-center mt-4">Editor</h1>

    <!-- Accordion -->
    <div class="accordion w-75 mx-auto mt-4" id="accordionExample" style="min-width:350px; max-width: 1000px;">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Navbar
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="FormControlInput1" class="form-label">Navbar Header</label>
                            <input value="<?= $prevNav['header'] ?>" type="text" class="form-control"
                                id="FormControlInput1" name="navbar_heading" placeholder="Navbar">
                        </div>
                        <div class="mb-3">
                            <label for="FormControlInput21" class="form-label">Item's Position</label>
                            <select name="navbar_position" class="form-select" id="FormControlInput21">
                                <option value="center">Center</option>
                                <option value="left">Left</option>
                                <option value="right">Right</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="FormControlInput5" class="form-label">Navbar Links</label>
                            <input type="text" class="form-control" id="FormControlInput5" name="navbar-links"
                                value="<?= implode(",", $prevNav['other-links']) ?>">
                        </div>
                        <div class="mb-3 form-check">
                            <input <?php echo $prevNav['searchbar'] ? "checked" : "" ?> class="form-check-input"
                                type="checkbox" value="true" name="navbar-search" id="flexCheckDefault1">
                            <label class="form-check-label" for="flexCheckDefault1">
                                Add Search Bar
                            </label>
                        </div>
                        <div class="mb-3 form-check">
                            <input <?php echo $prevNav['darkmode'] == 1 ? "checked" : '' ?> class="form-check-input"
                                type="checkbox" value="true" name="navbar_darkmode" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Dark Navbar
                            </label>
                        </div>
                        <button class="btn btn-primary px-4" name="navbar_submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Hero
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="FormControlInput99" class="form-label">Heading</label>
                            <input value="<?= $prevHero['heading'] ?>" type="text" class="form-control"
                                id="FormControlInput99" name="hero_heading" placeholder="Heading">
                        </div>
                        <div class="mb-3">
                            <label for="FormControlInput97" class="form-label">Description</label>
                            <input name="hero_description" value="<?= $prevHero['description'] ?>" type="text"
                                class="form-control" id="FormControlInput97" name="description"
                                placeholder="Description">
                        </div>
                        <div class="mb-3">
                            <label for="FormControlInput96" class="form-label">Button text</label>
                            <input name="hero_btn_text" value="<?= $prevHero['btn-text'] ?>" type="text"
                                class="form-control" id="FormControlInput96" name="btn-txt" placeholder="Submit">
                        </div>

                        <div class="mb-3">
                            <label for="FormControlInput98" class="form-label">Header Position</label>
                            <select name="hero_position" class="form-select" id="FormControlInput98"
                                name="hero position">
                                <option value="left">Left</option>
                                <option value="right">Right</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="FormControlInput89" class="form-label">Button Color</label>
                            <select name="hero_btn_color" class="form-select" id="FormControlInput89"
                                name="hero position">
                                <option value="" selected>Select button background</option>
                                <option value="primary" class="text-bg-primary">Primary</option>
                                <option value="secondary" class="text-bg-secondary">Secondary</option>
                                <option value="success" selected class="text-bg-success">Success</option>
                                <option value="danger" class="text-bg-danger">Danger</option>
                                <option value="warning" class="text-bg-warning">Warning</option>
                                <option value="info" class="text-bg-info">Info</option>
                                <option value="light" class="text-bg-light">Light</option>
                                <option value="dark" class="text-bg-dark">Dark</option>
                            </select>
                        </div>
                        <button name="hero_submit" class="btn btn-primary px-4">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Section
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="FormControlInput1" class="form-label">Section Heading</label>
                            <input name="section_heading" value="<?= $prevSection['heading'] ?>" type="text"
                                class="form-control" id="FormControlInput1" name="section-heading"
                                placeholder="Heading">
                        </div>
                        <div class="mb-3">
                            <label for="FormControlInput82" class="form-label">Header Position</label>
                            <select name="section_position" class="form-select" id="FormControlInput82"
                                name="heading position">
                                <option value="center">Center</option>
                                <option value="left">Left</option>
                                <option value="right">Right</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="FormControlInput81" class="form-label">Section description</label>
                            <input name="section_description" value="<?= $prevSection['description'] ?>" type="text"
                                class="form-control" id="FormControlInput91" name="section-description"
                                placeholder="Description...">
                        </div>
                        <button name="section_submit" class="btn btn-primary px-4">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <!-- Section forms generator form -->
    <form id="sectionForm" class="w-75 mx-auto p-2 my-4 border rounded" style="min-width:350px; max-width: 1000px;">
        <div class="form-group">
            <label for="sectionCount">Number of Sections:</label>
            <input type="number" class="form-control" id="sectionCount" min="1" required>
        </div>
        <button type="submit" class="btn btn-primary my-2">Generate Sections</button>
    </form>
    <!-- Section forms -->
    <div id="dynamicForm"></div>

    <!-- Manage sections -->
    <div class="container w-75 mx-auto mt-4 border rounded p-2" style="min-width:350px; max-width: 1000px;">
        <h3 class="text-center">Manage Sections</h3>
    </div>

    <!-- Upload image -->
    <form action="upload.php" style="min-width:350px; max-width: 1000px;"
        class="w-75 p-2 py-4 border rounded mx-auto d-flex flex-column gap-3 align-items-start my-4" method="post"
        enctype="multipart/form-data">
        <label for="">Upload Hero Image</label>
        <input type="file" name="image" class="form-control mt-2">
        <input type="submit" value="Upload" name="submit" class="btn btn-warning mt-2">
    </form>

    <!-- Load default -->
    <form class="w-75 mx-auto" action="" method="post">
        <button name="load-default" class="btn btn-dark px-4 d-block mx-auto">Load Default Values</button>
    </form>
    <!-- Output -->
    <h1 class="text-center mt-4">Output:</h1>
    <br>
    <div style="padding:0; overflow:hidden;" class="container border rounded-1 my-4">
        <?php include("layout.php") ?>
    </div>
</body>


</html>