<?php
session_start();
include 'dbconnect.php';

if (!isset($_SESSION['log'])) {
	header('location:login.php');
} else {
};

$uid = $_SESSION['id'];
$caricart = mysqli_query($conn, "select * from cart where userid='$uid' and status='Cart'");
$fetc = mysqli_fetch_array($caricart);
$orderidd = (0 < mysqli_num_rows($caricart)) ? $fetc['orderid'] : 0;
$itungtrans = mysqli_query($conn, "select count(detailid) as jumlahtrans from detailorder where orderid='$orderidd'");
$itungtrans2 = mysqli_fetch_assoc($itungtrans);
$itungtrans3 = $itungtrans2['jumlahtrans'];

if (isset($_POST["update"])) {
	$kode = $_POST['idproduknya'];
	$jumlah = $_POST['jumlah'];
	$q1 = mysqli_query($conn, "update detailorder set qty='$jumlah' where idproduk='$kode' and orderid='$orderidd'");
	if ($q1) {
		echo "Berhasil Update Cart
		<meta http-equiv='refresh' content='1; url= cart.php'/>";
	} else {
		echo "Gagal update cart
		<meta http-equiv='refresh' content='1; url= cart.php'/>";
	}
} else if (isset($_POST["hapus"])) {
	$kode = $_POST['idproduknya'];
	$q2 = mysqli_query($conn, "delete from detailorder where idproduk='$kode' and orderid='$orderidd'");
	if ($q2) {
		echo "Berhasil Hapus";
	} else {
		echo "Gagal Hapus";
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Chat Bot</title>
	<!-- for-mobile-apps -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="RAPI PESON DEKOR" />
	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- //for-mobile-apps -->
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<!-- font-awesome icons -->
	<link href="css/font-awesome.css" rel="stylesheet">
	<!-- //font-awesome icons -->
	<!-- js -->
	<script src="js/jquery-1.11.1.min.js"></script>
	<!-- //js -->
	<link href='//fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
	<!-- start-smoth-scrolling -->
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event) {
				event.preventDefault();
				$('html,body').animate({
					scrollTop: $(this.hash).offset().top
				}, 1000);
			});
		});
	</script>
	<!-- start-smoth-scrolling -->
</head>

<body>
	<!-- header -->
	<div class="agileits_header">
		<div class="container">
			<div class="w3l_offers">
				<p>DAPATKAN PENAWARAN MENARIK KHUSUS HARI INI, <a href="index.php">BELANJA SEKARANG!</a></p>
			</div>
			<div class="agile-login">
				<ul>
					<?php
					if (!isset($_SESSION['log'])) {
						echo '
					<li><a href="registered.php"> Daftar</a></li>
					<li><a href="login.php">Masuk</a></li>
					';
					} else {

						if ($_SESSION['role'] == 'Member') {
							echo '
					<li style="color:white">Halo, ' . $_SESSION["name"] . '
					<li><a href="logout.php">Keluar?</a></li>
					';
						} else {
							echo '
					<li style="color:white">Halo, ' . $_SESSION["name"] . '
					<li><a href="admin">Admin Panel</a></li>
					<li><a href="logout.php">Keluar?</a></li>
					';
						};
					}
					?>

				</ul>
			</div>
			<div class="product_list_header">
				<a href="cart.php"><button class="w3view-cart" type="submit" name="submit" value=""><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button>
				</a>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>

	<div class="logo_products">
		<div class="container">
			<div class="w3ls_logo_products_left1">
				<ul class="phone_email">
					<h1><a href="index.php">RAPI PESONA DEKOR</a></h1>
				</ul>
			</div>
			<div class="w3ls_logo_products_left">
			</div>
			<div class="w3l_search">
				<form action="search.php" method="post">
					<input type="search" name="Search" placeholder="Cari produk...">
					<button type="submit" class="btn btn-default search" aria-label="Left Align">
						<i class="fa fa-search" aria-hidden="true"> </i>
					</button>
					<div class="clearfix"></div>
				</form>
			</div>

			<div class="clearfix"> </div>
		</div>
	</div>
	<!-- //header -->
	<!-- navigation -->
	<div class="navigation-agileits">
		<div class="container">
			<nav class="navbar navbar-default">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header nav_2">
					<button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
					<ul class="nav navbar-nav">
						<li class="active"><a href="index.php" class="act">Home</a></li>
						<!-- Mega Menu -->
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Kategori Produk<b class="caret"></b></a>
							<ul class="dropdown-menu multi-column columns-3">
								<div class="row">
									<div class="multi-gd-img">
										<ul class="multi-column-dropdown">
											<h6>Kategori</h6>

											<?php
											$kat = mysqli_query($conn, "SELECT * from kategori order by idkategori ASC");
											while ($p = mysqli_fetch_array($kat)) {

											?>
												<li><a href="kategori.php?idkategori=<?php echo $p['idkategori'] ?>"><?php echo $p['namakategori'] ?></a></li>

											<?php
											}
											?>
										</ul>
									</div>

								</div>
							</ul>
						</li>
						<li><a href="cart.php">Keranjang Saya</a></li>
						<li><a href="daftarorder.php">Daftar Order</a></li>
						<li><a href="chatbot.php">Chat Bot</a></li>
					</ul>
				</div>
			</nav>
		</div>
	</div>

	<!-- //navigation -->
	<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Chat Bot</li>
			</ol>
		</div>
	</div>
	<!-- //breadcrumbs -->
	<!-- checkout -->
	<div class="checkout">
		<div class="container">

			<link rel="stylesheet" href="bot.css">

			<div class="container content" style="width: 80%;">
				<div class="row">
					<div class="col-12">
						<div class="panel">
							<div class="panel-body">
								<ul class="chat-list" id="data_pesan">
									<?php $id_user = $_SESSION['id'];
									// $chat = mysqli_query($conn, "SELECT * FROM `chat` WHERE `id_user` = $id_user ORDER BY `waktu` ASC");
									$chat = mysqli_query($conn, "SELECT * FROM `chat` WHERE `id_user` = $id_user");
									if (1 > mysqli_num_rows($chat)) {
										echo '<h3 id="belum">Belum ada pesan!</h3>';
									} else {
										while ($c = mysqli_fetch_assoc($chat)) {
											if (1 == $c['is_user']) { ?>
												<li class="in">
													<div class="chat-body">
														<div class="chat-message">
															<h5>Anda</h5>
															<p><?= $c['pesan']; ?></p>
														</div>
													</div>
												</li>
											<?php } else { ?>
												<li class="out">
													<div class="chat-body">
														<div class="chat-message">
															<h5>Bot</h5>
															<p><?= $c['pesan']; ?></p>
														</div>
													</div>
												</li>
											<?php } ?>
										<?php } ?>
									<?php } ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- <div class="row justify-content-center" style="margin-top: 16px;">
				<div class="col-md-8 col-lg-9 col-md-offset-1">
					<textarea name="chat" id="chat" rows="1" placeholder="Ketik Pesan Anda..." class="form-control" onkeyup="cek_pesan(this.value);" onkeydown="cek_pesan(this.value);" onkeypress="cek_pesan(this.value);" onclick="cek_pesan(this.value);" onchange="cek_pesan(this.value);"></textarea>
				</div>
				<div class="col-md-2 col-lg-1">
					<button id="tombol_kirim" class="btn btn-success btn-block" onclick="kirim_pesan();">Kirim</button>
				</div>
			</div> -->

			<div class="input-group" style="margin-top: 16px; width: 80%; margin: auto;">
				<input type="text" name="chat" id="chat" class="form-control" placeholder="Ketik Pesan Anda..." onkeyup="cek_pesan(this.value);" onkeydown="cek_pesan(this.value);" onkeypress="cek_pesan(this.value);" onclick="cek_pesan(this.value);" onchange="cek_pesan(this.value);">
				<span class="input-group-btn">
					<button id="tombol_kirim" class="btn btn-success btn-block" onclick="kirim_pesan();">Kirim</button>
				</span>
			</div>

			<script>
				var tombol_kirim = $('#tombol_kirim');
				tombol_kirim.prop('disabled', true);

				function cek_pesan(isi) {
					if (isi) {
						tombol_kirim.prop('disabled', false);
					} else {
						tombol_kirim.prop('disabled', true);
					}
				}

				function kirim_pesan() {
					var belum = $('#belum');
					belum.hide();
					var pesan = $('#chat').val().replaceAll('\n', '<br />');
					var data_pesan = $('#data_pesan');
					var chat = '<li class="in"><div class="chat-body"><div class="chat-message"><h5>Anda</h5><p>' + pesan + '</p></div></div></li>';
					data_pesan.append(chat);
					$('#chat').val('');
					$.post('bot.php', {
						pesan: pesan
					}, function(data, status) {
						data_pesan.append(data);
					});
				}
			</script>

		</div>
	</div>
	</div>
	<!-- //checkout -->
	<!-- //footer -->
	<div class="footer">
		<div class="container">
			<div class="w3_footer_grids">
				<div class="col-md-4 w3_footer_grid">
					<h3>Hubungi Kami</h3>
					<ul class="address">
						<li><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>Jl. Perumahan Bukit Indah No.50, Benda Baru, Kec. Pamulang, Kota Tangerang Selatan, Banten 15416</li>
						<li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><a href="mailto:info@email">RapiPesonaDekor@gmail.com</a></li>
						<li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>+6281286515542</li>
					</ul>
				</div>
				<div class="col-md-3 w3_footer_grid">
					<h3>Tentang Kami</h3>
					<ul class="info">
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="about.html">About Us</a></li>
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="about.html">Location</a></li>
					</ul>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<div class="footer-botm">
		<div class="container">
			<div class="w3layouts-foot">
				<ul>
					<li><a href="https://www.instagram.com/rapipesonadecor/" class="w3_agile_instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
					<li><a href="https://web.facebook.com/rapipesonadekor" class="w3_agile_facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
					<li><a href="https://twitter.com/rapipesonadekor" class="agile_twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //footer -->
	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.min.js"></script>

	<!-- top-header and slider -->
	<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {

			var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 4000,
				easingType: 'linear'
			};


			$().UItoTop({
				easingType: 'easeOutQuart'
			});

		});
	</script>
	<!-- //here ends scrolling icon -->

	<!-- main slider-banner -->
	<script src="js/skdslider.min.js"></script>
	<link href="css/skdslider.css" rel="stylesheet">
	<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery('#demo1').skdslider({
				'delay': 5000,
				'animationSpeed': 2000,
				'showNextPrev': true,
				'showPlayButton': true,
				'autoSlide': true,
				'animationType': 'fading'
			});

			jQuery('#responsive').change(function() {
				$('#responsive_wrapper').width(jQuery(this).val());
			});

		});
	</script>
	<!-- //main slider-banner -->
</body>

</html>