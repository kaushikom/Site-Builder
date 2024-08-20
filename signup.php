<?php
include("common/connection.php");
if (($_SERVER['REQUEST_METHOD'] == 'POST') && (isset($_POST['submit']))) {
    $email = $_POST['user_email'];
    $checksql = 'SELECT * FROM users WHERE user_email=?';
    $stmt = $conn->prepare($checksql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['duplicateRegistration'] = "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
  <strong>User already registered!</strong> Proceed to login or use another email.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
        header('Location: login.php');
        exit();
    } else {
        $username = $_POST['user_name'];
        $password = $_POST['password'];

        $sql = 'INSERT INTO users (username, user_email, user_password) VALUES (?, ?, ?)';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $username, $email, $password);
        $stmt->execute();

        $_SESSION['registration'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Registerd!</strong> You may now login.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
        header('Location: login.php');
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</head>

<body>
    <h1 class="text-center mt-4">Create Account</h1>
    <h5 class="text-center mt-4 text-secondary">Please register account details</>

        <form action="" class="w-50 mx-auto d-flex flex-column align-items-start" method="post">
            <label class="my-2" for="user_name">Name</label>
            <input type="text" id="user_name" name="user_name" class="form-control my-3" placeholder="Enter your name">
            <label class="my-2" for="user_email">Email</label>
            <input type="text" id="user_email" name="user_email" class="form-control my-3"
                placeholder="Enter email address">
            <label class="my-2" for="password">Password</label>
            <input type="text" id="password" name="password" class="form-control my-3" placeholder="Enter password">

            <button class="btn btn-primary" name="submit">CREATE ACCOUNT</button>

        </form>
        <div class="container w-50 mx-auto bg-dark text-light px-4 py-4 my-4">
            Already have an account? <a class="text-white-50" href="login.php">Log in</a>
        </div>
</body>

</html>