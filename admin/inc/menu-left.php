<div id="menu-left">
    <!-- <img src="https://www.w3schools.com/howto/img_avatar.png" alt="avatar">
    <span class="hoten">Lê Phi Thạch</span>
    <i class="bi bi-power icon-logout" title="Đăng xuất" onclick="window.location='#'"></i> -->
    <ul class="main-menu">
        <li class="item <?= $NavActive=='index' ? 'active' : '' ?>">
            <a href="./" class="btn-menu">
                <i class="bi bi-display"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="item <?= $NavActive=='nhanvien' ? 'active' : '' ?>" id="nhanvien">
            <a href="#" class="btn-menu">
                <i class="bi bi-people-fill"></i>
                <span>Nhân viên</span>
                <i class="bi bi-caret-down-fill icon-arrow"></i>
            </a>

            <div class="sub-menu">
                <a href="nhan-vien.php" <?= isset($NavSubActive) && $NavSubActive=='DanhSachNhanVien' ? 'class="active-submenu"' : '' ?>>
                    Danh sách nhân viên
                </a>                
                <a href="chuc-vu.php" <?= isset($NavSubActive) && $NavSubActive=='ChucVu' ? 'class="active-submenu"' : '' ?>>
                    Chức vụ
                </a>
            </div>
        </li>

        <li class="item <?= $NavActive=='monan' ? 'active' : '' ?>">
            <a href="mon-an.php" class="btn-menu">
                <i class="fas fa-utensils icon"></i>
                <span>Món ăn</span>
            </a>
        </li>

        <li class="item <?= $NavActive=='donhang' ? 'active' : '' ?>" id="donhang">
            <a href="#" class="btn-menu">
                <i class="bi bi-journals"></i>
                <span>Đơn hàng</span>
                <i class="bi bi-caret-down-fill icon-arrow"></i>
                <!-- <i class="bi bi-chevron-compact-down icon-arrow"></i> -->
            </a>

            <div class="sub-menu">
                <a href="tao-don-hang.php" <?= isset($NavSubActive) && $NavSubActive=='TaoDonHang' ? 'class="active-submenu"' : '' ?>>Tạo đơn hàng</a>
                <a href="danh-sach-don-hang.php" <?= isset($NavSubActive) && $NavSubActive=='DanhSachDonHang' ? 'class="active-submenu"' : '' ?>>Danh sách đơn hàng Offline</a>
                <a href="danh-sach-don-hang-online.php" <?= isset($NavSubActive) && $NavSubActive=='DanhSachDonHangOnline' ? 'class="active-submenu"' : '' ?>>Danh sách đơn hàng Online</a>
            </div>
        </li>

        <li class="item <?= $NavActive=='gopy' ? 'active' : '' ?>">
            <a href="gop-y.php" class="btn-menu">
                <i class="bi bi-shield"></i>
                <span>Góp ý</span>
            </a>
        </li>

        <li class="item <?= $NavActive=='BaoCaoDoanhThu' ? 'active' : '' ?>">
            <a href="bao-cao-doanh-thu.php" class="btn-menu">
                <i class="bi bi-graph-up"></i>
                <span>Báo cáo</span>
            </a>
        </li>

        <li class="item">
            <a href="./dang-xuat.php" class="btn-menu">
                <i class="bi bi-box-arrow-left"></i>
                <span>Đăng xuất</span>
            </a>
        </li>

    </ul>
</div>