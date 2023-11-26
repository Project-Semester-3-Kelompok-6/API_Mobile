<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'koneksi.php'; // Koneksi ke database
    $conn = mysqli_connect($hostName, $userName, $password, $dbName);

    $email = $_POST['Email'];
    $password = $_POST['Password'];

    $query_check = "SELECT * FROM users WHERE Email = ?";
    $stmt = mysqli_prepare($conn, $query_check);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        $storedPassword = $user['Password'];

        // Verifikasi kata sandi
        if ($password === $storedPassword) {
            $response = array(
                'code' => 200,
                'status' => 'Sukses',
                'token' => $user['token'], // Ganti dengan nama kolom token Anda
                'data' => array()
            );
        } else {
            $response = array(
                'code' => 401,
                'status' => 'Password salah, periksa kembali!',
                'data' => array()
            );
        }
    } else {
        $response = array(
            'code' => 404,
            'status' => 'Data tidak ditemukan, lanjutkan registrasi?',
            'data' => array()
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
    mysqli_close($conn);
}
?>
