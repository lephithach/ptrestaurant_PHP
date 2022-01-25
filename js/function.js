$(".add-to-cart-form").submit(function(){
    event.preventDefault();

    $.ajax({
        type: "POST",
        url: "./inc/xl-giohang.php?action=add-cart",
        data: $(this).serializeArray(),
        success: function(data,status){
            if(status == "success"){
                alert(data);                 
            }
        }
    });
});

function UpdateCart(soluong){
    if(soluong != ""){
        $.ajax({
            type: "POST",
            url: "./inc/xl-giohang.php?action=update-cart",
            data: $('#form-gio-hang').serializeArray(),
            success: function(data,status){
                if(status == "success"){
                    location.reload();                 
                }
            }            
        });
    }        
}

function DeleteCart(mamon){
    $.ajax({
        type: "GET",
        url: "./inc/xl-giohang.php?action=delete-cart",
        data: {
            "mamon" : mamon
        },
        success: function(data,status){
            if(status == "success"){
                location.reload();           
            }
        }            
    });
}

$('#form-gio-hang').submit(function(){
    event.preventDefault();

    let loi = 0;
    kiemtrahoten(); if(kiemtrahoten()==1) loi = 1;
    kiemtrasodienthoai(); if(kiemtrasodienthoai()==1) loi = 1;
    kiemtradiachi(); if(kiemtradiachi()==1) loi = 1;

    if(loi == 0){
        $.ajax({
            type: "POST",
            url: "./inc/xl-giohang.php?action=dat-hang",
            data: $('#form-gio-hang').serializeArray(),
            success: function(data,status){
                var data = JSON.parse(data);
                if(data.status == "success"){
                    window.location = data.message + "?mahd=" + data.mahd;
                }
            }
        });
    } //End if    
});

// Validate
function kiemtrahoten(){
    let loi = 1;
    var hoten = $('#hoten').val();
    if(hoten == ''){
        $(".loihoten").html("Chưa nhập họ tên");
        loi = 1;
    }else{
        $(".loihoten").empty();
        loi = 0; 
    }

    return loi;
}

function kiemtrasodienthoai(){
    let loi = 1;
    var sodienthoai = $('#sodienthoai').val();
    if(sodienthoai == ''){
        $(".loisodienthoai").html("Chưa nhập số điện thoại");
        loi = 1;
    }else if(sodienthoai != '' && !sodienthoai.match(/^\+?(\d.*){10,}$/)){
        $(".loisodienthoai").html("Số điện thoại không đúng");
        loi = 1;
    }else{
        $( ".loisodienthoai" ).empty();
        loi = 0;
    }

    return loi;
}

function kiemtradiachi(){
    let loi = 1;
    var diachi = $('#diachi').val();
    if(diachi == ''){
        $(".loidiachi").html("Vui lòng nhập địa chỉ");
        loi = 1;
    }else if(diachi.length < 25){
        $(".loidiachi").html("Địa chỉ chưa đầy đủ");
        loi = 1;
    }else{
        $(".loidiachi").empty();
        loi = 0;
    }

    return loi;
}

// Danh sách món ăn
function LocSanPham(mamon){
    $("#loc").click();
}

// Góp ý
$('#form-gop-y').submit(function(){
    event.preventDefault();

    let loi = 0;
    var hoten = $("#hoten").val();
    var sodienthoai = $("#sodienthoai").val();
    var email = $("#email").val();
    var noidung = $("#noidung").val();
    var hinhthuc = $("#hinhthuc").val();

    var regex_sdt = /^\d*\.?\d+$/;
    var regex_email = /^.+@.+$/;

    if(hoten.trim() == ''){
        loi = 1;
        $("#hoten").addClass("is-invalid");
        $("#error-hoten").html("Vui lòng nhập họ tên");
    }else{
        loi = 0;
        $("#hoten").removeClass("is-invalid");
        $("#error-hoten").html("");
    }

    if(!regex_sdt.test(sodienthoai) || sodienthoai.trim() == ''){
        loi = 1;
        $("#sodienthoai").addClass("is-invalid");
        $("#error-sodienthoai").html("Số điện thoại không hợp lệ");
    }else{
        loi = 0;
        $("#sodienthoai").removeClass("is-invalid");
        $("#error-sodienthoai").html("");
    }

    if(email.trim() == '' || !regex_email.test(email)){
        loi = 1;
        $("#email").addClass("is-invalid");
        $("#error-email").html("Email không hợp lệ");
    }else{
        loi = 0;
        $("#email").removeClass("is-invalid");
        $("#error-email").html("");
    }

    if(noidung.trim() == ''){
        loi = 1;
        $("#noidung").addClass("is-invalid");
        $("#error-noidung").html("Nội dung không hợp lệ");
    }else{
        loi = 0;
        $("#noidung").removeClass("is-invalid");
        $("#error-noidung").html("");
    }

    if(loi == 0){
        $.ajax({
            type: "POST",
            url: "./inc/xl-gop-y.php",
            data: {
                'hoten': hoten,
                'sodienthoai': sodienthoai,
                'email': email,
                'hinhthuc': hinhthuc,
                'noidung': noidung
            },
            success: function(data,status){
                var data = JSON.parse(data);

                $("#message").addClass(data.class);
                $("#message").html(data.message);
            }
        });

    } //End if    
});