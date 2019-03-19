<?php /* Template Name: Ekip Surgery */ ?>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/projects/klain/app_config.php");
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
            <div class="flexBox flexBox--between flexBox__form flexBox__form--3">
                <p class="inputBlock">
                <input type="text" class="inputForm" name="fullname" placeholder="Họ tên" readonly value="<?php the_field('fullname'); ?>" />
                </p>
                <p class="inputBlock">
                <input type="text" class="inputForm" name="idcard" placeholder="Só CMND" readonly value="<?php the_field('idcard'); ?>" />
                </p>
                <p class="inputBlock">
                <input type="text" class="inputForm" name="mobile" placeholder="Mobile" readonly value="<?php the_field('mobile'); ?>" />
                </p>
            </div>

            <h4 class="h4_page">Dịch vụ yêu cầu</h4>
                <?php
                    $listService = get_field('services');
                    $listServices = explode('<br>',$listService);
                ?>
                <?php foreach($listServices as $serv) { ?>
                    <p class="inputBlock">
                    <input type="checkbox" value="<?php echo $serv; ?>"><label><?php echo $serv; ?></label>
                    </p>
                <?php }  ?>
            <h4 class="h4_page">Hồ sơ bệnh án và tư vấn của bác sĩ</h4>

            <?php endwhile;endif; ?>
            <form action="<?php echo APP_URL; ?>data/editSurgery.php" method="post" enctype="multipart/form-data" id="addServices">
            <!-- phuong thu tu van -->

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
                    <input type="checkbox" name="check01[]" value="<?php the_field('fullname') ?>" id="dr_<?php echo $post->ID ?>"><label for="dr_<?php echo $post->ID ?>"><?php the_field('fullname') ?></label><br>
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
                    <input type="checkbox" name="check02[]" value="<?php the_field('fullname') ?>" id="mo_<?php echo $post->ID ?>"><label for="mo_<?php echo $post->ID ?>"><?php the_field('fullname') ?></label><br>
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
                    <input type="checkbox" name="check03[]" value="<?php the_field('fullname') ?>" id="pm_<?php echo $post->ID ?>"><label for="pm_<?php echo $post->ID ?>"><?php the_field('fullname') ?></label><br>
                <?php endwhile;endif; ?>
            </p>
            </div>
            
            <h3 class="h3_page">KTV GM</h3>
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
                        'terms' => 'ktv'
                        ),
                        )
                    );
                    $wp_query->query($param);
                    if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                ?>
                    <input type="checkbox" name="check04[]" value="<?php the_field('fullname') ?>" id="ktv_<?php echo $post->ID ?>"><label for="ktv_<?php echo $post->ID ?>"><?php the_field('fullname') ?></label><br>
                <?php endwhile;endif; ?>
            </p>
            <h3 class="h3_page">Phòng mổ</h3>
            <p class="inputBlock customSelect">
            <select name="room" id="room">
                    <option value="">Lựa chọn phòng mổ</option>
                    <option value="room_1">Phòng 1</option>
                    <option value="room_2">Phòng 2</option>
                    <option value="room_3">Phòng 3</option>
                    <option value="room_4">Phòng 4</option>
            </select>
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
            <a href="javascript:void(0)" class="btnSubmit callPopup">Bắt đầu</a>
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
	  $("#addServices").exValidation({
	    rules: {
            doctor1: "chkselect",
            doctor2: "chkselect",
            nursing1:"chkselect",
            nursing2:"chkselect",
            nursing3:"chkselect",
            nursing4:"chkselect",
            ktv:"chkselect",
            room:"chkselect",
	    },
	    stepValidation: true,
	    scrollToErr: true,
	    errHoverHide: true
	  });
    });

    $('.callPopup').click(function() {
        $('.overlay').fadeIn(200);
        $('.popUp').fadeIn(200);
    });

    $('.overlay').click(function() {
        $(this).fadeOut(200);
        $('.popUp').fadeOut(200);
    });

    $('.cancel').click(function() {
        $('.overlay').fadeOut(200);
        $('.popUp').fadeOut(200);
    });
</script>
<div class="overlay"></div>
</body>
</html>	