<?php /* Template Name: Add User */ ?>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/projects/klain/app_config.php");
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
        <h2 class="h2_page">Thêm người dùng mới</h2>
        <form action="<?php echo APP_URL; ?>data/addUser.php" method="post" enctype="multipart/form-data">
                <div class="flexBox flexBox--between flexBox__form">
                    <p class="inputBlock">
                    <input type="text" class="inputForm" name="fullname" placeholder="Họ tên" />
                    </p>
                    <label class="file">
                    <input type="file" name="file" id="file" aria-label="File browser example">
                    <span class="file-custom"></span>
                    </label>
                </div>
                <div class="flexBox flexBox--between flexBox__form">
                    <p class="inputBlock">
                    <input type="text" class="inputForm" name="username" placeholder="Username" />
                    </p>
                    <p class="inputBlock">
                    <input type="number" class="inputForm" name="mobile" placeholder="Mobile" />
                    </p>
                </div>
                
                <p class="inputBlock customSelect">
                    <select name="position">
                        <option>Lựa chọn vị trí</option>
                        <option value="boss">BSK</option>
                        <option value="manager">Ban Quản lý</option>
                        <option value="sale">Sale</option>
                        <option value="adviser">Tư vấn viên</option>
                        <option value="counter">Nhân viên quầy</option>
                        <option value="doctor">Bác sĩ</option>
                        <option value="nursing">Điều dưỡng</option>
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
<!--===================================================-->

</body>
</html>	