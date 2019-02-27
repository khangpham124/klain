<?php /* Template Name: Care */ ?>
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
<!--===================================================-->
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
            <a href="javascript:void(0)" onClick="window.location.href=window.location.href"><i class="fa fa-refresh" aria-hidden="true"></i>Cập nhật hệ thống</a>
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
        <form action="<?php echo APP_URL; ?>data/editSurgery.php" method="post" enctype="multipart/form-data" id="addServices">
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
            
            <!-- phuong thu tu van -->
            <h3 class="h3_page">Ngay sau phẫu thuật</h3>
            <div class="inputBlock">
                <textarea class="inputForm" name="after_surgery" id="after_surgery" <?php if(get_field('status_1')!='') { ?>readonly<?php } ?>  placeholder="TÌnh trạng"><?php the_field('status_1'); ?></textarea>
            </div>
            <textarea class="inputForm" <?php if(get_field('message_1')!='') { ?>readonly<?php } ?>    name="message_1" placeholder="Lời dặn"><?php the_field('message_1'); ?></textarea>
            <textarea class="inputForm" <?php if(get_field('custommer_voice_1')!='') { ?>readonly<?php } ?>  name="custommer_voice_1" placeholder="Ý kiến khách hàng"><?php the_field('custommer_voice_1'); ?></textarea>
            <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                <p class="inputBlock customSelect mt0">
                    <select name="rating_1" id="rating_1">
                    <option>Đánh giá của khách</option>
                    <option value="Hài lòng">Hài lòng</option>
                    <option value="Bình thường">Bình thường</option>
                    <option value="Không hài lòng">Không hài lòng</option>
                    </select>
                </p>
                <p class="inputBlock">
                <input type="text" class="inputForm" readonly value="<?php the_field('emp_1'); ?>" />
                </p>
            </div>

            <h3 class="h3_page">Vệ sinh sau 1 ngày</h3>
            <div class="inputBlock">
                <textarea class="inputForm" <?php if(get_field('status_2')!='') { ?>readonly<?php } ?>  name="after_1day" id="after_1day" placeholder="TÌnh trạng"><?php the_field('status_2'); ?></textarea>
            </div>
            <textarea class="inputForm" <?php if(get_field('message_2')!='') { ?>readonly<?php } ?>  name="message_2" placeholder="Lời dặn"><?php the_field('message_2'); ?></textarea>
            <textarea class="inputForm" <?php if(get_field('custommer_voice_2')!='') { ?>readonly<?php } ?>  name="custommer_voice_2" placeholder="Ý kiến khách hàng"><?php the_field('custommer_voice_2'); ?></textarea>

            <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                <p class="inputBlock customSelect mt0">
                    <select name="rating_2" id="rating_2">
                    <option>Đánh giá của khách</option>
                    <option value="Hài lòng">Hài lòng</option>
                    <option value="Bình thường">Bình thường</option>
                    <option value="Không hài lòng">Không hài lòng</option>
                    </select>
                </p>
                <p class="inputBlock">
                <input type="text" class="inputForm" readonly value="<?php the_field('emp_2'); ?>" />
                </p>
            </div>
            
            <!-- <label class="file">
            <input type="file" name="file" id="file" aria-label="File browser example">
            <span class="file-custom"></span>
            </label> -->

            <h3 class="h3_page">Tái khám sau 5 ngày</h3>
            <div class="inputBlock">
        <textarea class="inputForm" name="after_5day" <?php if(get_field('status_3')!='') { ?>readonly<?php } ?> id="after_5day" placeholder="TÌnh trạng"><?php the_field('status_3'); ?></textarea>
            </div>
            <textarea class="inputForm" <?php if(get_field('message_3')!='') { ?>readonly<?php } ?>  name="message_3" placeholder="Lời dặn"><?php the_field('message_3'); ?></textarea>
            <textarea class="inputForm" <?php if(get_field('custommer_voice_3')!='') { ?>readonly<?php } ?>  name="custommer_voice_3" placeholder="Ý kiến khách hàng"><?php the_field('custommer_voice_3'); ?></textarea>

            <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                <p class="inputBlock customSelect mt0">
                    <select name="rating_3" id="rating_3">
                    <option>Đánh giá của khách</option>
                    <option value="Hài lòng">Hài lòng</option>
                    <option value="Bình thường">Bình thường</option>
                    <option value="Không hài lòng">Không hài lòng</option>
                    </select>
                </p>
                <p class="inputBlock">
                <input type="text" class="inputForm" readonly value="<?php the_field('emp_3'); ?>" />
                </p>
            </div>

            <h3 class="h3_page">Tái khám sau 10 ngày</h3>
            <div class="inputBlock">
                <textarea class="inputForm" <?php if(get_field('status_4')!='') { ?>readonly<?php } ?>  name="after_10day" id="after_10day" placeholder="TÌnh trạng"><?php the_field('status_4'); ?></textarea>
            </div>
            <textarea class="inputForm" <?php if(get_field('message_4')!='') { ?>readonly<?php } ?>  name="message_4" placeholder="Lời dặn"><?php the_field('message_4'); ?></textarea>
            <textarea class="inputForm" <?php if(get_field('custommer_voice_4')!='') { ?>readonly<?php } ?>  name="custommer_voice_4" placeholder="Ý kiến khách hàng"><?php the_field('custommer_voice_4'); ?></textarea>
            <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                <p class="inputBlock customSelect mt0">
                    <select name="rating_4" id="rating_4">
                    <option>Đánh giá của khách</option>
                    <option value="Hài lòng">Hài lòng</option>
                    <option value="Bình thường">Bình thường</option>
                    <option value="Không hài lòng">Không hài lòng</option>
                    </select>
                </p>
                <p class="inputBlock">
                <input type="text" class="inputForm" readonly value="<?php the_field('emp_4'); ?>" />
                </p>
            </div>

            <h3 class="h3_page">Tái khám sau 1 tháng</h3>
            <div class="inputBlock">
                <textarea class="inputForm" name="after_1month" <?php if(get_field('status_5')!='') { ?>readonly<?php } ?>  id="after_1month" placeholder="TÌnh trạng"><?php the_field('status_5'); ?></textarea>
            </div>
            <textarea class="inputForm" <?php if(get_field('message_5')!='') { ?>readonly<?php } ?>  name="message_5" placeholder="Lời dặn"><?php the_field('message_5'); ?></textarea>
            <textarea class="inputForm" <?php if(get_field('custommer_voice_5')!='') { ?>readonly<?php } ?>  name="custommer_voice_5" placeholder="Ý kiến khách hàng"><?php the_field('custommer_voice_5'); ?></textarea>
            <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                <p class="inputBlock customSelect mt0">
                    <select name="rating_5" id="rating_5">
                    <option>Đánh giá của khách</option>
                    <option value="Hài lòng">Hài lòng</option>
                    <option value="Bình thường">Bình thường</option>
                    <option value="Không hài lòng">Không hài lòng</option>
                    </select>
                </p>
                <p class="inputBlock">
                <input type="text" class="inputForm" readonly value="<?php the_field('emp_5'); ?>" />
                </p>
            </div>


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
        </form>
        <?php endwhile;endif; ?>
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