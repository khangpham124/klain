<?php
include($_SERVER["DOCUMENT_ROOT"] . "/app_config.php");
include(APP_PATH."admin/wp-load.php");
include($_SERVER["DOCUMENT_ROOT"].'/Net/SFTP.php');
$idPost=$_POST['idPost'];
if($_POST['action']=='edit') {
    $fullname = $_POST['fullname'];
    $idcard = $_POST['idcard'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];


    $advise_f = $_POST['advise_f'];
    if($advise_f!='') {
        $timeline_now = get_field('timeline',$idPost);
        $date_adv = date('d-m-Y');
        $adviser = $_COOKIE['name_cookies'];
        $content = $_POST['advise_f'];
        $channel = $_POST['channel'];

        $timeline_now[] = array(
            'date' => $date_adv,
            'content' => $content,
            'channel' => $channel,
            'adviser' => $adviser,
        );
        update_field('timeline', $timeline_now, $idPost);
    }
    
    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $birth = $day.'-'.$month.'-'.$year;

    $cus_update = array(
        'post_title'    => $fullname,
        'ID'         => $idPost,
    );
    wp_update_post( $cus_update );
    update_post_meta($idPost,'idcard',$idcard);
    update_post_meta($idPost,'mobile',$mobile);
    update_post_meta($idPost,'address',$address);
    update_post_meta($idPost, 'birthday', $birth);

    $customer_id = get_field('idcustomer',$idPost);

    $sftp = new Net_SFTP($sftpServer);
    if ($sftp->login($sftpUsername, $sftpPassword)){
        if($_FILES["file1"]["name"]!="") {
            
                $parts1=pathinfo($_FILES["file1"]["name"]);
                $ext1=".".strtolower($parts1["extension"]);	
                $filename = strtolower($parts1["filename"]);
                $custom_name = $customer_id.'_front';            
                $attach_file = $custom_name.$ext1;
                $sftp->put(
                    APP_PATH_UPLOAD."customer/".$attach_file, file_get_contents($_FILES["file1"]["tmp_name"])
                );
                $linkFile_front= APP_IMG."customer/".$attach_file;
                update_post_meta($idPost, 'ic_front', $linkFile_front);            
        }
        if($_FILES["file2"]["name"]!="") {
            $parts1=pathinfo($_FILES["file2"]["name"]);
            $ext1=".".strtolower($parts1["extension"]);	
            $filename = strtolower($parts1["filename"]);
            $custom_name = $customer_id.'_back';
            $attach_file = $custom_name.$ext1;
            $sftp->put(
                APP_PATH_UPLOAD."customer/".$attach_file, file_get_contents($_FILES["file2"]["tmp_name"])
            );
            $linkFile_back=APP_IMG."customer/".$attach_file;
            update_post_meta($idPost, 'ic_back', $linkFile_back);
        }
    }

    header('Location:'.APP_URL.'customers');
}


?>