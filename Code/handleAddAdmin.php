<?php

// Function to check if a password meets certain criteria and determine its strength
function checkPasswordStrength($password)
{
    // Define regex patterns for different criteria
    $patterns = [
        'length' => '/.{8,}/',
        'uppercase' => '/[A-Z]/',
        'lowercase' => '/[a-z]/',
        'number' => '/[0-9]/',
        'specialChar' => '/[!@#$%^&*()_+\-=[\]{};\'":\\|,.<>\/?]/'
    ];

    // Check each criterion
    $strength = [
        'length' => preg_match($patterns['length'], $password),
        'uppercase' => preg_match($patterns['uppercase'], $password),
        'lowercase' => preg_match($patterns['lowercase'], $password),
        'number' => preg_match($patterns['number'], $password),
        'specialChar' => preg_match($patterns['specialChar'], $password)
    ];

    // Calculate the overall strength based on criteria met
    $strengthScore = array_sum($strength);
    $totalCriteria = count($strength);
    $strengthPercentage = ($strengthScore / $totalCriteria) * 100;

    // Determine strength level based on percentage
    if ($strengthPercentage >= 60) {
        return true;
    } else {
        return false;
    }
}
require_once("adminClass.php");

// Checking for empty fields
if (empty($_POST["ssn"]) || empty($_POST["fname"]) || empty($_POST["lname"]) || empty($_POST["email"]) || empty($_POST["password"])  || empty($_POST["confirm_password"]) || empty($_POST["officeid"])) {
    header("location:addAdminPage.php?msg=empty_field");
    exit;
} else if (!Admin::checkEmail($_POST["email"])) {
    header("location:addAdminPage.php?msg=User Already Exists");
    exit;
} else if ($_POST["password"] != $_POST["confirm_password"]) {
    header("location:addAdminPage.php?msg=passwords not match");
    exit;
} else if (Admin::check_office($_POST["officeid"])) {
    header("location:addAdmin.php?msg=Office doesn't exist");
    exit;
}
// else if (!checkPasswordStrength($_POST["password"]))
// {
//     header("location:addAdminPage.php?msg=Weak Password");
//     exit;
// }
else {
    // Enter data into database to create an admin account
    $ssn = $_POST["ssn"];
    $firstName = $_POST["fname"];
    $secondName = $_POST["lname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $officeid = $_POST["officeid"];

    // Assuming that the signup function is adjusted to accept the Admin object or its properties
    Admin::signup($ssn, $firstName, $secondName, $email, $password, $officeid);
    exit;
}
