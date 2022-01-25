<?php
    include('./connect.php');

    $hoten = $_POST["hoten"];
    $sodienthoai = $_POST["sodienthoai"];
    $email = $_POST["email"];
    $hinhthuc = $_POST["hinhthuc"];
    $noidung = $_POST["noidung"];

    $Sql_Insert = 'INSERT INTO gopy(thoigian, hoten, sdt, email, noidung, loai) VALUES("'.date('Y-m-d H:i:s').'", "'.$hoten.'", "'.$sodienthoai.'", "'.$email.'", "'.$noidung.'", "'.$hinhthuc.'")';
    $Kq_Insert = mysqli_query($conn, $Sql_Insert);

    if($Kq_Insert){
        echo json_encode(array(
            'status' => 1,
            'class' => 'alert alert-success col-md-12 text-center',
            'message' => 'Cảm ơn bạn đã góp ý về nhà hàng của chúng tôi'
        ));
    }else{
        echo json_encode(array(
            'status' => 0,
            'class' => 'alert alert-danger col-md-12 text-center',
            'message' => 'Có lỗi xảy ra'
        ));
    }
?>