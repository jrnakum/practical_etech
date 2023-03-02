<?php

   
   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   error_reporting(E_ALL);
    // Database connection
    include('config/db.php');

    // Error & success messages
    global $successMsg, $emailExist;
    global $emailVerifyErr, $emailVerifySuccess;
    
    // Set empty form vars for validation mapping
    $_password = "";
     // GET the token = ?token
     if(!empty($_GET['token'])){
        $token = $_GET['token'];
     } else {
         $token = "";
     }
     $user_id = "";

     if($token != "") {
        $sqlQuery = mysqli_query($connection, "SELECT * FROM users WHERE token = '$token' ");
        $countRow = mysqli_num_rows($sqlQuery);

        if($countRow == 1){
            while($rowData = mysqli_fetch_array($sqlQuery)){
                $user_id = $rowData['id'];
            }
        } else {
            $activationError = '<div class="alert alert-danger">
                    User token expired
                </div>
            ';
        }
    }

    if(isset($_POST["resetpassword"])) {
        $password  = $_POST["password"];
        $id  = $_POST["userid"];

        if(!empty($password)){
            
                // clean the form data before sending to database
                $_password = mysqli_real_escape_string($connection, $password);

                // Generate random activation token
                // Password hash
                $password_hash = password_hash($password, PASSWORD_BCRYPT);

                // Query
                $sqlQuery = mysqli_query($connection, "UPDATE users SET password = '$password_hash' WHERE id = '$id' ");
                
                if(!$sqlQuery){
                    die("MySQL query failed!" . mysqli_error($connection));
                } 
                mysqli_query($connection, "UPDATE users SET token = ''");
                    // Send verification email
                if($sqlQuery) {
                    $successMsg = '<div class="alert alert-success">
                        Password sucessfully changed.
                    </div>';
                    header("Location: ../practicaletech/login.php");

                }
            }
        }
?>