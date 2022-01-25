<?php 
    session_start();
    include('../../inc/connect.php');

    if(isset($_GET['action'])){
        switch ($_GET['action']){
            case 'XoaNhanVien':
                $manv = $_POST['manv'];

                // SQL lấy link hình cũ
                $hinh = mysqli_query($conn, 'SELECT hinh FROM nhanvien WHERE manv='.$manv);
                $row = mysqli_fetch_assoc($hinh);
                $hinh = '../' . $row['hinh'];

                // SQL DELETE
                $sql = 'DELETE FROM nhanvien WHERE manv='.$manv;
                $kq = mysqli_query($conn, $sql);

                if($kq){
                    unlink($hinh);
                    echo json_encode(array(
                        'status' => 1,
                        'message' => '<div class="col-4 alert alert-success" role="alert">Xóa thành công</div>'
                    ));
                }else{
                    echo json_encode(array(
                        'status' => 0,
                        'message' => '<div class="col-4 alert alert-danger" role="alert">Xóa thất bại</div>'
                    ));
                }
                break;

            default: break;
        }
    }
?>