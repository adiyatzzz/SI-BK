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
			<div class="hs-item set-bg" data-setbg="img/hero-slider/2.jpg" >
				<div style="margin-left: 370px; color: whitesmoke;">				
								<?php 
									session_start();
									if (!isset($_SESSION['login'])) {
										echo "<script>
								                    location.replace('login.php');
								                 </script>";
										exit;
									}

									if (!isset($_GET["act"])) {
										header("Location: ?act=data");
									}

									$conn = mysqli_connect("localhost", "root", "", "bk");
									$data = mysqli_query($conn, "SELECT*FROM admin");
									
								 ?>


								 <?php if ($_GET['act'] == "data"): ?>
								 	<div class="badge badge-pill badge-dark" style="font-size: 15px;"><a href="?act=tambah">+admin</a></div>
								
								<!-- pencarian -->
								<div style="margin-left: 170px;">
									<h3>Data admin</h3>
									<form action="" method="post">
									<input type="text" name="cari" id="" placeholder="Pencarian">
									<button type="submit" name="mencari">Cari</button>
								</form>
								</div> <br>
								
								<?php 
								    if(isset($_POST['mencari'])) {
								        $cari = $_POST['cari'];
								        echo "hasil pencarian : $cari";
								        $data = mysqli_query($conn,"SELECT*FROM admin WHERE username like '%$cari%' OR
								                                                            password like '%$cari%' ");
								    }else{
								        $data = mysqli_query($conn,"SELECT*FROM admin");
								    }



								?>

								<table border="1"  class=" table table-bordered" style="width: 600px; ">
									<tr>
										<td>No.</td>
										<td>Username</td>
										<td>Password</td>
										<td>Opt</td>
									</tr>
									<?php
								 	$i = 1;
									 while ($row = mysqli_fetch_assoc($data) ) {
									 ?>
									<tr>
										<td><?php echo $i++; ?></td>
										<td><?php echo $row["username"]; ?></td>
										<td><?php echo $row["password"]; ?></td>
										<td><a href="data_admin.php?act=hapus&id=<?php echo $row['id'] ;?>" onclick="return confirm('Konfirmasi');">Hapus</a> | <a href="data_admin.php?act=edit&id=<?php echo $row['id'] ;?>">Edit</a></td>
									</tr>
								<?php } ?>
								</table>
								 <?php endif ?>

								 <!-- HAPUS -->
								 <?php if ($_GET['act'] == "hapus"): ?>
								 	<?php 
								 	$id = $_GET['id'];
								 		mysqli_query($conn, "DELETE FROM admin WHERE id=$id");

									    if (mysqli_affected_rows($conn) > 0 ) {
									        echo "<script>
									            document.location.href ='data_admin.php';
									        </script>";
									    }
								 	 ?>
								 <?php endif ?>

								 <?php if ($_GET['act'] == "edit"): ?>
								 	<?php
								 		$id = $_GET['id'];
								 		$data = mysqli_query($conn, "SELECT*FROM admin WHERE id=$id");
								 		$r = mysqli_fetch_assoc($data);

								 		if (isset($_POST['edit'])) {
								 			$username = $_POST['username'];
								 			$password = $_POST['password'];

										    mysqli_query($conn, "UPDATE admin SET username='$username', password='$password' WHERE id=$id ");

										    if (mysqli_affected_rows($conn) > 0) {
										    	echo "<script>
								                   location.replace('data_admin.php');
								                </script>";
										    }
								 		}
								 	?>
								 	<h3>Edit admin</h3>
								 	<form method="post" action="">
								 		<input type="text" name="username" value="<?php echo $r["username"]; ?>" placeholder="Username"> <br>
								 		<input type="password" name="password" value="" placeholder="Password"> <br>
								 		<button type="submit" name="edit" onclick="return confirm('Konfirmasi!');">EDIT</button>
								 	</form>
								 <?php endif ; ?>

								 <?php if ($_GET['act'] == "tambah"): ?>
								 	<?php
								 	if (isset($_POST["simpan"])) {
									    $username = $_POST["username"];
									    $password = $_POST["password"];

									    $result = mysqli_query($conn, "SELECT*FROM admin WHERE username='$username'");
									    if (mysqli_fetch_assoc($result)) {
									        echo "<script>
									                    alert('Username Tidak bisa digunakan');
									                    location.replace('tambah_admin.php');
													 </script>";
									         return false;
									    }

									    mysqli_query($conn, "INSERT INTO admin VALUES ('', '$username', '$password') ");

									    if (mysqli_affected_rows($conn)) {
									        echo "<script>
									                    alert('Admin baru telah ditambahkan');
									                    location.replace('data_admin.php');
													 </script>";
									    }
									}

								?>
								<h1>New Admin</h1>
								<form action="" method="post">
								    <input type="text" name="username" id="" placeholder="Username" required=""><br>
								    <input type="password" name="password" id="" placeholder="Password" required=""> <br>
								    <button type="submit" name="simpan" onclick="return confirm('Konfirmasi');">Simpan</button>
								</form>
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