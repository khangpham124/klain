<?php /* Template Name: Care */ ?>
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

<body id="care">
<div class="flexBox flexBox--between flexBox--wrap">
    <?php include(APP_PATH."libs/sidebar.php"); ?>

<div id="wrapper">
<!--===================================================-->
<!--Header-->
<?php include(APP_PATH."libs/header.php"); ?>
<!--/Header-->

<div class="flexBox flexBox--between textBox flexBox--wrap maxW">
    <div class="blockPage blockPage--full">
        <h2 class="h2_page">Chăm sóc hậu phẫu</h2>
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
        <?php 
            $listService = get_field('services_list');
            $s=0;
            foreach($listService as $serv) {
            if($serv['end']!='') { $progress='<i class="fa fa-check-circle-o" aria-hidden="true"></i>'; } else { $progress='<i class="fa fa-stop-circle-o" aria-hidden="true"></i>'; }
            $time_end = strtotime($serv['end']);
            $search_key = array_search($time_end,$arr);
            if($serv['care']=='') {
        ?>
        <h4 class="h4_page <?php if($serv['do']!="yes") { ?>lock<?php } ?>">
            <em><?php echo $progress; ?></em>
            <p><?php echo $serv['name']; ?><?php if($serv['do']=="yes") { ?>(Ngày phẫu thuật xong: <?php echo $serv['end']; ?>)<?php } ?></p>
            <?php if(count($listService)>1) { ?>
                <span>
                    <?php if($serv['end']===$listService[$s]['end']) { ?>
                    (chăm sóc chung)
                    <?php } ?>
                </span>
            <?php } ?>    
            <strong><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></strong></h4>
        <div class="servicesDone">
            <form action="<?php echo APP_URL; ?>data/editSurgery.php" method="post" enctype="multipart/form-data">
                <!-- phuong thu tu van -->
                <h3 class="h3_page">Ngay sau phẫu thuật</h3>
                <textarea class="inputForm"  name="nurse_mess" placeholder="Lời dặn"><?php the_field('message_1'); ?></textarea>
                <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                    <div class="inputBlock">
                        <label class="h5_page">Bác sĩ khám</label>    
                        <p class="customSelect mt0">
                            <select name="doctor" id="doctor">
                                <option value="">Bác sĩ khám</option>
                                <?php
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
                                                'terms' => 'nursing primary'
                                            ),
                                        )
                                        );
                                    $posts_array = get_posts( $param );
                                    foreach ($posts_array as $sale ) {
                                ?>
                                    <option value="<?php echo get_field('fullname',$sale->ID); ?>"><?php echo get_field('fullname',$sale->ID); ?></option>
                                <?php } ?>
                            </select>
                        </p>
                    </div>
                    <p class="inputBlock">     
                        <label class="h5_page">Ngày Khám</label>
                        <input type="text" class="inputForm" value="<?php echo date('d-m-Y'); ?>" />
                    </p>                
                </div>
                <textarea class="inputForm" <?php if(get_field('custommer_voice_1')!='') { ?>readonly<?php } ?>  name="customer_mess" placeholder="Ý kiến khách hàng"><?php the_field('custommer_voice_1'); ?></textarea>
                <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                    <div class="inputBlock">
                    <label class="h5_page">Đánh giá của khách</label>
                        <p class="customSelect mt0">
                        <select name="rating" id="rating">
                            <option value="">Đánh giá của khách</option>
                            <option value="Hài lòng">Hài lòng</option>
                            <option value="Bình thường">Bình thường</option>
                            <option value="Không hài lòng">Không hài lòng</option>
                        </select>
                        </p>
                    </div>
                    <p class="inputBlock">     
                        <label class="h5_page">Nhân viên chăm sóc</label>
                        <input type="text" class="inputForm" readonly name="name_cskh" value="<?php echo $_COOKIE['name_cookies']; ?>" />
                    </p>
                </div>

                                                      
                <input type="hidden" name="name_cskh" value="<?php echo $_COOKIE['name_cookies']; ?>" >
                <input type="hidden" name="idSurgery" value="<?php echo $_GET['idSurgery']; ?>" >
                <input type="hidden" name="time" value="firsttime" >
                <input type="hidden" name="end" value="<?php echo $time_end; ?>" >
                <input type="hidden" name="status" value="cshp" >
                <input type="hidden" name="numb" value="<?php echo $serv['numb']; ?>" >
                <?php $s++; ?>  
                <input type="hidden" name="url" value="<?php echo $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" >
                <input type="hidden" name="action" value="edit_cshp" >
                <!-- <input class="btnSubmit" type="submit" name="submit" value="Lưu"> -->
                <button class="btnSubmit"><i class="fa fa-floppy-o" aria-hidden="true"></i>Lưu</button>
            </form>
        </div>
        <?php } } ?>
        <?php endwhile;endif; ?>
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

<script type="text/javascript" src="<?php echo APP_URL; ?>checkform/exvalidation.js"></script>
<script type="text/javascript" src="<?php echo APP_URL; ?>checkform/exchecker-ja.js"></script>
<script type="text/javascript">
	$(function(){
	  $("#addServices").exValidation({
	    rules: {
			mobile: "chkrequired",
	    },
	    stepValidation: true,
	    scrollToErr: true,
	    errHoverHide: true
	  });

    $('.h4_page').click(function() {
        $('.servicesDone').slideUp(500);
        $(this).next('.servicesDone').slideDown(500);
    });
});
</script>

</body>
</html>	