<?php /* Template Name: Ekip Surgery */ ?>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/projects/klain/app_config.php");
// include(APP_PATH."libs/checklog.php");
if(!$_COOKIE['login_cookies']) {    
	header('Location:'.APP_URL.'login');
}
include(APP_PATH."libs/head.php"); 
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link type="text/css" rel="stylesheet" href="<?php echo APP_URL; ?>checkform/exvalidation.css" />
<style type="text/css">
    #datepicker {
        display: none;
    }
</style>
</head>

<body id="top">
<!--===================================================-->
<div id="wrapper">
<!--===================================================-->
<!--Header-->
<?php include(APP_PATH."libs/header.php"); ?>
<!--/Header-->

<div class="flexBox flexBox--between textBox flexBox--wrap maxW">
    <div class="blockPage blockPage--full">
        <h2 class="h2_page">Thông tin Ekip mổ</h2>
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
            <h3 class="h3_page">Thông tin khách hàng</h3>
            <div class="flexBox flexBox--between flexBox__form flexBox__form--3">
                <p class="inputBlock">
                <input type="text" class="inputForm" name="fullname" placeholder="Họ tên" readonly value="<?php the_field('fullname'); ?>" />
                </p>
                <p class="inputBlock">
                <input type="text" class="inputForm" name="idcard" placeholder="Só CMND" readonly value="<?php the_field('idcard'); ?>" />
                </p>
                <p class="inputBlock">
                <input type="text" class="inputForm" name="mobile" placeholder="Mobile" readonly value="<?php the_field('mobile'); ?>" />
                </p>
            </div>

            <h4 class="h4_page">Dịch vụ yêu cầu</h4>
                <p class="inputBlock">
                    <input type="text" class="inputForm" readonly value="<?php the_field('services'); ?>" />
                </p>
            
            <h4 class="h4_page">Hồ sơ bệnh án và tư vấn của bác sĩ</h4>        


            <?php endwhile;endif; ?>
            <form action="<?php echo APP_URL; ?>data/editSurgery.php" method="post" enctype="multipart/form-data" id="addServices">
            <!-- phuong thu tu van -->
            <h3 class="h3_page">Mổ chính</h3>
            <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
            <p class="inputBlock customSelect" >
                    <select name="doctor1" id="doctor1">
                        <option value="">Lựa chọn bác sĩ</option>
                        <?php
                            $wp_query = new WP_Query();
                            $param=array(
                            'post_type'=>'users',
                            'order' => 'DESC',
                            'posts_per_page' => '-1',
                            'tax_query' => array(
                                'relation' => 'OR',
                                array(
                                'taxonomy' => 'userscat',
                                'field' => 'slug',
                                'terms' => 'doctor'
                                ),
                                array(
                                    'taxonomy' => 'userscat',
                                    'field' => 'slug',
                                    'terms' => 'boss'
                                ),
                                )
                            );
                            $wp_query->query($param);
                            if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                        ?>
                            <option value="<?php the_field('fullname') ?>"><?php the_field('fullname') ?></option>
                        <?php endwhile;endif; ?>
                    </select>
            </p>
            
            <p class="inputBlock customSelect">
                <select name="doctor2" id="doctor2">
                    <option value="">Lựa chọn bác sĩ</option>
                    <?php
                        $wp_query = new WP_Query();
                        $param=array(
                        'post_type'=>'users',
                        'order' => 'DESC',
                        'posts_per_page' => '-1',
                        'tax_query' => array(
                            array(
                            'taxonomy' => 'userscat',
                            'field' => 'slug',
                            'terms' => 'doctor'
                            )
                            )
                        );
                        $wp_query->query($param);
                        if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                    ?>
                        <option value="<?php the_field('fullname') ?>"><?php the_field('fullname') ?></option>
                    <?php endwhile;endif; ?>
                </select>
            </p>
            </div>
            <!-- phuong thu tu van -->

            <h3 class="h3_page">Phụ mổ</h3>
            <div class="flexBox flexBox--between flexBox__form flexBox__form--3">
            <p class="inputBlock customSelect">
                <select name="nursing1" id="nursing1">
                    <option value="">Lựa chọn điều dưỡng</option>
                    <?php
                        $wp_query = new WP_Query();
                        $param=array(
                        'post_type'=>'users',
                        'order' => 'DESC',
                        'posts_per_page' => '-1',
                        'tax_query' => array(
                            array(
                            'taxonomy' => 'userscat',
                            'field' => 'slug',
                            'terms' => 'nursing'
                            )
                            )
                        );
                        $wp_query->query($param);
                        if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                    ?>
                        <option value="<?php the_field('fullname') ?>"><?php the_field('fullname') ?></option>
                    <?php endwhile;endif; ?>
            </select>
            </p>
            <p class="inputBlock customSelect">
            <select name="nursing2" id="nursing2">
                    <option value="">Lựa chọn điều dưỡng</option>
                    <?php
                        $wp_query = new WP_Query();
                        $param=array(
                        'post_type'=>'users',
                        'order' => 'DESC',
                        'posts_per_page' => '-1',
                        'tax_query' => array(
                            array(
                            'taxonomy' => 'userscat',
                            'field' => 'slug',
                            'terms' => 'nursing'
                            )
                            )
                        );
                        $wp_query->query($param);
                        if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                    ?>
                        <option value="<?php the_field('fullname') ?>"><?php the_field('fullname') ?></option>
                    <?php endwhile;endif; ?>
            </select>
            </p>
            <p class="inputBlock customSelect">
            <select name="nursing3" id="nursing3">
                    <option value="">Lựa chọn điều dưỡng</option>
                    <?php
                        $wp_query = new WP_Query();
                        $param=array(
                        'post_type'=>'users',
                        'order' => 'DESC',
                        'posts_per_page' => '-1',
                        'tax_query' => array(
                            array(
                            'taxonomy' => 'userscat',
                            'field' => 'slug',
                            'terms' => 'nursing'
                            )
                            )
                        );
                        $wp_query->query($param);
                        if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                    ?>
                        <option value="<?php the_field('fullname') ?>"><?php the_field('fullname') ?></option>
                    <?php endwhile;endif; ?>
            </select>
            </p>
            </div>
            <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
            <p class="inputBlock customSelect">
            <select name="nursing4" id="nursing4">
                    <option value="">Lựa chọn điều dưỡng</option>
                    <?php
                        $wp_query = new WP_Query();
                        $param=array(
                        'post_type'=>'users',
                        'order' => 'DESC',
                        'posts_per_page' => '-1',
                        'tax_query' => array(
                            array(
                            'taxonomy' => 'userscat',
                            'field' => 'slug',
                            'terms' => 'nursing'
                            )
                            )
                        );
                        $wp_query->query($param);
                        if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                    ?>
                        <option value="<?php the_field('fullname') ?>"><?php the_field('fullname') ?></option>
                    <?php endwhile;endif; ?>
            </select>
            </p>
            <p class="inputBlock customSelect">
            <select name="nursing5">
                    <option value="">Lựa chọn điều dưỡng</option>
                    <?php
                        $wp_query = new WP_Query();
                        $param=array(
                        'post_type'=>'users',
                        'order' => 'DESC',
                        'posts_per_page' => '-1',
                        'tax_query' => array(
                            array(
                            'taxonomy' => 'userscat',
                            'field' => 'slug',
                            'terms' => 'nursing'
                            )
                            )
                        );
                        $wp_query->query($param);
                        if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                    ?>
                        <option value="<?php the_field('fullname') ?>"><?php the_field('fullname') ?></option>
                    <?php endwhile;endif; ?>
            </select>
            </p>
            </div>
            
            <h3 class="h3_page">KTV GM</h3>
            <p class="inputBlock customSelect">
            <select name="ktv" id="ktv">
                    <option value="">Lựa chọn điều dưỡng</option>
                    <?php
                        $wp_query = new WP_Query();
                        $param=array(
                        'post_type'=>'users',
                        'order' => 'DESC',
                        'posts_per_page' => '-1',
                        'tax_query' => array(
                            array(
                            'taxonomy' => 'userscat',
                            'field' => 'slug',
                            'terms' => 'ktv'
                            )
                            )
                        );
                        $wp_query->query($param);
                        if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                    ?>
                        <option value="<?php the_field('fullname') ?>"><?php the_field('fullname') ?></option>
                    <?php endwhile;endif; ?>
            </select>
            </p>
            <h3 class="h3_page">Phòng mổ</h3>
            <p class="inputBlock customSelect">
            <select name="room" id="room">
                    <option value="">Lựa chọn phòng mổ</option>
                    <option value="room_1">Phòng 1</option>
                    <option value="room_2">Phòng 2</option>
                    <option value="room_3">Phòng 3</option>
                    <option value="room_4">Phòng 4</option>
            </select>
            </p>

            <h3 class="h3_page">Nhập thông tin</h3>
            <p class="inputBlock customSelect">
            <select name="input" id="input">
                    <option value="">Lựa chọn điều dưỡng</option>
                    <?php
                        $wp_query = new WP_Query();
                        $param=array(
                        'post_type'=>'users',
                        'order' => 'DESC',
                        'posts_per_page' => '-1',
                        'tax_query' => array(
                            array(
                            'taxonomy' => 'userscat',
                            'field' => 'slug',
                            'terms' => 'nursing'
                            )
                            )
                        );
                        $wp_query->query($param);
                        if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                    ?>
                        <option value="<?php the_field('fullname') ?>"><?php the_field('fullname') ?></option>
                    <?php endwhile;endif; ?>
            </select>
            </p>

            <input type="hidden" name="idSurgery" value="<?php echo $_GET['idSurgery']; ?>" >
            <input type="hidden" name="action" value="ekip_create" >
            <input type="hidden" name="status" value="phauthuat" >
            <input class="btnSubmit" type="submit" name="submit" value="Hoàn tất">
        </form>
    </div>
</div>


<!--Footer-->
<?php include(APP_PATH."libs/footer.php"); ?>
<!--/Footer-->
<!--===================================================-->
</div>
<!--/wrapper-->
<!--===================================================-->

<script type="text/javascript" src="<?php echo APP_URL; ?>checkform/exvalidation.js"></script>
<script type="text/javascript" src="<?php echo APP_URL; ?>checkform/exchecker-ja.js"></script>
<script type="text/javascript">
	$(function(){
	  $("#addServices").exValidation({
	    rules: {
            doctor1: "chkselect",
            doctor2: "chkselect",
            nursing1:"chkselect",
            nursing2:"chkselect",
            nursing3:"chkselect",
            nursing4:"chkselect",
            ktv:"chkselect",
            room:"chkselect",
	    },
	    stepValidation: true,
	    scrollToErr: true,
	    errHoverHide: true
	  });
    });
</script>

</body>
</html>	