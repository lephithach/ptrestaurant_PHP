<?php 
    session_start();
    include('../inc/connect.php');
    include('inc/check-login.php');
    include('../inc/_fix.php');
    $NavActive = 'monan';
    $NavSubActive = 'ChiTietMonAn';

    if(isset($_POST["btn-luu"])){
        $tenmon = $_POST["tenmon"];
        $loaimon = $_POST["loaimon"];
        $dongia = $_POST["dongia"];

        $Sql_Update = 'UPDATE monan SET tenmon="'.$tenmon.'", maloai="'.$loaimon.'", dongia="'.$dongia.'" WHERE mamon='.$_GET["mamon"];
        $Kq_Update = mysqli_query($conn, $Sql_Update);

        if($Kq_Update){
            $message = '<div class="alert alert-success" role="alert">Cập nhật thành công</div>';
        }else{
            $message = '<div class="alert alert-danger" role="alert">Cập nhật thất bại</div>';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết món ăn</title>
    <?php include('./inc/link.php'); ?>
</head>

<body>
    <?php include('./inc/page-header.php'); ?>
    <?php include('./inc/menu-left.php'); ?>

    <div class="container-fluid" id="menu-right">
        <form id="form-chi-tiet-mon-an" method="post" action="">
            <div class="row">
                <div class="col-md-12">
                    <h4 style="text-transform:uppercase;">Chi tiết món ăn</h4>
                </div>
            </div>

            <div class="row">
                <?php
                    $Sql_Lay_CT_Mon = 'SELECT * FROM monan WHERE mamon=' . $_GET["mamon"];
                    $KQ_Lay_CT_Mon = mysqli_query($conn, $Sql_Lay_CT_Mon);

                    $row = mysqli_fetch_assoc($KQ_Lay_CT_Mon);
                    $maloai = $row['maloai'];
                ?>

                <div class="col-md-12">
                    <img src="<?= '../' . $row['hinh']; ?>" id="anh-mon-an" title="<?= $row['tenmon']; ?>" width="200px" height="200px" alt="<?= alias($row['tenmon']); ?>" onClick="window.open('sua-anh-san-pham.php?mamon=<?= $_GET["mamon"]; ?>', '', 'width=400, height=400');">
                    <p>Mã món ăn: <?= $row['mamon']; ?></p>
                </div>

                <div class="col-md-12 col-lg-6 col-xl-4">
                    <div class="form-group row">
                        <label for="tenmon" class="col-md-3 col-lg-4 col-xl-4 col-form-label label">Tên món:</label>
                        <input type="text" class="form-control col-md-9 col-lg-8 col-xl-8" id="tenmon" name="tenmon" value="<?= $row['tenmon']; ?>">
                    </div>
                </div>

                <div class="col-md-12 col-lg-6 col-xl-4">
                    <div class="form-group row">
                        <label for="loaimon" class="col-md-3 col-lg-4 col-xl-4 col-form-label label">Loại:</label>
                        <select name="loaimon" id="loaimon" class="form-control col-md-9 col-lg-8 col-xl-8">
                            <?php 
                                $Sql_Lay_Loai_Mon = 'SELECT * FROM loaimon';
                                $KQ_Lay_Loai_Mon = mysqli_query($conn, $Sql_Lay_Loai_Mon);

                                while($row_maloai = mysqli_fetch_assoc($KQ_Lay_Loai_Mon)){
                            ?>
                                <option value="<?= $row_maloai['maloai'] ?>" <?= $maloai == $row_maloai['maloai'] ? 'selected' : '' ?> ><?= $row_maloai['tenloai'] ?></option>

                            <?php 
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-12 col-lg-6 col-xl-4">
                    <div class="form-group row">
                        <label for="dongia" class="col-md-3 col-lg-4 col-xl-4 col-form-label label">Đơn giá:</label>
                        <input type="number" class="form-control col-md-9 col-lg-8 col-xl-8" id="dongia" name="dongia" value="<?= $row['dongia']; ?>">
                    </div>
                </div>
            </div>

            <div class="col-md-12 row justify-content-center" id="thongbao">
                <?= isset($message) ? $message : "" ?>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-sm btn-primary" id="btn-luu" name="btn-luu">Lưu</button>
                    <button type="button" class="btn btn-sm btn-danger" onCLick="XoaMonAn(<?= $_GET["mamon"] ?>);">Xóa món ăn</button>
                    <button type="button" class="btn btn-sm btn-secondary" onClick="window.location='mon-an.php'">Quay lại</button>
                </div>
            </div>
        </form>
    </div>

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="./js/function.js"></script>    
</body>
</html>