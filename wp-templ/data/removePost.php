<?php
include($_SERVER["DOCUMENT_ROOT"] . "/app_config.php");
include(APP_PATH."admin/wp-load.php");

$id_sur = $_GET['idSurgery'];
$redirect = $_GET['page'];
wp_update_post(array('ID' => $id_sur, 'post_status'   =>  'draft'));
header('Location:'.APP_URL.'/'.$redirect);
?>