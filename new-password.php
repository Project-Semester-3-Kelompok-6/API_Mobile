<?php

if (!empty($_POST['email']) && !empty($_POST['otp']) && !empty($_POST['new-password'])) {
    $email = $_POST['email'];
    $otp = $_POST['otp'];
    $new_password = $_POST['new-password']; // Password baru tanpa hashing
    $con = mysqli_connect("localhost", "root", "", "wm_hanaasri");
    if ($con) {
        $sql = "UPDATE users SET Password = '" . $new_password . "', reset_password_otp = '', reset_password_created_at = NULL WHERE Email = '"
            . $email . "' AND reset_password_otp = '" . $otp . "'";
        if (mysqli_query($con, $sql)) {
            if (mysqli_affected_rows($con)) {
                echo "success";
            } else {
                echo "Kode OTP Salah";
            }
        } else {
            echo "Kode OTP Salah";
        }
    } else {
        echo "Database connection failed";
    }
} else {
    echo "All fields are required";
}
?>
