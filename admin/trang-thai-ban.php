<?php 
    session_start();
    include('../inc/connect.php');
    include('inc/check-login.php');
    $NavActive = 'donhang';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trạng thái bàn</title>
    <?php include('./inc/link.php'); ?>
</head>

<style>
    .ban{
        width: 80%;
        height: 5rem;        
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #FFF;
        cursor: pointer;
    }
</style>

<body>
    <?php include('./inc/page-header.php'); ?>
    <?php include('./inc/menu-left.php'); ?>

    <div class="container-fluid" id="menu-right">
        <div class="row">
            <div class="col-md-12">
                <h4 style="text-transform:uppercase;">Trạng thái bàn</h4>
            </div>
        </div>

        <div class="row justify-content-center">
            <?php
                $sql = 'SELECT * FROM `ban`';
                $kq_sql = mysqli_query($conn, $sql);

                while($row = mysqli_fetch_assoc($kq_sql)){
            ?>

            <div class="col-md-2 m-2 ban <?= $row['trangthaiban']==0 ? 'bg-secondary' : 'bg-success' ?>" onClick="window.location='tao-don-hang.php?soban=<?= $row['soban']; ?><?= $row['trangthaiban']==0 ? '' : '&action=update-bill' ?>'" title="<?= $row['tenban']; ?>">
                <?= $row['tenban']; ?>
            </div>
            
            <?php } ?>
        </div> <!--End row bàn-->
    </div>

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="./js/function.js"></script>
</body>
</html>