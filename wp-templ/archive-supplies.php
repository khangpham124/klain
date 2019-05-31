<?php /* Template Name: Search */ ?>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/app_config.php");
if(!$_COOKIE['login_cookies']) {    
	header('Location:'.APP_URL.'login');
}
include(APP_PATH."libs/head.php"); 
?>
</head>

<body id="supply">
<div class="flexBox flexBox--between flexBox--wrap">
<?php include(APP_PATH."libs/sidebar.php"); ?>
<div id="wrapper">
<!--===================================================-->
<!--Header-->
<?php include(APP_PATH."libs/header.php"); ?>
<!--/Header-->


<div class="blockPage blockPage--full maxW">
    <div class="buttonBar">
        <a href="<?php echo APP_URL ?>add-supplies/"><i class="fa fa-user-plus" aria-hidden="true"></i>Thêm vật tư</a>
    </div>
    <h2 class="h2_page">Danh sách vật tư</h2>
        <table class="tblPage">
            <thead>
                <tr>
                    <td>Tên vật tư</td>
                    <td>Mã vật tư</td>
                    <td>Đơn vị tính</td>
                    <td>Xóa</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    query_posts($query_string . '&orderby=post_date&order=desc&posts_per_page=30&paged=' . $paged); 
                    if(have_posts()):while(have_posts()) : the_post();
                ?>
                <tr>
                    <td><?php the_title(); ?></td>
                    <td><?php the_field('sort') ?></td>
                    <td><?php the_field('unit') ?></td>
                    <td class="last">
                    <span><a onclick="myFunction()" data-link="<?php echo APP_URL; ?>data/removePost.php?idSurgery=<?php echo $post->ID; ?>&page=supplies"class="removeItem"><i class="fa fa-minus-circle" aria-hidden="true"></i></a></span>
                    </td>
                </tr>
                <?php endwhile;endif;?>
            </tbody>
        </table>
        <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
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
      function myFunction() {
        confirm("Xoá hồ sơ đã chọn?");
    }

    $(".removeItem").click(function(){
        if(confirm("Xoá hồ sơ đã chọn?")){
            var url = $(this).attr('data-link');
            window.location = url;
        }
        else{
            return false;
        }
    });
    });
</script>
</body>
</html>	