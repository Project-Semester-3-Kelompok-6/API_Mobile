<?php

include "koneksi.php";

$email = $_GET['email'];
$password = $_GET['password'];

$cek = "SELECT * FROM wm_hanaasri WHERE email = '$email' AND password = '$password'";
$msql = mysqli_query($koneksi, $cek);
$result = mysqli_num_rows($msql);

if(!empty($email) && !empty($password)){
    
    if($result == 0){
        echo "0";
    }else{
        echo "Selamat Datang";
    }
}else{
    echo "Ada Data Yang Masih Kosong";
}