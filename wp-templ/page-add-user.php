<?php /* Template Name: Add User */ ?>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/app_config.php");
if(!$_COOKIE['login_cookies']) {    
	header('Location:'.APP_URL.'login');
}
if(($_COOKIE['role_cookies']!='manager')) {
    header('Location:'.APP_URL);
}
include(APP_PATH."libs/head.php"); 
?>
<link type="text/css" rel="stylesheet" href="<?php echo APP_URL; ?>checkform/exvalidation.css" />
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
        <h2 class="h2_page">Thêm người dùng mới</h2>
        <form autocomplete="off" id="addUser" action="<?php echo APP_URL; ?>data/addUser.php" method="post" enctype="multipart/form-data">
                <div class="flexBox flexBox--between flexBox__form">
                    <p class="inputBlock">
                    <input type="text" class="inputForm" id="fullname" name="fullname" placeholder="Họ tên" />
                    </p>
                    <label class="file">
                    <input type="file" name="file" id="file" aria-label="File browser example">
                    <span class="file-custom"></span>
                    </label>
                </div>
                <div class="flexBox flexBox--between flexBox__form">
                    <p class="inputBlock">
                    <input type="text" class="inputForm" id="username" name="username" placeholder="Username" />
                    </p>
                    <p class="inputBlock">
                    <input type="number" class="inputForm" id="mobile" name="mobile" placeholder="Mobile" />
                    </p>
                </div>
                
                <p class="inputBlock customSelect">
                    <select name="position" id="position">
                        <option>Lựa chọn vị trí</option>
                        <option value="boss">BSK</option>
                        <option value="manager">Ban Quản lý</option>
                        <option value="sale">Sale</option>
                        <option value="adviser">Tư vấn viên</option>
                        <option value="counter">Nhân viên quầy</option>
                        <option value="doctor">Bác sĩ</option>
                        <option value="nursing-primary">Điều dưỡng chính</option>
                        <option value="nursing">Điều dưỡng phụ</option>
                        <option value="ktv">KTV gây mê</option>
                        <option value="customer-care">CSKH</option>
                        <option value="room">Room</option>
                    </select>
                </p>
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
	  $("#addUser").exValidation({
	    rules: {
            fullname: "chkrequired",
            file: "chkrequired",
            username: "chkrequired",
            mobile: "chkrequired",
            position: "chkselect",
	    },
	    stepValidation: true,
	    scrollToErr: true,
	    errHoverHide: true
	  });
    });
</script>
</body>
</html>	