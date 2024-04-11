<?php 

$con = new mysqli("localhost", "root", "", "Event");
if ($con->connect_error) {
    die("Connection failed" . $con->connect_error);
}

?>