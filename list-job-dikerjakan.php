<?php
require_once 'koneksi.php';

// Pastikan request yang diterima adalah metode POST dan terdapat data 'KaryawanID'
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['KaryawanID'])) {
    // Sanitasi input 'KaryawanID' untuk mencegah SQL injection
    $karyawanID = mysqli_real_escape_string($con, $_POST['KaryawanID']);

    $sql = "SELECT * FROM job WHERE Status = 'Task' AND KaryawanID = '$karyawanID'";
    $result = $con->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            // Jika ada data, simpan dalam array
            $jobdikerjakan = array();
            while ($row = $result->fetch_assoc()) {
                $jobdikerjakan[] = $row;
            }

            // Set header untuk JSON
            header('Content-Type: application/json');

            // Tampilkan data dalam format JSON
            echo json_encode($jobdikerjakan);
        } else {
            // Jika tidak ada data
            echo json_encode(array('message' => 'Tidak ada data pekerjaan yang sedang dikerjakan untuk KaryawanID ini.'));
        }
    } else {
        // Jika terjadi kesalahan dalam eksekusi query
        echo json_encode(array('message' => 'Gagal menjalankan query: ' . mysqli_error($con)));
    }
} else {
    // Jika request bukan metode POST atau tidak terdapat data 'KaryawanID'
    echo json_encode(array('message' => 'Permintaan tidak valid atau KaryawanID tidak diberikan.'));
}
