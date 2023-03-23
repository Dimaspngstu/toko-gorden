<?php
session_start();
include '../dbconnect.php';
mysqli_query($conn, "DELETE FROM `produk` WHERE `idproduk` = " . $_POST['idproduk']);
echo "<br><meta http-equiv='refresh' content='5; URL=produk.php'> You will be redirected to the form in 5 seconds";
