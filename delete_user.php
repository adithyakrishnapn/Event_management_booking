<?php 
require('connect.php');
session_start();
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $username = $_SESSION['user_name'];
}
$name = $_POST['name'];
$number = $_POST['number'];

$query = "DELETE FROM details WHERE name = '$name' AND num = $number ";
$result = $con -> query($query);
if($result === TRUE){
    echo '<script type="text/javascript">';
    echo 'alert("Deleted");';
    echo 'window.location.href = "userdelete.php";';
    echo '</script>';
}
else{
    echo '<script type="text/javascript">';
    echo 'alert("Couldn\'t find");';
    echo 'window.location.href = "userdelete.php";';
    echo '</script>';
}

?>