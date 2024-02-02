<?php
require_once("userClass.php");
session_start();


if (   (!empty($_POST["email"])) && (!empty($_POST["password"])) ) 
{
    $email=$_POST["email"];
    $password=$_POST["password"];
    $user=user::login($email,$password);
    if (!$user){
        header("location:index.php?msg=Invalid Email or Password");
    }
    else  //user exists
    {
        $_SESSION["user"]=serialize($user);

        if (isset($_SESSION["user"]) ) 
        {
            header("location:index.php?msg=hii");
        }
    
        header("location:userAccount.php");   
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