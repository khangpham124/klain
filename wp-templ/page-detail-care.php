<?php /* Template Name: Detail Care */ ?>
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
        <div class="buttonBar">
            <a href="javascript:void(0)" class="callPopup"><i class="fa fa-user-plus" aria-hidden="true"></i>Tạo ca khám trái lịch</a>
        </div>
        <?php
            $now = strtotime("now");
            // echo $now = strtotime($_GET['timetest']);
            $idCare = $_GET['id'];
            $wp_query = new WP_Query();
            $param = array (
            'posts_per_page' => '1',
            'post_type' => 'care',
            'post_status' => 'publish',
            'order' => 'DESC',
            's'=> $id_sur
            );
            $wp_query->query($param);
            if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
            $listCare = get_field('listcare');
            $idPost = $post->ID;
        ?>

        <ul class="treeCare">
            <li>
                <div class="point">
                    <p class="title">Ngay sau phẫu thuật<br>(ngày mổ xong <?php echo date('d/m/Y', $listCare[0]['expire']); ?> )</p>
                </div>
        <div class="content <?php if($now > $listCare[0]['expire']) { ?>lockCare<?php } ?>">
                    <form autocomplete="off" action="<?php echo APP_URL; ?>data/editSurgery.php" method="post">
                        <div class="block">
                            <label>Lời dặn của điều dưỡng</label>
                            <textarea class="inputForm" name="nurse_mess"><?php echo $listCare[0]['nurse_mess']; ?></textarea>
                        </div>

                        <div class="block">
                            <label>Tình trạng của khách</label>
                            <textarea class="inputForm" name="stt"><?php echo $listCare[0]['stt']; ?></textarea>
                        </div>

                        <div class="block">
                            <label>Ý kiến khách hàng</label>
                            <textarea class="inputForm"  name="customer_mess"><?php echo $listCare[0]['customer_mess']; ?></textarea>
                        </div>

                        <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                            <div class="block">
                                <label>Bác sĩ khám</label>    
                                <p class="customSelect mt0">
                                    <select name="doctor">
                                        <option value="">Lựa chọn</option>
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
                                            <option <?php if($listCare[0]['doctor']==get_field('fullname',$sale->ID)) {echo "selected";} ?> value="<?php echo get_field('fullname',$sale->ID); ?>"><?php echo get_field('fullname',$sale->ID); ?></option>
                                        <?php } ?>
                                    </select>
                                </p>
                            </div>
                            <div class="block">  
                                <label>Ngày Khám</label>
                                <input type="text" class="inputForm" value="<?php echo $listCare[0]['time'] ?>" />
                            </div>
                        </div>

                        <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                            <div class="block">
                                <label>Đánh giá của khách</label>
                                <p class="customSelect mt0">
                                <select name="rating" >
                                    <option value="">Đánh giá của khách</option>
                                    <option <?php if($listCare[0]['rating']=="Hài lòng") {echo "selected";} ?> value="Hài lòng">Hài lòng</option>
                                    <option <?php if($listCare[0]['rating']=="Bình thường") {echo "selected";} ?> value="Bình thường">Bình thường</option>
                                    <option <?php if($listCare[0]['rating']=="Không hài lòng") {echo "selected";} ?> value="Không hài lòng">Không hài lòng</option>
                                </select>
                                </p>
                            </div>
                            <p class="inputBlock">     
                                <label>Nhân viên chăm sóc</label>
                                <input type="text" class="inputForm" readonly name="name_cskh" value="<?php echo $listCare[0]['name']; ?>" />
                            </p>
                        </div>

                        <input type="hidden" name="name_cskh" value="<?php echo $_COOKIE['name_cookies']; ?>" >
                        <input type="hidden" name="idSurgery" value="<?php echo $_GET['idSurgery']; ?>" >
                        <input type="hidden" name="numb" value="<?php echo $s; ?>" >
                        <input type="hidden" name="action" value="edit_cshp" >
                        <input type="hidden" name="url" value="<?php echo $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" >
                        <button class="btnSubmit"><i class="fa fa-floppy-o" aria-hidden="true"></i>Lưu</button>                
                    </form>
                </div>
            </li>

            <li>
                <div class="point">
                    <p class="title">Vệ sinh sau 1 ngày<br>(dự kến <?php echo date('d/m/Y', $listCare[1]['expire']); ?> )</p>
                </div>
                <div class="content <?php if($now > $listCare[1]['expire']) { ?>lockCare<?php } ?>">
                    <form autocomplete="off" action="<?php echo APP_URL; ?>data/editSurgery.php" method="post">
                        <div class="block">
                            <label>Lời dặn của điều dưỡng</label>
                            <textarea class="inputForm" name="nurse_mess"><?php echo $listCare[1]['nurse_mess']; ?></textarea>
                        </div>

                        <div class="block">
                            <label>Tình trạng của khách</label>
                            <textarea class="inputForm" name="stt"><?php echo $listCare[1]['stt']; ?></textarea>
                        </div>

                        <div class="block">
                            <label>Ý kiến khách hàng</label>
                            <textarea class="inputForm"  name="customer_mess"><?php echo $listCare[1]['customer_mess']; ?></textarea>
                        </div>

                        <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                            <div class="block">
                                <label>Bác sĩ khám</label>    
                                <p class="customSelect mt0">
                                    <select name="doctor">
                                        <option value="">Lựa chọn</option>
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
                                            <option <?php if($listCare[0]['doctor']==get_field('fullname',$sale->ID)) {echo "selected";} ?> value="<?php echo get_field('fullname',$sale->ID); ?>"><?php echo get_field('fullname',$sale->ID); ?></option>
                                        <?php } ?>
                                    </select>
                                </p>
                            </div>
                            <div class="block">  
                                <label>Ngày Khám</label>
                                <input type="text" class="inputForm" value="<?php echo $listCare[1]['time'] ?>" />
                            </div>
                        </div>

                        <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                            <div class="block">
                                <label>Đánh giá của khách</label>
                                <p class="customSelect mt0">
                                <select name="rating" >
                                    <option value="">Đánh giá của khách</option>
                                    <option <?php if($listCare[1]['rating']=="Hài lòng") {echo "selected";} ?> value="Hài lòng">Hài lòng</option>
                                    <option <?php if($listCare[1]['rating']=="Bình thường") {echo "selected";} ?> value="Bình thường">Bình thường</option>
                                    <option <?php if($listCare[1]['rating']=="Không hài lòng") {echo "selected";} ?> value="Không hài lòng">Không hài lòng</option>
                                </select>
                                </p>
                            </div>
                            <p class="inputBlock">     
                                <label>Nhân viên chăm sóc</label>
                                <input type="text" class="inputForm" readonly name="name_cskh" value="<?php echo $listCare[1]['name']; ?>" />
                            </p>
                        </div>
                        
                        <?php if($listCare[1]['note']!='') { ?>
                        <label>Ghi chú (khi khách đổi lịch)</label>
                        <textarea readonly class="inputForm" ><?php echo $listCare[1]['note']; ?></textarea>
                        <?php } ?>

                        <input type="hidden" name="name_cskh" value="<?php echo $_COOKIE['name_cookies']; ?>" >
                        <input type="hidden" name="idPost" value="<?php echo $idPost; ?>" >
                        <input type="hidden" name="action" value="edit_cshp" >
                        <input type="hidden" name="time" value="after1day" >
                        <input type="hidden" name="url" value="<?php echo $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" >
                        <button class="btnSubmit"><i class="fa fa-floppy-o" aria-hidden="true"></i>Lưu</button>                
                    </form>
                </div>
            </li>
        <li>
            <div class="point">
                    <p class="title">Vệ sinh sau 3 ngày<br>(dự kến <?php echo date('d/m/Y', $listCare[2]['expire']); ?> )</p>
                </div>
                <div class="content <?php if($now > $listCare[2]['expire']) { ?>lockCare<?php } ?>">
                    <form autocomplete="off" action="<?php echo APP_URL; ?>data/editSurgery.php" method="post">
                        <div class="block">
                            <label>Lời dặn của điều dưỡng</label>
                            <textarea class="inputForm" name="nurse_mess"><?php echo $listCare[2]['nurse_mess']; ?></textarea>
                        </div>

                        <div class="block">
                            <label>Tình trạng của khách</label>
                            <textarea class="inputForm" name="stt"><?php echo $listCare[2]['stt']; ?></textarea>
                        </div>

                        <div class="block">
                            <label>Ý kiến khách hàng</label>
                            <textarea class="inputForm"  name="customer_mess"><?php echo $listCare[2]['customer_mess']; ?></textarea>
                        </div>

                        <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                            <div class="block">
                                <label>Bác sĩ khám</label>    
                                <p class="customSelect mt0">
                                    <select name="doctor">
                                        <option value="">Lựa chọn</option>
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
                                            <option <?php if($listCare[2]['doctor']==get_field('fullname',$sale->ID)) {echo "selected";} ?> value="<?php echo get_field('fullname',$sale->ID); ?>"><?php echo get_field('fullname',$sale->ID); ?></option>
                                        <?php } ?>
                                    </select>
                                </p>
                            </div>
                            <div class="block">  
                                <label>Ngày Khám</label>
                                <input type="text" class="inputForm" value="<?php echo $listCare[2]['time'] ?>" />
                            </div>
                        </div>

                        <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                            <div class="block">
                                <label>Đánh giá của khách</label>
                                <p class="customSelect mt0">
                                <select name="rating" >
                                    <option value="">Đánh giá của khách</option>
                                    <option <?php if($listCare[2]['rating']=="Hài lòng") {echo "selected";} ?> value="Hài lòng">Hài lòng</option>
                                    <option <?php if($listCare[2]['rating']=="Bình thường") {echo "selected";} ?> value="Bình thường">Bình thường</option>
                                    <option <?php if($listCare[2]['rating']=="Không hài lòng") {echo "selected";} ?> value="Không hài lòng">Không hài lòng</option>
                                </select>
                                </p>
                            </div>
                            <p class="inputBlock">     
                                <label>Nhân viên chăm sóc</label>
                                <input type="text" class="inputForm" readonly name="name_cskh" value="<?php echo $listCare[2]['name']; ?>" />
                            </p>
                        </div>

                        <?php if($listCare[2]['note']!='') { ?>
                        <label>Ghi chú (khi khách đổi lịch)</label>
                        <textarea readonly class="inputForm" ><?php echo $listCare[2]['note']; ?></textarea>
                        <?php } ?>

                        <input type="hidden" name="name_cskh" value="<?php echo $_COOKIE['name_cookies']; ?>" >
                        <input type="hidden" name="idPost" value="<?php echo $idPost; ?>" >
                        <input type="hidden" name="action" value="edit_cshp" >
                        <input type="hidden" name="time" value="after3day" >
                        <input type="hidden" name="url" value="<?php echo $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" >
                        <button class="btnSubmit"><i class="fa fa-floppy-o" aria-hidden="true"></i>Lưu</button>                
                    </form>
                </div>
            </li>


            <li>
            <div class="point">
                    <p class="title">Vệ sinh sau 5 ngày<br>(dự kến <?php echo date('d/m/Y', $listCare[3]['expire']); ?> )</p>
                </div>
                <div class="content <?php if($now > $listCare[3]['expire']) { ?>lockCare<?php } ?>">
                    <form autocomplete="off" action="<?php echo APP_URL; ?>data/editSurgery.php" method="post">
                        <div class="block">
                            <label>Lời dặn của điều dưỡng</label>
                            <textarea class="inputForm" name="nurse_mess"><?php echo $listCare[3]['nurse_mess']; ?></textarea>
                        </div>

                        <div class="block">
                            <label>Tình trạng của khách</label>
                            <textarea class="inputForm" name="stt"><?php echo $listCare[3]['stt']; ?></textarea>
                        </div>

                        <div class="block">
                            <label>Ý kiến khách hàng</label>
                            <textarea class="inputForm"  name="customer_mess"><?php echo $listCare[3]['customer_mess']; ?></textarea>
                        </div>

                        <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                            <div class="block">
                                <label>Bác sĩ khám</label>    
                                <p class="customSelect mt0">
                                    <select name="doctor">
                                        <option value="">Lựa chọn</option>
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
                                            <option <?php if($listCare[3]['doctor']==get_field('fullname',$sale->ID)) {echo "selected";} ?> value="<?php echo get_field('fullname',$sale->ID); ?>"><?php echo get_field('fullname',$sale->ID); ?></option>
                                        <?php } ?>
                                    </select>
                                </p>
                            </div>
                            <div class="block">  
                                <label>Ngày Khám</label>
                                <input type="text" class="inputForm" value="<?php echo $listCare[3]['time'] ?>" />
                            </div>
                        </div>

                        <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                            <div class="block">
                                <label>Đánh giá của khách</label>
                                <p class="customSelect mt0">
                                <select name="rating" >
                                    <option value="">Đánh giá của khách</option>
                                    <option <?php if($listCare[3]['rating']=="Hài lòng") {echo "selected";} ?> value="Hài lòng">Hài lòng</option>
                                    <option <?php if($listCare[3]['rating']=="Bình thường") {echo "selected";} ?> value="Bình thường">Bình thường</option>
                                    <option <?php if($listCare[3]['rating']=="Không hài lòng") {echo "selected";} ?> value="Không hài lòng">Không hài lòng</option>
                                </select>
                                </p>
                            </div>
                            <p class="inputBlock">     
                                <label>Nhân viên chăm sóc</label>
                                <input type="text" class="inputForm" readonly name="name_cskh" value="<?php echo $listCare[3]['name']; ?>" />
                            </p>
                        </div>

                        <?php if($listCare[3]['note']!='') { ?>
                        <label>Ghi chú (khi khách đổi lịch)</label>
                        <textarea readonly class="inputForm" ><?php echo $listCare[3]['note']; ?></textarea>
                        <?php } ?>

                        <input type="hidden" name="name_cskh" value="<?php echo $_COOKIE['name_cookies']; ?>" >
                        <input type="hidden" name="idPost" value="<?php echo $idPost; ?>" >
                        <input type="hidden" name="action" value="edit_cshp" >
                        <input type="hidden" name="time" value="after5day" >
                        <input type="hidden" name="url" value="<?php echo $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" >
                        <button class="btnSubmit"><i class="fa fa-floppy-o" aria-hidden="true"></i>Lưu</button>                
                    </form>
                </div>
            </li>


            <li>
            <div class="point">
                    <p class="title">Vệ sinh sau 10 ngày<br>(dự kến <?php echo date('d/m/Y', $listCare[4]['expire']); ?> )</p>
                </div>
                <div class="content <?php if($now > $listCare[4]['expire']) { ?>lockCare<?php } ?>">
                    <form autocomplete="off" action="<?php echo APP_URL; ?>data/editSurgery.php" method="post">
                        <div class="block">
                            <label>Lời dặn của điều dưỡng</label>
                            <textarea class="inputForm" name="nurse_mess"><?php echo $listCare[4]['nurse_mess']; ?></textarea>
                        </div>

                        <div class="block">
                            <label>Tình trạng của khách</label>
                            <textarea class="inputForm" name="stt"><?php echo $listCare[4]['stt']; ?></textarea>
                        </div>

                        <div class="block">
                            <label>Ý kiến khách hàng</label>
                            <textarea class="inputForm"  name="customer_mess"><?php echo $listCare[4]['customer_mess']; ?></textarea>
                        </div>

                        <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                            <div class="block">
                                <label>Bác sĩ khám</label>    
                                <p class="customSelect mt0">
                                    <select name="doctor">
                                        <option value="">Lựa chọn</option>
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
                                            <option <?php if($listCare[4]['doctor']==get_field('fullname',$sale->ID)) {echo "selected";} ?> value="<?php echo get_field('fullname',$sale->ID); ?>"><?php echo get_field('fullname',$sale->ID); ?></option>
                                        <?php } ?>
                                    </select>
                                </p>
                            </div>
                            <div class="block">  
                                <label>Ngày Khám</label>
                                <input type="text" class="inputForm" value="<?php echo $listCare[4]['time'] ?>" />
                            </div>
                        </div>

                        <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                            <div class="block">
                                <label>Đánh giá của khách</label>
                                <p class="customSelect mt0">
                                <select name="rating" >
                                    <option value="">Đánh giá của khách</option>
                                    <option <?php if($listCare[4]['rating']=="Hài lòng") {echo "selected";} ?> value="Hài lòng">Hài lòng</option>
                                    <option <?php if($listCare[4]['rating']=="Bình thường") {echo "selected";} ?> value="Bình thường">Bình thường</option>
                                    <option <?php if($listCare[4]['rating']=="Không hài lòng") {echo "selected";} ?> value="Không hài lòng">Không hài lòng</option>
                                </select>
                                </p>
                            </div>
                            <p class="inputBlock">     
                                <label>Nhân viên chăm sóc</label>
                                <input type="text" class="inputForm" readonly name="name_cskh" value="<?php echo $listCare[4]['name']; ?>" />
                            </p>
                        </div>

                        <?php if($listCare[4]['note']!='') { ?>
                        <label>Ghi chú (khi khách đổi lịch)</label>
                        <textarea readonly class="inputForm" ><?php echo $listCare[4]['note']; ?></textarea>
                        <?php } ?>

                        <input type="hidden" name="name_cskh" value="<?php echo $_COOKIE['name_cookies']; ?>" >
                        <input type="hidden" name="idPost" value="<?php echo $idPost; ?>" >
                        <input type="hidden" name="action" value="edit_cshp" >
                        <input type="hidden" name="time" value="after10day" >
                        <input type="hidden" name="url" value="<?php echo $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" >
                        <button class="btnSubmit"><i class="fa fa-floppy-o" aria-hidden="true"></i>Lưu</button>                
                    </form>
                </div>
            </li>

            <li>
            <div class="point">
                    <p class="title">Vệ sinh sau 1 tháng<br>(dự kến <?php echo date('d/m/Y', $listCare[5]['expire']); ?> )</p>
                </div>
                <div class="content <?php if($now > $listCare[5]['expire']) { ?>lockCare<?php } ?>">
                    <form autocomplete="off" action="<?php echo APP_URL; ?>data/editSurgery.php" method="post">
                        <div class="block">
                            <label>Lời dặn của điều dưỡng</label>
                            <textarea class="inputForm" name="nurse_mess"><?php echo $listCare[5]['nurse_mess']; ?></textarea>
                        </div>

                        <div class="block">
                            <label>Tình trạng của khách</label>
                            <textarea class="inputForm" name="stt"><?php echo $listCare[5]['stt']; ?></textarea>
                        </div>

                        <div class="block">
                            <label>Ý kiến khách hàng</label>
                            <textarea class="inputForm"  name="customer_mess"><?php echo $listCare[5]['customer_mess']; ?></textarea>
                        </div>

                        <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                            <div class="block">
                                <label>Bác sĩ khám</label>    
                                <p class="customSelect mt0">
                                    <select name="doctor">
                                        <option value="">Lựa chọn</option>
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
                                            <option <?php if($listCare[5]['doctor']==get_field('fullname',$sale->ID)) {echo "selected";} ?> value="<?php echo get_field('fullname',$sale->ID); ?>"><?php echo get_field('fullname',$sale->ID); ?></option>
                                        <?php } ?>
                                    </select>
                                </p>
                            </div>
                            <div class="block">  
                                <label>Ngày Khám</label>
                                <input type="text" class="inputForm" value="<?php echo $listCare[5]['time'] ?>" />
                            </div>
                        </div>

                        <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                            <div class="block">
                                <label>Đánh giá của khách</label>
                                <p class="customSelect mt0">
                                <select name="rating" >
                                    <option value="">Đánh giá của khách</option>
                                    <option <?php if($listCare[5]['rating']=="Hài lòng") {echo "selected";} ?> value="Hài lòng">Hài lòng</option>
                                    <option <?php if($listCare[5]['rating']=="Bình thường") {echo "selected";} ?> value="Bình thường">Bình thường</option>
                                    <option <?php if($listCare[5]['rating']=="Không hài lòng") {echo "selected";} ?> value="Không hài lòng">Không hài lòng</option>
                                </select>
                                </p>
                            </div>
                            <p class="inputBlock">     
                                <label>Nhân viên chăm sóc</label>
                                <input type="text" class="inputForm" readonly name="name_cskh" value="<?php echo $listCare[5]['name']; ?>" />
                            </p>
                        </div>

                        <?php if($listCare[5]['note']!='') { ?>
                        <label>Ghi chú (khi khách đổi lịch)</label>
                        <textarea readonly class="inputForm" ><?php echo $listCare[5]['note']; ?></textarea>
                        <?php } ?>

                        <input type="hidden" name="name_cskh" value="<?php echo $_COOKIE['name_cookies']; ?>" >
                        <input type="hidden" name="idPost" value="<?php echo $idPost; ?>" >
                        <input type="hidden" name="action" value="edit_cshp" >
                        <input type="hidden" name="time" value="after30dayy" >
                        <input type="hidden" name="url" value="<?php echo $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" >
                        <button class="btnSubmit"><i class="fa fa-floppy-o" aria-hidden="true"></i>Lưu</button>                
                    </form>
                </div>
            </li>
        </ul>

        
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
    <h3 class="h3_page">Tạo ca khám trái lịch</h3>
    <form autocomplete="off" action="<?php echo APP_URL; ?>data/editCare.php" method="post">
        <div class="inputBlock">
            <input type="text" class="inputForm" id="datechose" name="datechose" value="" placeholder="Chọn ngày phẫu thuật">
            <div id="datepicker"></div>
        </div>
        <p class="inputBlock mt10">
            <input type="text" class="inputForm" name="problem" id="problem" placeholder="Tình trạng" />
        </p>
        <input type="hidden" name="action" value="createSchedule" >
        <input type="hidden" name="idPost" value="<?php echo $idPost; ?>" >
        <input type="hidden" name="url" value="<?php echo $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" >
        <input class="btnSubmit" type="submit" name="submit" value="Lưu">
    </form>
</div>

</body>
</html>	