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
        <div class="buttonBar">
            <a href="<?php echo APP_URL ?>add-customer/"><i class="fa fa-user-plus" aria-hidden="true"></i>Tạo khách hàng mới</a>
            <a href="<?php echo APP_URL ?>add-surgery/"><i class="fa fa-user-plus" aria-hidden="true"></i>Tạo ca phẫu thuật</a>
            <a href="javascript:void(0)" onClick="window.location.href=window.location.href"><i class="fa fa-refresh" aria-hidden="true"></i>Cập nhật hệ thống</a>
        </div>
        <h2 class="h2_page">Tạo phiếu thu</h2>
            <?php
                $id_sur = $_GET['idSurgery'];
                $idCustomer = 'KLAIN_19';
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
                <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                    <label class="file">
                        <input type="file" name="file1" id="file1" aria-label="Mặt trước chứng minh">
                        <span class="file-custom"></span>
                    </label>
                    <label class="file">
                        <input type="file" name="file2" id="file2" aria-label="Mặt sau chứng minh">
                        <span class="file-custom"></span>
                    </label>
                </div>

                <h3 class="h3_page">Thông tin thanh toán</h3>
                <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                    <div class="flexBox__cols">
                        <h4 class="h4_page">Dịch vụ yêu cầu</h4>
                        <p class="inputBlock">
                        <input type="text" class="inputForm" readonly value="<?php the_field('services'); ?>" />
                        </p>
                    
                        <h4 class="h4_page">Phương thức thanh toán</h4>
                        <p class="inputBlock" id="radmethodPay">
                            <input type="radio" class="radioForm" id="rad1" name="methodPay" value="cash" /><label class="labelReg" for="rad1">Tiền mặt</label><br>
                            <input type="radio" class="radioForm" id="rad2" name="methodPay" value="bank-transfer" /><label class="labelReg" for="rad2">Chuyển khoản</label><br>
                            <input type="radio" class="radioForm" id="rad3" name="methodPay" value="visa" /><label class="labelReg" for="rad3">Visa/Master</label>
                        </p>
                        <h4 class="h4_page">Tình trạng thanh toán</h4>
                        <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                            <p class="inputBlock" id="radstatusPay">
                                <input type="radio" class="radioForm" id="rad4" name="statusPay" value="Thu đủ" /><label class="labelReg" for="rad4">Thu đủ</label>
                                <input type="radio" class="radioForm" id="rad5" name="statusPay" value="Đặt cọc" /><label class="labelReg" for="rad5">Đặt cọc</label>
                            </p>
                            <p class="inputBlock monneyDeposit">
                                <input type="number" class="inputForm" name="deposit" placeholder="Số tiền cọc" />
                            </p>
                        </div>    
                    </div>

                    <div class="flexBox__cols">
                        <h4 class="h4_page">Giá gốc dịch vụ</h4>
                        <p class="inputBlock">
                            <input type="text" class="inputForm" id="price_real" readonly value="<?php the_field('price'); ?>" />
                        </p>
                        <h4 class="h4_page">Sale giảm giá</h4>
                        <p class="inputBlock">
                            <input type="text" class="inputForm" id="price_sale" name="price_sale" <?php if($_COOKIE['role_cookies']!='manager') { ?> readOnly <?php } ?> value="<?php the_field('sale_discount'); ?>" />
                        </p>
                        <p class="inputBlock<?php if($_COOKIE['role_cookies']!='manager') { ?> readOnly <?php } ?>">
                            <input type="checkbox" class="chkForm" <?php if(get_field('accept')=='yes') { ?> checked <?php } ?> id="accept" name="accept" value="yes" /><label class="labelReg" for="accept">Quản lý chấp nhận</label>
                            <?php if(get_field('accept')=='yes') { ?>
                                <br>
                            Duyệt bởi : <?php echo get_field('approve'); ?>
                            <?php } ?>
                        </p>
                        <h4 class="h4_page">Chương trình giảm giá</h4>
                            <p class="inputBlock">
                                <input type="checkbox" class="chkForm" id="code_voucher" name="code_voucher" value="500" /><label class="labelReg" for="code_voucher">Code voucher</label><br class="sp">
                                <input type="checkbox" class="chkForm" id="promotion" name="promotion" value="100" /><label class="labelReg" for="promotion">Chương trình khuyến mãi</label><br class="sp">
                            </p>
                        <h4 class="h4_page">Thành tiền</h4>    
                        <p class="inputBlock"><input type="text" id="totalFee" name="totalFee" class="inputForm" readonly value="" /></p>
                    </div>
                </div>
                
                <input type="hidden" name="idCustomer" value="<?php echo $idCustomer; ?>" >
                <input type="hidden" name="cusId_post" value="<?php echo get_field('cusId_post'); ?>" >
                <input type="hidden" name="idSurgery" value="<?php echo $_GET['idSurgery']; ?>" >
                <input type="hidden" name="approve" value="<?php echo $_COOKIE['name_cookies']; ?>" >
                <input type="hidden" name="status" value="quay" >
                <input type="hidden" name="action" value="edit" >
                <?php if($_COOKIE['role_cookies']=='manager') { ?>
                    <input class="btnSubmit" type="submit" name="submit" value="Cập nhật">
                <?php } else {  ?>
                    <input class="btnSubmit" type="submit" name="submit" value="Tạo">
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

<script>
$( function() {
    var price_real = $('#price_real').val();
    var promotion = $('#promotion').val();
    if($('input[name="accept"]').is(':checked')) {
        var price_sale = $('#price_sale').val();
    } else {
        var price_sale = 0;
    }

    var code_voucher = 0;
    $("#code_voucher").on('click', function () {
        if($('input[name="code_voucher"]').is(':checked')) {
            var code_voucher = $('#code_voucher').val();
            alert(code_voucher);
        }
    });



    if($('input[name="promotion"]').is(':checked')) {
        var promotion = $('#promotion').val();
    } else {
        var promotion = 0;
    }

    var totalPrice = price_real - price_sale - promotion - code_voucher;
    $('#totalFee').val(totalPrice);


    $('input[type=radio][name=statusPay]').change(function() {
        if (this.value == 'Đặt cọc') {
            $('.monneyDeposit').slideDown(200);
        } else {
            $('.monneyDeposit').slideUp(200);    
        }
    });

});
</script>      

</body>
</html>	