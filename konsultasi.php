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
				<li class="active"><a href="data_siswa.php">Konseling</a></li>
				<li><a href="data_siswa.php?act=plgr_baru">Tambah baru</a></li>
				<li><a href="data_admin.php">Data admin</a></li>
				<li><a href="konsultasi.php">Balas Konsul</a></li>
				<li><a href="logout.php">Log Out</a></li>
			</ul>
		</div>
	</nav>
	<!-- Header section end -->


	<!-- Hero section -->
	<section class="hero-section" >
		<div class="hero-slider owl-carousel">
			<div class="hs-item set-bg" data-setbg="img/hero-slider/2.jpg">
				<div style="margin-left: 370px; color: whitesmoke;">				
<?php 
	$conn = mysqli_connect("localhost","root","","bk");

	$data = mysqli_query($conn,"SELECT * FROM konsul");
 ?>

 	<h2 style="color: white;">Balas Konsul </h2>
	<table border="1px"  class=" table table-bordered" style="width: 600px; ">
		<tr>
			<td>NO</td>
			<td>Nama</td>
			<td>Kelas</td>
			<td>Keluhan</td>
			<td>Balasan</td>
		</tr>

		<?php $no = 1; ?>
		<?php WHILE ($row = mysqli_fetch_assoc($data)) {?>

		<tr>
			<td><?= $no++; ?></td>
			<td><?= $row['nama'] ?></td>
			<td><?= $row['kelas'] ?></td>
			<td><?= $row['keluhan'] ?></td>
			<td><?= $row['balasan'] ?></td>
			<td><a href="balas_kons.php?id=<?= $row['id'] ?>">BALAS</a></td>
		</tr>
	<?php } ?>
	</table>

				</div>			
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