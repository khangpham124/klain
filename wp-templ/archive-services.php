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
<div class="flexBox flexBox--between flexBox--wrap">
<?php include(APP_PATH."libs/sidebar.php"); ?>
<div id="wrapper">
<!--===================================================-->
<!--Header-->
<?php include(APP_PATH."libs/header.php"); ?>
<!--/Header-->


<div class="blockPage blockPage--full maxW">
    <div class="buttonBar">
        <p class="inputBlock customSelect">
            <select id="selectBox">
                <option value="">Lọc Dịch vụ</option>
                <option value="<?php echo APP_URL ?>users/"> Tất cả</option>
            </select>
        </p>
        <a href="<?php echo APP_URL ?>add-services/"><i class="fa fa-plus-square" aria-hidden="true"></i>Thêm dịch vụ</a>
        <a href="javascript:void(0)" class="showIcon"><i class="fa fa-minus-square" aria-hidden="true"></i>Xoá dịch vụ</a>
        <a href="<?php echo APP_URL ?>services/"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Sửa dịch vụ</a>
        <a href="javascript:void(0)" onClick="window.location.href=window.location.href"><i class="fa fa-refresh" aria-hidden="true"></i>Cập nhật hệ thống</a>
    </div>
    <h2 class="h2_page">Danh sách dịch vụ</h2>
        <table class="tblPage">
            <thead>
                <tr>
                    <td>Dịch vụ</td>
                    <td>Giá</td>
                    <td>Chi tiết</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $wp_query = new WP_Query();
                    $param = array (
                        'posts_per_page' => '-1',
                        'post_type' => 'services',
                        'post_status' => 'publish',
                        'order' => 'DESC',
                    );
                    $wp_query->query($param);
                    if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                    
                ?>
                <tr>
                    <td><?php the_title(); ?></td>
                    <td><?php echo number_format(get_field('price')); ?></td>
                    <td class="last">
                    <a href="<?php echo wp_nonce_url(APP_URL."/admin/wp-admin/post.php?action=trash&post=$post->ID", 'delete-post_' . $post->ID); ?>" class="removeItem"><i class="fa fa-minus-circle" aria-hidden="true"></i></a>
                    <a href="<?php the_permalink(); ?>"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
                    </td>
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

      $('.showIcon').click(function() {
          $('.removeItem').toggleClass('fade');
        });
    });

</script>
</body>
</html>	