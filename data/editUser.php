<?php
include($_SERVER["DOCUMENT_ROOT"] . "/app_config.php");
include(APP_PATH."admin/wp-load.php");
include($_SERVER["DOCUMENT_ROOT"].'/Net/SFTP.php');
$sftp = new Net_SFTP($sftpServer);
if($_POST['action']=='update') {
    $fullname = $_POST['fullname'];
    $mobile = str_replace(' ','',$_POST['mobile']);
    $password = $_POST['password'];
    $pid = $_POST['postid'];
    
    update_post_meta($pid,'fullname',$fullname);
    add_post_meta($pid, 'password', md5($password));

    if ($sftp->login($sftpUsername, $sftpPassword)){
        if($_FILES["file"]["name"]!="") {
            $parts1=pathinfo($_FILES["file"]["name"]);
            $ext1=".".strtolower($parts1["extension"]);	
            $filename = strtolower($parts1["filename"]);
            $attach_file = $filename.$ext1;
            $sftp->put(
                APP_PATH_UPLOAD."user/".$attach_file, file_get_contents($_FILES["file"]["tmp_name"])
            );
            $avatar= APP_IMG."user/".$attach_file;
            update_post_meta($pid, 'avatar', $avatar);
        }
    }
    header('Location:'.$_POST['url']);
}
?>