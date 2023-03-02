<?php
   
   ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    // Database connection
    include('config/db.php');

    global $wrongPwdErr, $accountNotExistErr, $emailPwdErr, $verificationRequiredErr;

    if(isset($_POST['login'])) {
        $email        = $_POST['email'];
        $password     = $_POST['password'];
        
        // clean data 
        $user_email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $pswd = mysqli_real_escape_string($connection, $password);

        // Query if email exists in db
        $sql = "SELECT * From users WHERE email = '{$email}' ";
        $query = mysqli_query($connection, $sql);
        $rowCount = mysqli_num_rows($query);

        // If query fails, show the reason 
        if(!$query){
           die("SQL query failed: " . mysqli_error($connection));
        }

        if(!empty($email) && !empty($password)){
            
            // Check if email exist
            if($rowCount <= 0) {
                $accountNotExistErr = '<div class="alert alert-danger">
                        User account does not exist.
                    </div>';
            } else {
                // Fetch user data and store in php session
                while($row = mysqli_fetch_array($query)) {
                    $id            = $row['id'];
                    $firstname     = $row['first_name'];
                    $lastname      = $row['last_name'];
                    $email         = $row['email'];
                    $phone         = $row['phone'];
                    $pass_word     = $row['password'];
                    $token         = $row['token'];
                }

                
                $password_old = password_verify($password, $pass_word);
                if($email == $email && $password == $password_old) {
                        
                       header("Location: ./event/list.php");
                       
                       $_SESSION['id'] = $id;
                       $_SESSION['firstname'] = $firstname;
                       $_SESSION['lastname'] = $lastname;
                       $_SESSION['email'] = $email;
                       $_SESSION['username'] = $username;
                       $_SESSION['token'] = $token;

                    } else {
                        $emailPwdErr = '<div class="alert alert-danger">
                                Either email or password is incorrect.
                            </div>';
                }

            }

        }

    }

?>    