<?php
session_start();
include '../dbconnect.php';

$idproduk = $_POST['idproduk'];
$namaproduk = $_POST['namaproduk'];
$idkategori = $_POST['idkategori'];
$deskripsi = $_POST['deskripsi'];
$rate = $_POST['rate'];
$hargabefore = $_POST['hargabefore'];
$hargaafter = $_POST['hargaafter'];

if (!empty($_FILES['uploadgambar']['name'])) {
    $nama_file = $_FILES['uploadgambar']['name'];
    $ext = pathinfo($nama_file, PATHINFO_EXTENSION);
    $random = crypt($nama_file, time());
    $ukuran_file = $_FILES['uploadgambar']['size'];
    $tipe_file = $_FILES['uploadgambar']['type'];
    $tmp_file = $_FILES['uploadgambar']['tmp_name'];
    $path = "../produk/" . $random . '.' . $ext;
    $pathdb = "produk/" . $random . '.' . $ext;
    if ($tipe_file == "image/jpeg" || $tipe_file == "image/png") {
        if ($ukuran_file <= 5000000) {
            if (move_uploaded_file($tmp_file, $path)) {
                $query = "update produk set idkategori = '$idkategori', namaproduk = '$namaproduk', gambar = '$pathdb', deskripsi = '$deskripsi', rate = '$rate', hargabefore = '$hargabefore', hargaafter = '$hargaafter' where idproduk = $idproduk";
                $sql = mysqli_query($conn, $query); // Eksekusi/ Jalankan query dari variabel $query
                if ($sql) {
                    echo "<br><meta http-equiv='refresh' content='5; URL=produk.php'> You will be redirected to the form in 5 seconds";
                } else {
                    // Jika Gagal, Lakukan :
                    echo "Sorry, there's a problem while submitting.";
                    echo "<br><meta http-equiv='refresh' content='5; URL=produk.php'> You will be redirected to the form in 5 seconds";
                }
            } else {
                // Jika gambar gagal diupload, Lakukan :
                echo "Sorry, there's a problem while uploading the file.";
                echo "<br><meta http-equiv='refresh' content='5; URL=produk.php'> You will be redirected to the form in 5 seconds";
            }
        } else {
            // Jika ukuran file lebih dari 1MB, lakukan :
            echo "Sorry, the file size is not allowed to more than 1mb";
            echo "<br><meta http-equiv='refresh' content='5; URL=produk.php'> You will be redirected to the form in 5 seconds";
        }
    } else {
        // Jika tipe file yang diupload bukan JPG / JPEG / PNG, lakukan :
        echo "Sorry, the image format should be JPG/PNG.";
        echo "<br><meta http-equiv='refresh' content='5; URL=produk.php'> You will be redirected to the form in 5 seconds";
    }
} else {
    $query = "update produk set idkategori = '$idkategori', namaproduk = '$namaproduk', deskripsi = '$deskripsi', rate = '$rate', hargabefore = '$hargabefore', hargaafter = '$hargaafter' where idproduk = $idproduk";
    $sql = mysqli_query($conn, $query); // Eksekusi/ Jalankan query dari variabel $query
    if ($sql) {
        echo "<br><meta http-equiv='refresh' content='5; URL=produk.php'> You will be redirected to the form in 5 seconds";
    } else {
        // Jika Gagal, Lakukan :
        echo "Sorry, there's a problem while submitting.";
        echo "<br><meta http-equiv='refresh' content='5; URL=produk.php'> You will be redirected to the form in 5 seconds";
    }
}
