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

<body id="sugery_detail">
<div class="flexBox flexBox--between flexBox--wrap">
<?php include(APP_PATH."libs/sidebar.php"); ?>
<!--===================================================-->
<div id="wrapper">
<!--===================================================-->
<!--Header-->
<?php include(APP_PATH."libs/header.php"); ?>
<!--/Header-->

<div class="flexBox flexBox--between textBox flexBox--wrap maxW">
    <div class="blockPage blockPage--full">
        <h2 class="h2_page">Thông tin Ca phẫu thuật</h2>

         <ul class="tabItem tabItem--5 flexBox flexBox--center flexBox--wrap">
            <li><a href="javascript:void(0)"  data-id="tab1">Thông tin ban đầu</a></li>
            <li><a href="javascript:void(0)"  data-id="tab2">Tình trạng thanh toán</a></li>
            <li><a href="javascript:void(0)"  data-id="tab3">Bác sĩ khám</a></li>
            <li><a href="javascript:void(0)"  data-id="tab4">Chi tiết ca phẫu thuật</a></li>
            <li><a href="javascript:void(0)"  data-id="tab5">Chăm sóc hậu phẫu</a></li>
            
        </ul>

        <div class="tabContent">
            <div class="tabBox" id="tab1">
                <form action="<?php echo APP_URL; ?>data/editSurgery.php" method="post" enctype="multipart/form-data">
                <h3 class="h3_page">Thông tin cơ bản</h3>
                <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                    <p class="inputBlock">
                    <input type="text" class="inputForm" name="fullname" id="fullname" value="<?php echo get_field('fullname'); ?>" placeholder="Họ tên" />
                    </p>
                    <?php if($_COOKIE['role_cookies']!='doctor') { ?>
                        <p class="inputBlock">
                        <input type="number" class="inputForm" name="mobile" id="mobile" id="mobile" value="<?php echo get_field('mobile'); ?>" placeholder="Số điện thoại" />
                        </p>
                    <?php } ?>
                </div>    
                <!-- phuong thu tu van -->
                <h3 class="h3_page">Thông tin tư vấn</h3>
                <p class="inputBlock" id="radAdvise">
                    <input type="radio" class="radioForm" <?php if(get_field('advise')=="yes") { ?>checked <?php } ?> id="rad1" name="advise" value="yes" /><label class="labelReg" for="rad1">Đã được tư vấn</label>
                    <input type="radio" class="radioForm" <?php if(get_field('advise')=="no") { ?>checked <?php } ?> id="rad2" name="advise" value="no" /><label class="labelReg" for="rad2">Chưa được tư vấn</label>
                </p>
                <?php $adviser = get_field('adviser'); ?>

                <div class="blockAdvise" <?php if($adviser!='') { ?>style="display:block"<?php } ?>>
                    <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                    <p class="inputBlock">
                        <input type="text" class="inputForm" name="facebook" id="facebook" value="<?php echo $adviser; ?>"/>
                    </p>  
                        <p class="inputBlock customSelect">
                            <select name="channel">
                                <option value="">Lựa chọn kệnh tư vấn</option>
                                <option <?php if(get_field('channel')=='facebook') { ?>selected<?php } ?> value="facebook">Qua facebook</option>
                                <option <?php if(get_field('channel')=='mobile') { ?>selected<?php } ?> value="mobile">Qua Điện thoại</option>
                            </select>
                        </p>  
                    </div>
                    <p class="inputBlock blockFacebook">
                        <input type="text" class="inputForm" name="facebook" id="facebook" placeholder="Facebook của khách" />
                    </p>  
                </div>
                <!-- phuong thu tu van -->

                <h3 class="h3_page">Thông tin dịch vụ thực hiện</h3>
                    <?php
                        $listService = get_field('services');
                        $listServices = explode('<br>',$listService);
                    ?>
                    <h5 class="h5_page">Dịch vụ yêu cầu</h5>
                    <?php foreach($listServices as $serv) {
                        echo $serv.'<br>';
                    }    
                    ?>
                    <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                        <div class="inputBlock">
                            <input type="text" class="inputForm" id="datechose" readonly name="datechose" value="<?php echo get_field('date'); ?>" placeholder="Chọn ngày phẫu thuật">
                        </div>
                    </div>    
                

                    <h4 class="h4_page">Lịch sử phẫu thuật (trước kia)</h4>
                    <div class="inputBlock">
                        <div><?php the_field('detail_history'); ?></div>
                        <h4 class="h4_page">Tình trạng hiện tại</h4>
                        <input type="text" class="inputForm" readonly  value="<?php echo get_field('self_status'); ?>" >

                        <h4 class="h4_page">Mong muốn của khách hàng</h4>
                        <div><?php the_field('target'); ?></div>
                    </div>

                    <div class="typeService" id="faceSurery" >
                        <h4 class="h4_page">Cấu trúc nguyên thuỷ</h4>
                            <textarea class="inputForm" name="origin" id="origin"></textarea>
                        <h4 class="h4_page">Mong muốn của khách hàng</h4>
                        <p class="inputBlock">
                            <input type="radio" class="radioForm" id="wish1" name="target" value="Tuỳ thuộc vào tư vấn của bác sĩ và tư vấn viên" /><label class="labelReg" for="wish1">Tuỳ thuộc vào tư vấn của bác sĩ và tư vấn viên</label>
                            <input type="radio" class="radioForm" id="wish2" name="target" value="Theo nhu cầu của khách" /><label class="labelReg" for="wish2">Theo nhu cầu của khách</label>
                            <textarea class="inputForm" name="target_text"></textarea>
                        </p>    
                    </div>
                    <h4 class="h4_page">Tiền căn dị ứng</h4>
                    <div><?php the_field('caution'); ?></div>

                    <h4 class="h4_page">Tư vấn của bác sĩ</h4>
                    <div>
                    <textarea class="inputForm" <?php if(($_COOKIE['role_cookies']!='doctor')&&(get_field('status')=='pending')) { ?>readonly<?php } ?> name="doctor_advise"><?php if(get_field('doctor_advise')!="") {echo get_field('doctor_advise'); } ?></textarea>
                    </div>

                    <h4 class="h4_page">Ý kiến của khách hàng</h4>
                    <div><?php the_field('cus_note'); ?></div>
                    <input type="hidden" name="name_edit" value="<?php echo $_COOKIE['name_cookies']; ?>" >
                    <input type="hidden" name="idSurgery" value="<?php echo $post->ID; ?>" >
                    <?php if(get_field('status')=='pending') { ?>
                        <input type="hidden" name="status" value="tvv" >
                    <?php } ?>
                    <input type="hidden" name="action" value="edit_info" >
                    <input class="btnSubmit" type="submit" name="submit" value="Lưu">
                    </form>
                </div>
                <!-- het tabl1 -->
                <div class="tabBox" id="tab2">
                    <h3 class="h3_page">Tình trạng thanh toán : <?php the_field('payment_status'); ?></h3>
                    <h4 class="h4_page">Thông tin dịch vụ</h4>
                        <table class="tblPage">
                            <tr>
                                <th>
                                    Tóm tắt dịch vụ
                                </th>
                                    <td>
                                    <?php
                                        $listService = get_field('services');
                                        $listServices = explode('<br>',$listService);
                                    ?>
                                    <h5 class="h5_page">Dịch vụ yêu cầu</h5>
                                    <?php foreach($listServices as $serv) {
                                        echo $serv.'<br>';
                                    }    
                                    ?>
                                    <h5 class="h5_page">Tổng tiền</h5>
                                    <input type="text" class="inputForm" name="show_total" id="show_total" value="<?php echo number_format(get_field('total')); ?>" />
                                </td>
                            </tr>
                            <tr>
                                <th>Giảm giá</th>
                                <td><input type="text" class="inputForm" name="sale_discount" id="sale_discount" readonly value="<?php echo number_format(get_field('sale_discount')); ?>" /></td>
                            </tr>
                            <tr>
                                <th colspan="3">
                                <p class="inputBlock<?php if($_COOKIE['role_cookies']!='manager') { ?> readOnly <?php } ?>">
                                    <input type="checkbox" class="chkForm" <?php echo $check; ?> <?php if(get_field('accept')=='yes') { ?> checked <?php } ?> id="accept" name="accept" value="yes" />
                                    <label class="labelReg" for="accept">Giảm giá được chấp nhận</label>
                                </p>
                                
                                <?php if(get_field('accept')=='yes') { ?>
                                Duyệt bởi : <?php echo get_field('approve'); ?>
                                <?php } ?>
                                
                                </th>
                            </tr>
                            <tr>
                            <th>Tổng tiền sau điều chỉnh</th>
                                <td>
                                    <p class="inputBlock">
                                    <input type="text" id="totalFee" name="totalFee" class="inputForm" readonly value="<?php echo number_format(get_field('remain')); ?>" />
                                    </p>
                                </td>
                            </tr>
                        </table>

            
                        <h4 class="h4_page">Phương thức thanh toán</h4>
                        <table class="tblPage">
                            <tr>
                                <td><input type="radio" class="radioForm" id="rad4" name="statusPay" <?php if(get_field('payment_status')=='Thu đủ') { ?>checked<?php } ?> value="Thu đủ" /><label class="labelReg" for="rad4">Thu đủ</label><br></td>
                                <td><input type="radio" class="radioForm" id="rad5" name="statusPay" <?php if(get_field('deposit')!='') { ?> checked <?php } ?> value="Đặt cọc" /><label class="labelReg" for="rad5">Đặt cọc</label><br>
                                <p class="inputBlock inputNumber monneyDeposit" <?php if(get_field('deposit')!='') { ?> style="display:block;" <?php } ?>>
                                <input type="text" data-type="number" class="inputForm" id="deposit" name="deposit" placeholder="Số tiền cọc" />
                                <span></span>
                                </p>
                                </td>
                                <td><input type="radio" class="radioForm" id="rad6" name="statusPay" value="Nợ" <?php if(get_field('debt')!='') { ?> checked <?php } ?> /><label class="labelReg" for="rad6">Nợ</label><br>
                                <p class="inputBlock inputNumber monneyNo" <?php if(get_field('debt')!='') { ?> style="display:block;" <?php } ?>>
                                <input type="text" data-type="number" class="inputForm" id="debt" name="debt" placeholder="Còn nợ" <?php if(get_field('debt')!='') { ?> readonly value="<?php echo number_format(get_field('debt')); ?>" <?php } ?> />
                                </p>
                                </td>
                            </tr>
                        </table>
                        <div class="inputBlock" id="radstatusPay">
                            
                            
                        </div>

                        <div class="flexBox flexBox--between flexBox__form flexBox__form--3">
                            <div class="inputBlock">    
                                <label class="labelReg" for="rad1">Tiền mặt</label>
                                <p class="inputNumber">
                                    <input type="text" data-type="number" class="inputForm" name="cash_money" <?php if(get_field('process')=='yes') { ?><?php } ?> id="cash_money" placeholder="Số tiền mặt" value="<?php echo number_format(get_field('cash_money')); ?>" />
                                </p>
                            </div>

                            <div class="inputBlock">
                                <label class="labelReg" for="rad2">Chuyển khoản</label>
                                <p class="inputNumber">
                                    <input type="text" data-type="number" class="inputForm" name="bank_money" <?php if(get_field('process')=='yes') { ?><?php } ?> id="bank_money" placeholder="Số chuyển khoản" value="<?php echo number_format(get_field('bank_money')); ?>" />
                                </p>
                            </div>
                            <div class="inputBlock">
                                <label class="labelReg" for="rad3">Visa/Master</label>
                                <p class="inputNumber">
                                    <input type="text" data-type="number" class="inputForm" name="visa_money" <?php if(get_field('process')=='yes') { ?><?php } ?> id="visa_money" placeholder="Thanh toán visa" value="<?php echo number_format(get_field('visa_money')); ?>" />

                                </p>
                            </div>
                        </div> 

                        <div id="listBank">
                            <input type="radio" class="radioForm" id="rad_bank1" name="nameBank" value="Vietcombank" /><label class="labelReg" for="rad_bank1">Vietcombank</label>
                            <input type="radio" class="radioForm" id="rad_bank2" name="nameBank" value="VietinBank" /><label class="labelReg" for="rad_bank2">VietinBank</label>
                            <input type="radio" class="radioForm" id="rad_bank3" name="nameBank" value="Eximbank" /><label class="labelReg" for="rad_bank3">Eximbank</label>
                        </div>

                        <?php if((get_field('debt')>0)&&(get_field('debter')=='yes')) { ?>            
                        <p class="inputBlock">
                            <label class="labelReg" for="rad3">Người bảo lãnh</label>
                            <input type="text" id="totalFee" name="totalFee" class="inputForm" readonly value="<?php echo get_field('guy'); ?>" />
                        </p>
                        <p class="inputBlock">
                            <label class="labelReg" for="rad3">Duyệt bảo lãnh</label>
                            <input type="text" id="totalFee" name="totalFee" class="inputForm" readonly value="<?php echo get_field('approve2'); ?>" />
                        </p>
                        <?php } ?>

                    <table class="tblPage">
                        <tr>
                            <th>Số tiền đã thanh toán</th>
                            <td><p class="inputBlock"><input type="text" id="remain" name="remain" class="inputForm" readonly value="<?php if(get_field('remain')!='') { ?><?php echo number_format(get_field('remain')); ?><?php } ?>" /></p></td>
                        </tr>
                    </table>
                </div>



                <div class="tabBox doctorPart" id="tab3">
                    <?php 
                    $id_med = get_field('idmedical');
                    if($id_med!='') {
                    $wp_query = new WP_Query();
                    $param = array (
                        'posts_per_page' => '1',
                        'post_type' => 'medical',
                        'post_status' => 'publish',
                        'order' => 'DESC',
                        'p'=>$id_med
                    );
                    $wp_query->query($param);
			        if($wp_query->have_posts()): while($wp_query->have_posts()) :$wp_query->the_post();
                    ?>
                    <h3 class="h3_page">Bác sĩ:<?php the_field('bsnk_name'); ?></h3>
                    <h4 class="h4_page">Bệnh án ngoại khoa</h4>
                    <div>
                        <?php the_field('bsnk_advise'); ?>
                    </div>
                    <h4 class="h4_page">Hình ảnh trước khi phẫu thuật</h4>
                    <ul></ul>

                    <h4 class="h4_page">Bác sỉ Khải</h4>
                    <div>
                        <?php the_field('bsk'); ?>
                    </div>
                    <?php endwhile;endif; ?>
                    <?php } ?>
                </div>


                <div class="tabBox" id="tab4">
                    <?php
                    $room_name = get_field('ekip');
                    $room_id = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE post_title = '" . $room_name . "'" );

                    ?>
                    <h3 class="h3_page">Thông tin phòng mổ : Phòng số <?php echo get_field('room',$room_id); ?></h3>
                    <table class="tblPage">
                        <tr>
                            <th>Bác sĩ 1</th>
                            <td><?php the_field('doctor1',$room_id); ?></td>
                        </tr>

                        <tr>
                            <th>Bác sĩ 1</th>
                            <td><?php the_field('doctor2',$room_id); ?></td>
                        </tr>

                        <tr>
                            <th>Danh sách điều dưỡng</th>
                            <td>
                                <?php the_field('nursing1',$room_id); ?><br>
                                <?php the_field('nursing2',$room_id); ?><br>
                                <?php the_field('nursing3',$room_id); ?><br>
                                <?php the_field('nursing4',$room_id); ?><br>
                                <?php the_field('nursing5',$room_id); ?><br>
                            </td>
                        </tr>

                        <tr>
                            <th>Gây mê</th>
                            <td><?php the_field('ktv',$room_id); ?></td>
                        </tr>

                        <tr>
                            <th>Nhập thông tin</th>
                            <td><strong><?php the_field('input',$room_id); ?></strong></td>
                        </tr>
                    </table>

                    <h3 class="h3_page">Tường trình ca mổ</h3>
                    <div><?php the_field('report'); ?></div>
                    <h3 class="h3_page">Vật tư sử dụng</h3>
                    <div><?php the_field('supplies'); ?></div>
                </div>
                <div class="tabBox" id="tab5">
                <h3 class="h3_page">Chăm sóc hậu phẫu</h3>
                <form action="<?php echo APP_URL; ?>data/editSurgery.php" method="post" enctype="multipart/form-data">
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
                    
                </div>


            <button onclick="window.print();return false;" class="btnSubmit">In</button>
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
    $('#tab1').show();
    $('.tabItem li:nth-child(1)').addClass('active');
    $('.tabItem li').click(function() {
        $('.tabItem li').removeClass('active');
        $(this).toggleClass('active');
        var tabId = $(this).find('a').attr('data-id');
        $('.tabBox').fadeOut(200);
        $('#'+tabId).fadeIn(200);
    });        
</script>

</body>
</html>	