<?php /* Template Name: Care */ ?>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/projects/klain/app_config.php");
// include(APP_PATH."libs/checklog.php");
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
        <h2 class="h2_page">Chăm sóc hậu phẫu</h2>
        
        <form action="" method="post" enctype="multipart/form-data" id="addServices">
            <h3 class="h3_page">Thông tin khách hàng</h3>
            <div class="flexBox flexBox--between flexBox__form flexBox__form--3">
                <p class="inputBlock">
                <input type="text" class="inputForm" name="fullname" placeholder="Họ tên" />
                </p>
                <p class="inputBlock">
                <input type="number" class="inputForm" name="mobile" id="mobile" placeholder="Số điện thoại" />
                </p>
                <p class="inputBlock">
                <input type="text" class="inputForm" name="address" id="address" placeholder="Địa chỉ" />
                </p>
            </div>
            
            <!-- phuong thu tu van -->
            <h3 class="h3_page">Ngay sau phẫu thuật</h3>
            <p class="inputBlock">
                <input type="text" class="inputForm" name="address" id="address" placeholder="Tình trạng" />
            </p>
            <textarea class="inputForm" name="fullname" placeholder="Lời dặn"></textarea>

            <h3 class="h3_page">Vệ sinh sau 1 ngày</h3>
            <p class="inputBlock">
                <input type="text" class="inputForm" name="address" id="address" placeholder="Tình trạng" />
            </p>
            <textarea class="inputForm" name="fullname" placeholder="Lời dặn"></textarea>
            
            <label class="file">
            <input type="file" name="file" id="file" aria-label="File browser example">
            <span class="file-custom"></span>
            </label>

            <h3 class="h3_page">Tái khám sau 5 ngày</h3>
            <p class="inputBlock">
                <input type="text" class="inputForm" name="address" id="address" placeholder="Tình trạng" />
            </p>
            <textarea class="inputForm" name="fullname" placeholder="Lời dặn"></textarea>

            <h3 class="h3_page">Tái khám sau 10 ngày</h3>
            <p class="inputBlock">
                <input type="text" class="inputForm" name="address" id="address" placeholder="Tình trạng" />
            </p>
            <textarea class="inputForm" name="fullname" placeholder="Lời dặn"></textarea>

            <h3 class="h3_page">Tái khám sau 1 tháng</h3>
            <p class="inputBlock">
                <input type="text" class="inputForm" name="address" id="address" placeholder="Tình trạng" />
            </p>
            <textarea class="inputForm" name="fullname" placeholder="Lời dặn"></textarea>


            <h3 class="h3_page">Tái khám khi có vấn đề</h3>
            <div class="inputBlock">
                <input type="text" class="inputForm" id="datechose" name="datechose" value="" placeholder="Chọn ngày phẫu thuật">
                <div id="datepicker"></div>
            </div>
            <p class="inputBlock">
                <input type="text" class="inputForm" name="address" id="address" placeholder="Tình trạng" />
            </p>
            <textarea class="inputForm" name="fullname" placeholder="Lời dặn"></textarea>

            
            
            <input type="hidden" name="action" value="confirm" >
            <input class="btnSubmit" type="submit" name="submit" value="Lưu">
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
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    var currTime = new Date();  
    var hour = currTime.getHours();
    var hourText = hour.toString()
    var minutes = currTime.getMinutes();
    var minText = minutes.toString();
    var timeCompText = hourText + minText;
    var timeComp = parseInt(timeCompText);
    var dateToday = new Date();  

    $('#datepicker').datepicker({
    dateFormat: 'd-m-yy',
    minDate: dateToday,
    maxDate: "+4w",
    altField: '#datechose',
    onSelect: function (date) {
        var currTime = new Date();
        var currDate =currTime.getDate()+"-"+(currTime.getMonth()+1)+"-"+currTime.getFullYear();
        var choseDate = $(this).val();
    }
    });

    $("#datechose").on('click', function () {
        $('#datepicker').show(200);
    });

    $('#datechose').change(function(){
        $('#datepicker').datepicker('setDate', $(this).val());
    });
      
  });
</script>

<script type="text/javascript" src="<?php echo APP_URL; ?>checkform/exvalidation.js"></script>
<script type="text/javascript" src="<?php echo APP_URL; ?>checkform/exchecker-ja.js"></script>
<script type="text/javascript">
	$(function(){
	  $("#addServices").exValidation({
	    rules: {
			mobile: "chkrequired",
	    },
	    stepValidation: true,
	    scrollToErr: true,
	    errHoverHide: true
	  });

    $('input[type=radio][name=advise]').change(function() {
        if (this.value == 'yes') {
            $('.blockAdvise').slideDown(200);
        } else {
            $('.blockAdvise').slideUp(200);    
        }
    });

    $('input[type=radio][name=hasSur]').change(function() {
        if (this.value == 'yes') {
            $('.blockSur').slideDown(200);
        } else {
            $('.blockSur').slideUp(200);    
        }
    });

    

	});
</script>

</body>
</html>	