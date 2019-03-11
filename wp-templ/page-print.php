<?php /* Template Name: Print */ ?>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/projects/klain/app_config.php");
// include(APP_PATH."libs/checklog.php");
if(!$_COOKIE['login_cookies']) {    
	header('Location:'.APP_URL.'login');
}
include(APP_PATH."libs/head.php"); 
?>
</head>

<body id="print">
<!--===================================================-->
<div id="wrapper">
<!--===================================================-->
<!--Header-->
<?php include(APP_PATH."libs/header.php"); ?>
<!--/Header-->

<div class="flexBox flexBox--between textBox flexBox--wrap maxW">
    
    <div class="blockPage blockPage--full">
        <div class="flexBox flexBox--between">
            <p class='txtHead__print'>Trung tâm thẩm mỹ Klain<br>
            126 Nguyễn Trãi, phường 3, Quận 5<br>
            0923.999.229 - 0903.164.535<br>
        0902.648.232 - 090.118.3164
            </p>
            <p>
            <img src="<?php echo APP_URL; ?>common/img/header/logo.png" alt="">
            </p>
        </div>
        <h2 class="h2_page_print">Phiếu thu</h2>
        <table class="tblPage">
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
            <tr>
                <th colspan="2">Ngày <?php echo date("d") ?>Tháng <?php echo date("m") ?>Năm <?php echo date("Y") ?>                
                </th>
            </tr>

            <tr>
                <th>Họ tên người nộp tiền</th>
                <td><?php the_field('fullname'); ?> Mã KH:<?php echo get_field('idcustomer',get_field('cusid_post')); ?></td>
            </tr>

            <tr>
                <th>Số điện thoại</th>
                <td><?php the_field('mobile'); ?></td>
            </tr>

            <tr>
                <th>Số CMND</th>
                <td><?php echo get_field('idcard',get_field('cusid_post')); ?></td>
            </tr>

            <tr>
                <th>Địa chỉ</th>
                <td><?php echo get_field('address',get_field('cusid_post')); ?></td>
            </tr>

            <tr>
                <th>Dịch vụ thực hiện</th>
            </tr>

            <tr>
                <th><?php the_field('services'); ?></th>
                <td><input type="text" class="inputForm" id="price_real_1" readonly value="<?php echo number_format(get_field('price')); ?>" /></td>
            </tr>
            <?php if(get_field('services_2')!='') { ?>
            <tr>
                <th><?php the_field('services_2'); ?></th>
                <td><input type="text" class="inputForm" id="price_real_2" readonly value="<?php echo number_format(get_field('price_2')); ?>" /></td>
            </tr>
            <?php } ?>
            <?php if(get_field('services_3')!='') { ?>
            <tr>
                <th><?php the_field('services_3'); ?></th>
                <td><input type="text" class="inputForm" id="price_real_3" readonly value="<?php echo number_format(get_field('price_3')); ?>" /></td>
            </tr>
            <?php } ?>

            <tr>
                <th>Khuyến mãi</th>
                <td><?php echo number_format(get_field('sale_discount')); ?></td>
            </tr>

            <tr>
                <th>Số tỉền thanh toán</th>
                <td><?php echo number_format(get_field('remain')); ?></td>
            </tr>

            

            <tr>
                <th>Tình trạng thu</th>
                <td><?php the_field('payment_status'); ?>
                    <?php if(get_field('deposit')!='') { ?>
                    <h4 class="h4_page">Đặt cọc</h4>
                    <?php echo get_field('deposit'); ?>
                    <?php } ?>
                    <?php if(get_field('debt')!='') { ?>
                    <h4 class="h4_page">Còn nợ</h4>
                    <?php echo get_field('debt'); ?>
                    <?php } ?>
                    <h4 class="h4_page">Chi tiết</h4>
                    <label class="labelReg" for="rad1">Tiền mặt</label>
                    <p class="inputBlock inputNumber">
                        <input type="text" data-type="number" class="inputForm" name="cash_money" <?php if(get_field('process')=='yes') { ?>readonly<?php } ?> id="cash_money" placeholder="Số tiền mặt" value="<?php echo get_field('cash_money'); ?>" />
                    </p>
                    <label class="labelReg" for="rad2">Chuyển khoản</label>
                    <p class="inputBlock inputNumber">
                        <input type="text" data-type="number" class="inputForm" name="bank_money" <?php if(get_field('process')=='yes') { ?>readonly<?php } ?> id="bank_money" placeholder="Số chuyển khoản" value="<?php echo get_field('bank_money'); ?>" />
                        
                    </p>
                    <label class="labelReg" for="rad3">Visa/Master</label>
                    <p class="inputBlock inputNumber">
                        <input type="text" data-type="number" class="inputForm" name="visa_money" <?php if(get_field('process')=='yes') { ?>readonly<?php } ?> id="visa_money" placeholder="Thanh toán visa" value="<?php echo get_field('visa_money'); ?>" />
                        
                    </p>
                </td>
            </tr>
            <?php endwhile;endif; ?>  
        </table>    

        <div class="flexBox flexBox--between flexBox__form flexBox__form--3 txtPrint">
            <p class="inputBlock inputNumber"><strong>Giám đốc</strong><em>(Ký ,họ tên, đóng dấu)</em></p>
            <p class="inputBlock inputNumber"><strong>Người nộp tiền</strong><em>(Ký ,họ tên)</em></p>
            <p class="inputBlock inputNumber"><strong>Người lãp phiếu</strong><em>(Ký ,họ tên, đóng dấu)</em></p>
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

<script>
$( function() {
    // $(window).load(function() {
    //     window.print();
    // });
});
</script>      

</body>
</html>	