<?php
session_start();
include '../dbconnect.php';

mysqli_query($conn, "DELETE FROM `pembayaran` WHERE `no` = " . $_POST['no']);
echo mysqli_error($conn);
header('location: pembayaran.php');
