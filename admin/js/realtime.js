// Dashboard Realtime Box
LaySoBanTrong();
LaySoHoaDonOnline();
LayTongDonHangHomNay();
LayTongTienHoaDonHomNay();
LayTongTienHoaDonThangNay();

function LaySoBanTrong(){
    $.ajax({
        type: "POST",
        url: "./inc/realtime-box.php",
        data: {
            'action': 'SoBanTrong'
        },
        success: function(data){
            var data = JSON.parse(data);
            var sobantrong = data.sobantrong;
            if(sobantrong < 10 && sobantrong > 0)
                sobantrong = "0" + sobantrong;

            $('.table-status .number-status').html(sobantrong);
        }
    });
}setInterval("LaySoBanTrong()",5000);

function LaySoHoaDonOnline(){
    $.ajax({
        type: "POST",
        url: "./inc/realtime-box.php",
        data: {
            'action': 'SoDonOnline'
        },
        success: function(data){
            var data = JSON.parse(data);
            if(data.sodononline < 10 && data.sodononline > 0){
                data.sodononline = "0" + data.sodononline;
            }
            $('.order-online-status .number-status').html(data.sodononline);
        }            
    });
}setInterval("LaySoHoaDonOnline()",5000);

function LayTongDonHangHomNay(){
    $.ajax({
        type: "POST",
        url: "./inc/realtime-box.php",
        data: {
            'action': 'TongDonHangHomNay'
        },
        success: function(data){     
            var data = JSON.parse(data);
            if(data.sodonhanghomnay < 10 && data.sodonhanghomnay > 0){
                data.sodonhanghomnay = "0" + data.sodonhanghomnay;
            }
            $('.total-bill .number-status').html(data.sodonhanghomnay);
        }
    });
}setInterval("LayTongDonHangHomNay()",5000);

    function LayTongTienHoaDonHomNay(){
    $.ajax({
        type: "POST",
        url: "./inc/realtime-box.php",
        data: {
            'action': 'TongTienHomNay'
        },
        success: function(data){     
            var data = JSON.parse(data);  
            var tongtien = data;
            $('.total-money .number-status').html(tongtien);
        }            
    });
}setInterval("LayTongTienHoaDonHomNay()",5000);

function LayTongTienHoaDonThangNay(){
    $.ajax({
        type: "POST",
        url: "./inc/realtime-box.php",
        data: {
            'action': 'TongTienThangNay'
        },
        success: function(data){     
            var data = JSON.parse(data);
            var tongtien = data;
            $('.total-money-month .number-status').html(tongtien);
        }            
    });
}setInterval("LayTongTienHoaDonThangNay()",5000);
