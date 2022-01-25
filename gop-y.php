<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Góp ý</title>
    <link href="css/bootstrap.css" type="text/css" rel="stylesheet">
    <link href="css/main.css" type="text/css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" type="text/css" rel="stylesheet">
    <?php include('inc/fav-icon.php'); ?>
    <style>
        ._hinh_{
            background-image: url('./images/banner/banner-tittle-contact.jpg');
            opacity: 90%;
        }

        .error{
            padding-left: 0;
        }
    </style>
</head>

<body>
    <?php include('inc/nav.php'); ?>

    <div class="container-fluid" id="tittle">
        <div class="row">
			<div class="col-md-12 _hinh_">
				<h3 class="my-1 text-center tittle">GÓP Ý & KHIẾU NẠI</h3>
            </div>
        </div>
    </div>

    <div class="container my-3 container-gop-y">
        <div class="row">
            <div class="col-md-6 col-lg-5 col-xl-5">
                <h5 class="mb-4">Góp ý với chúng tôi</h5>

                <form id="form-gop-y" method="post" action="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="hoten" class="col-md-5 col-lg-4 col-xl-4 col-form-label">Họ tên</label>
                                <input type="text" id="hoten" name="hoten" placeholder="Họ tên" class="form-control col-md-7 col-lg-8 col-xl-8">
                                <span class="text-danger font-italic text-left error col-md-7 offset-md-5 col-lg-8 col-xl-8 offset-lg-4 offset-xl-4" id="error-hoten"></span>
                            </div>

                            <div class="form-group row">
                                <label for="sodienthoai" class="col-md-5 col-lg-4 col-xl-4 col-form-label">Số điện thoại</label>
                                <input type="text" id="sodienthoai" name="sodienthoai" placeholder="Số điện thoại" class="form-control col-md-7 col-lg-8 col-xl-8">
                                <span class="text-danger font-italic text-left error col-md-7 offset-md-5 col-lg-8 col-xl-8 offset-lg-4 offset-xl-4" id="error-sodienthoai"></span>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-5 col-lg-4 col-xl-4 col-form-label">Email</label>
                                <input type="text" id="email" name="email" placeholder="Email" class="form-control col-md-7 col-lg-8 col-xl-8">                                
                                <span class="text-danger font-italic text-left error col-md-7 offset-md-5 col-lg-8 col-xl-8 offset-lg-4 offset-xl-4" id="error-email"></span>
                            </div>

                            <div class="form-group row">
                                <label for="hinhthuc" class="col-md-5 col-lg-4 col-xl-4 col-form-label">Hình thức</label>
                                <select name="hinhthuc" id="hinhthuc" class="form-control col-md-7 col-lg-8 col-xl-8">
                                    <option value="0">Góp ý</option>
                                    <option value="1">Khiếu nại</option>
                                </select>
                            </div>

                            <div class="form-group row">
                                <label for="noidung" class="col-md-5 col-lg-4 col-xl-4 col-form-label">Nội dung</label>
                                <textarea name="noidung" id="noidung" cols="30" rows="4" placeholder="Nội dung" class="form-control col-md-7 col-lg-8 col-xl-8"></textarea>
                                <span class="text-danger font-italic text-left error col-md-7 offset-md-5 col-lg-8 col-xl-8 offset-lg-4 offset-xl-4" id="error-noidung"></span>
                            </div>

                            <div class="form-group row">
                                <button type="submit" class="btn btn-sm btn-outline-success col-md-7 offset-md-5 col-lg-8 offset-lg-4 col-xl-8 offset-xl-4">Gửi</button>
                            </div>

                            <div class="row">
                                <div class="" role="alert" id="message"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-6 col-lg-7 col-xl-7" id="ban-do">
                <h5 class="mb-4">Bản đồ của nhà hàng</h5>
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d522.5092948980958!2d106.84273918983615!3d10.95735735218829!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1svi!2s!4v1614862859928!5m2!1svi!2s" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>

    <?php include('inc/footer.php'); ?>

    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/bootstrap.js" type="text/javascript"></script>
    <script src="js/function.js" type="text/javascript"></script>
</body>
</html>