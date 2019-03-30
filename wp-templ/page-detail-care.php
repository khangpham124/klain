<?php /* Template Name: Detail Care */ ?>
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
        <div class="buttonBar">
            <a href="javascript:void(0)" class="callPopup"><i class="fa fa-user-plus" aria-hidden="true"></i>Tạo ca khám trái lịch</a>
        </div>
        <?php
            $id_sur = $_GET['idSurgery'];
            $idCustomer = 'KLAIN_19';
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
        <form action="<?php echo APP_URL; ?>data/editSurgery.php" method="post" enctype="multipart/form-data">
                <!-- phuong thu tu van -->
                <h3 class="h3_page">Ngay sau phẫu thuật</h3>
                <div class="inputBlock">
                    <textarea class="inputForm" name="info" id="info" <?php if(get_field('status_1')!='') { ?>readonly<?php } ?>  placeholder="TÌnh trạng"><?php the_field('status_1'); ?></textarea>
                </div>
                <textarea class="inputForm" <?php if(get_field('message_1')!='') { ?>readonly<?php } ?>   name="nurse_mess" placeholder="Lời dặn"><?php the_field('message_1'); ?></textarea>
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
                        <input type="text" class="inputForm" value="" />
                    </p>                
                </div>

                <input type="hidden" name="name_cskh" value="<?php echo $_COOKIE['name_cookies']; ?>" >
                <input type="hidden" name="idSurgery" value="<?php echo $_GET['idSurgery']; ?>" >
                <input type="hidden" name="time" value="firsttime" >
                <input type="hidden" name="end" value="<?php echo $time_end; ?>" >
                <input type="hidden" name="status" value="cskh" >
                <input type="hidden" name="numb" value="<?php echo $s; ?>" >
                <input type="hidden" name="action" value="edit_cshp" >
                <input class="btnSubmit" type="submit" name="submit" value="Lưu">
            </form>

            <h3 class="h3_page">Vệ sinh sau 1 ngày</h3>
            
            <h3 class="h3_page">Tái khám sau 3 ngày</h3>

            <h3 class="h3_page">Tái khám sau 5 ngày</h3>
            
            <h3 class="h3_page">Tái khám sau 10 ngày</h3>
            
            <h3 class="h3_page">Tái khám sau 1 tháng</h3>
            
            <h3 class="h3_page">Tái khám khi có vấn đề</h3>
            <div class="inputBlock">
                <input type="text" class="inputForm" id="datechose" name="datechose" value="" placeholder="Chọn ngày phẫu thuật">
                <div id="datepicker"></div>
            </div>
            <p class="inputBlock">
                <input type="text" class="inputForm" name="problem" id="problem" placeholder="Tình trạng" />
            </p>
            <textarea class="inputForm" name="problem_detail" placeholder="Lời dặn"></textarea>

            <input type="hidden" name="name_cskh" value="<?php echo $_COOKIE['name_cookies']; ?>" >
            <input type="hidden" name="idSurgery" value="<?php echo $_GET['idSurgery']; ?>" >
            <input type="hidden" name="status" value="cskh" >
            <input type="hidden" name="action" value="cskh_edit" >
            <input class="btnSubmit" type="submit" name="submit" value="Lưu">
        
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
  <script>
  $( function() {
    var currTime = new Date();  
    var hour = currTime.getHours();
    var hourText = hour.toString()
    var minutes = currTime.getMinutes();
    var minText = minutes.toString();
    var timeCompText = hourText + minText;
    var timeComp = parseInt(timeCompText);
    var dateToday = new Date();  

    $('#datepicker').datepicker({
    dateFormat: 'd-m-yy',
    minDate: dateToday,
    maxDate: "+4w",
    altField: '#datechose',
    onSelect: function (date) {
        var currTime = new Date();
        var currDate =currTime.getDate()+"-"+(currTime.getMonth()+1)+"-"+currTime.getFullYear();
        var choseDate = $(this).val();
    }
    });

    $("#datechose").on('click', function () {
        $('#datepicker').show(200);
    });

    $('#datechose').change(function(){
        $('#datepicker').datepicker('setDate', $(this).val());
    });
      
  });
</script>

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

    $('input[type=radio][name=advise]').change(function() {
        if (this.value == 'yes') {
            $('.blockAdvise').slideDown(200);
        } else {
            $('.blockAdvise').slideUp(200);    
        }
    });

    $('input[type=radio][name=hasSur]').change(function() {
        if (this.value == 'yes') {
            $('.blockSur').slideDown(200);
        } else {
            $('.blockSur').slideUp(200);    
        }
    });

    $('.callPopup').click(function() {
        $('.overlay').fadeIn(200);
        $('.popUp').fadeIn(200);
    });

    $('.overlay').click(function() {
        $(this).fadeOut(200);
        $('.popUp').fadeOut(200);
    });
});
</script>
<div class="overlay"></div>
<div class="popUp">
    <h3 class="h3_page">Tái khám khi có vấn đề</h3>
    <div class="inputBlock">
        <input type="text" class="inputForm" id="datechose" name="datechose" value="" placeholder="Chọn ngày phẫu thuật">
        <div id="datepicker"></div>
    </div>
    <p class="inputBlock">
        <input type="text" class="inputForm" name="problem" id="problem" placeholder="Tình trạng" />
    </p>
    <textarea class="inputForm" name="problem_detail" placeholder="Lời dặn"></textarea>
    <input class="btnSubmit" type="submit" name="submit" value="Lưu">
</div>
</body>
</html>	