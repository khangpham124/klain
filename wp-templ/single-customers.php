<?php /* Template Name: Login */ ?>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/projects/klain/app_config.php");
if(!$_COOKIE['login_cookies']) {    
	header('Location:'.APP_URL.'login');
}
include(APP_PATH."libs/head.php"); 
?>
</head>

<body>
<!--===================================================-->
<div class="flexBox flexBox--between flexBox--wrap">
    <?php include(APP_PATH."libs/sidebar.php"); ?>
    <div id="wrapper">
    <!--===================================================-->
    <!--Header-->
    <?php include(APP_PATH."libs/header.php"); ?>
    <!--/Header-->
        <div class="blockPage blockPage--full maxW">
            <h2 class="h2_page">Thông tin khách hàng</h2>
            <form action="<?php echo APP_URL; ?>data/editCustomer.php" method="post" enctype="multipart/form-data" id="formCustomer">
                <div class="flexBox flexBox--wrap flexBox--between">
                    <div class="customerInfo">
                        <h4 class="h4_page flexBox flexBox--between"><strong><?php the_field('idcustomer'); ?></strong> <em>Creator:<?php the_field('creator') ?></em></h4>
                        <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                            <p class="inputBlock">
                            <input type="text" class="inputForm" name="fullname" id="fullname" value="<?php the_title(); ?>" placeholder="Họ tên" />
                            </p>
                            <p class="inputBlock">
                            <input type="number" class="inputForm" name="mobile" id="mobile" placeholder="Điện thoại" value="<?php the_field('mobile'); ?>" />
                            </p>
                        </div>
                        <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                            <p class="inputBlock">
                            <input type="text" class="inputForm" name="address" id="address" value="<?php get_field('address'); ?>" placeholder="Địa chỉ" />
                            </p>
                            <p class="inputBlock">
                            <input type="text" class="inputForm" name="idcard" id="idcard" value="<?php the_field('idcard') ?>" placeholder="Só CMND" />
                            </p>
                        </div>

                        <div class="flexBox flexBox--between flexBox__form flexBox__form--3">
                            <p class="inputBlock customSelect">
                                <select id="day" name="day">
                                    <option value="">Ngày</option>
                                    <?php for($i=1;$i<=31;$i++) { ?>
                                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                    <?php } ?>
                                </select>
                            </p>
                            <p class="inputBlock customSelect">    
                                <select id="month" name="month">
                                    <option value="">Tháng</option>
                                    <?php for($i=1;$i<=31;$i++) { ?>
                                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                    <?php } ?>
                                </select>
                                </p>
                            <p class="inputBlock customSelect">    
                                <select id="year" name="year">
                                    <option value="">Năm sinh</option>
                                    <?php for($i=1940;$i<=2019;$i++) { ?>
                                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                    <?php } ?>
                                </select>
                            </p>
                        </div>
                        <h4 class="h4_page">Giấy tờ cá nhân</h4>
                        <div class="flexBox flexBox--between flexBox__form--2">
                            <?php
                            $image_front = get_field('ic_front');
                            $image_back = get_field('ic_back');
                            ?>
                            <?php if($image_front!='') { ?>
                            <p class="inputBlock"><img src="<?php echo $image_front; ?>"></p>
                            <?php } else { ?>
                            <input type="file" name="file1" id="file1" aria-label="Mặt trước chứng minh">
                            <?php } ?>

                            <?php if($image_back!='') { ?>
                            <p class="inputBlock"><img src="<?php echo $image_back; ?>"></p>
                            <?php } else { ?>
                                <input type="file" name="file2" id="file2" aria-label="Mặt sau chứng minh">
                            <?php } ?>
                        </div>

                        <h4 class="h4_page">Lịch sử Phẫu thuật</h4>
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
                    <?php wp_reset_query(); ?>
                    <div class="customerCard">
                        <h4 class="h4_page">Lịch sử tư vấn</h4>
                        <textarea class="inputForm" name="advise_f" placeholder="Tư vấn mới"></textarea>

                        <ul class="hisAdivise">
                            <?php
                            $timeline = get_field('timeline');
                                if(get_field('timeline')): 
                                    while(has_sub_field('timeline')):
                                ?>
                            <li>
                                <p class="date"><?php echo get_sub_field('date'); ?></p>
                                <div><?php echo get_sub_field('content'); ?>
                                <p class="adviser">Nhân viên tư vấn:<?php echo get_sub_field('adviser'); ?></p>
                                </div>
                                
                            </li>
                            <?php endwhile;endif; ?>
                        </ul>
                    </div>
                </div>
                <input type="hidden" name="action" value="edit" >
                <input type="hidden" name="idPost" value="<?php echo $post->ID; ?>" >
                <input type="hidden" name="editor" value="<?php echo $_COOKIE['name_cookies']; ?>" >
                <input class="btnSubmit" type="submit" name="submit" value="Cập nhật">
            </form>
        </div>

        <!--Footer-->
        <?php include(APP_PATH."libs/footer.php"); ?>
        <!--/Footer-->
        
    </div>

</div>

</body>
</html>	
