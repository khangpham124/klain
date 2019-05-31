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
                    <h4 class="h4_page">Theo ngày tạo</h4>
                    <form action="<?php echo APP_URL; ?>export?tab=1" method="POST" >
                        <div class="flexBox flexBox--between flexBox__form flexBox__form--2 mt10">
                            <label>Từ</label><label>Đến</label>
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
                            <h5 class="h5_page">Tình trạng thanh toán</h5>
                                <label class="checkStyle">
                                    Hồ sơ còn nợ
                                    <input type="checkbox" name="paidStt[]" value="Nợ" id="paidStt1">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="checkStyle">
                                    Hồ sơ đã đặt cọc
                                    <input type="checkbox" name="paidStt[]" value="Đặt cọc" id="paidStt2">
                                    <span class="checkmark"></span>
                                </label>
                            <h5 class="h5_page">Tình trạng hoàn/huỷ</h5>    
                                <label class="checkStyle">
                                    Hồ sơ đã huỷ
                                    <input type="checkbox" name="cancelSur" value="huy" id="paidStt3">
                                    <span class="checkmark"></span>
                                </label>
                            <h5 class="h5_page">Được giảm giá</h5>    
                                <label class="checkStyle">
                                    Hồ sơ được giảm giá
                                    <input type="checkbox" name="hasDiscount[]" value="0" id="paidStt3">
                                    <span class="checkmark"></span>
                                </label>
                        <h4 class="h4_page">Người duyệt giảm giá</h4>
                        <p class="inputBlock customSelect">
                            <select name="acceptor" id="acceptor">
                                <option value="">Lựa chọn</option>
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
                                    'terms' => array('counter','manager')
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

                        <h4 class="h4_page">Theo tên sale</h4>
                        <p class="inputBlock customSelect">
                            <select name="creator" id="creator">
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
                        <input class="btnSubmit" type="submit" name="submit" value="Lọc hồ sơ">
                        <input type="hidden" name="action_surgery" value="filter_surgery">
                    </form>
                    <?php if($_POST['action_surgery']=='filter_surgery') { ?>
                        <h2 class="h2_page mt30">Kết quả truy vấn</h2>
                        <table class="tblPage">
                            <thead>
                                <tr>
                                    <td>Trạng thái</td>
                                    <td>Ca</td>
                                    <td>Họ tên khách hàng</td>
                                    <td>Số điện thoại</td>
                                    <td>Ngày tạo hồ sơ</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $wp_query = new WP_Query();
                                    $paidStt = $_POST['paidStt'];
                                    $string = array();
                                    for($i=0;$i<=count($paidStt);$i++) {
                                        $string[] = "'".$paidStt[$i]."'";
                                        $string_s[] = $paidStt[$i];
                                    }
                                    $sttString=implode(',',$string);
                                    $sttString_send =implode('-',$string_s);

                                    $hasDiscount = $_POST['hasDiscount'];
                                    $cancelSur = $_POST['cancelSur'];
                                    $payment_status = $_POST['paidStt'];
                                    $from = $_POST['dateFrom'];
                                    $to = $_POST['dateTo'];
                                    $creator = $_POST['creator'];
                                    $acceptor = $_POST['acceptor'];

                                    $p_sur = $wpdb->get_results( "SELECT * 
                                    FROM `wp_postmeta`
                                    LEFT JOIN wp_posts ON wp_postmeta.post_id = wp_posts.ID
                                    WHERE 
                                    `meta_key` LIKE 'adviser' AND `meta_value` LIKE '$creator' 
                                    OR
                                    `meta_key` LIKE 'approve' AND `meta_value` LIKE '$acceptor'
                                    OR
                                    `meta_key` LIKE 'status' AND `meta_value` LIKE '$cancelSur'
                                    OR
                                    `meta_key` LIKE 'payment_status' AND `meta_value` IN ($sttString)
                                    ");

                                    $arr_ids = array();
                                    foreach($p_sur as $PS) {
                                        $arr_ids[] = $PS->post_id;
                                    }
                                    // var_dump($arr_ids);
                                    $wp_query = new WP_Query();
                                    if(empty($arr_ids)) {
                                        $param = array(
                                            'post_type' => 'surgery',
                                            'date_query' => array(
                                                array(
                                                    'after'     => $from,
                                                    'before'    => $to,
                                                    'inclusive' => true,
                                                ),
                                            )
                                        );
                                    } else {
                                        if(empty($hasDiscount)) {
                                            if(($from!="")||($to!="")) {
                                                $param = array(
                                                    'post_type' => 'surgery',
                                                    'orderby' => 'post__in', 
                                                    'post__in'=> array_unique($arr_ids),
                                                    'date_query' => array(
                                                        array(
                                                            'after'     => $from,
                                                            'before'    => $to,
                                                            'inclusive' => true,
                                                        ),
                                                    )
                                                );
                                                echo $from;
                                            } else {
                                                $param = array(
                                                    'post_type' => 'surgery',
                                                    'orderby' => 'post__in', 
                                                    'post__in'=> array_unique($arr_ids),
                                                );
                                            }
                                        } else {
                                            if(($from!="")||($to!="")) {
                                                $param = array(
                                                    'post_type' => 'surgery',
                                                    'orderby' => 'post__in', 
                                                    'post__in'=> array_unique($arr_ids),
                                                    'meta_query'	=> array(
                                                        array(
                                                            'key' => 'sale_discount',
                                                            'value' => 0,
                                                            'type'    => 'NUMERIC',
                                                            'compare' => '>'
                                                        ),
                                                    ),
                                                    'date_query' => array(
                                                        array(
                                                            'after'     => $from,
                                                            'before'    => $to,
                                                            'inclusive' => true,
                                                        ),
                                                    )
                                                );
                                            } else {
                                                $param = array(
                                                    'post_type' => 'surgery',
                                                    'orderby' => 'post__in', 
                                                    'post__in'=> array_unique($arr_ids),
                                                    'meta_query'	=> array(
                                                        array(
                                                            'key' => 'sale_discount',
                                                            'value' => 0,
                                                            'type'    => 'NUMERIC',
                                                            'compare' => '>'
                                                        ),
                                                    )
                                                );
                                            }
                                            
                                        }
                                    }
                                    $wp_query->query($param);
                                    if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                                ?>
                                <tr <?php if($stt=='batdau') { ?> class="lock"<?php } ?> >
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
                                                $stt_text = "CSHP";
                                            break;
                                            case "huy":
                                                $stt_text = "Đã Huỷ";
                                            break;
                                        }
                                        ?>
                                        <?php if($stt=='batdau') { ?>
                                            <i class="fa fa-lock" aria-hidden="true"></i>
                                        <?php } ?>
                                        <span class="noteColor note--<?php echo $stt ?>"></span>
                                        <em><?php echo $stt_text ?></em>
                                        <?php
                                        if((get_field('debt'))||(get_field('debt')!=0)) { ?>
                                        <span class="noteRemind noteRemind--1">Còn nợ</span>
                                        <?php } ?>
                                        <?php
                                        if((get_field('deposit'))||(get_field('deposit')!=0)) { ?>
                                        <span class="noteRemind noteRemind--1">Đặt Cọc</span>
                                        <?php } ?>
                                        
                                    </td>
                                    <td><?php the_title(); ?></td>
                                    <td><?php the_field('fullname'); ?></td>
                                    <td><?php the_field('mobile'); ?></td>
                                    <td><?php the_time('d/m/Y'); ?></td>
                                    </tr>
                                <?php endwhile;endif;?>
                                </tbody>
                            </table>
                        <a href="<?php echo APP_URL; ?>export_file/surgery?paidStt=<?php echo $sttString_send ?>&hasDiscount=<?php echo $hasDiscount; ?>&cancelSur=<?php echo $cancelSur; ?>&payment_status=<?php echo $payment_status; ?>&creator=<?php echo $creator; ?>&acceptor=<?php echo $acceptor; ?>&from=<?php echo $from; ?>&to=<?php echo $to; ?>" 
                        class="btnSubmit"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Xuất file Excel</a>
                        <?php } ?>
                </div>
<!-- END TAB1==================================================================================================== -->


                <div class="tabBox" id="tab2">
                <form autocomplete="off" id="queryRoom" action="?tab=2" method="post" enctype="multipart/form-data">
                    <h3 class="h3_page">Xuất thông tin phòng mổ</h3>
                    <h4 class="h4_page">Theo phòng mổ</h4>
                        <select name="roomName" id="roomName">
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
                                <option value="<?php the_title(); ?>"><?php the_field('fullname') ?></option>
                            <?php endwhile;endif; ?>
                        </select>
                    <h4 class="h4_page">Theo ngày mổ</h4>
                    <div class="flexBox flexBox--between flexBox__form flexBox__form--2 mt10">
                        <label>Từ</label><label>Đến</label>
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
                                <input type="checkbox" name="doctor1[]" value="<?php the_field('fullname') ?>" id="mo_<?php echo $post->ID ?>">
                                <span class="checkmark"></span>
                            </label>   
                        <?php endwhile;endif; ?>
                    </p>
                    <h4 class="h4_page">Theo tên người mổ phụ</h4>
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
                                <input type="checkbox" name="doctor2[]" value="<?php the_field('fullname') ?>" id="mo2_<?php echo $post->ID ?>">
                                <span class="checkmark"></span>
                            </label>   
                        <?php endwhile;endif; ?>
                    </p>
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
                                <input type="checkbox" name="ktv[]" value="<?php the_field('fullname') ?>" id="ktv_<?php echo $post->ID ?>">
                                <span class="checkmark"></span>
                            </label>
                        <?php endwhile;endif; ?>
                    </p>
                    <h4 class="h4_page">Theo tên người nhập thông tin</h4>
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
                                <input type="checkbox" name="input[]" value="<?php the_field('fullname') ?>" id="input_<?php echo $post->ID ?>">
                                <span class="checkmark"></span>
                            </label>
                        <?php endwhile;endif; ?>
                    </p>
                    <input type="submit" value="Lọc dữ liệu" class="btnSubmit">
                    <input type="hidden" name="action_room" value="filter_room">
                    </form>
                    
                <?php if($_POST['action_room']=='filter_room') { ?>
                    <h2 class="h2_page mt30">Kết quả truy vấn</h2>
                        <table class="tblPage">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Phòng mổ</td>
                                <td>Bác sĩ 1</td>
                                <td>Bác sĩ 2</td>
                                <td>Điều dưỡng</td>
                                <td>Gây mê</td>
                                <td>Nhập thông tin</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $wp_query = new WP_Query();
                            $room = $_POST['room'];
                            $doctor1 = $_POST['doctor1'];
                            $doctor2 = $_POST['doctor2'];
                            $ktv = $_POST['ktv'];
                            $input = $_POST['input'];

                            $string = array();
                            for($i=0;$i<=count($doctor1);$i++) {
                                $string[] = "'".$doctor1[$i]."<br>'";
                                $string_s[] = $doctor1[$i];
                            }
                            $sttString=implode(',',$string);
                            $sttString_send =implode('-',$string_s);

                            $string2 = array();
                            for($i=0;$i<=count($doctor2);$i++) {
                                $string2[] = "'".$doctor2[$i]."<br>'";
                                $string_s2[] = $doctor2[$i];
                            }
                            $sttString2=implode(',',$string2);
                            $sttString_send2 =implode('-',$string_s2);

                            $string3 = array();
                            for($i=0;$i<=count($ktv);$i++) {
                                $string3[] = "'".$ktv[$i]."<br>'";
                                $string_s3[] = $ktv[$i];
                            }
                            $sttString3=implode(',',$string_s3);
                            $sttString_send3 =implode('-',$string_s3);

                            $string4 = array();
                            for($i=0;$i<=count($input);$i++) {
                                $string4[] = "'".$input[$i]."'";
                                $string_s4[] = $input[$i];
                            }
                            $sttString4=implode(',',$string4);
                            $sttString_send4 =implode('-',$string_s4);

                            
                            $from = $_POST['dateFrom'];
                            $to = $_POST['dateTo'];
                            echo $sttString3;

                            $p_sur = $wpdb->get_results( "SELECT * 
                            FROM `wp_postmeta`
                            LEFT JOIN wp_posts ON wp_postmeta.post_id = wp_posts.ID
                            WHERE 
                            `meta_key` LIKE 'input' AND `meta_value` IN ($sttString4)
                            OR
                            `meta_key` LIKE 'doctor1' AND `meta_value` IN ($sttString)
                            OR
                            `meta_key` LIKE 'doctor2' AND `meta_value` IN ($sttString2)
                            OR
                            `meta_key` LIKE 'ktv' AND `meta_value` LIKE '%$sttString3%'
                            ");

                            $arr_ids = array();
                            foreach($p_sur as $PS) {
                                $arr_ids[] = $PS->post_id;
                            }
                            var_dump($arr_ids);
                            $wp_query = new WP_Query();
                            if(empty($arr_ids)) {
                                $param = array(
                                    'post_type' => 'ekip',
                                    'date_query' => array(
                                        array(
                                            'after'     => $from,
                                            'before'    => $to,
                                            'inclusive' => true,
                                        ),
                                    )
                                );
                            } else {
                                $param = array(
                                    'post_type' => 'ekip',
                                    'orderby' => 'post__in', 
                                    'post__in'=> array_unique($arr_ids),
                                );
                            }
                            $wp_query->query($param);
                            if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                        ?>
                            <tr>
                                <td><?php the_title(); ?></td>
                                <td><?php the_field('room'); ?></td>
                                <td><?php the_field('doctor1'); ?></td>
                                <td><?php the_field('doctor2'); ?></td>
                                <td><?php the_field('nursing_team'); ?></td>
                                <td><?php the_field('ktv'); ?></td>
                                <td><?php the_field('input'); ?></td>
                            </tr>
                            <?php endwhile;endif;  ?>
                        </tbody>
                    </table>
                    <a href="<?php echo APP_URL; ?>export_file/room?paidStt=<?php echo $sttString_send ?>&hasDiscount=<?php echo $hasDiscount; ?>&cancelSur=<?php echo $cancelSur; ?>&payment_status=<?php echo $payment_status; ?>&creator=<?php echo $creator; ?>&acceptor=<?php echo $acceptor; ?>&from=<?php echo $from; ?>&to=<?php echo $to; ?>" 
                        class="btnSubmit"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Xuất file Excel</a>
                <?php } ?>                    
                </div>

<!-- END TAB2==================================================================================================== -->
            <div class="tabBox" id="tab3">
                <form autocomplete="off" id="queryCare" action="?tab=3" method="post" enctype="multipart/form-data">
                    <h4 class="h4_page">Theo độ hài lòng của khách hàng</h4>
                        <select name="quality" id="quality">
                            <option value="">Đánh giá của khách</option>
                            <option value="3">Hài lòng</option>
                            <option value="2">Bình thường</option>
                            <option value="1">Không hài lòng</option>
                        </select>
                    <h4 class="h4_page">Theo nhân viên chăm sóc</h4>   
                    <select name="care_staff" id="care_staff"> 
                        <option value="">Đánh giá nhận viên</option>
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
                                'terms' => 'customer-care'
                                ),
                                )
                            );
                            $wp_query->query($param);
                            if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                        ?>
                        <option value="<?php the_field('fullname') ?>"><?php the_field('fullname') ?></option>
                        <?php endwhile;endif; ?>
                    </select>
                    <h4 class="h4_page">Theo người khám</h4>   
                    <select name="dr_staff" id="dr_staff"> 
                        <option value="">Lựa chọn</option>
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
                    <input type="submit" value="Lọc dữ liệu" class="btnSubmit">
                    <input type="hidden" name="action_care" value="filter_care">
                </form>
                    
                <?php if($_POST['action_care']=='filter_care') { ?>
                    <h2 class="h2_page mt30">Kết quả truy vấn</h2>
                        <table class="tblPage">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Phòng mổ</td>
                                <td>Bác sĩ 1</td>
                                <td>Bác sĩ 2</td>
                                <td>Điều dưỡng</td>
                                <td>Gây mê</td>
                                <td>Nhập thông tin</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $wp_query = new WP_Query();
                            $room = $_POST['room'];
                            $doctor1 = $_POST['doctor1'];
                            $doctor2 = $_POST['doctor2'];
                            $ktv = $_POST['ktv'];
                            $input = $_POST['input'];

                            $string = array();
                            for($i=0;$i<=count($doctor1);$i++) {
                                $string[] = "'".$doctor1[$i]."<br>'";
                                $string_s[] = $doctor1[$i];
                            }
                            $sttString=implode(',',$string);
                            $sttString_send =implode('-',$string_s);

                            $string2 = array();
                            for($i=0;$i<=count($doctor2);$i++) {
                                $string2[] = "'".$doctor2[$i]."<br>'";
                                $string_s2[] = $doctor2[$i];
                            }
                            $sttString2=implode(',',$string2);
                            $sttString_send2 =implode('-',$string_s2);

                            $string3 = array();
                            for($i=0;$i<=count($ktv);$i++) {
                                $string3[] = "'".$ktv[$i]."<br>'";
                                $string_s3[] = $ktv[$i];
                            }
                            $sttString3=implode(',',$string_s3);
                            $sttString_send3 =implode('-',$string_s3);

                            $string4 = array();
                            for($i=0;$i<=count($input);$i++) {
                                $string4[] = "'".$input[$i]."'";
                                $string_s4[] = $input[$i];
                            }
                            $sttString4=implode(',',$string4);
                            $sttString_send4 =implode('-',$string_s4);

                            
                            $from = $_POST['dateFrom'];
                            $to = $_POST['dateTo'];
                            echo $sttString3;

                            $p_sur = $wpdb->get_results( "SELECT * 
                            FROM `wp_postmeta`
                            LEFT JOIN wp_posts ON wp_postmeta.post_id = wp_posts.ID
                            WHERE 
                            `meta_key` LIKE 'input' AND `meta_value` IN ($sttString4)
                            OR
                            `meta_key` LIKE 'doctor1' AND `meta_value` IN ($sttString)
                            OR
                            `meta_key` LIKE 'doctor2' AND `meta_value` IN ($sttString2)
                            OR
                            `meta_key` LIKE 'ktv' AND `meta_value` LIKE '%$sttString3%'
                            ");

                            $arr_ids = array();
                            foreach($p_sur as $PS) {
                                $arr_ids[] = $PS->post_id;
                            }
                            var_dump($arr_ids);
                            $wp_query = new WP_Query();
                            if(empty($arr_ids)) {
                                $param = array(
                                    'post_type' => 'ekip',
                                    'date_query' => array(
                                        array(
                                            'after'     => $from,
                                            'before'    => $to,
                                            'inclusive' => true,
                                        ),
                                    )
                                );
                            } else {
                                $param = array(
                                    'post_type' => 'ekip',
                                    'orderby' => 'post__in', 
                                    'post__in'=> array_unique($arr_ids),
                                );
                            }
                            $wp_query->query($param);
                            if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                        ?>
                            <tr>
                                <td><?php the_title(); ?></td>
                                <td><?php the_field('room'); ?></td>
                                <td><?php the_field('doctor1'); ?></td>
                                <td><?php the_field('doctor2'); ?></td>
                                <td><?php the_field('nursing_team'); ?></td>
                                <td><?php the_field('ktv'); ?></td>
                                <td><?php the_field('input'); ?></td>
                            </tr>
                            <?php endwhile;endif;  ?>
                        </tbody>
                    </table>
                    <a href="<?php echo APP_URL; ?>export_file/care?paidStt=<?php echo $sttString_send ?>&hasDiscount=<?php echo $hasDiscount; ?>&cancelSur=<?php echo $cancelSur; ?>&payment_status=<?php echo $payment_status; ?>&creator=<?php echo $creator; ?>&acceptor=<?php echo $acceptor; ?>&from=<?php echo $from; ?>&to=<?php echo $to; ?>" 
                        class="btnSubmit"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Xuất file Excel</a>
                <?php } ?>     
            </div>

<!-- END TAB3==================================================================================================== -->                
                <div class="tabBox" id="tab4">
                    <label class="checkStyle">
                        Hồ sơ thiếu hình CMND
                        <input type="radio" name="paidStt" value="debt" id="paidStt1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="checkStyle">
                        Hồ sơ thiếu ngày tháng năm sinh
                        <input type="radio" name="paidStt" value="debt" id="paidStt1">
                        <span class="checkmark"></span>
                    </label>
                    <?php include(APP_PATH."libs/searchBlock_2.php"); ?>
                    <?php 
                    if($_POST['search']) {
                        include(APP_PATH."data/searchResult.php");
                    }
                    ?>
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
                    <a href="<?php echo APP_URL; ?>export_file/customer?paidStt=<?php echo $sttString_send ?>&hasDiscount=<?php echo $hasDiscount; ?>&cancelSur=<?php echo $cancelSur; ?>&payment_status=<?php echo $payment_status; ?>&creator=<?php echo $creator; ?>&acceptor=<?php echo $acceptor; ?>&from=<?php echo $from; ?>&to=<?php echo $to; ?>" 
                        class="btnSubmit"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Xuất file Excel</a>
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
        setDate:'',
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

    $('#dateFrom').val('');
    $('#dateTo').val('');
      
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