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
        
        <h3 class="h3_page">Tra cứu thông tin mã số ca mổ</h3>
        <form action="" method="post" class="formSearch">
            <p class="inputBlock">
            <input type="text" name="search" class="inputForm" placeholder="Tìm kiếm" />
            <input type="submit" class="submitBtn searchBtn">
            </p>
        </form>
        <?php
            $wp_query = new WP_Query();
            $param = array (
            'posts_per_page' => '-1',
            'post_type' => 'surgery',
            'post_status' => 'publish',
            'order' => 'DESC',
            'meta_query' => array(
            array(
            'key' => 'idcard',
            'value' => $_POST['idsurgery'],
            'compare' => '='
            ))
            
            );
            $wp_query->query($param);
            if($wp_query->have_posts()): 
        ?>
        <h2 class="h2_page">Kết quả tìm kiếm</h2>
        <table class="tblPage">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Họ tên</td>
                    <td>Số điện thoại</td>
                    <td>Số CMND</td>
                    <td>Facebook</td>
                </tr>
            </thead>
            <tbody>
                <?php 
                    while($wp_query->have_posts()) :$wp_query->the_post();
                ?>
                <tr>
                    <td>1</td>
                    <td><?php the_title(); ?></td>
                    <td><?php the_field('monbile') ?></td>
                    <td><?php the_field('idcard') ?></td>
                    <td class="last text"><a href="">Sử dụng</i></a></td>
                </tr>
                <tr>
                <?php endwhile; ?>    
            </tbody>
        </table>
        <?php endif; ?>


        <form action="" method="post" enctype="multipart/form-data" id="addServices">
            <h3 class="h3_page">Thông tin cơ bản</h3>
            <div class="flexBox flexBox--between flexBox__form flexBox__form--3">
                <p class="inputBlock">
                <input type="text" class="inputForm" name="fullname" placeholder="Họ tên" />
                </p>
                <p class="inputBlock">
                <input type="number" class="inputForm" name="mobile" id="mobile" placeholder="Số điện thoại" />
                </p>
                <p class="inputBlock">
                <input type="text" class="inputForm" name="address" id="address" placeholder="Địa chỉ" />
                </p>
            </div>
            
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
            <h3 class="h3_page">Phòng mổ</h3>
            <p class="inputBlock customSelect">
            <select name="number" id="number">
                    <option value="">Lựa chọn phòng mổ</option>
                    <option value="Phòng 1">Phòng 1</option>
                    <option value="Phòng 2">Phòng 2</option>
                    <option value="Phòng 3">Phòng 3</option>
                    <option value="Phòng 4">Phòng 4</option>
            </select>
            </p>

            <h3 class="h3_page">Vật tư sử dụng</h3>
            <table class="tblPage">
                <thead>
                    <tr>
                        <td>Vật tư</td>
                        <td>Đơn vị</td>
                        <td>Số lượng</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $wp_query = new WP_Query();
                        $param=array(
                        'post_type'=>'supplies',
                        'order' => 'DESC',
                        'posts_per_page' => '-1',
                        );
                        $wp_query->query($param);
                        if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                    ?>
                    <tr>
                        <td><?php the_title(); ?></td>
                        <td>Cái</td>
                        <td>
                        <p class="inputBlock customSelect">
                        <select name="">
                            <?php for($i=1;$i<=10;$i++) { ?>
                            <option value="<?php the_title(); ?>-<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php } ?>
                        </select>
                        </p>
                        </td>
                    </tr>
                    <?php endwhile;endif; ?>
                </tbody>
            </table>

            <input type="hidden" name="action" value="confirm" >
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
            number:"chkselect",
	    },
	    stepValidation: true,
	    scrollToErr: true,
	    errHoverHide: true
	  });
    });
</script>

</body>
</html>	