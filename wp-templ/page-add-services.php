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
        
            <form action="<?php echo APP_URL; ?>data/addServices.php" method="post">
                <div class="flexBox flexBox--between flexBox__form flexBox__form--3">
                    <p class="inputBlock">
                    <input type="text" class="inputForm" name="name" placeholder="Tên dịch vụ" />
                    </p>
                    <p class="inputBlock">
                    <input type="number" class="inputForm" name="price" placeholder="Giá" />
                    </p>
                    <p class="inputBlock">
                    <input type="number" class="inputForm" name="numb_img" placeholder="Só lượng ảnh cần chụp" />
                    </p>
                </div>
                <div class="flexBox flexBox--between flexBox__form flexBox__form--2">    
                    <p class="inputBlock customSelect">
                    <select name="services">
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
                    <select name="type">
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

</body>
</html>	