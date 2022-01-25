<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="./css/main.css">
    <?php include('./inc/link.php');?>
    <style>
        .none{
            display: none;
        }

        @media only screen and (max-width: 767px){
            #container-login{
                width: 90% !important;
                margin: 0 1rem !important;
                margin-top: 10vh !important;
            }

            .form-group label{
                padding-left: 0 !important;
            }
        }
    </style>
</head>

<body>
    <div class="container" id="container-login">
        <div class="row justify-content-center my-3">
            <div class="col-md-6 text-center"><span id="logo-login">PT Restaurant</span></div>
        </div>

        <div class="row justify-content-center my-2">
            <div class="col-md-6 text-center text-uppercase"><h5>Đăng nhập để vào trang quản trị</h5></div>
        </div>

        <form id="form-login" method="post" action="">
            <div class="row justify-content-center" id="container-form-login">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="username" class="col-md-6 col-lg-3 col-form-label">Tài khoản</label>
                        <input type="text" id="username" name="username" class="form-control col-md-6 col-lg-9" placeholder="Tài khoản">
                    </div>

                    <div class="form-group row">
                        <label for="username" class="col-md-6 col-lg-3 col-form-label">Mật khẩu</label>
                        <input type="password" id="password" name="password" class="form-control col-md-6 col-lg-9" placeholder="Mật khẩu">
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12 justify-content-center text-center" id="thongbao" style="margin: 0; padding: 0;">
                            <div class="col-12 alert none" role="alert"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <button type="submit" class="btn btn-success btn-block" onCLick="login();">Đăng nhập</button>
                        <button type="button" class="btn btn-secondary btn-block" onClick="window.location='.././'">Quay lại trang chủ</button>
                    </div>
                </div>
            </div>
        </form>

        <div class="row justify-content-center my-2">
            <div class="col-md-6 text-center">Copyright &copy; 2021 | Designed by Lê Phi Thạch</div>
        </div>
    </div>
    
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script>
        function login(){
            event.preventDefault();

            var username = $("#username").val();
            var password = $("#password").val();
            var loi = 0;

            if(username == ''){
                loi = 1;
                $("#thongbao .alert").removeClass('none');
                $("#thongbao .alert").addClass('alert-danger');
                $("#thongbao .alert").html('Chưa nhập tài khoản');
            }else if(password == ''){
                loi = 1;
                $("#thongbao .alert").removeClass('none');
                $("#thongbao .alert").addClass('alert-danger');
                $("#thongbao .alert").html('Chưa nhập mật khẩu');
            }

            if(loi == 0){
                $.ajax({
                    type: "POST",
                    url: "./inc/xl-dang-nhap.php",
                    data: {
                        'username': username,
                        'password': password
                    },
                    success: function(data){
                        var data = JSON.parse(data);

                        if(data.status == 0){
                            $("#thongbao .alert").removeClass('none');
                            $("#thongbao .alert").addClass('alert-danger');
                            $("#thongbao .alert").html('Tài khoản hoặc mật khẩu không đúng');
                        }else{
                            window.location = './';
                        }
                    }
                });
            }
        }
    </script>
</body>
</html>