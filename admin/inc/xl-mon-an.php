<?php 
    session_start();
    include('../../inc/connect.php');

    if(isset($_GET['action'])){
        switch ($_GET['action']){
            case 'XoaMonAn':
                $mamon = $_POST['mamon'];

                // SQL lấy link hình cũ
                $hinh = mysqli_query($conn, 'SELECT hinh FROM monan WHERE mamon='.$mamon);
                $row = mysqli_fetch_assoc($hinh);
                $hinh = '../../' . $row['hinh'];

                // SQL DELETE
                $sql = 'DELETE FROM monan WHERE mamon='.$mamon;
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