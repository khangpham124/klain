<?php /* Template Name: Login */ ?>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/projects/klain/app_config.php");
if(!$_COOKIE['login_cookies']) {    
	header('Location:'.APP_URL.'login');
}
include(APP_PATH."libs/head.php"); 
?>
</head>

<body id="login">
<!--===================================================-->
<div id="wrapper">
<!--===================================================-->
<!--Header-->
<?php include(APP_PATH."libs/header.php"); ?>
<!--/Header-->


<div class="blockPage blockPage--full maxW">
        <h2 class="h2_page">Thông tin khách hàng</h2>
        <form action="<?php echo APP_URL; ?>data/addUser.php" method="post" enctype="multipart/form-data" id="formCustomer">
            <div class="flexBox flexBox--wrap flexBox--between">
                <div class="customerInfo">
                    <h4 class="h4_page">Mã số KH: <strong><?php the_field('idcustomer'); ?></strong></h4>
                    <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                        <p class="inputBlock">
                        <input type="text" class="inputForm" name="fullname" id="fullname" value="<?php the_title(); ?>" placeholder="Họ tên" />
                        </p>
                        <p class="inputBlock">
                        <input type="number" class="inputForm" name="mobile" id="mobile" placeholder="Điện thoại" value="<?php the_field('mobile'); ?>" />
                        </p>
                    </div>
                    <h4 class="h4_page">Facebook : <?php the_field('facebook'); ?></h4>
                    <table class="tblPage">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Ngày phẫu thuật</td>
                                <td>Dịch vụ</td>
                                <td>Tư vấn viên</td>
                                <td>Chi tiết</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $wp_query = new WP_Query();
                        $param=array(
                        'post_type'=>'surgery',
                        'order' => 'DESC',
                        'posts_per_page' => '-1',
                        'meta_query' => array(
                            array(
                            'key' => 'mobile',
                            'value' => get_field('mobile'),
                            'compare' => '='
                            ))
                        );    
                        $wp_query->query($param);
                        if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                    ?>
                    <tr>
                        <td><span class="noteColor note--<?php echo get_field('status') ?>"></span></td>
                        <td><?php the_title(); ?></td>
                        <td><?php the_field('fullname'); ?></td>
                        <td><?php the_field('mobile'); ?></td>
                        <td class="last"><a href="<?php echo APP_URL; ?>form-counter/?idSurgery=<?php echo $post->ID; ?>"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a></td>
                    </tr>
                    <?php endwhile;endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="customerCard">
                    <?php
                    $image_front = wp_get_attachment_image_src(get_field('ic_front'),'full');
                    ?>
                <img src="<?php echo $image_front[0]; ?>">
                    <p class="inputBlock">
                    <input type="text" class="inputForm" name="idcard" id="idcard" value="<?php the_field('idcard') ?>" placeholder="Só CMND" />
                    </p>
                </div>
            </div>
        </form>
    </div>

<!--Footer-->
<?php include(APP_PATH."libs/footer.php"); ?>
<!--/Footer-->
<!--===================================================-->
</div>
<!--/wrapper-->
<!--===================================================-->

</body>
</html>	
