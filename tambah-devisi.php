<?php
require_once 'koneksi.php';

// Periksa Koneksi
if ($con->connect_error) {
    die("Koneksi Gagal: " . $con->connect_error);
}

// Query untuk mengambil NamaDevisi dari tabel devisi dan Nama dari tabel users berdasarkan DevisiID
$sql = "SELECT d.NamaDevisi, u.Nama
        FROM devisi d
        INNER JOIN users u ON d.DevisiID = u.DevisiID";

$result = $con->query($sql);

if ($result->num_rows > 0) {
    // Jika ada data, simpan dalam array
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Set header untuk JSON
    header('Content-Type: application/json');

    // Tampilkan data dalam format JSON
    echo json_encode($data);
} else {
    // Jika tidak ada data
    echo "Tidak ada data devisi atau karyawan.";
}
