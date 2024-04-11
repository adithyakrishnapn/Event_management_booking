<?php
// Start the session
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted name and number
    $name = $_POST["name"];
    $number = $_POST["number"];

    // Establish database connection
    $con = new mysqli("localhost", "root", "", "Event");
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Prepare and execute SQL query to check if admin credentials are valid
    $query = "SELECT * FROM admin WHERE name = ? AND num = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("si", $name, $number);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if admin credentials are valid
    if ($result->num_rows > 0) {
        // Admin credentials are valid, set session variables
        $_SESSION['user_id'] = $number;
        $_SESSION['user_name'] = $name;

        // Redirect to admin dashboard
        header("Location: admindashboard.php");
        exit(); // Ensure no further code execution after redirection
    } else {
        // Admin credentials are invalid, show error message
        $error_message = "Invalid admin credentials";
    }
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
                <div class="right col-6">

                </div>
                <div class="left col-6">
                    <ul>
                        <li><a href="admin.php" class="active">ADMIN</a></li>
                        <li><a href="index.php">USER</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="main">
        <center><h1 style="color: white;" class="pt-4">Admin Login</h1></center>
        <center><?php if (isset($error_message)) : ?>
            <p><?php echo $error_message; ?></p>
        <?php endif; ?></center>
        <div class="box">
            <form action="" method="post">
            <label>Name</label><br>
            <input type="text" id="name" name="name"><br>
            <label>Password</label><br>
            <input type="text" id="number" name="number"><br>
            <input type="submit" name="submit">
            </form>
            <hr>
            <p>Forgot password ?<a href="changepass.php">Click here</a></p>  
        </div>
    </div>
</body>
</html>