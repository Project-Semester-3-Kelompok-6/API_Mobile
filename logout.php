<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'koneksi.php';
    $conn = mysqli_connect($hostName, $userName, $password, $dbName);

    $email = $_POST['email']; // Access data from form-data in POST request
    $apiKey = $_POST['apiKey'];

    $query_check_apiKey = "SELECT * FROM users WHERE Email = '$email' AND apiKey = '$apiKey'";
    $check_apiKey = mysqli_fetch_array(mysqli_query($conn, $query_check_apiKey));
    $response = "";

    if (isset($check_apiKey)) {
        $query_update_apiKey = "UPDATE users SET apiKey = '' WHERE Email = '$email'";
        mysqli_query($conn, $query_update_apiKey); // Remove API Key from the database

        $response = array(
            'code' => 200,
            'status' => 'Logout berhasil',
        );
    } else {
        $response = array(
            'code' => 401,
            'status' => 'Unauthorized, apiKey tidak valid!',
        );
    }

    header('Content-Type: application/json'); // Set response content type
    echo json_encode($response); // Output JSON response
    mysqli_close($conn);
}
?>
