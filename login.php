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

	<!-- Hero section -->
	<section class="hero-section" >
		<div class="hero-slider owl-carousel">
			<div class="hs-item set-bg" data-setbg="img/course/4.jpg " >
				<div class="hs-text">
					<div class="container">
						<div class="row">
							<div class="col-lg-8">
								<?php
								session_start();
								$conn = mysqli_connect("localhost", "root", "", "bk");

								if (isset($_POST["login"])) {
									$user = $_POST["username"];
									$pass = $_POST["password"];

									$result = mysqli_query($conn, "SELECT*FROM admin WHERE username='$user' AND password='$pass' ");
									if (mysqli_num_rows($result) > 0) {
							                // set session
							                $_SESSION["login"] = true;
							                header("Location: data_siswa.php");
							                exit;
							        }

							        $error = true;
								}
								?>
								<div style="background-color: rgba(0,0,0,0.9); width: 380px; height: 300px; text-align: center;">
									<h2 style="color: white; text-align: center;">Login admin/guru</h2> <br>
									<form method="POST" action="" >
										<?php if (isset($error)): ?>
											<p style="color: red; font-style: italic;">Username / Password Salah!</p>
										<?php endif ?>
									<input type="text" name="username" placeholder="Username" required="" style="border: none;border-bottom: 1px solid grey; background-color: transparent;  margin-bottom: 10px; color: whitesmoke; "><br> 
									<input type="password" name="password" placeholder="Password" required=""  style="border: none;border-bottom: 1px solid grey; background-color: transparent;  margin-bottom: 10px; color: whitesmoke;">  <br>
									<button type="submit" name="login" style="background-color: transparent; border: 1px solid grey; border-radius: 10px; color: white;"> Log In </button>
								</form>	
								</div>
								
							</div>
						</div>
					</div>
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
