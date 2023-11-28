<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'koneksi.php';
    $conn = mysqli_connect($hostName, $userName, $password, $dbName);

    $email = $_POST['Email'];  // Access data from form-data in POST request
    $password = $_POST['Password'];

    $query_check = "select * from users where Email = '$email'";
    $check = mysqli_fetch_array(mysqli_query($conn, $query_check));
    $json_array = array();
    $response = "";

    if (isset($check)) {
        $query_check_pass = "select * from users where Email = '$email' and Password = '$password'";
        $query_pass_result = mysqli_query($conn, $query_check_pass);
        $check_password = mysqli_fetch_array($query_pass_result);
        if (isset($check_password)) {
            $apiKey = bin2hex(random_bytes(23)); // Generate API Key
            $query_update_apiKey = "UPDATE users SET apiKey = '$apiKey' WHERE Email = '$email'";
            mysqli_query($conn, $query_update_apiKey); // Set API Key in the database

            $query_pass_result = mysqli_query($conn, $query_check_pass);
            while ($row = mysqli_fetch_assoc($query_pass_result)) {
                $json_array[] = $row;
            }
            $response = array(
                'code' => 200,
                'status' => 'Sukses',
                'data' => $json_array
            );
        } else {
            $response = array(
                'code' => 401,
                'status' => 'Password salah, periksa kembali!',
                'data' => $json_array
            );
        }
    } else {
        $response = array(
            'code' => 404,
            'status' => 'Data tidak ditemukan',
            'data' => $json_array
        );
    }
    header('Content-Type: application/json');  // Set response content type
    echo json_encode($response);  // Output JSON response
    mysqli_close($conn);
}
?>
