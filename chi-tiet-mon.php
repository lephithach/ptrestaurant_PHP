<?php
	session_start();
	include('./inc/connect.php');

	if(isset($_GET['action'])) $action = $_GET['action'];
	
	switch (isset($action)){
		case 'buy': echo 'Mua';
			break;
	}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Chi tiết món</title>
<link href="css/bootstrap.css" type="text/css" rel="stylesheet">
<link href="css/main.css" type="text/css" rel="stylesheet">
<?php include('./inc/fav-icon.php'); ?>
</head>

<body>
	<?php include('./inc/nav.php'); ?>

	<div class="container mt-3">
		<div class="row">
			<!-- <div class="col-md-12 mb-3"><h4>Bạn đang xem món</h4></div> -->
			
			<!-- Ảnh món ăn-->
			<div class="col-md-3" id="img-mon-an-container">
				<img src="https://media.cooky.vn/recipe/g1/2185/s320x320/recipe2185-prepare-step4-636481519203306343.jpg" alt="com-chien" title="cơm chiên" class="img-mon-an">
			</div>
			
			<!--Thông tin món ăn-->
			<div class="col-md-9 thong-tin-chi-tiet">
				<h4>Lorem ipsum dolor sit amet</h4>
				<p>Số lượng: <input type="number" maxlength="2" min="0" value="1" style="max-width: 3.3em; text-align: right;"></p>
				<h5 class="text-danger">1000 VNĐ</h5>
				<!-- <div class="alert alert-success my-3">Thêm vào giỏ thành công.</div> -->
				<a href="?action=buy&mamon=#" class="btn btn-sm btn-danger mt-1" id="btn-them-vao-gio-pc">Thêm vào giỏ</a>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<hr>
				<div class="row">
					<div class="col-md-12"><h5>Mô tả</h5></div>
					<div class="col-md-12 text-justify">
						<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At cupiditate culpa debitis! Sequi nisi id necessitatibus ipsa est cupiditate, dolorem architecto ratione cum, numquam officia rerum tempora, inventore voluptatibus incidunt.</p>
					</div>
				</div>
			</div>
		</div>	
	</div>

	<!-- <div class="container-fluid" id="btn-dat-hang-mobile">
		<div class="row bg-info fixed-bottom text-center py-2">
			<div class="col-md-12"><button type="submit" class="btn btn-danger" id="btn-them-vao-gio-mobile">Thêm vào giỏ</button></div>
		</div>
	</div> -->
	
	<?php include('./inc/footer.php'); ?>
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>
</body>
</html>
