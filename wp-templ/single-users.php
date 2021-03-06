<?php /* Template Name: Search */ ?>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/app_config.php");
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


<div class="blockPage blockPage--full maxW ">
<h2 class="h2_page">Thông tin tài khoản</h2>
        <form action="<?php echo APP_URL; ?>data/editUser.php" method="post" enctype="multipart/form-data" id="formCustomer">
            <div class="flexBox flexBox--wrap flexBox--between">
                <div class="customerInfo">
                    <h4 class="h4_page">ID: <strong><?php the_field('id_user'); ?></strong></h4>
                    <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                        <p class="inputBlock">
                        <input type="text" class="inputForm" name="fullname" id="fullname" value="<?php the_field('fullname'); ?>" placeholder="username" />
                        </p>
                        <p class="inputBlock">
                        <input type="text" readonly class="inputForm" name="username" id="username" value="<?php the_title(); ?>" placeholder="username" />
                        </p>
                    </div>
                    <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                        <p class="inputBlock">
                        <input type="text" class="inputForm" name="mobile" id="mobile" placeholder="Điện thoại" value="<?php the_field('mobile'); ?>" />
                        </p>
                    </div>

                    
                    <h3 class="h4_page">Thay đổi mật khẩu</h3>
                    <p class="inputBlock">
                        <input type="password" class="inputForm" name="password" value="" placeholder="Đặt lại password" />
                    </p>
                    
                    <input type="hidden" name="postid" value="<?php echo $post->ID; ?>" >
                    <input type="hidden" name="url" value="<?php echo $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" >
                    <input type="hidden" name="action" value="update" >
                    <input class="btnSubmit" type="submit" name="submit" value="Cập nhật">
                </div>
                <div class="customerCard">
                    <?php
                    $thumb_url = get_field('avatar');
                    ?>
                    <img src="<?php echo thumbCrop($thumb_url,500,500); ?>">
                    <h3 class="h4_page">Thay đổi hình đại diện</h3>
                    <input type="file" name="file" id="file" aria-label="File browser example">
                </div>
            </div>
        </form>
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
    });
</script>
</body>
</html>	