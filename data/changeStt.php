<?php
include($_SERVER["DOCUMENT_ROOT"] . "/projects/klain/app_config.php");
include(APP_PATH."admin/wp-load.php");

$id_sur = $_GET['idSurgery'];
$change_stt = $_GET['change'];
update_post_meta($id_sur,'status',$change_stt);
header('Location:'.APP_URL.'surgery');
?>