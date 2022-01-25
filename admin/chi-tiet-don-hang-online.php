<?php 
    session_start();
    include('../inc/connect.php');
    include('inc/check-login.php');
    include('./inc/function.php');
    $NavActive = 'donhang';
    $NavSubActive = 'DanhSachDonHangOnline';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng</title>
    <?php include('./inc/link.php'); ?>
</head>
<body>
    <?php include('./inc/page-header.php'); ?>
    <?php include('./inc/menu-left.php'); ?>

    <?php 
        $mahd = $_GET["mahd"];
        $Sql_LayThongTinHoaDon = 'SELECT `mahd`, `hoadon`.`manv`, `ngaylaphd`, `tenkh`, `hoadon`.`sdt`, `hoadon`.`diachi`, `tongtien`, `chietkhau`, `ghichu`, `tinhtrang`, `nhanvien`.`ho`, `nhanvien`.`ten` FROM `hoadon` JOIN `nhanvien` ON `hoadon`.`manv` = `nhanvien`.`manv` WHERE mahd='.$mahd;
        $Kq_Sql_LayThongTinHoaDon = mysqli_query($conn, $Sql_LayThongTinHoaDon);

        $row = mysqli_fetch_assoc($Kq_Sql_LayThongTinHoaDon);
        $tinhtrang = $row['tinhtrang'];
    ?>

    <div class="container-fluid" id="menu-right">
        <div class="row">
            <div class="col-md-12">
                <h4 style="text-transform:uppercase;">Chi tiết đơn hàng online</h4>
            </div>
        </div>

        <div class="row text-left">
            <div class="col-md-2 py-2">
                <b>Đơn hàng số:</b> <?= $mahd; ?>
            </div>

            <div class="col-md-3 py-2">
                <b>Nhân viên:</b> <?= $row['ho'] . ' ' . $row['ten']; ?>
            </div>

            <div class="col-md-3 py-2">
                <b>Ngày đặt:</b> <?= date('d/m/Y H:i:s', strtotime($row['ngaylaphd'])); ?>
            </div>

            <div class="col-md-3 py-2">
                <b>Khách Hàng:</b> <?= $row['tenkh']; ?>
            </div>

            <div class="col-md-2 py-2">
                <b>SĐT:</b> <?= $row['sdt']; ?>
            </div>

            <div class="col-md-2 py-2">
                <b>Chiết khấu:</b> <?= $row['chietkhau']; ?>%
            </div>

            <div class="col-md-2 py-2">
                <b>Tổng tiền:</b> <?= number_format($row['tongtien'], 0, ".", ","); ?>
            </div>                    

            <div class="col-md-4 py-2">
                <b>Địa chỉ:</b> <?= $row['diachi']; ?>
            </div>

            <div class="col-md-4 py-2">
                <b>Ghi chú:</b> <?= $row['ghichu']; ?>
            </div>

            <div class="col-md-3 py-2">
                <b>Tình trạng:</b> <?= format_tinhtrang($row['tinhtrang']); ?>
            </div>
        </div>

        <div class="row">
            <div class="table-responsive table-responsive-lg">
                <table class="table table-sm table-bordered table-striped" id="chi-tiet-don-hang-online">
                    <thead>
                        <tr class="text-center bg-info text-light">
                            <th width="5%" scope="col">#</th>
                            <th width="25%" scope="col">Tên món</th>
                            <th width="10%" scope="col">SL</th>
                            <th width="15%" scope="col">Đơn giá</th>
                            <th width="15%" scope="col">Thành tiền</th>
                            <th width="10%" scope="col">&nbsp;</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php 
                        $Sql_LayChiTietHoaDon = 'SELECT * FROM `chitiethoadon` JOIN `monan` ON `chitiethoadon`.`mamon` = `monan`.`mamon` WHERE `mahd`='.$mahd;
                        $Kq_Sql_LayChiTietHoaDon = mysqli_query($conn, $Sql_LayChiTietHoaDon);

                        if(mysqli_num_rows($Kq_Sql_LayChiTietHoaDon)>0){
                            $STT = 1;
                            while($row = mysqli_fetch_assoc($Kq_Sql_LayChiTietHoaDon)){
                    ?>

                    <tr>
                        <td><?= $STT++; ?></td>
                        <td class="text-left"><?= $row['tenmon']; ?></td>
                        <td><?= $row['soluong']; ?></td>
                        <td class="text-right"><?= number_format($row['dongia_cthd'], 0, ".", ","); ?></td>
                        <td class="text-right"><?= number_format($row['dongia_cthd'] * $row['soluong'], 0, ".", ","); ?></td>
                        <td>&nbsp;</td>
                    </tr>

                    <?php 
                            }
                        }else{
                            echo '<tr><td colspan="6">Không có món ăn nào trong hóa đơn này</td></tr>';
                        }
                    ?>
                    </tbody>
                </table>
            </div>  <!--End div table danh sách đơn hàng online-->
        </div>

        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-sm btn-secondary" href="javascript:history.back();">Quay lại</a>
                <a class="btn btn-sm btn-success <?= $tinhtrang == 'Đang xử lý' || $tinhtrang == 'Đã thanh toán' ? 'disable' : '' ?>" href="thanh-toan-don-hang.php?mahd=<?= $_GET["mahd"] ?>&dononline=1">Thanh toán</a>
                <a class="btn btn-sm btn-primary" href="bill.php?mahd=<?= $_GET["mahd"] ?>&print=1" target="_blank">In hóa đơn</a>
            </div>
        </div>
    </div>

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="./js/function.js"></script>
</body>
</html>