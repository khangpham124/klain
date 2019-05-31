<?php /* Template Name: Add Surgery */ ?>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/app_config.php");
// include(APP_PATH."libs/checklog.php");
if(!$_COOKIE['login_cookies']) {    
	header('Location:'.APP_URL.'login');
}
if(get_post_status($post->ID)!="publish") {    
    header('Location:'.APP_URL.'surgery');
}
include(APP_PATH."libs/head.php");
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link type="text/css" rel="stylesheet" href="<?php echo APP_URL; ?>common/css/magnific-popup.css" />
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
        <h2 class="h2_page flexBox flexBox--between">Thông tin Ca phẫu thuật <a onclick="myFunction()" data-link="<?php echo APP_URL; ?>data/removePost.php?idSurgery=<?php echo $post->ID; ?>&page=surgery"class="removeItem btnPage btnPage--red">Xóa hồ sơ</a></h2>

         <ul class="tabItem tabItem--6 flexBox flexBox--center flexBox--wrap">
            <li><a href="javascript:void(0)"  data-id="tab1">Thông tin ban đầu</a></li>
            <?php if(($_COOKIE['role_cookies']!='doctor')&&($_COOKIE['role_cookies']!='room')) { ?>
            <li><a href="javascript:void(0)"  data-id="tab2">Tình trạng thanh toán</a></li>
            <?php } ?>
            <li><a href="javascript:void(0)"  data-id="tab3">Bác sĩ khám</a></li>
            <li><a href="javascript:void(0)"  data-id="tab4">Chi tiết ca phẫu thuật</a></li>
            <li><a href="javascript:void(0)"  data-id="tab5">Chăm sóc hậu phẫu</a></li>
            <li><a href="javascript:void(0)"  data-id="tab6">Hình ảnh</a></li>
        </ul>

        <div class="tabContent">
            <div class="tabBox" id="tab1">
                <form action="<?php echo APP_URL; ?>data/editSurgery.php" method="post" enctype="multipart/form-data">
                <h3 class="h3_page">Thông tin cơ bản
                </h3>
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
                <?php
                    $rows = get_field('timeline',get_field('cusid_post'));
                    $lastCount = count($rows);
                    $last_adv = $lastCount - 1;
                    $first_row = $rows[$last_adv];
                ?>
                <h3 class="h5_page">Nhân viên tư vấn</h3>
                <p class="inputBlock">
                    <input type="text" class="inputForm" readonly value="<?php echo get_field('adviser'); ?>">
                </p>
                <?php if(get_field('channel')!="") { ?>
                    <p class="inputBlock">
                        <input type="text" class="inputForm" readonly value="<?php echo get_field('channel'); ?>">
                    </p>  
                <?php } ?>

                <h3 class="h5_page mt30">Tư vấn của tư vấn viên</h3>
                <textarea class="inputForm mb30" name="advise_f" readonly placeholder=""><?php echo $first_row['content']; ?></textarea>
                <h3 class="h5_page">Tư vấn của Bác sĩ</h3>
                <?php if(get_field('doctor_advise')!='') { ?>
                <div class="mb30"><?php echo get_field('doctor_advise'); ?></div>
                <?php } else { ?>
                <textarea class="inputForm" name="doctor_advise" <?php if(($_COOKIE['role_cookies']!='doctor')&&($_COOKIE['role_cookies']!='bsk')) { ?>readonly<?php } ?>  id="doctor_advise"></textarea>
                <?php } ?>

                <!-- phuong thu tu van -->

                <h3 class="h3_page">Thông tin dịch vụ thực hiện</h3>
                    <div class="mb30">
                        <?php
                            $listService = get_field('services_list');
                        ?>
                        <?php 
                        foreach($listService as $serv) {
                            echo '<p>'.$serv['name'].'</p>';
                        }
                        ?>
                        <?php if(($_COOKIE['role_cookies']!='doctor')&&($_COOKIE['role_cookies']!='room')) { ?>
                        <h4 class="h4_page h4_page--services">Giảm giá</h4>
                        <p class="inputBlock inputNumber">
                            <input type="text" class="inputForm" readonly value="<?php echo number_format(get_field('sale_discount')); ?>">
                        </p>
                        <?php } ?>
                    </div>
                <!-- ADD SERVICES -->

                <!-- DATE -->
                <h3 class="h3_page">ngày phẫu thuật</h3>
                <div class="flexBox flexBox--between flexBox__form flexBox__form--2 mt10">
                    <div class="inputBlock">
                        <input type="text" class="inputForm" value="<?php echo get_field('date'); ?>" placeholder="Chọn ngày phẫu thuật">
                    </div>
                </div>
                <!-- DATE -->          

                <h4 class="h4_page">Lịch sử phẫu thuật : <?php if(get_field('hassurgery')=="yes") { echo "Đã từng phẫu thuật"; } else { echo "Chưa từng phẫu thuật";} ?></h4>
                
                <?php if(get_field('detail_history')!="") { ?>
                <div class="inputBlock">
                    <h3 class="h5_page">Chi tiết ca phẫu thuật trước</h3>
                    <div><?php echo get_field('detail_history'); ?></div>
                </div>
                <?php } ?>

                <h4 class="h4_page">Tình trạng hiện tại</h4>
                <div><?php echo get_field('self_status'); ?></div>
                <h4 class="h4_page">Mong muốn của khách hàng</h4>
                <div><?php echo get_field('target'); ?></div>


                <h4 class="h4_page">Ý kiến của khách hàng</h4>
                <div><?php echo get_field('cus_note'); ?></div>

                    <input type="hidden" name="action" value="edit_info" >
                    <input type="hidden" name="name_edit" value="<?php echo $_COOKIE['name_cookies']; ?>" >
                    <input type="hidden" name="idSurgery" value="<?php echo $post->ID; ?>" >
                    <input type="hidden" name="url" value="<?php echo $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" >
                    <div class="flexBox flexBox--C">
                        <input class="btnSubmit" type="submit" name="submit" value="Cập nhật">
                        <?php if(($_COOKIE['role_cookies']=='doctor')||($_COOKIE['role_cookies']=='bsk')) { ?>
                            <input type="hidden" name="status" value="tvv" >        
                        <?php } ?>
                        <a href="<?php echo APP_URL; ?>print?idSurgery=<?php echo $post->ID; ?>&form=tvv" class="btnSubmit">In</a>
                    </div>
                </form>
            </div>
                <!-- het tabl1 -->


                <div class="tabBox" id="tab2">
                    <?php if(get_field('status')!='pending') { ?>
                    <h3 class="h3_page">Tình trạng thanh toán : <?php the_field('payment_status'); ?></h3>
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
                                    <input type="text" class="inputForm" name="show_total" id="show_total" value="<?php echo number_format(get_field('total')); ?>" />
                                </td>
                            </tr>
                            <tr>
                                <th>Giảm giá</th>
                                <td><input type="text" class="inputForm" name="sale_discount" id="sale_discount" readonly value="<?php echo number_format(get_field('sale_discount')); ?>" /></td>
                            </tr>
                            <tr>
                                <th colspan="3">
                                <p class="inputBlock<?php if(($_COOKIE['role_cookies']!='manager')) { ?> readOnly <?php } ?>">
                                    <input type="checkbox" class="chkForm"<?php if(get_field('accept')!="") { ?> checked <?php } ?> id="accept" name="accept" value="yes" />
                                    <label class="labelReg" for="accept">Giảm giá được chấp nhận</label>
                                </p>
                                
                                <?php if(get_field('accept')!="") { ?>
                                Duyệt bởi : <?php echo get_field('approve'); ?>
                                <?php } ?>
                                
                                </th>
                            </tr>
                            <tr>
                            <th>Tổng tiền sau điều chỉnh</th>
                                <td>
                                    <p class="inputBlock">
                                    <input type="text" id="totalFee" name="totalFee" class="inputForm" readonly value="<?php echo number_format(get_field('total')); ?>" />
                                    </p>
                                </td>
                            </tr>
                        </table>

            
                        <h4 class="h4_page">Phương thức thanh toán</h4>
                            <table class="tblPage <?php if(($_COOKIE['role_cookies']!='manager')&&($_COOKIE['role_cookies']!='counter')) { ?>lockCheck<?php } ?>">
                            <tr>
                                <td><input type="radio" class="radioForm" id="rad4" name="statusPay" <?php if(get_field('payment_status')=='Thu đủ') { ?>checked<?php } ?> value="Thu đủ" /><label class="labelReg" for="rad4">Thu đủ</label><br></td>
                                <td><input type="radio" class="radioForm" id="rad5" name="statusPay" <?php if(get_field('payment_status')=='Đặt cọc') { ?>checked<?php } ?> value="Đặt cọc" /><label class="labelReg" for="rad5">Đặt cọc</label><br>
                                <p class="inputBlock inputNumber monneyDeposit" <?php if(get_field('deposit')!='') { ?> style="display:block;" <?php } ?>>
                                <input type="text" data-type="number" class="inputForm" value="<?php echo number_format(get_field('deposit'));  ?>" id="deposit" name="deposit" placeholder="Số tiền cọc" />
                                <span></span>
                                </p>
                                </td>
                                <td><input type="radio" class="radioForm" id="rad6" name="statusPay" value="Nợ" <?php if(get_field('payment_status')=='Nợ') { ?>checked<?php } ?> /><label class="labelReg" for="rad6">Nợ</label><br>
                                <p class="inputBlock inputNumber monneyNo" <?php if(get_field('debt')!='') { ?> style="display:block;" <?php } ?>>
                                <input type="text" data-type="number" class="inputForm" id="debt" name="debt" placeholder="Còn nợ" <?php if(get_field('debt')!='') { ?> readonly value="<?php echo number_format(get_field('debt')); ?>" <?php } ?> />
                                </p>
                                </td>
                            </tr>
                        </table>

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

                        <?php if((get_field('debt')>0)&&(get_field('debter')=='yes')&&($_COOKIE['role_cookies']=='counter')) { ?>            
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
                            <td><p class="inputBlock"><input type="text" id="remain" name="remain" class="inputForm" readonly value="<?php if(get_field('collect')!='') { ?><?php echo number_format(get_field('collect')); ?><?php } ?>" /></p></td>
                        </tr>
                    </table>

                    <table class="tblPage">
                        <tr>
                            <th>Số tiền còn lại cần thanh toán</th>
                            <td><p class="inputBlock"><input type="text" id="remain_depo" name="remain_depo" class="inputForm" readonly value="<?php if(get_field('remain')!='') { ?><?php echo number_format(get_field('remain')); ?><?php } ?>" /></p></td>
                        </tr>
                    </table>

                    <?php if((get_field('payment_status')=='Nợ')&&(($_COOKIE['role_cookies']=='counter')||($_COOKIE['role_cookies']=='manager'))) { ?>   
                    <h3 class="h3_page">Thanh toán nợ</h3>
                    <form action="<?php echo APP_URL; ?>data/editSurgery.php" method="post" enctype="multipart/form-data">
                        <table class="tblPage">
                            <tr>
                                <th>Số tiền thanh toán</th>
                                <td><p class="inputBlock"><input type="text" id="debt_paid" name="debt_paid" class="inputForm" value="" /></p></td>
                            </tr>
                            <tr>
                                <th>Ngày thanh toán</th>
                                <td>
                                    <p class="inputBlock">
                                    <input type="text" class="inputForm" id="datechose" name="debt_date" readonly value="<?php echo date('d/m/Y'); ?>">
                                    </p>
                                </td>
                            </tr>
                        </table>
                    <?php } ?>

                    <?php if((get_field('payment_status')=='Đặt cọc')&&(($_COOKIE['role_cookies']=='counter')||($_COOKIE['role_cookies']=='manager'))) { ?>   
                    <h3 class="h3_page">Thanh toán tiền phần còn lại</h3>
                    <form action="<?php echo APP_URL; ?>data/editSurgery.php" method="post" enctype="multipart/form-data">
                        <table class="tblPage">
                            <tr>
                                <th>Số tiền thanh toán</th>
                                <td><p class="inputBlock"><input type="text" id="debt_paid" name="debt_paid" class="inputForm" value="" /></p></td>
                            </tr>
                            <tr>
                                <th>Ngày thanh toán</th>
                                <td>
                                    <p class="inputBlock">
                                    <input type="text" class="inputForm" id="datechose" name="debt_date" readonly value="<?php echo date('d/m/Y'); ?>">
                                    </p>
                                </td>
                            </tr>
                        </table>
                    <?php } ?>

                    <h4 class="h4_page">Lịch sử thanh toán</h4>
                    <table class="tblPage">
                        <tr>
                            <td>Số tiền thanh toán</td>
                            <td>Ngày thanh toán</td>
                            <td>Người thu</td>
                        </tr>
                        <?php while(has_sub_field('treepay')) { ?>
                        <tr>
                            <td><?php echo number_format(get_sub_field('money')); ?></td>
                            <td><?php echo get_sub_field('date'); ?></td>
                            <td><?php echo get_sub_field('name'); ?></td>
                        </tr>
                        <?php } ?>
                    </table>

                    <div class="flexBox flexBox--C">
                    <?php if((get_field('payment_status')=='Nợ')&&(($_COOKIE['role_cookies']=='counter')||($_COOKIE['role_cookies']=='manager'))) { ?>   
                        <input type="hidden" name="action" value="paidDebt" >
                        <input type="hidden" name="idSurgery" value="<?php echo $post->ID; ?>" >
                        <input type="hidden" name="debt_get" value="<?php echo $_COOKIE['name_cookies']; ?>" >
                        <input type="hidden" name="url" value="<?php echo $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" >
                        <input class="btnSubmit" type="submit" name="submit" value="Thanh toán nợ">
                    </form>    
                    <?php } ?>

                    <?php if((get_field('payment_status')=='Đặt cọc')&&(($_COOKIE['role_cookies']=='counter')||($_COOKIE['role_cookies']=='manager'))) { ?>   
                        <input type="hidden" name="action" value="paidDebt" >
                        <input type="hidden" name="idSurgery" value="<?php echo $post->ID; ?>" >
                        <input type="hidden" name="debt_get" value="<?php echo $_COOKIE['name_cookies']; ?>" >
                        <input type="hidden" name="url" value="<?php echo $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" >
                        <input class="btnSubmit" type="submit" name="submit" value="Thanh toán tiếp">
                    </form>    
                    <?php } ?>

                        <a href="<?php echo APP_URL; ?>print?idSurgery=<?php echo $post->ID; ?>&form=counter" class="btnSubmit">In</a>
                    </div>
                    <?php } ?>
                </div>



                <div class="tabBox doctorPart" id="tab3">
                    <?php 
                    $listService = get_field('services_list');

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
                    <?php if(get_field('bks')!='') { ?>    
                        <h4 class="h4_page">Bác sĩ Khải</h4>
                        <div>
                            <?php the_field('bsk'); ?>
                        </div>
                    <?php } ?>
                    <?php endwhile;endif; ?>
                    <?php } ?>
                    <?php wp_reset_query(); ?>
                </div>


                <div class="tabBox" id="tab4">
                    <?php 
                    foreach($listService as $serv) {
                        $ekip = $serv['ekip'];
                        if($ekip!='') {
                            $wp_query = new WP_Query();
                            $param = array (
                                'posts_per_page' => '1',
                                'post_type' => 'ekip',
                                'post_status' => 'publish',
                                'order' => 'DESC',
                                's'=>$ekip
                            );
                            $wp_query->query($param);
                            if($wp_query->have_posts()): while($wp_query->have_posts()) :$wp_query->the_post();
                            ?>
                            <h3 class="h3_page"><?php echo $serv['name']; ?></h3>
                            <table class="tblPage">
                                <tr>
                                    <th>Phòng mổ</th>
                                    <td><?php echo get_field('room'); ?></td>
                                </tr>
                                <?php if(get_field('doctor1')!='') { ?>
                                <tr>
                                    <th>Bác sĩ 1</th>
                                    <td><?php the_field('doctor1'); ?></td>
                                </tr>
                                <?php } ?>

                                <?php if(get_field('doctor2')!=''){ ?>
                                <tr>
                                    <th>Bác sĩ 1</th>
                                    <td><?php the_field('doctor2'); ?></td>
                                </tr>
                                <?php } ?>

                                <?php if(get_field('nursing_team')!=''){ ?>
                                <tr>
                                    <th>Danh sách điều dưỡng</th>
                                    <td>
                                        <?php the_field('nursing_team'); ?>
                                    </td>
                                </tr>
                                <?php } ?>
                                <?php if(get_field('ktv')!=''){ ?>
                                <tr>
                                    <th>Gây mê</th>
                                    <td><?php the_field('ktv'); ?></td>
                                </tr>
                                <?php } ?>
                                <?php if(get_field('input')!=''){ ?>
                                <tr>
                                    <th>Nhập thông tin</th>
                                    <td><strong><?php the_field('input'); ?></strong></td>
                                </tr>
                                <?php } ?>
                            </table>
                            <?php endwhile;endif; ?>
                            
                            <?php wp_reset_query(); ?>
                            <h4 class="h4_page">Tường trình ca mổ</h4>
                            <div class="inputBlock reportBlock mb30">
                                <?php echo $serv['report']; ?>
                            </div>
                        <?php } ?>    
                    <?php } ?>
                </div>
            <div class="tabBox" id="tab5">
                <table class="tblPage">
                    <tr>
                        <td>Dịch vụ</td>
                        <td>Tình trang</td>
                        <td>Ngày phẫu thuật xong</td>
                        <td>Số lần Chăm sóc</td>
                        <td>Thao tác</td>
                    </tr>
                <?php 
                    foreach($listService as $serv) {
                        $careId_arr = get_page_by_title( $serv['care'], '', 'care' );
                        $careId = $careId_arr->ID;
                        $listCare = get_field('listcare',$careId);
                        $count_care = array();
                        foreach($listCare as $care) {
                            if($care['care']=='care') {
                                $count_care[] = $care['care'];
                            }
                        }
                        
                        $numb_count_care = count($count_care);
                ?>

                    <tr>
                        <td><?php echo $serv['name'] ?></td>
                        <td><?php if($serv['do']=='yes') { ?>Hoàn tất<?php } else { ?>Chưa hoàn tất<?php } ?></td>
                        <td><?php echo $serv['end'] ?></td>
                        <td><?php echo $numb_count_care; ?></td>
                        <td><?php if($serv['do']=='yes') { ?><a href="<?php echo APP_URL ?>detail-care?id=<?php echo $serv['care']; ?>"><i class="fa fa-comments" aria-hidden="true"></i></a><?php } ?></td>
                    </tr>
                <?php } ?>
                </table>
            </div>

            <div class="tabBox" id="tab6">
                <form action="<?php echo APP_URL; ?>data/editSurgery.php" method="post" enctype="multipart/form-data">
                    <?php 
                        $s=0;
                        foreach($listService as $serv) {
                        $args = array("post_type" => "services", "s" => $serv['name']);
                        $query = get_posts( $args );
                        foreach ($query as $querys ) {
                            $ids = $querys->ID;
                        }
                    ?>
                        <div class="imgBox">
                            <h3 class="h3_page"><?php echo $serv['name']; ?></h3>
                            
                            <h4 class="h4_page">Trước</h4>
                            <?php
                                $listImage = explode(',',$serv['image_before']);
                                unset($listImage[count($listImage)-1]);
                                $avai_img = count($listImage);
                                $numb_image = get_field('numb_image',$ids);
                                $remain_img = $numb_image - $avai_img;
                                for($i=0;$i<$remain_img;$i++) { 
                            ?>
                                <input type="file" name="file<?php echo $i ?><?php echo $s; ?>_before" id="file<?php echo $i ?><?php echo $s; ?>_before" >
                                <?php } ?>
                            
                            <!-- Box IMAGE     -->
                            <ul class="lstImge flexBox flexBox--wrap flexBox--start">
                                <?php 
                                $listImage = explode(',',$serv['image_before']);
                                unset($listImage[count($listImage)-1]);
                                foreach ($listImage as $img ) {
                                ?>
                                <li><a href="<?php echo APP_IMG; ?>surgery/<?php the_title(); ?>/<?php echo $img; ?>" title="" rel="lightbox-cats"><img src="<?php echo APP_IMG; ?>surgery/<?php the_title(); ?>/<?php echo $img; ?>"></a></li>
                                <?php } ?>
                            </ul> 

                            <h4 class="h4_page">Sau</h4>
                            <?php
                                $listImage = explode(',',$serv['image_after']);
                                unset($listImage[count($listImage)-1]);
                                $avai_img = count($listImage);
                                $numb_image = get_field('numb_image',$ids);
                                $remain_img = $numb_image - $avai_img;
                                for($i=0;$i<$remain_img;$i++) { 
                            ?>
                                <input type="file" name="file<?php echo $i ?><?php echo $s; ?>_after" id="file<?php echo $i ?><?php echo $s; ?>_after" >
                                <?php } ?>
                            
                            <!-- Box IMAGE     -->
                            <ul class="lstImge flexBox flexBox--wrap flexBox--start">
                                <?php 
                                $listImage = explode(',',$serv['image_after']);
                                unset($listImage[count($listImage)-1]);
                                foreach ($listImage as $img ) {
                                ?>
                                <li><a href="<?php echo APP_IMG; ?>surgery/<?php the_title(); ?>/<?php echo $img; ?>" title="" rel="lightbox-cats"><img src="<?php echo APP_IMG; ?>surgery/<?php the_title(); ?>/<?php echo $img; ?>"></a></li>
                                <?php } ?>
                            </ul> 
                            
                        
                        </div>
                        <?php $s++; ?>
                    <?php } ?>
                    <input type="hidden" name="action" value="edit_info" >
                    <input type="hidden" name="idSurgery" value="<?php echo $post->ID; ?>" >
                    <input type="hidden" name="upload" value="upload" >
                    <input type="hidden" name="url" value="<?php echo $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" >
                    <input class="btnSubmit btnUpload" type="submit" name="submit" value="Tải lên">
                </form>
            </div>
            <!-- <button onclick="window.print();return false;" class="btnSubmit">In</button> -->
    </div>
</div>

</div>
<!--Footer-->
<?php include(APP_PATH."libs/footer.php"); ?>
<!--/Footer-->


</div>
<!--/wrapper-->
</div>
<script type="text/javascript" src="<?php echo APP_URL; ?>common/js/jquery.magnific-popup.js"></script>
 <script type="text/javascript">
    <?php $tab = $_GET['tab'];
    if(!$tab) {
    ?>
    $('#tab1').show();
    $('.tabItem li:nth-child(1)').addClass('active');
    <?php } else { ?>
    $('#tab<?php echo $tab; ?>').show();
    $('.tabItem li:nth-child(<?php echo $tab; ?>)').addClass('active');
    <?php } ?>

    $('.tabItem li').click(function() {
        $('.tabItem li').removeClass('active');
        $(this).toggleClass('active');
        var tabId = $(this).find('a').attr('data-id');
        $('.tabBox').fadeOut(200);
        $('#'+tabId).fadeIn(200);
    });

	    $(function() {
	    	$('.lstImge').magnificPopup({
			  	delegate: 'a',
				type: 'image',
				tLoading: 'Loading image #%curr%...',
				mainClass: 'mfp-img-mobile',
				gallery: {
					enabled: true,
					navigateByImgClick: true,

					preload: [0,1]

				},
                zoom: {
				enabled: true, // By default it's false, so don't forget to enable it
			 	duration: 300, // duration of the effect, in milliseconds

                    easing: 'ease-in-out', // CSS transition easing function 
                    opener: function(openerElement) {
return openerElement.is('img') ? openerElement : openerElement.find('img');
                    }
                },

				image: {
					tError: '<a href="%url%">cannot load image</a>.',

					titleSrc: 'title'

				}

			});
	    });
</script>

<script>
$( function() {
    if($('#accept').is(':checked')) {
            var totalPrice = $('#hide_tt_final').val();
            
            $('input[type=radio][name=statusPay]').change(function() {
                    var totalPrice = $('#totalFee').val();
                    $('#remain').val(totalPrice);
            });
            
            $('#deposit').on('keyup', function(e){
                    var deposit = $('#deposit').val();
                    var remain_depo = totalPrice - deposit;
                    $('#remain').val(numberWithCommas(deposit));
                    $('#remain_depo').val(numberWithCommas(remain_depo));
                
            });
            $('#debt').live('focusout', function(){
                    var debt = $('#debt').val();
                    var reMain = totalPrice - debt;
                    $('#remain').val(numberWithCommas(reMain));
                    $('#remain_depo').val(numberWithCommas(debt));
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
                var remain_depo = totalPrice - deposit;
                $('#remain').val(numberWithCommas(deposit));
                $('#remain_depo').val(numberWithCommas(remain_depo));
                
            });
            $('#debt').live('focusout', function(){
                    var debt = $('#debt').val();
                    var reMain = totalPrice - debt;
                    $('#remain').val(numberWithCommas(reMain));
                    $('#remain_depo').val(numberWithCommas(debt));
            });
        }
    });

    $('input[type=radio][name=statusPay]').change(function() {
        if (this.value == 'Đặt cọc') {
            $('.monneyDeposit').slideDown(200);
            $('.monneyNo').slideUp(200);
            $('#listGuy').slideUp(200);
            $('#debt').val(0);
            $('#remain_depo').val(0);
        }
        if (this.value == 'Nợ') {
            $('.monneyDeposit').slideUp(200);
            $('.monneyNo').slideDown(200);
            $('#listGuy').slideDown(200);
            $('#deposit').val(0);
            $('#remain_depo').val(0);
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

    function myFunction() {
        confirm("Xoá hồ sơ đã chọn?");
    }

    $(".removeItem").click(function(){
        if(confirm("Xoá hồ sơ đã chọn?")){
            var url = $(this).attr('data-link');
            window.location = url;
        }
        else{
            return false;
        }
    });
});
</script>


</body>
</html>	