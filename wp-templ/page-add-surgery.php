<?php /* Template Name: Add Surgery */ ?>
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
            </div>
            <!-- phuong thu tu van -->

            <h3 class="h3_page">Thông tin dịch vụ thực hiện</h3>
                <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                    <p class="inputBlock customSelect mt0">
                        <select name="services" id="services" class="services servicesSl">
                            <option value="">Lựa chọn dịch vụ</option>
                            <?php
                                $wp_query = new WP_Query();
                                $param=array(
                                'post_type'=>'services',
                                'order' => 'DESC',
                                'posts_per_page' => '-1',
                                );
                                $wp_query->query($param);
                                if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                                $terms = get_the_terms($post->ID,'servicescat');
                                foreach($terms as $term) { 
                                $type_serve = $term->name;
                                }

                                $terms_type = get_the_terms($post->ID,'typecat');
                                foreach($terms_type as $term_type) { 
                                $typecat_serve = $term_type->slug;
                                }
                            ?>
                                <option data-service="<?php echo $post->ID; ?>" data-image="<?php echo get_field('numb_image'); ?>" data-type="<?php echo $typecat_serve; ?>" data-price="<?php echo get_field('price'); ?>" class="<?php echo $type_serve; ?>" value="<?php the_title(); ?>"><?php the_title(); ?></option>
                            <?php endwhile;endif; ?>
                        </select>
                    </p>
                    <p class="inputBlock">
                    <input type="text" class="inputForm priceNumb" readonly id="price_1" name="price" value="" placeholder="Giá" />
                    </p>
                </div>
                <div id="moreBox"></div>
                <div id="moreBox2"></div>
                
                <p class="addServices"><i class="fa fa-plus-circle" aria-hidden="true"></i>thêm dịch vụ</p>
                <p class="addServices--rmv"><i class="fa fa-minus-circle" aria-hidden="true"></i>xoá dịch vụ</p>
                <p class="noteServices">(Chỉ dành cho các dịch vụ có liên quan, tối đa 3 dịch vụ)</p>
                <p class="inputBlock inputNumber">
                        <input type="text" data-type="number" class="inputForm" name="sale_discount" id="discount" value="0" placeholder="Giá giảm" />
                        <span></span>
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

                <div class="typeService" id="bodySurery" >    
                    <h4 class="h4_page">Tình trạng hiện tại</h4>
                        <input type="checkbox" class="chkForm" id="chk1" name="self_status" value="Ngực nhỏ" /><label class="labelReg" for="chk1">Ngực nhỏ</label><br class="sp">
                        <input type="checkbox" class="chkForm" id="chk2" name="self_status" value="Ngực chảy xệ" /><label class="labelReg" for="chk2">Ngực chảy xệ</label><br class="sp">
                        <input type="checkbox" class="chkForm" id="chk3" name="self_status" value="Ngực quá to" /><label class="labelReg" for="chk3">Ngực quá to</label><br class="sp">
                        <input type="checkbox" class="chkForm" id="chk4" name="self_status" value="Dư mỡ" /><label class="labelReg" for="chk4">Dư mỡ</label><br class="sp">
                        <input type="checkbox" class="chkForm" id="chk5" name="self_status" value="Mông nhỏ" /><label class="labelReg" for="chk5">Mông nhỏ</label>

                    <h4 class="h4_page">Mong muốn của khách hàng</h4>
                        <div class="form_services" id="form_nguc">
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
                                <!-- <label class="labelBlock">Loại túi</label>
                                <p class="inputBlock">
                                    <input type="radio" class="radioForm" id="styleT1" name="styleT" value="Nanochip Ergonomix" /><label class="labelReg" for="styleT1">Nanochip Ergonomix</label><br class="sp">
                                    <input type="radio" class="radioForm" id="styleT2" name="styleT" value="Nanochip" /><label class="labelReg" class="labelReg" for="styleT2">Nanochip</label><br class="sp">
                                    <input type="radio" class="radioForm" id="styleT3" name="styleT" value="Nano không chip" /><label class="labelReg" for="styleT3">Nano không chip</label><br class="sp">
                                    <input type="radio" class="radioForm" id="styleT4" name="styleT" value="Mentor" /><label class="labelReg" for="styleT4">Mentor</label><br class="sp">
                                    <input type="radio" class="radioForm" id="styleT5" name="styleT" value="Natrelle" /><label  class="labelReg"for="styleT5">Natrelle</label><br class="sp">
                                </p>
                                <label class="labelBlock">Dịch vụ kèm theo</label>
                                <input type="checkbox" class="chkForm" id="plus1" name="plus" value="Thu quầng" /><label class="labelReg" for="plus1">Thu quầng</label><br class="sp">
                                <input type="checkbox" class="chkForm" id="plus2" name="plus" value="Thu ti" /><label class="labelReg" for="plus2">Thu ti</label><br class="sp">
                                <input type="checkbox" class="chkForm" id="plus3" name="plus" value="Treo sa trễ" /><label class="labelReg" for="plus3">Treo sa trễ</label><br class="sp">
                                <input type="checkbox" class="chkForm" id="plus4" name="plus" value="Áo định hình" /><label class="labelReg" for="plus4">Áo định hình</label><br class="sp"> -->
                            </div>
                        </div>

                        <div class="form_services" id="form_mong">
                            <h5 class="h5_page">Dịch vụ mông</h5>
                            <div class="innerService">
                                <p class="inputBlock">
                                    <input type="text" class="inputForm" name="size_mong" placeholder="Kích thước" />
                                </p>
                                <!-- <label class="labelBlock">Loại túi</label>
                                <input type="text" class="inputForm" name="styleT1" placeholder="Loại túi" /> -->
                            </div>
                        </div>
                        
                        <div class="form_services" id="form_hm">
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
                </div>

                <div class="typeService" id="faceSurery" >
                    <h4 class="h4_page">Cấu trúc nguyên thuỷ</h4>
                        <textarea class="inputForm" name="origin" id="origin"></textarea>
                    <h4 class="h4_page">Mong muốn của khách hàng</h4>
                    <p class="inputBlock">
                        <!-- <input type="radio" class="radioForm" id="wish1" name="target" value="Tuỳ thuộc vào tư vấn của bác sĩ và tư vấn viên" /><label class="labelReg" for="wish1">Tuỳ thuộc vào tư vấn của bác sĩ và tư vấn viên</label>
                        <input type="radio" class="radioForm" id="wish2" name="target" value="Theo nhu cầu của khách" /><label class="labelReg" for="wish2">Theo nhu cầu của khách</label> -->
                        <textarea class="inputForm" name="target_text"></textarea>
                    </p>    
                </div>
                <?php } ?>

                <h4 class="h4_page">Tư vấn của người tư vấn</h4>
                <textarea class="inputForm" name="doctor_advise"></textarea>

                <?php if(($_COOKIE['role_cookies']=='manager')||($_COOKIE['role_cookies']=='boss')||($_COOKIE['role_cookies']=='adviser')||($_COOKIE['role_cookies']=='sale')) { ?>
                <h4 class="h4_page">Ý kiến của khách hàng</h4>
                <textarea class="inputForm" name="cus_note"></textarea>
                <?php } ?>


            <input type="hidden" name="action" value="create" >
            <input type="hidden" name="status" value="tvv" >
            <input type="hidden" name="numb_image" id="numb_image" value="" >
            <div class="flexBox flexBox--arround flexBox__form flexBox__form--3">
                <input class="btnSubmit" type="submit" name="submit" value="Tạo">
                <input class="btnSubmit btnSubmit--dr" type="submit" name="pending" value="Chờ khám">
                <a href="<?php echo APP_URL; ?>print?idSurgery=<?php echo $id_sur; ?>" class="btnSubmit <?php if(get_field('accept')=='no') { ?>disable<?php } ?>"><i class="fa fa-print" aria-hidden="true"></i> In</a>
            </div>
        </form>
    </div>
</div>


<!--Footer-->
<?php include(APP_PATH."libs/footer.php"); ?>
<!--/Footer-->
<!--===================================================-->
</div>
<!--/wrapper-->
<!--===================================================-->

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

    $('#services').on('change', function() {
        var type = $('select[name="services"] :selected').attr('class');
        var type_detail = $('select[name="services"] :selected').attr('data-type');
        var numb_image = $('select[name="services"] :selected').attr('data-image');
        $('#numb_image').val(numb_image);
        if(type=='body') {
            $('.typeService').slideUp(200);
            $('.form_services').slideUp(200);
            $('#bodySurery').slideDown(200);
            $('#form_'+type_detail).slideDown(200);
        } else {
            $('.typeService').slideUp(200);
            $('#faceSurery').slideDown(200);
        }
    });

    $('.servicesSl').live('change',function(){
        var price = $('option:selected',this).attr('data-price');
        $(this).parent().next().find('.priceNumb').val(price);
        // var p1 = $('#price_1').val();
        // var p2 = $('#price_2').val();
        // var p3 = $('#price_3').val();
        // var tt_templ = p1 + p2 + p3;
        // console.log(p1);
        // var sale_discount = $('#sale_discount').val();
        // var total_templ = tt_templ - sale_discount;
        // $('#total_templ').val(total_templ);
    });
    
    $('.addServices').click(function() {
        var services = $('select[name="services"] :selected').attr('data-service');
        var content = $('#moreBox').text();
        if(content=='') {
            var divappend = $('#moreBox');  
            var count = 2;  
        } else {
            var divappend = $('#moreBox2');
            var count = 3;
            $(this).hide(200);
            $('.noteServices').hide(200);
        }
        $('<p class="taC"><img src="<?php echo APP_URL; ?>common/img/icon/loading.gif" alt ></p>').appendTo(divappend);
        $('.addServices--rmv').css('display','inline-block');
        $.ajax({
            url: 'http://vnese-freelance.co/projects/klain/data/loadServices.php?services=' + services +'&count='+ count,
            }).done(function(data) { // data what is sent back by the php page
            divappend.html(data); // display data
        });
    });

    $('.addServices--rmv').click(function() {
        var content = $('#moreBox').text();
        var content2 = $('#moreBox2').text();
        if((content!='')&&(content2!='')) {
            $('#moreBox2').empty();
        }
        if((content!='')&&(content2=='')) {
            $('#moreBox').empty();
        }
        $('.addServices').css('display','inline-block');
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