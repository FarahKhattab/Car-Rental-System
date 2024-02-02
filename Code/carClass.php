<?php

class car
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

    // Constructor
    public function __construct($plate_no, $model, $car_type, $year, $color, $capacity, $price_per_day, $office_id, $image)
    {
        $this->plate_no = $plate_no;
        $this->model = $model;
        $this->car_type = $car_type;
        $this->year = $year;
        $this->color = $color;
        $this->capacity = $capacity;
        $this->price_per_day = $price_per_day;
        $this->status = "available";
        $this->office_id = $office_id;
        $this->image = $image;
    }

    static function getCars()
    {
        require_once("config.php");
        $qry = " SELECT * FROM car";

        $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $result = mysqli_query($cn, $qry);
        $data = mysqli_fetch_all($result);
        mysqli_close($cn);
        return $data;
    }

    static function getThisUserCars()
    {
        require_once("config.php");

        $status = "available";

        // Adjust the query to filter cars based on the 'status' column
        $qry = "SELECT * FROM car WHERE status = '$status'";
        $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $result = mysqli_query($cn, $qry);
        $data = mysqli_fetch_all($result);
        mysqli_close($cn);
        return $data;
    }

    static function getCarDetailsById($plate_no)
    {
        require_once("config.php");

        $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        // Sanitize input to prevent SQL injection
        $plate_no = mysqli_real_escape_string($cn, $plate_no);

        // Fetch car details using the provided ID
        $qry = "SELECT * FROM car WHERE plate_no = '$plate_no'";
        $result = mysqli_query($cn, $qry);

        // Check if the query was successful
        if ($result) {
            $carDetails = mysqli_fetch_assoc($result);
            mysqli_close($cn);
            return $carDetails; // Return the details if found
        } else {
            mysqli_close($cn);
            return null; // Return null if car details not found
        }
    }

    static function addCar($plate_no, $model, $car_type, $color, $capacity, $price_per_day, $status, $office_id, $image)
    {
        require_once("config.php");
        $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        // Sanitize inputs
        $plate_no = mysqli_real_escape_string($cn, $plate_no);
        $model = mysqli_real_escape_string($cn, $model);
        $car_type = mysqli_real_escape_string($cn, $car_type);
        $color = mysqli_real_escape_string($cn, $color);
        $capacity = intval($capacity);
        $price_per_day = floatval($price_per_day);
        $status = mysqli_real_escape_string($cn, $status);
        $office_id = intval($office_id);
        $image = mysqli_real_escape_string($cn, $image);

        // Query to insert data
        $qry = "INSERT INTO car (plate_no, model, car_type, color, capacity, price_per_day, status, office_id, image)
                VALUES ('$plate_no', '$model', '$car_type', '$color', $capacity, $price_per_day, '$status', $office_id, '$image')";

        $result = mysqli_query($cn, $qry);

        // Error handling
        if ($result) {
            echo "Car added successfully!";
        } else {
            echo "Error: " . mysqli_error($cn);
        }

        mysqli_close($cn);
    }


    static function updateStatus($plate_no, $status)
    {
        $rental = "cancelled";
        require_once("config.php");
        $qry = "UPDATE car SET status = '$status' WHERE plate_no='$plate_no'";



        $qry2 = "UPDATE rental
        SET status = 'cancelled'
        WHERE plate_no = '$plate_no'";

        $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $result = mysqli_query($cn, $qry);
        $result = mysqli_query($cn, $qry2);

        mysqli_close($cn);
    }


    static function getrentedCars()
    {
        require_once("config.php");

        $status = "rented";

        // Adjust the query to filter cars based on the 'status' column
        $qry = "SELECT * FROM car WHERE status = '$status'";
        $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $result = mysqli_query($cn, $qry);
        $data = mysqli_fetch_all($result);
        mysqli_close($cn);
        return $data;
    }
}
