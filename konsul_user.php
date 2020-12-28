<!DOCTYPE html>
<html lang="en">
<head>
	<title>Bimbingan Konseling</title>
	<meta charset="UTF-8">
	<meta name="description" content="Unica University Template">
	<meta name="keywords" content="event, unica, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->   
	<link href="img/favicon.ico" rel="shortcut icon"/>

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/themify-icons.css"/>
	<link rel="stylesheet" href="css/magnific-popup.css"/>
	<link rel="stylesheet" href="css/animate.css"/>
	<link rel="stylesheet" href="css/owl.carousel.css"/>
	<link rel="stylesheet" href="css/style.css"/>


	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<!-- Header section  -->
	<nav class="nav-section">
		<div class="container">
			
			<ul class="main-menu">
				<li class="active"><a href="index.php">Konseling</a></li>
				<li><a href="home.php">Home Student</a></li>
				<li><a href="data_kon.php">Data Konsultasi</a></li>
				<li><a href="konsul_user.php">Konsultasi</a></li>
				<li><a href="login.php">Login Teacher</a></li>
			</ul>
		</div>
	</nav>
	<!-- Header section end -->


	<!-- Hero section -->
	<section class="hero-section" >
		<div class="hero-slider owl-carousel">
			<div class="hs-item set-bg" data-setbg="img/hero-slider/2.jpg" >
								<div style="margin: 10px 0 0 460px;" >
								 <h2 style="color: whitesmoke;">Silahkan isi keluhan anda</h2>	
								<form action="" method="POST">
									<input type="text" name="nama" placeholder="Masukan Nama" required style="border: none; border-bottom: 1px solid whitesmoke;  background: rgba(0,0,0,0.7); color: white; margin-bottom: 5px;"><br>
									<input type="text" name="kelas" placeholder="Masukan Kelas" required style="border: none; border-bottom: 1px solid whitesmoke;  background: rgba(0,0,0,0.7); color: white; margin-bottom: 5px;"><br>
									<textarea rows="5" cols="50" name="keluhan" placeholder="Keluhan Anda" style="border: none; border-bottom: 1px solid whitesmoke;  background: rgba(0,0,0,0.7); color: white; margin-bottom: 5px;"></textarea> <br>
									<input type="submit" name="enter" value="Enter">
								</form>
								</div>


							<?php 
								$conn = mysqli_connect("localhost","root","","bk");

								if(isset($_POST['enter'])) {
									$nama = $_POST['nama'];
									$kelas = $_POST['kelas'];
									$keluhan = $_POST['keluhan'];

									mysqli_query($conn,"INSERT INTO konsul VALUES('','$nama','$kelas','$keluhan','')");

									if(mysqli_affected_rows($conn) > 0){
										echo "<script>
											alert('Mohon tunggu balasan konsultasi anda');
											document.location.href = 'data_kon.php';
											</script>";
									}else{
										echo "<script>
											alert('Data Gagal Ditambahkan')</script>";
									}
								}

							 ?>
							
			</div>
		</div>
	</section>

	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.countdown.js"></script>
	<script src="js/masonry.pkgd.min.js"></script>
	<script src="js/magnific-popup.min.js"></script>
	<script src="js/main.js"></script>
	
</body>
</html>
