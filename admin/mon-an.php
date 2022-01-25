<?php 
    session_start();
    include('../inc/connect.php');
    include('inc/check-login.php');
    include('../inc/_fix.php');
    $NavActive = "monan";    

    if(isset($_POST['btn-loc'])){
        //Số dòng cần lọc
        $sodong = $_POST['sodong'];
        if($sodong != '#'){
            $sodonglimit = ' LIMIT '.$sodong;
        }else{
            $sodonglimit = '';
        }

        //Lọc theo loại
        $loai = $_POST['loai'];
        if($loai != '#'){
            $whereloai = ' WHERE loaimon.maloai="'.$loai.'"';
        }else{
            $whereloai = '';
        }

        // Lọc theo tên
        if(isset($_POST['ten'])){
            $ten = $_POST['ten'];
        }

        if(isset($ten) && $ten != '' && $loai == '#'){
            $whereloai .= ' WHERE monan.tenmon LIKE "%'.$ten.'%"';
        }else{
            $whereloai .= '';
        }
    }else{
        $sodong = 10;   //Mặc định lọc 10 dòng
        $sodonglimit = ' LIMIT 10';     //Câu query lấy 10 dòng
        $whereloai = '';        //Câu query WHERE
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Món ăn</title>
    <?php include('./inc/link.php'); ?>
</head>

<body>
    <?php include('./inc/page-header.php'); ?>
    <?php include('./inc/menu-left.php'); ?>

    <div class="container-fluid" id="menu-right">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-uppercase">Danh sách món ăn</h4>
            </div>
        </div>

        <form id="form-loc" method="post" action="">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group row">
                        <label for="sodong" class="col-md-4 col-form-label">Số dòng:</label>
                        <select name="sodong" id="sodong" class="col-md-8 form-control">
                            <option value="#" <?= $sodong=="all" ? 'selected' : '' ?>>Tất cả</option>
                            <option value="10" <?= $sodong=="10" ? 'selected' : '' ?>>10</option>
                            <option value="20" <?= $sodong=="20" ? 'selected' : '' ?>>20</option>
                            <option value="50" <?= $sodong=="50" ? 'selected' : '' ?>>50</option>
                            <option value="100" <?= $sodong=="100" ? 'selected' : '' ?>>100</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group row">
                        <label for="loai" class="col-md-4 col-form-label">Loại:</label>
                        <select name="loai" id="loai" class="col-md-8 form-control" onChange="DisableTen(this.value);">
                        <?php 
                            $sql_lay_loai_mon_an = 'SELECT * FROM `loaimon`';
                            $kq_lay_loai_mon_an = mysqli_query($conn, $sql_lay_loai_mon_an);

                            if(mysqli_num_rows($kq_lay_loai_mon_an)>0){
                                echo '<option value="#">--Chọn--</option>';
                                while($row = mysqli_fetch_assoc($kq_lay_loai_mon_an)){
                                    if($loai != $row['maloai'])
                                        echo '<option value="'.$row['maloai'].'">'.$row['tenloai'].'</option>';
                                    else
                                        echo '<option value="'.$row['maloai'].'" selected>'.$row['tenloai'].'</option>';
                                }
                            }else{
                                echo '<option value="#">----</option>';
                            }
                        ?>                                        
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group row">
                        <label for="ten" class="col-md-4 col-form-label">Tên:</label>
                        <input type="text" class="col-md-8 form-control" placeholder="Nhập tên món ăn" id="ten" name="ten" value="<?= isset($ten) ? $ten : '' ?>" <?= isset($loai) && $loai != '#' ? 'disabled' : '' ?>>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-sm btn-primary" id="btn-loc" name="btn-loc">Lọc</button>
                    <a href="them-mon-an.php" class="btn btn-sm btn-secondary">Thêm món ăn</a>
                </div>
            </div>
        </form>

        <div class="row">
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped" id="mon-an">
                    <thead>
                        <tr class="text-center bg-info text-light">
                            <th width="5%" scope="col">#</th>
                            <th width="10%" scope="col">Mã món</th>
                            <th width="30%" scope="col">Tên món</th>
                            <th width="10%" scope="col">Đơn giá</th>
                            <th width="15%" scope="col">Loại món</th>
                            <th width="10%" scope="col">Ảnh</th>
                            <th width="15%" scope="col">&nbsp;</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php 
                        $sql_lay_mon_an = 'SELECT * FROM `monan` JOIN `loaimon` ON monan.maloai = loaimon.maloai';
                        $sql_lay_mon_an .= $whereloai;
                        $sql_lay_mon_an .= ' ORDER BY monan.mamon asc'.$sodonglimit;
                        $kq_lay_mon_an = mysqli_query($conn, $sql_lay_mon_an);

                        if(mysqli_num_rows($kq_lay_mon_an)>0){
                            $stt = 0;
                            while($row = mysqli_fetch_assoc($kq_lay_mon_an)){
                                $stt++;
                    ?>

                        <tr style="line-height:1.7;">
                            <td><?= $stt; ?></td>
                            <td><?= $row['mamon']; ?></td>
                            <td class="text-left"><?= $row['tenmon']; ?></td>
                            <td><?= number_format($row['dongia'],0,".",","); ?></td>
                            <td><?= $row['tenloai']; ?></td>
                            <td><img src="<?= "../".$row['hinh']; ?>" width="15%" alt="<?= alias($row['tenmon']); ?>"></td>
                            <td><a href="chi-tiet-mon-an.php?mamon=<?= $row['mamon']; ?>" class="btn btn-sm btn-outline-secondary" title="Xem món ăn"><i class="bi bi-eye"></i></a></td>
                        </tr>
                            
                    <?php
                            }
                        }else{

                        }
                    ?>
                    </tbody>
                </table>
            </div>  <!--End div table-->
        </div>  <!--End row table-->
    </div>
    
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="./js/function.js"></script>
    <script>
        function DisableTen(maloai){
            if(maloai != '#'){
                $("#ten").prop("disabled", true);
                $("#ten").val("");
            }
            else{
                $("#ten").prop("disabled", false);
            }
        }
    </script>
</body>
</html>