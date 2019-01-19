<?php /* Template Name: Search */ ?>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/projects/klain/app_config.php");
if(!$_COOKIE['login_cookies']) {    
	header('Location:'.APP_URL.'login');
}
include(APP_PATH."libs/head.php"); 
?>
</head>

<body id="users">
<!--===================================================-->
<div id="wrapper">
<!--===================================================-->
<!--Header-->
<?php include(APP_PATH."libs/header.php"); ?>
<!--/Header-->


<div class="blockPage blockPage--full maxW">
    <div class="buttonBar">
        <p class="inputBlock customSelect">
            <select id="selectBox">
                <option value="">Lọc tài khoản</option>
                <option value="<?php echo APP_URL ?>users/"> Tất cả</option>
                <option value="<?php echo APP_URL ?>users/?position=manager">Ban Quản lý</option>
                <option value="<?php echo APP_URL ?>users/?position=sale">Sale</option>
                <option value="<?php echo APP_URL ?>users/?position=adviser">Tư vấn viên</option>
                <option value="<?php echo APP_URL ?>users/?position=counter">Nhân viên quầy</option>
                <option value="<?php echo APP_URL ?>users/?position=doctor">Bác sĩ</option>
                <option value="<?php echo APP_URL ?>users/?position=nursing">Điều dưỡng</option>
                <option value="<?php echo APP_URL ?>users/?position=customer-care">CSKH</option>
            </select>
        </p>
        <a href="<?php echo APP_URL ?>add-user/"><i class="fa fa-user-plus" aria-hidden="true"></i>Tạo tài khoản mới</a>
        <a href="javascript:void(0)" onClick="window.location.href=window.location.href"><i class="fa fa-refresh" aria-hidden="true"></i>Cập nhật hệ thống</a>
    </div>
    <h2 class="h2_page">Danh sách tài khoản</h2>
        <table class="tblPage">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Ảnh đại diện</td>
                    <td>Họ tên</td>
                    <td>Bộ phận</td>
                    <td>Số điện thoại</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $wp_query = new WP_Query();
                    if($_GET['position']!='') {
                        $slug = $_GET['position'];
                        $param=array(
                            'post_type'=>'users',
                            'order' => 'DESC',
                            'posts_per_page' => '-1',
                            'tax_query' => array(
                            array(
                            'taxonomy' => 'userscat',
                            'field' => 'slug',
                            'terms' => $slug
                            )
                            )
                        );
                    } else {
                        $param = array (
                            'posts_per_page' => '-1',
                            'post_type' => 'users',
                            'post_status' => 'publish',
                            'order' => 'DESC',
                        );
                    }
                    $wp_query->query($param);
                    if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                    $thumb = get_post_thumbnail_id($post->ID);
                    $thumb_url = wp_get_attachment_image_src($thumb,'full');
                    $terms = get_the_terms($post->ID, 'userscat');
                    foreach($terms as $term) { 
                        $name_user = $term->name;
                    }
                ?>
                <tr>
                    <td><?php the_field('id_user') ?></td>
                    <td><img src="<?php echo thumbCrop($thumb_url[0],80,80); ?>" alt=""></td>
                    <td><?php the_field('fullname') ?></td>
                    <td><?php echo $name_user; ?></td>
                    <td><?php the_field('mobile') ?></td>
                    <td class="last"><a href="<?php the_permalink(); ?>"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a></td>
                </tr>
                <?php endwhile;endif;?>
            </tbody>
        </table>
    </div>


<!--Footer-->
<?php include(APP_PATH."libs/footer.php"); ?>
<!--/Footer-->
<!--===================================================-->
</div>
<!--/wrapper-->
<!--===================================================-->
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