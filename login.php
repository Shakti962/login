<?php
include('config/config.php');
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $sql = "SELECT * FROM `tbl_admin` WHERE `username` = '$username' AND `password` = '$password'";
    $result = $conn->query($sql);
    if ($result == true) {
        $count = $result->num_rows;
        if ($count == 1) {
            header('location:index.php');
            //start a new session
            session_start();

            // Store data in session variables
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;
        } else {
            echo "<script>
                    alert('User Not Found');
                </script>";
        }
    } else {
        echo "<script>
                    alert('Error, Try again leter!');
                </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/795131a83d.js" crossorigin="anonymous"></script>
    <!-- Bootstrap-Link -->
    <link rel="stylesheet" href="plugins/bootstrap.min.css">
    <!-- Css-Link -->
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <nav class="px-md-3 navbar navbar-expand-lg fixed-top">
        <a class="navbar-brand d-inline-block mx-auto" href="index.php"><img class="logo" src="svgs/logo.svg" alt=""></a>
    </nav>
    <div class="row d-flex align-items-center justify-content-center m-5 p-5 login-block">
        <img class="col-lg-6 login-img" src="images/sm-logo.png" alt="">
        <div class="col-lg-6 text-center">
            <form method="POST">
                <input type="text" name="username" class="p-2 w-50 my-4" type="text" placeholder="Name" required>
                <input type="password" name="password" class="p-2 w-50 my-4" type="password" placeholder="Password" required><br>
                <button type="submit" name="login" class="btn login-btn">Login</button>
            </form>
        </div>
    </div>

    <!-- JS Work -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="plugins/bootstrap.bundle.min.js" charset="utf-8"></script>
    <script src="js/index.js"></script>
</body>
</html>