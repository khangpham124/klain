<?php
include($_SERVER["DOCUMENT_ROOT"] . "/app_config.php");
include(APP_PATH."admin/wp-load.php");

$id_sur = $_GET['idSurgery'];
$change_stt = $_GET['change'];

$id_sur_post = $_POST['idSurgery'];
$change =$_POST['change'];
$reason_cancel = $_POST['reason_cancel'];
if($change_stt!='') {
    update_post_meta($id_sur,'status',$change_stt);
} else {
    update_post_meta($id_sur_post,'status',$change);
}

if($change=='huy') {
    update_post_meta($id_sur_post,'reason_cancel',$reason_cancel);
}
header('Location:'.APP_URL.'surgery');
?>