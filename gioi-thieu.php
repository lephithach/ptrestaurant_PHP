<?php
    include('inc/connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới thiệu về nhà hàng</title>
    <link href="css/bootstrap.css" type="text/css" rel="stylesheet">
    <link href="css/main.css" type="text/css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" type="text/css" rel="stylesheet">
    <?php include('inc/fav-icon.php'); ?>
    <style>
        ._hinh_{
            background-image: url('./images/banner/banner-tittle-info.jpg');
            opacity: 90%;
        }
    </style>
</head>

<body>    
    <?php include('inc/nav.php'); ?>

    <div class="container-fluid" id="tittle">
        <div class="row">
			<div class="col-md-12 _hinh_">
				<h3 class="my-1 text-center tittle">Giới thiệu về nhà hàng</h3>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- <div class="row">
            <div class="col-md-12">
                <img src="./images/banner/sanh-chinh.jpg" width="100%" alt="sanh-chinh">
            </div>

            <div class="col-md-12">
                <p class="text-justify mt-2">Nhà hàng PT Restaurant tự hào khi được trở thành một trong những điểm hẹn lý tưởng của những doanh nhân thành đạt, những bạn trẻ năng động hay những bữa cơm gia đình ấm cúng sau mỗi ngày làm việc căng thẳng. Không gian nơi đây được trang trí và thiết kế đầy ấn tượng nổi bật với tông màu ấm. Cảm giác ấy đến từ không gian nổi bật với lối thiết kế kiến trúc Đông Dương hài hòa với những món ăn biểu tượng của món ngon Việt Nam hiện đại và ẩm thực phương Tây.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <img src="./images/banner/nhan-vien.jpg" width="100%" alt="nhan-vien">
            </div>

            <div class="col-md-12">
                <p class="text-justify mt-2">Đến với nhà hàng của chúng tôi bạn sẽ được thưởng thức những món ăn ngon phong phú, đa dạng cùng với những chai rượu đặc sắc. Bên cạnh đó chúng tôi sở hữu một đội ngũ nhân viên chuyên nghiệp, nhanh nhẹn và nhiệt tình. Đảm bảo cho các món ăn đưa lên quý khách được đảm bảo chất lượng và hương vị thơm ngon nhất. Chăm lo cho khách hàng đến từng chi tiết nhỏ. Đem lại cho bạn sự thoải mái như đang ở một nơi quen thuộc.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <img src="./images/banner/mon-an.jpg" width="100%" alt="mon-an">
            </div>

            <div class="col-md-12">
                <p class="text-justify mt-2">Ở đây chúng tôi có rất nhiều các món ăn trong thực đơn mang nét ẩm thực Việt và ẩm thực phương Tây. Nếu bạn đã được thưởng thức các món ăn của chúng tôi chắc chắn bạn sẽ khó quên được hương vị của mỗi món ăn mà nhà hàng của chúng tôi mang lại. Vì các món ăn đều có màu sắc bắt mắt, lôi cuốn ngoài ra quý khách còn cảm nhận được vị vừa béo, vừa ngọt và đậm đà của các món ăn của chúng tôi mang lại. Bên cạnh đó nhà hàng còn sở hữu sảnh chính lớn với sức chứa lên đến 150 người, đủ lớn để tổ chức tiệc liên hoan hoặc lễ kỷ niệm công ty.</p>
            </div>
        </div> -->

        <div class="row my-2" id="khong-gian">
            <div class="col-md-7">
                <img src="./images/banner/sanh-chinh.jpg" width="100%" alt="sanh-chinh">
            </div>

            <div class="col-md-5">
                <p class="text-justify mt-2">Nhà hàng PT Restaurant tự hào khi được trở thành một trong những điểm hẹn lý tưởng của những doanh nhân thành đạt, những bạn trẻ năng động hay những bữa cơm gia đình ấm cúng sau mỗi ngày làm việc căng thẳng. Không gian nơi đây được trang trí và thiết kế đầy ấn tượng nổi bật với tông màu ấm. Cảm giác ấy đến từ không gian nổi bật với lối thiết kế kiến trúc Đông Dương hài hòa với những món ăn biểu tượng của món ngon Việt Nam hiện đại và ẩm thực phương Tây.</p>
            </div>
        </div>

        <div class="row my-2" id="nhan-vien">
            <div class="col-md-7">
                <img src="./images/banner/nhan-vien.jpg" width="100%" alt="nhan-vien">
            </div>

            <div class="col-md-5">
                <p class="text-justify mt-2">Đến với nhà hàng của chúng tôi bạn sẽ được thưởng thức những món ăn ngon phong phú, đa dạng cùng với những chai rượu đặc sắc. Bên cạnh đó chúng tôi sở hữu một đội ngũ nhân viên chuyên nghiệp, nhanh nhẹn và nhiệt tình. Đảm bảo cho các món ăn đưa lên quý khách được đảm bảo chất lượng và hương vị thơm ngon nhất. Chăm lo cho khách hàng đến từng chi tiết nhỏ. Đem lại cho bạn sự thoải mái như đang ở một nơi quen thuộc.</p>
            </div>
        </div>

        <div class="row my-2">
            <div class="col-md-7">
                <img src="./images/banner/mon-an.jpg" width="100%" alt="mon-an">
            </div>

            <div class="col-md-5">
                <p class="text-justify mt-2">Ở đây chúng tôi có rất nhiều các món ăn trong thực đơn mang nét ẩm thực Việt và ẩm thực phương Tây. Nếu bạn đã được thưởng thức các món ăn của chúng tôi chắc chắn bạn sẽ khó quên được hương vị của mỗi món ăn mà nhà hàng của chúng tôi mang lại. Vì các món ăn đều có màu sắc bắt mắt, lôi cuốn ngoài ra quý khách còn cảm nhận được vị vừa béo, vừa ngọt và đậm đà của các món ăn của chúng tôi mang lại. Bên cạnh đó nhà hàng còn sở hữu sảnh chính lớn với sức chứa lên đến 150 người, đủ lớn để tổ chức tiệc liên hoan hoặc lễ kỷ niệm công ty.</p>
            </div>
        </div>
    </div>

    <?php include('inc/footer.php'); ?>

    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/bootstrap.js" type="text/javascript"></script>
</body>
</html>