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
				<li><a href="?act=plgr_baru">Tambah baru</a></li>
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

	if (!isset($_GET['act'])) {
		header("location: ?act=data");
	}

	
	$conn = mysqli_connect("localhost", "root", "", "bk");
	$data = mysqli_query($conn, "SELECT*FROM siswa");
	
 ?>

<!-- Page utama -->
<?php if ($_GET['act'] == "data"): ?>
<h2><font color="white">Data Pelanggaran Siswa</font></h2> <br>

<!-- pencarian -->
<form action="" method="post">
	<input type="text" name="cari" id="" placeholder="Pencarian">
	<button type="submit" name="mencari">Cari</button>
</form>
<?php 
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
		<td>Tambah pelanggaran</td>
		<td>Opt</td>
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
		<td><a href="?act=new_plgr&nis=<?php echo $row["nis"] ; ?>&
								  oldPoin=<?php echo $row["poin"]; ?>&
								  nama=<?php echo $row["nama"]; ?>&
								  kelas=<?php echo $row["kelas"]; ?>" style="font-size: 30px;">+</a></td>
		<td><a href="?act=hapus&nis=<?php echo $row['nis'] ;?>" onclick="return confirm('Konfirmasi');">Hapus</a> | <a href="?act=edit&nis=<?php echo $row['nis'] ;?>">Edit</a></td>
		<td><a href="?act=detail&nis=<?php echo $row["nis"] ; ?>">detail</a></td>
	</tr>
<?php } ?>
</table>
<?php endif ?>
<!-- END -->

<!-- Hapus -->
<?php if ($_GET['act'] == "hapus"){
	$nis = $_GET['nis'];

    mysqli_query($conn, "DELETE FROM pelanggaran WHERE nis_plgr=$nis");
    mysqli_query($conn, "DELETE FROM siswa WHERE nis=$nis");

    if (mysqli_affected_rows($conn) > 0 ) {
        echo "<script>
            document.location.href ='data_siswa.php';
        </script>";
    }
}
?>
<!-- END -->
<!-- Page edit -->
<?php if ($_GET['act'] == "edit"): ?>
	<?php
    $oldNis = $_GET['nis'];

    $data = mysqli_query($conn, "SELECT*FROM siswa WHERE nis=$oldNis");
    while ($row = mysqli_fetch_assoc($data)) {
        $id = $row["id"];
        $nama = $row["nama"];
        $kelas = $row["kelas"];
        $nis = $row["nis"];
    }

    if (isset($_POST["edit"])) {
        $nama = $_POST['nama'];
        $kls = $_POST['kelas'];
        $jurusan = $_POST['jurusan'];
        $kelas = "$kls $jurusan";
        $nis = $_POST['nis'];

        if ($jurusan == "--Jurusan--" )  {
            echo "<script>
                        alert('Jurusan belum terisi');
                        location.replace('?act=edit');
                    </script>";
            return false;
        }

        if ($kls == "--Kelas--" ) {
            echo "<script>
                        alert('Kelas belum terisi');
                        location.replace('?act=edit');
                    </script>";
            return false;
        }

        mysqli_query($conn, "UPDATE siswa SET nis='$nis', nama='$nama', kelas='$kelas' WHERE nis=$oldNis");
        mysqli_query($conn, "UPDATE pelanggaran SET kls_plgr='$kelas', nama_plgr='$nama', nis_plgr='$nis' WHERE nis_plgr=$oldNis");

        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>
                   location.replace('data_siswa.php');
                </script>";
        }else{
            echo "gagal";
        }
    }

?>
<h1>Edit Siswa</h1>
<form action="" method="post">
    <input type="text" name="nama"  placeholder="nama" required="" autocomplete="off" value="<?php echo $nama; ?>"> <br>
	<select name="kelas">
		<option value="--Kelas--">--Kelas--</option>
		<option value="X">X</option>
		<option value="XI" >XI</option>
		<option value="XII">XII</option>
	</select>
	<select name="jurusan">
		<option>--Jurusan--</option>
		<option>RPL</option>
		<option>BCT</option>
		<option>MM</option>
		<option>PS</option>
		<option>DI</option>
		<option>KI</option>
		<option>TKJ</option>
		<option>ANM</option>
	</select> <br>
	<input type="text" name="nis" required="" autocomplete="off" placeholder="NIS" value="<?php echo $nis; ?>"> <br>
    <button type="submit" name="edit" onclick="return confirm('Konfirmasi');"> EDIT </button>
</form>

<?php endif ?>
<!-- END -->

<!-- Page detail data pelanggar -->
<?php if ($_GET['act'] == "detail"): ?>
<?php 
	$nis = $_GET['nis'];
	$siswa_data = mysqli_query($conn, "SELECT*FROM siswa WHERE nis='$nis'");
 ?>
<h3 style="color: white;">Catatan pelanggaran</h3>
<?php while($r = mysqli_fetch_assoc($siswa_data)) { ?>
 <p style="color: white;">Nama : <?php echo $r["nama"] ; ?></p>
 <p style="color: white;">Kelas : <?php echo $r["kelas"] ; ?></p>
  <p style="color: white;">NIS : <?php echo $r["nis"] ; ?></p>
  <p style="color: white;">Total Poin : <?php echo $r["poin"] ; ?></p>
<?php } ?>
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
<!-- END -->

<!-- Pelanggar baru -->
<?php if ($_GET['act'] == "plgr_baru"): ?>
<?php

if (isset($_POST['simpan'])) {
	$nama = $_POST['nama'];
	$kls = $_POST['kelas'];
	$jurusan = $_POST['jurusan'];
	$kelas = "$kls $jurusan";
	$nis = $_POST['nis'];
	$pelanggaran = $_POST['pelanggaran'];
	$poin = $_POST['poin'];

	$nisSudahAda = mysqli_query($conn, "SELECT * FROM siswa WHERE nis=$nis ");
	if (mysqli_fetch_assoc($nisSudahAda)) {
		echo "<script>
                    alert('NIS sudah ada, Silahkan menuju halaman tambah pelanggaran');
                    location.replace('?act=data');
                 </script>";
         return false;
	}

	if ($jurusan == "--Jurusan--" )  {
		echo "<script>
					alert('Jurusan belum terisi');
					location.replace('?act=plgr_baru');
				 </script>";
         return false;
	}

	if ($kls == "--Kelas--" ) {
		echo "<script>
					alert('Kelas belum terisi');
					location.replace('?act=plgr_baru');
                 </script>";
         return false;
	}

	mysqli_query($conn, "INSERT INTO pelanggaran VALUES ('', '$pelanggaran', $poin, '$kelas', now(),'$nama', '$nis' )");
	mysqli_query($conn, "INSERT INTO siswa VALUES('', '$nis', '$nama', '$kelas', $poin) ");

	if (mysqli_affected_rows($conn) > 0) {
		echo "<script>
                   location.replace('?act=detail&nis=$nis');
                </script>";
	}
}
 ?>
<h2>Pelanggaran Baru</h2>
<form action="" method="post">
	<input type="text" name="nama"  placeholder="nama" required="" autocomplete="off"> <br>
	<select name="kelas">
		<option value="--Kelas--">--Kelas--</option>
		<option value="X">X</option>
		<option value="XI">XI</option>
		<option value="XII">XII</option>
	</select>
	<select name="jurusan">
		<option>--Jurusan--</option>
		<option>RPL</option>
		<option>BCT</option>
		<option>MM</option>
		<option>PS</option>
		<option>DI</option>
		<option>KI</option>
		<option>TKJ</option>
		<option>ANM</option>
	</select> <br>
	<input type="text" name="nis" required="" autocomplete="off" placeholder="NIS"> <br>
	<textarea name="pelanggaran" required="" autocomplete="off" placeholder="Pelanggaran"></textarea> <br>
	<select name="poin" required="">
		<?php 
		for ($i = 1; $i <= 100; $i++) {
		 ?>
		<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
		<?php } ?>
	</select>
	<button type="submit" name="simpan" onclick="return confirm('Konfirmasi');">Simpan</button>
</form>

<?php endif ?>
<!-- END -->

<!-- Pelanggaran baru -->
<?php if ($_GET['act'] == "new_plgr"): ?>
	<?php
$nis = $_GET['nis'];
$data = mysqli_query($conn, "SELECT*FROM siswa WHERE nis=$nis");
$row = mysqli_fetch_assoc($data);
if (isset($_POST['simpan'])) {
	$plgrn = $_POST['pelanggaran'];
	$newPoin = $_POST['newPoin'];
	$oldPoin = $_GET['oldPoin'];
	$poin = $oldPoin + $newPoin;
	$nama = $_GET['nama'];
	$kelas = $_GET['kelas'];
	$nis = $_GET['nis'];

	$result = mysqli_query($conn, "INSERT INTO pelanggaran VALUES ('', '$plgrn', $newPoin,   '$kelas', now(),'$nama','$nis' )");
	mysqli_query($conn, "UPDATE siswa SET poin=$poin WHERE nis=$nis");

	if (mysqli_affected_rows($conn) > 0) {
		echo "<script>
                    location.replace('?act=detail&nis=$nis');
                 </script>";
	}
}
 ?>
<h1>Pelanggaran baru</h1>
<form method="post" action="">
	<textarea name="pelanggaran" placeholder="Pelanggaran" required=""></textarea> <br>
	<label>poin :</label>
	<select name="newPoin" required="">
		<?php 
		for ($i = 1; $i <= 100; $i++) {
		 ?>
		<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
		<?php } ?>
	</select>
	<button type="submit" name="simpan" onclick="return confirm('Apakah data sudah benar');">Simpan</button>
</form>
<?php endif ?>
<!-- END -->

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