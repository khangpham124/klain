<?php /* Template Name: Ekip Surgery */ ?>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/app_config.php");
// include(APP_PATH."libs/checklog.php");
if(!$_COOKIE['login_cookies']) {    
	header('Location:'.APP_URL.'login');
}

include(APP_PATH."libs/head.php"); 
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link type="text/css" rel="stylesheet" href="<?php echo APP_URL; ?>checkform/exvalidation.css" />
<style type="text/css">
    #datepicker {
        display: none;
    }
</style>
</head>

<body id="top">
<div class="flexBox flexBox--between flexBox--wrap">
<?php include(APP_PATH."libs/sidebar.php"); ?>
<!--===================================================-->
<div id="wrapper">
<!--===================================================-->
<!--Header-->
<?php include(APP_PATH."libs/header.php"); ?>
<!--/Header-->

<div class="flexBox flexBox--between textBox flexBox--wrap maxW">
    <div class="blockPage blockPage--full">
        <h2 class="h2_page">Thông tin Ekip mổ</h2>
        <?php
                $id_sur = $_GET['idSurgery'];
                $wp_query = new WP_Query();
                $param = array (
                'posts_per_page' => '-1',
                'post_type' => 'surgery',
                'post_status' => 'publish',
                'order' => 'DESC',
                'p'=> $id_sur
                );
                $wp_query->query($param);
                if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                $stt_surgery = get_field('status');
            ?>
            <h3 class="h3_page">Thông tin khách hàng</h3>
            <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                <p class="inputBlock">
                <input type="text" class="inputForm" name="fullname" placeholder="Họ tên" readonly value="<?php the_field('fullname'); ?>" />
                </p>
                <p class="inputBlock">
                <input type="text" class="inputForm" name="mobile" placeholder="Mobile" readonly value="<?php the_field('mobile'); ?>" />
                </p>
            </div>


            <?php endwhile;endif; ?>
                
            <!-- EKIP XU LY -->
            <form action="<?php echo APP_URL; ?>data/editSurgery.php" method="post" enctype="multipart/form-data" id="ekipForm">
            <h4 class="h4_page">Dịch vụ yêu cầu</h4>
                <?php
                        $listService = get_field('services_list',$id_sur);
                    ?>
                    <?php 
                    $u = 0;
                    foreach($listService as $serv) {
                    $u++;
                    ?>
                    <p class="inputBlock <?php if($serv['do']=='yes') { ?>lockCheck<?php } ?>">
                    <input type="checkbox" <?php if($serv['do']=='yes') { ?>checked<?php } ?> id="do_<?php echo $u; ?>"  <?php if($serv['do']!='yes') { ?>name="startSur[]"<?php } ?> value="<?php echo $serv['name']; ?>"><label for="do_<?php echo $u; ?>"><?php echo $serv['name']; ?><?php if($serv['do']=='yes') { ?>đã xong<?php } ?></label>
                    </p>
            <?php }  ?>

            <h4 class="h4_page flexBox flexBox--center flexBox--between">Hồ sơ bệnh án và tư vấn của bác sĩ
            <a href="<?php the_permalink(); ?>" title="Chi tiết" class="btnPage" target="_blank">Xem hồ sơ</a>
            </h4>
            <h3 class="h3_page">Bác sĩ phụ trách</h3>
            <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
            <p class="inputBlock" >
                <?php
                    $wp_query = new WP_Query();
                    $param=array(
                    'post_type'=>'users',
                    'order' => 'DESC',
                    'posts_per_page' => '-1',
                    'tax_query' => array(
                        'relation' => 'OR',
                        array(
                        'taxonomy' => 'userscat',
                        'field' => 'slug',
                        'terms' => 'doctor'
                        ),
                        array(
                            'taxonomy' => 'userscat',
                            'field' => 'slug',
                            'terms' => 'boss'
                        ),
                        )
                    );
                    $wp_query->query($param);
                    if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                ?>
                    <label class="checkStyle">
                            <?php the_field('fullname'); ?>
                            <input type="checkbox" name="check01[]" value="<?php the_field('fullname') ?>" id="dr_<?php echo $post->ID ?>">
                            <span class="checkmark"></span>
                    </label>        
                <?php endwhile;endif; ?>
            </p>
            <?php wp_reset_query(); ?>
            </div>

            <h3 class="h3_page">Mổ chính</h3>
            <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
            <p class="inputBlock" >
                <?php
                    $wp_query = new WP_Query();
                    $param=array(
                    'post_type'=>'users',
                    'order' => 'DESC',
                    'posts_per_page' => '-1',
                    'tax_query' => array(
                        'relation' => 'OR',
                        array(
                        'taxonomy' => 'userscat',
                        'field' => 'slug',
                        'terms' => 'doctor'
                        ),
                        array(
                            'taxonomy' => 'userscat',
                            'field' => 'slug',
                            'terms' => 'boss'
                        ),
                        array(
                            'taxonomy' => 'userscat',
                            'field' => 'slug',
                            'terms' => 'nursing-primary'
                        ),
                        )
                    );
                    $wp_query->query($param);
                    if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                ?>
                    <label class="checkStyle">
                        <?php the_field('fullname'); ?>
                        <input type="checkbox" name="check02[]" value="<?php the_field('fullname') ?>" id="mo_<?php echo $post->ID ?>">
                        <span class="checkmark"></span>
                    </label>   
                <?php endwhile;endif; ?>
            </p>
            <?php wp_reset_query(); ?>
            </div>
            <!-- phuong thu tu van -->
            

            <h3 class="h3_page">Phụ mổ</h3>
            <div class="flexBox flexBox--between flexBox__form flexBox__form--3">
            <p class="inputBlock" >
                <?php
                    $wp_query = new WP_Query();
                    $param=array(
                    'post_type'=>'users',
                    'order' => 'DESC',
                    'posts_per_page' => '-1',
                    'tax_query' => array(
                        'relation' => 'OR',
                        array(
                        'taxonomy' => 'userscat',
                        'field' => 'slug',
                        'terms' => 'nursing'
                        ),
                        array(
                            'taxonomy' => 'userscat',
                            'field' => 'slug',
                            'terms' => 'nursing-primary'
                        ),
                        )
                    );
                    $wp_query->query($param);
                    if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                ?>
                    <label class="checkStyle">
                        <?php the_field('fullname'); ?>
                        <input type="checkbox" name="check03[]" value="<?php the_field('fullname') ?>" id="pm_<?php echo $post->ID ?>">
                        <span class="checkmark"></span>
                    </label>
                <?php endwhile;endif; ?>
            </p>
            </div>
            
            <h3 class="h3_page">KTV GM</h3>
            <p class="inputBlock mb30">
                <?php
                    $wp_query = new WP_Query();
                    $param=array(
                    'post_type'=>'users',
                    'order' => 'DESC',
                    'posts_per_page' => '-1',
                    'tax_query' => array(
                        'relation' => 'OR',
                        array(
                        'taxonomy' => 'userscat',
                        'field' => 'slug',
                        'terms' => 'ktv'
                        ),
                        )
                    );
                    $wp_query->query($param);
                    if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                ?>
                    <label class="checkStyle">
                        <?php the_field('fullname'); ?>
                        <input type="checkbox" name="check04[]" value="<?php the_field('fullname') ?>" id="ktv_<?php echo $post->ID ?>">
                        <span class="checkmark"></span>
                    </label>
                <?php endwhile;endif; ?>
            </p>

            <h3 class="h3_page">Nhập thông tin</h3>
            <p class="inputBlock customSelect">
            <select name="input" id="input">
                    <option value="">Lựa chọn điều dưỡng</option>
                    <?php
                    $wp_query = new WP_Query();
                    $param=array(
                    'post_type'=>'users',
                    'order' => 'DESC',
                    'posts_per_page' => '-1',
                    'tax_query' => array(
                        'relation' => 'OR',
                        array(
                        'taxonomy' => 'userscat',
                        'field' => 'slug',
                        'terms' => 'nursing'
                        ),
                        array(
                            'taxonomy' => 'userscat',
                            'field' => 'slug',
                            'terms' => 'nursing-primary'
                        ),
                        )
                    );
                    $wp_query->query($param);
                    if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                ?>
                        <option value="<?php the_field('fullname') ?>"><?php the_field('fullname') ?></option>
                    <?php endwhile;endif; ?>
            </select>
            </p>


            <input type="hidden" name="idSurgery" value="<?php echo $_GET['idSurgery']; ?>" >
            <input type="hidden" name="action" value="ekip_create" >
            <input type="hidden" name="status" value="batdau" >
            <!-- <a href="javascript:void(0)" class="btnSubmit callPopup">Bắt đầu</a> -->
            <input class="btnSubmit" type="submit" name="submit" value="Bắt đầu">
            <div class="popUp">
                <p class="txtNote">Vui lòng kiểm tra lại thông tin chính xác,vì thông tin khi nhập vào sẽ ko thể thay đổi được nữa</p>
                <div class="flexBox flexBox--arround flexBox__form--2">
                <input class="btnSubmit" type="submit" name="submit" value="Bắt đầu">
                <a href="javascript:void(0)" class="btnSubmit cancel">Quay lại</a>
                </div>
            </div>         
        </form>
    </div>
</div>
</div>


<!--Footer-->
<?php include(APP_PATH."libs/footer.php"); ?>
<!--/Footer-->
<!--===================================================-->
</div>

<script type="text/javascript" src="<?php echo APP_URL; ?>checkform/exvalidation.js"></script>
<script type="text/javascript" src="<?php echo APP_URL; ?>checkform/exchecker-ja.js"></script>
<script type="text/javascript">
	$(function(){
	  $("#ekipForm").exValidation({
	    rules: {
            doctor1: "chkselect",
            ktv:"chkselect",
            room:"chkselect",
            input:"chkselect",
	    },
	    stepValidation: true,
	    scrollToErr: true,
	    errHoverHide: true
	  });
    });

    // $('.callPopup').click(function() {
    //     $('.overlay').fadeIn(200);
    //     $('.popUp').fadeIn(200);
    // });

    // $('.overlay').click(function() {
    //     $(this).fadeOut(200);
    //     $('.popUp').fadeOut(200);
    // });

    // $('.cancel').click(function() {
    //     $('.overlay').fadeOut(200);
    //     $('.popUp').fadeOut(200);
    // });
</script>
<div class="overlay"></div>
</body>
</html>	