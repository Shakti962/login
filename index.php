<?php

// Initialize the session
session_start();
if (isset($_POST['logout'])) {
    // Unset all the session variables
    $_SESSION = array();

    // Destroy the session.
    session_destroy();

    // Redirect to login page
    header("location: login.php");
    exit;
}
//Authorization--Access Control
//Check that user logged in or not
if (!isset($_SESSION['username'])) {
    echo "<script>
                    alert('Please login to access the login panel');
                    window.location.replace('login.php');
                </script>";
}

include('config/config.php');
//Delete User From Database
if(isset($_GET['id'])){
    $id = $_GET['id'];
    //SQL query to delete data from database
    $sql = "DELETE FROM `tbl_admin` WHERE `id` = '$id'";
    //Excute SQL query and save data in database
    $result = $conn->query($sql);
    //Returning to home URL
    if ($result == true) {
        echo "<script>
                    alert('Admin deleted successfully')
                    window.location.replace('index.php');
                </script>";
    } else {
        echo "<script>alert('Admin not deleted')</script>";
    }
}
//SQL query to get data from database
$sql = "SELECT * FROM `tbl_admin`";

// Excute SQL query and save data in database
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/795131a83d.js" crossorigin="anonymous"></script>
    <!-- Bootstrap-Link -->
    <link rel="stylesheet" href="plugins/bootstrap.min.css">
    <!-- Css-Link -->
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <nav class="px-md-3  navbar navbar-expand-lg fixed-top">
        <a class="navbar-brand" href="index.php"><img class="logo" src="svgs/logo.svg" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon" onclick="openNav()"><img class="nav-img" src="svgs/nav-icon.svg" alt=""></span>
        </button>
        <div id="sideNav" class="side-nav d-inline d-lg-none ms-auto" onclick="closeNav()">
            <div class="closebtn mb-5" ><i class="color-yellow fas fa-times" onclick="closeNav()"></i></div>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item px-3"><a class="nav-link active" href="index.php">Home</a></li>
                <form method="post">
                    <li class="nav-item px-3">
                        <a class="nav-link navbar-link">
                            <button class="btn" type="submit" name="logout">Logout</button>
                        </a></li>
                </form>
            </ul>
        </div>
        <div class="d-none d-lg-inline ms-auto">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item px-3"><a class="nav-link active" href="index.php">Home</a></li>
                <form method="post">
                    <li class="nav-item px-3">
                        <a class="nav-link navbar-link">
                            <button class="btn p-0 text-light" type="submit" name="logout">Logout</button>
                        </a></li>
                </form>
            </ul>
        </div>
    </nav>
    <div class="m-0 my-5 p-0 m-lg-5 p-lg-5">
        <div class="divider row text-center overflow-hidden p-4 w-100">
            <hr class="col-lg-5 my-auto">
            <h3 class="col-lg-2">Admin Panel</h3>
            <hr class="col-lg-5 my-auto">
        </div>
        <div class="row pt-3 m-0 mx-lg-4">
            <div class="col-lg-2 col-md-4 text-center admin-card p-4 m-3">
                <button class="btn mt-3">
                    <a href="create.php"><i class="far fa-plus-square fa-4x" style="color: #fff"></i></a>
                </button>
            </div>
            <?php while($row = $result->fetch_assoc()) { ?>
            <div class="col-lg-2 col-md-4 text-center admin-card p-4 m-3">
                <h5 class="pb-5"><?php echo $row['full_name'] ?></h5>
                <hr class="divider">
                <div class="pt-1">
                    <button class="btn bg-yellow px-4 py-0"><a style="color: #1a1e21;" onClick="return confirm('Are you sure you want to delete?')" href="?id=<?php echo $row['id'] ?>"><i class="fas fa-trash-alt"></i></a></button>
                    <button class="btn bg-yellow px-4 py-0"><a style="color: #1a1e21;" href="create.php?id=<?php echo $row['id'] ?>"><i class="fas fa-pencil-alt"></i></a></button>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    <!-- JS Work -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="plugins/bootstrap.bundle.min.js" charset="utf-8"></script>
    <script src="js/index.js"></script>
</body>
</html>