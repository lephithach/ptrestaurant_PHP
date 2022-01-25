<?php
    session_start();
    include('../inc/connect.php');
    include('./inc/check-login.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Hóa đơn thanh toán</title>
<link href="../css/bootstrap.css" type="text/css" rel="stylesheet">
<link href="../css/main.css" type="text/css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" type="text/css" rel="stylesheet">
<?php include('./inc/link.php'); ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Courgette&display=swap');

    *{margin:0; padding: 0; font-family: 'Roboto', sans-serif;}

    body{
        width: 8cm !important;
        height: auto !important;
    }
    
    #wrapper-bill{
        width: 8cm;
        height: auto;
        font-size: 13px;
        line-height: 1.5;
        border: 1px solid rgba(0, 0, 0, 0.1);
        padding: 1cm 0.2cm;
        margin: 1cm;
    }

    .logo{
        font-family: 'Courgette', cursive;
        font-size: 2em;
        color: #28a745 !important;
    }

    #wrapper-bill #dia-chi{
        font-size: 12px;
        text-align: center;
        line-height: 0.4;
    }

    #wrapper-bill #hoa-don-thanh-toan{
        text-transform: uppercase;
        text-align: center;
        margin-top: 0.4cm;
        margin-bottom: 0.2cm;
        font-weight: bold;
        font-size: 14px;
    }

    #wrapper-bill #thong-tin-hoa-don{
        display: flex;
        flex-direction: column;
        font-size: 12px;
    }

    table{
        margin: 10px 0;
    }

    table thead{
        font-size: 13px;
    }

    table tbody{
        font-size: 12px;
    }

    table tbody .ten-mon{
        text-align: left;
        padding-left: 0.1cm;
    }

    .group-tien,
    .group-chiet-khau{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        margin-top: 2px;
    }
    .group-tien .tien,
    .group-chiet-khau .tien{
        font-weight: bold;
        font-size: 15px;
    }

    .group-tien .tien::after{
        content: ' VND';
        font-size: 11px;
    }

    .group-chiet-khau .tien::after{
        content: ' %';
        font-size: 11px;
    }

    .cam-on{
        display: block;
        text-align: center;
        margin-top: 0.2cm;
    }

    footer img{
        display: block;
        width: 2cm;
        height: 2cm;
        margin: 0 auto;
    }

    @media print{
        @page{ 
            size: 80mm auto portrait !important;
        }
        body{
            width: 80mm;
            max-width: 80mm;
            height: auto;
            margin: 0;
        }
    }
</style>
</head>
<body>
    <?php 
        if(isset($_GET["mahd"])){
            $mahd = $_GET["mahd"];
        }else{
            header('location:./');
        }

        $sql_lay_ten_hd = 'SELECT * FROM `hoadon` WHERE mahd = '.$mahd;
        $kq_sql_lay_ten_hd = mysqli_query($conn, $sql_lay_ten_hd);

        if(mysqli_num_rows($kq_sql_lay_ten_hd) == 0){
            header('location:./'); exit;
        }
        $row = mysqli_fetch_assoc($kq_sql_lay_ten_hd);

        $manv = $row['manv'];
        $ngaylaphd = strtotime($row['ngaylaphd']);
        $ngaylaphd = date("d/m/Y", $ngaylaphd);
        $soban = $row['soban'];
        $giovao = $row['giovao'];
        $giora = $row['giora'];
        $tenkh = $row['tenkh'];
        $sdt = $row['sdt'];
        $diachi = $row['diachi'];
        $chietkhau = $row['chietkhau'];
        $vat = $row['vat'];
        $khachdua = $row['khachdua'];
        $trakhach = $row['trakhach'];
        $tongtien = $row['tongtien'];
        $dononline = $row['dononline'];
        $tinhtrang = $row['tinhtrang'];
        
        $QR_code_link = 'Hóa đơn số: ' . $mahd . ' - Tổng tiền: ' . number_format($tongtien, 0, ".", ",") . ' - Tình trạng: ' . $tinhtrang;

        $lay_ten_nv = mysqli_query($conn, 'SELECT `ho`, `ten` FROM `nhanvien` WHERE `manv`='.$manv);
        $row_nv = mysqli_fetch_assoc($lay_ten_nv);
        $hotennv = $row_nv['ho'] . ' ' . $row_nv['ten'];
    ?>
    <div id="wrapper-bill">
        <header>
            <div id="logo" class="text-center"><span class="logo">PT Restaurant</span></div>
            <div id="dia-chi"><span>123, Võ Thị Sáu, Biên Hòa, Đồng Nai</span></div>
            <div id="hoa-don-thanh-toan"><span>Hóa đơn thanh toán</span></div>
            <div id="thong-tin-hoa-don">
                <span><b>Hóa đơn số:</b> <?= $mahd; ?></span>
            <?php
                if($dononline != 1){
            ?>
                <span><b>Bàn số:</b> <?= $soban; ?></span>
            <?php } ?>

                <span><b>Ngày lập:</b> <?= $ngaylaphd; ?> (<?= $giovao; ?> - <?= $giora; ?>)</span>
            <?php
                if($dononline == 1){
            ?>
                <span><b>Khách hàng:</b> <?= $tenkh; ?></span>
                <span><b>SĐT:</b> <?= $sdt; ?></span>
                <span><b>Địa chỉ:</b> <?= $diachi; ?></span>
            <?php } ?>
                <span><b>Thu ngân:</b> <?= $hotennv; ?></span>
            </div>
        </header>

        <div id="content">
            <table class="table table-sm" style="text-align: center;">
                <thead>
                    <tr>
                        <th width="20px">#</th>
                        <th width="100px">Tên món</th>
                        <th width="40px">Đ.Giá</th>
                        <th width="20px">SL</th>
                        <th width="40px">Th.Tiền</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        $sql = 'SELECT chitiethoadon.mamon, dongia_cthd, monan.mamon, monan.tenmon, monan.maloai, SUM(chitiethoadon.soluong) As soluong FROM chitiethoadon JOIN monan ON monan.mamon = chitiethoadon.mamon WHERE mahd = '.$mahd.' GROUP BY chitiethoadon.mamon, dongia_cthd, monan.mamon, monan.tenmon, monan.maloai';
                        $lay_chi_tiet_hd = mysqli_query($conn, $sql);
                        $stt = 1;
                        $cong = 0;
                        while($row_cthd = mysqli_fetch_assoc($lay_chi_tiet_hd)){

                    ?>
                    <tr>
                        <td><?= $stt++; ?></td>
                        <td class="ten-mon"><?= $row_cthd['tenmon']; ?></td>
                        <td class="text-right"><?= number_format($row_cthd['dongia_cthd'], 0, ".", ","); ?></td>
                        <td><?= $row_cthd['soluong']; ?></td>
                        <td class="text-right"><?= number_format($row_cthd['soluong'] * $row_cthd['dongia_cthd'], 0, ".", ","); ?></td>
                    </tr>
                        
                    <?php
                        
                        $cong += $row_cthd['soluong'] * $row_cthd['dongia_cthd'];
                        } //End While

                        echo '
                            <tr>
                                <td colspan="4" class="font-weight-bold text-left">Cộng</td>
                                <td class="text-right">'.number_format($cong, 0, ".", ",").'</td>
                            </tr>
                        ';
                    ?>
                </tbody>
            </table>

        <?php if($dononline != 1) {?>
            <div id="vat" class="group-tien">
                <span>VAT:</span>
                <span class="tien"><?= number_format($vat, 0, ".", ","); ?></span>
            </div>
        <?php } ?>

            <div id="chiet-khau" class="group-chiet-khau">
                <span>Chiết khấu:</span>
                <span class="tien"><?= number_format($chietkhau, 0, ".", ","); ?></span>
            </div>

            <div id="tong-tien" class="group-tien">
                <span>Tổng tiền:</span>
                <span class="tien"><?= number_format($tongtien, 0, ".", ","); ?></span>
            </div>

            <hr>

            <div id="khach-dua" class="group-tien">
                <span>Khách đưa:</span>
                <span class="tien"><?= number_format($khachdua, 0, ".", ","); ?></span>
            </div> 

            <div id="tra-khach" class="group-tien">
                <span>Trả khách:</span>
                <span class="tien"><?= number_format($trakhach, 0, ".", ","); ?></span>
            </div>                     
            <hr>          
            
        </div>
        
        <footer>
            <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?= $QR_code_link ?>&choe=UTF-8" alt="QR-Code">

            <span class="cam-on">Cảm ơn quý khách đã sử dụng dịch vụ!<br>Hẹn gặp lại quý khách.</span>
    
            <p class="text-center font-weight-bold mt-3">Sản phẩm của Lê Phi Thạch</p>
        </footer>
    </div>

    <script src="../js/jquery.js" type="text/javascript"></script>
    <script src="../js/bootstrap.js" type="text/javascript"></script>
    <?php 
        if(isset($_GET["print"]) && $_GET["print"] == 1){
            echo '<script>window.print();</script>';
        }
    ?>
</body>
</html>