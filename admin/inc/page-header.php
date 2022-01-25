<div class="container-fluid sticky-top">
    <div class="nav row">
        <div class="col-md-2 logo"><span onClick="window.location='./'" style="cursor:pointer;">PT Restaurant</span></div>
        <!-- <div class="row col-md-10 justify-content-between">
            <div class="col-md-3">
                <i class="bi bi-arrow-left-square" title="Quay lại" onClick="history.back();"></i>
                <i class="bi bi-arrow-right-square"></i>
            </div>
            <div class="col-md-4 time text-right" id="time"></div>
        </div> -->

        
        <div class="col-md-1" id="thu-nho">
            <i class="bi bi-arrow-left-square" title="Nhỏ / To"></i>
        </div>

        <div class="col-md-4 text-light" id="xin-chao">Xin chào: <?= $_SESSION['hoten']; ?></div>

        <div class="col-md-5 time text-right" id="time"></div>
        
        <div class="disable" id="menu"><i class="bi bi-list"></i></div>
        <!-- <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> -->
    </div>
</div>