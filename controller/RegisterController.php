<?php

   
   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   error_reporting(E_ALL);
    // Database connection
    include('config/db.php');

    // Swiftmailer lib
    require_once './lib/vendor/autoload.php';
    
    // Error & success messages
    global $successMsg, $emailExist;
    global $emailVerifyErr, $emailVerifySuccess;
    
    // Set empty form vars for validation mapping
    $_first_name = $_last_name = $_email = $_phone = $_password = "";
    if(isset($_POST["register"])) {
        // print_r($_REQUEST);die;
        $firstname     = $_POST["firstname"];
        $lastname      = $_POST["lastname"];
        $email         = $_POST["email"];
        $phone  = $_POST["phone"];
        $password      = $_POST["password"];

        // Verify if form values are not empty
        if(!empty($firstname) && !empty($lastname) && !empty($email) && !empty($username) && !empty($password)){
            
            // check if user email already exist
            $emailCheckQuery = mysqli_query($connection, "SELECT * FROM users WHERE email = '{$email}' OR phone = '{$phone}' ");
            
            $rowCount = mysqli_num_rows($emailCheckQuery);

            if($rowCount) {
                $emailExist = '
                    <div class="alert alert-danger" role="alert">
                        Phone or email already exist!
                    </div>
                ';
            } else {
                // clean the form data before sending to database
                $_first_name = mysqli_real_escape_string($connection, $firstname);
                $_last_name = mysqli_real_escape_string($connection, $lastname);
                $_email = mysqli_real_escape_string($connection, $email);
                
                $_phone = mysqli_real_escape_string($connection, $phone);
                $_password = mysqli_real_escape_string($connection, $password);

                // Generate random activation token
                // $token = md5(rand().time());

                // Password hash
                $password_hash = password_hash($password, PASSWORD_BCRYPT);

                // Query
                $sql = "INSERT INTO users (first_name, last_name, email, phone, password) VALUES ('{$firstname}', '{$lastname}', '{$email}', '{$phone}', '{$password_hash}')";

                // Create mysql query
                $sqlQuery = mysqli_query($connection, $sql);
                
                if(!$sqlQuery){
                    die("MySQL query failed!" . mysqli_error($connection));
                } 

                    // Send verification email
                if($sqlQuery) {
                    $successMsg = '<div class="alert alert-success">
                        User register Sucessfully
                    </div>';
                     
                }
            }
        }
    }
?>