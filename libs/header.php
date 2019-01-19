<?php
    $param = array (
        'name'=> $_COOKIE['login_cookies'],
        'posts_per_page' => '1',
        'post_type' => 'users', 
        'post_status' => 'publish',
        'order' => 'DESC',
        );
        $posts_array = get_posts( $param );
        foreach ($posts_array as $user ) {
        $thumb = get_post_thumbnail_id($user->ID);
        $thumb_url = wp_get_attachment_image_src($thumb,'full');
?>
<header id="header" class="flexBox flexBox--center flexBox--between">
    <p id="logo"><a href="<?php echo APP_URL; ?>"><img src="<?php echo APP_URL; ?>common/img/header/logo.png" alt=""></a></p>
    <?php if($_COOKIE['login_cookies']!='') { ?>
    <div class="headerInfo flexBox flexBox--center">
        <p class="headerInfo__username pc">Hi, <?php echo get_field('fullname',$user->ID); ?></p>
        <p class="headerInfo__ava"><a href="javascript:void(0)" class="iconShow">
            <?php if($thumb_url!='') { ?>
            <img src="<?php echo thumbCrop($thumb_url[0],150,150); ?>" alt=""></a>
            <?php } else { ?>
            <img src="<?php echo APP_URL; ?>common/img/icon/no-img.jpg" alt=""></a>
            <?php } ?>
        </p>
    </div>
    <?php } ?>
</header>
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
        <li><a href="<?php echo APP_URL; ?>surgery"><i class="fa fa-medkit" aria-hidden="true"></i>Quản lý Ca Phẫu thuật</a></li>
        <li><a href="<?php echo APP_URL; ?>services"><i class="fa fa-briefcase" aria-hidden="true"></i>Quản lý Dịch vụ</a></li>
        <li><a href="<?php echo APP_URL; ?>supplies"><i class="fa fa-cube" aria-hidden="true"></i></i>Quản lý vật tư</a></li>
        <li><a href="<?php echo APP_URL; ?>care"><i class="fa fa-phone" aria-hidden="true"></i>Quản lý CSKH</a></li>
        <li><a href="<?php echo APP_URL; ?>"><i class="fa fa-database" aria-hidden="true"></i>Truy xuất dữ liệu</a></li>
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
        <li><a href="<?php echo APP_URL; ?>surgery"><i class="fa fa-medkit" aria-hidden="true"></i>Xem Ca Phẫu thuật</a></li>
    </ul>
    <?php } ?>
    <?php if($_COOKIE['login_cookies']!='') { ?>
            <ul class="lstSide">
                <li><a href="<?php echo APP_URL; ?>logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Thoát</a></li>
            </ul>
        <?php } ?>
</aside>
<?php } ?>