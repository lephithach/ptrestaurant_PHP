<?php
    include('inc/connect.php');
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" CONTENT="PT Restaurant, PT, LPT, Phi Thạch, Lê Phi Thạch, Phi Thach, Phi Thạch Share">
	<meta name="description" CONTENT="PT Restaurant - Nhà hàng đẳng cấp và phong cách">
	<title>PT Restaurant</title>
	<link href="css/bootstrap.css" type="text/css" rel="stylesheet">
	<link href="css/main.css" type="text/css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" type="text/css" rel="stylesheet">
	<?php include('inc/fav-icon.php'); ?>
<style type="text/css">
	#gioi-thieu-1{
		background-image: url("images/banner/image-nha-hang.jpg");
	}

	#gioi-thieu-2{
		background-image: url("images/banner/image-nha-hang-2.jpg");
	}

	#gioi-thieu-3{
		background-image: url("images/banner/image-nha-hang-3.jpg");
	}

	/*Start media screen maxwidth 767px*/
	@media only screen and (max-width: 992px){
		#gioi-thieu-1{
			background-image: url("images/banner/image-nha-hang-768px.jpg");
		}

		#gioi-thieu-2{
			background-image: url("images/banner/image-nha-hang-2-768px.jpg");
		}

		#gioi-thieu-3{
			background-image: url("images/banner/image-nha-hang-3-768px.jpg");
		}
		
		.gioi-thieu--text{
			/*padding: 10em 5em;*/
			margin: 10vh 1em;
			background: rgba(0, 0, 0, 0.4);
			padding: 1.5em;
			border-radius: 1.5em;
		}

		.gioi-thieu--text p{
			color: #FFF;
			/*text-shadow: 2px 2px 2px #000;*/
			font-size: 1.2em;
		}

		.title{
			font-family: 'Lobster', cursive;
			color: #FFF;
			text-shadow: 2px 4px 2px #000;
		}
	} /*End media screen maxwidth 767px*/
</style>
</head>

<body>
	<?php include('inc/nav.php'); ?>
	
	<!--Giới thiệu-->
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12" id="gioi-thieu-1">
				<div class="row">
					<div class="col-xs-12 col-sm-10 col-md-6 col-lg-5 col-xl-5 gioi-thieu--text">
						<h3 class="title">Sơ lược về nhà hàng</h3>
						<p class="text-justify">
							Nhà hàng PT Restaurant tự hào khi được trở thành một trong những điểm hẹn lý tưởng của những doanh nhân thành đạt, 
							những bạn trẻ năng động hay những bữa cơm gia đình ấm cúng sau mỗi ngày làm việc căng thẳng. 
							Không gian nơi đây được trang trí và thiết kế đầy ấn tượng nổi bật với tông màu ấm. 
							Cảm giác ấy đến từ không gian nổi bật với lối thiết kế kiến trúc Đông Dương hài hòa với những món ăn biểu tượng của món ngon Việt Nam hiện đại và ẩm thực phương Tây.
						</p>
					</div>
				</div>
			</div>
		</div>		<!--End gioi thieu 1-->
		
		<div class="row">
			<div class="col-md-12" id="gioi-thieu-2">
				<div class="row">
					<div class="col-xs-12 col-sm-10 col-md-6 col-lg-5 col-xl-5 gioi-thieu--text">
						<h3 class="title">Đội ngũ nhân viên thân thiện</h3>
						<p class="text-justify">
							Đến với nơi đây bạn sẽ được thưởng thức những món ăn ngon phong phú, đa dạng cùng với những chai rượu đặc sắc. 
							Bên cạnh đó chúng tôi sở hữu một đội ngũ nhân viên chuyên nghiệp, nhanh nhẹn và nhiệt tình.
							Đảm bảo cho các món ăn đưa lên quý khách được đảm bảo chất lượng và hương vị thơm ngon nhất.
							Chăm lo cho khách hàng đến từng chi tiết nhỏ. Đem lại cho bạn sự thoải mái như đang ở một nơi quen thuộc.
						</p>
					</div>
				</div>
			</div>
		</div>		<!--End gioi thieu 2-->
		
		<div class="row">
			<div class="col-md-12" id="gioi-thieu-3">
				<div class="row">
					<div class="col-xs-12 col-sm-10 col-md-6 col-lg-5 col-xl-5 gioi-thieu--text">
						<h3 class="title">Hương vị lôi cuốn trong từng món ăn</h3>
						<p class="text-justify">
							Ở đây chúng tôi có rất nhiều các món ăn trong thực đơn mang nét ẩm thực Việt và ẩm thực phương Tây. Nếu bạn đã được thưởng thức các món ăn của chúng tôi chắc chắn bạn sẽ khó quên được hương vị của mỗi món ăn mà nhà hàng của chúng tôi mang lại. Vì các món ăn đều có màu sắc bắt mắt, lôi cuốn ngoài ra quý khách còn cảm nhận được vị vừa béo, vừa ngọt và đậm đà của các món ăn của chúng tôi mang lại. Bên cạnh đó nhà hàng còn sở hữu sảnh chính lớn với sức chứa lên đến 150 người, đủ lớn để tổ chức tiệc liên hoan hoặc lễ kỷ niệm công ty.
						</p>
					</div>
				</div>
			</div>
		</div>		<!--End gioi thieu 3-->	
	</div>

	<style>
		.banner{
			padding: 0;
		}

		.banner img{
			width: 100%;
			height: 100%;
			position: relative;
		}

		.banner .container-button-banner{
			display: flex;			
			flex-direction: column;
			align-items: center;
			justify-content: center;
			position: absolute;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			background-color: rgba(0,0,0,0.14);
			color: #FFF;
			width: 100%;
			height: 100%;
			transition: all .5s ease-in-out;
		}

		.banner .container-button-banner:hover{
			background-color: rgba(0,0,0,0.5);
		}

		.banner .container-button-banner p{
			font-size: 2em;
			font-family: 'Pattaya', sans-serif;
			text-shadow: 5px 3px 4px #000;
		}

		@media only screen and (max-width: 767px){
			.banner .container-button-banner p{
				font-size: 1.3em;
				font-family: 'Pattaya', sans-serif;
			}

			.banner .container-button-banner a{
				font-size: 0.8em;
			}
		}
	</style>

	<!-- <div class="container-fluid">
		<div class="row">
			<div class="col-md-12 banner">
				<img src="./images/banner/image-nha-hang.jpg" alt="khung-canh">

				<div class="container-button-banner">
					<p class="title">Không gian sang trọng</p>
					<a href="gioi-thieu.php#khong-gian" class="btn btn-outline-light">Xem thêm</a>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12 banner">
				<img src="./images/banner/image-nha-hang-2.jpg" alt="nhan-vien">

				<div class="container-button-banner">
					<p class="title">Nhân viên chuyên nghiệp</p>
					<a href="gioi-thieu.php#nhan-vien" class="btn btn-outline-light">Xem thêm</a>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12 banner">
				<img src="./images/banner/image-nha-hang-3.jpg" alt="mon-an">

				<div class="container-button-banner">
					<p class="title">Hương vị tuyệt vời</p>
					<a href="danh-sach-mon-demo.php" class="btn btn-outline-light">Đặt món ăn ngay</a>
				</div>
			</div>
		</div>
	</div> -->
	
	<?php include('inc/footer.php'); ?>

<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>
</body>
</html>