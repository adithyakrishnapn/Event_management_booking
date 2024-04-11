<?php 
require('connect.php');
session_start();
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $username = $_SESSION['user_name'];
}
$date = $_POST['date'];

$query = "DELETE FROM details WHERE date_time = '$date'";
$result = $con -> query($query);
if($result === TRUE){
    echo '<script type="text/javascript">';
    echo 'alert("Deleted");';
    echo 'window.location.href = "completebooked.php";';
    echo '</script>';
}
else{
    echo '<script type="text/javascript">';
    echo 'alert("Couldn\'t find");';
    echo 'window.location.href = "completebooked.php";';
    echo '</script>';
}

?>