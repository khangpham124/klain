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
            <p>Trung tam tham my Klain</p>
            <img src="<?php echo APP_URL; ?>common/img/header/logo.png" alt="">
        </div>
        <h2 class="h2_page">Phiếu thu</h2>
        <p>Ngay <?php echo date("d") ?>Thang <?php echo date("m") ?>Nam <?php echo date("Y") ?></p>
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
            <p>Họ tên người nộp tiền: <?php the_field('fullname'); ?></p>
            <p>Mã KH: <?php the_field(''); ?> Số điện thoại:<?php the_field('mobile'); ?></p>
            <p>Địa chỉ: <?php the_field('fullname'); ?> Số CMND:<?php the_field('fullname'); ?></p>
            <p>Dịch vụ: <?php the_field('fullname'); ?> </p>
            <p>Tình trạng thu: <?php the_field('payment_status'); ?> Số tiên cọc:<?php the_field('fullname'); ?></p>
            <p>So tien: <?php echo  $_POST['totalFee']; ?></p>
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
    // $(window).load(function() {
    //     window.print();
    // });
});
</script>      

</body>
</html>	