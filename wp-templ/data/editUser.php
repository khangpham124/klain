<?php
include($_SERVER["DOCUMENT_ROOT"] . "/app_config.php");
include(APP_PATH."admin/wp-load.php");
require_once( APP_PATH . 'admin/wp-admin/includes/image.php' );
require_once( APP_PATH . 'admin/wp-admin/includes/file.php' );
require_once( APP_PATH . 'admin/wp-admin/includes/media.php' );
if($_POST['action']=='update') {
    $fullname = $_POST['fullname'];
    $mobile = str_replace(' ','',$_POST['mobile']);
    $password = $_POST['password'];
    $pid = $_POST['postid'];
    
    update_post_meta($pid,'fullname',$fullname);
    add_post_meta($pid, 'password', md5($password));
    $attach_id = media_handle_upload('file', $pid);
    if (is_numeric($attach_id)) {
        update_option('option_image', $attach_id);
        update_post_meta($pid, '_my_file_upload', $attach_id);
    }
    update_post_meta($pid,'_thumbnail_id',$attach_id);
    set_post_thumbnail( $pid, $thumbnail_id );
    header('Location:'.APP_URL.'users');
}
?>