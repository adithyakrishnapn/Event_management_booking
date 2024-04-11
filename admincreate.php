<?php 
require('connect.php');
session_start();
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $username = $_SESSION['user_name'];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
<nav>
    <div class="container">
        <div class="row">
            <div class="right col-6 pt-3">
                <?php 
                $con = new mysqli("localhost", "root", "", "Event");
                if ($con->connect_error) {
                    die("Connection failed" . $con->connect_error);
                }
                else{
                    $query = "SELECT * FROM admin WHERE name = '$username' AND num = $userId";
                    $res = $con->query($query);
                    if($res->num_rows >0){
                        echo "<p>".'Logged in as '.$username;
                    }
                    else{
                        echo "No account found";
                        echo '<script type="text/javascript">';
                        echo 'alert("No account found");';
                        echo 'window.location.href = "admin.php";';
                        echo '</script>';
                    }
                }
                ?>
            </div>
            <div class="left col-6 pt-2">
                <ul>
                    <li>
                        <form action="logout.php">
                        <input type="submit" value="Log Out">
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<div class="main">
    <div class="box">
    <form action="admindata.php" method="post">
        <label>Name</label>
        <input type="text" id="name" name="name"><br>
        <label>Number</label>
        <input type="text" id="number" name="number" placeholder="New number"><br>
        <input type="submit" name="submit">
        <hr>
    </form>
    </div>
</div>
</body>
</html>