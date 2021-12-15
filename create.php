<?php
include('config/config.php');
// Initialize the session
session_start();
//Authorization--Access Control
//Check that user logged in or not
if (!isset($_SESSION['username'])) {
    echo "<script>
                    alert('Please login to access the login panel');
                    window.location.replace('login.php');
                </script>";
}
//Getting the data from form
if (isset($_POST['submit'])) {
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    //SQL query to save data in database
    $sql = "INSERT INTO tbl_admin (`full_name`, `username`, `password`) VALUES ('$full_name', '$username', '$password')";
    // Execute SQL query and save data in database
    $result = $conn->query($sql);
    if ($result == true) {
        echo "<script>
            alert('Your data is successfully added')
            window.location.replace('index.php');
        </script>";
    } else {
        echo "<script>alert('your data is not added')</script>";
    }
}
//Updating Data In Database
if (isset($_POST['save'])) {
    $id = $_GET['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    //SQL query to update data in database
    $sql = "UPDATE tbl_admin SET `full_name` = '$full_name', `username`= '$username' WHERE `id` = '$id';";
    // Execute SQL query and update data in database
    $result = $conn->query($sql);
    if ($result == true) {
        echo "<script>
                    alert('Your data is successfully updated')
                    window.location.replace('Index.php');
                </script>";
    } else {
        echo "<script>alert('your data is not updated')</script>";
    }
}
//Fill Data In Input Fields
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    //SQL query to get data from database
    $sql_user = "SELECT * FROM `tbl_admin` WHERE `id` = '$id'";

    // Execute SQL query and save data in database
    $result_user = $conn->query($sql_user);
    $row = $result_user->fetch_assoc();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Profile</title>
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
    <div class="divider row text-center overflow-hidden p-4 w-100">
        <hr class="col-lg-4 my-auto">
        <h3 class="col-lg-4">Create Admin</h3>
        <hr class="col-lg-4 my-auto">
    </div>
    <img class="col-lg-6 login-img" src="images/sm-logo.png" alt="">
    <div class="col-lg-6 text-center">
        <form action="" method="post">
            <input type="text" name="full_name" class="p-2 w-50 my-4" placeholder="Full Name" value="<?php echo $row['full_name'] ?? "" ?>" required>
            <input type="text" name="username" class="p-2 w-50 my-4" placeholder="Username" value="<?php echo $row['username'] ?? "" ?>" required>
            <input type="password" name="password" class="p-2 w-50 my-4" placeholder="Password" <?php if (isset($_GET['id'])){echo '';}else{echo 'required';} ?>><br>
            <?php if (isset($_GET['id'])){ ?>
            <button id="save-btn" class="btn login-btn py-2 px-3 m-2" type="submit" name="save">Save</button>
            <?php }else{ ?>
            <button id="submit-btn" class="btn login-btn p-2 m-2" type="submit" name="submit">Create</button>
            <?php } ?>
        </form>
    </div>
</div>

<!-- JS Work -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="plugins/bootstrap.bundle.min.js" charset="utf-8"></script>
<script src="js/index.js"></script>
<?php
if (isset($_GET['id'])) {
    echo "<script>
            document.getElementsByClassName('col-lg-4')[1].textContent = 'Update Admin';
                </script>";
}
?>
</body>
</html>