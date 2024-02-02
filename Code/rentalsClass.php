<?php
require_once("carClass.php");
class rental
{
    // Properties
    public $plate_no;
    public $model;
    public $car_type;
    public $color;
    public $capacity;
    public $price_per_day;
    public $status;
    public $office_id;
    public $image;
    public $year;

    static function getRentals($user_ssn)
    {
        require_once("config.php");
        $qry = "SELECT rental.plate_no, reservation_date, pick_up_date, return_date, card_no, total_amount, rental.status,image
        FROM rental JOIN car on rental.plate_no=car.plate_no
        WHERE rental.user_ssn = $user_ssn";

        $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $result = mysqli_query($cn, $qry);
        $data = mysqli_fetch_all($result);
        mysqli_close($cn);
        return $data;
    }




    static function getCarRentals($plate_no)
    {
        require_once("config.php");
        $qry = "SELECT user_ssn, reservation_date, pick_up_date, return_date, card_no, total_amount, status FROM rental WHERE plate_no = ?";

        $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $stmt = mysqli_prepare($cn, $qry);

        // Check for connection and prepared statement errors
        if (!$cn || !$stmt) {
            // Handle errors, you may use mysqli_error() to get specific error details
            return false;
        }

        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, "s", $plate_no);

        // Execute the statement
        $exec = mysqli_stmt_execute($stmt);

        if ($exec) {
            // Get the result set
            $result = mysqli_stmt_get_result($stmt);

            // Fetch all rows into an associative array
            $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

            // Free the result set
            mysqli_free_result($result);

            mysqli_stmt_close($stmt);
            mysqli_close($cn);
            return $data;
        } else {
            mysqli_stmt_close($stmt);
            mysqli_close($cn);
            return false; // Return false to indicate failure
        }
    }


    static function cancelRentals($user_ssn, $plate_no, $reservation_date)
    {
        $status = "available";
        car::updateStatus($plate_no, $status);
        require_once("config.php");
        $qry = "UPDATE rental SET  status = ? WHERE user_ssn = ? AND plate_no = ? AND reservation_date = ?";

        $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $stmt = mysqli_prepare($cn, $qry);

        // Bind parameters to the prepared statement
        $status = "canceled";
        mysqli_stmt_bind_param($stmt, "ssss", $status, $user_ssn, $plate_no, $reservation_date);

        // Execute the statement
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            mysqli_stmt_close($stmt);
            mysqli_close($cn);
            return true;
        } else {
            mysqli_stmt_close($stmt);
            mysqli_close($cn);
            return false; // Return false to indicate failure
        }
    }

    static function getCar_UserRentals()
    {
        require_once("config.php");
        $qry = "SELECT ssn, rental.plate_no, reservation_date, pick_up_date, return_date, card_no, total_amount, rental.status AS rental_status, model, car_type, color, capacity, price_per_day, car.status, country, city, fname, lname, email, phone_no, address FROM ((rental Join car on rental.plate_no=car.plate_no) JOIN office on car.office_id=office.office_id) JOIN user on rental.user_ssn=user.ssn";

        $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $stmt = mysqli_prepare($cn, $qry);

        // Check for connection and prepared statement errors
        if (!$cn || !$stmt) {
            // Handle errors, you may use mysqli_error() to get specific error details
            return false;
        }

        // Execute the statement
        $exec = mysqli_stmt_execute($stmt);

        if ($exec) {
            // Get the result set
            $result = mysqli_stmt_get_result($stmt);

            // Fetch all rows into an associative array
            $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

            // Free the result set
            mysqli_free_result($result);

            mysqli_stmt_close($stmt);
            mysqli_close($cn);
            return $data;
        } else {
            mysqli_stmt_close($stmt);
            mysqli_close($cn);
            return false; // Return false to indicate failure
        }
    }


    static function getCar_User_dateRentals($date)
    {
        require_once("config.php");
        $qry = "SELECT ssn, rental.plate_no, reservation_date, pick_up_date, return_date, card_no, total_amount, rental.status AS rental_status, model, car_type, color, capacity, price_per_day, car.status, country, city, fname, lname, email, phone_no, address FROM ((rental Join car on rental.plate_no=car.plate_no) JOIN office on car.office_id=office.office_id) JOIN user on rental.user_ssn=user.ssn where rental.reservation_date=?";

        $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $stmt = mysqli_prepare($cn, $qry);

        // Check for connection and prepared statement errors
        if (!$cn || !$stmt) {
            // Handle errors, you may use mysqli_error() to get specific error details
            return false;
        }

        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, "s", $date);

        // Execute the statement
        $exec = mysqli_stmt_execute($stmt);

        if ($exec) {
            // Get the result set
            $result = mysqli_stmt_get_result($stmt);

            // Fetch all rows into an associative array
            $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

            // Free the result set
            mysqli_free_result($result);

            mysqli_stmt_close($stmt);
            mysqli_close($cn);
            return $data;
        } else {
            mysqli_stmt_close($stmt);
            mysqli_close($cn);
            return false; // Return false to indicate failure
        }
    }
}
