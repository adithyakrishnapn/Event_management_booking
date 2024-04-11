<?php 
require('connect.php');
$name = $_POST['name'];
$number = $_POST['number'];

$query = "UPDATE details SET num = $number WHERE name = '$name'";
$res = $con->query($query);

if ($res === TRUE){
    echo '<script type="text/javascript">';
    echo 'alert("Updated");';
    echo 'window.location.href = "index.php";';
    echo '</script>';
}
else{
    echo ("error".connect_error);
}
?>