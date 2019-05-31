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
        $thumb_url = get_field('avatar',$user->ID);
?>
<header id="header" class="flexBox flexBox--center flexBox--between">
    <p id="logo"><a href="<?php echo APP_URL; ?>"><img src="<?php echo APP_URL; ?>common/img/header/logo.png" alt=""></a></p>
    <?php if($_COOKIE['login_cookies']!='') { ?>
    <div class="headerInfo flexBox flexBox--center">
        <?php if(($_COOKIE['role_cookies']=='manager')||(($_COOKIE['role_cookies']=='boss')||($_COOKIE['role_cookies']=='sale'))) { ?>
        <a href="<?php echo APP_URL ?>add-customer/" class="btnPage"><i class="fa fa-user-plus" aria-hidden="true"></i>Tạo khách hàng mới</a>
        <a href="<?php echo APP_URL ?>add-surgery/" class="btnPage" ><i class="fa fa-medkit" aria-hidden="true"></i>Tạo ca phẫu thuật</a>
        <a href="<?php echo APP_URL ?>add-surgery?type=guarantee" class="btnPage"><i class="fa fa-id-badge" aria-hidden="true"></i></i>Tạo ca bảo hành</a>
        <?php } ?>
        <a href="javascript:void(0)" onClick="window.location.href=window.location.href" class="btnPage btnPage--ref"><i class="fa fa-refresh" aria-hidden="true"></i>Cập nhật hệ thống</a>
        <p class="headerInfo__username pc"><?php echo get_field('fullname',$user->ID); ?><br>
        <span><?php echo $_COOKIE['role_cookies']; ?></span>
    </p>
        <p class="headerInfo__ava"><a href="javascript:void(0)" class="iconShow">
            <?php if($thumb_url!='') { ?>
            <img src="<?php echo thumbCrop($thumb_url,150,150); ?>" alt=""></a>
            <?php } else { ?>
            <img src="<?php echo APP_URL; ?>common/img/icon/no-img.jpg" alt=""></a>
            <?php } ?>
        </p>
    </div>
    <?php } ?>
</header>
<?php } ?>