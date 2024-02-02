<?php
class Admin
{
    // Properties
    public $ssn;
    public $firstName;
    public $secondName;
    public $email;
    private $password;
    public $officeid;

    // Constructor
    public function __construct($ssn, $firstName, $secondName, $email, $password, $officeid)
    {
        $this->ssn = $ssn;
        $this->firstName = $firstName;
        $this->secondName = $secondName;
        $this->email = $email;
        $this->password = $password;
        $this->officeid = $officeid;
    }

    // Static method to check if the email already exists
    static function checkEmail($email)
    {
        // Query to check email existence
        $qry = "SELECT * FROM admin WHERE email='$email' LIMIT 1";

        // Establish connection to the database
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
            header("location: signup.php?msg=" . urlencode("admin Registration Failed: " . $e->getMessage()));
            exit();
        }

        mysqli_close($cn);
        header("location: adminAccount.php");
        exit();
    }

    // Static method to check if the SSN already exists
    static function checkSSN($ssn)
    {
        // Query to check SSN existence
        $qry = "SELECT * FROM admin WHERE ssn=$ssn LIMIT 1";

        // Establish connection to the database
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
            header("location: signup.php?msg=" . urlencode("admin Registration Failed: " . $e->getMessage()));
            exit();
        }

        mysqli_close($cn);
        header("location: adminAccount.php");
        exit();
    }

    // Static method for admin signup
    static function signup($ssn, $firstName, $secondName, $email, $password, $officeid)
    {
        // $password = md5(trim($password));
        $qry = "INSERT INTO admin (ssn, fname, lname, email, password, office_id)
                VALUES ('$ssn', '$firstName', '$secondName', '$email', '$password', '$officeid')";

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
            header("location: addAdmin.php?msg=" . urlencode("admin Registration Failed: " . $e->getMessage()));
            exit();
        }

        mysqli_close($cn);
        header("location:index.php");
        exit();
    }

    // Static method for admin login
    static function login($email, $password)
    {
        // Declare a user variable for the login
        $user = null;
        $email = htmlspecialchars(trim($email));
        $password = (trim($password));

        // Query to check admin login
        $qry = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";

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
                    $email = $result['email'];
                    $password = $result['password'];
                    $officeid = $result['office_id'];

                    $user = new Admin($ssn, $firstName, $secondName, $email, $password, $officeid);
                }
                return $user;
            }
        } catch (Exception $e) {
            header("location: index.php?msg=" . urlencode("admin Login Failed: " . $e->getMessage()));
            exit();
        }
    }

    // Added By Nour    
    static function get_office_location($officeid)
    {
        require_once("config.php");
        $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $qry = "SELECT country,city FROM office WHERE office_id = $officeid";
        $result = mysqli_query($cn, $qry);
        // Check if the query was successful
        if ($result) {
            $officeLocation = mysqli_fetch_assoc($result);
            mysqli_close($cn);
            return $officeLocation; // Return the details if found
        } else {
            mysqli_close($cn);
            return null; // Return null if car details not found
        }
    }

    static function check_office($officeid)
    {
        $qry = "SELECT * FROM office WHERE office_id = $officeid ";
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
                $office = mysqli_fetch_assoc($result);

                if ($office) {
                    return false;
                }
                return true;
            }
        } catch (Exception $e) {
            header("location: addAdmin.php?msg=" . urlencode("User Registration Failed: " . $e->getMessage()));
            exit();
        }
        mysqli_close($cn);
        exit();
    }
}
