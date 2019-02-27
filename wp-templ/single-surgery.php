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
                <h3 class="h3_page">Thông tin cơ bản</h3>
                <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                    <p class="inputBlock">
                    <input type="text" class="inputForm" name="fullname" id="fullname" value="<?php echo get_field('fullname'); ?>" placeholder="Họ tên" />
                    </p>
                    <p class="inputBlock">
                    <input type="number" class="inputForm" name="mobile" id="mobile" id="mobile" value="<?php echo get_field('mobile'); ?>" placeholder="Số điện thoại" />
                    </p>
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
                    <div><?php the_field('doctor_advise'); ?></div>

                    <h4 class="h4_page">Ý kiến của khách hàng</h4>
                    <div><?php the_field('cus_note'); ?></div>
                </div>

                <div class="tabBox" id="tab2">
                    <h3 class="h3_page">Tình trạng thanh toán : <?php the_field('payment_status'); ?></h3>
                    <div class="flexBox flexBox--between flexBox__form flexBox__form--3">
                        <?php $services = get_field('services'); ?>
                        <p class="inputBlock">
                        <input type="text" class="inputForm" name="discount" readonly value="<?php echo $services; ?> (<?php echo number_format(get_field('price')); ?> Đ)" placeholder="" />
                        </p>
                        <p class="inputBlock">
                        <input type="text" class="inputForm" name="discount" readonly  value= "Giá giảm: <?php echo number_format(get_field('sale_discount')); ?> Đ" placeholder="Giá giảm" />
                        </p>

                        <p class="inputBlock">
                        <input type="text" class="inputForm" id="price_real" readonly value="Còn lại: <?php echo get_field('total'); ?>" />
                        </p>
                        

                        <p class="inputBlock">
                        <input type="text" class="inputForm" name="discount" readonly  value= "Duyệt bởi : <?php echo get_field('approve'); ?>" />
                        </p>
                    </div>

                    <h4 class="h4_page">Thông tin thanh toán</h4>
                    <div><?php the_field('payment_detail'); ?></div>
                    
                </div>
                <div class="tabBox" id="tab3">
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


<!--Footer-->
<?php include(APP_PATH."libs/footer.php"); ?>
<!--/Footer-->
<!--===================================================-->
</div>
<!--/wrapper-->
<!--===================================================-->

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