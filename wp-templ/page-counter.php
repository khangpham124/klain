<?php /* Template Name: Form Counter */ ?>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/app_config.php");
// include(APP_PATH."libs/checklog.php");
$id_sur = $_GET['idSurgery'];
if(!$_COOKIE['login_cookies']) {    
	header('Location:'.APP_URL.'login');
}
if((($_COOKIE['role_cookies']!='manager')&&($_COOKIE['role_cookies']!='boss')&&($_COOKIE['role_cookies']!='counter'))||(get_field('status',$id_sur)=="quay")) {
    header('Location:'.APP_URL);
}
include(APP_PATH."libs/head.php"); 
?>
<link type="text/css" rel="stylesheet" href="<?php echo APP_URL; ?>checkform/exvalidation.css" />
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
        <form autocomplete="off" action="<?php echo APP_URL; ?>data/editSurgery.php" method="post" enctype="multipart/form-data" id="formCounter">
            <h2 class="h2_page">Tạo phiếu thu</h2>
                <?php
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
                    <input type="text" class="inputForm" name="fullname" placeholder="Họ tên" value="<?php echo get_the_title($cusId_post); ?>" />
                    </p>
                    <p class="inputBlock">
                    <input type="text" class="inputForm" name="mobile" placeholder="Mobile" value="<?php echo get_field('mobile',$cusId_post); ?>" />
                    </p>
                </div>

                <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                    <p class="inputBlock">
                    <input type="text" class="inputForm" name="address" placeholder="Địa chỉ" value="<?php echo get_field('address',$cusId_post); ?>" />
                    </p>
                    <p class="inputBlock">
                    <input type="text" class="inputForm" name="idcard" placeholder="CMND" value="<?php echo get_field('idcard',$cusId_post); ?>" />
                    </p>
                </div>

                <h4 class="h4_page">Ngày tháng năm sinh</h4>
                <div class="flexBox flexBox--between flexBox__form flexBox__form--3 mb30">
                    <?php
                        $birth = explode('/',get_field('birthday',$cusId_post));
                    ?>
                    <p class="inputBlock customSelect">
                        <select id="day" name="day">
                            <option value="">Ngày</option>
                            <?php for($i=1;$i<=31;$i++) { ?>
                            <option <?php if($i==$birth[0]) { ?>selected<?php } ?> value="<?php echo $i ?>"><?php echo $i ?></option>
                            <?php } ?>
                        </select>
                    </p>
                    <p class="inputBlock customSelect">    
                        <select id="month" name="month">
                            <option value="">Tháng</option>
                            <?php for($i=1;$i<=12;$i++) { ?>
                            <option <?php if($i==$birth[1]) { ?>selected<?php } ?> value="<?php echo $i ?>"><?php echo $i ?></option>
                            <?php } ?>
                        </select>
                        </p>
                    <p class="inputBlock customSelect">    
                        <select id="year" name="year">
                            <option value="">Năm sinh</option>
                            <?php for($i=1940;$i<=2019;$i++) { ?>
                            <option <?php if($i==$birth[2]) { ?>selected<?php } ?> value="<?php echo $i ?>"><?php echo $i ?></option>
                            <?php } ?>
                        </select>
                    </p>
                </div>

                    <div class="flexBox flexBox--between flexBox__form flexBox__form--2 mb10">
                    <p class="inputBlock"><img src="<?php echo get_field('ic_front',$cusId_post); ?>"></p>
                    <p class="inputBlock"><img src="<?php echo get_field('ic_back',$cusId_post); ?>"></p>
                    </div>

                    <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                        <input type="file" name="file1" id="file1" aria-label="Mặt trước chứng minh">
                        <input type="file" name="file2" id="file2" aria-label="Mặt sau chứng minh">
                    </div>
                    
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
                                <td><input type="text" data-type="number" <?php if(get_field('accept')!='') { ?> readOnly <?php } ?> class="inputForm" name="sale_discount" id="sale_discount"  <?php if(($_COOKIE['role_cookies']!='manager')&&($_COOKIE['role_cookies']!='counter')) { ?> readonly <?php } ?> value="<?php echo get_field('sale_discount'); ?>" /></td>
                            </tr>
                            <tr>
                                <th colspan="3">
                                <p class="inputBlock<?php if(($_COOKIE['role_cookies']!='manager')) { ?> readOnly <?php } ?>">
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
                                        $check = "";
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
                                if($total_discount==0) {
                                    $check = "checked";
                                }
                                ?>
                                    <input type="checkbox" class="chkForm" <?php echo $check; ?> <?php if(get_field('accept')!='') { ?> checked <?php } ?> id="accept" name="accept" value="yes" />
                                    <label class="labelReg" for="accept">Giảm giá được chấp nhận</label>
                                </p>
                                    <p class="inputBlock<?php if($_COOKIE['role_cookies']!='manager') { ?> readOnly <?php } ?>">
                                    <?php if(get_field('accept')!='') { ?>
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

                        <div class="hidePart" <?php if(get_field('accept')!='') { ?>style="display:block"<?php } ?>>            
                        <h4 class="h4_page">Phương thức thanh toán</h4>
                        <table class="tblPage">
                            <tr class="chkradio" id="chkradio">
                                <td class="col1"><input type="radio" class="radioForm" id="rad4" name="statusPay" <?php if(get_field('payment_status')=='Thu đủ') { ?>checked<?php } ?> value="Thu đủ" /><label class="labelReg" for="rad4">Thu đủ</label><br></td>
                                <td class="col2"><input type="radio" class="radioForm" id="rad5" name="statusPay" <?php if(get_field('deposit')!='') { ?> checked <?php } ?> value="Đặt cọc" /><label class="labelReg" for="rad5">Đặt cọc</label><br>
                                <p class="inputBlock inputNumber monneyDeposit" <?php if(get_field('deposit')!='') { ?> style="display:block;" <?php } ?>>
                                    <input type="text"  class="inputForm" id="deposit" name="deposit" value="<?php echo get_field('deposit') ?>" placeholder="Số tiền cọc" />
                                </p>
                                </td>
                                <td class="col3">
                                    <input type="radio" class="radioForm" id="rad6" name="statusPay" value="Nợ" <?php if(get_field('debt')!='') { ?> checked <?php } ?> /><label class="labelReg" for="rad6">Nợ</label><br>
                                    <p class="inputBlock inputNumber monneyNo" <?php if(get_field('debt')!='') { ?> style="display:block;" <?php } ?>>
                                    <input type="text" class="inputForm" id="debt" name="debt" placeholder="Còn nợ" <?php if(get_field('debt')!='') { ?> readonly value="<?php echo get_field('debt'); ?>" <?php } ?> /></p>
                                    <div id="listGuy" <?php if(get_field('debt')!='') { ?>style="display:block;"<?php } ?>>
                                            <p class="inputBlock customSelect <?php if(get_field('debt')!='') { ?> disable <?php } ?>">
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
                                                        <option <?php if(get_field('guy')==get_field('fullname',$sale->ID)) { ?>selected<?php } ?> value="<?php echo get_field('fullname',$sale->ID); ?>"><?php echo get_field('fullname',$sale->ID); ?></option>
                                                    <?php } ?>
                                                </select>
                                            </p>
                                            <p class="inputBlock<?php if($_COOKIE['role_cookies']!='manager') { ?> readOnly <?php } ?> mt10">
                                                <input type="checkbox" class="chkForm" <?php if(get_field('debter')!='') { ?> checked <?php } ?> id="debter" name="debter" value="yes" />
                                                <label class="labelReg" for="debter">Người bảo lãnh được chấp nhận</label>
                                            </p>
                                        <?php if(get_field('debter')=='yes') { ?>Duyệt bởi : <?php echo get_field('approve2'); ?><?php } ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <div class="inputBlock" id="radstatusPay">
                        </div>

                        <div class="flexBox flexBox--between flexBox__form flexBox__form--3">
                            <div class="inputBlock">    
                                <label class="labelReg" for="rad1">Tiền mặt</label>
                                <p class="inputNumber">
                                    <input type="text"  class="inputForm moneyInput" name="cash_money" <?php if(get_field('process')=='yes') { ?><?php } ?> id="cash_money" placeholder="Số tiền mặt" value="<?php echo get_field('cash_money'); ?>" />
                                </p>
                            </div>

                            <div class="inputBlock">
                                <label class="labelReg" for="rad2">Chuyển khoản</label>
                                <p class="inputNumber">
                                    <input type="text"  class="inputForm moneyInput" name="bank_money" <?php if(get_field('process')=='yes') { ?><?php } ?> id="bank_money" placeholder="Số chuyển khoản" value="<?php echo get_field('bank_money'); ?>" />
                                </p>
                            </div>
                            <div class="inputBlock">
                                <label class="labelReg" for="rad3">Visa/Master</label>
                                <p class="inputNumber">
                                    <input type="text"  class="inputForm moneyInput" name="visa_money" <?php if(get_field('process')=='yes') { ?><?php } ?> id="visa_money" placeholder="Thanh toán visa" value="<?php echo get_field('visa_money'); ?>" />

                                </p>
                            </div>
                        </div> 

                        <div id="listBank">
                            <input type="radio" class="radioForm" id="rad_bank1" <?php if(get_field('chose_bank')=='Vietcombank') { ?>checked <?php } ?> name="nameBank" value="Vietcombank" /><label class="labelReg" for="rad_bank1">Vietcombank</label><br>
                            <input type="radio" class="radioForm" id="rad_bank2" <?php if(get_field('chose_bank')=='VietinBank') { ?>checked <?php } ?> name="nameBank" value="VietinBank" /><label class="labelReg" for="rad_bank2">VietinBank</label><br>
                            <input type="radio" class="radioForm" id="rad_bank3" <?php if(get_field('chose_bank')=='Eximbank') { ?>checked <?php } ?> name="nameBank" value="Eximbank" /><label class="labelReg" for="rad_bank3">Eximbank</label><br>
                        </div>
                        
                    <table class="tblPage">
                        <tr>
                            <th>Số tiền thanh toán</th>
                            <td><p class="inputBlock"><input type="text" id="collect" name="collect" class="inputForm" readonly value="<?php if(get_field('collect')!='') { ?><?php echo get_field('collect'); ?><?php } ?>" /></p></td>
                        </tr>
                    </table>

                    <table class="tblPage">
                        <tr>
                            <th>Số tiền còn lại cần thanh toán</th>
                            <td><p class="inputBlock"><input type="text" id="remain" name="remain" class="inputForm" readonly value="<?php if(get_field('remain')!='') { ?><?php echo get_field('remain'); ?><?php } ?>" /></p></td>
                        </tr>
                    </table>
                    </div>
                
        
                    <input type="hidden" name="cusid_post" value="<?php echo get_field('cusid_post') ?>" >
                    <input type="hidden" name="idSurgery" value="<?php echo $_GET['idSurgery']; ?>" >
                    <input type="hidden" name="approve" value="<?php echo $_COOKIE['name_cookies']; ?>" >
                    <input type="hidden" name="counter" value="<?php echo $_COOKIE['name_cookies']; ?>" >
                    <input type="hidden" name="datePaid" value="<?php echo date('d/m/Y'); ?>" >
                    <input type="hidden" name="url" value="<?php echo $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" >
                    <input type="hidden" name="timeRegis" value="register" >
                    
                    <?php if($_COOKIE['role_cookies']=='manager') { ?>
                        <input type="hidden" name="status" value="tvv" >
                        <input type="hidden" name="action" value="edit" >
                    <?php } else { ?>
                        <input type="hidden" id="statusDynamic" name="status" value="quay" >
                    <?php } ?>
                    <input type="hidden" id="actionDynamic" name="action" value="edit" >

                    <?php if((($_COOKIE['role_cookies']=='manager')||($_COOKIE['role_cookies']=='counter'))) { ?>
                        <div class="flexBox flexBox--C mt30">
                            <input class="btnSubmit" <?php if($_COOKIE['role_cookies']=='counter') { ?>id="btnSubmit"<?php } ?> type="submit" name="submit" value="Cập nhật">
                            <a href="<?php echo APP_URL; ?>data/changeStt.php?idSurgery=<?php echo $post->ID; ?>&change=huy" class="btnSubmit" title="Hoàn tất">Huỷ</a>
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

<script type="text/javascript" src="<?php echo APP_URL; ?>checkform/exvalidation.js"></script>
<script type="text/javascript" src="<?php echo APP_URL; ?>checkform/exchecker-ja.js"></script>
<script>
<?php if($_COOKIE['role_cookies']!='manager') { ?>
    $(function(){
        $("#formCounter").exValidation({
            rules: {
                guy: "chkselect",
                debt:"chkrequired",
                deposit:"chkrequired",
                accept:"chkcheckbox",
                cash_money:"chkrequired",
                bank_money:"chkrequired",
                visa_money:"chkrequired",
            },
            stepValidation: true,
            scrollToErr: true,
            errHoverHide: true
        });
        $('#guy').removeClass('chkselect errPosRight err');
        $('#debt').removeClass('chkrequired errPosRight');
        $('#deposit').removeClass('chkrequired errPosRight');
    });
    $('.btnSubmit').addClass('disable');
<?php } ?>

$( function() {
    $('.moneyInput').on('focusout', function(e){
        if($('#cash_money').val()!='') {
            var cash_money = parseInt($('#cash_money').val());
        } else {
            cash_money = 0;
        }
        if($('#bank_money').val()!='') {
            var bank_money = parseInt($('#bank_money').val());
        } else {
            bank_money = 0;
        }
        if($('#visa_money').val()!='') {
            var visa_money = parseInt($('#visa_money').val());
        } else {
            visa_money = 0;
        }
        if(($(this).val()!='')||($(this).val()!=0)) {
            $('.moneyInput').removeClass('chkrequired errPosRight');
            $('.btnSubmit').addClass('loadPage');
        } else {
            $('.moneyInput').addClass('chkrequired errPosRight');
            $('.btnSubmit').removeClass('loadPage');
        }
        var collect = $('#collect').val();
        var money_must = collect;
        var money_sum = cash_money + bank_money + visa_money;
        if(numberWithCommas(money_sum) == money_must) {
            $('#btnSubmit').removeClass('disable');
        } else {
            $('#btnSubmit').addClass('disable');
        }
    });

    $('#sale_discount').live('focusout', function(){
        var tt_templ = $('#hide_total').val();
        var discount = $(this).val();
        var remain = parseInt(tt_templ) - parseInt(discount);
        $('#hide_tt_final').val(remain);
        $('#totalFee').val(numberWithCommas(remain));
    });

    if($('#accept').is(':checked')) {
            $('#accept').removeClass('chkcheckbox errPosRight err');
            var totalPrice = $('#hide_tt_final').val();
            $('input[type=radio][name=statusPay]').change(function() {
                    var totalPrice = $('#totalFee').val();
                    $('#collect').val(totalPrice);
            });
            
            $('#deposit').on('keyup', function(e){
                    var deposit = $('#deposit').val();
                    var remain_depo = totalPrice - deposit;
                    $('#collect').val(numberWithCommas(deposit));
                    $('#remain').val(numberWithCommas(remain_depo));
                
            });
            $('#debt').live('focusout', function(){
                    var debt = $('#debt').val();
                    var reMain = totalPrice - debt;
                    $('#collect').val(numberWithCommas(reMain));
                    $('#remain').val(numberWithCommas(debt));
            });
        } else {
            $('#accept').addClass('chkcheckbox errPosRight err');
        }


    $('input[type=checkbox][name=accept]').change(function() {
        if($('#accept').is(':checked')) {
            var totalPrice = $('#hide_tt_final').val();
            $(this).removeClass('chkcheckbox errPosRight err');
            $('input[type=radio][name=statusPay]').change(function() {
                    var totalPrice = $('#totalFee').val();
                    $('#collect').val(totalPrice);
            });
            
            $('#deposit').on('keyup', function(e){
                var deposit = $('#deposit').val();
                var remain_depo = totalPrice - deposit;
                $('#collect').val(numberWithCommas(deposit));
                $('#remain').val(numberWithCommas(remain_depo));
                
            });
            $('#debt').live('focusout', function(){
                    var debt = $('#debt').val();
                    var reMain = totalPrice - debt;
                    $('#collect').val(numberWithCommas(reMain));
                    $('#remain').val(numberWithCommas(debt));
            });
        }
    });
    
    $('input[type=radio][name=statusPay]').change(function() {
        if (this.value == 'Đặt cọc') {
            $('.monneyDeposit').slideDown(200);
            $('.monneyNo').slideUp(200);
            $('#listGuy').slideUp(200);
            $('#debt').val(0);
            $('#remain').val(0);
            $('#guy').removeClass('chkselect errPosRight err');
            $('#debt').removeClass('chkrequired errPosRight');
            $('#deposit').addClass('chkrequired errPosRight');
        } else {
            $('#deposit').removeClass('chkrequired errPosRight');
        }
        if (this.value == 'Nợ') {
            $('.monneyDeposit').slideUp(200);
            $('.monneyNo').slideDown(200);
            $('#listGuy').slideDown(200);
            $('#deposit').val(0);
            $('#remain').val(0);
            $('#guy').addClass('chkselect errPosRight err');
            $('#debt').addClass('chkrequired errPosRight');
            if($('#debter').is(':checked')) {
                $('#statusDynamic').val('quay');
                $('#actionDynamic').val('edit');
                $('#btnSubmit').val('CẬP NHẬT');
                $('#btnSubmit').addClass('disable');
                $('.moneyInput').addClass('chkrequired errPosRight');
            } else {
                $('#statusDynamic').val('mngpending');
                $('#actionDynamic').val('wait_mng');
                $('#btnSubmit').val('CHỜ DUYỆT');
                $('#btnSubmit').removeClass('disable');
                $('.moneyInput').removeClass('chkrequired errPosRight');
            }
        } else {
            $('#guy').removeClass('chkselect errPosRight err');
            $('#debt').removeClass('chkrequired errPosRight');
            $('#statusDynamic').val('quay');
            $('#actionDynamic').val('edit');
            $('#btnSubmit').val('CẬP NHẬT');
            $('#btnSubmit').addClass('disable');
            $('.moneyInput').addClass('chkrequired errPosRight');
        }
    });
    
    $('input[type=text][name=bank_money]').keyup(function() {
        if (this.value != '') {
            $('#listBank').slideDown(200);
        } else {
            $('#listBank').slideUp(200);
        }
    });

    $('#sale_discount').live('focusout', function(){
        var lim1 = 30000000;
        var lim2 = 49000000;
        var lim3 = 50000000;
        var lim4 = 79000000;
        var lim5 = 80000000;
        var lim6 = 99000000;
        var lim7 = 100000000;
        var total_price = parseInt($('#hide_total').val());
        var total_discount = parseInt($(this).val());
        if((total_price >= lim1)&&(total_price <= lim2)) {
            if(total_discount <= 1000000) {
                $('#accept').prop( "checked", true );
            } else {
                $('#accept').prop( "checked", false );
            }
        }
        if((total_price >= lim3)&&(total_price <= lim4)) {
            if(total_discount <= 2000000) {
                $('#accept').prop( "checked", true );
            } else {
                $('#accept').prop( "checked", false );
            }
        }
        if((total_price >= lim5)&&(total_price <= lim6)) {
            if(total_discount <= 3000000) {
                $('#accept').prop( "checked", true );
            } else {
                $('#accept').prop( "checked", false );
            }
        }
        if(total_price >= lim7) {
            if(total_discount <= 5000000) {
                $('#accept').prop( "checked", true );
            } else {
                $('#accept').prop( "checked", false );
            }
        }
        if(total_discount==0) {
            $('#accept').prop( "checked", true );
        }

        if($('#accept').is(':checked')) {
            var totalPrice = $('#hide_tt_final').val();
            $('input[type=radio][name=statusPay]').change(function() {
                    var totalPrice = $('#totalFee').val();
                    $('#collect').val(totalPrice);
            });
            
            $('#deposit').on('keyup', function(e){
                var deposit = $('#deposit').val();
                var remain_depo = totalPrice - deposit;
                $('#collect').val(numberWithCommas(deposit));
                $('#remain').val(numberWithCommas(remain_depo));
                
            });
            $('#debt').live('focusout', function(){
                    var debt = $('#debt').val();
                    var reMain = totalPrice - debt;
                    $('#collect').val(numberWithCommas(reMain));
                    $('#remain').val(numberWithCommas(debt));
            });
        }
    });

    if($('#accept').is(':checked')) {
        var totalPrice = $('#hide_tt_final').val();
        if($('#rad6').is(':checked')) {
            var debt = $('#debt').val();
            var reMain = totalPrice - debt;
            $('#collect').val(numberWithCommas(reMain));
            $('#remain').val(numberWithCommas(debt));
        }
        $('.hidePart').slideDown(200);
    } else {
        $('.hidePart').slideUp(200);
    }
    
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