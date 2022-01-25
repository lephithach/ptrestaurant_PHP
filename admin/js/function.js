$('.main-menu #donhang a').click(function(){
    $('.main-menu #donhang .sub-menu').toggleClass("show");            
    $('#donhang .icon-arrow').toggleClass("icon-arrow-rotate");
});

$('.main-menu #nhanvien a').click(function(){
    $('.main-menu #nhanvien .sub-menu').toggleClass("show");            
    $('#nhanvien .icon-arrow').toggleClass("icon-arrow-rotate");
});

    // if(nhanvien == true){
    //     $('.main-menu #nhanvien .sub-menu').toggleClass("show");            
    //     $('#nhanvien .icon-arrow').toggleClass("icon-arrow-rotate");    
    // }

$('#menu').click(function(){
    $('#menu-left').toggleClass("menu-left-show");
});

$('#thu-nho').click(function(){
    $('#menu-left').toggleClass("menu-left-mini");
});

function clock(){
    var timer = new Date();
    var hour = timer.getHours();
    var minute = timer.getMinutes();
    var second = timer.getSeconds();
    var day = timer.getDate();
    var month = timer.getMonth() + 1;
    var year = timer.getFullYear();
    
    if(hour < 10) {
        hour = "0" + hour;
    }
    if(minute < 10) {
        minute = "0" + minute;
    }
    if(second < 10) {
        second = "0" + second;
    }
    if(day < 10){
        day = "0" + day;
    }
    if(month < 10){
        month = "0" + month;
    }

    document.getElementById("time").innerHTML = hour + ":" + minute + ":" + second + " " + day + "/" + month + "/" + year;
}setInterval("clock()",1000);

// Avatar trang thêm NV
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#anh-nhan-vien').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
  
$("#them-avatar-nhan-vien").change(function() {
    readURL(this);
});

function ThemAvatarNhanVien(){
    $('#them-avatar-nhan-vien').click();
}

// Xóa nhân viên
function XoaNhanVien(manv){
    if (confirm("Bạn có muốn xóa nhân viên " + manv +"?") == true) {
        $.ajax({
            type: "POST",
            url: "./inc/xl-nhan-vien.php?action=XoaNhanVien",
            data: {
                'manv': manv
            },
            success: function(data,status){
                var data = JSON.parse(data);

                $("#thongbao").html(data);

                if(data.status == 1){
                    window.location = 'nhan-vien.php';
                }
            }
        });
    }
}

// Thêm chức vụ
$("#form-them-chuc-vu").submit(function(){
    event.preventDefault();

    $.ajax({
        type: "POST",
        url: "./inc/xl-chuc-vu.php?action=ThemChucVu",
        data: $(this).serializeArray(),
        success: function(data,status){
            $("#thongbao").html(data);
        }
    });
});

// Xóa chức vụ
function XoaChucVu(machucvu){
    var machucvu = machucvu;

    if (confirm("Bạn có muốn xóa " + machucvu +"?") == true) {
        $.ajax({
            type: "POST",
            url: "./inc/xl-chuc-vu.php?action=XoaChucVu",
            data: {
                'machucvu': machucvu
            },
            success: function(data,status){
                $("#thongbao").html(data);
            }
        });
    }
}

// Cập nhật chức vụ
$("#form-chuc-vu").submit(function(){
    event.preventDefault();

    $.ajax({
        type: "POST",
        url: "./inc/xl-chuc-vu.php?action=CapNhatChucVu",
        data: $(this).serializeArray(),
        success: function(data,status){
            $("#thongbao").html(data);
        }
    });
});

function KiemTraMaChucVu(){
    // Chưa làm được
    var loi = 1;
    var machucvu = $('#machucvu').val();
    
    $.ajax({
        type: "POST",
        url: "./inc/xl-chuc-vu.php?action=KiemTraMaChucVu",
        data: {
            'machucvu': machucvu
        },
        success: function(data,status){
            var data = JSON.parse(data);
            if(data == 1){
                $(".loimachucvu").html("Mã chức vụ trùng");
                loi = 1;
            }else{
                $(".loimachucvu").empty();
                loi = 0;
            }
        }
    });   
    
    return loi;
}

// Xóa món ăn
function XoaMonAn(mamon){
    if (confirm("Bạn có muốn xóa món số " + mamon +"?") == true) {
        $.ajax({
            type: "POST",
            url: "./inc/xl-mon-an.php?action=XoaMonAn",
            data: {
                'mamon': mamon
            },
            success: function(data){
                var data = JSON.parse(data);
                $("#thongbao").html(data.message);

                if(data.status == 1){
                    window.location = 'mon-an.php';
                }
            }
        });
    }
}

// Xác nhận đơn hàng Online
function XacNhanDonOnline(mahd){
    $.ajax({
        type: "POST",
        url: "./inc/xl-don-hang.php?action=update-status-bill",
        data: {
            'mahd': mahd
        },
        success: function(data){
            var data = JSON.parse(data);

            if(data.status == 1){
                location.reload();
            }else{
                alert(data.message);
            }
        }
    });
}