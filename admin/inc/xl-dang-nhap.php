<?php 
    session_start();
    include('../../inc/connect.php');
    include('../../inc/_fix.php');

    $username = fixkytudacbiet($_POST["username"]);
    $password = md5(fixkytudacbiet($_POST["password"]));

    $TimTaiKhoan = mysqli_query($conn, 'SELECT `ho`, `ten`, `account`.`manv` FROM account JOIN nhanvien ON account.manv = nhanvien.manv WHERE username = "'.$username.'" AND password = "'.$password.'"');
    if(mysqli_num_rows($TimTaiKhoan)>0){
        $row = mysqli_fetch_assoc($TimTaiKhoan);

        $_SESSION['username'] = $username;
        $_SESSION['hoten'] = $row['ho'] . " " . $row['ten'];
        $_SESSION['manv'] = $row['manv'];

        echo json_encode(array(
            'status' => 1,
            'message' => 'Đăng nhập thành công'
        ));
    }else{
        echo json_encode(array(
            'status' => 0,
            'message' => 'Đăng nhập thất bại'
        ));
    }
?>