<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
	<a class="navbar-brand" href="./">PT Restaurant</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mx-auto">
			<li class="nav-item <?= basename($_SERVER['PHP_SELF'])=='index.php' ? 'active' : '' ?>">				
				<a class="nav-link" href="./">
					<i class="fas fa-home icon"></i>Trang chủ
				</a>
			</li>

			<li class="nav-item <?= basename($_SERVER['PHP_SELF'])=='gioi-thieu.php' ? 'active' : '' ?>">				
				<a class="nav-link" href="./gioi-thieu.php">
					<i class="fas fa-info"></i>Giới thiệu
				</a>
			</li>
			
			<li class="nav-item <?= basename($_SERVER['PHP_SELF'])=='danh-sach-mon.php' ? 'active' : '' ?>">
				<a class="nav-link" href="./danh-sach-mon.php">
					<i class="fas fa-utensils icon"></i>Danh sách món ăn
				</a>
			</li>

			<li class="nav-item <?= basename($_SERVER['PHP_SELF'])=='gio-hang.php' ? 'active' : '' ?>">
				<a class="nav-link" href="./gio-hang.php">
					<i class="fas fa-shopping-cart icon"></i>Giỏ hàng
				</a>
			</li>
			
			<li class="nav-item <?= basename($_SERVER['PHP_SELF'])=='gop-y.php' ? 'active' : '' ?>">
				<a class="nav-link" href="gop-y.php">
					<i class="far fa-address-book"></i>Góp ý
				</a>
			</li>
		</ul>

		<a href="tel:0929626424" class="btn btn-outline-success" id="goi-ngay"><i class="bi bi-telephone mr-1"></i>GỌI NGAY</a>
	</div>
</nav>
<!-- End nav -->