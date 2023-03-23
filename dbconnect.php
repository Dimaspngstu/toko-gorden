<?php
// isi nama host, username mysql, dan password mysql anda
$conn = mysqli_connect("localhost", "root", "", "rapi_pesona_dekor");

if (!$conn) {
	echo "gagal konek database menn";
} else {
};
