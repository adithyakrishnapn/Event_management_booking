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
                    $query = "SELECT * FROM admin WHERE name = '$username' AND num = $userId";
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
<div class="mainobject">
    <table width="100%" border="2px">
        <tr>
            <th>Name</th>
            <th>Address</th>
            <th>Date</th>
        </tr>
            <?php 
                $row = $res -> fetch_assoc();
                $selectionQuery = "SELECT * FROM details WHERE date_time IS NOT NULL";
                $selectionResult = $con -> query($selectionQuery);
                if($selectionResult ->num_rows>0){
                    while($rower = $selectionResult->fetch_assoc()){
                        echo "<tr>";
                        echo "<td>".$rower['name']."</td>";
                        echo "<td>".$rower['address']."</td>";
                        echo "<td>".$rower['date_time']."</td>";
                        echo "</tr>";
                    }
                }
                else{
                    echo "No Data Found";
                }
            ?>
    </table><br>
    <div class="cls">
    <form action="delete_date.php" method="POST" style="width:50%; background-color: rgb(47, 134, 255); padding: 20px;">
        <label>Enter the date of Event to be deleted</label>
        <input type="date" name="date">
        <input type="submit">
    </form>
    </div>
</div>
</body>
</html>