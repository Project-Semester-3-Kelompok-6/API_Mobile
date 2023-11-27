<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "vendor/autoload.php";

if(!empty($_POST['email'])){
    $email = $_POST['email'];
    $con = mysqli_connect("localhost", "root", "", "wm_hanaasri");
    if($con){
        try{
        $otp = random_int(100000, 999999);
            
        }catch(Exception $e){
        $otp = rand(100000, 999999);
        }
        $sql = "update users set reset_password_otp = '".$otp."', reset_password_created_at = '"
        .date('Y-m-d H:i:s')."' where email = '".$email."'";
        if(mysqli_query($con, $sql)){
            if(mysqli_affected_rows($con)){
                $mail = new PHPMailer(true);

                try {
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'muhyi7x@gmail.com';                     //SMTP username
                    $mail->Password   = 'xvsc gvix vcqx devh';                               //SMTP password
                    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
                    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                
                    //Recipients
                    $mail->setFrom('WMHanaasri@email.com', 'WMHanaasri');
                    $mail->addAddress($email);     //Add a recipient
                    $mail->addReplyTo('info@example.com', 'Information');
                
                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Reset Password';
                    $mail->Body    = 'Your OTP to reset password is [ ' . $otp . ' ]';
                    $mail->AltBody = 'Reset Password to access application';
                
                    if($mail->send())
                        echo 'success';
                    else
                        echo 'Failed to send OTP through mail';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
            else echo "Reset Password Failed";
        }
        else echo "Reset Password Failed";
    }else echo "Database connection failed";
}else echo "All fields are required";
?>