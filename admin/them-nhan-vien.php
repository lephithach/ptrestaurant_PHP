<?php 
    session_start();
    include('../inc/connect.php');
    include('inc/check-login.php');
    $NavActive = "nhanvien";
    $NavSubActive = "DanhSachNhanVien";

    if(isset($_POST['btn-luu'])){
        $ho = $_POST['ho'];
        $ten = $_POST['ten'];
        $phai = $_POST['phai'];
        $ngaysinh = $_POST['ngaysinh'];
        $chungminhthu = $_POST['chungminhthu'];
        $sodienthoai = $_POST['sodienthoai'];
        $chucvu = $_POST['chucvu'];
        $diachi = $_POST['diachi'];
    
            // Upload ảnh
            $target_dir = "images/AnhNhanVien/";
			$target_file = $target_dir . strtolower(basename($_FILES["them-avatar-nhan-vien"]["name"]));

			//Upload hình
			$kiemtra = 0;

			$kieufile = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
			$mangkieufile = array('jpg', 'jpeg', 'png');

			if(!in_array($kieufile,$mangkieufile)){
				$message = '<div class="alert alert-warning" role="alert">Chỉ nhận file .jpg, .jpeg, .png</div>';
				$kiemtra = 1;
			}

			//Kiểm tra xem có phải là ảnh
			$check = getimagesize($_FILES["them-avatar-nhan-vien"]["tmp_name"]);
			if(!$check){
				$message = '<div class="alert alert-warning" role="alert">Tập tin không phải hình ảnh</div>';
				$kiemtra = 1;
			}

			//Kiểm tra xem hình có trùng hay không?
			if(file_exists($target_file)){
				$message = '<div class="alert alert-warning" role="alert">Xin lỗi, tập tin này đã tồn tại trên hệ thống</div>';
				$kiemtra = 1;
			}

			//Kiểm tra dung lượng ảnh
			if($_FILES["them-avatar-nhan-vien"]["size"] > 1048576){
				$message = '<div class="alert alert-warning" role="alert">Vui lòng tải ảnh có dung lượng dưới 1MB</div>';
				$kiemtra = 1;
			}

            if($kiemtra == 0){
                $sql_insert = 'INSERT INTO nhanvien(ho, ten, phai, ngaysinh, chungminhthu, sdt, diachi, hinh, machucvu) VALUES("'.$ho.'", "'.$ten.'", "'.$phai.'", "'.$ngaysinh.'", "'.$chungminhthu.'", "'.$sodienthoai.'", "'.$diachi.'", "'.$target_file.'", "'.$chucvu.'")';
                $kq_insert = mysqli_query($conn, $sql_insert);

                if($kq_insert){
                    move_uploaded_file($_FILES["them-avatar-nhan-vien"]["tmp_name"], $target_file);
                    $message = '<div class="alert alert-success" role="alert">Thêm nhân viên thành công</div>';
                }else{
                    $message = '<div class="alert alert-danger" role="alert">Thêm nhân viên thất bại</div>';
                }
            }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm nhân viên</title>
    <?php include('./inc/link.php'); ?>
    <?php include('../inc/_fix.php'); ?>
    <style>
        .label{
            text-align: left;
        }
    </style>
</head>

<body>
    <?php include('./inc/page-header.php'); ?>
    <?php include('./inc/menu-left.php'); ?>

    <div class="container-fluid" id="menu-right">
        <div class="row">
            <div class="col-md-12">
                <h4 style="text-transform:uppercase;">Thêm nhân viên</h4>
            </div>
        </div>

        <form id="form-them-nhan-vien" method="post" enctype="multipart/form-data" action="">
            <div class="row" id="them-nhan-vien">
                <div class="col-md-12">
                    <div class="row justify-content-center">
                        <div class="col-md-2">                               
                            <img src="./images/avatar.jpg" alt="anh-nhan-vien" id="anh-nhan-vien" title="Thay ảnh" onclick="ThemAvatarNhanVien();">

                            <div class="custom-file mt-2">
                                <input type="file" class="custom-file-input" accept=".jpg, .jpeg, .png" id="them-avatar-nhan-vien" name="them-avatar-nhan-vien" required>
                                <label class="custom-file-label text-left" for="customFile">Chọn ảnh</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-lg-6 col-xl-4">
                    <div class="form-group row">
                        <label for="ho" class="col-md-3 col-lg-4 col-xl-4 col-form-label label">Họ:</label>
                        <input type="text" class="form-control col-md-9 col-lg-8 col-xl-8" id="ho" name="ho" placeholder="Họ" autofocus required value="<?= isset($ho) ? $ho : '' ?>">
                    </div>
                </div>

                <div class="col-md-12 col-lg-6 col-xl-4">
                    <div class="form-group row">
                        <label for="ten" class="col-md-3 col-lg-4 col-xl-4 col-form-label label">Tên:</label>
                        <input type="text" class="form-control col-md-9 col-lg-8 col-xl-8" id="ten" name="ten" placeholder="Tên" required value="<?= isset($ten) ? $ten : '' ?>">
                    </div>
                </div>

                <div class="col-md-12 col-lg-6 col-xl-4">
                    <div class="form-group row">
                        <label for="phai" class="col-md-3 col-lg-4 col-xl-4 col-form-label label">Phái:</label>
                        <select name="phai" id="phai" class="form-control col-md-9 col-lg-8 col-xl-8">
                            <option value="1" value="<?= isset($phai) && $phai == 1 ? 'selected' : '' ?>">Nam</option>
                            <option value="0" value="<?= isset($phai) && $phai == 0 ? 'selected' : '' ?>">Nữ</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-12 col-lg-6 col-xl-4">
                    <div class="form-group row">
                        <label for="ngaysinh" class="col-md-3 col-lg-4 col-xl-4 col-form-label label">Ngày sinh:</label>
                        <input type="date" class="form-control col-md-9 col-lg-8 col-xl-8" id="ngaysinh" name="ngaysinh" required value="<?= isset($ngaysinh) ? $ngaysinh : '' ?>">
                    </div>
                </div>

                <div class="col-md-12 col-lg-6 col-xl-4">
                    <div class="form-group row">
                        <label for="chungminhthu" class="col-md-3 col-lg-4 col-xl-4 col-form-label label">CMT:</label>
                        <input type="text" class="form-control col-md-9 col-lg-8 col-xl-8" maxlength="12" id="chungminhthu" name="chungminhthu" placeholder="Chứng minh thư" required value="<?= isset($chungminhthu) ? $chungminhthu : '' ?>">
                    </div>
                </div>

                <div class="col-md-12 col-lg-6 col-xl-4">
                    <div class="form-group row">
                        <label for="sodienthoai" class="col-md-3 col-lg-4 col-xl-4 col-form-label label">SĐT:</label>
                        <input type="text" class="form-control col-md-9 col-lg-8 col-xl-8" maxlength="10" id="sodienthoai" name="sodienthoai" placeholder="Số điện thoại" required value="<?= isset($sodienthoai) ? $sodienthoai : '' ?>">
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
                                if($row['machucvu'] == 'NV' || isset($chucvu) == $row['machucvu'])
                                    echo '<option value="'.$row['machucvu'].'" selected>'.$row['tenchucvu'].'</option>';
                                else
                                    echo '<option value="'.$row['machucvu'].'">'.$row['tenchucvu'].'</option>';
                            }
                        ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-12 col-lg-6 col-xl-4">
                    <div class="form-group row">
                        <label for="diachi" class="col-md-3 col-lg-4 col-xl-4 col-form-label label">Địa chỉ:</label>
                        <textarea class="form-control col-md-9 col-lg-8 col-xl-8" id="diachi" name="diachi" placeholder="Địa chỉ" required><?= isset($diachi) ? $diachi : '' ?></textarea>
                    </div>
                </div>
            </div>


                <div class="col-md-12 row justify-content-center" id="thongbao">
                <?= isset($message) ? $message : "" ?>
                </div>

            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-sm btn-primary" id="btn-luu" name="btn-luu">Lưu</button>
                    <button type="button" class="btn btn-sm btn-secondary" onClick="window.location='nhan-vien.php'">Quay lại</button>
                </div>
            </div>
        </form>


                </div>  <!--End div row menu-right-->
            </div>      <!--End div menu-right-->
        </div>
    </div>
    
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="./js/function.js"></script>        
</body>
</html>