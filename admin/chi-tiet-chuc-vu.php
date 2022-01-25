<?php 
    session_start();
    include('../inc/connect.php');
    include('inc/check-login.php');
    include('../inc/_fix.php');
    $NavActive = "nhanvien";
    $NavSubActive = "ChucVu";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include('./inc/link.php'); ?>
    <script>
        // Giữ thanh menu trái
        const nhanvien = true;
    </script>
</head>
<body>
    <?php include('./inc/page-header.php'); ?>
    <?php include('./inc/menu-left.php'); ?>

    <div class="container-fluid" id="menu-right">
        <form id="form-chuc-vu" method="post" action="">
            <div class="row">
                <div class="col-md-12"><h4 style="text-transform:uppercase;" class="text-center">Chi tiết chức vụ</h4></div>
            </div>

            <div class="row justify-content-lg-center">
                <?php 
                    if(isset($_GET["machucvu"])){
                        $sql = 'SELECT * FROM `chucvu` WHERE machucvu="'.$_GET["machucvu"].'"';
                        $kq = mysqli_query($conn, $sql);

                        $row = mysqli_fetch_assoc($kq);
                ?>

                <div class="col-md-12 col-lg-6 col-xl-4">
                    <div class="form-group row">
                        <label for="machucvu" class="col-md-3 col-lg-4 col-xl-4 col-form-label label">Mã CV:</label>
                        <input type="text" class="form-control col-md-9 col-lg-8 col-xl-8" maxlength="3" id="machucvu" name="machucvu" value="<?= $row['machucvu'] ?>" onInput="KiemTraMaChucVu()">
                        <div class="text-danger font-italic text-center loimachucvu col-md-12 col-lg-12 col-xl-12"></div>
                    </div>
                </div>

                <div class="col-md-12 col-lg-6 col-xl-4">
                    <div class="form-group row">
                        <label for="tenchucvu" class="col-md-3 col-lg-4 col-xl-4 col-form-label label">Tên CV:</label>
                        <input type="text" class="form-control col-md-9 col-lg-8 col-xl-8" id="tenchucvu" name="tenchucvu" value="<?= $row['tenchucvu'] ?>">
                    </div>
                </div>

                <?php 
                    }
                ?>
            </div>

            <div class="row col-md-12 col-lg-12 col-xl-12 justify-content-center" id="thongbao"></div>

            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-sm btn-primary">Lưu</button>
                    <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                    <button type="button" class="btn btn-sm btn-secondary" onClick="history.back();">Quay lại</button>
                </div>
            </div>
        </form>
    </div>

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="./js/function.js"></script>  
</body>
</html>