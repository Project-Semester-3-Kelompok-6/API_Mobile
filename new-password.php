<?php

if (!empty($_POST['email']) && !empty($_POST['otp']) && !empty($_POST['new-password'])) {
    $email = $_POST['email'];
    $otp = $_POST['otp'];
    $new_password = password_hash($_POST['new-password'], PASSWORD_DEFAULT);
    $con = mysqli_connect("localhost", "root", "", "login_register");
    if ($con) {
        $sql = "UPDATE users SET password = '" . $new_password . "', reset_password_otp = '', reset_password_created_at = NULL WHERE email = '"
            . $email . "' AND reset_password_otp = '" . $otp . "'";
        if (mysqli_query($con, $sql)) {
            if (mysqli_affected_rows($con)) {
                echo "success";
            } else {
                echo "Reset Password Failed";
            }
        } else {
            echo "Reset Password Failed";
        }
    } else {
        echo "Database connection failed";
    }
} else {
    echo "All fields are required";
}
?>