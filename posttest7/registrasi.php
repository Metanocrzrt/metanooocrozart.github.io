<?php

include 'koneksi.php';

if (isset($_POST['submit'])){
	$nama = $_POST['nama'];
	$username = $_POST['username'];
	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];

	$cek_user = mysqli_query($koneksi,"SELECT * FROM user WHERE username = '$username'");
	$cek_login = mysqli_num_rows($cek_user);

	if ($cek_login > 1){
		echo "<script>
			alert('Username telah terdaftar');
			window.location = 'registrasi.php';
		</script>";
	}else{
		if ($password1 != $password2){
			echo "<script>
			alert('konfirmasi password tidak sesuai');
			window.location = 'registrasi.php';
		</script>";
		}else{
			$password = password_hash($password1,PASSWORD_DEFAULT);
			mysqli_query($koneksi,"INSERT INTO user VALUES('','$nama','$username','$password')");
			echo "<script>
			alert('data berhasil dikirim');
			window.location = 'index.php';
		</script>";
		}
	}
}


?>
<!--
Author: Colorlib
Author URL: https://colorlib.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>SignUp Now</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Custom Theme files -->
<link href="css/register.css" rel="stylesheet" type="text/css" media="all" />
<!-- //Custom Theme files -->
<!-- web font -->
<link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
<!-- //web font -->
</head>
<body>
	<!-- main -->
	<div class="main-w3layouts wrapper">
		<h1>SignUp Now</h1>
		<div class="main-agileinfo">
			<div class="agileits-top">
				<form action="" method="POST">
					<input class="text" type="text" name="nama" placeholder="Nama Lengkap" required="yes">
					<input class="text email" type="text" name="username" placeholder="username" required="yes">
					<input class="text" type="password" name="password1" placeholder="Password" required="">
					<input class="text w3lpass" type="password" name="password2" placeholder="Confirm Password" required="">
					<input type="submit" value="SIGNUP" name="submit">
				</form>
				<p>Don't have an Account? <a href="index.php"> Login Now!</a></p>
			</div>
		</div>
		<!-- copyright -->
		<div class="colorlibcopy-agile">
			<p>?? 2022 Sancto Metano Crozart. All rights reserved | Design by MetanoCrzrt</p>
		</div>
		<!-- //copyright -->
		<ul class="colorlib-bubbles">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
	<!-- //main -->
</body>
</html>