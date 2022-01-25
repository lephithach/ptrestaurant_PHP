<?php 
    session_start();
    include('../inc/connect.php');
    include('inc/check-login.php');
    $NavActive = "monan";
    $NavSubActive = "Thêm món ăn";

    if(isset($_POST['btn-luu'])){
        $tenmon = $_POST['tenmon'];
        $maloai = $_POST['maloai'];
        $dongia = $_POST['dongia'];
    
            // Upload ảnh
            $target_dir = "images/monan/";
			$target_file = $target_dir . strtolower(basename($_FILES["them-anh-mon-an"]["name"]));

			//Upload hình
			$kiemtra = 0;

			$kieufile = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
			$mangkieufile = array('jpg', 'jpeg', 'png');

			if(!in_array($kieufile,$mangkieufile)){
				$message = '<div class="alert alert-warning" role="alert">Chỉ nhận file .jpg, .jpeg, .png</div>';
				$kiemtra = 1;
			}

			//Kiểm tra xem có phải là ảnh
			$check = getimagesize($_FILES["them-anh-mon-an"]["tmp_name"]);
			if(!$check){
				$message = '<div class="alert alert-warning" role="alert">Tập tin không phải hình ảnh</div>';
				$kiemtra = 1;
			}

			//Kiểm tra xem hình có trùng hay không?
			if(file_exists("../" . $target_file)){
				$message = '<div class="alert alert-warning" role="alert">Xin lỗi, tập tin này đã tồn tại trên hệ thống</div>';
				$kiemtra = 1;
			}

			//Kiểm tra dung lượng ảnh
			if($_FILES["them-anh-mon-an"]["size"] > 4194304){
				$message = '<div class="alert alert-warning" role="alert">Vui lòng tải ảnh có dung lượng dưới 4MB</div>';
				$kiemtra = 1;
			}

            if($kiemtra == 0){
                $sql_insert = 'INSERT INTO monan(tenmon, maloai, dongia, hinh) VALUES("'.$tenmon.'", "'.$maloai.'", "'.$dongia.'", "'.$target_file.'")';
                $kq_insert = mysqli_query($conn, $sql_insert);

                if($kq_insert){
                    move_uploaded_file($_FILES["them-anh-mon-an"]["tmp_name"], "../" . $target_file);
                    $message = '<div class="alert alert-success" role="alert">Thêm món thành công</div>';
                }else{
                    $message = '<div class="alert alert-danger" role="alert">Thêm món thất bại</div>';
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
    <title>Thêm món ăn</title>
    <?php include('./inc/link.php'); ?>
    <?php include('../inc/_fix.php'); ?>
</head>

<body>
    <?php include('./inc/page-header.php'); ?>
    <?php include('./inc/menu-left.php'); ?>

    <div class="container-fluid" id="menu-right">
        <div class="row">
            <div class="col-md-12">
                <h4 style="text-transform:uppercase;">Thêm món ăn</h4>
            </div>
        </div>


        <form id="form-them-nhan-vien" method="post" enctype="multipart/form-data" action="">
            <div class="row" id="them-nhan-vien">
                <div class="col-md-12">
                    <div class="row justify-content-center">
                        <div class="col-md-2">                               
                            <img src="./images/them-mon.jpg" alt="anh-mon-an" id="anh-mon-an" width="150px" title="Thêm ảnh" onclick="ThemAnhMonAn();">

                            <div class="custom-file mt-2">
                                <input type="file" class="custom-file-input" accept=".jpg, .jpeg, .png" id="them-anh-mon-an" name="them-anh-mon-an" required>
                                <label class="custom-file-label text-left" for="customFile">Chọn ảnh</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-lg-6 col-xl-4">
                    <div class="form-group row">
                        <label for="tenmon" class="col-md-3 col-lg-4 col-xl-4 col-form-label label">Tên món</label>
                        <input type="text" class="form-control col-md-9 col-lg-8 col-xl-8" id="tenmon" name="tenmon" placeholder="Tên món" autofocus required value="<?= isset($tenmon) ? $tenmon : '' ?>">
                    </div>
                </div>

                <div class="col-md-12 col-lg-6 col-xl-4">
                    <div class="form-group row">
                        <label for="maloai" class="col-md-3 col-lg-4 col-xl-4 col-form-label label">Mã loại</label>
                        <select name="maloai" id="maloai" class="form-control col-md-9 col-lg-8 col-xl-8">
                            <?php 
                                $SQL_maloai = mysqli_query($conn, 'SELECT * FROM loaimon');
                                while($row = mysqli_fetch_assoc($SQL_maloai)){
                            ?>
                                <option value="<?= $row['maloai']; ?>" <?= isset($maloai) && $maloai == $row['maloai'] ? 'selected' : '' ?>><?= $row['tenloai']; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-12 col-lg-6 col-xl-4">
                    <div class="form-group row">
                        <label for="dongia" class="col-md-3 col-lg-4 col-xl-4 col-form-label label">Đơn giá</label>
                        <input type="number" class="form-control col-md-9 col-lg-8 col-xl-8" id="dongia" name="dongia" placeholder="Đơn giá" required value="<?= isset($dongia) ? $dongia : '' ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 row justify-content-center" id="thongbao">
                <?= isset($message) ? $message : "" ?>
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-sm btn-primary" id="btn-luu" name="btn-luu">Lưu</button>
                    <button type="button" class="btn btn-sm btn-secondary" onClick="window.location='mon-an.php'">Quay lại</button>
                </div>
            </div>
        </form>
    </div>
    
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="./js/function.js"></script>
    <script>
        function ThemAnhMonAn(){
            $("#them-anh-mon-an").click();
        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#anh-mon-an').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        
        $("#them-anh-mon-an").change(function() {
            readURL(this);
        });
    </script>
</body>
</html>