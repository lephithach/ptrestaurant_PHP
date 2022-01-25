<?php 
    session_start();
    include('../inc/connect.php');
    include('inc/check-login.php');
    include('../inc/_fix.php');
    $NavActive = "nhanvien";
    $NavSubActive = "DanhSachNhanVien";

    if(isset($_POST["btn-luu"])){
        $ho = $_POST["ho"];
        $ten = $_POST["ten"];
        $phai = $_POST["phai"];
        $ngaysinh = $_POST["ngaysinh"];
        $chungminhthu = $_POST["chungminhthu"];
        $sodienthoai = $_POST["sodienthoai"];
        $chucvu = $_POST["chucvu"];
        $diachi = $_POST["diachi"];

        $Sql_Update = 'UPDATE nhanvien SET ho="'.$ho.'", ten="'.$ten.'", phai="'.$phai.'", ngaysinh="'.$ngaysinh.'", chungminhthu="'.$chungminhthu.'", sdt="'.$sodienthoai.'", machucvu="'.$chucvu.'", diachi="'.$diachi.'" WHERE manv='.$_GET["manv"];
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
    <title>Chi tiết nhân viên</title>
    <?php include('./inc/link.php'); ?>
</head>

<body>
    <?php include('./inc/page-header.php'); ?>
    <?php include('./inc/menu-left.php'); ?>

    <div class="container-fluid" id="menu-right">
        <div class="row">
            <?php 
                if(!isset($_GET['manv']) || $_GET['manv'] == ''){
                    echo '<script>window.location="nhan-vien.php"</script>';
                }else{
                    $manv = $_GET['manv'];
                    $sql_chi_tiet_nhan_vien = 
                        'SELECT * FROM `nhanvien` JOIN `chucvu`
                        ON nhanvien.machucvu = chucvu.machucvu
                        WHERE nhanvien.manv = "'.$manv.'"';
                    $kq_sql_chi_tiet_nhan_vien = mysqli_query($conn, $sql_chi_tiet_nhan_vien);

                    $row = mysqli_fetch_assoc($kq_sql_chi_tiet_nhan_vien);
                    $macv = $row['machucvu'];
                    $hoten = $row['ho'] . " " . $row['ten'];
                    $diachi = $row['diachi'];
            ?>

            <form id="form-chi-tiet-nhan-vien" method="post" action="">
                <div class="row" id="chi-tiet-nhan-vien">
                    <div class="col-md-12">
                        <h4 style="text-transform:uppercase;">Thông tin nhân viên</h4>
                    </div>

                    <div class="col-md-12">
                        <img src="<?= $row['hinh']; ?>" id="anh-nhan-vien" title="<?= $hoten; ?>" alt="<?= alias($hoten); ?>" onClick="window.open('sua-anh-nhan-vien.php?manv=<?= $_GET["manv"] ?>', '', 'width=400, height=400');">
                        <p>Mã nhân viên: <?= manv($row['manv']); ?></p>
                    </div>

                    <div class="col-md-12 col-lg-6 col-xl-4">
                        <div class="form-group row">
                            <label for="ho" class="col-md-3 col-lg-4 col-xl-4 col-form-label label">Họ:</label>
                            <input type="text" class="form-control col-md-9 col-lg-8 col-xl-8" id="ho" name="ho" value="<?= $row['ho']; ?>">
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-6 col-xl-4">
                        <div class="form-group row">
                            <label for="ten" class="col-md-3 col-lg-4 col-xl-4 col-form-label label">Tên:</label>
                            <input type="text" class="form-control col-md-9 col-lg-8 col-xl-8" id="ten" name="ten" value="<?= $row['ten']; ?>">
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-6 col-xl-4">
                        <div class="form-group row">
                            <label for="phai" class="col-md-3 col-lg-4 col-xl-4 col-form-label label">Phái:</label>
                            <select name="phai" id="phai" class="form-control col-md-9 col-lg-8 col-xl-8">
                                <option value="1" <?= $row['phai']=="1" ? 'selected':'' ?> >Nam</option>
                                <option value="0" <?= $row['phai']=="0" ? 'selected':'' ?> >Nữ</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-6 col-xl-4">
                        <div class="form-group row">
                            <label for="ngaysinh" class="col-md-3 col-lg-4 col-xl-4 col-form-label label">Ngày sinh:</label>
                            <input type="date" class="form-control col-md-9 col-lg-8 col-xl-8" id="ngaysinh" name="ngaysinh" value="<?= $row['ngaysinh']; ?>">
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-6 col-xl-4">
                        <div class="form-group row">
                            <label for="chungminhthu" class="col-md-3 col-lg-4 col-xl-4 col-form-label label">CMT:</label>
                            <input type="text" class="form-control col-md-9 col-lg-8 col-xl-8" id="chungminhthu" name="chungminhthu" value="<?= $row['chungminhthu']; ?>">
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-6 col-xl-4">
                        <div class="form-group row">
                            <label for="sodienthoai" class="col-md-3 col-lg-4 col-xl-4 col-form-label label">Số điện thoại:</label>
                            <input type="text" class="form-control col-md-9 col-lg-8 col-xl-8" id="sodienthoai" name="sodienthoai" value="<?= $row['sdt']; ?>">
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-6 col-xl-4">
                        <div class="form-group row">
                            <label for="chucvu" class="col-md-3 col-lg-4 col-xl-4 col-form-label label">Chức vụ:</label>
                            <select name="chucvu" id="chucvu" class="form-control col-md-9 col-lg-8 col-xl-8">
                            <?php 
                                $sql_chuc_vu = 'SELECT * FROM chucvu';
                                $kq_chuc_vu = mysqli_query($conn, $sql_chuc_vu);

                                while($row = mysqli_fetch_assoc($kq_chuc_vu)){
                                    if($macv != $row['machucvu'])
                                        echo '<option value="'.$row['machucvu'].'">'.$row['tenchucvu'].'</option>';
                                    else
                                    echo '<option value="'.$row['machucvu'].'" selected>'.$row['tenchucvu'].'</option>';
                                }
                            ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-6 col-xl-4">
                        <div class="form-group row">
                            <label for="diachi" class="col-md-3 col-lg-4 col-xl-4 col-form-label label">Địa chỉ:</label>
                            <textarea class="form-control col-md-9 col-lg-8 col-xl-8" id="diachi" name="diachi"><?= $diachi; ?></textarea>
                        </div>
                    </div>

                    <div class="col-md-12 row justify-content-center" id="thongbao">
                        <?= isset($message) ? $message : "" ?>
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-sm btn-primary" id="btn-luu" name="btn-luu">Lưu</button>
                        <button type="button" class="btn btn-sm btn-danger" onClick="XoaNhanVien(<?= $_GET["manv"] ?>);">Xóa nhân viên</button>
                        <button type="button" class="btn btn-sm btn-secondary" onClick="window.location='nhan-vien.php'">Quay lại</button>
                    </div>
                </div>
            </form>

            <?php 
                }
            ?>
        </div>
    </div>
    
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="./js/function.js"></script>   
</body>
</html>