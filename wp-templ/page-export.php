<?php /* Template Name: Export */ ?>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/app_config.php");
if(!$_COOKIE['login_cookies']) {    
	header('Location:'.APP_URL.'login');
}
if(($_COOKIE['role_cookies']!='manager')) {
    header('Location:'.APP_URL);
}
include(APP_PATH."libs/head.php"); 
require_once($_SERVER["DOCUMENT_ROOT"]."/excel/PHPExcel/PHPExcel.php");
$objPHPExcel = new PHPExcel();
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>

<body id="customer">
<!--===================================================-->
<div class="flexBox flexBox--between flexBox--wrap">
    <?php include(APP_PATH."libs/sidebar.php"); ?>
	<div id="wrapper">
	<!--===================================================-->
	<!--Header-->
	<?php include(APP_PATH."libs/header.php"); ?>
	<!--/Header-->
	
	<div class="blockPage blockPage--full maxW">
            <h2 class="h2_page">Truy xuất dữ liệu</h2>
            <ul class="tabItem tabItem--4 flexBox flexBox--center flexBox--wrap">
                <li><a href="javascript:void(0)"  data-id="tab1">Xuất danh sách hồ sơ</a></li>
                <li><a href="javascript:void(0)"  data-id="tab2">Xuất danh sách phòng mổ</a></li>
                <li><a href="javascript:void(0)"  data-id="tab3">Xuất danh sách CSKH</a></li>
                <li><a href="javascript:void(0)"  data-id="tab4">Xuất thông tin khách hàng</a></li>
            </ul>

            <div class="tabContent">
                <div class="tabBox" id="tab1">
                    <h3 class="h3_page">Xuất thông tin hồ sơ</h3>
                    <h4 class="h4_page">Theo tên khách hàng</h4>
                    <?php include(APP_PATH."libs/searchBlock_2.php"); ?>
                    <?php 
                    if($_POST['search']) {
                        include(APP_PATH."data/searchResult.php");
                    }
                    ?>
                    <h4 class="h4_page">Theo ngày tạo</h4>
                    <div class="flexBox flexBox--between flexBox__form flexBox__form--2 mt10">
                        <label>Từ</label>-<label>Đến</label>
                    </div>
                    <div class="flexBox flexBox--between flexBox__form flexBox__form--2 mt10">
                        <div class="inputBlock">
                            <input type="text" class="inputForm" id="dateFrom" name="dateFrom" value="" placeholder="Chọn ngày">
                            <div id="datepicker_from"></div>
                        </div>
                        <div class="inputBlock">
                            <input type="text" class="inputForm" id="dateTo" name="dateTo" value="" placeholder="Chọn ngày">
                            <div id="datepicker_to"></div>
                        </div>
                    </div>
                    <h4 class="h4_page">Theo tình trạng hồ sơ</h4>
                        <label class="checkStyle">
                            Hồ sơ còn nợ
                            <input type="checkbox" name="check01[]" value="debt" id="">
                            <span class="checkmark"></span>
                        </label>
                        <label class="checkStyle">
                            Hồ sơ đã đặt cọc
                            <input type="checkbox" name="check01[]" value="deposit" id="">
                            <span class="checkmark"></span>
                        </label>
                        <label class="checkStyle">
                            Hồ sơ đã huỷ
                            <input type="checkbox" name="check01[]" value="deposit" id="">
                            <span class="checkmark"></span>
                        </label>
                    <h4 class="h4_page">Theo tên sale</h4>
                    <p class="inputBlock customSelect">
                        <select name="input" id="input"></select>
                    </p>

                    <h4 class="h4_page">Hồ sơ được giảm giá</h4>
                    <p class="inputBlock customSelect">
                        <select name="input" id="input">
                        <option value="">Lựa chọn sale</option>
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
                </div>
                <div class="tabBox" id="tab2">
                <form autocomplete="off" id="queryRoom" action="?tab=2" method="post" enctype="multipart/form-data">
                    <h3 class="h3_page">Xuất thông tin phòng mổ</h3>
                    <select name="input" id="input">
                        <option value="">Lựa chọn phòng mổ</option>
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
                                'terms' => 'room'
                                ),
                            )
                            );
                            $wp_query->query($param);
                            if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                        ?>
                                <option value="<?php the_field('fullname') ?>"><?php the_field('fullname') ?></option>
                            <?php endwhile;endif; ?>
                        </select>
                    <h4 class="h4_page">Theo phòng mổ</h4>
                    <h4 class="h4_page">Theo ngày mổ</h4>
                    <div class="flexBox flexBox--between flexBox__form flexBox__form--2 mt10">
                        <label>Từ</label>-<label>Đến</label>
                    </div>
                    <div class="flexBox flexBox--between flexBox__form flexBox__form--2 mt10">
                        <div class="inputBlock">
                            <input type="text" class="inputForm" id="dateFrom" name="dateFrom" value="" placeholder="Chọn ngày">
                            <div id="datepicker_from"></div>
                        </div>
                        <div class="inputBlock">
                            <input type="text" class="inputForm" id="dateTo" name="dateTo" value="" placeholder="Chọn ngày">
                            <div id="datepicker_to"></div>
                        </div>
                    </div>
                    <h4 class="h4_page">Theo tên người mổ chính</h4>
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
                    <h4 class="h4_page">Theo tên người mổ phụ</h4>
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
                    <h4 class="h4_page">Theo tên người gây mê</h4>
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
                    <input type="submit" value="FILTER" class="btnSubmit">
                </form>                

                    <h2 class="h2_page mt30">Kết quả truy vấn</h2>
                        <table class="tblPage">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Họ tên</td>
                                <td>Số điện thoại</td>
                                <td>Số CMND</td>
                                <td>Chi tiết</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $wp_query = new WP_Query();				
                            $param = array (
                                'posts_per_page' => '-1',
                                'post_type' => 'customers',
                                'post_status' => 'publish',
                                'order' => 'DESC',
                                'paged' => $paged,
                                'meta_query'	=> array(
                                    array(
                                        'key' => 'creator',
                                        'value' => $_COOKIE['name_cookies'],
                                        'compare' => 'LIKE'
                                    ),
                                )
                                );
                            
                            $wp_query->query($param);
                            if($wp_query->have_posts()): while($wp_query->have_posts()) :$wp_query->the_post();
                            ?>
                            <tr>
                                <td><?php the_field('idcustomer'); ?></td>
                                <td><?php the_title(); ?></td>
                                <td><?php the_field('mobile'); ?></td>
                                <td><?php the_field('idcard'); ?></td>
                                <td class="last"><a href="<?php the_permalink(); ?>"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a></td>
                            </tr>
                            <?php endwhile;endif;  ?>
                        </tbody>
                    </table>
                    <a href="#" class="btnSubmit"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Xuất file Excel</a>

                </div>
                <div class="tabBox" id="tab3"></div>
                <div class="tabBox" id="tab4">
                    <h2 class="h2_page mt30">Kết quả truy vấn</h2>
                        <table class="tblPage">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Họ tên</td>
                                <td>Số điện thoại</td>
                                <td>Số CMND</td>
                                <td>Chi tiết</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $wp_query = new WP_Query();				
                            $param = array (
                                'posts_per_page' => '-1',
                                'post_type' => 'customers',
                                'post_status' => 'publish',
                                'order' => 'DESC',
                                'paged' => $paged,
                                'meta_query'	=> array(
                                    array(
                                        'key' => 'creator',
                                        'value' => $_COOKIE['name_cookies'],
                                        'compare' => 'LIKE'
                                    ),
                                )
                                );
                            
                            $wp_query->query($param);
                            if($wp_query->have_posts()): while($wp_query->have_posts()) :$wp_query->the_post();
                            ?>
                            <tr>
                                <td><?php the_field('idcustomer'); ?></td>
                                <td><?php the_title(); ?></td>
                                <td><?php the_field('mobile'); ?></td>
                                <td><?php the_field('idcard'); ?></td>
                                <td class="last"><a href="<?php the_permalink(); ?>"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a></td>
                            </tr>
                            <?php endwhile;endif;  ?>
                        </tbody>
                    </table>
                    <a href="#" class="btnSubmit"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Xuất file Excel</a>
                </div>
            </div>

            
	</div>


	<!--Footer-->
	<?php include(APP_PATH."libs/footer.php"); ?>
	<!--/Footer-->
	
	</div>
	<!--/wrapper-->
	
</div>	

<script type="text/javascript">
    <?php $tab = $_GET['tab'];
    if(!$tab) {
    ?>
    $('#tab1').show();
    $('.tabItem li:nth-child(1)').addClass('active');
    <?php } else { ?>
    $('#tab<?php echo $tab; ?>').show();
    $('.tabItem li:nth-child(<?php echo $tab; ?>)').addClass('active');
    <?php } ?>
    
    $('.tabItem li').click(function() {
        $('.tabItem li').removeClass('active');
        $(this).toggleClass('active');
        var tabId = $(this).find('a').attr('data-id');
        $('.tabBox').fadeOut(200);
        $('#'+tabId).fadeIn(200);
    });
</script>    
<script src="<?php echo APP_URL; ?>common/js/jquery-ui.js"></script>
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

    $('#datepicker_from').datepicker({
        show:false,
    dateFormat: 'd-m-yy',
    // minDate: dateToday,
    // maxDate: "+4w",
    altField: '#dateFrom',
    onSelect: function (date) {
        var currTime = new Date();
        var currDate =currTime.getDate()+"-"+(currTime.getMonth()+1)+"-"+currTime.getFullYear();
        var choseDate = $(this).val();
    }
    });

    $("#dateFrom").on('click', function () {
        $('#datepicker_from').show(200);
    });

    $('#dateFrom').change(function(){
        $('#datepicker_from').datepicker('setDate', $(this).val());
    });

    $('#datepicker_to').datepicker({
    dateFormat: 'd-m-yy',
    // minDate: dateToday,
    // maxDate: "+4w",
    altField: '#dateTo',
    onSelect: function (date) {
        var currTime = new Date();
        var currDate =currTime.getDate()+"-"+(currTime.getMonth()+1)+"-"+currTime.getFullYear();
        var choseDate = $(this).val();
    }
    });

    $("#dateTo").on('click', function () {
        $('#datepicker_to').show(200);
    });

    $('#dateTo').change(function(){
        $('#datepicker_to').datepicker('setDate', $(this).val());
    });
      
  });
</script>

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