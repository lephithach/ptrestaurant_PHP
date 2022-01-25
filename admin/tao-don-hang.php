<?php 
    session_start();
    include('../inc/connect.php');
    include('inc/check-login.php');
    $NavActive = 'donhang';
    $NavSubActive = 'TaoDonHang';
    $CapNhatDonHang = false;
    $btn_update_bill = false;
    $btn_pay_bill = false;
    $TongTienHoaDonCu = 0;

    if (!isset($_SESSION['giohang'])) {
        $_SESSION['giohang'] = array();
    }

    if(!isset($_GET["soban"])) header("location:trang-thai-ban.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo đơn hàng</title>
    <?php include('./inc/link.php'); ?>
    <style>
        .tung-mon{
            padding: 0;
            margin: 0.8rem;
            cursor: pointer;
            border: 1px solid rgba(39, 58, 73, 0.2);
        }

        .tung-mon img{
            position: relative;
            padding: 0;
            width: 100%;
            height: 100%;
        }

        .ten-mon{
            position: absolute;
            width: 100%;
            height: 2rem;
            line-height: 2rem;
            bottom: 0;
            left: 0;
            right: 0;
            margin: 0;
            padding: 0 0.4rem;
            background-color: #273a49;
            color: #FFF;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
            font-size: 0.9rem;
        }

        .ten-mon-hoa-don{
            border: 1px solid rgba(39, 58, 73, 0.2);
        }

        #danh-sach-mon-container{
            overflow: auto;
        }

        #danh-sach-mon-content{
            width: 100% !important;
            max-height: 80vh !important;
            overflow: inherit;
        }

        #mon-da-chon-container{
            overflow: auto;
        }

        #mon-da-chon-content{
            width: 100% !important;
            max-height: 80vh !important;
            overflow-y: scroll;
        }

        .so-luong{
            width: 50px;
            text-align: center;
            border: none;
            background: none;
            margin: 0 0.3rem;
        }        
    </style>
</head>

<body>
    <?php include('./inc/page-header.php'); ?>    

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-7 mt-2">
                <h4 class="text-center text-uppercase">
                    <?php 
                        if(isset($_GET["action"]) && $_GET["action"] == "update-bill"){
                            echo 'Cập nhật đơn hàng cho bàn '.$_GET["soban"];
                            $CapNhatDonHang = true;
                        }
                        else
                            echo 'Tạo đơn hàng cho bàn';
                    ?> 
                    <select name="soban" id="soban" class="form-control-sm <?= $CapNhatDonHang == true ? 'disable' : '' ?>" onChange="window.location='?soban=' + this.value">
                        <?php
                            $LaySoBan = mysqli_query($conn, "SELECT `soban` FROM `ban` WHERE `trangthaiban`='0'");
                            while($row = mysqli_fetch_assoc($LaySoBan)){
                                if(isset($_GET["soban"]) && $_GET["soban"] == $row['soban'])
                                    echo '<option selected value="'.$row['soban'].'">'.$row['soban'].'</option>';
                                else
                                    echo '<option value="'.$row['soban'].'">'.$row['soban'].'</option>';
                            }
                        ?>
                    </select>
                </h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-7" id="danh-sach-mon-container">
                <div class="row mx-auto" id="loc-mon-an">
                    <form id="form-loc-mon-an" method="post" action="">
                        <div class="col-md-12">
                            <select name="loai-mon" id="loai-mon" class="form-control" onChange="LocMonAn(this.value);">
                                <option value="all">Tất cả</option>
                            <?php
                                $sql = 'SELECT `maloai`, `tenloai` FROM `loaimon`';
                                $kq_sql = mysqli_query($conn, $sql);

                                while($row = mysqli_fetch_assoc($kq_sql)){
                            ?>
                                <option value="<?= $row['maloai']; ?>" <?= isset($_POST['loai-mon']) && $_POST['loai-mon'] == $row['maloai'] ? 'selected' : ''; ?>><?= $row['tenloai']; ?></option>

                            <?php
                                }  //Lấy tên loại món để lọc
                            ?>
                            </select>
                        </div>

                        <button type="submit" class="disable" id="btn-loc" name="btn-loc">OK</button>
                    </form>
                </div>

                <div class="row mx-auto" id="danh-sach-mon-content">
                <?php
                    if(isset($_POST['loai-mon']) && $_POST['loai-mon'] == "all"){
                        $where = ' WHERE 1';
                    }else if(isset($_POST['loai-mon'])){
                        $maloai = $_POST["loai-mon"];
                        $where = ' WHERE `maloai`="'.$maloai.'"';
                    }else{
                        $where = '';
                    }
                    $sql = 'SELECT `mamon`, `tenmon`, `hinh` FROM `monan`'.$where;
                    $kq_sql = mysqli_query($conn, $sql);

                    while($row = mysqli_fetch_assoc($kq_sql)){
                ?>

                <div class="col-md-2 tung-mon" onClick="AddCart(<?= $row['mamon']; ?>);">
                    <img src="../<?= $row['hinh']; ?>" alt="<?= $row['tenmon']; ?>" title="<?= $row['tenmon']; ?>">
                    <p class="ten-mon"><?= $row['tenmon']; ?></p>
                </div>

                <?php 
                    }
                ?>
                </div>
            </div>  <!--End col sản phẩm-->

            <div class="col-md-5" id="mon-da-chon-container">
                <div class="row" id="mon-da-chon-content">
                    <div class="col-md-12">
                        <h5>Món ăn đã chọn</h5>
                        <?php 
                            $LaySoHD = mysqli_query($conn, 'SELECT DISTINCT `hoadon`.`mahd` FROM `hoadon` JOIN `chitiethoadon` ON hoadon.mahd = chitiethoadon.mahd WHERE hoadon.tinhtrang = "Chưa thanh toán" AND hoadon.soban = '.$_GET["soban"]);
                            $row = mysqli_fetch_assoc($LaySoHD);
                            if(mysqli_num_rows($LaySoHD)>0){
                                echo '<input class="disable" id="MaHD" name="MaHD" value="'.$row['mahd'].'">';
                                echo '<input class="disable" id="SoBan" name="SoBan" value="'.$_GET["soban"].'">';
                            }
                        ?>
                    </div>

                    <div class="col-md-12">
                    <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th width="5%" class="text-center">#</th>
                                    <th width="60%">Tên món</th>
                                    <th width="5%" class="text-center">SL</th>
                                    <th width="10" class="text-center">Đ.Giá</th>
                                    <th width="10%" class="text-center">Th.Tiền</th>
                                    <th width="10%" class="text-danger text-center" style="border-top: 1px solid red; border-bottom: 1px solid red;">Xóa</th>
                                </tr>
                            </thead>

                            <tbody>
                                <form id="form-gio-hang-admin" method="post" action="">
                                <?php
                                // Lấy danh sách hóa đơn cũ hiện chưa thanh toán trên bàn
                                if($CapNhatDonHang == true){
                                    // $sql_lay_hoa_don = 'SELECT * FROM `hoadon` JOIN `chitiethoadon` ON hoadon.mahd = chitiethoadon.mahd JOIN monan ON monan.mamon = chitiethoadon.mamon WHERE hoadon.tinhtrang = "Chưa thanh toán" AND hoadon.soban = '.$_GET["soban"];
                                    $sql_lay_hoa_don = 'SELECT * FROM `hoadon` JOIN `chitiethoadon` ON hoadon.mahd = chitiethoadon.mahd JOIN monan ON monan.mamon = chitiethoadon.mamon WHERE hoadon.tinhtrang = "Chưa thanh toán" AND hoadon.soban = '.$_GET["soban"];
                                    $kq_lay_hoa_don = mysqli_query($conn, $sql_lay_hoa_don);                                    

                                    $STT = 0;
                                    $TongTienHoaDonCu = 0;

                                    if($kq_lay_hoa_don){
                                        $btn_pay_bill = true;
                                        while($row = mysqli_fetch_assoc($kq_lay_hoa_don)){
                                            $STT++;
                                ?>
                                    <tr>
                                        <th scope="row" class="text-center"><?= $STT; ?></th>
                                        <td><?= $row['tenmon']; ?></td>
                                        <td class="text-center"><?= $row['soluong']; ?></td>
                                        <td class="text-right"><?= number_format($row['dongia_cthd'], 0, ".", ","); ?></td>
                                        <td class="text-right"><?= number_format($row['dongia_cthd']*$row['soluong'], 0, ".", ","); ?></td>
                                        <td>&nbsp;</td>
                                    </tr>
                                <?php
                                        $TongTienHoaDonCu += $row['dongia_cthd']*$row['soluong'];
                                        }
                                    }
                                    echo '
                                        <tr class="bg-secondary text-white">
                                            <td colspan="4" class="text-right font-weight-bold">Tổng tiền hóa đơn cũ</td>
                                            <td >'.number_format($TongTienHoaDonCu, 0, ".", ",").'</td>
                                            <td class="text-center">&nbsp;</td>
                                        </tr>
                                    ';

                                    echo '<tr><td colspan="6" id="them-mon"><h5>Thêm món</h5></td></tr>'; //Làm dở tại đây. Thêm món ăn khi có bill cũ
                                } //end if
                                ?>

                                <?php
                                if(isset($_SESSION['giohang'])){
                                    $cacmasanpham = implode(',', array_keys($_SESSION['giohang']));
                                    $sql_lay_gio_hang = 'SELECT * FROM monan WHERE mamon IN ('.$cacmasanpham.')';
                                    $kq_lay_gio_hang = mysqli_query($conn, $sql_lay_gio_hang);

                                    $STT = 0;
                                    $TongTienHoaDon = 0;

                                    if($kq_lay_gio_hang){
                                        $btn_update_bill = true;
                                        $btn_pay_bill = false;
                                        while($row = mysqli_fetch_assoc($kq_lay_gio_hang)){
                                            $STT++;
                                            $soluong = $_SESSION['giohang'][$row['mamon']];
                                            $thanhtien = $row['dongia']*$_SESSION['giohang'][$row['mamon']];
                                ?>
                                        
                                            <tr>
                                                <th scope="row" class="text-center"><?= $STT; ?></th>
                                                <td><?= $row['tenmon']; ?></td>
                                                <td class="text-center"><input onchange="javascript:UpdateCart(this.value);" type="number" value="<?= $soluong; ?>" id="soluong" name="soluong[<?= $row['mamon']; ?>]" class="so-luong" /></td>
                                                <td class="text-right"><?= number_format($row['dongia'], 0, ".", ","); ?></td>
                                                <td class="text-right"><?= number_format($thanhtien, 0, ".", ","); ?></td>
                                                <td class="text-center"><a href="javascript:DeleteCart(<?=$row['mamon'];?>);" class="btn btn-sm btn-outline-danger" title="Xóa món '<?= $row['tenmon']; ?>'">X</a></td>
                                            </tr>
                                        
                                <?php
                                            
                                            $TongTienHoaDon += $row['dongia']*$_SESSION['giohang'][$row['mamon']];
                                        }
                                        if($CapNhatDonHang == true) $TongTienHoaDon += $TongTienHoaDonCu;

                                        echo '
                                            <tr class="bg-secondary text-white">
                                                <td colspan="4" class="text-right font-weight-bold">Tổng tiền</td>
                                                <td >'.number_format($TongTienHoaDon, 0, ".", ",").'</td>
                                                <td class="text-center"><a href="../inc/xl-giohang.php?action=un-cart" class="btn btn-sm btn-danger" title="Xóa tất cả">X</td>
                                            </tr>
                                        ';
                                    }
                                }
                                ?>
                                    
                                </form>
                            </tbody>
                        </table>
                    </div>
                    
                </div>   <!--End row món ăn đã chọn-->

                <div class="row">
                    <div class="col-md-12 text-center" id="thongbao"></div>
                </div>      <!--End thông báo-->

                <?php 
                    if($kq_lay_gio_hang || $CapNhatDonHang == true){ 
                ?>

                <div class="row" id="btn-cap-nhat">
                    <div class="col-md-12 text-center">
                        <button type="button" class="btn btn-sm btn-primary <?= $_GET["action"] != 'update-bill' ? '' : 'disable' ?>" onClick="SaveBill(<?= $_GET["soban"] ?>);">Lưu HĐ</button>
                        <button type="button" class="btn btn-sm btn-primary <?= $btn_update_bill == true && $CapNhatDonHang == true ? '' : 'disable' ?>" onClick="UpdateBill();">Cập nhật HĐ</button>
                        <!-- <a href="./inc/xl-don-hang.php?action=pay-bill&soban=<?= $_GET["soban"] ?>" class="btn btn-sm btn-success">Thanh toán</a> -->
                        <!-- <a href="./thanh-toan-don-hang.php?soban=<?= $_GET["soban"] ?>" class="btn btn-sm btn-success">Thanh toán</a> -->
                        <button type="button" class="btn btn-sm btn-success <?= $btn_pay_bill == true ? '' : 'disable' ?>" onClick="ThanhToan();">Thanh toán</button>
                    </div>
                </div>

                <?php } ?>

                
            </div>
        </div>
    </div>

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="./js/function.js"></script>
    <script>
        function LocMonAn(maloai){
            $("#btn-loc").click();
        }

        function ThanhToan(){            
            window.location="thanh-toan-don-hang.php?mahd=" + $("#MaHD").val() + "&soban=" + $("#SoBan").val();
        }

        function AddCart(mamon){
            $.ajax({
                type: "POST",
                url: "../inc/xl-giohang.php?action=add-cart-admin",
                data: {
                    "soluong": 1,
                    "mamon": mamon
                },
                success: function(data,status){
                    if(status == "success"){
                        location.reload();
                        // $.get('gio-hang-admin.php', function (cartContentHTML) {
                        //     $('#gio-hang-admin').html(cartContentHTML);
                        //     console.log(cartContentHTML);
                        // });           
                    }
                }
            });
        }

        function UpdateCart(soluong){
            if(soluong != ""){
                $.ajax({
                    type: "POST",
                    url: "../inc/xl-giohang.php?action=update-cart",
                    data: $('#form-gio-hang-admin').serializeArray(),
                    success: function(data,status){
                        if(status == "success"){
                            location.reload();
                        }
                    }            
                });
            }   
        }

        function DeleteCart(mamon){
            $.ajax({
                type: "GET",
                url: "../inc/xl-giohang.php?action=delete-cart",
                data: {
                    "mamon" : mamon
                },
                success: function(data,status){
                    if(status == "success"){
                        location.reload(); 
                        // $.get('gio-hang-admin.php', function (cartContentHTML) {
                        //     $('#gio-hang-admin').html(cartContentHTML);
                        //     console.log(cartContentHTML);
                        // });          
                    }
                }            
            });
        }

        function SaveBill(soban){
            if(soban < 10)
                soban = "0" + soban;

            $.ajax({
                type: "POST",
                url: "./inc/xl-don-hang.php?action=save-bill",
                data: {
                    "soban" : soban
                },
                success: function(data,status){
                    var data = JSON.parse(data);
                    $("#thongbao").html(data.html);

                    if(data.status == "success"){
                        setTimeout(function(){
                            window.location = window.location.href + "&action=update-bill";
                        }, 1000);
                    }
                }            
            });
        }

        function UpdateBill(soban){
            var MaHD = $("#MaHD").val();

            $.ajax({
                type: "POST",
                url: "./inc/xl-don-hang.php?action=update-bill",
                data: {
                    "mahd" : MaHD
                },
                success: function(data,status){
                    var data = JSON.parse(data);
                    $("#thongbao").html(data.html);

                    if(data.status == "success"){
                        setTimeout(function(){
                            window.location.reload();
                        }, 1000);
                    }
                }            
            });
        }
    </script>
</body>
</html>