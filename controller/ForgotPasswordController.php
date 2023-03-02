<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    // Database connection
    include('./config/db.php');

    // Swiftmailer lib
    require_once './lib/vendor/autoload.php';

    global $passwordLink, $errorToSendLink, $emailNotFound;
    // GET the token = ?token
    if(isset($_POST["forgot"])) {
        $email = $_POST["email"];
        $sqlQuery = mysqli_query($connection, "SELECT * FROM users WHERE email = '$email' ");
        $countRow = mysqli_num_rows($sqlQuery);

        if($countRow == 1){
            while($rowData = mysqli_fetch_array($sqlQuery)){
                $token = md5(rand().time());
                $update = mysqli_query($connection, "UPDATE users SET token = '$token' WHERE email = '$email' ");
                if($update){
                    $msg = 'Click on the reset Your password. <br><br> a href="http://'.$_SERVER['HTTP_HOST'].'/practicaletech/resetpassword.php?token='.$token.'"> Reset Password</a>';

                //    //Create the Transport
                //     $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
                //     ->setUsername('your_email@gmail.com')
                //     ->setPassword('your_email_password');

                //     // Create the Mailer using your created Transport
                //     $mailer = new Swift_Mailer($transport);

                //     // Create a message
                //     $message = (new Swift_Message('Please Verify Email Address!'))
                //     ->setFrom([$email => $firstname . ' ' . $lastname])
                //     ->setTo($email)
                //     ->addPart($msg, "text/html")
                //     ->setBody('Hello! User');

                //     //Send the message
                //     $result = $mailer->send($message);
                    $result = true;   
                    if(!$result){
                        $passwordLink = '<div class="alert alert-success">
                            Error to send email link!
                        </div>';
                    } else {
                        $errorToSendLink = '<div class="alert alert-success">
                            Reset password link send sucessfuly!
                        </div>';
                    }
                }  else {
                        $emailNotFound = '<div class="alert alert-danger">
                                Something went worng.. Try after some time
                            </div>
                        ';
                      }
            }
        } else {
            $emailNotFound = '<div class="alert alert-danger">
                    Email Note found !
                </div>
            ';
        }
    }

    

?>