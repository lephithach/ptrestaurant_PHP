<?php 
    function format_tinhtrang($str){
        switch($str){
            case 'Đang xử lý':
                $str = '<span class="text-secondary">'.$str.'</span>';
                break;

            case 'Chưa thanh toán':
                $str = '<span class="text-danger">'.$str.'</span>';
                break;

            case 'Đã thanh toán':
                $str = '<span class="text-success">'.$str.'</span>';
                break;

            default: break;
        }

        return $str;
    }
?>