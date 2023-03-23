<?php
session_start();
include '../dbconnect.php';

mysqli_query($conn, "UPDATE `pembayaran` SET `metode` = '" . $_POST['metode'] . "', `norek` = '" . $_POST['norek'] . "', `an` = '" . $_POST['an'] . "', `logo` = '" . $_POST['logo'] . "' WHERE `no` = " . $_POST['no']);

header('location: pembayaran.php');
