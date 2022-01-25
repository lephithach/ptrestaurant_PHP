<?php 
    session_start();
    include('../inc/connect.php');
    include('inc/check-login.php');

    if(isset($_POST['btn-luu'])){
        // Upload ảnh
        $target_dir = "images/monan/";
        $target_file = $target_dir . strtolower(basename($_FILES["them-anh-san-pham"]["name"]));

        //Upload hình
        $kiemtra = 0;

        $kieufile = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $mangkieufile = array('jpg', 'jpeg', 'png');

        if(!in_array($kieufile,$mangkieufile)){
            $message = '<div class="alert alert-warning" role="alert">Chỉ nhận file .jpg, .jpeg, .png</div>';
            $kiemtra = 1;
        }

        //Kiểm tra xem có phải là ảnh
        $check = getimagesize($_FILES["them-anh-san-pham"]["tmp_name"]);
        if(!$check){
            $message = '<div class="alert alert-warning" role="alert">Tập tin không phải hình ảnh</div>';
            $kiemtra = 1;
        }

        $sql_hinh = 'SELECT hinh FROM monan WHERE mamon='.$_GET["mamon"];
        $kq_hinh = mysqli_query($conn, $sql_hinh);

        $row = mysqli_fetch_assoc($kq_hinh);

        //Gỡ hình cũ trong máy
        if(file_exists($row['hinh'])){
            unlink($row['hinh']);
        }

        //Kiểm tra xem hình có trùng hay không?
        // if(file_exists($target_file)){
        //     $message = '<div class="alert alert-warning" role="alert">Xin lỗi, tập tin này đã tồn tại trên hệ thống</div>';
        //     $kiemtra = 1;
        // }

        //Kiểm tra dung lượng ảnh
        if($_FILES["them-anh-san-pham"]["size"] > 4194304){
            $message = '<div class="alert alert-warning" role="alert">Vui lòng tải ảnh có dung lượng dưới 4MB</div>';
            $kiemtra = 1;
        }

        if($kiemtra == 0){
            $sql_update = 'UPDATE monan SET hinh="'.$target_file.'" WHERE mamon='.$_GET["mamon"];
            $kq_update = mysqli_query($conn, $sql_update);

            if($kq_update){
                move_uploaded_file($_FILES["them-anh-san-pham"]["tmp_name"], '../' . $target_file);
                $message = '<div class="alert alert-success" role="alert">Cập nhật thành công</div>';
            }else{
                $message = '<div class="alert alert-danger" role="alert">Cập nhật thất bại</div>';
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
    <title>Sửa ảnh sản phẩm</title>
    <?php include('./inc/link.php'); ?>
</head>

<body>
    <style>
        #anh-san-pham{
            max-width: 4cm;
            max-height: 4cm;
            cursor: pointer;
        }

        #anh-san-pham:hover{
            border: 2px solid #2af598;
        }
    </style>

    <div class="container">
        <form id="form-sua-anh-san-pham" method="post" enctype="multipart/form-data" action="">
        <div class="row justify-content-center">
            <div class="col-xs-12 text-center">
            <?php 
                $sql = mysqli_query($conn, 'SELECT `hinh` FROM `monan` WHERE mamon='. $_GET["mamon"]);
                $row = mysqli_fetch_assoc($sql);
            ?>        
                <img src="../<?= $row['hinh'] ?>" alt="anh-san-pham" id="anh-san-pham" title="Thay ảnh" onclick="ThemAnhSanPham();">

                <div class="custom-file mt-2">
                    <input type="file" class="custom-file-input" accept=".jpg, .jpeg, .png" id="them-anh-san-pham" name="them-anh-san-pham" required>
                    <label class="custom-file-label text-left" for="customFile">Chọn ảnh</label>
                </div>                
            </div>

            <div class="col-md-12 justify-content-center" id="thongbao">
                <?= isset($message) ? $message : "" ?>
            </div>

            <div class="col-xs-12 my-2">
                <button type="submit" class="btn btn-sm btn-primary" id="btn-luu" name="btn-luu">Lưu</button>
            </div>
        </div>
        </form>
    </div>

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="./js/function.js"></script>
    <script>
        function ThemAnhSanPham(){
            $("#them-anh-san-pham").click();
        }

        // Avatar trang thêm NV
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#anh-san-pham').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        
        $("#them-anh-san-pham").change(function() {
            readURL(this);
        });
    </script>
</body>
</html>