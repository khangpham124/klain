<?php /* Template Name: Form Counter */ ?>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/projects/klain/app_config.php");
// include(APP_PATH."libs/checklog.php");
if(!$_COOKIE['login_cookies']) {    
	header('Location:'.APP_URL.'login');
}
include(APP_PATH."libs/head.php"); 
?>
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
        <h2 class="h2_page">Thong tin benh an</h2>
            <?php
                $id_sur = $_GET['idSurgery'];
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

            <form action="<?php echo APP_URL; ?>data/editSurgery.php" method="post" enctype="multipart/form-data">
                <h3 class="h3_page">Bệnh Án</h3>
                    <h4 class="h4_page">Dịch vụ yêu cầu : <?php the_field('services'); ?></h4>
                    <h4 class="h4_page">Hoi benh</h4>
                    <div class="inputBlock">
                        <label class="smallLabel">Qua trinh benh ly</label>
                        <textarea class="inputForm" name="howto" placeholder=""></textarea>
                        <div class="flexBox flexBox--between flexBox__form flexBox__form--2 mb10">
                            <p class="inputBlock borderBox" id="radHis">
                                <label class="smallLabel">Di ung thuoc</label>
                                <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Co</label>
                                <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Khong</label>
                            </p>
                            <p class="inputBlock borderBox" id="radHis">
                                <label class="smallLabel">Di ung thuc an</label>
                                <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Co</label>
                                <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Khong</label>
                            </p>
                        </div>
                        <label class="smallLabel">Tien can noi khoa</label>
                        <textarea class="inputForm" name="howto" placeholder=""></textarea>
                        <label class="smallLabel">Tien can ngoai khoa</label>
                        <textarea class="inputForm" name="howto" placeholder=""></textarea>
                        <label class="smallLabel">Kinh nguyet</label>
                        <textarea class="inputForm" name="howto" placeholder=""></textarea>
                        <label class="smallLabel">Gia dinh</label>
                        <textarea class="inputForm" name="howto" placeholder=""></textarea>
                    </div>

                     <h4 class="h4_page">Kham benh</h4>
                    <div class="inputBlock">
                        <label class="smallLabel">Toan than</label>
                        <textarea class="inputForm" name="howto" placeholder=""></textarea>
                        <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                            <div class="inputBlock">
                                <label class="smallLabel">Mach</label>
                                <input type="text" class="inputForm" name="discount" id="discount" value="" placeholder="Giá giảm" />
                                <label class="smallLabel">Nhiet do</label>
                                <input type="text" class="inputForm" name="discount" id="discount" value="" placeholder="Giá giảm" />
                                <label class="smallLabel">Huyet ap</label>
                                <input type="text" class="inputForm" name="discount" id="discount" value="" placeholder="Giá giảm" />
                            </div>
                            <div class="inputBlock">
                                <label class="smallLabel">Nhip tho</label>
                                <input type="text" class="inputForm" name="discount" id="discount" value="" placeholder="Giá giảm" />
                                <label class="smallLabel">Can nang</label>
                                <input type="text" class="inputForm" name="discount" id="discount" value="" placeholder="Giá giảm" />
                            </div>
                        </div>


                        <label class="smallLabel">Benh ngoai khoa</label>
                        <textarea class="inputForm" name="howto" placeholder=""></textarea>

                        <h4 class="h4_page">Cac co quan</h4>
                        <ul class="tabItem tabItem--4 flexBox flexBox--center flexBox--wrap">
                            <li><a href="javascript:void(0)"  data-id="tab1">MŨI</a></li>
                            <li><a href="javascript:void(0)"  data-id="tab2">MẶT</a></li>
                            <li><a href="javascript:void(0)"  data-id="tab3">CẰM</a></li>
                            <li><a href="javascript:void(0)"  data-id="tab4">KHÁC</a></li>
                        </ul>

                        <div class="tabContent">
                            <div class="tabBox" id="tab1">
                                <input type="text" class="inputForm" name="discount" id="discount" value="" placeholder="Da lam mui bao nhieu lan?" />
                                <label class="smallLabel">Mũi hiện tại</label>
                                <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Mũi silastic</label>
                                <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Mũi bọc sụn</label>
                                <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Mũi cấu trúc</label>
                                <input type="text" class="inputForm mb10" name="discount" id="discount" value="" placeholder="Hinh dang tong quat" />
                                <input type="text" class="inputForm" name="discount" id="discount" value="" placeholder="Seo vung mui" />
                                
                                <label class="smallLabel">Sóng mũi</label>
                                <div class="flexBox flexBox--between flexBox__form flexBox__form--2 mb10">
                                    <div class="inputBlock borderBox">
                                        <label class="smallLabel">Xượng mũi (gồ)</label>
                                        <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Có</label>
                                        <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Không</label>
                                        <label class="smallLabel">Lệch</label>
                                        <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Có</label>
                                        <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Không</label>
                                    </div>
                                    <div class="inputBlock borderBox">
                                        <label class="smallLabel">Bè</label>
                                        <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Có</label>
                                        <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Không</label>

                                        <label class="smallLabel">Đục xương</label>
                                        <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Có</label>
                                        <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Không</label>
                                    </div>
                                </div>
                                <input type="text" class="inputForm" name="discount" id="discount" value="" placeholder="Vi tri Radix" />

                                <label class="smallLabel">Dau mui</label>
                                <div class="flexBox flexBox--between flexBox__form flexBox__form--2 mb10">
                                    <div class="inputBlock borderBox">
                                        <label class="smallLabel">To</label>
                                        <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Co</label>
                                        <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Không</label>
                                        <label class="smallLabel">Mo mem dau mui</label>
                                        <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Nhiều</label>
                                        <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Ít</label>
                                        <label class="smallLabel">Dau mui ngan</label>
                                        <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Nhiều</label>
                                        <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Ít</label>
                                    </div>

                                    <div class="inputBlock borderBox">
                                        <label class="smallLabel">Goc mui moi</label>
                                        <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Hech</label>
                                        <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Khong hech</label>

                                        <label class="smallLabel">Da mui</label>
                                        <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Day</label>
                                        <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Mong</label>

                                        <label class="smallLabel">Do nay dau mui</label>
                                        <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Yeu</label>
                                        <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">1</label>
                                        <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">2</label>
                                        <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">3</label>
                                        <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">4</label>
                                        <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">5</label>
                                        <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Manh</label>
                                    </div>
                                </div>


                                
                                <label class="smallLabel">Danh gia vach ngang</label>
                                <div class="flexBox flexBox--between flexBox__form flexBox__form--2 mb10">
                                    <div class="inputBlock borderBox">
                                        <label class="smallLabel">Veo</label>
                                        <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Co</label>
                                        <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Khong</label>
                                    </div>
                                    <div class="inputBlock borderBox">
                                        <label class="smallLabel">Cong lom</label>
                                        <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Trai</label>
                                        <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Phai</label>
                                    </div>
                                </div>
                                <input type="text" class="inputForm mb10" name="discount" id="discount" value="" placeholder="Vat lieu su dung" />
                                <input type="text" class="inputForm" name="discount" id="discount" value="" placeholder="Cach dung tru" />

                                <label class="smallLabel">Tien dinh mui</label>
                                <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Khong khuyet</label>
                                <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Khuyet</label>
                                <input type="text" class="inputForm mb10" name="discount" id="discount" value="" placeholder="Can ghe cho khuyet" />
                                <div class="flexBox flexBox--between flexBox__form flexBox__form--2 mb10">
                                    <div class="inputBlock borderBox">
                                        <label class="smallLabel">Canh mui</label>
                                        <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Mong</label>
                                        <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Day</label>
                                    </div>
                                    <div class="inputBlock borderBox">
                                        <label class="smallLabel">Cong nhieu</label>
                                        <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Co</label>
                                        <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Khong</label>
                                    </div>
                                </div>   
                                <input type="text" class="inputForm mb10" name="discount" id="discount" value="" placeholder="Cat canh mui?" />
                                <input type="text" class="inputForm" name="discount" id="discount" value="" placeholder="Treo canh mui?" />

                                <label class="smallLabel">Nen mui</label>
                                <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Cao</label>
                                <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Thap</label>
                                <input type="text" class="inputForm" name="discount" id="discount" value="" placeholder="Ranh mui nong sau?" />

                                <label class="smallLabel">Duong kinh nen mui/khoang cach 2 khoe mat</label>
                                <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Rong</label>
                                <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Bang</label>
                                <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Nho</label>
                                <input type="text" class="inputForm" name="discount" id="discount" value="" placeholder="Thu nen mui?" />

                                <label class="smallLabel">Sun canh mui</label>
                                <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Nho</label>
                                <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">To</label>
                                <input type="text" class="inputForm" name="discount" id="discount" value="" placeholder="Bi bien dang?" />

                                <label class="smallLabel">Mui khi cuoi bi keo dai</label>
                                <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Nho</label>
                                <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">To</label>


                            </div>
                            <div class="tabBox" id="tab2">MAT</div>
                            <div class="tabBox" id="tab3">CAM</div>
                            <div class="tabBox" id="tab4">KHAC</div>
                        </div>
                    </div>





                    <!-- <h4 class="h4_page">Hình ảnh trước phẫu thuật</h4>
                    <?php
                    // $numb_image = get_field('numb_image');
                    // for($i=1;$i<=$numb_image;$i++) {
                    ?>
                    <label class="file">
                        <input type="file" name="file<?php echo $i; ?>" id="file<?php echo $i; ?>" accept="image/*" capture="camera">
                        <span class="file-custom"></span>
                    </label>
                    <?php //} ?> -->
                
                <h3 class="h3_page">Dành riêng cho BSK</h3>    
            <textarea class="inputForm" <?php if($_COOKIE['role_cookies']!='boss') { ?>readonly<?php } ?> name="bsk" id="bsk"></textarea>
                
                <input type="hidden" name="idSurgery" value="<?php echo $_GET['idSurgery']; ?>" >
                <?php if($_COOKIE['role_cookies']=='doctor') { ?>
                    <input type="hidden" name="status" value="bsnk" >
                    <input type="hidden" name="bsnk" value="<?php echo $_COOKIE['name_cookies']; ?>" >
                    <input type="hidden" name="numb_image" value="<?php echo $numb_image; ?>" >
                    <input class="btnSubmit" type="submit" name="submit" value="Cập nhật">
                    <input type="hidden" name="action" value="edit_bsnk" >
                <?php } else {  ?>
                    <input type="hidden" name="status" value="bsk" >
                    <input class="btnSubmit" type="submit" name="submit" value="Tạo">
                    <input type="hidden" name="bsk" value="<?php echo $_COOKIE['name_cookies']; ?>" >
                    <input type="hidden" name="action" value="edit_bsk" >
                <?php } ?>    
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