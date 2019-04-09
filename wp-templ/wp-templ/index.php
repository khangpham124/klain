<?php
include($_SERVER["DOCUMENT_ROOT"] . "/app_config.php");
// include(APP_PATH."libs/checklog.php");
if(!$_COOKIE['login_cookies']) {    
	header('Location:'.APP_URL.'login');
}
if($_COOKIE['role_cookies']=='room') {
    // echo '<meta http-equiv="refresh" content="10" >';
}
include(APP_PATH."libs/head.php"); 
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>

<body id="top">
<!--===================================================-->
<div class="flexBox flexBox--between flexBox--wrap">
    <?php include(APP_PATH."libs/sidebar.php"); ?>
    <div id="wrapper">
    <!--===================================================-->
        <!--Header-->
        <?php include(APP_PATH."libs/header.php"); ?>
        <!--/Header-->

        <div class="textBox">
            
        <!-- CSKH   -->
            <?php  if(($_COOKIE['role_cookies']=='manager')||($_COOKIE['role_cookies']=='boss')||($_COOKIE['role_cookies']=='customer-care')) { ?>            
                <h2 class="h2_page">Danh sách khách đến lịch</h2>
                <div id="calendario"></div>

                <h2 class="h2_page">Danh sách khách hàng vừa phẫu thuật xong</h2>
                <table class="tblPage">
                    <thead>
                        <tr>
                            <td>Trạng thái</td>
                            <td>Ca</td>
                            <td>Họ tên</td>
                            <td>Số điện thoại</td>
                            <td>Chi tiết</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $param=array(
                                'post_type'=>'surgery',
                                'order' => 'DESC',
                                'posts_per_page' => '-1',
                                'meta_query'	=> array(
                                    'relation'		=> 'OR',
                                    array(
                                        'key'	  	=> 'status',
                                        'value'	  	=> 'hauphau',
                                        'compare' 	=> '=',
                                    ),
                                    array(
                                        'key'	  	=> 'status',
                                        'value'	  	=> 'phauthuat',
                                        'compare' 	=> '=',
                                    ),
                                )
                            );

                        $wp_query->query($param);
                        if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                        $stt = get_field('status');
                        ?>
                        <tr>
                            <td>
                            <?php
                            $stt = get_field('status');
                            switch ($stt) {
                                case "tvv":
                                    $stt_text = "Tư vấn viên";
                                break;
                                case "pending":
                                    $stt_text = "Chờ khám";
                                break;
                                case "quay":
                                    $stt_text = "Quầy";
                                break;
                                case "bsnk":
                                    $stt_text = "Bác sĩ ngoại khoa";
                                break;
                                case "bsk":
                                    $stt_text = "Bác sĩ Khải";
                                break;
                                case "batdau":
                                    $stt_text = "Đang mổ";
                                break;
                                case "phauthuat":
                                    $stt_text = "Phẫu thuật";
                                break;
                                case "hauphau":
                                    $stt_text = "Hậu phẫu";
                                break;
                                case "cshp":
                                    $stt_text = "CSKH";
                                break;
                                case "huy":
                                    $stt_text = "Đã Huỷ";
                                break;
                            }
                            ?>
                            <?php if($stt=='batdau') { ?><i class="fa fa-lock" aria-hidden="true"></i><?php } ?>
                            <span class="noteColor note--<?php echo $stt ?>"></span>
                            <em><?php echo $stt_text ?></em>
                        </td>
                            <td><?php the_title(); ?></td>
                            <td><?php the_field('fullname'); ?></td>
                            <td><?php the_field('mobile'); ?></td>
                            <td class="last">
                                <a href="<?php echo APP_URL; ?>care-now/?idSurgery=<?php echo $post->ID; ?>" title="Ca mổ"><i class="fa fa-heartbeat" aria-hidden="true"></i></a>
                            </td>        
                            
                        </tr> 
                    <?php endwhile;endif; ?>
                    </tbody>
                    </table>
            <?php } ?>

            
            <?php  if($_COOKIE['role_cookies']!='customer-care') { ?>
            <h2 class="h2_page">Danh sách khách hàng trong ngày</h2> 
            <table class="tblPage">
            <thead>
                <tr>
                    <td>Trạng thái</td>
                    <td>Ca</td>
                    <td>Họ tên</td>
                    <td>Số điện thoại</td>
                    <td>Chi tiết</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $wp_query = new WP_Query();
                    if(($_COOKIE['role_cookies']=='manager')||($_COOKIE['role_cookies']=='boss')) {
                        $param=array(
                        'post_type'=>'surgery',
                        'order' => 'DESC',
                        'posts_per_page' => '-1',
                        'meta_query'	=> array(
                            array(
                                'key'	  	=> 'status',
                                'value'	  	=> 'huy',
                                'compare' 	=> '!=',
                            ),
                            )
                        );
                    }
                    
                    if(($_COOKIE['role_cookies']=='tvv')||($_COOKIE['role_cookies']=='sale')) {
                        $param=array(
                        'post_type'=>'surgery',
                        'order' => 'DESC',
                        'posts_per_page' => '-1',
                        'meta_query'	=> array(
                            'relation'		=> 'OR',
                            array(
                                'key'	  	=> 'status',
                                'value'	  	=> 'tvv',
                                'compare' 	=> '=',
                            ),
                            array(
                                'key' => 'status',
                                'value' => 'pending',
                                'compare' => '='
                            ),
                            )
                        );
                    }

                    if($_COOKIE['role_cookies']=='counter') {
                        $param=array(
                        'post_type'=>'surgery',
                        'order' => 'DESC',
                        'posts_per_page' => '-1',
                        'meta_query'	=> array(
                            'relation'		=> 'OR',
                            array(
                                'key'	  	=> 'status',
                                'value'	  	=> 'tvv',
                                'compare' 	=> '=',
                            ),
                            array(
                                'key' => 'status',
                                'value' => 'pending',
                                'compare' => '='
                            ),
                            )
                        );
                    }
                    
                    if($_COOKIE['role_cookies']=='doctor') {
                        $param=array(
                        'post_type'=>'surgery',
                        'order' => 'DESC',
                        'posts_per_page' => '-1',
                        'meta_query'	=> array(
                            'relation'		=> 'OR',
                            // array(
                            //     'key' => 'date',
                            //     'value' => $curr_date,
                            //     'compare' => 'LIKE'
                            // ),
                            array(
                                'key'	  	=> 'status',
                                'value'	  	=> 'quay',
                                'compare' 	=> '=',
                            ),
                            array(
                                'key' => 'status',
                                'value' => 'pending',
                                'compare' => '='
                            ),
                            array(
                                'key' => 'payment_status',
                                'value' => 'Đặt cọc',
                                'compare' => '!='
                            ),
                            )
                        );
                    }

                    if($_COOKIE['role_cookies']=='room') {
                        $param=array(
                            'post_type'=>'surgery',
                            'order' => 'DESC',
                            'posts_per_page' => '-1',
                            'meta_query'	=> array(
                                'relation'		=> 'OR',
                                // array(
                                //     'key' => 'date',
                                //     'value' => $curr_date,
                                //     'compare' => 'LIKE'
                                // ),
                                array(
                                    'key'	  	=> 'status',
                                    'value'	  	=> 'bsk',
                                    'compare' 	=> '=',
                                ),
                                array(
                                    'key'	  	=> 'status',
                                    'value'	  	=> 'bsnk',
                                    'compare' 	=> '=',
                                ),
                                array(
                                    'key'	  	=> 'status',
                                    'value'	  	=> 'phauthuat',
                                    'compare' 	=> '=',
                                ),
                                array(
                                    'key'	  	=> 'status',
                                    'value'	  	=> 'batdau',
                                    'compare' 	=> '=',
                                ),
                            )
                        );
                    }    

                    if($_COOKIE['role_cookies']=='customer-care') {
                        $param=array(
                            'post_type'=>'surgery',
                            'order' => 'DESC',
                            'posts_per_page' => '-1',
                            'meta_query'	=> array(
                                'relation'		=> 'OR',
                                // array(
                                //     'key' => 'date',
                                //     'value' => $curr_date,
                                //     'compare' => 'LIKE'
                                // ),
                                array(
                                    'key'	  	=> 'status',
                                    'value'	  	=> 'hauphau',
                                    'compare' 	=> '=',
                                ),
                                )
                        );
                    }
                    $wp_query->query($param);
                    if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                    $stt = get_field('status');
                ?>
                <tr>
                    <td>
                        <?php
                        $stt = get_field('status');
                        switch ($stt) {
                            case "tvv":
                                $stt_text = "Tư vấn viên";
                            break;
                            case "pending":
                                $stt_text = "Chờ khám";
                            break;
                            case "quay":
                                $stt_text = "Quầy";
                            break;
                            case "bsnk":
                                $stt_text = "Bác sĩ ngoại khoa";
                            break;
                            case "bsk":
                                $stt_text = "Bác sĩ Khải";
                            break;
                            case "batdau":
                                $stt_text = "Đang mổ";
                            break;
                            case "phauthuat":
                                $stt_text = "Phẫu thuật";
                            break;
                            case "hauphau":
                                $stt_text = "Hậu phẫu";
                            break;
                            case "cshp":
                                $stt_text = "CSKH";
                            break;
                            case "huy":
                                $stt_text = "Đã Huỷ";
                            break;
                        }
                        ?>
                        <?php if($stt=='batdau') { ?><i class="fa fa-lock" aria-hidden="true"></i><?php } ?>
                        <span class="noteColor note--<?php echo $stt ?>"></span>
                        <em><?php echo $stt_text ?></em>
                        <?php if(get_field('doctor_advise')!='') { ?>
                        (BS tư vấn)
                        <?php } ?>
                    </td>
                    <td><?php the_title(); ?></td>
                    <td><?php the_field('fullname'); ?></td>
                    <td><?php the_field('mobile'); ?></td>
                    <?php if(($_COOKIE['role_cookies']=='manager')||($_COOKIE['role_cookies']=='boss')) { ?>
                        <td class="last">
                        <?php if($stt!='batdau') { ?>
                            <?php if($stt=='tvv') { ?>
                            <a href="<?php echo APP_URL; ?>form-counter/?idSurgery=<?php echo $post->ID; ?>" title="Quầy"><i class="fa fa-print" aria-hidden="true"></i></a>
                            <?php } ?>
                            <!-- <a href="<?php echo APP_URL; ?>doctor-confirm/?idSurgery=<?php echo $post->ID; ?>" title="Bác sĩ khám"><i class="fa fa-stethoscope" aria-hidden="true"></i></a> -->
                            <?php if(($stt!='hauphau')&&($stt!='cshp')) { ?>
                            <a href="<?php echo APP_URL; ?>ekip-surgery/?idSurgery=<?php echo $post->ID; ?>&idEkip=<?php echo $idEkip; ?>" title="Ca mổ"><i class="fa fa-heartbeat" aria-hidden="true"></i></a>
                            <?php } ?>
                        <?php } ?>
                        <a href="<?php the_permalink(); ?>" title="Chi tiết"><i class="fa fa-info-circle" aria-hidden="true"></i></a></td>
                        </td>        
                    <?php } ?>

                    <?php if($_COOKIE['role_cookies']=='counter') { ?>
                        <td class="last">
                            <?php if($stt=='tvv') { ?>
                            <a href="<?php echo APP_URL; ?>form-counter/?idSurgery=<?php echo $post->ID; ?>"><i class="fa fa-print" aria-hidden="true"></i></a>
                            <?php } ?>
                            <?php if($stt=='quay') { ?>
                            <a href="<?php echo APP_URL; ?>print?idSurgery=<?php echo $id_sur; ?>&form=counter" class="btnPrint <?php if(get_field('accept')=='no') { ?>disable<?php } ?>">In phiếu thu</a>
                            <?php } ?>
                            <a href="<?php the_permalink(); ?>" title="Chi tiết"><i class="fa fa-info-circle" aria-hidden="true"></i></a></td>
                        </td>
                    <?php } ?>

                    <?php if(($_COOKIE['role_cookies']=='tvv')||($_COOKIE['role_cookies']=='sale')) { ?>
                    <td class="last">
                        <a href="<?php echo APP_URL; ?>print?idSurgery=<?php echo $post->ID; ?>&form=tvv"><i class="fa fa-print" aria-hidden="true"></i></a>
                        <a href="<?php the_permalink(); ?>" title="Chi tiết"><i class="fa fa-info-circle" aria-hidden="true"></i></a></td>
                    </td>
                    <?php } ?>
                    
                    <?php if($_COOKIE['role_cookies']=='doctor') { ?>
                        <?php if($stt=='pending') { ?>
                        <td class="last"><a href="<?php the_permalink(); ?>" title="Chi tiết"><i class="fa fa-info-circle" aria-hidden="true"></i></a></td></td>
                        <?php } else { ?>
                        <td class="last"><a href="<?php echo APP_URL; ?>doctor-confirm/?idSurgery=<?php echo $post->ID; ?>"><i class="fa fa-stethoscope" aria-hidden="true"></i></a></td>
                        <?php } ?>
                    <?php } ?>

                    <?php if($_COOKIE['role_cookies']=='room') { ?>
                        <?php if(($stt=='bsk')||($stt=='bsnk')||($stt=='batdau')) { ?>
                            <td class="last">
                                <?php if($stt=='batdau') { ?>
                                    <?php if($_COOKIE['role_cookies']=='room') {
                                        $surger_cf = get_field('services_list');
                                        $surger_remain = array();
                                        for($i=0; $i < count($surger_cf); $i++){
                                            if($surger_cf[$i]['do']!='yes') {
                                                $surger_remain[]=$surger_cf[$i]['name'];
                                            }
                                        }
                                        $remin_s = count($surger_remain);
                                    ?>
                                    <a href="javascript:void(0)" class="callPopup" data-id=<?php echo $post->ID; ?>><i class="fa fa-check-circle" aria-hidden="true"></i></a>
                                    <?php } ?>
                                    <a href="<?php the_permalink(); ?>" title="Chi tiết"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                                <?php } else { ?>
                                    <a href="<?php echo APP_URL; ?>ekip-surgery/?idSurgery=<?php echo $post->ID; ?>"><i class="fa fa-heartbeat" aria-hidden="true"></i></a>
                                <?php } ?>    
                            </td>
                        <?php } else { ?>
                            <td class="last">
                                <?php 
                                $surger_cf = get_field('services_list');
                                $surger_remain = array();
                                for($i=0; $i < count($surger_cf); $i++){
                                    if($surger_cf[$i]['do']!='yes') {
                                        $surger_remain[]=$surger_cf[$i]['name'];
                                    }
                                }
                                $remin_s = count($surger_remain);
                                if(($remin_s==0)&&($stt=='phauthuat')) {
                                ?>
                                    <a href="<?php echo APP_URL; ?>after-surgery/?idSurgery=<?php echo $post->ID; ?>"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
                                <?php } else { ?>
                                    <a href="<?php echo APP_URL; ?>ekip-surgery/?idSurgery=<?php echo $post->ID; ?>"><i class="fa fa-heartbeat" aria-hidden="true"></i></a>
                                <?php } ?>
                            </td>
                        <?php } ?>
                    <?php } ?>

                    <?php if($_COOKIE['role_cookies']=='customer-care') { ?>
                        <td class="last"> <a href="<?php the_permalink(); ?>" title="Chi tiết"><i class="fa fa-info-circle" aria-hidden="true"></i></a></td></td>
                    <?php } ?>
                </tr>
                <?php endwhile;endif; ?>
            </tbody>
        </table>
        <?php } ?>
        </div>
        </div>


    <!--Footer-->
    <?php include(APP_PATH."libs/footer.php");  ?>
    <!--/Footer-->
    <!--===================================================-->
</div>    
<!--/wrapper-->
<!--===================================================-->


<div class="popUp">
    <?php include(APP_PATH."data/popReport.php"); ?>
</div>

<div class="CarepopUp">
    <?php include(APP_PATH."data/carePopup.php"); ?>
</div>
<div class="overlay"></div>

<script src="<?php echo APP_URL; ?>common/js/jquery-ui.js"></script>
<script>
$(function() {
    var addCustomInformation = function () {
    <?php
    $remind = array();
    $wp_query = new WP_Query();
    $param = array (
    'posts_per_page' => '-1',
    'post_type' => 'care',
    'post_status' => 'publish',
    'order' => 'DESC',
    'paged' => $paged,
    );
    $wp_query->query($param);
    if($wp_query->have_posts()): while($wp_query->have_posts()) :$wp_query->the_post();
    $test = get_field('listcare',$post->ID);
    foreach($test as $exp) {
        $remind[]=date('d/m/Y', $exp['expire']);
    }
    endwhile;endif;
    $vals = array_count_values($remind);
?>

$(".ui-datepicker-calendar td").each(function() {
    var taga = $(this).find('a');
    var ngay = taga.text();
    if(parseInt(ngay) < 10){
        ngay = '0' + ngay;
    }
    var thang_fake = $(this).attr('data-month');
    var thang = parseInt(thang_fake) + 1;
    if(parseInt(thang) < 10){
        thang = '0' + thang;
    }
    var year = $(this).attr('data-year');
    var getDate = ngay + '/' + thang + '/' + year;
    <?php foreach($vals as $ca=>$k) { ?>
    if(getDate=='<?php echo $ca ?>') {
        var getDateURL = getDate.replace(/[/]/g,'');
        taga.append( "<strong>(<?php echo $k; ?> ca)</strong>" );
        taga.attr('href','<?php echo APP_URL; ?>care?date='+getDateURL);
        taga.addClass('hasCare');
    }
    <?php } ?>
});
}
  

$("#calendario").datepicker({
    dateFormat: "dd/mm/yy",
    dayNames: [
      "Thứ Hai",
      "Thứ Ba",
      "Thứ Tư",
      "Thứ Năm",
      "Thứ Sáu",
      "Thứ Bảy",
      "Chủ nhật",
      "Thứ test"
    ],
    dayNamesMin: ["Chủ nhật", "Hai", "Ba", "Tư", "Năm", "Sáu", "Bảy", "D"],
    monthNames: [
      "Tháng 1 -",
      "Tháng 2 -",
      "Tháng 3 -",
      "Tháng 4 -",
      "Tháng 5 -",
      "Tháng 6 -",
      "Tháng 7 -",
      "Tháng 8 -",
      "Tháng 9 -",
      "Tháng 10 -",
      "Tháng 11 -",
      "Tháng 12 -"
    ],
    nextText: "Tháng sau",
    prevText: "Tháng trước",
    onSelect: function () {
        setTimeout(addCustomInformation, 10);
    },
    onChangeMonthYear: function () {
        setTimeout(addCustomInformation, 10);
    },
    beforeShow: function () {
        setTimeout(addCustomInformation, 10);
    },
  });
  addCustomInformation();

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

    $('.callPopup').click(function() {
        $('.overlay').fadeIn(200);
        $('.popUp').fadeIn(200);
        var idSur = $(this).attr('data-id');
        $('#idSurgery').val(idSur);
    });

    $('.ui-state-default.hasCare').click(function() {
        var url = $(this).attr('href');
        window.location = url;
    });

    $('.overlay').click(function() {
        $(this).fadeOut(200);
        $('.popUp').fadeOut(200);
        $('.CarepopUp').fadeOut(200);
    });

    

  });
</script>

</body>
</html>	