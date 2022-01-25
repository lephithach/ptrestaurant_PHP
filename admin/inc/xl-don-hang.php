<?php 
    session_start();
    include('../../inc/connect.php');

    if(isset($_GET["action"])){
        switch ($_GET["action"]){
            case "save-bill":
                $SoBan = $_POST["soban"];
                $TinhTrangHoaDon = 'Chưa thanh toán'; 

                $cacmasanpham = implode(',', array_keys($_SESSION['giohang']));
                $tongtien = 0;
                $sanphamdat = array();
                
                // Lấy thông tin các sản phẩm trong giỏ hàng
                $sql_lay_tt_san_pham = 'SELECT * FROM `monan` WHERE `mamon` IN ('.$cacmasanpham.')';
                $kq_lay_tt_san_pham =  mysqli_query($conn, $sql_lay_tt_san_pham);

                // Cộng tổng tiền
                while ($row = mysqli_fetch_assoc($kq_lay_tt_san_pham)) {
                    $sanphamdat[] = $row;
                    $tongtien += $row['dongia'] * $_SESSION['giohang'][$row['mamon']];
                }

                // Thêm hóa đơn
                $vat = $tongtien * 10 / 100;
                $sql_them_hoa_don = 'INSERT INTO `hoadon` (`manv`, `ngaylaphd`, `ngaysuahd`, `soban`, `tenkh`, `sdt`, `diachi`, `giovao`, `giora`, `chietkhau`, `vat`, `tongtien`, `tinhtrang`, `khachdua`, `trakhach`, `dononline`, `ghichu`) 
                                    VALUES ("'.$_SESSION['manv'].'", "'.date('Y-m-d H:i:s').'", "'.date('Y-m-d H:i:s').'", "'.$SoBan.'", NULL, NULL, NULL, "'.date('H:i:s').'", "'.date('H:i:s').'", "0", "'.$vat.'" ,"'.$tongtien.'", "'.$TinhTrangHoaDon.'", NULL, NULL, "0", NULL)';

                $kq_them_hoa_don = mysqli_query($conn, $sql_them_hoa_don);
                
                // Lấy mã hóa đơn vừa thêm
                $so_hd_vua_them = $conn->insert_id;

                // Lấy chuỗi chi tiết hóa đơn cần thêm
                $str_chi_tiet_hd = '';
                foreach ($sanphamdat as $key => $sanpham) {
                    $str_chi_tiet_hd .= '("'.$so_hd_vua_them.'", "'.$sanpham['mamon'].'", "'.$_SESSION['giohang'][$sanpham['mamon']].'", "'.$sanpham['dongia'].'")';
                    if ($key != count($sanphamdat) - 1) {
                        $str_chi_tiet_hd .= ",";
                    }
                }
                
                // Thêm chi tiết hóa đơn
                $sql_them_cthd = 'INSERT INTO `chitiethoadon` (`mahd`, `mamon`, `soluong`, `dongia_cthd`) VALUES '.$str_chi_tiet_hd.';';
                $kq_them_cthd = mysqli_query($conn, $sql_them_cthd);
                
                
                if($kq_them_hoa_don && $kq_them_cthd){
                    unset($_SESSION['giohang']);
                    $sql_update_table = 'UPDATE `ban` SET `trangthaiban` = "1" WHERE `ban`.`soban` = '.$SoBan;
                    $kq_update_table = mysqli_query($conn, $sql_update_table);

                    echo json_encode(array(
                        'status' => 'success',
                        'message' => 'Lưu hóa đơn thành công',
                        'html' => '<div class="alert alert-success" role="alert">Lưu hóa đơn thành công</div>'
                    ));
                }else{
                    echo json_encode(array(
                        'status' => 'failed',
                        'message' => 'Lưu hóa đơn thất bại',
                        'html' => '<div class="alert alert-danger" role="alert">Lưu hóa đơn thất bại</div>'
                    ));
                }                
                break;

            case 'update-bill':
                $cacmasanpham = implode(',', array_keys($_SESSION['giohang']));
                $tongtien = 0;
                $sanphamdat = array();
                
                // Lấy thông tin các sản phẩm trong giỏ hàng
                $sql_lay_tt_san_pham = 'SELECT `dongia`, `mamon` FROM `monan` WHERE `mamon` IN ('.$cacmasanpham.')';
                $kq_lay_tt_san_pham =  mysqli_query($conn, $sql_lay_tt_san_pham);

                // Cộng tổng tiền
                while ($row = mysqli_fetch_assoc($kq_lay_tt_san_pham)) {
                    $sanphamdat[] = $row;
                    $tongtien += $row['dongia'] * $_SESSION['giohang'][$row['mamon']];
                }

                // Lấy tổng tiền hóa đơn cũ
                $TongTienHoaDonCu = mysqli_query($conn, 'SELECT `tongtien` FROM `hoadon` WHERE `mahd`=' . $_POST["mahd"]);
                $row = mysqli_fetch_assoc($TongTienHoaDonCu);
                $TongTienHoaDonCu = $row['tongtien'];

                // Cộng tổng tiền cũ với tổng tiền mới
                $tongtien += $TongTienHoaDonCu;

                // Lấy chuỗi chi tiết hóa đơn cần thêm
                $str_chi_tiet_hd = '';
                foreach ($sanphamdat as $key => $sanpham) {
                    $str_chi_tiet_hd .= '("'.$_POST["mahd"].'", "'.$sanpham['mamon'].'", "'.$_SESSION['giohang'][$sanpham['mamon']].'", "'.$sanpham['dongia'].'")';
                    if ($key != count($sanphamdat) - 1) {
                        $str_chi_tiet_hd .= ",";
                    }
                }
                
                // Thêm chi tiết hóa đơn
                $sql_them_cthd = 'INSERT INTO `chitiethoadon` (`mahd`, `mamon`, `soluong`, `dongia_cthd`) VALUES '.$str_chi_tiet_hd.';';
                $kq_them_cthd = mysqli_query($conn, $sql_them_cthd);

                // Cập nhật giá hóa đơn
                $vat = $tongtien * 10 / 100;
                $sql_cap_nhat_hoa_don = 'UPDATE `hoadon` SET `ngaysuahd`="'.date('Y-m-d H:i:s').'", `vat`="'.$vat.'", `tongtien`="'.$tongtien.'" WHERE mahd='. $_POST["mahd"];
                $kq_cap_nhat_hoa_don = mysqli_query($conn, $sql_cap_nhat_hoa_don);
                
                if($kq_cap_nhat_hoa_don && $kq_them_cthd){
                    unset($_SESSION['giohang']);

                    echo json_encode(array(
                        'status' => 'success',
                        'message' => 'Cập nhật hóa đơn thành công',
                        'html' => '<div class="alert alert-success" role="alert">Cập nhật hóa đơn thành công</div>'
                    ));
                }else{
                    echo json_encode(array(
                        'status' => 'failed',
                        'message' => 'Cập nhật hóa đơn thất bại',
                        'html' => '<div class="alert alert-danger" role="alert">Cập nhật hóa đơn thất bại</div>'
                    ));
                }
                break;

            case "pay-bill":
                $mahd = $_POST["mahd"];
                if($_POST["soban"] == 0){
                    $soban = 'NULL';
                    $update_table = false;
                }else{
                    $soban = $_POST["soban"];
                    $update_table = true;
                }
                $TongTienPhaiThanhToan = $_POST["TongTienPhaiThanhToan"];
                $TienTraKhach = $_POST["TienTraKhach"];
                $TienKhachDua = $_POST["TienKhachDua"];
                $ChietKhau = $_POST["ChietKhau"];
                
                $sql_update_hoa_don = 'UPDATE `hoadon` SET `ngaysuahd`="'.date('Y-m-d H:i:s').'", `giora`="'.date('H:i:s').'", `chietkhau`="'.$ChietKhau.'", `tongtien`="'.$TongTienPhaiThanhToan.'", `tinhtrang`="Đã thanh toán", `khachdua`="'.$TienKhachDua.'", `trakhach`="'.$TienTraKhach.'" WHERE `mahd`='.$mahd;
                $kq_update_hoa_don = mysqli_query($conn, $sql_update_hoa_don);

                if($kq_update_hoa_don){
                    if($update_table == true){
                        $sql_update_table = 'UPDATE `ban` SET `trangthaiban` = "0" WHERE `ban`.`soban` = '.$soban;
                        $kq_update_table = mysqli_query($conn, $sql_update_table);
                    }

                    echo json_encode(array(
                        'status' => 'success',
                        'mahd' => $mahd,
                    ));
                }
                
                break;

            case 'update-status-bill':
                $mahd = $_POST['mahd'];

                $SQL_Update = mysqli_query($conn, 'UPDATE hoadon SET manv='.$_SESSION['manv'].', tinhtrang="Chưa thanh toán" WHERE mahd='.$mahd);

                if($SQL_Update){
                    echo json_encode(array(
                        'status' => 1,
                        'message' => 'Đã xác nhận đơn hàng ' . $mahd
                    ));
                }else{
                    echo json_encode(array(
                        'status' => 0,
                        'message' => 'Xác nhận đơn hàng ' . $mahd . ' không thành công'
                    ));
                }

            default: break;
        }
    }
?>