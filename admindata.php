<?php 

$name = $_POST["name"];
$number = $_POST["number"];

$con = new mysqli("localhost", "root", "", "");
if ($con->connect_error) {
    die("Connection failed" . $con->connect_error);
}

$query = "CREATE DATABASE IF NOT EXISTS Event";
$result = $con->query($query);

if ($result === TRUE) {
    $con->select_db("Event");
    $tc = "CREATE TABLE IF NOT EXISTS admin(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        num INT(20) NOT NULL
    )";

    $tableCreationResult = $con->query($tc);

    if ($tableCreationResult === TRUE) {
        $checkQuery = "SELECT * FROM admin WHERE name = '$name'";
        $checkResult = $con->query($checkQuery);
        
        if ($checkResult->num_rows > 0) {
            // Values already exist
            echo "Already a user";
            echo '<script type="text/javascript">';
            echo 'alert("Already a Admin");';
            echo 'window.location.href = "admincreate.php";';
            echo '</script>';
        } else {
            // Values don't exist, insert them into the table
            $insertQuery = "INSERT INTO admin (name, num) VALUES ('$name', $number)";
            
            if ($con->query($insertQuery) === TRUE) {
                echo "Account created";
                echo '<script type="text/javascript">';
                echo 'alert("Account created");';
                echo 'window.location.href = "admincreate.php";';
                echo '</script>';
            } else {
                echo "Error inserting record: " . $con->error;
            }
        }

    } else {
        echo("Table creation failed: " . $con->error);
    }
} else {
    echo("Failed connecting to database");
}

// Close the connection
$con->close();
?>
