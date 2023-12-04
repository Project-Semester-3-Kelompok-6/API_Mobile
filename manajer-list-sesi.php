<?php
require_once 'koneksi.php';

// Pastikan request yang diterima adalah metode GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM sesi";
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
            echo json_encode(array('message' => 'Tidak ada data pekerjaan yang sedang dikerjakan.'));
        }
    } else {
        // Jika terjadi kesalahan dalam eksekusi query
        echo json_encode(array('message' => 'Gagal menjalankan query: ' . mysqli_error($con)));
    }
} else {
    // Jika request bukan metode GET
    echo json_encode(array('message' => 'Permintaan tidak valid.'));
}
