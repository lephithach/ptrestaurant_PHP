<?php
	require_once('./Model/Model.php');
	require_once('./Model/Product.php');

	$Product = new Product;

	echo $Product->getFullProduct('SELECT * FROM `monan` JOIN `loaimon` ON monan.maloai = loaimon.maloai ORDER BY monan.maloai asc');
?>