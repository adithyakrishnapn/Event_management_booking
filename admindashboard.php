<?php
// Start the session
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process the form data
    $name = $_POST["name"];
    $number = $_POST["number"];
    
    // Store form data in session variables
    $_SESSION['user_id'] = $number;
    $_SESSION['user_name'] = $name;
    
    $con = new mysqli("localhost", "root", "", "Event");
    if ($con->connect_error) {
        die("Connection failed" . $con->connect_error);
    }
    else{
        $query = "SELECT * FROM admin WHERE name = '$name' AND num = $number";
        $res = $con->query($query);
        if($res->num_rows >0){
            echo "<p>".'Logged in as '.$name;
        }
        else{
            echo "No account found";
            echo '<script type="text/javascript">';
            echo 'alert("No account found");';
            echo 'window.location.href = "admin.php";';
            echo '</script>';
        }
    }
    // Redirect user to admindashboard.php to prevent form resubmission
    header("Location: admindashboard.php");

 // Ensure no further code execution after redirection
 exit();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
<nav>
    <div class="container">
        <div class="row">
            <div class="right col-6 pt-3">
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
    <h5 style="text-align: center; color: white;padding-top: 30px;">Welcome</h5>
        <div class="box">
            <p><a class="sample" href = "completebooked.php">VIEW BOOKED</a></p>
            <p><a class="sample" href = "admincreate.php">CREATE NEW ADMIN</a></p>
            <p><a class="sample" href = "userdelete.php">DELETE USERS</a></p>
            <p><a class="sample" href = "admindelete.php">DELETE ADMIN</a><br></p>
        </div>
    </div>
</body>
</html>