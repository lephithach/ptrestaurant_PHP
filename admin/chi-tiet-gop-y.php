<?php 
    session_start();
    include('../inc/connect.php');
    include('inc/check-login.php');
    include('./inc/function.php');
    $NavActive = 'gopy';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết góp ý</title>
    <?php include('./inc/link.php'); ?>
</head>

<body>
    <?php include('./inc/page-header.php'); ?>
    <?php include('./inc/menu-left.php'); ?>

    <div class="container-fluid" id="menu-right">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-uppercase">Chi tiết góp ý & khiếu nại</h4>
            </div>
        </div>

        <?php
            $sql = 'SELECT * FROM gopy WHERE id='. $_GET["id"];
            $kq = mysqli_query($conn, $sql);

            $row = mysqli_fetch_assoc($kq);
        ?>

        <div class="row text-left">
            <div class="col-md-2 py-2">
                <b>ID: </b><?= $row['id']; ?>
            </div>

            <div class="col-md-3 py-2">
                <b>Thời gian: </b><?= $row['thoigian']; ?>
            </div>

            <div class="col-md-4 py-2">
                <b>Họ tên: </b><?= $row['hoten']; ?>
            </div>

            <div class="col-md-2 py-2">
                <b>SĐT: </b><?= $row['sdt']; ?>
            </div>

            <div class="col-md-4 py-2">
                <b>Email: </b><?= $row['email']; ?>
            </div>

            <div class="col-md-4 py-2">
                <b>Loại: </b><?= $row['loai'] == 0 ? 'Góp ý' : 'Khiếu nại'; ?>
            </div>

            <div class="col-md-12 py-2">
            <b>Nội dung: </b> <br>
                <?php 
                    foreach(explode("\n", $row['noidung']) as $noidung)
                    echo $noidung.'<br>';
                ?>
            </div>
        </div>
    </div>


    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="./js/function.js"></script>
</body>
</html>