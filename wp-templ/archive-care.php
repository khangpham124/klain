<?php
include($_SERVER["DOCUMENT_ROOT"] . "/app_config.php");
if(!$_COOKIE['login_cookies']) {    
	header('Location:'.APP_URL.'login');
}
if(($_COOKIE['role_cookies']=='doctor')) {
    header('Location:'.APP_URL);
}

include(APP_PATH."libs/head.php"); 
$dateGet = $_GET['date'];
$day =  substr($dateGet, 0,2);
$month =  substr($dateGet, 2,2);
$year =  substr($dateGet, 4,4);
?>
</head>

<body id="surgery">

<div class="flexBox flexBox--between flexBox--wrap">
<?php include(APP_PATH."libs/sidebar.php"); ?>
<div id="wrapper">
<!--===================================================-->
<!--Header-->
<?php include(APP_PATH."libs/header.php"); ?>
<!--/Header-->

<div class="textBox">
<div class="blockPage blockPage--full maxW">
    <h2 class="h2_page">Danh sách chăm sóc khách hàng <?php if($dateGet!='') { ?> (ngày <?php echo $day; ?>/<?php echo $month; ?>/<?php echo $year; ?>)<?php } ?></h2>    
            <table class="tblPage">
            <thead>
                <tr>
                    <td>Ca</td>
                    <td>Họ tên khách hàng</td>
                    <td>Số điện thoại</td>
                    <td>Chi tiết</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $wp_query = new WP_Query();
                    if($dateGet=='') {
                        $param=array(
                        'post_type'=>'care',
                        'order' => 'DESC',
                        'posts_per_page' => '20',
                        );
                        $wp_query->query($param);
                    if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post(); 
                ?>
                    <tr>
                        <td></td>
                        <td><?php the_title(); ?></td>
                        <td><?php the_field('fullname'); ?></td>
                        <td><?php the_field('mobile'); ?></td>
                        <td class="last">
                            <a href="<?php echo APP_URL; ?>form-counter/?idSurgery=<?php echo $post->ID; ?>" title="Quầy"><i class="fa fa-print" aria-hidden="true"></i></a>
                            <a href="<?php echo APP_URL; ?>doctor-confirm/?idSurgery=<?php echo $post->ID; ?>" title="Bác sĩ khám"><i class="fa fa-stethoscope" aria-hidden="true"></i></a>
                            <a href="<?php echo APP_URL; ?>ekip-surgery/?idSurgery=<?php echo $post->ID; ?>&idEkip=<?php echo $idEkip; ?>" title="Ca mổ"><i class="fa fa-heartbeat" aria-hidden="true"></i></a>
                            <a href="<?php the_permalink(); ?>" title="Chi tiết"><i class="fa fa-info-circle" aria-hidden="true"></i></a></td>
                        </td>
                    </tr>
                <?php endwhile;endif; ?>
                <?php } else {
                        $dateCare = $day.'/'.$month.'/'.$year;
                        $param = array(
                            'posts_per_page' => '20',
                            'post_type'		=> 'care',
                        );
                    $wp_query->query($param);
                    if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post(); 
                    $remind = array();
                ?>
                <?php
                    $test = get_field('listcare',$post->ID);
                    foreach($test as $exp) {
                        $remind[]=date('d/m/Y', $exp['expire']);
                    }
                    if (($find = array_search($dateCare, $remind)) !== false) {
                ?>
                    <tr>
                        <td><?php the_title(); 
                        $title = explode('-',$post->post_title);
                        $sur = get_page_by_title($title[1], OBJECT, 'surgery');
                        $surgeryID = $sur->ID;
                        ?></td>
                        <td><?php echo get_field('fullname',$surgeryID); ?></td>
                        <td><?php echo get_field('mobile',$surgeryID); ?></td>
                        <td class="last">
                            <a href="<?php echo get_permalink($surgeryID); ?>?tab=5" title="Chi tiết"><i class="fa fa-info-circle" aria-hidden="true"></i></a></td>
                        </td>
                    </tr>
                <?php } ?>
                <?php endwhile;endif; ?>
                <?php } ?>
            </tbody>
        </table>
        <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
    </div>
</div>

<!--Footer-->
<?php include(APP_PATH."libs/footer.php"); ?>
<!--/Footer-->

</div>
<!--/wrapper-->
</div>


</body>
</html>	