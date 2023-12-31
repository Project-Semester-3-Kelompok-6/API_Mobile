<?php
require_once 'koneksi.php';

if ($con) {
    if (!empty($_POST['JobID'])) {
        $JobID = $_POST['JobID'];

        // Periksa apakah data gambar diterima
        if (isset($_POST['image']) && !empty($_POST['image'])) {
            $path = 'task/' . date("d-m-y") . '-' . time() . '-' . rand(10000, 10000) . '.jpg';
            if (file_put_contents($path, base64_decode($_POST['image']))) {
                $sql = "UPDATE job SET Status = 'Done', BuktiFoto = '$path' WHERE JobID = '$JobID'";
                if (mysqli_query($con, $sql)) {
                    echo 'success';
                } else {
                    echo 'Failed to update database: ' . mysqli_error($con);
                }
            } else {
                echo 'Failed to upload image';
            }
        } else {
            // Jika data gambar tidak diterima, atur kolom BuktiFoto menjadi NULL
            $sql = "UPDATE job SET Status = 'Done', BuktiFoto = NULL WHERE JobID = '$JobID'";
            if (mysqli_query($con, $sql)) {
                echo 'success';
            } else {
                echo 'Failed to update database: ' . mysqli_error($con);
            }
        }
    } else {
        echo 'Incomplete data received';
    }
} else {
    echo "Database connection failed";
}
?>
