<?php
include($_SERVER["DOCUMENT_ROOT"] . "/projects/klain/app_config.php");
include(APP_PATH."admin/wp-load.php");
require_once( APP_PATH . 'admin/wp-admin/includes/image.php' );
require_once( APP_PATH . 'admin/wp-admin/includes/file.php' );
require_once( APP_PATH . 'admin/wp-admin/includes/media.php' );
if($_POST['action']=='create') {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $mobile = str_replace(' ','',$_POST['mobile']);
    $cate = $_POST['position'];
    $id_user = 'USR'.rand(10,100);
    $category = get_category_by_slug($_POST['position']);
    
    $user_post = array(
        'post_title'    => $username,
        'post_status'   => 'publish',
        'post_type' => 'users',
    );
    $pid = wp_insert_post($user_post); 
    wp_set_object_terms( $pid, $cate, 'userscat' );
    add_post_meta($pid, 'fullname', $fullname);
    add_post_meta($pid, 'password', md5('123456'));
    add_post_meta($pid, 'mobile', $mobile);
    add_post_meta($pid, 'id_user', $id_user);
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