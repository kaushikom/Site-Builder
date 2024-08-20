<?php session_start();
include("./common/connection.php");
include("./common/jsonOperations.php")
    ?>
<!-- Replace placeholder values with the data fetched -->
<!-- Function array to string conversion in Navbar links input -->
<!-- Handle section cards -->
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
    <h1 class="text-center mt-4">Editor</h1>
    <div class="accordion w-75 mx-auto mt-4" id="accordionExample" style="min-width:350px; max-width: 1000px;">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    Navbar
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="FormControlInput1" class="form-label">Navbar Header</label>
                            <input type="text" class="form-control" id="FormControlInput1" name="heading"
                                placeholder="Navbar">
                        </div>
                        <div class="mb-3">
                            <label for="FormControlInput2" class="form-label">Header Position</label>
                            <select class="form-select" id="FormControlInput2" name="heading position">
                                <option value="center">Center</option>
                                <option value="left">Left</option>
                                <option value="right">Right</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="FormControlInput5" class="form-label">Navbar Links</label>
                            <input type="text" class="form-control" id="FormControlInput5" name="navbar-links"
                                placeholder="Home, About, Contact, Careers">
                        </div>
                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" value="true" id="flexCheckDefault1">
                            <label class="form-check-label" for="flexCheckDefault1">
                                Add Search Bar
                            </label>
                        </div>
                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" value="true" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Dark Navbar
                            </label>
                        </div>
                        <button class="btn btn-primary px-4">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Hero
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="FormControlInput99" class="form-label">Heading</label>
                            <input type="text" class="form-control" id="FormControlInput99" name="heading"
                                placeholder="Heading">
                        </div>
                        <div class="mb-3">
                            <label for="FormControlInput97" class="form-label">Description</label>
                            <input type="text" class="form-control" id="FormControlInput97" name="description"
                                placeholder="Description">
                        </div>
                        <div class="mb-3">
                            <label for="FormControlInput96" class="form-label">Button text</label>
                            <input type="text" class="form-control" id="FormControlInput96" name="btn-txt"
                                placeholder="Submit">
                        </div>

                        <div class="mb-3">
                            <label for="FormControlInput98" class="form-label">Header Position</label>
                            <select class="form-select" id="FormControlInput98" name="hero position">
                                <option value="left">Left</option>
                                <option value="right">Right</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="FormControlInput89" class="form-label">Button Color</label>
                            <select class="form-select" id="FormControlInput89" name="hero position">
                                <option value="" selected>Select button background</option>
                                <option value="primary" class="text-bg-primary">Primary</option>
                                <option value="secondary" class="text-bg-secondary">Secondary</option>
                                <option value="success" class="text-bg-success">Success</option>
                                <option value="danger" class="text-bg-danger">Danger</option>
                                <option value="warning" class="text-bg-warning">Warning</option>
                                <option value="info" class="text-bg-info">Info</option>
                                <option value="light" class="text-bg-light">Light</option>
                                <option value="dark" class="text-bg-dark">Dark</option>
                            </select>
                        </div>

                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" value="true" id="flexCheckDefault100">
                            <label class="form-check-label" for="flexCheckDefault100">
                                Button outline
                            </label>
                        </div>

                        <button class="btn btn-primary px-4">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Section
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="mb-3">
                        <label for="FormControlInput1" class="form-label">Section Heading</label>
                        <input type="text" class="form-control" id="FormControlInput1" name="section-heading"
                            placeholder="Heading">
                    </div>
                    <div class="mb-3">
                        <label for="FormControlInput82" class="form-label">Header Position</label>
                        <select class="form-select" id="FormControlInput82" name="heading position">
                            <option value="center">Center</option>
                            <option value="left">Left</option>
                            <option value="right">Right</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="FormControlInput81" class="form-label">Section description</label>
                        <input type="text" class="form-control" id="FormControlInput91" name="section-description"
                            placeholder="Description...">
                    </div>
                    <button class="btn btn-primary px-4">Submit</button>
                </div>
            </div>
        </div>
    </div>


    <h1 class="text-center mt-4">Output:</h1>
    <br>
    <div style="padding:0; overflow:hidden;" class="container border rounded-1">

        <?php include("layout.php") ?>
    </div>
</body>

</html>