<?php 
    session_start();
    include('../../inc/connect.php');

    if(isset($_GET['action'])){
        switch ($_GET['action']){
            case 'ThemChucVu':
                $machucvu = $_POST['machucvu'];
                $tenchucvu = $_POST['tenchucvu'];
                $sql = 'INSERT INTO `chucvu`(`machucvu`, `tenchucvu`) VALUES("'.$machucvu.'", "'.$tenchucvu.'")';
                $kq = mysqli_query($conn, $sql);

                if($kq){
                    echo '<div class="col-4 alert alert-success" role="alert">
                            Thêm thành công
                        </div>
                    ';
                }else{
                    echo '<div class="col-4 alert alert-danger" role="alert">
                            Thêm thất bại
                        </div>
                    ';
                }
                break;

            case 'CapNhatChucVu':
                $machucvu = $_POST['machucvu'];
                $tenchucvu = $_POST['tenchucvu'];
                $sql = 'UPDATE `chucvu` SET `machucvu` = "'.$machucvu.'"';
                $sql .= ', `tenchucvu` = "'.$tenchucvu.'"';
                $sql .= ' WHERE `machucvu` = "'.$machucvu.'"';
                $kq = mysqli_query($conn, $sql);

                if($kq){
                    echo '<div class="col-4 alert alert-success" role="alert">
                            Cập nhật thành công
                        </div>
                    ';
                }else{
                    echo '<div class="col-4 alert alert-danger" role="alert">
                            Cập nhật thất bại
                        </div>
                    ';
                }
                break;

            case 'XoaChucVu':
                $machucvu = $_POST['machucvu'];
                $sql = 'DELETE FROM `chucvu` WHERE `machucvu` = "'.$machucvu.'"';
                $kq = mysqli_query($conn, $sql);

                if($kq){
                    echo '<script>
                            alert("Xóa thành công");
                            location.reload();
                        </script>
                    ';
                }else{
                    echo '<script>
                            alert("Xóa thất bại");
                        </script>
                    ';
                }
                break;

            case 'KiemTraMaChucVu':
                $machucvu = $_POST['machucvu'];
                $sql = 'SELECT * FROM `chucvu` WHERE `machucvu` = "'.$machucvu.'"';
                $kq = mysqli_query($conn, $sql);

                if(mysqli_num_rows($kq)>0){
                    echo 1;
                }else{
                    echo 0;
                }
                break;

            default: break;
        }
    }
?>