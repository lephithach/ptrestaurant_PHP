<?php
    include('inc/connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt hàng thành công</title>
    <link href="css/bootstrap.css" type="text/css" rel="stylesheet">
    <link href="css/main.css" type="text/css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" type="text/css" rel="stylesheet">
    <?php include('inc/fav-icon.php'); ?>
    <style>
        @media only screen and (max-width: 992px){
            img#thank-you{
                width: 100%;
            }
        }

        @media only screen and (min-width: 993px){
            img#thank-you{
                width: 70%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center my-2">
            <div class="col-md-6 col-lg-5 col-xl-5 text-center text-uppercase text-success"><h4>Cảm ơn quý khách</h4></div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5 col-xl-5 text-justify">Quý khách đã đặt hàng thành công tại nhà hàng của chúng tôi. Nhà hàng chúng tôi sẽ liên lạc với quý khách trong vòng <strong>30 phút</strong> để xác nhận đơn hàng. <br> Xin quý khách vui lòng giữ liên lạc để tiện trong việc xác nhận.</div>            
        </div>

        <div class="row justify-content-center text-center">
            <div class="col-md-6 col-lg-5 col-xl-5"><span class="font-weight-bold" style="font-size:1.2rem;">Xin chân thành cảm ơn!</span></div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5 col-xl-5 text-center"><img id="thank-you" src="https://media3.giphy.com/media/l3q2FnW3yZRJVZH2g/giphy.gif" alt="thank-you"></div>
        </div>

        <!-- <div class="row justify-content-center my-2">
            <div class="col-md-6 col-lg-5 col-xl-5"><a href="<?= isset($_GET["mahd"]) ? 'bill.php?mahd='.$_GET["mahd"] : '' ?>" class="btn btn-sm btn-success btn-block">Xem hóa đơn</a></div>
        </div> -->

        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5 col-xl-5"><a href="./" class="btn btn-sm btn-secondary btn-block">Quay về trang chủ</a></div>
        </div>
    </div>

    <?php include('inc/footer.php'); ?>

    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/bootstrap.js" type="text/javascript"></script>
</body>
</html>