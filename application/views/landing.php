<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Landing Page</title>
	<meta name="description" content="Landing pages." />

	<!--Inter UI font-->
	<link href="https://rsms.me/inter/inter-ui.css" rel="stylesheet">


	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/landing/css/bootstrap/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/landing/css/fontawesome/css/all.min.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/landing_baru/css/blue.css" />
	<!-- Bootstrap CSS / Color Scheme -->
	<link rel="stylesheet" href="css/blue.css" id="theme-color">
</head>

<body>

	<!--navigation-->
	<section class="smart-scroll">
		<div class="container-fluid">
			<nav class="navbar navbar-expand-md navbar-dark">
				<a class="navbar-brand heading-black" href="index.html">
					Penggajian
				</a>
				<button class="navbar-toggler navbar-toggler-right border-0" type="button" data-toggle="collapse"
					data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
					aria-label="Toggle navigation">
					<span data-feather="grid"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarCollapse">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item">
							<a class="nav-link page-scroll" href="#features">HOME</a>
						</li>
						<li class="nav-item">
							<a class="nav-link page-scroll d-flex flex-row align-items-center text-primary" href="#">
								<em data-feather="layout" width="18" height="18" class="mr-2"></em>
								Try Generator
							</a>
						</li>
					</ul>
				</div>
			</nav>
		</div>
	</section>

	<!--hero header-->
	<section class="py-7 py-md-0 bg-hero" id="home">
		<div class="container">
			<div class="row vh-md-100">
				<div class="col-md-8 col-sm-10 col-12 mx-auto my-auto text-center">
					<h1 class="heading-black text-capitalize">SMA YP UNILA</h1>
					<p class="lead py-3"> JL. JEND. SUPRAPTO NO. 88 BANDAR LAMPUNG
					</p>
					<button class="btn btn-primary d-inline-flex flex-row align-items-center">
						Get started now
						<em class="ml-2" data-feather="arrow-right"></em>
					</button>
				</div>
			</div>
		</div>
	</section>

	<!-- features section -->
	<section class="pt-6 pb-7" id="features">
		<div class="container">
			<div class="row">
				<div class="col-md-6 mx-auto text-center">
					<h2 class="heading-black">SISTEM PENGGAJIAN GURU DAN STAFF SMA YP UNILA</h2>
					<p class="text-muted lead">Website Gaji Guru dan Staff SMA YP UNILA adalah sebuah platform digital
						yang di rancang khusus untuk memfasilitasi pengelolaan dan akses informasi terkait gaji guru dan
						staff di SMA YP UNILA </p>
				</div>
			</div>
			<div class="row mt-6">
				<div class="col-md-6 mr-auto">
					<h2>VISI</h2>
					<p class="mb-5">“Pada tahun 2025 Menjadi Sekolah Unggul di Provinsi Lampung Melalui Pengembangan
						Kreatifitas berlandaskan IPTAQ dan IPTEK”</p>
				</div>
				<div class="col-md-5">
					<!-- ... (previous code) ... -->

					<div class="slick-about">
						<img src="<?php echo base_url('assets/landing_baru/img/blog-1.jpg'); ?>"
							class="img-fluid rounded d-block mx-auto" alt="" />
						<img src="<?php echo base_url('assets/landing_baru/img/blog-2.jpg'); ?>"
							class="img-fluid rounded d-block mx-auto" alt="" />
						<img src="<?php echo base_url('assets/landing_baru/img/blog-3.jpg'); ?>"
							class="img-fluid rounded d-block mx-auto" alt="" />
					</div>

					<!-- ... (remaining code) ... -->

				</div>
			</div>
		</div>
	</section>

	<!--news section-->


	<!--footer-->
	<footer class="py-6">
		<div class="container">
			<div class="row">
				<div class="col-sm-5 mr-auto">
					<h5>About SMA YP UNILA</h5>
					<p class="text-muted">Berdirinya Sekolah Menengah Atas Yayasan Pembina Unila pada tahun 1981 di
						bawah naungan Yayasan Pembina Unila dengan Akte Notaris No. 45 tanggal 26 Februari 1974.</p>
				</div>
				<div class="col-sm-2">
					<h5>Contact Us</h5>
					<ul class="list-unstyled">
						<li><a href="https://www.facebook.com/smaypunilabandarlampung?_rdc=1&_rdr">Facebook</a></li>
						<li><a href="https://www.instagram.com/sma_ypunila/">Instagram</a></li>
						<li><a href="https://www.youtube.com/@smanilatv5942">Youtube</a></li>
						<li> 0721-254502</li>
					</ul>
				</div>
				<div class="row mt-5">
					<div class="col-12 text-muted text-center small-xl">
						&copy; Official Website Penggajian Guru dan Staff SMA YP UNILA Bandar Lampung
					</div>
				</div>
			</div>
	</footer>

	<!--scroll to top-->
	<div class="scroll-top">
		<i class="fa fa-angle-up" aria-hidden="true"></i>
	</div>



	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.7.3/feather.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/landing_baru/js/scripts.js"></script>
</body>

</html>