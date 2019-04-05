<?php
include($_SERVER["DOCUMENT_ROOT"] . "/app_config.php");
if(!$_COOKIE['login_cookies']) {    
	header('Location:'.APP_URL.'login');
}
if(($_COOKIE['role_cookies']=='doctor')) {
    header('Location:'.APP_URL);
}

include(APP_PATH."libs/head.php"); 
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
            <h2 class="h2_page">Danh sách hồ sơ khách hàng</h2>
            <div class="buttonBar">
            <p class="inputBlock customSelect">
                <select id="selectBox">
                    <option value="">Tình trạng Hồ sơ</option>
                    <option value="<?php echo APP_URL ?>surgery?stt=tvv">Khâu Tư vấn viên</option>
                    <option value="<?php echo APP_URL ?>surgery?stt=pending">Khâu Chờ khám</option>
                    <option value="<?php echo APP_URL ?>surgery?stt=quay">Khâu Quầy</option>
                    <option value="<?php echo APP_URL ?>surgery?stt=bsnk">Khâu Bác sĩ ngoại khoa</option>
                    <option value="<?php echo APP_URL ?>surgery?stt=bsk">Khâu Bác sĩ Khải</option>
                    <option value="<?php echo APP_URL ?>surgery?stt=batdau">Khâu Đang mổ</option>
                    <option value="<?php echo APP_URL ?>surgery?stt=phauthuat">Khâu Phẫu thuật Xong</option>
                    <option value="<?php echo APP_URL ?>surgery?stt=hauphau">Khâu Hậu phẫu</option>
                    <option value="<?php echo APP_URL ?>surgery?stt=cshp">Khâu Đang CSHP</option>
                    <option value="<?php echo APP_URL ?>surgery?stt=huy">Đã huỷ</option>
                    <option value="<?php echo APP_URL ?>surgery/">Tất cả</option>
                </select>
            </p>
        </div>
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
                        'post_type'=>'surgery',
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
                        <?php
                        $stt = get_field('status');
                        switch ($stt) {
                            case "tvv":
                                $stt_text = "Tư vấn viên";
                            break;
                            case "pending":
                                $stt_text = "Chờ khám";
                            break;
                            case "quay":
                                $stt_text = "Quầy";
                            break;
                            case "bsnk":
                                $stt_text = "Bác sĩ ngoại khoa";
                            break;
                            case "bsk":
                                $stt_text = "Bác sĩ Khải";
                            break;
                            case "batdau":
                                $stt_text = "Đang mổ";
                            break;
                            case "phauthuat":
                                $stt_text = "Phẫu thuật";
                            break;
                            case "hauphau":
                                $stt_text = "Hậu phẫu";
                            break;
                            case "cshp":
                                $stt_text = "CSHP";
                            break;
                            case "huy":
                                $stt_text = "Đã Huỷ";
                            break;
                        }
                        ?>
                        <?php if($stt=='batdau') { ?>
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        <?php } ?>
                        <span class="noteColor note--<?php echo $stt ?>"></span>
                        <em><?php echo $stt_text ?></em>
                        <?php if(get_field('debt')!='') { ?>
                        <span class="noteRemind noteRemind--1">Còn nợ</span>
                        <?php } ?>
                        
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
                                    <a href="<?php echo APP_URL; ?>form-counter/?idSurgery=<?php echo $post->ID; ?>"><i class="fa fa-print" aria-hidden="true"></i></a>
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

<script>
    $(function(){
      // bind change event to select
      $('#selectBox').on('change', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
    });
</script>

</body>
</html>	