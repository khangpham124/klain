<?php /* Template Name: Add Services */ ?>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/projects/klain/app_config.php");
require_once( APP_PATH . 'admin/wp-admin/includes/image.php' );
require_once( APP_PATH . 'admin/wp-admin/includes/file.php' );
require_once( APP_PATH . 'admin/wp-admin/includes/media.php' );
if(!$_COOKIE['login_cookies']) {    
	header('Location:'.APP_URL.'login');
}
include(APP_PATH."libs/head.php"); 
?>
<link type="text/css" rel="stylesheet" href="<?php echo APP_URL; ?>checkform/exvalidation.css" />
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
        <h2 class="h2_page">Thêm Dịch vụ</h2>
            <form action="<?php echo APP_URL; ?>data/addServices.php" method="post" id="addServices">
                <div class="flexBox flexBox--between flexBox__form flexBox__form--3">
                    <p class="inputBlock">
                    <input type="text" class="inputForm" id="name" name="name" placeholder="Tên dịch vụ" />
                    </p>
                    <p class="inputBlock inputNumber">
                        <input type="text" id="price" data-type="number" class="inputForm" name="price" placeholder="Giá" />
                        <span></span>
                    </p>
                    <p class="inputBlock">
                    <input type="number" class="inputForm" id="numb_img" name="numb_img" placeholder="Só lượng ảnh cần chụp" />
                    </p>
                </div>
                <div class="flexBox flexBox--between flexBox__form flexBox__form--2">    
                    <p class="inputBlock customSelect">
                    <select name="services" id="services">
                        <option>Lựa chọn loại</option>
                        <?php
                            $args=array(
                                'child_of' => 0,
                                'orderby' =>'ID',
                                'order' => 'DESC',
                                'hide_empty' => 0,
                                'taxonomy' => 'servicescat',
                                'number' => '0',
                                'pad_counts' => false
                                );
                                $categories = get_categories($args);
                                foreach ( $categories as $category ):
                                $slug = $category->slug;
                        ?>
                            <option value="<?php echo $slug ?>"><?php echo $category->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                    </p>

                    <p class="inputBlock customSelect">
                    <select name="type" id="type">
                        <option>Lựa chọn chi tiết</option>
                        <?php
                            $args=array(
                                'child_of' => 0,
                                'orderby' =>'ID',
                                'order' => 'DESC',
                                'hide_empty' => 0,
                                'taxonomy' => 'typecat',
                                'number' => '0',
                                'pad_counts' => false
                                );
                                $categories = get_categories($args);
                                foreach ( $categories as $category ):
                                $slug = $category->slug;
                        ?>
                            <option value="<?php echo $slug ?>"><?php echo $category->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                    </p>

                    <p class="inputBlock customSelect">
                    <select name="main" id="main">
                        <option>Lựa chọn dịch vụ chính</option>
                        <?php
                            $wp_query = new WP_Query();
                            $param = array (
                                'posts_per_page' => '-1',
                                'post_type' => 'services',
                                'post_status' => 'publish',
                                'order' => 'DESC',
                                // 'meta_query' => array(
                                //     array(
                                //     'key' => 'main',
                                //     'value' => '',
                                //     'compare' => '='
                                //     ))
                            );
                            $wp_query->query($param);
                            if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                            
                        ?>
                            <option value="<?php echo $post->ID; ?>"><?php echo $post->post_title; ?></option>
                        <?php endwhile;endif; ?>
                    </select>
                    </p>
                </div>
                <input type="hidden" name="action" value="create" >
                <input class="btnSubmit" type="submit" name="submit" value="Tạo">
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
            name: "chkrequired",
            price: "chkrequired",
            numb_img: "chkrequired",
            services:"chkselect",
            type:"chkselect",
	    },
	    stepValidation: true,
	    scrollToErr: true,
	    errHoverHide: true
	  });
    });
</script>
</body>
</html>	