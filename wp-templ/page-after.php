<?php /* Template Name: After Surgery */ ?>
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
        
        <h3 class="h3_page">Tra cứu thông tin khách hàng cũ</h3>
        <form action="" method="post" class="formSearch">
            <p class="inputBlock">
            <input type="text" name="search" class="inputForm" placeholder="Tìm kiếm" />
            <input type="submit" class="submitBtn searchBtn">
            </p>
        </form>
        <?php
            $wp_query = new WP_Query();
            $param = array (
            'posts_per_page' => '-1',
            'post_type' => 'customers',
            'post_status' => 'publish',
            'order' => 'DESC',
            'meta_query' => array(
            array(
            'key' => 'idcard',
            'value' => $_POST['mobile'],
            'compare' => '='
            ))
            
            );
            $wp_query->query($param);
            if($wp_query->have_posts()): 
        ?>
        <h2 class="h2_page">Kết quả tìm kiếm</h2>
        <table class="tblPage">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Họ tên</td>
                    <td>Số điện thoại</td>
                    <td>Số CMND</td>
                    <td>Facebook</td>
                </tr>
            </thead>
            <tbody>
                <?php 
                    while($wp_query->have_posts()) :$wp_query->the_post();
                ?>
                <tr>
                    <td>1</td>
                    <td><?php the_title(); ?></td>
                    <td><?php the_field('monbile') ?></td>
                    <td><?php the_field('idcard') ?></td>
                    <td class="last text"><a href="">Sử dụng</i></a></td>
                </tr>
                <tr>
                <?php endwhile; ?>    
            </tbody>
        </table>
        <?php endif; ?>


        <form action="" method="post" enctype="multipart/form-data" id="addServices">
            <h3 class="h3_page">Thông tin cơ bản</h3>
            <div class="flexBox flexBox--between flexBox__form flexBox__form--3">
                <p class="inputBlock">
                <input type="text" class="inputForm" name="fullname" placeholder="Họ tên" />
                </p>
                <p class="inputBlock">
                <input type="number" class="inputForm" name="mobile" id="mobile" placeholder="Số điện thoại" />
                </p>
                <p class="inputBlock">
                <input type="text" class="inputForm" name="address" id="address" placeholder="Địa chỉ" />
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
                        <select name="position">
                            <option value="">Lựa chọn tư vấn viên</option>
                            <?php
                                $wp_query = new WP_Query();
                                $param=array(
                                'post_type'=>'users',
                                'order' => 'DESC',
                                'posts_per_page' => '-1',
                                'tax_query' => array(
                                array(
                                'taxonomy' => 'userscat',
                                'field' => 'slug',
                                'terms' => 'sale'
                                )
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
                        <select name="position">
                            <option value="">Lựa chọn kệnh tư vấn</option>
                            <option value="facebook">Qua facebook</option>
                            <option value="mobile">Qua Điện thoại</option>
                        </select>
                    </p>  
                </div>
                <p class="inputBlock blockFacebook">
                    <input type="text" class="inputForm" name="mobile" placeholder="Facebook của khách" />
                </p>  
            </div>
            <!-- phuong thu tu van -->

            <h3 class="h3_page">Thông tin dịch vụ thực hiện</h3>
                <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                    <p class="inputBlock customSelect mt0">
                        <select name="services">
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
                            ?>
                                <option value="<?php the_title(); ?>"><?php the_title(); ?></option>
                            <?php endwhile;endif; ?>
                        </select>
                    </p>

                    <div class="inputBlock">
                        <input type="text" class="inputForm" id="datechose" name="datechose" value="" placeholder="Chọn ngày phẫu thuật">
                        <div id="datepicker"></div>
                    </div>
                </div>

                <h4 class="h4_page">Lịch sử phẫu thuật (đồi với dịch cụ yêu cầu)</h4>
                <p class="inputBlock" id="radHis">
                    <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Đã từng</label>
                    <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Chưa từng</label>
                </p>

                <div class="blockSur">
                    <p class="inputBlock">
                        <label>Chi tiết ca phẫu thuật trước (phương pháp thực hiện, tên bác sĩ, tình trạng viêm hoặc nhiễm trùng)</label>
                        <textarea class="inputForm" name="fullname"></textarea>
                    </p>
                    <p class="inputBlock">
                        <input type="text" class="inputForm" name="fullname" placeholder="Thời điểm phẫu thuật" />
                    </p>
                    <p class="inputBlock mt20">
                        <label>Lý do muốn làm lại</label>
                        <textarea class="inputForm" name="fullname"></textarea>
                    </p>
                </div>

                <div class="bodySurery">
                    <h4 class="h4_page">Tình trạng hiện tại</h4>
                        <input type="checkbox" class="chkForm" id="chk1" name="fullname" value="Ngực nhỏ" /><label class="labelReg" for="chk1">Ngực nhỏ</label>
                        <input type="checkbox" class="chkForm" id="chk2" name="fullname" value="Ngực chảy xệ" /><label class="labelReg" for="chk2">Ngực chảy xệ</label>
                        <input type="checkbox" class="chkForm" id="chk3" name="fullname" value="Ngực quá to" /><label class="labelReg" for="chk3">Ngực quá to</label>
                        <input type="checkbox" class="chkForm" id="chk4" name="fullname" value="Dư mỡ" /><label class="labelReg" for="chk4">Dư mỡ</label>
                        <input type="checkbox" class="chkForm" id="chk5" name="fullname" value="Mông nhỏ" /><label class="labelReg" for="chk5">Mông nhỏ</label>

                    <h4 class="h4_page">Mong muốn của khách hàng</h4>
                        <div class="form_services" id="form_nguc">
                            <h5 class="h5_page">Dịch vụ ngực</h5>
                            <div class="innerService">
                                <p class="inputBlock">
                                    <input type="text" class="inputForm" name="mobile" placeholder="Kích thước" />
                                </p>
                                <label class="labelBlock">Dáng ngực</label>
                                <p class="inputBlock">
                                    <input type="radio" class="radioForm" id="rad3" name="hasSur" value="Tròn" /><label class="labelReg" for="rad3">Tròn</label>
                                    <input type="radio" class="radioForm" id="rad4" name="hasSur" value="Giọt nước" /><label class="labelReg" for="rad4">Giọt nước</label>
                                </p>
                                <label class="labelBlock">Loại túi</label>
                                <p class="inputBlock">
                                    <input type="radio" class="radioForm" id="rad3" name="hasSur" value="Tròn" /><label class="labelReg" for="rad3">Nanochip Ergonomix</label>
                                    <input type="radio" class="radioForm" id="rad4" name="hasSur" value="Giọt nước" /><label class="labelReg" class="labelReg" for="rad4">Nanochip</label>
                                    <input type="radio" class="radioForm" id="rad4" name="hasSur" value="Giọt nước" /><label class="labelReg" for="rad4">Nano không chip</label>
                                    <input type="radio" class="radioForm" id="rad4" name="hasSur" value="Giọt nước" /><label class="labelReg" for="rad4">Mentor</label>
                                    <input type="radio" class="radioForm" id="rad4" name="hasSur" value="Giọt nước" /><label  class="labelReg"for="rad4">Natrelle</label>
                                </p>
                                <label class="labelBlock">Dịch vụ kèm theo</label>
                                <input type="checkbox" class="chkForm" id="chk1" name="fullname" value="Ngực nhỏ" /><label class="labelReg" for="chk1">Thu quầng</label>
                                <input type="checkbox" class="chkForm" id="chk1" name="fullname" value="Ngực nhỏ" /><label class="labelReg" for="chk1">Thu ti</label>
                                <input type="checkbox" class="chkForm" id="chk1" name="fullname" value="Ngực nhỏ" /><label class="labelReg" for="chk1">Treo sa trễ</label>
                                <input type="checkbox" class="chkForm" id="chk1" name="fullname" value="Ngực nhỏ" /><label class="labelReg" for="chk1">Áo định hình</label>
                            </div>
                        </div>

                        <div class="form_services" id="form_mong">
                            <h5 class="h5_page">Dịch vụ mông</h5>
                            <div class="innerService">
                                <p class="inputBlock">
                                    <input type="text" class="inputForm" name="mobile" placeholder="Kích thước" />
                                </p>
                                <label class="labelBlock">Loại túi</label>
                                <input type="text" class="inputForm" name="mobile" placeholder="Loại túi" />
                            </div>
                        </div>
                        
                        <div class="form_services" id="form_nguc">
                            <h5 class="h5_page">Dịch vụ hút mỡ</h5>
                            <div class="innerService">
                                <label class="labelBlock">Bụng</label>
                                    <p class="inputBlock">
                                    <input type="checkbox" class="chkForm" id="chk1" name="fullname" value="Trên" /><label class="labelReg" for="chk1">Trên</label>
                                    <input type="checkbox" class="chkForm" id="chk1" name="fullname" value="Dưới" /><label class="labelReg" for="chk1">Dưới</label>
                                    <input type="checkbox" class="chkForm" id="chk1" name="fullname" value="Eo" /><label class="labelReg" for="chk1">Eo</label>
                                    <input type="checkbox" class="chkForm" id="chk1" name="fullname" value="Lưng" /><label class="labelReg" for="chk1">Lưng</label>
                                    <input type="checkbox" class="chkForm" id="chk1" name="fullname" value="Cải thiện toàn bộ" /><label class="labelReg" for="chk1">Cải thiện toàn bộ</label>
                                    </p>
                                <label class="labelBlock">Tạo hình bụng</label>
                                    <p class="inputBlock">
                                        <input type="radio" class="radioForm" id="rad3" name="hasSur" value="Yes" /><label class="labelReg" for="rad3">Có</label>
                                        <input type="radio" class="radioForm" id="rad4" name="hasSur" value="No" /><label for="rad4">Không</label>
                                    </p>
                                <label class="labelBlock">Bắp tay</label>
                                <textarea class="inputForm"></textarea>
                                <label class="labelBlock">Đùi</label>
                                <textarea class="inputForm"></textarea>
                            </div>
                        </div>
                </div>

                <div class="faceSurery">
                    <h4 class="h4_page">Cấu trúc nguyên thuỷ</h4>
                        <textarea class="inputForm"></textarea>
                    <h4 class="h4_page">Mong muốn của khách hàng</h4>
                    <p class="inputBlock">
                        <input type="radio" class="radioForm" id="rad5" name="fullname" /><label class="labelReg" for="rad5">Tuỳ thuộc vào tư vấn của bác sĩ và tư vấn viên</label>
                        <input type="radio" class="radioForm" id="rad6" name="fullname" /><label class="labelReg" for="rad6">Theo nhu cầu của khách</label>
                        <textarea class="inputForm"></textarea>
                    </p>    
                </div>
                <h4 class="h4_page">Tiền căn dị ứng</h4>
                <textarea class="inputForm"></textarea>

                <h4 class="h4_page">Tư vấn của bác sĩ</h4>
                <textarea class="inputForm"></textarea>

                <h4 class="h4_page">Ý kiến của khách hàng</h4>
                <textarea class="inputForm"></textarea>
            
            <input type="hidden" name="action" value="confirm" >
            <input class="btnSubmit" type="submit" name="submit" value="Tạo">
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

    

	});
</script>

</body>
</html>	