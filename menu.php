<?php 
include 'library/inc.connection.php';
include 'library/inc.library.php';

?>
<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="assets/img/favicon.png" type="image/png">
	<title>Riolo Desert</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/linericon/style.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/magnific-popup.css">
	<link rel="stylesheet" href="assets/owl-carousel/owl.carousel.min.css">
	<link rel="stylesheet" href="assets/lightbox/simpleLightbox.css">
	<link rel="stylesheet" href="assets/nice-select/css/nice-select.css">
	<link rel="stylesheet" href="assets/jquery-ui/jquery-ui.css">
	<link rel="stylesheet" href="assets/animate-css/animate.css">
	<!-- main css -->
	<link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

	<!--================ Start Header Menu Area =================-->
	<div class="menu-trigger">
		<span></span>
		<span></span>
		<span></span>
	</div>
	<header class="fixed-menu">
		<span class="menu-close"><i class="fa fa-times"></i></span>
		<div class="menu-header">
			<div class="logo d-flex justify-content-center">
				<img src="img/logo.png" alt="">
			</div>
		</div>
		<div class="nav-wraper">
			<div class="navbar">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link active" href="index.php"><img src="assets/img/header/nav-icon1.png" alt=""> home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="menu.php"><img src="assets/img/header/nav-icon3.png" alt="">menu</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="login.php" data-toggle="modal" data-target="#exampleModal"><img src="assets/img/header/nav-icon8.png" alt="">Login</a>
					</li>
				</ul>
			</div>
		</div>
	</header>
	<!--================ End Header Menu Area =================-->

	<div class="site-main">
		<!--================ Start Home Banner Area =================-->
		<section class="home_banner_area" style="background: url(assets/img/kue/2.jpg); background-size: contain;">
			<div class="banner_inner">
				<div class="container-fluid no-padding">
					<div class="row fullscreen">

					</div>
				</div>
			</div>
		</section>
		<!-- Start banner bottom -->
		<div class="row banner-bottom align-items-center justify-content-center">
			<div class="col-lg-4">
			</div>
			<div class="col-lg-8">
				<div class="banner_content">
					<div class="row d-flex align-items-center">
						<div class="col-lg-8 col-md-12">
							<h1>Riolo - Toko Kue Tradisional & Lainnya</h1>
							<p>Menjual kue tradisional Makassar Bugis yang bisa dijadikan ole ole ke luar kota. Juga
								menerima order untuk acara nikahan, lamaran, syukuran, pengajian, meeting, dll</p>
						</div>
						<div class="col-lg-4 col-md-12">

						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End banner bottom -->
		<!--================ End Home Banner Area =================-->

		<!--================ Menu Area =================-->
		<section class="menu_area section_gap">
			<div class="container">
				<div class="row menu_inner">
					<div class="col-lg-5 offset-lg-2">
						<div class="menu_list">
							<h1>Menu Riolo - Toko Kue</h1>
							<ul class="list">
								<?php 
								$qq = mysqli_query($mysqli, "SELECT * FROM barang order by kd_barang");
								while ($dad = mysqli_fetch_assoc($qq)) {
									?>
								<li>
									<h4><?php echo $dad['nm_barang']; ?>
										<span>Rp. <?php echo format_angka($dad['harga_jual']); ?>,-</span>
									</h4>
									<p><?php echo $dad['keterangan']; ?></p>
								</li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--================End Menu Area =================-->
		<!--================ Start Footer Area =================-->
		<footer class="footer-area overlay">
			<div class="row footer-bottom justify-content-between">
				<div class="col-lg-6">
					<p class="footer-text m-0">
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						Copyright &copy;<script>
							document.write(new Date().getFullYear());
						</script> All rights reserved | This template is made with <i class="fa fa-heart-o"
							aria-hidden="true"></i> by <a href="#" target="_blank">STMIK Handayani</a>
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					</p>
				</div>
			</div>

	</div>
	</footer>
	<!--================ Start Footer Area =================-->
	</div>

	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Konfirmasi status!</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="aktor" value="admin" />
							<label class="form-check-label">
								Admin
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="aktor" value="user" />
							<label class="form-check-label">
								User
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="aktor" value="retail" />
							<label class="form-check-label">
								Retail
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="aktor" value="kurir" />
							<label class="form-check-label">
								Kurir
							</label>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/stellar.js"></script>
	<script src="assets/js/jquery.magnific-popup.min.js"></script>
	<script src="assets/lightbox/simpleLightbox.min.js"></script>
	<script src="assets/nice-select/js/jquery.nice-select.min.js"></script>
	<script src="assets/owl-carousel/owl.carousel.min.js"></script>
	<script src="assets/jquery-ui/jquery-ui.js"></script>
	<script src="assets/js/jquery.ajaxchimp.min.js"></script>
	<script src="assets/counter-up/jquery.waypoints.min.js"></script>
	<script src="assets/counter-up/jquery.counterup.js"></script>
	<script src="assets/js/mail-script.js"></script>
	<script src="assets/js/gmaps.min.js"></script>
	<script src="assets/js/theme.js"></script>

	<script type="text/javascript">
		$('input:radio[name="aktor"]').change(function () {
			if ($(this).is(':checked') && $(this).val() == 'admin') {
				document.location.href = 'penjualan/admin';
			} else if ($(this).is(':checked') && $(this).val() == 'user') {
				document.location.href = 'penjualan/user/?open=Pelanggan-Baru';
			} else if ($(this).is(':checked') && $(this).val() == 'retail') {
				document.location.href = 'penjualan/retail/?open=Pelanggan-Baru';
			} else {
				document.location.href = 'penjualan/kurir';
			}
		});
	</script>
</body>

</html>