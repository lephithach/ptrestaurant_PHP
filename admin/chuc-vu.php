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
    <title>Chức vụ</title>
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
        <div class="row">
            <div class="col-md-12">
                <h4 style="text-transform:uppercase;">Danh sách chức vụ</h4>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12 my-2">
                <a href="them-chuc-vu.php" class="btn btn-sm btn-primary">Thêm chức vụ</a>
            </div>
        </div>

        <div class="row">
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped" id="chuc-vu">
                    <thead>
                        <tr class="text-center bg-info text-light">
                            <th width="5%" scope="col">#</th>
                            <th width="10%" scope="col">Mã CV</th>
                            <th width="15%" scope="col">Tên CV</th>                                        
                            <th width="15%" scope="col">Tổng số NV</th>                                        
                            <th width="15%" scope="col">&nbsp;</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php 
                            $sql_lay_dscv = 'SELECT * FROM `chucvu`';
                            $kq_sql_lay_dscv = mysqli_query($conn, $sql_lay_dscv);                                            

                            if(mysqli_num_rows($kq_sql_lay_dscv)>0){
                                $stt = 1;
                                while($row = mysqli_fetch_assoc($kq_sql_lay_dscv)){
                                    $sql_dem_so_nv = 'SELECT COUNT(*) AS `sonv` FROM `nhanvien` WHERE `machucvu` = "'.$row['machucvu'].'"';
                                    $kq_sql_dem_so_nv = mysqli_query($conn, $sql_dem_so_nv);
                                    $row_sonv = mysqli_fetch_assoc($kq_sql_dem_so_nv);                                                
                        ?>
                                    <tr style="line-height:1.7;">
                                        <td><?= $stt++ ?></td>
                                        <td><?= $row['machucvu']; ?></td>
                                        <td><?= $row['tenchucvu']; ?></td>
                                        <td><?= $row_sonv['sonv']; ?></td>
                                        <td>
                                            <a href="chi-tiet-chuc-vu.php?machucvu=<?= $row['machucvu']; ?>" class="btn btn-sm btn-outline-secondary">Sửa</a>
                                            <!-- <a href="" class="btn btn-sm btn-outline-info">Xóa</a> -->
                                            <button type="button" class="btn btn-sm btn-outline-info" onClick="XoaChucVu('<?= $row['machucvu']; ?>');">Xóa</button>
                                        </td>
                                    </tr>
                        <?php
                                }
                            }else{
                                echo'
                                    <tr>
                                        <td colspan="8">Không có chức vụ nào</td>
                                    </tr>
                                ';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>  <!--End row table chức vụ-->
    </div>  <!--End div menu right-->

    <div id="thongbao"></div>
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="./js/function.js"></script>   
</body>
</html>