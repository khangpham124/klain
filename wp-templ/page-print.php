<?php /* Template Name: Print */ ?>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/app_config.php");
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
<div class="maxW__print">
<?php
$form = $_GET['form'];
$idSurgery = $_GET['idSurgery'];
$type = $_GET['type'];
if($form=='tvv') {
?>
<h2 class="h2_page_print">Phiếu thông tin khách hàng</h2>
<h3 class="h3_page">Thông tin cơ bản</h3>
<div class="flexBox flexBox--between flexBox__form flexBox__form--2">
<p class="inputBlock">
<input type="text" class="inputForm" name="fullname" id="fullname" value="<?php echo get_field('fullname',$idSurgery); ?>" placeholder="Họ tên" />
</p>
<?php if($_COOKIE['role_cookies']!='doctor') { ?>
<p class="inputBlock">
<input type="number" class="inputForm" name="mobile" id="mobile" id="mobile" value="<?php echo get_field('mobile',$idSurgery); ?>" placeholder="Số điện thoại" />
</p>
<?php } ?>
</div>    
<!-- phuong thu tu van -->
<h3 class="h3_page">Thông tin tư vấn</h3>
<p class="inputBlock">
<input type="text" class="inputForm" readonly value="<?php if(get_field('advise',$idSurgery)=='yes') {echo "Đã được tư vấn";} else {echo "Chưa được tư vấn";} ?>">
</p>
<div class="blockAdvise">
<h3 class="h5_page">Nhân viên tư vấn</h3>
<div class="flexBox flexBox--between flexBox__form flexBox__form--2">
<p class="inputBlock">
<input type="text" class="inputForm" readonly value="<?php echo get_field('adviser',$idSurgery); ?>">
</p>
<?php if(get_field('channel')!="") { ?>
<p class="inputBlock">
    <input type="text" class="inputForm" readonly value="<?php echo get_field('channel',$idSurgery); ?>">
</p>  
<?php } ?>
</div>
</div>
<!-- phuong thu tu van -->

<h3 class="h3_page">Thông tin dịch vụ thực hiện</h3>
<?php
$listService = get_field('services_list',$idSurgery);
foreach($listService as $serv) {
    echo '<p>'.$serv['name'].'</p>';
}   
?>
<h4 class="h4_page h4_page--services">Giảm giá</h4>
<p class="inputBlock inputNumber">
<input type="text" class="inputForm" readonly value="<?php echo number_format(get_field('sale_discount',$idSurgery)); ?>">
</p>
<!-- ADD SERVICES -->

<!-- DATE -->
<h3 class="h3_page">ngày phẫu thuật</h3>
<div class="flexBox flexBox--between flexBox__form flexBox__form--2 mt10">
<div class="inputBlock">
<input type="text" class="inputForm" value="<?php echo get_field('date',$idSurgery); ?>" placeholder="Chọn ngày phẫu thuật">

</div>
</div>
<!-- DATE -->          

<h4 class="h4_page">Lịch sử phẫu thuật : <?php if(get_field('hassurgery',$idSurgery)=="yes") { echo "Đã từng phẫu thuật"; } else { echo "Chưa từng phẫu thuật";} ?></h4>

<?php if(get_field('detail_history',$idSurgery)!="") { ?>
<div class="inputBlock">
<h3 class="h5_page">Chi tiết ca phẫu thuật trước</h3>
<div><?php echo get_field('detail_history',$idSurgery); ?></div>
</div>
<?php } ?>

<h4 class="h4_page">Tình trạng hiện tại</h4>
<div><?php echo get_field('self_status',$idSurgery); ?></div>
<h4 class="h4_page">Mong muốn của khách hàng</h4>
<div><?php echo get_field('target',$idSurgery); ?></div>


<h4 class="h4_page">Tư vấn</h4>
<div><?php echo get_field('doctor_advise',$idSurgery); ?></div>

<h4 class="h4_page">Ý kiến của khách hàng</h4>
<div><?php echo get_field('cus_note',$idSurgery); ?></div>

<input type="hidden" name="action" value="edit_info" >
</div>
<?php } ?>


<?php if(($form=='counter')&&($type=='')) { ?>
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
                <th colspan="2">Ngày <?php echo date("d") ?> Tháng <?php echo date("m") ?> Năm <?php echo date("Y") ?>                
                </th>
            </tr>

            <tr>
                <th>Họ tên người nộp tiền</th>
                <td><?php the_field('fullname'); ?> <p class="floatR">Mã KH:<?php echo get_field('idcustomer',get_field('cusid_post')); ?></p></td>
            </tr>

            <tr>
                <th>Số điện thoại</th>
                <td><?php the_field('mobile'); ?></td>
            </tr>
            <?php if(get_field('idcard',get_field('cusid_post'))!='') { ?>
                <tr>
                    <th>Số CMND</th>
                    <td><?php echo get_field('idcard',get_field('cusid_post')); ?></td>
                </tr>
            <?php } ?>
            <tr>
                <th>Địa chỉ</th>
                <td><?php echo get_field('address',get_field('cusid_post')); ?></td>
            </tr>

            <tr>
                <th>Dịch vụ thực hiện</th>
                <td>
                <?php
                $listService = get_field('services_list',$idSurgery);
                foreach($listService as $serv) {
                    echo '<p><strong>'.$serv['name'].'</strong></p>';
                }   
                ?>
                </td>
            </tr>
            <tr>
                <th>Số tỉền phải thanh toán</th>
                <td><?php echo number_format(get_field('total_final')); ?> VND</td>
            </tr>
            <?php if(get_field('sale_discount')!=0) { ?>
                <tr>
                    <th>Khuyến mãi</th>
                    <td><?php echo number_format(get_field('sale_discount')); ?> VND</td>
                </tr>
            <?php } ?>
            <tr>
                <th>Số tỉền đã thanh toán</th>
                <td><?php echo number_format(get_field('collect')); ?> VND</td>
            </tr>
            <tr>
                <th>Tình trạng thu</th>
                <td>
                    <?php if(get_field('deposit')!=0) { ?>
                    <h4 class="h4_page">Đặt cọc:<?php echo number_format(get_field('deposit')); ?> VND</h4>
                    <?php } ?>
                    <?php if(get_field('debt')!=0) { ?>
                    <h4 class="h4_page">Còn nợ: <?php echo number_format(get_field('debt')); ?> VND&nbsp;&nbsp;&nbsp;&nbsp;Người bảo lãnh: <?php echo get_field('guy'); ?></h4>
                    <?php } ?>

                    <?php if(get_field('cash_money')!=0) { ?>
                    <label class="labelReg" for="rad1">Tiền mặt</label>
                    <h4 class="h4_page"><?php echo number_format(get_field('cash_money')); ?> VND</h4>
                    <?php } ?>
                    <?php if(get_field('bank_money')!=0) { ?>
                    <h4 class="h4_page">Chuyển khoản: <?php echo number_format(get_field('bank_money')); ?>VND qua <?php echo get_field('chose_bank'); ?></h4>
                    <?php } ?>
                    <?php if(get_field('visa_money')!=0) { ?>
                    <label class="labelReg" for="rad3">Visa/Master</label>
                    <h4 class="h4_page"><?php echo number_format(get_field('visa_money')); ?> VND</h4>
                    <?php } ?>
                </td>
            </tr>
            <?php endwhile;endif; ?>  
        </table>    

        <div class="flexBox flexBox--between flexBox__form flexBox__form--3 txtPrint">
            <p class="inputBlock inputNumber"><strong>Giám đốc</strong><em>(Ký ,họ tên, đóng dấu)</em></p>
            <p class="inputBlock inputNumber"><strong>Người nộp tiền</strong><em>(Ký ,họ tên)</em></p>
            <p class="inputBlock inputNumber"><strong>Người lập phiếu</strong><em>(Ký ,họ tên, đóng dấu)</em></p>
        </div>        
    </div>
<?php } ?>


<?php if(($form=='counter')&&($type=='deposit')) { ?>
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
        <h2 class="h2_page_print">Phiếu cọc</h2>
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
                <th colspan="2">Ngày <?php echo date("d") ?> Tháng <?php echo date("m") ?> Năm <?php echo date("Y") ?>                
                </th>
            </tr>

            <tr>
                <th>Họ tên người nộp tiền</th>
                <td><?php the_field('fullname'); ?> <p class="floatR">Mã KH:<?php echo get_field('idcustomer',get_field('cusid_post')); ?></p></td>
            </tr>

            <tr>
                <th>Số điện thoại</th>
                <td><?php the_field('mobile'); ?></td>
            </tr>
            <?php if(get_field('idcard',get_field('cusid_post'))!='') { ?>
                <tr>
                    <th>Số CMND</th>
                    <td><?php echo get_field('idcard',get_field('cusid_post')); ?></td>
                </tr>
            <?php } ?>
            <tr>
                <th>Địa chỉ</th>
                <td><?php echo get_field('address',get_field('cusid_post')); ?></td>
            </tr>

            <tr>
                <th>Dịch vụ thực hiện</th>
                <td>
                <?php
                $listService = get_field('services_list',$idSurgery);
                foreach($listService as $serv) {
                    echo '<p><strong>'.$serv['name'].'</strong></p>';
                }   
                ?>
                </td>
            </tr>
            <tr>
                <th>Số tỉền phải thanh toán</th>
                <td><?php echo number_format(get_field('total_final')); ?> VND</td>
            </tr>
            <?php if(get_field('sale_discount')!=0) { ?>
                <tr>
                    <th>Khuyến mãi</th>
                    <td><?php echo number_format(get_field('sale_discount')); ?> VND</td>
                </tr>
            <?php } ?>
            <tr>
                <th>Số tỉền đã thanh toán</th>
                <td><?php echo number_format(get_field('collect')); ?> VND</td>
            </tr>
            <tr>
                <th>Tình trạng thu</th>
                <td>
                    <?php if(get_field('deposit')!=0) { ?>
                    <h4 class="h4_page">Đặt cọc: <?php echo number_format(get_field('deposit')); ?> VND</h4>
                    <h4 class="h4_page">Còn lại: <?php echo number_format(get_field('remain')); ?> VND</h4>
                    <?php } ?>
                    <?php if(get_field('debt')!=0) { ?>
                    <h4 class="h4_page">Còn nợ: <?php echo number_format(get_field('debt')); ?> VND&nbsp;&nbsp;&nbsp;&nbsp;Người bảo lãnh: <?php echo get_field('guy'); ?></h4>
                    <?php } ?>

                    <?php if(get_field('cash_money')!=0) { ?>
                    <label class="labelReg" for="rad1">Tiền mặt</label>
                    <h4 class="h4_page"><?php echo number_format(get_field('cash_money')); ?> VND</h4>
                    <?php } ?>
                    <?php if(get_field('bank_money')!=0) { ?>
                    <h4 class="h4_page">Chuyển khoản: <?php echo number_format(get_field('bank_money')); ?>VND qua <?php echo get_field('chose_bank'); ?></h4>
                    <?php } ?>
                    <?php if(get_field('visa_money')!=0) { ?>
                    <label class="labelReg" for="rad3">Visa/Master</label>
                    <h4 class="h4_page"><?php echo number_format(get_field('visa_money')); ?> VND</h4>
                    <?php } ?>
                </td>
            </tr>
            <?php endwhile;endif; ?>  
        </table>     

        <div class="flexBox flexBox--between flexBox__form flexBox__form--3 txtPrint">
            <p class="inputBlock inputNumber"><strong>Giám đốc</strong><em>(Ký ,họ tên, đóng dấu)</em></p>
            <p class="inputBlock inputNumber"><strong>Người nộp tiền</strong><em>(Ký ,họ tên)</em></p>
            <p class="inputBlock inputNumber"><strong>Người lập phiếu</strong><em>(Ký ,họ tên, đóng dấu)</em></p>
        </div>        
    </div>
<?php } ?>    
</div>
<!--Footer-->
<?php include(APP_PATH."libs/footer.php"); ?>
<!--/Footer-->
<!--===================================================-->
</div>
<!--/wrapper-->
<!--===================================================-->
  

</body>
</html>	