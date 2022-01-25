<?php 
    session_start();
    include('../inc/connect.php');
    include('inc/check-login.php');
    include('./inc/function.php');
    $NavActive = 'donhang';
    $NavSubActive = 'DanhSachDonHangOnline';

    if(isset($_POST['btn-loc'])){
        //Số dòng cần lọc
        $sodong = $_POST['sodong'];
        if($sodong != '#'){
            $sodonglimit = ' LIMIT '.$sodong;
        }else{
            $sodonglimit = '';
        }

        //Lọc theo loại
        $tinhtrang = $_POST['tinh-trang'];
        if($tinhtrang != '#'){
            $where = ' AND tinhtrang="'.$tinhtrang.'"';
        }else{
            $where = '';
        }

        //Lọc theo tên
        if(isset($_POST['ten-khach-hang']) && trim($_POST['ten-khach-hang']) != ''){
            $tenkhachhang = $_POST['ten-khach-hang'];
            $where .= ' AND tenkh LIKE "%'.$tenkhachhang.'%"';
        }

        //Lọc theo sdt
        if(isset($_POST['sdt']) && trim($_POST['sdt']) != ''){
            $sdt = $_POST['sdt'];
            $where .= ' AND sdt LIKE "%'.$sdt.'%"';
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
    <title>Danh sách đơn hàng online</title>    
    <?php include('./inc/link.php'); ?>
</head>
<body>
    <?php include('./inc/page-header.php'); ?>
    <?php include('./inc/menu-left.php'); ?>

    <div class="container-fluid" id="menu-right">
        <div class="row">
            <div class="col-md-12">
                <h4 style="text-transform:uppercase;">Danh sách đơn hàng online</h4>
            </div>
        </div>

        <form id="form-loc-danh-sach-don-hang" method="post" action="">
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
                        <label for="tinh-trang" class="col-md-4 col-form-label">Tình trạng:</label>
                        <select name="tinh-trang" id="tinh-trang" class="col-md-8 form-control">
                            <option value="#" <?= isset($tinhtrang) && $tinhtrang == '#' ? 'selected' : '' ?>>--Tất cả--</option>
                            <option value="Đang xử lý" <?= isset($tinhtrang) && $tinhtrang == 'Đang xử lý' ? 'selected' : '' ?>>Đang xử lý</option>
                            <option value="Chưa thanh toán" <?= isset($tinhtrang) && $tinhtrang == 'Chưa thanh toán' ? 'selected' : '' ?>>Chưa thanh toán</option>
                            <option value="Đã thanh toán" <?= isset($tinhtrang) && $tinhtrang == 'Đã thanh toán' ? 'selected' : '' ?>>Đã thanh toán</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group row">
                        <label for="ten-khach-hang" class="col-md-4 col-form-label">Tên KH:</label>
                        <input type="text" id="ten-khach-hang" name="ten-khach-hang" placeholder="Tên khách hàng" class="form-control col-md-8" onInput="KiemTraTenHoacSDT()" value="<?= isset($_POST["ten-khach-hang"]) ? $_POST["ten-khach-hang"] : '' ?>">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group row">
                        <label for="sdt" class="col-md-4 col-form-label">SĐT:</label>
                        <input type="text" class="col-md-8 form-control" placeholder="Số điện thoại khách hàng" id="sdt" name="sdt" maxlength="10" value="<?= isset($sdt) ? $sdt : '' ?>" onInput="KiemTraTenHoacSDT()">
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
                            <th width="5%" scope="col">HĐ</th>
                            <th width="10%" scope="col">Tên NV</th>
                            <th width="10%" scope="col">Ngày đặt</th>
                            <th width="10%" scope="col">Tên KH</th>
                            <th width="10%" scope="col">SĐT</th>
                            <th width="10%" scope="col">Địa chỉ</th>
                            <th width="10%" scope="col">Tổng tiền</th>
                            <!-- <th width="10%" scope="col">Ghi chú</th> -->
                            <th width="10%" scope="col" onClick="alert('OK')">Tình trạng</th>
                            <th width="10%" scope="col">&nbsp;</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php 
                        $sql_lay_danh_sach_hoa_don = 'SELECT `mahd`, `manv`, `ngaylaphd`, `tenkh`, `sdt`, `diachi`, `tongtien`, `ghichu`, `tinhtrang` FROM `hoadon` WHERE `dononline`="1"'.$where;
                        $sql_lay_danh_sach_hoa_don .= ' ORDER BY mahd DESC '.$sodonglimit;
                        // var_dump($sql_lay_danh_sach_hoa_don); exit;
                        $kq_sql_lay_danh_sach_hoa_don = mysqli_query($conn, $sql_lay_danh_sach_hoa_don);

                        if(mysqli_num_rows($kq_sql_lay_danh_sach_hoa_don)>0){
                            $STT = 1;
                            while($row = mysqli_fetch_assoc($kq_sql_lay_danh_sach_hoa_don)){
                                // Xử lý ngày
                                $ngaydathang = strtotime($row['ngaylaphd']);
                                $ngaydathang = date('d/m/Y H:i:s', $ngaydathang);

                                $sql_ten_nv = mysqli_query($conn, 'SELECT `ho`, `ten` FROM `nhanvien` WHERE manv='.$row['manv']);
                                $row_nv = mysqli_fetch_assoc($sql_ten_nv);
                    ?>                                    

                        <tr>
                            <td><?= $STT++; ?></td>
                            <td><?= $row['mahd']; ?></td>
                            <td><?= $row_nv['ho'] . ' ' . $row_nv['ten']; ?></td>
                            <td><?= $ngaydathang; ?></td>
                            <td><?= $row['tenkh']; ?></td>
                            <td><?= $row['sdt']; ?></td>
                            <td class="dia-chi"><?= $row['diachi']; ?></td>
                            <td class="text-right"><?= number_format($row['tongtien'], 0, ".", ","); ?></td>
                            <!-- <td><?= $row['ghichu']; ?></td> -->
                            <td><?= format_tinhtrang($row['tinhtrang']); ?></td>
                            <td>
                                <a href="chi-tiet-don-hang-online.php?mahd=<?= $row['mahd']; ?>" class="btn btn-sm btn-outline-secondary" title="Xem đơn hàng"><i class="bi bi-eye"></i></a>
                                <?= $row['tinhtrang'] == 'Đang xử lý' ? '<button type="button" class="btn btn-sm btn-outline-primary" title="Xác nhận đơn hàng" onClick="XacNhanDonOnline('.$row['mahd'].');"><i class="bi bi-check2"></i></button>' : '' ?>
                            </td>
                        </tr>

                    <?php 
                            }
                        }else{
                            echo '<tr><td colspan="11">Không tìm thấy hóa đơn nào</td></tr>';
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