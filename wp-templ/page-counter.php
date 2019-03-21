<?php /* Template Name: Form Counter */ ?>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/projects/klain/app_config.php");
// include(APP_PATH."libs/checklog.php");
if(!$_COOKIE['login_cookies']) {    
	header('Location:'.APP_URL.'login');
}
if(($_COOKIE['role_cookies']=='doctor')) {
    header('Location:'.APP_URL);
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
                    'posts_per_page' => '1',
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

                    <h4 class="h4_page">Thông tin dịch vụ</h4>
                        <table class="tblPage">
                            <tr>
                                <th>
                                    Tóm tắt dịch vụ
                                </th>
                                    <td>
                                    <?php
                                        $listService = get_field('services_list');
                                    ?>
                                    <h5 class="h5_page">Dịch vụ yêu cầu</h5>
                                    <?php 
                                    foreach($listService as $serv) {
                                        echo '<p>'.$serv['name'].'</p>';
                                    }
                                    ?>
                                    <h5 class="h5_page">Tổng tiền</h5>
                                    <input type="text" class="inputForm" readonly name="show_total" id="show_total" value="<?php echo number_format(get_field('total')); ?>" />
                                    <input type="hidden" class="inputForm" name="hide_total" id="hide_total" value="<?php echo get_field('total'); ?>" />
                                </td>
                            </tr>
                            <tr>
                                <th>Giảm giá</th>
                                <td><input type="text" class="inputForm" name="sale_discount" id="sale_discount"  <?php if(($_COOKIE['role_cookies']!='manager')&&($_COOKIE['role_cookies']!='counter')) { ?> readonly <?php } ?> value="<?php echo get_field('sale_discount'); ?>" /></td>
                            </tr>
                            <tr>
                                <th colspan="3">
                                <p class="inputBlock<?php if(($_COOKIE['role_cookies']!='manager')&&($_COOKIE['role_cookies']!='counter')) { ?> readOnly <?php } ?>">
                                <?php
                                $discount = get_field('sale_discount');
                                $total_price = get_field('total');
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
                                    <input type="checkbox" class="chkForm" <?php echo $check; ?> <?php if(get_field('accept')=='yes') { ?> checked <?php } ?> id="accept" name="accept" value="yes" />
                                    <label class="labelReg" for="accept">Giảm giá được chấp nhận</label>
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
                            <th>Tổng tiền sau điều chỉnh</th>
                                <td>
                                    <p class="inputBlock">
                                    <input type="text" id="totalFee" name="totalFee" class="inputForm" readonly value="<?php echo number_format($total_remain); ?>" />
                                    <input type="hidden" id="hide_tt_final" name="hide_tt_final" class="inputForm" readonly value="<?php echo $total_remain; ?>" />
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
                                    <input type="text" class="inputForm" id="deposit" name="deposit" placeholder="Số tiền cọc" />
                                </p>
                                </td>
                                <td><input type="radio" class="radioForm" id="rad6" name="statusPay" value="Nợ" <?php if(get_field('debt')!='') { ?> checked <?php } ?> /><label class="labelReg" for="rad6">Nợ</label><br>
                                <p class="inputBlock inputNumber monneyNo" <?php if(get_field('debt')!='') { ?> style="display:block;" <?php } ?>>
                                <input type="text" class="inputForm" id="debt" name="debt" placeholder="Còn nợ" <?php if(get_field('debt')!='') { ?> readonly value="<?php echo get_field('debt'); ?>" <?php } ?> />
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
                                    <input type="text" data-type="number" class="inputForm" name="cash_money" <?php if(get_field('process')=='yes') { ?><?php } ?> id="cash_money" placeholder="Số tiền mặt" value="<?php echo get_field('cash_money'); ?>" />
                                </p>
                            </div>

                            <div class="inputBlock">
                                <label class="labelReg" for="rad2">Chuyển khoản</label>
                                <p class="inputNumber">
                                    <input type="text" data-type="number" class="inputForm" name="bank_money" <?php if(get_field('process')=='yes') { ?><?php } ?> id="bank_money" placeholder="Số chuyển khoản" value="<?php echo get_field('bank_money'); ?>" />
                                </p>
                            </div>
                            <div class="inputBlock">
                                <label class="labelReg" for="rad3">Visa/Master</label>
                                <p class="inputNumber">
                                    <input type="text" data-type="number" class="inputForm" name="visa_money" <?php if(get_field('process')=='yes') { ?><?php } ?> id="visa_money" placeholder="Thanh toán visa" value="<?php echo get_field('visa_money'); ?>" />

                                </p>
                            </div>
                        </div> 

                        <div id="listBank">
                            <input type="radio" class="radioForm" id="rad_bank1" <?php if(get_field('chose_bank')=='Vietcombank') { ?>checked <?php } ?> name="nameBank" value="Vietcombank" /><label class="labelReg" for="rad_bank1">Vietcombank</label>
                            <input type="radio" class="radioForm" id="rad_bank2" <?php if(get_field('chose_bank')=='VietinBank') { ?>checked <?php } ?> name="nameBank" value="VietinBank" /><label class="labelReg" for="rad_bank2">VietinBank</label>
                            <input type="radio" class="radioForm" id="rad_bank3" <?php if(get_field('chose_bank')=='Eximbank') { ?>checked <?php } ?> name="nameBank" value="Eximbank" /><label class="labelReg" for="rad_bank3">Eximbank</label>
                        </div>
                        
                        
                        <div id="listGuy">
                            <p class="inputBlock customSelect">
                                <select name="guy" id="guy">
                                    <option value="">Người bảo lãnh</option>
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
                                            'terms' => 'sale'
                                            ),
                                            array(
                                                'taxonomy' => 'userscat',
                                                'field' => 'slug',
                                                'terms' => 'adviser'
                                            ),
                                        )
                                        );
                                        $posts_array = get_posts( $param );
                                        foreach ($posts_array as $sale ) {
                                    ?>
                                        <option value="<?php echo get_field('fullname',$sale->ID); ?>"><?php echo get_field('fullname',$sale->ID); ?></option>
                                    <?php } ?>
                                </select>
                            </p>
                            <p class="inputBlock<?php if(($_COOKIE['role_cookies']!='manager')&&($_COOKIE['role_cookies']!='counter')) { ?> readOnly <?php } ?>">
                            <input type="checkbox" class="chkForm" <?php if(get_field('debter')=='yes') { ?> checked <?php } ?> id="debter" name="debter" value="yes" />
                            <label class="labelReg" for="debter">Người bảo lãnh được chấp nhận</label>
                            </p>
                            <?php if(get_field('debter')=='yes') { ?>Duyệt bởi : <?php echo get_field('approve2'); ?><?php } ?>
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
                            <a href="javascript:void(0)" class="btnSubmit callPopup">Cập nhật</a>
                            <a href="<?php echo APP_URL; ?>data/changeStt.php?idSurgery=<?php echo $post->ID; ?>&change=huy" class="btnSubmit" title="Hoàn tất">Huỷ</a>
                        </div>
                    <?php } ?>   
                    <div class="popUp">
                        <p class="txtNote">Vui lòng kiểm tra lại thông tin chính xác,vì thông tin khi nhập vào sẽ ko thể thay đổi được nữa</p>
                        <div class="flexBox flexBox--arround flexBox__form--2">
                        <input class="btnSubmit" type="submit" name="submit" value="Cập nhật">
                        <a href="javascript:void(0)" class="btnSubmit cancel">Quay lại</a>
                        </div>
                    </div> 
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
    // $('.callPopup').addClass('disable');
    // $('input[type=checkbox][name=accept]').change(function() {
    //     if($(this).val()=='yes') {
    //         $('.callPopup').removeClass('disable');
    //     } else {
    //         $('.callPopup').addClass('disable');
    //     }    
    // });

    $('#sale_discount').live('focusout', function(){
        var tt_templ = $('#hide_total').val();
        var discount = $(this).val();
        var remain = parseInt(tt_templ) - parseInt(discount);
        $('#hide_tt_final').val(remain);
        $('#totalFee').val(numberWithCommas(remain));
    });

    if($('#accept').is(':checked')) {
            var totalPrice = $('#hide_tt_final').val();
            
            $('input[type=radio][name=statusPay]').change(function() {
                    var totalPrice = $('#totalFee').val();
                    $('#remain').val(totalPrice);
            });
            
            $('#deposit').on('keyup', function(e){
                    var deposit = $('#deposit').val();
                    $('#remain').val(numberWithCommas(deposit));
                
            });
            $('#debt').live('focusout', function(){
                    var debt = $('#debt').val();
                    var reMain = totalPrice - debt;
                    $('#remain').val(numberWithCommas(reMain));
            });
        }

    $('input[type=checkbox][name=accept]').change(function() {
        if($('#accept').is(':checked')) {
            var totalPrice = $('#hide_tt_final').val();
            
            $('input[type=radio][name=statusPay]').change(function() {
                    var totalPrice = $('#totalFee').val();
                    $('#remain').val(totalPrice);
            });
            
            $('#deposit').on('keyup', function(e){
                    var deposit = $('#deposit').val();
                    $('#remain').val(deposit);
                
            });
            $('#debt').live('focusout', function(){
                    var debt = $('#debt').val();
                    var reMain = totalPrice - debt;
                    $('#remain').val(numberWithCommas(reMain));
            });
        }
    });

    $('input[type=radio][name=statusPay]').change(function() {
        if (this.value == 'Đặt cọc') {
            $('.monneyDeposit').slideDown(200);
            $('.monneyNo').slideUp(200);
            $('#listGuy').slideUp(200);
            $('#debt').text('');
        }
        if (this.value == 'Nợ') {
            $('.monneyDeposit').slideUp(200);
            $('.monneyNo').slideDown(200);
            $('#listGuy').slideDown(200);
            $('#deposit').text('');
        }
    });

    $('input[type=text][name=bank_money]').keyup(function() {
        if (this.value != '') {
            $('#listBank').slideDown(200);
        } else {
            $('#listBank').slideUp(200);
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

    $('.cancel').click(function() {
        $('.overlay').fadeOut(200);
        $('.popUp').fadeOut(200);
    });
});
</script>     

<div class="overlay"></div>


</body>
</html>	