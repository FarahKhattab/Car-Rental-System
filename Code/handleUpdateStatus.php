<?php

session_start();
require_once("carClass.php");
require_once("config.php");

var_dump($_POST);
$status = $_POST["status"];
$plate_no = $_SESSION["plate_no"];
// $user_ssn = $_SESSION["user_ssn"];
// $reservation_date = $_SESSION["reservation_date"];

require_once("carClass.php");
car::updateStatus($plate_no, $status);
header("location:adminAccount.php");