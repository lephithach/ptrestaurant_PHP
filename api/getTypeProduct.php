<?php     
    require_once('./Model/Model.php');
	// require_once('./Model/Product.php');

	$Model = new Model;

    if(isset($_GET['maloai'])) {
        $maloai = $_GET['maloai'];
        $sql = "SELECT * FROM loaimon WHERE maloai=\"${maloai}\"";
        echo json_encode($Model->runSingleQuery($sql));
    } else {
        echo json_encode($Model->runQuery('SELECT * FROM `loaimon`'));
    }
?>