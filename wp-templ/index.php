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
        <div class="blockPage">
            <?php include(APP_PATH."libs/searchBlock.php"); ?>
            <?php if(($_COOKIE['role_cookies']=='manager')||($_COOKIE['role_cookies']=='boss')||($_COOKIE['role_cookies']=='counter')) { ?>
            <div class="buttonBar">
                <a href="<?php echo APP_URL ?>add-customer/"><i class="fa fa-user-plus" aria-hidden="true"></i>Tạo khách hàng mới</a>
                <a href="<?php echo APP_URL ?>add-surgery/"><i class="fa fa-user-plus" aria-hidden="true"></i>Tạo ca phẫu thuật</a>
                <a href="javascript:void(0)" onClick="window.location.href=window.location.href"><i class="fa fa-refresh" aria-hidden="true"></i>Cập nhật hệ thống</a>
            </div>
            <?php } ?>
        </div>
        
        <?php if(($_COOKIE['role_cookies']=='manager')||($_COOKIE['role_cookies']=='boss')||($_COOKIE['role_cookies']=='counter')) { ?>
        <div class="blockPage blockPage--half mt0">
            <h2 class="h2_page">Mục Quản lý</h2>
            <ul class="listMange flexBox flexBox--between">
                <li><a href="<?php echo APP_URL; ?>users"><i class="fa fa-user" aria-hidden="true"></i>Quản lý user</a></li>
                <li><a href="<?php echo APP_URL; ?>customers"><i class="fa fa-users" aria-hidden="true"></i>Quản lý Khách hàng</a></li>
            </ul>
            <ul class="listMange flexBox flexBox--between">   
                <li><a href="<?php echo APP_URL; ?>surgery"><i class="fa fa-medkit" aria-hidden="true"></i>Quản lý Ca Phẫu thuật</a></li>
                <li><a href="<?php echo APP_URL; ?>services"><i class="fa fa-briefcase" aria-hidden="true"></i>Quản lý Dịch vụ</a></li>
                </ul>
            <ul class="listMange flexBox flexBox--between">
                <li><a href="<?php echo APP_URL; ?>supplies"><i class="fa fa-cube" aria-hidden="true"></i></i>Quản lý vật tư</a></li>
                <li><a href="<?php echo APP_URL; ?>care"><i class="fa fa-phone" aria-hidden="true"></i>Quản lý CSKH</a></li>
            </ul>
        </div>  
        <?php } ?>      
    </div>

        <div class="blockPage blockPage--full mt40">
            <?php if(($_COOKIE['role_cookies']=='manager')||($_COOKIE['role_cookies']=='boss')||$_COOKIE['role_cookies']=='customer-care') { ?>
                <h2 class="h2_page">Danh sách khách hàng đến lịch</h2>
                <table class="tblPage">
                    <thead>
                    <tr>
                        <td>Kì chăm sóc tiếp theo</td>
                        <td>Ngày phẫu thuật</td>
                        <td>Ca</td>
                        <td>Họ tên</td>
                        <td>Số điện thoại</td>
                        <td>Chi tiết</td>
                    </tr>
                </thead>
                <?php
                    
                    $now = strtotime($curr_date);
                    $app_1days = 86400;
                    $app_3days = 172800;
                    $app_5days = 345600;
                    $app_10ays = 777600;
                    $remind_1days = $now - $app_1days;
                    $remind_3days = $now - $app_3days;
                    $remind_5days = $now - $app_5days;
                    $remind_10days = $now - $app_3days;

                    $wp_query = new WP_Query();
                    $remind_3days;
                    $param = array (
                    'posts_per_page' => '-1',
                    'post_type' => 'surgery',
                    'post_status' => 'publish',
                    'order' => 'DESC',
                    'meta_query'	=> array(
                        'relation' => 'OR',
                        array(
                            'key' => 'time',
                            'value' => $remind_1days,
                            'compare' => '>='
                        ),
                        array(
                            'key' => 'time',
                            'value' => $remind_3days,
                            'compare' => '>='
                        ),
                        array(
                            'key' => 'time',
                            'value' => $remind_5days,
                            'compare' => '>='
                        ),
                        array(
                            'key' => 'time',
                            'value' => $remind_10ays,
                            'compare' => '>='
                        ),
                    )
                    );
                    $wp_query->query($param);
                    if($wp_query->have_posts()): while($wp_query->have_posts()) :$wp_query->the_post();
                ?>
                <tr>
                    <td>
                        <?php if(get_field('time') > $remind_1days ) { ?>
                            <span class="noteRemind noteRemind--1">Sau 1 ngày</span>
                        <?php } else if(get_field('time') > $remind_3days ) { ?>
                            <span class="noteRemind noteRemind--3">Sau 3 ngày</span>
                        <?php } else if(get_field('time') > $remind_5days ) {  ?>
                            <span class="noteRemind noteRemind--5">Sau 5 ngày</span>
                        <?php } else if(get_field('time') > $remind_10ays ) { ?>
                            <span class="noteRemind noteRemind--10">Sau 10 ngày</span>
                        <?php } ?>
                        </span>
                    </td>
                    <td><?php the_field('date'); ?></td>
                    <td><?php the_title(); ?></td>
                    <td><?php the_field('fullname'); ?></td>
                    <td><?php the_field('mobile'); ?></td>
                    <td class="last"><a href="<?php echo APP_URL; ?>care/?idSurgery=<?php echo $post->ID; ?>"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a></td>        
                </tr>
                <?php endwhile;endif; ?>
                </table>
                
            <?php } ?>

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
                    if(($_COOKIE['role_cookies']=='manager')||($_COOKIE['role_cookies']=='boss')||($_COOKIE['role_cookies']=='counter')) {
                        $param=array(
                        'post_type'=>'surgery',
                        'order' => 'DESC',
                        'posts_per_page' => '-1',
                        // 'meta_query'	=> array(
                        //     array(
                        //         'key' => 'date',
                        //         'value' => $curr_date,
                        //         'compare' => 'LIKE'
                        //     ),
                        // )
                        );
                    }
                    
                    if($_COOKIE['role_cookies']=='doctor') {
                        $param=array(
                        'post_type'=>'surgery',
                        'order' => 'DESC',
                        'posts_per_page' => '-1',
                        'meta_query'	=> array(
                            // 'relation'		=> 'OR',
                            // array(
                            //     'key' => 'date',
                            //     'value' => $curr_date,
                            //     'compare' => 'LIKE'
                            // ),
                            array(
                                'key'	  	=> 'status',
                                'value'	  	=> 'quay',
                                'compare' 	=> '=',
                            ),
                            )
                        );
                    }

                    if($_COOKIE['role_cookies']=='room') {
                        $param=array(
                            'post_type'=>'surgery',
                            'order' => 'DESC',
                            'posts_per_page' => '-1',
                            'meta_query'	=> array(
                                'relation'		=> 'OR',
                                // array(
                                //     'key' => 'date',
                                //     'value' => $curr_date,
                                //     'compare' => 'LIKE'
                                // ),
                                array(
                                    'key'	  	=> 'status',
                                    'value'	  	=> 'bsk',
                                    'compare' 	=> '=',
                                ),
                                array(
                                    'key'	  	=> 'status',
                                    'value'	  	=> 'bsnk',
                                    'compare' 	=> '=',
                                ),
                                array(
                                    'key'	  	=> 'status',
                                    'value'	  	=> 'phauthuat',
                                    'compare' 	=> '=',
                                ),
                            )
                        );
                    }    

                    if($_COOKIE['role_cookies']=='customer-care') {
                        $param=array(
                            'post_type'=>'surgery',
                            'order' => 'DESC',
                            'posts_per_page' => '-1',
                            'meta_query'	=> array(
                                'relation'		=> 'OR',
                                // array(
                                //     'key' => 'date',
                                //     'value' => $curr_date,
                                //     'compare' => 'LIKE'
                                // ),
                                array(
                                    'key'	  	=> 'status',
                                    'value'	  	=> 'hauphau',
                                    'compare' 	=> '=',
                                ),
                                )
                        );
                    }
                    $wp_query->query($param);
                    if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                ?>
                <tr>
                    <td><span class="noteColor note--<?php echo get_field('status') ?>"></span></td>
                    <td><?php the_title(); ?></td>
                    <td><?php the_field('fullname'); ?></td>
                    <td><?php the_field('mobile'); ?></td>
                    <?php if(($_COOKIE['role_cookies']=='manager')||($_COOKIE['role_cookies']=='boss')) { ?>
                        <td class="last">
                        <a href="<?php echo APP_URL; ?>form-counter/?idSurgery=<?php echo $post->ID; ?>"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
                        <a href="<?php echo APP_URL; ?>doctor-confirm/?idSurgery=<?php echo $post->ID; ?>"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
                        <a href="<?php echo APP_URL; ?>ekip-surgery/?idSurgery=<?php echo $post->ID; ?>&idEkip=<?php echo $idEkip; ?>"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
                        <a href="<?php the_permalink(); ?>"><i class="fa fa-print" aria-hidden="true"></i></a></td>
                        </td>        
                    <?php } ?>

                    <?php if($_COOKIE['role_cookies']=='counter') { ?>
                    <td class="last"><a href="<?php echo APP_URL; ?>form-counter/?idSurgery=<?php echo $post->ID; ?>"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a></td>
                    <?php } ?>
                    
                    <?php if($_COOKIE['role_cookies']=='doctor') { ?>
                    <td class="last"><a href="<?php echo APP_URL; ?>doctor-confirm/?idSurgery=<?php echo $post->ID; ?>"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a></td>
                    <?php } ?>

                    <?php if($_COOKIE['role_cookies']=='room') { 
                        $stt = get_field('status');
                    ?>
                    <?php if(($stt=='bsk')||($stt=='bsnk')) { ?>
                        <td class="last"><a href="<?php echo APP_URL; ?>ekip-surgery/?idSurgery=<?php echo $post->ID; ?>&idEkip=<?php echo $idEkip; ?>"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a></td>
                    <?php } else { ?>
                        <td class="last"><a href="<?php echo APP_URL; ?>after-surgery/?idSurgery=<?php echo $post->ID; ?>"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a></td>
                    <?php } ?>

                    <?php } ?>

                    <?php if($_COOKIE['role_cookies']=='customer-care') { ?>
                    <td class="last"><a href="<?php echo APP_URL; ?>care/?idSurgery=<?php echo $post->ID; ?>"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a></td>
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
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $(function() {
    var availableTags = [
	<?php 
	$wp_query = new WP_Query();
	$param = array (
	'posts_per_page' => '-1',
	'post_type' => 'customers',
	'post_status' => 'publish',
	'order' => 'DESC',
	'paged' => $paged,
	);
	$wp_query->query($param);
	if($wp_query->have_posts()): while($wp_query->have_posts()) :$wp_query->the_post();
	?>
      "<?php the_title(); ?>",
     <?php endwhile; endif; ?>
    ];
    $( "#tags" ).autocomplete({
      source: availableTags
    });
  });
  </script>

</body>
</html>	