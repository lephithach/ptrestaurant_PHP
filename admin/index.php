<?php 
    session_start();
    include('../inc/connect.php');
    include('inc/check-login.php');
    $NavActive = 'index';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php include('./inc/link.php'); ?>
</head>

<body>
    <?php include('./inc/page-header.php'); ?>
    <?php include('./inc/menu-left.php'); ?>

    <div class="container-fluid" id="menu-right">
        <div class="row">
            <div class="realtime-box table-status col-md-2" onClick="window.location='trang-thai-ban.php'">
                <p class="number-status">--</p>                            
                <p class="title-status">Bàn đang trống</p>
            </div>

            <div class="realtime-box order-online-status col-md-3">
                <p class="number-status">--</p>                            
                <p class="title-status">Đơn hàng Online chưa xử lý</p>
            </div>

            <div class="realtime-box total-bill col-md-3">
                <p class="number-status">--</p>                            
                <p class="title-status">Tổng đơn hàng hôm nay</p>
            </div>

            <div class="realtime-box total-money col-md-3">
                <p class="number-status">--</p>                            
                <p class="title-status">Tổng tiền hóa đơn hôm nay</p>
            </div>

            <div class="realtime-box total-money-month col-md-3">
                <p class="number-status">--</p>
                <p class="title-status">Tổng tiền hóa đơn tháng này</p>
            </div>
        </div> <!--End div row-->
    </div> <!--End div menu right-->
    
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="./js/function.js"></script>
    <script src="./js/realtime.js"></script>
</body>
</html>