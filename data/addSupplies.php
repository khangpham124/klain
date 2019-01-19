<?php
include($_SERVER["DOCUMENT_ROOT"] . "/projects/klain/app_config.php");
include(APP_PATH."admin/wp-load.php");
if($_POST['action']!='') {
    $name = $_POST['name'];
    $unit = $_POST['unit'];
    $user_post = array(
        'post_title'    => $name,
        'post_status'   => 'publish',
        'post_type' => 'supplies',
    );
    $pid = wp_insert_post($user_post); 
    add_post_meta($pid, 'unit', $unit);
    header('Location:'.APP_URL.'supplies');
}
?>