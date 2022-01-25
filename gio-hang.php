<?php
    session_start();
    include('./inc/connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Giỏ hàng</title>
<link href="css/bootstrap.css" type="text/css" rel="stylesheet">
<link href="css/main.css" type="text/css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" type="text/css" rel="stylesheet">
<?php include('inc/fav-icon.php'); ?>
<style>
    #tittle ._hinh_{
        background-image: url('./images/banner/banner-tittle-cart.jpg');
    }
</style>
</head>
<body>
    <?php    
        include('inc/nav.php');
        include('inc/_fix.php');

        if (!isset($_SESSION['giohang'])) {
            $_SESSION['giohang'] = array();
        }    
    ?>

    <div class="container-fluid" id="tittle">
        <div class="row">
			<div class="col-md-12 _hinh_">
				<h3 class="my-1 text-center tittle">GIỎ HÀNG CỦA BẠN</h3>
            </div>
        </div>
    </div>

    <div class="container my-3">
        <div class="table-responsive">
            <table class="table table-bordered table-sm table-striped" id="gio-hang">
                <thead>
                    <tr class="text-center bg-success text-light">
                        <th width="5%" scope="col">#</th>
                        <th width="60%" scope="col">Tên món ăn</th>
                        <th width="2%" scope="col">Ảnh</th>
                        <th width="5%" scope="col">SL</th>
                        <th width="10%" scope="col">Đơn giá</th>
                        <th width="10%" scope="col">Thành tiền</th>
                        <th width="2%" scope="col">&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    <form id="form-gio-hang" method="post" action="">
                    <?php 
                        if(isset($_SESSION['giohang'])){
                            $cacmasanpham = implode(',', array_keys($_SESSION['giohang']));
                            $sql_lay_gio_hang = 'SELECT * FROM monan WHERE mamon IN ('.$cacmasanpham.')';
                            $kq_lay_gio_hang = mysqli_query($conn, $sql_lay_gio_hang);

                            $STT = 0;
                            $tongtien = 0;

                            if($kq_lay_gio_hang){
                                $ThongTinNhanHang = true;
                                while($row = mysqli_fetch_assoc($kq_lay_gio_hang)){
                                    $STT++;
                                    $soluong = $_SESSION['giohang'][$row['mamon']];
                                    $thanhtien = $row['dongia']*$_SESSION['giohang'][$row['mamon']];
                                    echo'
                                        <tr style="line-height: 40px;">
                                            <th class="text-center padding-san-pham" scope="row">'.$STT.'</th>
                                            <td>'.$row['tenmon'].'</td>
                                            <td class="text-center"><img src="'.$row['hinh'].'" alt="'.alias($row['tenmon']).'" width="40px" class="img-cart"></td>
                                            <td class="text-center"><input onchange="javascript:UpdateCart(this.value);" type="number" value="'.$soluong.'" id="soluong" name="soluong['.$row['mamon'].']" class="so-luong" /></td>
                                            <td class="text-right">'.number_format($row['dongia'], 0, ",", ".").'</td>
                                            <td class="text-right font-weight-bold">'.number_format($thanhtien, 0, ",", ".").'</td>
                                            <!--<td class="text-center"><a href="./inc/xl-giohang.php?action=delete-cart&mamon='.$row['mamon'].'" class="btn btn-sm btn-outline-danger">Xóa</a></td>-->
                                            <td class="text-center"><a href="javascript:DeleteCart('.$row['mamon'].');" class="btn btn-sm btn-outline-danger">Xóa</a></td>
                                        </tr>
                                    ';
                                    $tongtien += $row['dongia']*$_SESSION["giohang"][$row['mamon']];
                                }
                                echo'
                                    <tr>
                                        <td class="text-right" colspan="5" style="font-size: 1.2em;">Tổng tiền</td>
                                        <td class="text-right text-danger font-weight-bold text-center" colspan="2" style="font-size: 1.2em;">'. number_format($tongtien, 0, ",", ".") .' đ</td>
                                    </tr>
                                ';
                            }else{
                                $ThongTinNhanHang = false;
                                echo'
                                    <tr>
                                        <td class="text-center text-success" colspan="7" style="font-size: 1.1em;">Bạn chưa chọn món ăn, bấm <a href="./danh-sach-mon-demo.php">vào đây</a> để xem món ăn.</td>
                                    </tr>
                                ';
                            }
                        }
                    ?>
                    
                    <!-- </form>                     -->
                </tbody>

            </table>
        </div>        
    </div>

    <?php if($ThongTinNhanHang == true){ ?>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-10 col-md-6 col-lg-4 col-xl-3">
                <div class="row">
                    <div class="col-md-12 text-left"><h6>Thông tin nhận hàng</h6></div>
                </div>                

                <!-- <form id="form-khach-hang" method="post" action=""> -->
                    <div class="form-group row">
                        <label for="hoten" class="col-md-4">Họ tên</label>

                        <div class="col-md-8">
                            <input type="text" id="hoten" name="hoten" class="form-control" placeholder="Họ tên" onInput="kiemtrahoten();">
                            <div class="text-danger font-italic loihoten"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="sodienthoai" class="col-md-4">Số điện thoại</label>

                        <div class="col-md-8">
                            <input type="text" id="sodienthoai" name="sodienthoai" class="form-control" placeholder="Số điện thoại" onInput="kiemtrasodienthoai();">
                            <div class="text-danger font-italic loisodienthoai"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="diachi" class="col-md-4">Địa chỉ</label>

                        <div class="col-md-8">
                            <input type="text" id="diachi" name="diachi" class="form-control" placeholder="Địa chỉ" onInput="kiemtradiachi();">
                            <div class="text-danger font-italic loidiachi"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="diachi" class="col-md-4">&nbsp;</label>

                        <div class="col-md-8">
                            <button type="submit" class="btn btn-success" id="btn-dat-hang" name="dat-hang">Đặt hàng</button>
                            <!-- <input type="submit" class="btn btn-success" name="dat-hang" value="Đặt hàng"> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php } ?>

    <?php include('./inc/footer.php'); ?>    
    
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>
<script src="js/jquery.validate.min.js" type="text/javascript"></script>
<script src="js/function.js" type="text/javascript"></script>
</body>
</html>