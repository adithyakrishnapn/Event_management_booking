<?php


echo '<script type="text/javascript">';
echo 'alert("Logged Out");';
echo '</script>';
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page or any other appropriate page
header("Location: index.php");
exit();


?>