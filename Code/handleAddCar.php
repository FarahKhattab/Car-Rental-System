<?php
session_start();
require_once("carClass.php");
require_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define an array to hold the names of empty fields
    $emptyFields = [];

    // Define your input fields
    $fields = [
        'plate_no' => $_POST["plate_no"] ?? '',
        'model' => $_POST["model"] ?? '',
        'type' => $_POST["type"] ?? '',
        'year' => $_POST["year"] ?? '',
        'color' => $_POST["color"] ?? '',
        'capacity' => $_POST["capacity"] ?? '',
        'office_id' => $_POST["office_id"] ?? '',
        'price_per_day' => $_POST["price_per_day"] ?? '',
        'city' => $_POST["city"] ?? '',
        'country' => $_POST["country"] ?? '',
        // 'image' is handled separately as it's a file
    ];

    // Loop through fields and check for emptiness
    foreach ($fields as $fieldName => $value) {
        if (empty($value)) {
            $emptyFields[] = $fieldName;
        }
    }

    // Handle File Upload for Image
    // Placeholder for image path
    $imagePath = '';
    $image = '';
    if (!isset($_FILES["image"]) || $_FILES["image"]["error"] != 0) {
        $emptyFields[] = 'image'; // Add 'image' to the list of empty fields if there's an error
        echo "Error code: " . $_FILES["image"]["error"];
    } else {
        $image = $_FILES["image"]["name"];
        $imagePath = 'C:/xampp/htdocs/Rana' . $_FILES["image"]["name"];
        // move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
    }

    if (!empty($emptyFields)) {
        // Redirect back to the form with a list of empty fields
        header("Location: addCarPage.php?msg=empty_fields&fields=" . implode(',', $emptyFields));
        exit;
    }

    car::addCar(
        $fields["plate_no"],
        $fields["model"],
        $fields["type"],
        $fields["color"],
        $fields["capacity"],
        $fields["price_per_day"],
        "available",
        $fields["office_id"],
        $image
    );

    // ... Rest of your car adding logic ...

    // Successful addition (placeholder, replace with actual success check)
    header("Location: adminAccount.php?msg=car_added");
    exit;
} else {
    // Not a POST request, redirect to the form or handle accordingly
    header("Location: addCarPage.php");
}
exit;