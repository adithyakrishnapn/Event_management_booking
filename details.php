<?php
session_start();
require('connect.php');

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $username = $_SESSION['user_name'];
} else {
    echo "Please log in";
    exit(); // Stop further execution if not logged in
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'sendemail/phpmailer/src/Exception.php';
require 'sendemail/phpmailer/src/PHPMailer.php';
require 'sendemail/phpmailer/src/SMTP.php';

$address = $_POST["adrs"];
$dt = $_POST["date"];
$code = $_POST["code"];
$email = "dragoncorexgamer@gmail.com";
$sub = "Event Management";
$number = $_POST["number"];
$mail = $_POST["mail"];

$quer = "SELECT * FROM details WHERE date_time = '$dt'";
$rs = $con->query($quer);

if ($rs->num_rows > 0) {
    echo '<script type="text/javascript">';
    echo 'alert("Already Booked, change the date");';
    echo 'history.go(-1);';
    echo '</script>';
} else {
    $r = "INSERT INTO details (name, address, code, date_time, number, mail) VALUES ('$username', '$address', '$code', '$dt', $number, '$mail')";
    $result = $con->query($r);

    if ($result === TRUE) {
        // Mail Connecting
        if (isset($_POST["send"])) {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'dragoncorexgamer@gmail.com';
            $mail->Password = 'vmlzvtasuyowectn';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('dragoncorexgamer@gmail.com');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = $sub;
            $mail->Body = "Name : " . $username . "<br> Mail : " . $_POST["mail"] . "<br> Number : " . $_POST["number"] ."<br> Date : " . $_POST["date"] . "<br> Purpose : " . $_POST["message"];

            $mail->send();

            echo "<script>
                alert('Booked');
                </script>";
        }

        
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("Error: ' . $con->error . '");';
        echo 'window.location.href = "book.php";';
        echo '</script>';
    }
}

$con->close();
?>



<!--html-->
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
                <?php 
                $con = new mysqli("localhost", "root", "", "Event");
                if ($con->connect_error) {
                    die("Connection failed" . $con->connect_error);
                }
                else{
                    $query = "SELECT * FROM details WHERE name = '$username' AND num = $userId";
                    $res = $con->query($query);
                    if($res->num_rows >0){
                        echo "<p>".'Logged in as '.$username;
                    }
                    else{
                        echo "No account found";
                        echo '<script type="text/javascript">';
                        echo 'alert("No account found");';
                        echo 'window.location.href = "index.php";';
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
    <h1>Details</h1>
    <table width="100%" border="2px">
        <tr>
            <th>Name</th>
            <th>Address</th>
            <th>Date</th>
        </tr>
    <?php 

    $query = "SELECT address,date_time,name FROM details WHERE date_time = '$dt'";
    $res = $con->query($query);
     if($res->num_rows > 0){
        while($row = $res->fetch_assoc()){
            echo "<tr>";
            echo "<td>".$row['name']."</td>";
            echo "<td>".$row['address']."</td>";
            echo "<td>".$row['date_time']."</td>";
            echo "</tr>";        }
    }
    else{
            echo "0 results found";
    }
     $con->close()
    ?>
    </table>
    <button onclick="history.back()">Go Back</button>
</body>
</html>