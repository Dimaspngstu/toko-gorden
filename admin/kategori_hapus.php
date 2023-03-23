<?php
session_start();
include '../dbconnect.php';

mysqli_query($conn, "DELETE FROM `kategori` WHERE `idkategori` = " . $_POST['idkategori']);
echo mysqli_error($conn);
header('location: kategori.php');
