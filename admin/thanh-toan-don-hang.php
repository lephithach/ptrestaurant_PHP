<?php 
    session_start();
    include('../inc/connect.php');
    include('inc/check-login.php');
    $NavActive = 'donhang';
    $NavSubActive = 'TaoDonHang';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán đơn hàng</title>
    <?php include('./inc/link.php'); ?>
</head>

<body>
    <?php include('./inc/page-header.php'); ?>

    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-12">
                        <h5>Thanh toán hóa đơn</h5>
                    </div>

                    <div class="col-md-12">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th width="5%" class="text-center">#</th>
                                    <th width="60%">Tên món</th>
                                    <th width="5%" class="text-center">SL</th>
                                    <th width="10" class="text-center">Đ.giá</th>
                                    <th width="10%" class="text-center">Th.tiền</th>
                                </tr>
                            </thead>

                            <style>
                                .so-luong{
                                    width: 50px;
                                    text-align: center;
                                    border: none;
                                    background: none;
                                    margin: 0 0.3rem;
                                }
                            </style>

                            <tbody>
                                <form id="form-gio-hang-admin" method="post" action="">
                                <?php 
                                if(isset($_GET["mahd"])){
                                    // $sql_lay_hoa_don = 'SELECT * FROM `hoadon` JOIN `chitiethoadon` ON hoadon.mahd = chitiethoadon.mahd JOIN monan ON monan.mamon = chitiethoadon.mamon WHERE hoadon.tinhtrang = "Chưa thanh toán" AND hoadon.soban = '.$_GET["soban"];
                                    $sql_lay_hoa_don = 'SELECT hoadon.mahd, hoadon.manv, hoadon.ngaylaphd, hoadon.ngaysuahd, hoadon.soban, hoadon.tenkh, hoadon.sdt, hoadon.diachi, hoadon.giovao, hoadon.giora, hoadon.chietkhau, hoadon.tongtien, hoadon.khachdua, hoadon.trakhach, chitiethoadon.mamon, dongia_cthd, monan.mamon, monan.tenmon, monan.maloai, SUM(chitiethoadon.soluong) As soluong FROM chitiethoadon JOIN hoadon ON hoadon.mahd = chitiethoadon.mahd JOIN monan ON monan.mamon = chitiethoadon.mamon WHERE hoadon.mahd = ' . $_GET["mahd"];
                                    $sql_lay_hoa_don .= ' GROUP BY hoadon.mahd, hoadon.manv, hoadon.ngaylaphd, hoadon.ngaysuahd, hoadon.soban, hoadon.tenkh, hoadon.sdt, hoadon.diachi, hoadon.giovao, hoadon.giora, hoadon.chietkhau, hoadon.tongtien, hoadon.khachdua, hoadon.trakhach, chitiethoadon.mamon, dongia_cthd, monan.mamon, monan.tenmon, monan.maloai';
                                    $kq_lay_hoa_don = mysqli_query($conn, $sql_lay_hoa_don);

                                    $STT = 0;
                                    $tongtien = 0;

                                    if($kq_lay_hoa_don){
                                        while($row = mysqli_fetch_assoc($kq_lay_hoa_don)){
                                            $STT++;
                                ?>
                                        
                                            <tr>
                                                <th scope="row" class="text-center"><?= $STT; ?></th>
                                                <td><?= $row['tenmon']; ?></td>
                                                <td class="text-center"><?= $row['soluong']; ?></td>
                                                <td class="text-right"><?= number_format($row['dongia_cthd'], 0, ".", ","); ?></td>
                                                <td class="text-right"><?= number_format($row['dongia_cthd']*$row['soluong'], 0, ".", ","); ?></td>
                                            </tr>
                                        
                                <?php
                                            
                                            $tongtien += $row['dongia_cthd']*$row['soluong'];
                                        }

                                        echo '
                                            <tr class="bg-secondary text-white">
                                                <td colspan="4" class="text-right font-weight-bold">Tổng</td>
                                                <td class="text-right">'.number_format($tongtien, 0, ".", ",").'
                                                    <input type="hidden" id="tongtien" name="tongtien" value="'.$tongtien.'">
                                                </td>
                                            </tr>
                                        ';
                                        if(isset($_GET["dononline"]) && $_GET["dononline"] == 1){
                                            $vat = 0;
                                        }else{
                                            $vat = $tongtien * 10 / 100;
                                        }
                                        $tongtienhoadon = $tongtien + $vat;

                                        echo '
                                            <tr>
                                                <td colspan="4" class="text-right font-weight-bold">Thuế VAT</td>
                                                <td class="text-right">'.number_format($vat, 0, ".", ",").'
                                                    <input type="hidden" id="vat" name="vat" value="'.$vat.'">
                                                </td>
                                            </tr>
                                        ';

                                        echo '
                                            <tr class="bg-secondary text-white">
                                                <td colspan="4" class="text-right font-weight-bold">Tổng tiền hóa đơn</td>
                                                <td class="text-right">'.number_format($tongtienhoadon, 0, ".", ",").'
                                                    <input type="hidden" id="tongtienhoadon" name="tongtienhoadon" value="'.$tongtienhoadon.'">
                                                </td>
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
            </div>

            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-12">
                        <h5>Tính tiền</h5>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group row mr-auto">
                            <label for="tienkhachdua" class="col-form-label col-md-4">Tiền khách đưa</label>
                            <input type="number" class="form-control col-md-4" id="tienkhachdua" name="tienkhachdua" value="<?= $tongtienhoadon; ?>" onInput="TinhTienTraKhach();" autofocus required>
                            <input type="text" class="form-control col-md-4" id="tienkhachdua_format" name="tienkhachdua_format" value="<?= number_format($tongtienhoadon, 0, ".", ","); ?>" disabled>
                        </div>

                        <div class="form-group row mr-auto">
                            <label for="chietkhau" class="col-form-label col-md-4">Chiết khấu</label>
                            <input type="number" class="form-control col-md-4" id="chietkhau" name="chietkhau" value="0" onInput="TinhTienTraKhach();" required>
                            <input type="text" class="form-control col-md-4" value="%" disabled>
                        </div>

                        <div class="form-group row mr-auto">
                            <label for="tientrakhach" class="col-form-label col-md-4">Tiền trả khách</label>
                            <input type="text" class="form-control col-md-8" id="tientrakhach_format" name="tientrakhach_format" value="0" disabled>
                            <input type="hidden" class="form-control col-md-8" id="tientrakhach" name="tientrakhach" value="0">
                        </div>

                        <hr>

                        <div class="form-group row mr-auto">
                            <label for="TongTienPhaiThanhToan" class="col-form-label col-md-4"><span class="font-weight-bold">Tổng phải thanh toán</span></label>
                            <input type="text" class="form-control col-md-8" id="TongTienPhaiThanhToan_format" name="TongTienPhaiThanhToan_format" value="<?= number_format($tongtienhoadon, 0, ".", ",") ?>" disabled>
                            <input type="hidden" class="form-control col-md-8" id="TongTienPhaiThanhToan" name="TongTienPhaiThanhToan" value="<?= $tongtienhoadon; ?>">
                        </div>
                    </div>

                    <div class="col-md-12 text-center">
                        <button type="button" class="btn btn-sm btn-success" onClick="ThanhToan(<?= $_GET["mahd"]; ?>, <?= isset($_GET["soban"]) ? $_GET["soban"] : 0; ?>);">Thanh toán</button>
                    </div>
                </div>   <!--End row-->
            </div>
        </div>
    </div>

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script>
        function TinhTienTraKhach(){
            var TongTienHoaDon = new Number($("#tongtienhoadon").val());
            var TienTraKhach = 0;
            var TienKhachDua = new Number($("#tienkhachdua").val());
            var ChietKhau = new Number($("#chietkhau").val());

            if(ChietKhau > 100){
                $("#chietkhau").val(100);
                ChietKhau = 100;
            }else if(ChietKhau == 0){
                $("#chietkhau").val(0);
                ChietKhau = 0;
            }else if(ChietKhau < 1){
                $("#chietkhau").val(1);
                ChietKhau = 1;
            }else{
                $("#chietkhau").val(ChietKhau);
                ChietKhau = $("#chietkhau").val();
            }

            var TongTienPhaiThanhToan = TongTienHoaDon - (TongTienHoaDon * ChietKhau / 100);

            $("#tienkhachdua_format").val(PhanTachHangNghin(TienKhachDua));
            $("#TongTienPhaiThanhToan_format").val(PhanTachHangNghin(TongTienPhaiThanhToan));
            $("#TongTienPhaiThanhToan").val(TongTienPhaiThanhToan);

            if(TienKhachDua >= TongTienHoaDon){
                TienTraKhach = TienKhachDua - TongTienPhaiThanhToan;
                $("#tientrakhach_format").val(PhanTachHangNghin(TienTraKhach));
                $("#tientrakhach").val(TienTraKhach);                
            }else{
                $("#tientrakhach_format").val("Tiền khách đưa nhỏ hơn tiền phải thanh toán");
                $("#tientrakhach").val(0);
            }
        }

        function ThanhToan(mahd, soban){
            if(soban < 10){
                soban = "0" + soban;
            }

            var TongTienPhaiThanhToan = $("#TongTienPhaiThanhToan").val();
            var TienTraKhach = $("#tientrakhach").val();
            var TienKhachDua = $("#tienkhachdua").val();
            var ChietKhau = $("#chietkhau").val();

            $.ajax({
                type: "POST",
                url: "./inc/xl-don-hang.php?action=pay-bill",
                data: {
                    "mahd": mahd,
                    "soban": soban,
                    "TongTienPhaiThanhToan": TongTienPhaiThanhToan,
                    "TienTraKhach": TienTraKhach,
                    "TienKhachDua": TienKhachDua,
                    "ChietKhau": ChietKhau
                },
                success: function(data,status){
                    var data = JSON.parse(data);

                    if(data.status == 'success'){
                        window.location="./bill.php?mahd=" + data.mahd + "&print=1";
                    }
                }
            });
        }

        function PhanTachHangNghin(number){
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    </script>
</body>
</html>