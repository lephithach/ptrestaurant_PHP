<?php 
    session_start();
    include('../../inc/connect.php');

    if(isset($_POST['action'])){
        switch ($_POST['action']){
            case 'SoBanTrong':
                $sql = 'SELECT COUNT(*) AS `sobantrong` FROM `ban` WHERE trangthaiban = 0';
                $kq = mysqli_query($conn, $sql);

                $row = mysqli_fetch_assoc($kq);

                echo json_encode($row);
                break;

            case 'SoDonOnline': 
                $sql = 'SELECT COUNT(*) AS `sodononline` FROM `hoadon` WHERE dononline = 1 AND tinhtrang="Đang xử lý"';
                $kq = mysqli_query($conn, $sql);

                $row = mysqli_fetch_assoc($kq);

                echo json_encode(array(
                    'sodononline' => number_format($row['sodononline'], 0, ".", ",")
                ));
                break;

            case 'TongDonHangHomNay':
                $daynow = date('d');
                $monthnow = date('m');
                $yearnow = date('Y');
                $sql = 'SELECT COUNT(*) AS `sodonhanghomnay` FROM `hoadon` WHERE YEAR(ngaylaphd) = '. $yearnow;
                $sql .= ' and MONTH(ngaylaphd) = '. $monthnow;
                $sql .= ' and DAY(ngaylaphd) = '. $daynow;
                $kq = mysqli_query($conn, $sql);

                $row = mysqli_fetch_assoc($kq);

                echo json_encode(array(
                    'sodonhanghomnay' => number_format($row['sodonhanghomnay'], 0, ".", ",")
                ));
                break;

            case 'TongTienHomNay':
                $daynow = date('d');
                $monthnow = date('m');
                $yearnow = date('Y');
                $sql = 'SELECT SUM(tongtien) As `tongtien` FROM `hoadon` WHERE YEAR(ngaylaphd) = '. $yearnow;
                $sql .= ' and MONTH(ngaylaphd) = '. $monthnow;
                $sql .= ' and DAY(ngaylaphd) = '. $daynow;
                $kq = mysqli_query($conn, $sql);

                $row = mysqli_fetch_assoc($kq);
                $tien = number_format($row['tongtien'], 0, ".", ",") ."đ";

                echo json_encode($tien);
                break;

                case 'TongTienThangNay':
                    // $daynow = date('d');
                    $monthnow = date('m');
                    $yearnow = date('Y');
                    $sql = 'SELECT SUM(tongtien) As `tongtien` FROM `hoadon` WHERE YEAR(ngaylaphd) = '. $yearnow;
                    $sql .= ' and MONTH(ngaylaphd) = '. $monthnow;
                    // $sql .= ' and DAY(ngaylaphd) = '. $daynow;
                    $kq = mysqli_query($conn, $sql);
    
                    $row = mysqli_fetch_assoc($kq);
                    $tien = number_format($row['tongtien'], 0, ".", ",") ."đ";
    
                    echo json_encode($tien);
                    break;

            default: break;
        }
    }
?>