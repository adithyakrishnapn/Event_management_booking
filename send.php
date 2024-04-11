<?php 

$name = $_POST["name"];
$number = $_POST["number"];

session_start();
$_SESSION['user_id'] = $number;
$_SESSION['user_name'] = $name;


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
                <?php 
                $con = new mysqli("localhost", "root", "", "Event");
                if ($con->connect_error) {
                    die("Connection failed" . $con->connect_error);
                }
                else{
                    $query = "SELECT * FROM details WHERE name = '$name' AND num = $number";
                    $res = $con->query($query);
                    if($res->num_rows >0){
                        echo "<p>".'Logged in as '.$name;
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
<div class="sty">
<h5 style="text-align: center; padding-top: 20px;">Welcome</h5>
    <p style="text-align:center;">
        <?php 
            $qr = "SELECT code FROM details WHERE name = '$name' AND num = $number";
            $result = $con -> query($qr);
            if($result -> num_rows >0 ){
                while($row = $result->fetch_assoc()){
                    echo "Your Code : ".$row['code'];
                }
            }    
            else{
                echo "No Data Found";
            }    
        ?>
    </p>
    <p style="text-align:center;">Use this code to book Events.</p>
</div>
    <div class="main">
        <div class="box">
            <a class="sample" href = "booked.php">VIEW BOOKED</a>
            <a class="sample" href = "book.php">BOOK NEW</a>
        </div>
    </div>
</body>
</html>