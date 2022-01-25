<?php 
    include('inc/connect.php');    
    include('inc/_fix.php');    
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Danh sách món ăn</title>
<link href="css/bootstrap.css" type="text/css" rel="stylesheet">
<link href="css/main.css" type="text/css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" type="text/css" rel="stylesheet">
<?php include('inc/fav-icon.php'); ?>
<style>
    #tittle ._hinh_{
        background-image: url('./images/banner/banner-tittle-theatrer-bar.jpg');
    }
</style>
</head>

<body>    
    <?php include('inc/nav.php'); ?>

    <div class="container-fluid" id="tittle">
        <div class="row">
			<div class="col-md-12 _hinh_">
				<h3 class="my-1 text-center tittle">DANH SÁCH MÓN ĂN</h3>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row mt-3">
                    <!-- Danh sách các loại món -->
                    <div class="col-md-12 col-lg-2 col-xl-2" id="form-loc">
                        <h5 class="text-center text-success">Tìm món ăn theo</h5>
                        <form id="loc-mon-an" method="post" action="?action=filter">      
                            <div class="form-group">
                                <label for="ma_loai_mon">Loại món</label>
                                
                                <!-- Start loại món -->
                                <select name="ma_loai_mon" id="ma_loai_mon" class="form-control" onChange="LocSanPham(this.value);">
                                    <option value="all">Tất cả các món</option>

                                    <?php
                                        $sql_lay_loai_mon_an = 'SELECT * FROM `loaimon`';                                    
                                        $kq_lay_loai_mon_an = mysqli_query($conn, $sql_lay_loai_mon_an);

                                        if(mysqli_num_rows($kq_lay_loai_mon_an)>0){
                                            while($row = mysqli_fetch_assoc($kq_lay_loai_mon_an)){
                                                if(isset($_POST['ma_loai_mon']) && $_POST['ma_loai_mon'] == $row['maloai']){
                                                    echo '<option value="'.$row['maloai'].'" selected>'.$row['tenloai'].'</option>';
                                                }else{
                                                    echo '<option value="'.$row['maloai'].'">'.$row['tenloai'].'</option>';
                                                }
                                                
                                            }
                                        }
                                    ?>
                                </select>                    
                            </div>

                                <!-- End loại món -->

                                <!-- Theo giá -->
                            <div class="form-group">
                                <label for="loc-mon-an" class="theo-gia">Theo giá</label>
                                <select name="theo_gia" id="theo_gia" class="form-control" onChange="LocSanPham(this.value);">
                                        <option value="macdinh" <?php if(isset($_POST['theo_gia']) && $_POST['theo_gia'] == 'macdinh') echo'selected'; else echo''; ?>>Mặc định</option>
                                        <option value="asc" <?php if(isset($_POST['theo_gia']) && $_POST['theo_gia'] == 'asc') echo'selected'; else echo''; ?>>Giá tăng dần</option>
                                        <option value="desc" <?php if(isset($_POST['theo_gia']) && $_POST['theo_gia'] == 'desc') echo'selected'; else echo''; ?>>Giá giảm dần</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success" style="display: none;" id="loc" title="Lọc">Lọc</button>
                        </form>                        
                    </div>

                    <!-- Hết danh sách các loại món -->

                    <!-- Bắt đầu show các sản phẩm -->
                    <!-- <div class="col-lg-10 col-xl-10">
                        <div class="row"> -->
                            
                        <?php
                            // if(isset($_GET['action'])){
                            //     switch ($_GET['action']){
                            //         case 'filter':
                            //             if(isset($_POST['ma_loai_mon'])){
                            //                 $ma_loai_mon = $_POST['ma_loai_mon'];
                            //             }else{
                            //                 $ma_loai_mon = 'all';
                            //             } 
                            //             if(isset($_POST['theo_gia'])){
                            //                 $theo_gia = $_POST['theo_gia'];
                            //             }else{
                            //                 $theo_gia = 'macdinh';
                            //             }          

                            //             // Nếu chỉ lọc mỗi loại món
                            //             if($ma_loai_mon != 'all' && $theo_gia == 'macdinh'){
                            //                 $sql_show = 'SELECT * FROM `monan` JOIN `loaimon` ON monan.maloai = loaimon.maloai WHERE monan.maloai="'.$ma_loai_mon.'"';
                            //             } // Nếu chỉ lọc mỗi giá
                            //             else if($ma_loai_mon == 'all' && $theo_gia != 'macdinh'){
                            //                 $sql_show = 'SELECT * FROM `monan` JOIN `loaimon` ON monan.maloai = loaimon.maloai WHERE 1 ORDER BY `dongia` '.$theo_gia;
                            //             } // Lọc cả giá và loại món
                            //             else if($ma_loai_mon != 'all' && $theo_gia != 'macdinh'){
                            //                 $sql_show = 'SELECT * FROM `monan` JOIN `loaimon` ON monan.maloai = loaimon.maloai WHERE monan.maloai="'.$ma_loai_mon.'"';
                            //                 $sql_show .= ' ORDER BY dongia '.$theo_gia;
                            //             }
                            //             else{
                            //                 // $sql_show = 'SELECT * FROM `monan` JOIN `loaimon` ON monan.maloai = loaimon.maloai ORDER BY monan.tenmon asc';
                            //                 echo '<script type="text/javascript">window.location.href="./danh-sach-mon-demo.php";</script>';
                            //                 exit;
                            //             }                 
                                  
                            //             break;
                            //     }
                            // }else{
                            //     $sql_show = 'SELECT * FROM `monan` JOIN `loaimon` ON monan.maloai = loaimon.maloai ORDER BY monan.tenmon asc';
                            // }

                            // // Xử lý lấy dữ liệu
                            // $kq_show = mysqli_query($conn, $sql_show);                            

                            // if(mysqli_num_rows($kq_show)>0){
                            //     while($row = mysqli_fetch_assoc($kq_show)){
                        ?>
                            
                            <!-- <div class="col-xl-2 col-lg-3 col-md-3 col-sm-4 col-xs-6 san-pham mb-auto">
                                <img src="<?= $row['hinh']; ?>" alt="<?= $row['tenmon']; ?>" title="<?= $row['tenmon']; ?>" class="img-san-pham">
                                <div class="tag"><?= $row['tenloai'] ?></div>
                                <div class="thong_tin_mon text-center">
                                    <span class="font-weight-bold ten-mon"><?= $row['tenmon'] ?></span><br>
                                    <span class="text-danger font-weight-bold don-gia"><?= number_format($row['dongia'],0); ?> VNĐ</span><br>
                                    <form id="add-to-cart-form" action="gio-hang.php?action=add-cart" method="POST">
                                        
                                        <button type="submit" title="MUA NGAY" class="text-center my-2 btn btn-danger">MUA NGAY</button>
                                        <span class="ml-2 font-weight-bold _so-luong">Số lượng:</span><input type="number" class="_so-luong" value="1" name="soluong[<?= $row['mamon']; ?>]" />
                                    </form>
                                </div>
                            </div> -->
                            
                            
                        <?php 
                            //     }
                            // }else{                                
                            //     echo '
                            //         <div class="col-md-12" id="mon-an-trong-container">
                            //             <i class="bi bi-emoji-frown icon-mon-an-trong"></i>

                            //             <h6 class="text-secondary text-center mt-2">
                            //                 Không có món ăn nào trong danh sách này. Vui lòng chọn loại món khác và quay lại sau. Xin cảm ơn!
                            //             </h6>
                            //         </div>
                            //     ';
                            // }
                        ?>
                        <!-- </div>                        
                    </div> -->
                    <!-- Hết show các sản phẩm -->

                    <!-- Test show mới -->
                    <!-- Bắt đầu show các sản phẩm -->
                    <div class="col-lg-10 col-xl-10 san-pham-container">
                        <div class="row">
                            
                        <?php
                            if(isset($_GET['action'])){
                                switch ($_GET['action']){
                                    case 'filter':
                                        if(isset($_POST['ma_loai_mon'])){
                                            $ma_loai_mon = $_POST['ma_loai_mon'];
                                        }else{
                                            $ma_loai_mon = 'all';
                                        } 
                                        if(isset($_POST['theo_gia'])){
                                            $theo_gia = $_POST['theo_gia'];
                                        }else{
                                            $theo_gia = 'macdinh';
                                        }
                                        
                                        $type = 1;
                                        $sql_where = false;
                                        $sql_lay_loai_mon_an = 'SELECT * FROM `loaimon`';

                                        // Nếu chỉ lọc mỗi loại món
                                        if($ma_loai_mon != 'all' && $theo_gia == 'macdinh'){
                                            // $sql_where = 'SELECT * FROM `monan` JOIN `loaimon` ON monan.maloai = loaimon.maloai WHERE monan.maloai="'.$ma_loai_mon.'"';
                                            $sql_lay_loai_mon_an = 'SELECT * FROM `loaimon` WHERE maloai="'.$ma_loai_mon.'"';
                                        } // Nếu chỉ lọc mỗi giá
                                        else if($ma_loai_mon == 'all' && $theo_gia != 'macdinh'){
                                            // $sql_where = ' ORDER BY `dongia` '.$theo_gia;
                                            $type = 2;
                                            $sql_lay_tat_ca_mon_an = 'SELECT * FROM `monan` JOIN `loaimon` ON monan.maloai = loaimon.maloai WHERE 1 ORDER BY dongia '.$theo_gia;
                                            $sql_where = '';
                                        } // Lọc cả giá và loại món
                                        else if($ma_loai_mon != 'all' && $theo_gia != 'macdinh'){
                                            $sql_lay_loai_mon_an = 'SELECT * FROM `loaimon` WHERE maloai="'.$ma_loai_mon.'"';
                                            $sql_where .= ' ORDER BY dongia '.$theo_gia;
                                        }
                                        else{
                                            // $sql_show = 'SELECT * FROM `monan` JOIN `loaimon` ON monan.maloai = loaimon.maloai ORDER BY monan.tenmon asc';
                                            echo '<script type="text/javascript">window.location.href="./danh-sach-mon-demo.php";</script>';
                                            exit;
                                        }                 
                                    
                                        break;
                                }
                            }else{
                                $type = 1;
                                $sql_lay_loai_mon_an = 'SELECT * FROM `loaimon`';
                                $sql_where = false;
                            } // End IF ISSET

                            // var_dump($sql_lay_loai_mon_an); exit;
                            // $sql_lay_loai_mon_an = 'SELECT * FROM `loaimon`';
                            if($type == 1){
                                $kq_sql_lay_loai_mon_an = mysqli_query($conn, $sql_lay_loai_mon_an);
                                while($row = mysqli_fetch_assoc($kq_sql_lay_loai_mon_an)){
                                    $maloai = $row['maloai'];
                                    $tenloai = $row['tenloai'];
    
                                    echo '
                                        <div class="col-md-12 title-ten-loai">
                                            <h5><i class="fas fa-utensils icon mr-2"></i>'.$tenloai.'</h5>
                                        </div>
                                        <hr>
                                    ';
                                    $sql_lay_tat_ca_mon_an = 'SELECT * FROM `monan` JOIN `loaimon` ON monan.maloai = loaimon.maloai WHERE monan.maloai="'.$maloai.'"';
    
                                    $sql_lay_tat_ca_mon_an .= $sql_where;
                                    // var_dump($sql_lay_tat_ca_mon_an); exit;
                                    // Xử lý lấy dữ liệu
                                    $lay_tat_ca_mon_an = mysqli_query($conn, $sql_lay_tat_ca_mon_an);
                                         
                                    
                                // }
    
                                    if(mysqli_num_rows($lay_tat_ca_mon_an)>0){
                                        while($row = mysqli_fetch_assoc($lay_tat_ca_mon_an)){                            
                            // }
                        ?>
                            
                            <div class="col-xl-2 col-lg-3 col-md-3 col-sm-4 col-xs-6 san-pham mb-auto">
                                <img src="<?= $row['hinh']; ?>" alt="<?= alias($row['tenmon']); ?>" title="<?= $row['tenmon']; ?>" class="img-san-pham">
                                <div class="tag"><?= $row['tenloai'] ?></div>
                                <div class="thong_tin_mon text-center">
                                    <span class="font-weight-bold ten-mon" title="<?= $row['tenmon'] ?>"><?= $row['tenmon'] ?></span><br>
                                    <span class="text-danger font-weight-bold don-gia"><?= number_format($row['dongia'],0); ?> VNĐ</span><br>
                                    <form class="add-to-cart-form" action="" method="POST">                                        
                                        <button type="submit" title="MUA NGAY" class="text-center my-2 btn btn-danger">MUA NGAY</button>
                                        <span class="ml-2 font-weight-bold _so-luong">Số lượng:</span><input type="number" class="_so-luong" value="1" name="soluong[<?= $row['mamon']; ?>]" />
                                    </form>
                                </div>
                            </div>
                            
                            
                        <?php 
                                        }
                                    }else{                                
                                        echo '
                                            <div class="col-md-12" id="mon-an-trong-container">
                                                <i class="bi bi-emoji-frown icon-mon-an-trong"></i>

                                                <h6 class="text-secondary text-center mt-2">
                                                    Danh sách này hiện chưa có món ăn. Quý khách vui lòng xem loại món khác. Xin cảm ơn!
                                                </h6>
                                            </div>
                                        ';
                                    }
                                }
                            }else if($type == 2){    
                                $sql_lay_tat_ca_mon_an .= $sql_where;
                                // var_dump($sql_lay_tat_ca_mon_an); exit;
                                // Xử lý lấy dữ liệu
                                $lay_tat_ca_mon_an = mysqli_query($conn, $sql_lay_tat_ca_mon_an);
    
                                if(mysqli_num_rows($lay_tat_ca_mon_an)>0){
                                    while($row = mysqli_fetch_assoc($lay_tat_ca_mon_an)){
                        ?>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-sm-4 col-xs-6 san-pham mb-auto">
                                            <img src="<?= $row['hinh']; ?>" alt="<?= alias($row['tenmon']); ?>" title="<?= $row['tenmon']; ?>" class="img-san-pham">
                                            <div class="tag"><?= $row['tenloai'] ?></div>
                                            <div class="thong_tin_mon text-center">
                                                <span class="font-weight-bold ten-mon" title="<?= $row['tenmon'] ?>"><?= $row['tenmon'] ?></span><br>
                                                <span class="text-danger font-weight-bold don-gia"><?= number_format($row['dongia'],0); ?> VNĐ</span><br>
                                                <form id="add-to-cart-form" action="gio-hang.php?action=add-cart" method="POST">
                                                    
                                                    <button type="submit" title="MUA NGAY" class="text-center my-2 btn btn-danger">MUA NGAY</button>
                                                    
                                                    <span class="ml-2 font-weight-bold _so-luong">Số lượng:</span><input type="number" class="_so-luong" value="1" name="soluong[<?= $row['mamon']; ?>]" />
                                                </form>
                                            </div>
                                        </div>

                        <?php
                                    }
                                }
                            }
                        ?>
                        </div>                        
                    </div>
                    <!-- End test show mới -->
                </div>
            </div>
        </div>
    </div>

    <?php include('inc/footer.php'); ?>

<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>
<script src="js/function.js" type="text/javascript"></script>
</body>
</html>