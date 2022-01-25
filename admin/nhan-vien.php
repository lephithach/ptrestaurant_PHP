<?php 
    session_start();
    include('../inc/connect.php');
    include('inc/check-login.php');
    $NavActive = "nhanvien";
    $NavSubActive = "DanhSachNhanVien";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách nhân viên</title>
    <?php include('./inc/link.php'); ?>
    <?php include('../inc/_fix.php'); ?>
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
                <h4 style="text-transform:uppercase;">Danh sách nhân viên</h4>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <a href="them-nhan-vien.php" class="btn btn-sm btn-primary">Thêm nhân viên</a>
            </div>
        </div>
        
        <div class="row">
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped" id="nhan-vien">
                    <thead>
                        <tr class="text-center bg-info text-light">
                            <th width="5%" scope="col">#</th>
                            <th width="10%" scope="col">Mã NV</th>
                            <th width="15%" scope="col">Họ</th>
                            <th width="10%" scope="col">Tên</th>
                            <th width="10%" scope="col">Phái</th>
                            <th width="15%" scope="col">Ngày sinh</th>
                            <th width="15%" scope="col">Chức vụ</th>
                            <th width="15%" scope="col">&nbsp;</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php 
                            $sql_lay_dsnv = 'SELECT * FROM `nhanvien` JOIN `chucvu` ON nhanvien.machucvu = chucvu.machucvu';
                            $kq_sql_lay_dsnv = mysqli_query($conn, $sql_lay_dsnv);

                            if(mysqli_num_rows($kq_sql_lay_dsnv)>0){
                                $stt = 1;
                                while($row = mysqli_fetch_assoc($kq_sql_lay_dsnv)){                                                
                                    $ngaysinh = strtotime($row['ngaysinh']);
                                    $ngaysinh = date('d/m/Y', $ngaysinh);
                        ?>
                                    <tr style="line-height:1.7;">
                                        <td><?= $stt++; ?></td>
                                        <td><?= manv($row['manv']); ?></td>
                                        <td class="text-left"><?= $row['ho']; ?></td>
                                        <td><?= $row['ten']; ?></td>
                                        <td><?= $row['phai']==1 ? 'Nam' : 'Nữ' ?></td>
                                        <td><?= $ngaysinh; ?></td>
                                        <td><?= $row['tenchucvu']; ?></td>
                                        <td>
                                            <a href="chi-tiet-nhan-vien.php?manv=<?= $row['manv']; ?>" class="btn btn-sm btn-outline-secondary" title="Xem nhân viên"><i class="bi bi-eye"></i></a>
                                            <a href="the-nhan-vien.php?manv=<?= $row['manv']; ?>" target="_blank" class="btn btn-sm btn-outline-info" title="In thẻ nhân viên"><i class="bi bi-printer"></i></a>
                                        </td>
                                    </tr>
                        <?php
                                }
                            }else{
                                echo'
                                    <tr>
                                        <td colspan="8">Không có nhân viên nào trong danh sách</td>
                                    </tr>
                                ';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>  <!--End row table nhân viên-->
    </div> <!--End div menu right-->

    
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="./js/function.js"></script>    
</body>
</html>