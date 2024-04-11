<?php 

session_start();
require('connect.php');
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
    <div class="main">
        <div class="boxed">
        <form action="details.php" method="post">
            <h6 style="text-align: center;">BOOK EVENT MANAGEMENT</h6>
                <p style="text-align:center;">
                    <?php 
                        $qr = "SELECT code FROM details WHERE name = '$username' AND num = $userId";
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
            <p style="text-align:center;">Use this code book Events.</p>
            <label>Name</label><br>
            <input type="text" id="name" name="name"><br>
            <label>Code</label><br>
            <input type="text" id="code" name="code"><br>
            <label>Address</label><br>
            <input type="text" id="address" name="adrs"><br>
            <label>Mail</label><br>
            <input type="text" name="mail"><br>
            <label>Number</label><br>
            <input type="number" name="number"><br>
            <label>Date</label><br>
            <input type="date" id="datetime" name="date"><br>
            <label>Purpose</label><br>
            <input type="text" name="message"><br>
            <input type="submit" name="send">
         </form>
        </div>
    </div>
</body>
</html>