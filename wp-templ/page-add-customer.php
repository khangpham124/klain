<?php /* Template Name: Add Customer */ ?>
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
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link type="text/css" rel="stylesheet" href="<?php echo APP_URL; ?>checkform/exvalidation.css" />
<style type="text/css">
    #datepicker {
        display: none;
    }
</style>
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
        <h2 class="h2_page">Thông tin khách hàng</h2>
        
            <form action="<?php echo APP_URL; ?>data/addCustomer.php" method="post" enctype="multipart/form-data" id="formCustomer">
                <h3 class="h3_page">Thông tin cơ bản</h3>
                <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                    <p class="inputBlock">
                    <input type="text" class="inputForm" name="fullname" id="fullname" placeholder="Họ tên" />
                    </p>
                    <p class="inputBlock">
                    <input type="text" class="inputForm" name="idcard" id="idcard" placeholder="Só CMND" />
                    </p>
                </div>

                <div class="flexBox flexBox--between flexBox__form flexBox__form--2">    
                    <p class="inputBlock">
                    <input type="number" class="inputForm" name="mobile" id="mobile" placeholder="Điện thoại" />
                    </p>
                    <div class="flexBox flexBox--between flexBox__form flexBox__form--3">
                        <p class="inputBlock customSelect">
                            <select id="day" name="day">
                                <option value="">Ngày</option>
                                <?php for($i=0;$i<=31;$i++) { ?>
                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                <?php } ?>
                            </select>
                        </p>
                        <p class="inputBlock customSelect">    
                            <select id="month" name="month">
                                <option value="">Tháng</option>
                                <?php for($i=0;$i<=31;$i++) { ?>
                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                <?php } ?>
                            </select>
                            </p>
                        <p class="inputBlock customSelect">    
                            <select id="year" name="year">
                                <option value="">Năm</option>
                                <?php for($i=1940;$i<=2019;$i++) { ?>
                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                <?php } ?>
                            </select>
                        </p>
                    </div>
                </div>

                <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                    <label class="file">
                        <input type="file" name="file1" id="file1" aria-label="Mặt trước chứng minh">
                        <span class="file-custom"></span>
                    </label>
                    <label class="file">
                        <input type="file" name="file2" id="file2" aria-label="Mặt sau chứng minh">
                        <span class="file-custom"></span>
                    </label>
                </div>
                
                <h3 class="h3_page">Thông tin tài khoản online</h3>
                <div class="flexBox flexBox--between flexBox__form">
                    <p class="inputBlock">
                    <input type="text" class="inputForm" name="facebook" placeholder="facebook" />
                    </p>
                    <p class="inputBlock customSelect">
                        <select id="address" name="address">
                            <option value="">Chọn Tỉnh/Thành phố</option>
                            <option value="Đài Loan">--Đài Loan</option>
                            <option value="Trung Quốc">--Trung Quốc</option>
                            <option value="Hàn Quốc">--Hàn Quốc</option>
                            <option value="Hồ Chí Minh">Hồ Chí Minh</option>
                            <option value="Hà Nội">Hà Nội</option>
                            <option value="Đà Nẵng">Đà Nẵng</option>
                            <option value="An Giang">An Giang</option>
                            <option value="Bà Rịa - Vũng Tàu">Bà Rịa - Vũng Tàu</option>
                            <option value="Bắc Giang">Bắc Giang</option>
                            <option value="Bắc Kạn">Bắc Kạn</option>
                            <option value="Bạc Liêu">Bạc Liêu</option>
                            <option value="Bắc Ninh">Bắc Ninh</option>
                            <option value="Bắc Ninh">Bắc Ninh</option>
                            <option value="Bình Dương">Bình Dương</option>
                            <option value="Bình Phước">Bình Phước</option>
                            <option value="Bình Thuận">Bình Thuận</option>
                            <option value="Bình Định">Bình Định</option>
                            <option value="Cà Mau">Cà Mau</option>
                            <option value="Cần Thơ">Cần Thơ</option>
                            <option value="Cao Bằng">Cao Bằng</option>
                            <option value="Gia Lai">Gia Lai</option>
                            <option value="Hà Giang">Hà Giang</option>
                            <option value="Hà Nam">Hà Nam</option>
                            <option value="Hà Tĩnh">Hà Tĩnh</option>
                            <option value="Hải Dương">Hải Dương</option>
                            <option value="Hải Phòng">Hải Phòng</option>
                            <option value="Hậu Giang">Hậu Giang</option>
                            <option value="Hoà Bình">Hoà Bình</option>
                            <option value=">Hưng Yên">Hưng Yên</option>
                            <option value="Khánh Hòa">Khánh Hòa</option>
                            <option value="Kiên Giang">Kiên Giang</option>
                            <option value="Kon Tum">Kon Tum</option>
                            <option value="Lai Châu">Lai Châu</option>
                            <option value="Lâm Đồng">Lâm Đồng</option>
                            <option value="Lạng Sơn">Lạng Sơn</option>
                            <option value="Lào Cai">Lào Cai</option>
                            <option value="Long An">Long An</option>
                            <option value="Nam Định">Nam Định</option>
                            <option value="Nghệ An">Nghệ An</option>
                            <option value="Ninh Bình">Ninh Bình</option>
                            <option value="Ninh Thuận">Ninh Thuận</option>
                            <option value="Phú Thọ">Phú Thọ</option>
                            <option value="Phú Yên">Phú Yên</option>
                            <option value="Quảng Bình">Quảng Bình</option>
                            <option value="Quảng Nam">Quảng Nam</option>
                            <option value="Quảng Ngãi">Quảng Ngãi</option>
                            <option value="Quảng Ninh">Quảng Ninh</option>
                            <option value="Quảng Trị">Quảng Trị</option>
                            <option value="Sóc Trăng">Sóc Trăng</option>
                            <option value="Sơn La">Sơn La</option>
                            <option value="Tây Ninh">Tây Ninh</option>
                            <option value="Thái Bình">Thái Bình</option>
                            <option value="Thái Nguyên">Thái Nguyên</option>
                            <option value="Thanh Hóa">Thanh Hóa</option>
                            <option value="Thừa Thiên Huế">Thừa Thiên Huế</option>
                            <option value="Tiền Giang">Tiền Giang</option>
                            <option value="Trà Vinh">Trà Vinh</option>
                            <option value="Tuyên Quang">Tuyên Quang</option>
                            <option value="Vĩnh Long">Vĩnh Long</option>
                            <option value="Vĩnh Phúc">Vĩnh Phúc</option>
                            <option value="Yên Bái">Yên Bái</option>
                            <option value="Đắk Lắk">Đắk Lắk</option>
                            <option value="Đắk Nông">Đắk Nông</option>
                            <option value="Điện Biên">Điện Biên</option>
                            <option value="Đồng Nai">Đồng Nai</option>
                            <option value="Đồng Tháp">Đồng Tháp</option>
                                                                                                        
                        </select>
                    </p>
                </div>
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

<script type="text/javascript" src="<?php echo APP_URL; ?>checkform/exvalidation.js"></script>
<script type="text/javascript" src="<?php echo APP_URL; ?>checkform/exchecker-ja.js"></script>
<script type="text/javascript">
	$(function(){
	  $("#formCustomer").exValidation({
	    rules: {
            fullname: "chkrequired",
            idcard: "chkrequired",
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