<?php 
    session_start();
    include('../inc/connect.php');
    include('inc/check-login.php');
    include('./inc/function.php');
    $NavActive = 'donhang';
    $NavSubActive = 'DanhSachDonHang';

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

        //Lọc theo tên nhân viên
        if($_POST['ten-nhan-vien'] != '#'){
            $tennhanvien = $_POST['ten-nhan-vien'];
            $where .= ' AND manv LIKE "%'.$tennhanvien.'%"';
        }

        //Lọc theo số bàn
        if($_POST['so-ban'] != '#'){
            $soban = $_POST['so-ban'];
            $where .= ' AND soban LIKE "%'.$soban.'%"';
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
    <title>Danh sách đơn hàng</title>
    <?php include('./inc/link.php'); ?>
</head>
<body>
    <?php include('./inc/page-header.php'); ?>
    <?php include('./inc/menu-left.php'); ?>

    <div class="container-fluid" id="menu-right">
        <div class="row">
            <div class="col-md-12">
                <h4 style="text-transform:uppercase;">Danh sách đơn hàng Offline</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
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
                                    <option value="Chưa thanh toán" <?= isset($tinhtrang) && $tinhtrang == 'Chưa thanh toán' ? 'selected' : '' ?>>Chưa thanh toán</option>
                                    <option value="Đã thanh toán" <?= isset($tinhtrang) && $tinhtrang == 'Đã thanh toán' ? 'selected' : '' ?>>Đã thanh toán</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group row">
                                <label for="ten-nhan-vien" class="col-md-4 col-form-label">Tên NV:</label>
                                <select name="ten-nhan-vien" id="ten-nhan-vien" class="col-md-8 form-control">
                                    <option value="#">--Chọn--</option>
                                    <?php 
                                        $sql_nhanvien = mysqli_query($conn, 'SELECT manv, ho, ten FROM nhanvien');                                                

                                        while($row = mysqli_fetch_assoc($sql_nhanvien)){
                                    ?>
                                        <option value="<?= $row['manv'] ?>" <?= isset($tennhanvien) && $tennhanvien == $row['manv'] ? 'selected' : '' ?>><?= $row['ho'] . ' ' . $row['ten'] ?></option>

                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group row">
                                <label for="so-ban" class="col-md-4 col-form-label">Số bàn:</label>
                                <select name="so-ban" id="so-ban" class="col-md-8 form-control">
                                    <option value="#">--Chọn--</option>
                                    <?php 
                                        $sql_ban = mysqli_query($conn, 'SELECT soban, tenban FROM ban');                                                

                                        while($row = mysqli_fetch_assoc($sql_ban)){
                                    ?>
                                        <option value="<?= $row['soban'] ?>" <?= isset($soban) && $soban == $row['soban'] ? 'selected' : '' ?>><?= $row['tenban'] ?></option>

                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-sm btn-primary" id="btn-loc" name="btn-loc">Lọc</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="table-responsive table-responsive-lg">
                <table class="table table-sm table-bordered table-striped" id="danh-sach-don-hang-online">
                    <thead>
                        <tr class="text-center bg-info text-light">
                            <th width="5%" scope="col">#</th>
                            <th width="5%" scope="col">HĐ</th>
                            <th width="10%" scope="col">Tên NV</th>
                            <th width="10%" scope="col">Ngày tạo ĐH</th>
                            <!-- <th width="10%" scope="col">Tên KH</th> -->
                            <th width="10%" scope="col">Bàn số</th>
                            <th width="10%" scope="col">Giờ ra</th>
                            <th width="10%" scope="col">Tổng tiền</th>
                            <!-- <th width="10%" scope="col">Ghi chú</th> -->
                            <th width="10%" scope="col">Tình trạng</th>
                            <th width="10%" scope="col">&nbsp;</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php 
                        $sql_lay_danh_sach_hoa_don = 'SELECT `mahd`, `manv`, `ngaylaphd`, `soban`, `giora`, `tongtien`, `ghichu`, `tinhtrang` FROM `hoadon` WHERE `dononline`="0"'.$where;
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
                            <td><?= $row['soban']; ?></td>
                            <td><?= $row['giora']; ?></td>
                            <td class="text-right"><?= number_format($row['tongtien'], 0, ".", ","); ?></td>
                            <!-- <td><?= $row['ghichu']; ?></td> -->
                            <td><?= format_tinhtrang($row['tinhtrang']); ?></td>
                            <td>
                                <a href="chi-tiet-don-hang.php?mahd=<?= $row['mahd']; ?>" class="btn btn-sm btn-outline-secondary" title="Xem đơn hàng"><i class="bi bi-eye"></i></a>
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
        </div>
    </div>

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="./js/function.js"></script>
    <script>
        KiemTraTenHoacSDT();

        function KiemTraTenHoacSDT(){
            var TenKhachHang = $("#ten-khach-hang").val();
            var SDT = $("#sdt").val();

            if(TenKhachHang != ''){
                $("#sdt").val("");
                $("#sdt").prop("disabled", true);
            }else{
                $("#sdt").prop("disabled", false);
            }

            if(SDT != ''){
                $("#ten-khach-hang").val("");
                $("#ten-khach-hang").prop("disabled", true);
            }else{
                $("#ten-khach-hang").prop("disabled", false);
            }
        }
    </script>
</body>
</html>