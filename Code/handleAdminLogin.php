<?php
require_once("adminClass.php");
session_start();


if (   (!empty($_POST["email"])) && (!empty($_POST["password"])) ) 
{
    $email=$_POST["email"];
    $password=$_POST["password"];
    $admin=admin::login($email,$password);
    if (!$admin){
        header("location:index.php?msg=Invalid Email or Password");
    }
    else  //user exists
    {
        $_SESSION["admin"]=serialize($admin);

        if (isset($_SESSION["admin"]) ) 
        {
            header("location:index.php?msg=hii");
        }
    
        header("location:adminAccount.php");   
        exit(); 
    }
    
}
else{
    #error message displayed in route
   header("location:index.php?msg=empty_field");
   //exit();
}

?>

#cn-> connects DB
#result-> has user we need


# we now need to fetch for user in the database
# associative because we want both key and value