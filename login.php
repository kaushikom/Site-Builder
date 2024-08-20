<?php
include("common/connection.php");
include('insertdefault.php');
if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit'])) {
    $email = $_POST['user_email'];
    $password = $_POST['password'];

    $sql = 'SELECT * FROM users WHERE user_email = ? && user_password = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['username'] = $row['username'];
        insertDefaultData($conn);
        header('Location: editor.php');
        exit();
    } else {
        echo "Invalid email or password";
    }
}

include("common/connection.php");
if (isset($_SESSION['duplicateRegistration'])) {
    echo $_SESSION['duplicateRegistration'];
    unset($_SESSION['duplicateRegistration']);
}
if (isset($_SESSION['registrationSuccess'])) {
    echo $_SESSION['registrationSuccess'];
    unset($_SESSION['registrationSuccess']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</head>

<body>
    <h1 class="text-center mt-4">Login Account</h1>
    <h5 class="text-center mt-4 text-secondary">Please login account details</>

        <form action="" class="w-50 mx-auto d-flex flex-column align-items-start" method="post">
            <label class="my-2" for="user_email">Email</label>
            <input type="text" id="user_email" name="user_email" class="form-control my-3"
                placeholder="Enter email address">
            <label class="my-2" for="password">Password</label>
            <input type="text" id="password" name="password" class="form-control my-3" placeholder="Enter password">

            <button class="btn btn-primary" name="submit">LOG IN</button>

        </form>
        <div class="container w-50 mx-auto bg-dark text-light px-4 py-4 my-4">
            Don't have an account? <a class="text-white-50" href="signup.php">Sign up</a>
        </div>
</body>

</html>