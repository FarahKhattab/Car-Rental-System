<!-- require_once("userClass.php");
require_once("displayCar.php");

if (isset($_POST['signout'])) {
// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to index.php
header("Location: index.php");
exit();
}
 -->


<?php
session_start();
session_unset();
// var_dump($_SESSION);
header("location:index.php");
