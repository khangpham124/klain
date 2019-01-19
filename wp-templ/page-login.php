<?php /* Template Name: Login */ ?>
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


<div class="blockPage blockPage--full maxW maxW--min loginBlock">
	<h2 class="h2_page">Đăng nhập hệ thống</h2>
	<form action="<?php echo APP_URL; ?>libs/checklog.php" method="POST">
		<p class="inputBlock">
		<input type="text" name="username" class="inputForm" placeholder="Username hoặc mobile" />
		</p>
		<p class="inputBlock">
		<input type="password" name="password" class="inputForm" placeholder="Password" />
		</p>
		<input class="btnSubmit" type="submit" name="submit" value="Đăng nhập">
	</form>
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