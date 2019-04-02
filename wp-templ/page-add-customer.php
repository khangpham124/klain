<?php /* Template Name: Add Customer */ ?>
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
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link type="text/css" rel="stylesheet" href="<?php echo APP_URL; ?>checkform/exvalidation.css" />
<style type="text/css">
    #datepicker {
        display: none;
    }
</style>
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
        <h2 class="h2_page">Thông tin khách hàng</h2>
        
            <form action="<?php echo APP_URL; ?>data/addCustomer.php" method="post" enctype="multipart/form-data" id="formCustomer">
                <h3 class="h3_page">Thông tin cơ bản</h3>
                <div class="flexBox flexBox--between flexBox__form flexBox__form--3">
                    <p class="inputBlock">
                    <input type="text" class="inputForm" name="fullname" id="fullname" placeholder="Họ tên" />
                    </p>
                    <p class="inputBlock">
                    <input type="text" class="inputForm" name="idcard" id="idcard" placeholder="Só CMND" />
                    </p>
                    <p class="inputBlock">
                    <input type="number" class="inputForm" name="mobile" id="mobile" placeholder="Điện thoại" />
                    </p>
                </div>

            <div class="flexBox flexBox--between flexBox__form flexBox__form--3">
                        <p class="inputBlock customSelect">
                            <select id="day" name="day">
                                <option value="">Ngày</option>
                                <?php for($i=1;$i<=31;$i++) { ?>
                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                <?php } ?>
                            </select>
                        </p>
                        <p class="inputBlock customSelect">    
                            <select id="month" name="month">
                                <option value="">Tháng</option>
                                <?php for($i=1;$i<=12;$i++) { ?>
                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                <?php } ?>
                            </select>
                            </p>
                        <p class="inputBlock customSelect">    
                            <select id="year" name="year">
                                <option value="">Năm sinh</option>
                                <?php for($i=1940;$i<=2019;$i++) { ?>
                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                <?php } ?>
                            </select>
                        </p>
            </div>
                
                <h3 class="h3_page">Thông tin tài khoản online</h3>
                <div class="flexBox flexBox--between flexBox__form">
                    <p class="inputBlock">
                    <input type="text" class="inputForm" name="address" placeholder="Địa chỉ" />
                    </p>
                    <p class="inputBlock">
                    <input type="text" class="inputForm" name="facebook" placeholder="facebook" />
                    </p>
                </div>

                <h3 class="h3_page">Tư vấn cho khách hàng</h3>
                <textarea class="inputForm" name="advise_f" placeholder=""></textarea>

                <input type="hidden" name="action" value="create" >
                <input type="hidden" name="creator" value="<?php echo $_COOKIE['name_cookies']; ?>" >
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
</div>

<script type="text/javascript" src="<?php echo APP_URL; ?>checkform/exvalidation.js"></script>
<script type="text/javascript" src="<?php echo APP_URL; ?>checkform/exchecker-ja.js"></script>
<script type="text/javascript">
	$(function(){
	  $("#formCustomer").exValidation({
	    rules: {
            fullname: "chkrequired",
            mobile: "chkrequired",
            address: "chkrequired",
	    },
	    stepValidation: true,
	    scrollToErr: true,
	    errHoverHide: true
	  });
	});
</script>



</body>
</html>	