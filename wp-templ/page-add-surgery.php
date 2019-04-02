<?php /* Template Name: Add Surgery */ ?>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/app_config.php");
if(!$_COOKIE['login_cookies']) {    
	header('Location:'.APP_URL.'login');
}
if($_COOKIE['role_cookies']=='doctor') {
    header('Location:'.APP_URL);
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
    <div id="wrapper">
    <!--Header-->
    <?php include(APP_PATH."libs/header.php"); ?>
    <!--/Header-->

    <div class="flexBox flexBox--between textBox flexBox--wrap maxW">
        <div class="blockPage blockPage--full">
            <h2 class="h2_page">Thông tin Khởi tạo dịch vụ</h2>
            <h3 class="h3_page">Tra cứu thông tin khách hàng</h3>
            <?php include(APP_PATH."libs/searchBlock_2.php"); ?>
            <?php 
            if($_POST['search']) {
                include(APP_PATH."data/searchResult.php");
            }
            ?>
            <form action="<?php echo APP_URL; ?>data/addSurgery.php" method="post" enctype="multipart/form-data" id="addServices">
                <?php if(($_COOKIE['role_cookies']=='manager')||($_COOKIE['role_cookies']=='boss')||($_COOKIE['role_cookies']=='adviser')||($_COOKIE['role_cookies']=='sale')) { ?>
                <h3 class="h3_page">Thông tin cơ bản</h3>
                <div class="flexBox flexBox--between flexBox__form flexBox__form--3">
                    <p class="inputBlock">
                    <input type="text" class="inputForm" name="cusid_post" readOnly id="cusid_post" value="" placeholder="ID" />
                    </p>
                    <p class="inputBlock">
                    <input type="text" class="inputForm" name="fullname" readOnly id="fullname" value="" placeholder="Họ tên" />
                    </p>
                    <p class="inputBlock">
                    <input type="number" class="inputForm" name="mobile" readOnly id="mobile" id="mobile" placeholder="Số điện thoại" />
                    </p>
                </div>
                <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                <p class="inputBlock">
                    <input type="text" class="inputForm" name="idcard" readOnly id="idcard" id="idcard" placeholder="CMND" />
                    </p>
                    <p class="inputBlock">
                    <input type="text" class="inputForm" name="address" readOnly id="address" id="address" placeholder="Địa chỉ" />
                    </p>
                </div>
                
                <!-- phuong thu tu van -->
                <h3 class="h3_page">Thông tin tư vấn</h3>
                <p class="inputBlock" id="radAdvise">
                    <input type="radio" class="radioForm" id="rad1" name="advise" value="yes" /><label class="labelReg" for="rad1">Đã được tư vấn</label>
                    <input type="radio" class="radioForm" id="rad2" name="advise" value="no" /><label class="labelReg" for="rad2">Chưa được tư vấn</label>
                </p>
                <div class="blockAdvise">
                    <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                        <p class="inputBlock customSelect">
                            <select name="adviser" id="adviser">
                                <option value="">Lựa chọn tư vấn viên</option>
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
                                        'terms' => 'sale'
                                        ),
                                        array(
                                            'taxonomy' => 'userscat',
                                            'field' => 'slug',
                                            'terms' => 'adviser'
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
                        <p class="inputBlock customSelect">
                            <select name="channel">
                                <option value="">Lựa chọn kệnh tư vấn</option>
                                <option value="facebook">Qua facebook</option>
                                <option value="mobile">Qua Điện thoại</option>
                                <option value="tmv">Tại TMV</option>
                            </select>
                        </p>  
                    </div>
                    <p class="inputBlock blockFacebook">
                        <input type="text" class="inputForm" name="facebook" id="facebook" placeholder="Facebook của khách" />
                    </p>
                    <h4 class="h4_page h4_page--services">Tư vấn mới nhất</h4>
                    <div class="adviserBox">
                        <?php
                        $rows = get_field('timeline',$cusId);
                        $lastCount = count($rows);
                        $last_adv = $lastCount - 1;
                        $first_row = $rows[$last_adv];
                        ?>
                        <p class="date"><?php echo $first_row['date' ] ?></p>
                        <div class="content">Nội dung:<?php echo $first_row['content' ] ?></div>
                        <p class="adviser">Tư vấn viên:<?php echo $first_row['adviser' ] ?></p>
                    </div>
                    
                    <textarea class="inputForm" name="advise_f" placeholder=""></textarea>
                </div>
                <!-- phuong thu tu van -->

                <h3 class="h3_page">Thông tin dịch vụ thực hiện</h3>
                    <?php
                        $args=array(
                            'child_of' => 0,
                            'orderby' =>'ID',
                            'order' => 'DESC',
                            'hide_empty' => 1,
                            'taxonomy' => 'typecat',
                            'number' => '0',
                            'pad_counts' => false
                            );
                            $categories = get_categories($args);
                            foreach ( $categories as $category ):
                            $slug = $category->slug;
                    ?>
                    <h4 class="h4_page h4_page--services"><?php echo $category->name; ?></h4>
                    <?php
                        $wp_query = new WP_Query();
                        $param=array(
                        'post_type'=>'services',
                        'order' => 'DESC',
                        'posts_per_page' => '-1',
                        'tax_query' => array(
                        array(
                        'taxonomy' => 'typecat',
                        'field' => 'slug',
                        'terms' => $slug
                        )
                        )
                        );
                        $wp_query->query($param);
                        if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                    ?>
                    <div class="flexBox flexBox--between flexBox--center flexBox__form flexBox__form--2" id="listServices">
                        <label class="checkStyle">
                            <?php the_title(); ?>
                            <input type="checkbox" class="servName" data-price="<?php echo get_field('price'); ?>" name="services[]" value="<?php the_title(); ?>">
                            <span class="checkmark"></span>
                        </label>
                        <p class="inputBlock">
                        <input type="text" class="inputForm priceNumb" id="price_<?php the_ID() ?>" readonly  name="price_<?php the_ID(); ?>" value="<?php echo number_format(get_field('price')); ?>" placeholder="" />
                        </p>
                    </div>
                    <?php endwhile;endif; ?>
                    <?php endforeach; ?>
                    <h4 class="h4_page h4_page--services">Giảm giá</h4>
                    <p class="inputBlock inputNumber">
                        <input type="text" class="inputForm" name="sale_discount" id="discount" value="0" />
                    </p>


                    <h4 class="h4_page h4_page--services">Tổng tiền tạm tính</h4>
                    <p class="inputBlock inputNumber__new">
                        <input type="text" class="inputForm" name="total_templ" id="total_templ" value="0"/>
                        <input type="hidden" name="total_hide" id="total_hide" value="0"/>
                        <span id="tt_mask"></span>
                    </p>
                <!-- ADD SERVICES -->

                <!-- DATE -->
                    <div class="flexBox flexBox--between flexBox__form flexBox__form--2 mt10">
                        <div class="inputBlock">
                            <input type="text" class="inputForm" id="datechose" name="datechose" value="" placeholder="Chọn ngày phẫu thuật">
                            <div id="datepicker"></div>
                        </div>
                    </div>
                <!-- DATE -->          

                    <h4 class="h4_page">Lịch sử phẫu thuật (đồi với dịch cụ yêu cầu)</h4>
                    <p class="inputBlock" id="radHis">
                        <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Đã từng</label>
                        <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Chưa từng</label>
                    </p>

                    <div class="blockSur">
                        <div class="inputBlock">
                            <label>Chi tiết ca phẫu thuật trước</label>
                            <textarea class="inputForm" name="howto" placeholder="phương pháp thực hiện"></textarea>
                            <textarea class="inputForm" name="doctorOld" placeholder="tên bác sĩ"></textarea>
                            <textarea class="inputForm" name="statusOld" placeholder="Tình trạng viêm hoặc nhiễm trùng"></textarea>
                        </div>

                        <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                            <p class="inputBlock">
                                <input type="text" class="inputForm" name="oldtime" placeholder="Thời điểm phẫu thuật" />
                            </p>
                            <p class="inputBlock customSelect mt0">
                                <select name="reason" id="reason">
                                    <option value="">Lý do muốn làm lại</option>
                                    <option value="Do ý muốn chủ quan (không thích hình dáng đã phẫu thuật trước đó)">Do ý muốn chủ quan (không thích hình dáng đã phẫu thuật trước đó)</option>
                                    <option value="Do có vấn đề (viêm, nhiễm trùng, lệch méo, hỏng ...)">Do có vấn đề (viêm, nhiễm trùng, lệch méo, hỏng ...)</option>
                                </select>
                            </p>
                        </div>
                    </div>
                    <ul class="tabItem tabItem--4 flexBox flexBox--center flexBox--wrap">
                            <li><a href="javascript:void(0)"  data-id="tab1">MŨI</a></li>
                            <li><a href="javascript:void(0)"  data-id="tab2">MÔNG</a></li>
                            <li><a href="javascript:void(0)"  data-id="tab3">HÚT MỠ</a></li>
                            <li><a href="javascript:void(0)"  data-id="tab4">NGỰC</a></li>
                        </ul>

                        <div class="tabContent">
                            <div class="tabBox" id="tab1">
                            <h4 class="h4_page">Cấu trúc nguyên thuỷ</h4>
                                <textarea class="inputForm" name="origin" id="origin"></textarea>
                            <h4 class="h4_page">Mong muốn của khách hàng</h4>
                            <p class="inputBlock">
                                <textarea class="inputForm" name="target_text"></textarea>
                            </p>
                            </div>

                            <div class="tabBox" id="tab2">
                                <h5 class="h5_page">Dịch vụ mông</h5>
                                <div class="innerService">
                                    <p class="inputBlock">
                                        <input type="text" class="inputForm" name="size_mong" placeholder="Kích thước" />
                                    </p>
                                    
                                </div>
                            </div>

                            <div class="tabBox" id="tab3">
                                <h5 class="h5_page">Dịch vụ hút mỡ</h5>
                                    <div class="innerService">
                                        <label class="labelBlock">Bụng</label>
                                            <p class="inputBlock">
                                            <input type="checkbox" class="chkForm" id="stomach1" name="stomach" value="Trên" /><label class="labelReg" for="stomach1">Trên</label><br class="sp">
                                            <input type="checkbox" class="chkForm" id="stomach2" name="stomach" value="Dưới" /><label class="labelReg" for="stomach2">Dưới</label><br class="sp">
                                            <input type="checkbox" class="chkForm" id="stomach3" name="stomach" value="Eo" /><label class="labelReg" for="stomach3">Eo</label><br class="sp">
                                            <input type="checkbox" class="chkForm" id="stomach4" name="stomach" value="Lưng" /><label class="labelReg" for="stomach4">Lưng</label><br class="sp">
                                            <input type="checkbox" class="chkForm" id="stomach5" name="stomach" value="Cải thiện toàn bộ" /><label class="labelReg" for="stomach5">Cải thiện toàn bộ</label>
                                            </p>
                                        <label class="labelBlock">Tạo hình bụng</label>
                                            <p class="inputBlock">
                                                <input type="radio" class="radioForm" id="shape3" name="shape_hm" value="Yes" /><label class="labelReg" for="shape3">Có</label>
                                                <input type="radio" class="radioForm" id="shape4" name="shape_hm" value="No" /><label for="shape4">Không</label>
                                            </p>
                                        <label class="labelBlock">Bắp tay</label>
                                        <textarea class="inputForm" name="arm"></textarea>
                                        <label class="labelBlock">Đùi</label>
                                        <textarea class="inputForm" name="thighs"></textarea>
                                    </div>
                            </div>

                            <div class="tabBox" id="tab4">
                                <h4 class="h4_page">Tình trạng hiện tại</h4>
                                <input type="checkbox" class="chkForm" id="chk1" name="self_status" value="Ngực nhỏ" /><label class="labelReg" for="chk1">Ngực nhỏ</label><br class="sp">
                                <input type="checkbox" class="chkForm" id="chk2" name="self_status" value="Ngực chảy xệ" /><label class="labelReg" for="chk2">Ngực chảy xệ</label><br class="sp">
                                <input type="checkbox" class="chkForm" id="chk3" name="self_status" value="Ngực quá to" /><label class="labelReg" for="chk3">Ngực quá to</label><br class="sp">
                                <input type="checkbox" class="chkForm" id="chk4" name="self_status" value="Dư mỡ" /><label class="labelReg" for="chk4">Dư mỡ</label><br class="sp">
                                <input type="checkbox" class="chkForm" id="chk5" name="self_status" value="Mông nhỏ" /><label class="labelReg" for="chk5">Mông nhỏ</label>
                                <h4 class="h4_page">Mong muốn của khách hàng</h4>
                                <h5 class="h5_page">Dịch vụ ngực</h5>
                                <div class="innerService">
                                    <p class="inputBlock">
                                        <input type="text" class="inputForm" name="size_nguc" placeholder="Kích thước" />
                                    </p>
                                    <label class="labelBlock">Dáng ngực</label>
                                    <p class="inputBlock">
                                        <input type="radio" class="radioForm" id="shape1" name="shape" value="Tròn" /><label class="labelReg" for="shape1">Tròn</label>
                                        <input type="radio" class="radioForm" id="shape2" name="shape" value="Giọt nước" /><label class="labelReg" for="shape2">Giọt nước</label>
                                    </p>
                                </div>
                            </div>
                        </div>    
                
                    <?php } ?>

                    <h4 class="h4_page">Tư vấn của người tư vấn</h4>
                    <textarea class="inputForm" name="doctor_advise" id="doctor_advise"></textarea>

                    <?php if(($_COOKIE['role_cookies']=='manager')||($_COOKIE['role_cookies']=='boss')||($_COOKIE['role_cookies']=='adviser')||($_COOKIE['role_cookies']=='sale')) { ?>
                    <h4 class="h4_page">Ý kiến của khách hàng</h4>
                    <textarea class="inputForm" name="cus_note" id="cus_note"></textarea>
                    <?php } ?>


                <input type="hidden" name="action" value="create" >
                <input type="hidden" name="status" value="tvv" >
                <!-- <input type="hidden" name="numb_image" id="numb_image" value="" > -->
                <div class="flexBox flexBox--arround flexBox__form--2">
                    <input class="btnSubmit" type="submit" name="submit" value="Tạo">
                    <input class="btnSubmit btnSubmit--dr" type="submit" name="pending" value="Chờ khám">
                    <!-- <a href="<?php echo APP_URL; ?>print?idSurgery=<?php echo $id_sur; ?>" class="btnSubmit <?php if(get_field('accept')=='no') { ?>disable<?php } ?>"><i class="fa fa-print" aria-hidden="true"></i> In</a> -->
                </div>
            </form>
        </div>
    </div>


    <!--Footer-->
    <?php include(APP_PATH."libs/footer.php"); ?>
    <!--/Footer-->
    </div>
<!--/wrapper-->
</div>

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
    // minDate: dateToday,
    // maxDate: "+4w",
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
            fullname: "chkrequired",
            address: "chkrequired",
            mobile: "chkrequired",
            doctor_advise: "chkrequired",
            cus_note: "chkrequired",
            datechose: "chkrequired",
            listServices:"chkcheckbox"
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


    $('.servName').on('change', function() {
        if ($(this).is(':checked')) {
            var price = $(this).attr('data-price');
            var tt_templ = $('#total_templ').val();
            var total_templ = parseInt(price) + parseInt(tt_templ);
            $('#total_templ').val(total_templ);
            $('#total_hide').val(total_templ);
            $('#tt_mask').text(numberWithCommas(total_templ));
        } else {
            var price = $(this).attr('data-price');
            var tt_templ = $('#total_templ').val();
            var total_templ =  parseInt(tt_templ) - parseInt(price);
            $('#total_templ').val(total_templ);
            $('#total_hide').val(total_templ);
            $('#tt_mask').text(numberWithCommas(total_templ));
        }
    });

    $('#discount').live('focusout', function(){
        var tt_templ = $('#total_hide').val();
        var discount = $(this).val();
        var remain = parseInt(tt_templ) - parseInt(discount);
        $('#total_templ').val(remain);
        $('#tt_mask').text(numberWithCommas(remain));
    });
    

    $('#getData').click(function() {
        var cus_id = $('#cus_id').text();
        var cus_name = $('#cus_name').text();
        var cus_mobile = $('#cus_mobile').text();
        var cus_add = $('#cus_add').text();
        var cus_idcard = $('#cus_idcard').text();
        $("#cusid_post").val(cus_id);
        $("#fullname").val(cus_name);
        $("#mobile").val(cus_mobile);
        $("#address").val(cus_add);
        $("#idcard").val(cus_idcard);
    });

    $('#tab1').show();
    $('.tabItem li:nth-child(1)').addClass('active');
    $('.tabItem li').click(function() {
        $('.tabItem li').removeClass('active');
        $(this).toggleClass('active');
        var tabId = $(this).find('a').attr('data-id');
        $('.tabBox').fadeOut(200);
        $('#'+tabId).fadeIn(200);
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