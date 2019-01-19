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
                <h3 class="h3_page">Bệnh Án</h3>
                <div class="flexBox flexBox--between flexBox__form">
                    <div class="flexBox__cols">
                        <h4 class="h4_page">Dịch vụ yêu cầu</h4>
                        <p class="inputBlock">
                        <input type="text" class="inputForm" readonly value="<?php the_field('services'); ?>" />
                        </p>
                    </div>
                </div>
                
                <input type="hidden" name="idSurgery" value="<?php echo $_GET['idSurgery']; ?>" >
                <input type="hidden" name="status" value="quay" >
                <input type="hidden" name="action" value="edit" >
                <?php if($_COOKIE['role_cookies']=='doctor') { ?>
                    <input type="hidden" name="bsnk" value="<?php echo $_COOKIE['name_cookies']; ?>" >
                    <input class="btnSubmit" type="submit" name="submit" value="Cập nhật">
                <?php } else {  ?>
                    <input class="btnSubmit" type="submit" name="submit" value="Tạo">
                    <input type="hidden" name="bsk" value="<?php echo $_COOKIE['name_cookies']; ?>" >
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