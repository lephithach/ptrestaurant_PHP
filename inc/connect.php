<?php
	$servername = 'localhost';
	$user = 'root';
	$pass = '';
	$dbname = 'qlnhahang';
	
	$conn = mysqli_connect($servername, $user, $pass, $dbname);
	mysqli_set_charset($conn, 'utf8');
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	
	if(!$conn) die('Kết nối đến Server thất bại');
?>