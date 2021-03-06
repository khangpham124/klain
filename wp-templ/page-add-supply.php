<?php /* Template Name: Add Supply */ ?>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/app_config.php");
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
<div class="flexBox flexBox--between flexBox--wrap">
<?php include(APP_PATH."libs/sidebar.php"); ?>
<!--===================================================-->
<div id="wrapper">
<!--===================================================-->
<!--Header-->
<?php include(APP_PATH."libs/header.php"); ?>
<!--/Header-->

<div class="flexBox flexBox--between textBox flexBox--wrap maxW">
    <div class="blockPage blockPage--full">
        <h2 class="h2_page">Thêm Vật tư</h2>
        
            <form autocomplete="off" action="<?php echo APP_URL; ?>data/addSupplies.php" method="post">
                <div class="flexBox flexBox--between flexBox__form">
                    <p class="inputBlock">
                    <input type="text" class="inputForm" name="name" placeholder="Tên vật tư" />
                    </p>
                    <p class="inputBlock">
                    <input type="text" class="inputForm" name="unit" placeholder="Đơn vị tính" />
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
</div>

<script type="text/javascript" src="<?php echo APP_URL; ?>checkform/exvalidation.js"></script>
<script type="text/javascript" src="<?php echo APP_URL; ?>checkform/exchecker-ja.js"></script>
<script type="text/javascript">
	$(function(){
	  $("#addServices").exValidation({
	    rules: {
            name: "chkrequired",
            unit: "chkrequired",
	    },
	    stepValidation: true,
	    scrollToErr: true,
	    errHoverHide: true
	  });
    });
</script>

</body>
</html>	