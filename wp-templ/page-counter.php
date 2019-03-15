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

<body id="counter">

<div class="flexBox flexBox--between flexBox--wrap">
    <?php include(APP_PATH."libs/sidebar.php"); ?>
    <div id="wrapper">
    <!--Header-->
    <?php include(APP_PATH."libs/header.php"); ?>
    <!--/Header-->

    <div class="flexBox flexBox--between textBox flexBox--wrap maxW">
        
        <div class="blockPage blockPage--full">
            <h2 class="h2_page">Tạo phiếu thu</h2>
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
                    $cusId_post = get_field('cusid_post');
        
                ?>
                <h3 class="h3_page">Thông tin khách hàng</h3>
                <div class="flexBox flexBox--between flexBox__form flexBox__form--2 mb10">
                    <p class="inputBlock">
                    <input type="text" class="inputForm" name="fullname" placeholder="Họ tên" readonly value="<?php the_field('fullname'); ?>" />
                    </p>
                    <p class="inputBlock">
                    <input type="text" class="inputForm" name="mobile" placeholder="Mobile" readonly value="<?php the_field('mobile'); ?>" />
                    </p>
                </div>
                <form action="<?php echo APP_URL; ?>data/editSurgery.php" method="post" enctype="multipart/form-data">
                    <?php if(get_field('ic_front',$cusId_post)=='') { ?>
                    <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                        <input type="file" name="file1" id="file1" aria-label="Mặt trước chứng minh">
                        <input type="file" name="file2" id="file2" aria-label="Mặt sau chứng minh">
                        
                    </div>
                    <?php } else { ?>
                    <div class="flexBox flexBox--between flexBox__form flexBox__form--2 mb10">
                    <p class="inputBlock"><img src="<?php echo get_field('ic_front',$cusId_post); ?>"></p>
                    <p class="inputBlock"><img src="<?php echo get_field('ic_back',$cusId_post); ?>"></p>
                    </div>
                    <?php } ?>

                    <h3 class="h3_page">Thông tin thanh toán</h3>

                    
                    <h4 class="h4_page">Dịch vụ yêu cầu</h4>
                        <table class="tblPage">
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
                                <th>Giảm giá</th>
                                <td><input type="text" class="inputForm" name="sale_discount" id="sale_discount" <?php if(($_COOKIE['role_cookies']!='manager')) { ?> readonly <?php } ?> value="<?php echo get_field('sale_discount'); ?>" /></td>
                            </tr>
                            <tr>
                                <th colspan="3">
                                <p class="inputBlock<?php if($_COOKIE['role_cookies']!='manager') { ?> readOnly <?php } ?>">
                                <?php
                                $price1 = get_field('price');
                                $price2 = get_field('price_2');
                                $price3 = get_field('price_3');
                                $discount = get_field('sale_discount');
                                $total_price = (int)$price1 + (int)$price2 + (int)$price3;
                                $total_discount = (int)$discount;
                                $total_remain =$total_price - $total_discount;

                                $lim1 = 30000000;
                                $lim2 = 49000000;
                                $lim3 = 50000000;
                                $lim4 = 79000000;
                                $lim5 = 80000000;
                                $lim6 = 99000000;
                                $lim7 = 100000000;
                                if(($total_price >= $lim1)&&($total_price <= $lim2)) {
                                    if($total_discount <= 1000000) {
                                        $check = "checked";
                                    } else {
                                        $check = "test";
                                    }
                                }
                                if(($total_price >= $lim3)&&($total_price <= $lim4)) {
                                    if($total_discount <= 2000000) {
                                        $check = "checked";
                                    } else {
                                        $check = "";
                                    }
                                }
                                if(($total_price >= $lim5)&&($total_price <= $lim6)) {
                                    if($total_discount <= 3000000) {
                                        $check = "checked";
                                    } else {
                                        $check = "";
                                    }
                                }
                                if($total_price >= $lim7) {
                                    if($total_discount <= 5000000) {
                                        $check = "checked";
                                    } else {
                                        $check = "";
                                    }
                                }
                                ?>
                                    <input type="checkbox" class="chkForm" <?php echo $check; ?> <?php if(get_field('accept')=='yes') { ?> checked <?php } ?> id="accept" name="accept" value="yes" /><label class="labelReg" for="accept">Giảm giá được chấp nhận</label>
                                </p>
                                    <p class="inputBlock<?php if($_COOKIE['role_cookies']!='manager') { ?> readOnly <?php } ?>">
                                    <?php if(get_field('accept')=='yes') { ?>
                                        <br>
                                    Duyệt bởi : <?php echo get_field('approve'); ?>
                                    <?php } ?>
                                </p>
                                </th>
                            </tr>
                            <tr>
                            <th>Tồng cộng</th>
                                <td><p class="inputBlock"><input type="text" id="totalFee" name="totalFee" class="inputForm" readonly value="<?php echo $total_remain; ?>" /></p></td>
                            </tr>
                        </table>

            
                        <h4 class="h4_page">Phương thức thanh toán</h4>
                        <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                            <div class="inputBlock" id="radstatusPay">
                                <input type="radio" class="radioForm" id="rad4" name="statusPay" <?php if(get_field('payment_status')=='Thu đủ') { ?>checked<?php } ?> value="Thu đủ" /><label class="labelReg" for="rad4">Thu đủ</label><br>
                                <input type="radio" class="radioForm" id="rad5" name="statusPay" <?php if(get_field('deposit')!='') { ?> checked <?php } ?> value="Đặt cọc" /><label class="labelReg" for="rad5">Đặt cọc</label><br>
                                    <input type="radio" class="radioForm" id="rad6" name="statusPay" value="Nợ" <?php if(get_field('debt')!='') { ?> checked <?php } ?> /><label class="labelReg" for="rad6">Nợ</label><br>

                                <p class="inputBlock inputNumber monneyNo" <?php if(get_field('debt')!='') { ?> style="display:block;" <?php } ?>>
                                    <input type="text" data-type="number" class="inputForm" id="debt" name="debt" placeholder="Còn nợ" <?php if(get_field('debt')!='') { ?> readonly value="<?php echo get_field('debt'); ?>" <?php } ?> />
                                    <!-- <span></span> -->
                                </p>
                                <p class="inputBlock inputNumber monneyDeposit" <?php if(get_field('deposit')!='') { ?> style="display:block;" <?php } ?>>
                                <input type="text" data-type="number" class="inputForm" id="deposit" name="deposit" placeholder="Số tiền cọc" />
                                <span></span>
                                </p>
                            </div>

                            <div class="inputBlock" id="radmethodPay">
                                <label class="labelReg" for="rad1">Tiền mặt</label>
                                <p class="inputBlock inputNumber">
                                    <input type="text" data-type="number" class="inputForm" name="cash_money" <?php if(get_field('process')=='yes') { ?><?php } ?> id="cash_money" placeholder="Số tiền mặt" value="<?php echo get_field('cash_money'); ?>" />
                                    
                                </p>
                                <label class="labelReg" for="rad2">Chuyển khoản</label>
                                <p class="inputBlock inputNumber">
                                    <input type="text" data-type="number" class="inputForm" name="bank_money" <?php if(get_field('process')=='yes') { ?><?php } ?> id="bank_money" placeholder="Số chuyển khoản" value="<?php echo get_field('bank_money'); ?>" />
                                    
                                </p>
                                <label class="labelReg" for="rad3">Visa/Master</label>
                                <p class="inputBlock inputNumber">
                                    <input type="text" data-type="number" class="inputForm" name="visa_money" <?php if(get_field('process')=='yes') { ?><?php } ?> id="visa_money" placeholder="Thanh toán visa" value="<?php echo get_field('visa_money'); ?>" />
                                    
                                </p>
                            </div>
                        </div> 

                    <table class="tblPage">
                        <tr>
                            <th>Số tiền thanh toán</th>
                            <td><p class="inputBlock"><input type="text" id="remain" name="remain" class="inputForm" readonly value="<?php if(get_field('remain')!='') { ?><?php echo get_field('remain'); ?><?php } ?>" /></p></td>
                        </tr>
                    </table>    
                
        
                    <input type="hidden" name="cusid_post" value="<?php echo get_field('cusid_post') ?>" >
                    <input type="hidden" name="idSurgery" value="<?php echo $_GET['idSurgery']; ?>" >
                    <input type="hidden" name="approve" value="<?php echo $_COOKIE['name_cookies']; ?>" >
                    <input type="hidden" name="status" value="quay" >
                    <input type="hidden" name="action" value="edit" >
                    <?php if(($_COOKIE['role_cookies']=='manager')||($_COOKIE['role_cookies']=='counter')) { ?>
                        <div class="flexBox flexBox--arround flexBox__form flexBox__form--2">
                            <input class="btnSubmit <?php if((get_field('accept')!='yes')||(get_field('process')=='yes')) { ?><?php } ?>"  type="submit" name="submit" value="Cập nhật">
                            <a href="<?php echo APP_URL; ?>print?idSurgery=<?php echo $id_sur; ?>" class="btnSubmit <?php if(get_field('accept')=='no') { ?>disable<?php } ?>">In phiếu thu</a>
                            <a href="<?php echo APP_URL; ?>data/editSurgery?action=cancel&idSurgery=<?php echo $id_sur; ?>" class="btnSubmit <?php if(get_field('accept')=='no') { ?>disable<?php } ?>">Huỷ</a>
                        </div>
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
</div>

<script>
$( function() {
    $('input[type=checkbox][name=accept]').change(function() {
        if($(this).val()=='yes') {
            $('.btnSubmit').removeClass('disable');
        } else {
            $('.btnSubmit').addClass('disable');
        }    
    });

    if($('input[name="accept"]').is(':checked')) {
        var totalPrice = $('#totalFee').val();
        $('#deposit').on('keyup', function(e){
                var deposit = $('#deposit').val();
                $('#remain').val(deposit);
            
        });
        $('#debt').on('keyup', function(e){
                var debt = $('#debt').val();
                var reMain = totalPrice - debt;
                $('#remain').val(reMain);
        });
        $('input[type=radio][name=statusPay]').change(function() {
            if (this.value == 'Thu đủ') {
                var totalPrice = $('#totalFee').val();
                $('#remain').val(totalPrice);
            }
        });
    }

    $('input[type=radio][name=statusPay]').change(function() {
        if (this.value == 'Đặt cọc') {
            $('.monneyDeposit').slideDown(200);
            $('.monneyNo').slideUp(200);
            $('#debt').val('');
        }
        if (this.value == 'Nợ') {
            $('.monneyDeposit').slideUp(200);
            $('.monneyNo').slideDown(200);
            $('#deposit').val('');
        }
    });

});
</script>      

</body>
</html>	