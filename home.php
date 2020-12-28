<?php 
	if (!isset($_GET['act'])) {
		echo "<script>
            document.location.href ='home.php?act=data';
        </script>";
	}
 ?>
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
				<div style="margin-left: 370px; color: whitesmoke;">
	<?php if ($_GET['act'] == "data"): ?>
			<h2><font color="white">Poin Pelanggaran Siswa</font></h2> <br>
<!-- pencarian -->
<form action="" method="post">
	<input type="text" name="cari" id="" placeholder="Pencarian">
	<button type="submit" name="mencari">Cari</button>
</form> <br>
<?php 
 	$conn = mysqli_connect("localhost", "root", "", "bk");
 	$data = mysqli_query($conn, "SELECT*FROM siswa");
    if(isset($_POST['mencari'])) {
        $cari = $_POST['cari'];
        echo "hasil pencarian : $cari";
        $data = mysqli_query($conn,"SELECT*FROM siswa WHERE nis like '%$cari%' OR
                                                            nama like '%$cari%' OR 
															kelas like '%$cari%' OR 
															poin like '%$cari%'");
    }else{
        $data = mysqli_query($conn,"SELECT*FROM siswa");
    }



?>
<table border="1" class=" table table-bordered" style="width: 600px; ">
	<tr>
		<td>No.</td>
		<td>NIS</td>
		<td>Nama</td>
		<td>kelas</td>
		<td>Poin</td>
		<td>Status</td>
	</tr>
	<?php

 	$i = 1;
	 while ($row = mysqli_fetch_assoc($data) ) {
	 ?>
	<tr>
		<td><?php echo $i++; ?></td>
		<td><?php echo $row["nis"]; ?></td>
		<td><?php echo $row["nama"]; ?></td>
		<td><?php echo $row["kelas"]; ?></td>
		<td><?php echo $row["poin"]; ?></td>
		<td><?php if ($row["poin"] <= 25) {
				echo "Aman";
			}elseif ($row["poin"] > 25 && $row["poin"] <=50) {
				echo "Peringatan";
			}elseif ($row["poin"] > 50 && $row["poin"] <=75) {
				echo 'Insaflah Anda';
			}elseif ($row["poin"] > 75 && $row["poin"] <=99) {
				echo 'auto kada naik';
			}elseif ($row["poin"] == 100) {
				echo 'Drop Out';
			}?></td>
		<td><a href="?act=detail&nis=<?php echo $row["nis"] ; ?>">detail</a></td>
	</tr>
<?php } ?>
</table>						
	<?php endif ?>		

	<?php if ($_GET['act'] == "detail"): ?>
		<?php 
			$conn = mysqli_connect("localhost", "root", "", "bk");
			$nis = $_GET['nis'];
			$siswa_data = mysqli_query($conn, "SELECT*FROM siswa WHERE nis='$nis'");
		 ?>
		 <div >
		 	<h3 style="color: white;">Catatan pelanggaran</h3>
			<?php while($r = mysqli_fetch_assoc($siswa_data)) { ?>
			 <p style="color: white;">Nama : <?php echo $r["nama"] ; ?></p>
			 <p style="color: white;">Kelas : <?php echo $r["kelas"] ; ?></p>
			  <p style="color: white;">NIS : <?php echo $r["nis"] ; ?></p>
			  <p style="color: white;">Total Poin : <?php echo $r["poin"] ; ?></p>
			<?php } ?>
		 </div>
		
		<table border="1" class=" table table-bordered" style="width: 600px; ">
			<tr>
				<th>No.</th>
				<th>Pelanggaran</th>
				<th>Poin</th>
				<th>Tanggal</th>
			</tr>
			<?php
			$data = mysqli_query($conn, "SELECT*FROM pelanggaran WHERE nis_plgr='$nis'");
			$i = 1;
			while ($row = mysqli_fetch_assoc($data) ) {
			?>
			<tr>
				<td><?php echo $i++; ?></td>
				<td><?php echo $row["pelanggaran"] ; ?></td>
				<td><?php echo $row["poin"] ; ?></td>
				<td><?php echo $row["tgl_pelanggaran"] ; ?></td>
			</tr>
			<?php } ?>
		</table>
	<?php endif ?>					
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