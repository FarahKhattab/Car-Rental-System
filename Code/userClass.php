<?php

class user
{
    public $ssn;
    public $firstName;
    public $secondName;
    public $userName;
    public $email;
    private $password;
    public $phone;
    public $gender;
    public $address;




    public function __construct($ssn, $firstName, $secondName, $userName, $email, $password, $phone, $gender, $address)
    {
        $this->ssn = $ssn;
        $this->firstName = $firstName;
        $this->secondName = $secondName;
        $this->userName = $userName;
        $this->email = $email;
        $this->password = $password;
        $this->phone = $phone;
        $this->gender = $gender;
        $this->address = $address;
    }

    static function checkEmail($email)
    {
        $qry = "SELECT * FROM user WHERE email='$email' LIMIT 1";

        require_once("config.php");
        $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        if (!$cn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        try {
            $result = mysqli_query($cn, $qry);

            if (!$result) {
                throw new Exception(mysqli_error($cn));
            } else {
                $user = mysqli_fetch_assoc($result);

                if ($user) {
                    return false;
                }
                return true;
            }
        } catch (Exception $e) {
            header("location: signup.php?msg=" . urlencode("User Registration Failed: " . $e->getMessage()));
            exit();
        }
        mysqli_close($cn);
        header("location: userAccount.php");
        exit();
    }

    static function checkUsername($username)
    {
        $qry = "SELECT * FROM user WHERE userName='$username' LIMIT 1";

        require_once("config.php");
        $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        if (!$cn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        try {
            $result = mysqli_query($cn, $qry);

            if (!$result) {
                throw new Exception(mysqli_error($cn));
            } else {
                $user = mysqli_fetch_assoc($result);

                if ($user) {
                    return false;
                }
                return true;
            }
        } catch (Exception $e) {
            header("location: signup.php?msg=" . urlencode("User Registration Failed: " . $e->getMessage()));
            exit();
        }
        mysqli_close($cn);
        header("location: userAccount.php");
        exit();
    }

    static function checkSSN($ssn)
    {
        $qry = "SELECT * FROM user WHERE ssn=$ssn LIMIT 1";
        require_once("config.php");
        $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        if (!$cn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        try {
            $result = mysqli_query($cn, $qry);

            if (!$result) {
                throw new Exception(mysqli_error($cn));
            } else {
                $user = mysqli_fetch_assoc($result);

                if ($user) {
                    return false;
                }
                return true;
            }
        } catch (Exception $e) {
            header("location: signup.php?msg=" . urlencode("User Registration Failed: " . $e->getMessage()));
            exit();
        }
        mysqli_close($cn);
        header("location: userAccount.php");
        exit();
    }


    static function signup($ssn, $firstName, $secondName, $userName, $email, $password, $phone, $gender, $address)
    {
        $password = md5(trim($password));
        $qry = "INSERT INTO user (ssn, fname, lname, userName, email, password, gender, phone_no, address)
            VALUES ('$ssn', '$firstName', '$secondName', '$userName', '$email', '$password', '$gender', '$phone', '$address')";

        require_once("config.php");

        $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        if (!$cn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        try {
            $result = mysqli_query($cn, $qry);

            if (!$result) {
                throw new Exception(mysqli_error($cn));
            }
        } catch (Exception $e) {
            header("location: signup.php?msg=" . urlencode("User Registration Failed: " . $e->getMessage()));
            exit();
        }

        mysqli_close($cn);
        header("location:index.php");
        exit();
    }


    static function login($email, $password)
    {

        #declare a user variable which is that person logging in right now
        $user = null;
        $email = htmlspecialchars(trim($email));

        $password = md5(trim($password));
        //$qry="select * from users email='$email' AND password='$password' ";

        $qry = "SELECT * FROM user WHERE email = '$email' And password = '$password' ";

        require_once("config.php");

        $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        try {
            $result = mysqli_query($cn, $qry);


            if (!$result) {
                throw new Exception(mysqli_error($cn));
            } else {
                if ($result = mysqli_fetch_assoc($result)) {

                    $ssn = $result['ssn'];
                    $firstName = $result['fname'];
                    $secondName = $result['lname'];
                    $userName = $result['username'];
                    $email = $result['email'];
                    $password = $result['password'];
                    $gender = $result['gender'];
                    $phone = $result['phone_no'];
                    $address = $result['address'];

                    $user = new user($ssn, $firstName, $secondName, $userName, $email, $password, $phone, $gender, $address);
                }
                return $user;
            }
        } catch (Exception $e) {
            header("location: index.php?msg=" . urlencode("User Login Failed: " . $e->getMessage()));
            exit();
        }
    }
}
