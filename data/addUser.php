<?php
include($_SERVER["DOCUMENT_ROOT"] . "/app_config.php");
include(APP_PATH."admin/wp-load.php");
include($_SERVER["DOCUMENT_ROOT"].'/Net/SFTP.php');
$sftp = new Net_SFTP($sftpServer);
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

    if ($sftp->login($sftpUsername, $sftpPassword)){
        if($_FILES["file"]["name"]!="") {
            $parts1=pathinfo($_FILES["file"]["name"]);
            $ext1=".".strtolower($parts1["extension"]);	
            $filename = strtolower($parts1["filename"]);
            $custom_name = $customer_id.'_front';
            $attach_file = $custom_name.$ext1;
            $sftp->put(
                APP_PATH_UPLOAD."user/".$attach_file, file_get_contents($_FILES["file"]["tmp_name"])
            );
            $avatar= APP_IMG."user/".$attach_file;
            add_post_meta($pid, 'avatar', $avatar);
        } else {
            $thumbnail_id = APP_URL.'img/top/favicon.png';
            add_post_meta($pid, 'avatar', $thumbnail_id);
        }
    }
    header('Location:'.APP_URL.'users');
}
?>