<?php
// Retrieve data sent from the form
$userSSN = $_POST['user_ssn'] ?? '';
$cardNo = $_POST['card_no'] ?? '';
$plateNo = $_POST['plate_no'] ?? '';
$startDate = $_POST['startDate'] ?? '';
$endDate = $_POST['endDate'] ?? '';

// Connection to your database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get price per hour based on plate_no
$sqlPrice = "SELECT price_per_day FROM car WHERE plate_no = '$plateNo'";
$resultPrice = $conn->query($sqlPrice);

if ($resultPrice->num_rows > 0) {
    $row = $resultPrice->fetch_assoc();
    $pricePerDay = $row["price_per_day"];

    // Calculate total amount

    $startDateTime = new DateTime($startDate);
    $endDateTime = new DateTime($endDate);

    $startMonth = $startDateTime->format('m');
    $endMonth = $endDateTime->format('m');

    $startYear = $startDateTime->format('Y');
    $endYear = $endDateTime->format('Y');

    $interval = $startDateTime->diff($endDateTime);

    if ($startMonth == $endMonth && $startYear == $endYear) {
        // If dates are in the same month and year
        $totalDays = $interval->days;
    } elseif ($startYear == $endYear) {
        // If dates are in different months but same year
        $daysInStartMonth = cal_days_in_month(CAL_GREGORIAN, $startMonth, $startYear);
        $startToEndMonthDays = $daysInStartMonth - $startDateTime->format('j'); // Days remaining in start month

        $totalDays = $startToEndMonthDays + $endDateTime->format('j');
    } else {
        // If dates span across multiple months and years
        $startToEndMonthDays = cal_days_in_month(CAL_GREGORIAN, $startMonth, $startYear) - $startDateTime->format('j');
        $endToStartMonthDays = $endDateTime->format('j');

        $totalDays = $startToEndMonthDays + $endToStartMonthDays;

        // Count the days in all the months in between
        for ($i = $startMonth + 1; $i < $endMonth; $i++) {
            $totalDays += cal_days_in_month(CAL_GREGORIAN, $i, $startYear);
        }
    }
    echo "Total days: $totalDays";
    echo "Price per hour: $pricePerDay";
    $totalAmount = $totalDays * $pricePerDay; // Total billing amount

    $plate_no = $_POST['plate_no'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    // $status = "ongoing";

    // // Insert data into transaction table
    // $currentDate = date("Y-m-d"); // Current date
    // $sqlInsertTransaction = "INSERT INTO rental (user_ssn, plate_no ,reservation_date,pick_up_date,return_date,card_no,total_amount,rental_status)
    //                          VALUES ('$userSSN', '$plate_no','$currentDate', '$startDate','$endDate','$cardNo', '$totalAmount','$status')";

    // $carStatus = "rented";
    // // require_once("carClass.php");
    // $qry = "UPDATE car SET status = '$carStatus' WHERE plate_no='$plate_no'";
    // require_once("config.php");

    // $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    // $result1 = mysqli_query($cn, $qry);

    // $result2 = mysqli_query($cn, $sqlInsertTransaction);


    //  $result = mysqli_query($cn, $qry);

    // mysqli_close($cn);
    // header("Location: userAccount.php");
    $status = "ongoing";

    // Insert data into transaction table
    $currentDate = date("Y-m-d"); // Current date
    $sqlInsertTransaction = "INSERT INTO rental (user_ssn, plate_no, reservation_date, pick_up_date, return_date, card_no, total_amount, status)
                         VALUES ('$userSSN', '$plate_no', '$currentDate', '$startDate', '$endDate', '$cardNo', '$totalAmount', '$status')";

    $carStatus = "rented";
    $qry = "UPDATE car SET status = '$carStatus' WHERE plate_no='$plate_no'";

    require_once("config.php");

    $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    // Execute the update query for the car status
    $result2 = mysqli_query($cn, $sqlInsertTransaction);
    $result1 = mysqli_query($cn, $qry);

    // Check for errors in the update query
    if (!$result1) {
        echo "Error updating car status: " . mysqli_error($cn);
        mysqli_close($cn);
        exit();
    }

    // Execute the insert query for the rental data


    // Check for errors in the insert query
    if (!$result2) {
        echo "Error inserting into rental table: " . mysqli_error($cn);
        mysqli_close($cn);
        exit();
    }

    mysqli_close($cn);

    header("Location: userAccount.php");


    // if ($conn->query($sqlInsertTransaction) === TRUE) {
    //     $lastTransactionId = $conn->insert_id;

    //     // Insert data into rental table
    //     $sqlInsertRental = "INSERT INTO rental (user_ssn, plate_no, reservation_date, pick_up_date, return_date, transaction_id)
    //                         VALUES ('$userSSN', '$plateNo', '$currentDate', '$startDate', '$endDate', '$lastTransactionId')";
    //     $sqlUpdateCarStatus = "UPDATE car SET status = 'Rented' WHERE plate_no = '$plateNo'";

    //     if ($conn->query($sqlUpdateCarStatus) === TRUE) {
    //         header("Location: userAccount.php");
    //         $conn->close();
    //     } else {
    //         echo "Error: " . $sqlInsertRental . "<br>" . $conn->error;
    //     }
    // } else {
    //     echo "Error: " . $sqlInsertTransaction . "<br>" . $conn->error;
    // }
} else {
    echo "No car found with the provided plate number.";
}

// require_once("config.php");
// $qry = "UPDATE car SET status = '$status' WHERE plate_no='$plate_no'";
// $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
// $result = mysqli_query($cn, $qry);

// mysqli_close($cn);