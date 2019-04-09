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
        <h2 class="h2_page">Danh sách chăm sóc khách hàng (ngày <?php echo $day; ?>/<?php echo $month; ?>/<?php echo $year; ?>)</h2>
        
            <table class="tblPage">
            <thead>
                <tr>
                    <td>Trạng thái</td>
                    <td>Ca</td>
                    <td>Họ tên khách hàng</td>
                    <td>Số điện thoại</td>
                    <td>Chi tiết</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $wp_query = new WP_Query();
                    $stt = $_GET['stt'];
                    if($stt=='') {
                        $param=array(
                        'post_type'=>'care',
                        'order' => 'DESC',
                        'posts_per_page' => '20',
                        );
                    } else {
                        $param=array(
                            'post_type'=>'surgery',
                            'order' => 'DESC',
                            'posts_per_page' => '20',
                            'meta_query'	=> array(
                                array(
                                    'key'	  	=> 'status',
                                    'value'	  	=> $stt,
                                    'compare' 	=> '=',
                                ),
                                )
                        );
                    }
                        
                    $wp_query->query($param);
                    if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                    $stt = get_field('status');
                ?>
                <tr <?php if($stt=='batdau') { ?> class="lock"<?php } ?> >
                <td>
                       
                    </td>
                    <td><?php the_title(); ?></td>
                    <td><?php the_field('fullname'); ?></td>
                    <td><?php the_field('mobile'); ?></td>
                    <?php if(($_COOKIE['role_cookies']=='manager')||($_COOKIE['role_cookies']=='boss')) { ?>
                                <td class="last">
                                <a href="<?php echo APP_URL; ?>form-counter/?idSurgery=<?php echo $post->ID; ?>" title="Quầy"><i class="fa fa-print" aria-hidden="true"></i></a>
                                <a href="<?php echo APP_URL; ?>doctor-confirm/?idSurgery=<?php echo $post->ID; ?>" title="Bác sĩ khám"><i class="fa fa-stethoscope" aria-hidden="true"></i></a>
                                <a href="<?php echo APP_URL; ?>ekip-surgery/?idSurgery=<?php echo $post->ID; ?>&idEkip=<?php echo $idEkip; ?>" title="Ca mổ"><i class="fa fa-heartbeat" aria-hidden="true"></i></a>
                                <a href="<?php the_permalink(); ?>" title="Chi tiết"><i class="fa fa-info-circle" aria-hidden="true"></i></a></td>
                                </td>        
                            <?php } ?>

                            <?php if($_COOKIE['role_cookies']=='counter') { ?>
                                <td class="last">
                                    <?php if($stt=='tvv') { ?>
                                    <a href="<?php echo APP_URL; ?>form-counter/?idSurgery=<?php echo $post->ID; ?>"><i class="fa fa-print" aria-hidden="true"></i></a>
                                    <?php } ?>
                                    <?php if($stt=='quay') { ?>
                                    <a href="<?php echo APP_URL; ?>print?idSurgery=<?php echo $id_sur; ?>&form=counter" class="btnPrint <?php if(get_field('accept')=='no') { ?>disable<?php } ?>">In phiếu thu</a>
                                    <?php } ?>
                                    <a href="<?php the_permalink(); ?>" title="Chi tiết"><i class="fa fa-info-circle" aria-hidden="true"></i></a></td>
                                </td>
                            <?php } ?>

                            <?php if(($_COOKIE['role_cookies']=='tvv')||($_COOKIE['role_cookies']=='sale')) { ?>
                            <td class="last">
                                <a href="<?php echo APP_URL; ?>print?idSurgery=<?php echo $post->ID; ?>&form=tvv"><i class="fa fa-print" aria-hidden="true"></i></a>
                                <a href="<?php the_permalink(); ?>" title="Chi tiết"><i class="fa fa-info-circle" aria-hidden="true"></i></a></td>
                            </td>
                            <?php } ?>
                            
                            <?php if($_COOKIE['role_cookies']=='doctor') { ?>
                                <?php if($stt=='pending') { ?>
                                <td class="last"><a href="<?php the_permalink(); ?>" title="Chi tiết"><i class="fa fa-info-circle" aria-hidden="true"></i></a></td></td>
                                <?php } else { ?>
                                <td class="last"><a href="<?php echo APP_URL; ?>doctor-confirm/?idSurgery=<?php echo $post->ID; ?>"><i class="fa fa-stethoscope" aria-hidden="true"></i></a></td>
                                <?php } ?>
                            <?php } ?>

                            <?php if($_COOKIE['role_cookies']=='room') { 
                            ?>
                            <?php if(($stt=='bsk')||($stt=='bsnk')||($stt=='batdau')) { ?>
                                <td class="last">
                                    <?php if($stt=='batdau') { ?>
                                        <a href="<?php echo APP_URL; ?>data/changeStt.php?idSurgery=<?php echo $post->ID; ?>&change=phauthuat" title="Hoàn tất"><i class="fa fa-check-circle" aria-hidden="true"></i></a>
                                        <a href="<?php the_permalink(); ?>" title="Chi tiết"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                                    <?php } else { ?>
                                        <a href="<?php echo APP_URL; ?>ekip-surgery/?idSurgery=<?php echo $post->ID; ?>"><i class="fa fa-heartbeat" aria-hidden="true"></i></a>
                                    <?php } ?>    
                                </td>
                            <?php } else { ?>
                                <td class="last"><a href="<?php echo APP_URL; ?>after-surgery/?idSurgery=<?php echo $post->ID; ?>"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a></td>
                            <?php } ?>

                            <?php } ?>

                            <?php if($_COOKIE['role_cookies']=='customer-care') { ?>
                                <td class="last"> <a href="<?php the_permalink(); ?>" title="Chi tiết"><i class="fa fa-info-circle" aria-hidden="true"></i></a></td></td>
                            <?php } ?>
                </tr>
                <?php endwhile;endif; ?>
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