<?php
session_start();
include '../dbconnect.php';

if (isset($_POST['addcategory'])) {
  $namakategori = $_POST['namakategori'];

  $tambahkat = mysqli_query($conn, "insert into kategori (namakategori) values ('$namakategori')");
  if ($tambahkat) {
    echo "
		<meta http-equiv='refresh' content='1; url= kategori.php'/>  ";
  } else {
    echo "
		 <meta http-equiv='refresh' content='1; url= kategori.php'/> ";
  }
};
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/png" href="../favicon.png">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Kelola Kategori - Tokopekita</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/themify-icons.css">
  <link rel="stylesheet" href="assets/css/metisMenu.css">
  <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/css/slicknav.min.css">

  <!-- amchart css -->
  <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
  <!-- Start datatable css -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">

  <!-- others css -->
  <link rel="stylesheet" href="assets/css/typography.css">
  <link rel="stylesheet" href="assets/css/default-css.css">
  <link rel="stylesheet" href="assets/css/styles.css">
  <link rel="stylesheet" href="assets/css/responsive.css">
  <!-- modernizr css -->
  <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
  <!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->
  <!-- preloader area start -->
  <div id="preloader">
    <div class="loader"></div>
  </div>
  <!-- preloader area end -->
  <!-- page container area start -->
  <div class="page-container">
    <!-- sidebar menu area start -->
    <div class="sidebar-menu">
      <div class="main-menu">
        <div class="menu-inner">
          <nav>
            <ul class="metismenu" id="menu">
              <li><a href="index.php"><span>Home</span></a></li>
              <li><a href="../"><span>Kembali ke Toko</span></a></li>
              <li>
                <a href="manageorder.php"><i class="ti-dashboard"></i><span>Kelola Pesanan</span></a>
              </li>
              <li class="active">
                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout"></i><span>Kelola Toko
                  </span></a>
                <ul class="collapse">
                  <li class="active"><a href="kategori.php">Kategori</a></li>
                  <li><a href="produk.php">Produk</a></li>
                  <li><a href="pembayaran.php">Metode Pembayaran</a></li>
                </ul>
              </li>
              <li><a href="customer.php"><span>Kelola Pelanggan</span></a></li>
              <li><a href="user.php"><span>Kelola Staff</span></a></li>
              <li>
                <a href="../logout.php"><span>Logout</span></a>

              </li>

            </ul>
          </nav>
        </div>
      </div>
    </div>
    <!-- sidebar menu area end -->
    <!-- main content area start -->
    <div class="main-content">
      <!-- header area start -->
      <div class="header-area">
        <div class="row align-items-center">
          <!-- nav and search button -->
          <div class="col-md-6 col-sm-8 clearfix">
            <div class="nav-btn pull-left">
              <span></span>
              <span></span>
              <span></span>
            </div>
          </div>
          <!-- profile info & task notification -->
          <div class="col-md-6 col-sm-4 clearfix">
            <ul class="notification-area pull-right">
              <li>
                <h3>
                  <div class="date">
                    <script type='text/javascript'>
                      var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                      var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                      var date = new Date();
                      var day = date.getDate();
                      var month = date.getMonth();
                      var thisDay = date.getDay(),
                        thisDay = myDays[thisDay];
                      var yy = date.getYear();
                      var year = (yy < 1000) ? yy + 1900 : yy;
                      document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
                      //-->
                    </script></b>
                  </div>
                </h3>

              </li>
            </ul>
          </div>
        </div>
      </div>


      <!-- page title area end -->
      <div class="main-content-inner">

        <!-- market value area start -->
        <div class="row mt-5 mb-5">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div class="d-sm-flex justify-content-between align-items-center">
                  <h2>Daftar Kategori</h2>
                  <button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2">Tambah Kategori</button>
                </div>
                <div class="data-tables datatable-dark">
                  <table id="dataTable3" class="display" style="width:100%">
                    <thead class="thead-dark">
                      <tr>
                        <th>No.</th>
                        <th>Nama Kategori</th>
                        <th>Jumlah Produk</th>
                        <th>Tanggal Dibuat</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $brgs = mysqli_query($conn, "SELECT * from kategori order by idkategori ASC");
                      $no = 1;
                      while ($p = mysqli_fetch_array($brgs)) {
                        $id = $p['idkategori'];

                      ?>

                        <tr>
                          <td><?php echo $no++ ?></td>
                          <td><?php echo $p['namakategori'] ?></td>
                          <td><?php

                              $result1 = mysqli_query($conn, "SELECT Count(idproduk) AS count FROM produk p, kategori k where p.idkategori=k.idkategori and k.idkategori='$id' order by idproduk ASC");
                              $cekrow = mysqli_num_rows($result1);
                              $row1 = mysqli_fetch_assoc($result1);
                              $count = $row1['count'];
                              if ($cekrow > 0) {
                                echo number_format($count);
                              } else {
                                echo 'No data';
                              }
                              ?></td>
                          <td><?php echo $p['tgldibuat'] ?></td>
                          <td nowrap>
                            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal_edit<?= $id; ?>">Edit</button>
                            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal_hapus<?= $id; ?>">Hapus</button>
                          </td>

                        </tr>

                        <div id="modal_edit<?= $id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="my-modal-title">Edit</h5>
                                <button class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <form action="kategori_edit.php" method="post">
                                <div class="modal-body">
                                  <input type="hidden" name="idkategori" value="<?= $id; ?>">
                                  <input type="text" name="namakategori" value="<?= $p['namakategori']; ?>" class="form-control" required>
                                </div>
                                <div class="modal-footer">
                                  <input type="submit" class="btn btn-pimary" value="Perbarui">
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>

                        <div id="modal_hapus<?= $id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="my-modal-title">Hapus</h5>
                                <button class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <b>Apa Anda yakin ingin menghapus Kategori ini?</b>
                              </div>
                              <div class="modal-footer">
                                <form action="kategori_hapus.php" method="post">
                                  <input type="hidden" name="idkategori" value="<?= $id; ?>">
                                  <input type="submit" class="btn btn-pimary" value="Hapus">
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>

                      <?php
                      }

                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- modal input -->
      <div id="myModal" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Kategori</h4>
            </div>
            <div class="modal-body">
              <form method="post">
                <div class="form-group">
                  <label>Nama Kategori</label>
                  <input name="namakategori" type="text" class="form-control" required autofocus>
                </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              <input name="addcategory" type="submit" class="btn btn-primary" value="Tambah">
            </div>
            </form>
          </div>
        </div>
      </div>

      <script>
        $(document).ready(function() {
          $('#dataTable3').DataTable({
            dom: 'Bfrtip',
            buttons: [
              'print'
            ]
          });
        });
      </script>

      <!-- jquery latest version -->
      <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
      <!-- bootstrap 4 js -->
      <script src="assets/js/popper.min.js"></script>
      <script src="assets/js/bootstrap.min.js"></script>
      <script src="assets/js/owl.carousel.min.js"></script>
      <script src="assets/js/metisMenu.min.js"></script>
      <script src="assets/js/jquery.slimscroll.min.js"></script>
      <script src="assets/js/jquery.slicknav.min.js"></script>
      <!-- Start datatable js -->
      <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
      <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
      <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
      <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
      <!-- start chart js -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
      <!-- start highcharts js -->
      <script src="https://code.highcharts.com/highcharts.js"></script>
      <!-- start zingchart js -->
      <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
      <script>
        zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
        ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
      </script>
      <!-- all line chart activation -->
      <script src="assets/js/line-chart.js"></script>
      <!-- all pie chart -->
      <script src="assets/js/pie-chart.js"></script>
      <!-- others plugins -->
      <script src="assets/js/plugins.js"></script>
      <script src="assets/js/scripts.js"></script>

</body>

</html>