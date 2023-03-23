<?php

session_start();
date_default_timezone_set('Asia/Jakarta');
include 'dbconnect.php';

$id_user = $_SESSION['id'];
$pesan = $_POST['pesan'];
$waktu = time();

mysqli_query($conn, "INSERT INTO `chat` SET `id_user` = $id_user, `is_user` = 1, `pesan` = '$pesan', `waktu` = $waktu");

$hello = ['hi', 'hai', 'halo', 'helo', 'hallo', 'hello', 'hi!', 'hai!', 'halo!', 'helo!', 'hallo!', 'hello!'];
if (in_array($string = trim(preg_replace('/\s+/', '', str_replace('<br />', '', $pesan))), $hello)) {
  $balasan = 'Halo ' . $_SESSION['name'] . '! Ada yang bisa saya bantu?';
  mysqli_query($conn, "INSERT INTO `chat` SET `id_user` = $id_user, `is_user` = 0, `pesan` = '$balasan', `waktu` = $waktu");
  echo '<li class="out"><div class="chat-body"><div class="chat-message"><h5>Bot</h5><p>' . $balasan . '</p></div></div></li>';
} else {
  $loop_kategori = mysqli_query($conn, "SELECT * FROM `kategori`");
  $loop_produk = mysqli_query($conn, "SELECT * FROM `produk`");
  $ada = false;
  while ($k = mysqli_fetch_assoc($loop_kategori)) {
    if (strpos(strtolower($pesan), strtolower($k['namakategori'])) !== false) {
      $ada = true;
      $balasan = 'Apakah Anda sedang mencari <b>' . $k['namakategori'] . '</b>?<br />Silakan klik tautan di bawah ini untuk membuka kategori ' . $k['namakategori'] . '.<br /><br /><h4><a class="link_bot" href="kategori.php?idkategori=' . $k['idkategori'] . '">' . $k['namakategori'] . '</a></h4>';
      mysqli_query($conn, "INSERT INTO `chat` SET `id_user` = $id_user, `is_user` = 0, `pesan` = '$balasan', `waktu` = $waktu");
      echo '<li class="out"><div class="chat-body"><div class="chat-message"><h5>Bot</h5><p>' . $balasan . '</p></div></div></li>';
    }
  }
  while ($p = mysqli_fetch_assoc($loop_produk)) {
    if (strpos(strtolower($pesan), strtolower($p['namaproduk'])) !== false) {
      $ada = true;
      $balasan = 'Apakah Anda sedang mencari <b>' . $p['namaproduk'] . '</b>?<br />Silakan klik tautan di bawah ini untuk membuka produk ' . $p['namaproduk'] . '.<br /><br /><div class="row"><div class="col-sm-2"><a class="link_bot" href="product.php?idproduk=' . $p['idproduk'] . '"><img src="' . $p['gambar'] . '" class="gambar_bot" /></a></div><div class="col-sm-10"><h4><a class="link_bot" href="product.php?idproduk=' . $p['idproduk'] . '">' . $p['namaproduk'] . '</a></h4><h4>Rp' . number_format($p['hargaafter']) . ' <s>Rp' . number_format($p['hargabefore']) . '</s></h4></div></div>';
      // $balasan = 'Apakah Anda sedang mencari <b>' . $p['namaproduk'] . '</b>?<br />Silakan klik tautan di bawah ini untuk membuka produk ' . $p['namaproduk'] . '.<br /><br /><div class="col-satu"><a class="link_bot" href="product.php?idproduk=' . $p['idproduk'] . '"><img src="' . $p['gambar'] . '" class="gambar_bot" /></a></div><div class="col-dua"><h4><a class="link_bot" href="product.php?idproduk=' . $p['idproduk'] . '">' . $p['namaproduk'] . '</a></h4><h4>Rp' . number_format($p['hargaafter']) . ' <s>Rp' . number_format($p['hargabefore']) . '</s></h4></div>';
      mysqli_query($conn, "INSERT INTO `chat` SET `id_user` = $id_user, `is_user` = 0, `pesan` = '$balasan', `waktu` = $waktu");
      echo '<li class="out"><div class="chat-body"><div class="chat-message"><h5>Bot</h5><p>' . $balasan . '</p></div></div></li>';
    }
  }
  if (!$ada) {
    $balasan = 'Saya tidak paham maksud Anda!';
    mysqli_query($conn, "INSERT INTO `chat` SET `id_user` = $id_user, `is_user` = 0, `pesan` = '$balasan', `waktu` = $waktu");
    echo '<li class="out"><div class="chat-body"><div class="chat-message"><h5>Bot</h5><p>' . $balasan . '</p></div></div></li>';
  }
}
