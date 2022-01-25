<?php

session_start();
include './connect_db.php';
$GLOBALS['connection'] = $con;
switch ($_GET['action']) {
    case "add":
        $result = update_cart(true);
        echo json_encode($result);
        break;
    case "delete":
        if (isset($_POST['id'])) {
            unset($_SESSION["cart"][$_POST['id']]);
        }
        echo json_encode(array(
            'status' => 1,
            'message' => 'Xóa sản phẩm thành công'
        ));
        break;
    default:
        break;
}

function update_cart($add = false) {
    foreach ($_POST['quantity'] as $id => $quantity) {
        if ($quantity == 0) {
            unset($_SESSION["cart"][$id]);
        } else {
            if (!isset($_SESSION["cart"][$id])) {
                $_SESSION["cart"][$id] = 0;
            }
            if ($add) {
                $_SESSION["cart"][$id] += $quantity;
            } else {
                $_SESSION["cart"][$id] = $quantity;
            }
            //Kiểm tra số lượng sản phẩm tồn kho
            $addProduct = mysqli_query($GLOBALS['connection'], "SELECT `quantity` FROM `product` WHERE `id` = " . $id);
            $addProduct = mysqli_fetch_assoc($addProduct);
            if ($_SESSION["cart"][$id] > $addProduct['quantity']) {
                $_SESSION["cart"][$id] = $addProduct['quantity'];
                return array(
                    'status' => 0,
                    'message' => "Số lượng sản phẩm tồn kho chỉ còn: " . $addProduct['quantity'] . " sản phẩm. Bạn vui lòng kiểm tra lại giỏ hàng."
                );
            }
            return array(
                'status' => 1,
                'message' => "Thêm sản phẩm thành công"
            );
        }
    }
}
