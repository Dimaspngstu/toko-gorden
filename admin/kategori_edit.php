<?php
session_start();
include '../dbconnect.php';

mysqli_query($conn, "UPDATE `kategori` SET `namakategori` = '" . $_POST['namakategori'] . "' WHERE `idkategori` = " . $_POST['idkategori']);

header('location: kategori.php');
