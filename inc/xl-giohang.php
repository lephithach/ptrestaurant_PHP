<?php 
    session_start();
    include('./connect.php');

    

    if (isset($_GET['action'])) {
        switch ($_GET['action']){
            case 'un-cart':
                unset($_SESSION["giohang"]);
                echo '<script>history.back();</script>';
                break;

            case 'add-cart': 
                foreach ($_POST['soluong'] as $mamon => $soluong) {
                    if ($soluong == 0) {
                        unset($_SESSION["giohang"][$mamon]);
                    }else{
                        //$cacmasanpham = implode(',', array_keys($_SESSION['giohang']));  //Chạy được, lấy các mã món đã add vào giỏ hàng
                        if(in_array($mamon, array_keys($_SESSION['giohang']))){
                            $_SESSION["giohang"][$mamon] += $soluong;
                        }else{
                            $_SESSION["giohang"][$mamon] = $soluong;
                        }
                    }
                    
                    echo 'Thêm vào giỏ hàng thành công';
                }
                break;

            case 'add-cart-admin': 
                // var_dump($_POST['mamon']); exit;
                // foreach ($_POST['soluong'] as $mamon => $soluong) {
                    $mamon = $_POST["mamon"];
                    $soluong = $_POST["soluong"];

                    if ($soluong == 0) {
                        unset($_SESSION["giohang"][$mamon]);
                    }else{
                        //$cacmasanpham = implode(',', array_keys($_SESSION['giohang']));  //Chạy được, lấy các mã món đã add vào giỏ hàng
                        if(in_array($mamon, array_keys($_SESSION['giohang']))){
                            $_SESSION["giohang"][$mamon] += $soluong;
                        }else{
                            $_SESSION["giohang"][$mamon] = $soluong;
                        }
                    }
                // }
                break;

            case 'delete-cart':
                if(isset($_GET['mamon'])){
                    $mamon = $_GET['mamon'];
                    unset($_SESSION["giohang"][$mamon]);
                    // header('location:../gio-hang.php');
                    echo '<script>history.back();</script>';
                }                    
                break;

            case 'update-cart':
                foreach ($_POST['soluong'] as $mamon => $soluong) {
                    if ($soluong == 0) {
                        unset($_SESSION['giohang'][$mamon]);
                    }else{
                        $_SESSION['giohang'][$mamon] = $soluong;
                    }
                }
                break;

            case 'dat-hang':
                $hoten = $_POST['hoten'];
                $sodienthoai = $_POST['sodienthoai'];
                $diachi = $_POST['diachi'];

                $loi = 0;
                if(empty($hoten)){
                    $loi = 1;
                    echo json_encode(array(
                        'status' => 'false',
                        'loi' => 'hoten',
                        'message' => 'Chưa nhập họ tên'
                    ));
                }
                if(empty($sodienthoai)  || !is_numeric($sodienthoai)){
                    $loi = 1;
                }
                if(empty($diachi)){
                    $loi = 1;
                }

                if($loi == 0 && !empty($_POST['soluong'])){
                    $cacmasanpham = implode(',', array_keys($_SESSION['giohang']));
                    $tongtien = 0;
                    $sanphamdat = array();
                    
                    // Lấy thông tin các sản phẩm trong giỏ hàng
                    $sql_lay_tt_san_pham = 'SELECT * FROM `monan` WHERE `mamon` IN ('.$cacmasanpham.')';
                    $kq_lay_tt_san_pham =  mysqli_query($conn, $sql_lay_tt_san_pham);

                    // Cộng tổng tiền
                    while ($row = mysqli_fetch_assoc($kq_lay_tt_san_pham)) {
                        $sanphamdat[] = $row;
                        $tongtien += $row['dongia'] * $_POST['soluong'][$row['mamon']];
                    }

                    // Thêm hóa đơn
                    $sql_them_hoa_don = 'INSERT INTO `hoadon` (`manv`, `ngaylaphd`, `ngaysuahd`, `soban`, `tenkh`, `sdt`, `diachi`, `giovao`, `giora`, `chietkhau`, `tongtien`, `tinhtrang`, `dononline`, `ghichu`) 
                                        VALUES ("1", "'.date('Y-m-d H:i:s').'", "'.date('Y-m-d H:i:s').'", NULL, "'.$hoten.'", "'.$sodienthoai.'", "'.$diachi.'", "'.date('H:i:s').'", "'.date('H:i:s').'", "0", "'.$tongtien.'", "Đang xử lý", "1", NULL);';
                    // var_dump($sql_them_hoa_don); exit;
                    $kq_them_hoa_don = mysqli_query($conn, $sql_them_hoa_don);

                    // var_dump($kq_them_hoa_don); exit;
                    
                    // Lấy mã hóa đơn vừa thêm
                    $so_hd_vua_them = $conn->insert_id;

                    // Lấy chuỗi chi tiết hóa đơn cần thêm
                    $str_chi_tiet_hd = '';
                    foreach ($sanphamdat as $key => $sanpham) {
                        $str_chi_tiet_hd .= '("'.$so_hd_vua_them.'", "'.$sanpham['mamon'].'", "'.$_POST['soluong'][$sanpham['mamon']].'", "'.$sanpham['dongia'].'")';
                        if ($key != count($sanphamdat) - 1) {
                            $str_chi_tiet_hd .= ",";
                        }
                    }

                    // Thêm chi tiết hóa đơn
                    $sql_them_cthd = 'INSERT INTO `chitiethoadon` (`mahd`, `mamon`, `soluong`, `dongia_cthd`) VALUES '.$str_chi_tiet_hd.';';
                    $kq_them_cthd = mysqli_query($conn, $sql_them_cthd);
                    
                    if($kq_them_hoa_don && $kq_them_cthd){
                        unset($_SESSION['giohang']);

                        echo json_encode(array(
                            'status' => 'success',
                            'message' => 'dat-hang-thanh-cong.php',
                            'mahd' => $so_hd_vua_them
                        ));
                    }
                    
                    // var_dump($cacmasanpham); exit;
                }                
                
                break;
        }
    }
?>