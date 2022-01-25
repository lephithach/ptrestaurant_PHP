<?php 
    session_start();
    include('../inc/connect.php');
    include('inc/check-login.php');
    include('../inc/_fix.php');

    $NavActive = 'BaoCaoDoanhThu';

    if(isset($_POST["btn-xem"])){
        $thang = $_POST["thang"];
        $nam = $_POST["nam"];
    }else{
        $thang = date('m');
        $nam = date('Y');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Báo cáo doanh thu tháng <?= $thang ?> năm <?= $nam ?></title>
    <?php include('./inc/link.php'); ?>
    <style>
        @media print{
            @page{
                size: A4;
                margin: 0;
            }

            body{
                width: 21cm;
                min-height: 29.7cm;
                padding: 2cm;
            }

            *{
                color: #000;
                font-family: Times new roman;
            }

            #menu-left,
            .container-fluid.sticky-top,
            #chon-ngay{
                display: none;
            }

            #menu-right{
                width: 100% !important;
                margin-left: 0;
            }

            #header{
                display: block;
            }

            #header .logo{
                display: block;
                color: #000 !important;
            }

            #title{
                font-weight: bold;
                margin: 1rem 0 !important;
            }

            #ngay{
                display: block;
            }

            #nguoi-lap{
                display: block;
                margin-right: 3rem !important;
            }

            #ten-nguoi-lap{
                margin-top: 5rem;
            }

            .logo{
                font-family: 'Courgette', cursive;
                font-size: 2em;
                color: #000 !important;
                padding: 0;
                text-align: center;
            }
        }
    </style>
</head>

<body>
<?php include('./inc/page-header.php'); ?>
<?php include('./inc/menu-left.php'); ?>

<div class="container-fluid" id="menu-right">
    <div class="row disable" id="header">
        <div class="col-md-12"><span class="logo">PT Restaurant</span></div>
        <div class="col-md-12"><span>123, Võ Thị Sáu, Biên Hòa, Đồng Nai</span></div>
    </div>

    <div class="row" id="title">
        <div class="col-md-12">
            <h4 style="text-transform:uppercase;">Báo cáo doanh thu tháng <?= $thang ?> năm <?= $nam ?></h4>
        </div>
    </div> <!--End div row-->

    <div class="row" id="chon-ngay">
        <div class="col-md-12">
            <form id="form-doanh-thu" method="post" action="">
                <div class="row justify-content-md-center">
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label for="thang" class="col-form-label col-md-4">Tháng</label>
                            
                            <select name="thang" id="thang" class="form-control col-md-8">
                                <?php for($i = 1; $i <= 12; $i++){ ?>
                                    <option value="<?= $i ?>" <?= $i == $thang ? 'selected' : '' ?>><?= $i ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group row">
                            <label for="nam" class="col-form-label col-md-4">Năm</label>
                            
                            <select name="nam" id="nam" class="form-control col-md-8">
                                <?php for($i = date('Y') - 2; $i <= date('Y') + 2; $i++){ ?>
                                    <option value="<?= $i ?>" <?= $i == $nam ? 'selected' : '' ?>><?= $i ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-sm btn-primary" id="btn-xem" name="btn-xem">Xem</button>
                        <button type="button" class="btn btn-sm btn-secondary ml-1" onClick="window.print()">In báo cáo</button>
                    </div>
                </div>
            </form>
        </div>
    </div> <!--End div row-->

    <div class="row">
        <div class="col-md-12 text-right disable" id="ngay">
            Biên Hòa, ngày <?= date('d') ?> tháng <?= date('m') ?> năm <?= date('Y') ?>
        </div>
    </div>  <!--End div row-->
    
    <div class="row">    
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-striped" id="chuc-vu">
                <thead>
                    <tr class="text-center bg-info text-light">
                        <th width="5%" scope="col">#</th>
                        <th width="15%" scope="col">Ngày</th>                                
                        <th width="15%" scope="col">Tổng đơn offline</th>                
                        <th width="15%" scope="col">Tổng đơn online</th>                
                        <th width="15%" scope="col">Tổng tiền</th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                        $sql_lay_danh_sach = 'SELECT ngaylaphd, SUM(tongtien) As tongtien FROM `hoadon` WHERE month(ngaylaphd) = '.$thang.' AND year(ngaylaphd) = '.$nam.' AND tinhtrang = "Đã thanh toán" GROUP BY day(ngaylaphd)';
                        $kq_sql_lay_danh_sach = mysqli_query($conn, $sql_lay_danh_sach);

                        if(mysqli_num_rows($kq_sql_lay_danh_sach)>0){
                            $stt = 1;
                            $cong_offline = 0;
                            $cong_online = 0;
                            $cong_tien = 0;

                            while($row = mysqli_fetch_assoc($kq_sql_lay_danh_sach)){
                                $day = date('d', strtotime($row['ngaylaphd']));

                                $sql_offline = mysqli_query($conn, 'SELECT COUNT(mahd) As donoffline FROM `hoadon` WHERE day(ngaylaphd) = '.$day.' AND month(ngaylaphd) = '.$thang.' AND year(ngaylaphd) = '.$nam.' AND tinhtrang = "Đã thanh toán" AND dononline = 0');
                                $row_offline = mysqli_fetch_assoc($sql_offline);

                                $sql_online = mysqli_query($conn, 'SELECT COUNT(mahd) As dononline FROM `hoadon` WHERE day(ngaylaphd) = '.$day.' AND month(ngaylaphd) = '.$thang.' AND year(ngaylaphd) = '.$nam.' AND tinhtrang = "Đã thanh toán" AND dononline = 1');
                                $row_online = mysqli_fetch_assoc($sql_online);
                    ?>
                                <tr style="line-height:1.7;">
                                    <td><?= $stt++ ?></td>
                                    <td><?= date('d/m/Y', strtotime($row['ngaylaphd'])); ?></td>
                                    <td><?= $row_offline['donoffline']; ?></td>
                                    <td><?= $row_online['dononline']; ?></td>
                                    <td><?= number_format($row['tongtien'], 0, ".", ","); ?></td>
                                </tr>
                    <?php
                                $cong_offline += $row_offline['donoffline'];
                                $cong_online += $row_online['dononline'];
                                $cong_tien += $row['tongtien'];
                            }
                            echo '
                                <tr style="line-height:1.7;">
                                    <td colspan="2">Tổng</td>
                                    <td>'.$cong_offline.'</td>
                                    <td>'.$cong_online.'</td>
                                    <td>'.number_format($cong_tien, 0, ".", ",").'</td>
                                </tr>
                            ';
                        }else{
                            echo'
                                <tr>
                                    <td colspan="5">Không có dữ liệu nào</td>
                                </tr>
                            ';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>  <!--End div row-->

    <div class="row">
        <div class="col-md-12 text-right disable" id="nguoi-lap">
            <div class="row justify-content-end">
                <div class="col-md-md text-center">
                    <p>Người lập</p>
                    <p id="ten-nguoi-lap">Lê Phi Thạch</p>
                </div>
            </div>
        </div>
    </div>   <!--End div row-->
</div>  <!--End div menu right-->

<div id="thongbao"></div>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="./js/function.js"></script>
</body>
</html>