<?php /* Template Name: Search */ ?>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/projects/klain/app_config.php");
include(APP_PATH."libs/head.php"); 
?>
</head>

<body id="login">
<!--===================================================-->
<div id="wrapper">
<!--===================================================-->
<!--Header-->
<?php include(APP_PATH."libs/header.php"); ?>
<!--/Header-->


<div class="blockPage blockPage--full">
    <h2 class="h2_page">Kết quả tìm kiếm (2 kết quả)</h2>
        <table class="tblPage">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Họ tên</td>
                    <td>Số điện thoại</td>
                    <td>Số CMND</td>
                    <td>Facebook</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Nguyện Thị Mẹt</td>
                    <td>090909009</td>
                    <td>Nguyễn văn tí</td>
                    <td class="last"><a href=""><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a></td>
                </tr>
                <tr>
                <td>2</td>
                    <td>Nguyện Thị Mẹt</td>
                    <td>090909009</td>
                    <td>Nguyễn văn tí</td>
                    <td class="last"><a href=""><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a></td>
                </tr>
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

</body>
</html>	