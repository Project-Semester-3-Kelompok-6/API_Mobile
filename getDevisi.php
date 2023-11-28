<?php
require_once 'koneksi.php';

// Periksa Koneksi
if ($con->connect_error) {
    die("Koneksi Gagal: " . $con->connect_error);
}

// Query untuk mengambil semua data dari tabel "devisi"
$sql = "SELECT DevisiID, `NamaDevisi` FROM devisi";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    // Jika ada data, simpan dalam array
    $devisi = array();
    while ($row = $result->fetch_assoc()) {
        $devisi[] = $row;
    }

    // Set header untuk JSON
    header('Content-Type: application/json');

    // Tampilkan data dalam format JSON
    echo json_encode($devisi);
} else {
    // Jika tidak ada data
    echo "Tidak ada data devisi.";
}
?>
