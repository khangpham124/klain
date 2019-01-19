<?php
include($_SERVER["DOCUMENT_ROOT"] . "/projects/klain/app_config.php");
// include(APP_PATH."libs/checklog.php");
if(!$_COOKIE['login_cookies']) {    
	header('Location:'.APP_URL.'login');
}
include(APP_PATH."libs/head.php"); 
?>
</head>

<body id="top">
<!--===================================================-->
<div id="wrapper">
<!--===================================================-->
<!--Header-->
<?php include(APP_PATH."libs/header.php"); ?>
<!--/Header-->

<div class="flexBox flexBox--between textBox flexBox--wrap">
    
    <div class="flexBox flexBox--between flexBox__form flexBox__form--2 blockPage--full">
        <div class="blockPage blockPage--half">
            <h2 class="h2_page">Tìm kiếm thông tin khách hàng</h2>
            <form action="<?php echo APP_URL ?>search">
                <p class="inputBlock ui-widget">
                <input type="text" id="tags" name="search" class="inputForm" placeholder="Tìm kiếm" />
                <input type="submit" class="submitBtn searchBtn">
                </p>
            </form>
        </div>
        

        <div class="blockPage blockPage--half">
            <div class="buttonBar">
                <a href="<?php echo APP_URL ?>add-customer/"><i class="fa fa-user-plus" aria-hidden="true"></i>Tạo khách hàng mới</a>
                <a href="<?php echo APP_URL ?>add-surgery/"><i class="fa fa-user-plus" aria-hidden="true"></i>Tạo ca phẫu thuật</a>
                <a href="javascript:void(0)" onClick="window.location.href=window.location.href"><i class="fa fa-refresh" aria-hidden="true"></i>Cập nhật hệ thống</a>
            </div>
        </div>        
    </div>

        <div class="blockPage blockPage--full">
            <h2 class="h2_page">Danh sách khách hàng trong ngày</h2>
            <table class="tblPage">
            <thead>
                <tr>
                    <td>Trạng thái</td>
                    <td>Ca</td>
                    <td>Họ tên</td>
                    <td>Số điện thoại</td>
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
                        'key' => 'date',
                        'value' => $curr_date,
                        'compare' => 'LIKE'
                    ))
                    // 'meta_query'	=> array(
                    //     'relation'		=> 'OR',
                    //     array(
                    //         'key'	 	=> 'status',
                    //         'value'	  	=> 'tvv',
                    //         'compare' 	=> '=',
                    //     ),
                    //     array(
                    //         'key'	  	=> 'status',
                    //         'value'	  	=> 'bsnk',
                    //         'compare' 	=> '=',
                    //     ),
                    //     array(
                    //         'key'	  	=> 'status',
                    //         'value'	  	=> 'bsk',
                    //         'compare' 	=> '=',
                    //     ),
                    // )
                    );    
                    $wp_query->query($param);
                    if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                ?>
                <tr>
                    <td><span class="noteColor note--<?php echo get_field('status') ?>"></span></td>
                    <td><?php the_title(); ?></td>
                    <td><?php the_field('fullname'); ?></td>
                    <td><?php the_field('mobile'); ?></td>
                    <?php if($_COOKIE['role_cookies']=='manager') { ?>
                        <td class="last"><a href="<?php echo APP_URL; ?>form-counter/?idSurgery=<?php echo $post->ID; ?>"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
                        <a href="<?php the_permalink(); ?>"><i class="fa fa-print" aria-hidden="true"></i></a></td>
                        </td>        
                    <?php } ?>

                    <?php if($_COOKIE['role_cookies']=='counter') { ?>
                    <td class="last"><a href="<?php echo APP_URL; ?>form-counter/?idSurgery=<?php echo $post->ID; ?>"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a></td>
                    <?php } ?>
                    
                    <?php if($_COOKIE['role_cookies']=='doctor') { ?>
                    <td class="last"><a href="<?php echo APP_URL; ?>doctor-confirm/?idSurgery=<?php echo $post->ID; ?>"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a></td>
                    <?php } ?>

                    <?php if($_COOKIE['role_cookies']=='room') { ?>
                    <td class="last"><a href="<?php echo APP_URL; ?>ekip-surgery/?idSurgery=<?php echo $post->ID; ?>"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a></td>
                    <?php } ?>

                    
                </tr>
                <?php endwhile;endif; ?>
            </tbody>
        </table>
        <div class='noteIcon flexBox flexBox--center flexBox--between'>
            <p><span class="noteColor note--tvv"></span><em>Tư vấn viên</em></p>
            <p><span class="noteColor note--quay"></span><em>Quầy</em></p>
            <p><span class="noteColor note--bsnk"></span><em>Bác sĩ ngoại khoa</em></p>
            <p><span class="noteColor note--bsk"></span><em>Bác sĩ Khải</em></p>
            <p><span class="noteColor note--phauthuat"></span><em>Phẫu thuật</em></p>
            <p><span class="noteColor note--hauphau"></span><em>Hậu phẫu</em></p>
            <p><span class="noteColor note--cskh"></span><em>CSKH</em></p>
        </div>
        </div>

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