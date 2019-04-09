<?php
include($_SERVER["DOCUMENT_ROOT"] . "/app_config.php");
include(APP_PATH."admin/wp-load.php");

$id_sur = $_GET['idSurgery'];
$change_stt = $_GET['change'];

$reason_cancel = $_POST['reason_cancel'];

update_post_meta($id_sur,'status',$change_stt);

if($change_stt=='huy') {
    update_post_meta($id_sur,'reason_cancel',$reason_cancel);
}
header('Location:'.APP_URL.'surgery');
?>