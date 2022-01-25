<?php 
    session_start();
    include('../inc/connect.php');
    include('inc/check-login.php');
    include('./inc/function.php');
    $NavActive = 'gopy';
    
    if(isset($_POST['btn-loc'])){
        //Số dòng cần lọc
        $sodong = $_POST['sodong'];
        if($sodong != '#'){
            $sodonglimit = ' LIMIT '.$sodong;
        }else{
            $sodonglimit = '';
        }

        //Lọc theo loại
        $hinhthuc = $_POST['hinhthuc'];
        if($hinhthuc != '#'){
            $where .= ' AND loai="'.$hinhthuc.'"';
        }else{
            $where = '';
        }

        // Lọc theo sdt
        $sdt = $_POST['sdt'];
        if($sdt != ''){
            $where .= ' AND sdt="'.$sdt.'"';
        }else{
            $where = '';
        }
    }else{
        $sodong = 10;   //Mặc định lọc 10 dòng
        $sodonglimit = ' LIMIT 10';     //Câu query lấy 10 dòng
        $where = '';        //Câu query WHERE
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Góp ý & Khiếu nại</title>    
    <?php include('./inc/link.php'); ?>
</head>
<body>
    <?php include('./inc/page-header.php'); ?>
    <?php include('./inc/menu-left.php'); ?>

    <div class="container-fluid" id="menu-right">
        <div class="row">
            <div class="col-md-12">
                <h4 style="text-transform:uppercase;">Góp ý & Khiếu nại</h4>
            </div>
        </div>

        <form id="form-loc" method="post" action="">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group row">
                        <label for="sodong" class="col-md-4 col-form-label">Số dòng:</label>
                        <select name="sodong" id="sodong" class="col-md-8 form-control">
                            <option value="#" <?= $sodong=="#" ? 'selected' : '' ?>>Tất cả</option>
                            <option value="10" <?= $sodong=="10" ? 'selected' : '' ?>>10</option>
                            <option value="20" <?= $sodong=="20" ? 'selected' : '' ?>>20</option>
                            <option value="50" <?= $sodong=="50" ? 'selected' : '' ?>>50</option>
                            <option value="100" <?= $sodong=="100" ? 'selected' : '' ?>>100</option>
                        </select>
                    </div>
                </div>    
            
                <div class="col-md-4">
                    <div class="form-group row">
                        <label for="hinhthuc" class="col-md-4 col-form-label">Hình thức:</label>
                        <select name="hinhthuc" id="hinhthuc" class="col-md-8 form-control">
                            <option value="#" <?= isset($hinhthuc) && $hinhthuc == '#' ? 'selected' : '' ?>>--Tất cả--</option>
                            <option value="0" <?= isset($hinhthuc) && $hinhthuc == '0' ? 'selected' : '' ?>>Góp ý</option>
                            <option value="1" <?= isset($hinhthuc) && $hinhthuc == '1' ? 'selected' : '' ?>>Khiếu nại</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group row">
                        <label for="sdt" class="col-md-4 col-form-label">SĐT:</label>
                        <input type="text" class="col-md-8 form-control" maxlength="10" placeholder="Số điện thoại khách hàng" id="sdt" name="sdt" value="<?= isset($sdt) ? $sdt : '' ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-sm btn-primary" id="btn-loc" name="btn-loc">Lọc</button>
                </div>
            </div>
        </form>

        <div class="row">
            <div class="table-responsive table-responsive-lg">
                <table class="table table-sm table-bordered table-striped" id="danh-sach-don-hang-online">
                    <thead>
                        <tr class="text-center bg-info text-light">
                            <th width="5%" scope="col">#</th>
                            <th width="15%" scope="col">Họ tên</th>
                            <th width="10%" scope="col">Số điện thoại</th>
                            <th width="15%" scope="col">Email</th>
                            <th width="10%" scope="col">Thời gian</th>
                            <th width="10%" scope="col">Hình thức</th>
                            <th width="30%" scope="col">Nội dung</th>
                            <!-- <th width="5%" scope="col">&nbsp;</th> -->
                        </tr>
                    </thead>

                    <tbody>
                    <?php 
                        $sql_lay_danh_sach_gop_y = 'SELECT * FROM `gopy` WHERE 1'.$where;
                        $sql_lay_danh_sach_gop_y .= ' ORDER BY id DESC '.$sodonglimit;
                        $kq_sql_lay_danh_sach_gop_y = mysqli_query($conn, $sql_lay_danh_sach_gop_y);

                        if(mysqli_num_rows($kq_sql_lay_danh_sach_gop_y)>0){
                            $STT = 1;
                            while($row = mysqli_fetch_assoc($kq_sql_lay_danh_sach_gop_y)){
                                // Xử lý ngày
                                $thoigian = strtotime($row['thoigian']);
                                $thoigian = date('d/m/Y H:i:s', $thoigian);
                    ?>

                        <tr>
                            <td><?= $STT++; ?></td>
                            <td class="text-left"><?= $row['hoten']; ?></td>
                            <td><?= $row['sdt']; ?></td>
                            <td class="text-left"><?= $row['email']; ?></td>
                            <td><?= $thoigian; ?></td>
                            <td><?= $row['loai'] == 0 ? 'Góp ý' : 'Khiếu nại' ?></td>
                            <td class="text-left">
                                <?php 
                                    foreach(explode("\n", $row['noidung']) as $noidung)
                                    echo $noidung.'<br>';
                                ?>
                            </td>
                            <!-- <td>
                                <a href="chi-tiet-gop-y.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-secondary" title="Xem"><i class="bi bi-eye"></i></a>
                            </td> -->
                        </tr>

                    <?php 
                            }
                        }else{
                            echo '<tr><td colspan="10">Không tìm thấy dữ liệu nào</td></tr>';
                        }
                    ?>
                    </tbody>
                </table>
            </div>  <!--End div table danh sách đơn hàng online-->
        </div>  <!--End row-->
    </div>

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="./js/function.js"></script>
</body>
</html>