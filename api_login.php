<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $response = [
            'code' => 200,
            'status' => 'Login success',
            'user' => $user
        ];
    } else {
        $response = [
            'code' => 401,
            'status' => 'Login failed'
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);

    $stmt->close();
}
?>
