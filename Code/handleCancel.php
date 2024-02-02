<?php
require_once("rentalsClass.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $plate_number = $_POST["plate_number2"]; // Fetch rental ID
    $user_ssn = $_POST["user_ssn2"];
    $reservation_date = $_POST["reservation_date2"]; // Fetch plate number

    echo $plate_number ;
    echo $user_ssn ;
    echo $reservation_date ;
    if(rental:: cancelRentals( $user_ssn,$plate_number,$reservation_date))
    {
        echo "success";
    }
  else  {
        echo "fail";   
    }
    header("location:rentals.php");

}
?>
