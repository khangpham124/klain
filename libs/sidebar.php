<aside class="hideSide">
    <p class="iconClose"><i class="fa fa-window-close" aria-hidden="true"></i><p>
    <p class="h2_page">Tài khoản</p>
    <ul class="lstSide">
        <li><a href="<?php echo APP_URL; ?>users/<?php echo $_COOKIE['login_cookies']; ?>">Chỉnh sửa thông tin</a></li>
    </ul>
    <p class="h2_page">Tác vụ</p>
    <?php if($_COOKIE['role_cookies']=='manager') { ?>
    <ul class="lstSide">
        <li><a href="<?php echo APP_URL; ?>users"><i class="fa fa-user" aria-hidden="true"></i>Quản lý user</a></li>
        <li><a href="<?php echo APP_URL; ?>customers"><i class="fa fa-users" aria-hidden="true"></i>Quản lý Khách hàng</a></li>
        <li><a href="<?php echo APP_URL; ?>surgery"><i class="fa fa-medkit" aria-hidden="true"></i>Quản lý Ca Phẫu thuật</a>
            <ul>
                <li><a href="<?php echo APP_URL; ?>deposit"><i class="fa fa-credit-card" aria-hidden="true"></i>Quản lý KH đặt cọc</a></li>
                <li><a href="<?php echo APP_URL; ?>debt"><i class="fa fa-money" aria-hidden="true"></i>Quản lý KH nợ</a></li>
            </ul>
        </li>
        <li><a href="<?php echo APP_URL; ?>services"><i class="fa fa-briefcase" aria-hidden="true"></i>Quản lý Dịch vụ</a></li>
        <li><a href="<?php echo APP_URL; ?>supplies"><i class="fa fa-cube" aria-hidden="true"></i></i>Quản lý vật tư</a></li>
        <li><a href="<?php echo APP_URL; ?>care"><i class="fa fa-phone" aria-hidden="true"></i>Quản lý CSKH</a></li>
        
        <li><a href="<?php echo APP_URL; ?>export"><i class="fa fa-database" aria-hidden="true"></i>Truy xuất dữ liệu</a></li>
    </ul>
    <?php } ?>

    <?php if($_COOKIE['role_cookies']=='sale') { ?>
    <ul class="lstSide">
        <li><a href="<?php echo APP_URL; ?>customers"><i class="fa fa-users" aria-hidden="true"></i>Khách hàng</a></li>
        <li><a href="<?php echo APP_URL; ?>surgery"><i class="fa fa-medkit" aria-hidden="true"></i>Xem Ca Phẫu thuật</a></li>
    </ul>
    <?php } ?>

    <?php if($_COOKIE['role_cookies']=='counter') { ?>
    <ul class="lstSide">
        <li><a href="<?php echo APP_URL; ?>customers"><i class="fa fa-users" aria-hidden="true"></i>DS Khách hàng</a></li>
        <li><a href="<?php echo APP_URL; ?>surgery"><i class="fa fa-medkit" aria-hidden="true"></i>Quản lý Ca Phẫu thuật</a>
            <ul>
                <li><a href="<?php echo APP_URL; ?>deposit"><i class="fa fa-credit-card" aria-hidden="true"></i>Quản lý KH đặt cọc</a></li>
                <li><a href="<?php echo APP_URL; ?>debt"><i class="fa fa-money" aria-hidden="true"></i>Quản lý KH nợ</a></li>
            </ul>
        </li>
    </ul>
    <?php } ?>
    <?php if($_COOKIE['login_cookies']!='') { ?>
            <ul class="lstSide">
                <li><a href="<?php echo APP_URL; ?>logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Thoát</a></li>
            </ul>
        <?php } ?>
    <p id="copyright">Develop by Teddycoder - <?php echo date('Y') ?></p>    
</aside>