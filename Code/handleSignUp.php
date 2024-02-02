<?php

// Function to check if a password meets certain criteria and determine its strength
function checkPasswordStrength($password) {
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
    if ($strengthPercentage >= 60) 
    {
        return true;
    } else {
        return false;
    }
}

require_once("userClass.php");

if ((empty($_POST["ssn"])) || empty($_POST["fname"]) || (empty($_POST["lname"])) || (empty($_POST["username"])) || empty($_POST["email"]) || empty($_POST["password"])  ||  empty($_POST["confirm_password"]) || (empty($_POST["gender"])) || (empty($_POST["phone"])) || (empty($_POST["address"])))
 {
    #error message displayed in route
   header("location:signupPage.php?msg=empty_field");
   exit;

 }

else if (!user::checkUsername($_POST["username"]) || !user::checkEmail($_POST["email"]) || !user::checkSSN($_POST["ssn"])) {
    #error message displayed in route
    header("location:signupPage.php?msg=User Already Exists");
    exit;
   
}
else if($_POST["password"] !=$_POST["confirm_password"])
{
    header("location:signupPage.php?msg=passwords not match");
    exit;
}
else if(!checkPasswordStrength($_POST["password"]))
{
    header("location:signupPage.php?msg=Weak Password");
    exit;
}
 else {
   
     #enetr data into database to create an account
    $ssn = $_POST["ssn"];
    $firstName = $_POST["fname"];
    $secondName = $_POST["lname"];
    $userName = $_POST["username"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $gender = $_POST["gender"];
    $password = ($_POST["password"]);
    $address = $_POST["address"];


    // require_once("userClass.php");
    user::signup($ssn, $firstName, $secondName, $userName, $email, $password, $phone, $gender, $address);
    header("location:index.php");
    exit;
}
?>