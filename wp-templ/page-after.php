<?php /* Template Name: After Surgery */ ?>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/projects/klain/app_config.php");
// include(APP_PATH."libs/checklog.php");
if(!$_COOKIE['login_cookies']) {    
	header('Location:'.APP_URL.'login');
}
include(APP_PATH."libs/head.php"); 
?>
<link type="text/css" rel="stylesheet" href="<?php echo APP_URL; ?>checkform/exvalidation.css" />
</head>

<body id="top">
<div class="flexBox flexBox--between flexBox--wrap">
    <?php include(APP_PATH."libs/sidebar.php"); ?>
<div id="wrapper">
<!--===================================================-->
<!--Header-->
<?php include(APP_PATH."libs/header.php"); ?>
<!--/Header-->

<div class="flexBox flexBox--between textBox flexBox--wrap maxW">
    <div class="blockPage blockPage--full">
        <h2 class="h2_page">Thông tin hậu phẫu</h2>
            <form action="<?php echo APP_URL; ?>data/editSurgery.php" method="post" enctype="multipart/form-data" id="addServices">
            <h3 class="h3_page">Tường trình phẫu thuật</h3>
            <div class="flexBox flexBox--between flexBox__form flexBox__form--3">
                <textarea class="inputForm" name="report" id="report"></textarea>
            </div>

            <h3 class="h3_page">Vật tư sử dụng</h3>
            <table class="tblPage">
                <thead>
                    <tr>
                        <td>Vật tư</td>
                        <td>Đơn vị</td>
                        <td>Số lượng</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $n=0;
                        $wp_query = new WP_Query();
                        $param=array(
                        'post_type'=>'supplies',
                        'order' => 'DESC',
                        'posts_per_page' => '-1',
                        );
                        $wp_query->query($param);
                        if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                        $n++;
                    ?>
                    <tr>
                        <td><?php the_title(); ?></td>
                        <td>Cái</td>
                        <td>
                        <p class="inputBlock customSelect">
                        <select name="supplies<?php echo $n; ?>">
                            <?php for($i=0;$i<=10;$i++) { ?>
                            <option value="<?php the_title(); ?>-<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php } ?>
                        </select>
                        </p>
                        </td>
                    </tr>
                    <?php endwhile;endif; ?>
                </tbody>
            </table>
            <input type="hidden" name="idSurgery" value="<?php echo $_GET['idSurgery']; ?>" >
            <input type="hidden" name="action" value="ekip_report" >
            <input type="hidden" name="status" value="hauphau" >
            <input class="btnSubmit" type="submit" name="submit" value="Hoàn tất">
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
            doctor1: "chkselect",
            doctor2: "chkselect",
            nursing1:"chkselect",
            nursing2:"chkselect",
            nursing3:"chkselect",
            nursing4:"chkselect",
            ktv:"chkselect",
            room:"chkselect",
	    },
	    stepValidation: true,
	    scrollToErr: true,
	    errHoverHide: true
	  });
    });
</script>

</body>
</html>	