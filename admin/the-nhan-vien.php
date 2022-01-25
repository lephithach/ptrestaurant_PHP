<?php 
    session_start();
    include('../inc/connect.php');
    include('inc/check-login.php');
    $NavActive = "nhanvien";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thẻ nhân viên</title>
    <?php include('./inc/link.php'); ?>
    <?php include('../inc/_fix.php'); ?>
    
    <style>
        /* Thẻ nhân viên */
        @import url('https://fonts.googleapis.com/css2?family=Courgette&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

        *{
            font-size: 14px;
            font-family: 'Roboto', sans-serif;
        }

        body{
            width: 21cm !important;
        }

        .wrapper{
            width: 8.6cm !important;
            height: 5.4cm !important;
            border: 1px solid #000;
            margin: 2cm 0 0 2cm;
            position: relative;
            border-radius: 20px;
            background-color: #fcf6ed;
        }

        header{      
            height: 1cm;
            /* background-color: #fcf6ed; */
            position: relative;
            border-bottom: 1px solid #000;
        }

        header .logo{
            font-family: 'Courgette', cursive;
            font-size: 1.3em;
            color: #28a745;
            position: absolute;
            left: 0;
            line-height: 1cm;
        }

        header span{
            position: absolute;
            right: 0;
            line-height: 1cm;
        }

        .left{
            float: left;
            width: 30%;
            text-align: center;
        }

        .left img{
            max-width: 2cm;
            /* max-height: 2.7cm; */
        }

        .right{
            float: right;
            width: 68%;
            padding-right: 2%;
        }

        .right .nhan-thong-tin{
            width: 2cm;
            font-size: 14px;
        }

        .right .thong-tin{
            font-weight: bold;
            font-size: 14px;
            text-align: center;
            text-transform: uppercase;
        }

        /* Thẻ tên */

        .wrapper-the-ten{
            width: 7cm;
            height: 2cm;
            border: 1px solid #000;
            margin: 2cm 2cm 0 0;
            position: relative;
            background-color: #fcf6ed;
        }

        .wrapper-the-ten .logo{
            font-family: 'Courgette', cursive;
            font-size: 1.3em;
            color: #28a745;
            position: absolute;
            left: 0;
            line-height: 1cm;
            width: 100%;
            text-align: center;
        }

        .wrapper-the-ten .chucvu,
        .wrapper-the-ten .hoten{
            width: 100%;
            text-align: center;
            position: absolute;
            line-height: 1.5;
            text-transform: uppercase;
        }

        .wrapper-the-ten .chucvu{
            font-size: 12px;
            margin-top: 0.6rem;
        }

        .wrapper-the-ten .hoten{
            font-weight: bold;
            margin-top: 0.4rem;
            font-size: 15px;
        }

        .wrapper-container{
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>

<body>

<?php 
    if(!isset($_GET["manv"]))
        $where = '';
    else
        $where = ' WHERE nhanvien.manv="'.$_GET["manv"].'"';

    $sql = 'SELECT * FROM `nhanvien` JOIN `chucvu` ON nhanvien.machucvu = chucvu.machucvu';
    $sql .= $where;
    $kq_sql = mysqli_query($conn, $sql);

    if(mysqli_num_rows($kq_sql)>0){
        while($row = mysqli_fetch_assoc($kq_sql)){
            $fullname = $row['ho'] . " " . $row['ten'];
            $ngaysinh = strtotime($row['ngaysinh']);
?>
    <div class="wrapper-container">
        <div class="the-nhan-vien">
            <div class="wrapper">
                <header>
                    <span class="logo ml-3">PT Restaurant</span>
                    <span class="mr-3" style="font-size: 10px;">123, Võ Thị Sáu, Biên Hòa, Đồng Nai</span>
                </header>

                <div id="left" class="left mt-4">
                    <img src="<?= $row['hinh']; ?>" alt="anh-the">
                    <span style="font-size: 0.8em;"><?= manv($row['manv']); ?></span>
                </div>

                <div id="right" class="right mt-4">
                    <table width="100%">
                        <tr>
                            <td colspan="2" class="text-center text-danger font-weight-bold pb-2">THẺ NHÂN VIÊN</td>
                        </tr>

                        <tr>
                            <td class="nhan-thong-tin">Họ và tên:</td>
                            <td class="thong-tin"><?= $fullname; ?></td>
                        </tr>

                        <tr>
                            <td class="nhan-thong-tin">Ngày sinh:</td>
                            <td class="thong-tin"><?= date('d/m/Y', $ngaysinh); ?></td>
                        </tr>

                        <tr>
                            <td class="nhan-thong-tin">Chức vụ:</td>
                            <td class="thong-tin"><?= $row['tenchucvu']; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="the-ten">
            <div class="wrapper-the-ten">
                <span class="logo">PT Restaurant</span><br>
                <span class="chucvu"><?= $row['tenchucvu']; ?></span><br>
                <span class="hoten"><?= $row['ho'] . ' ' . $row['ten']; ?></span>
            </div>
        </div>
    </div>
<?php 
        }
    }else{
        echo 'Không có nhân viên nào. Vui lòng kiểm tra lại.';
    }
?>

    

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script>
        window.print();
    </script>
</body>
</html>