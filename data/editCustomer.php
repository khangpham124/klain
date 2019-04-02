<?php
include($_SERVER["DOCUMENT_ROOT"] . "/app_config.php");
include(APP_PATH."admin/wp-load.php");

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

        $timeline_now[] = array(
            'date' => $date_adv,
            'content' => $content,
            'adviser' => $adviser,
        );
        update_field('timeline', $timeline_now, $idPost);
    }
    
    $cus_update = array(
        'post_title'    => $fullname,
        'ID'         => $idPost,
    );
    wp_update_post( $cus_update );
    update_post_meta($idPost,'idcard',$idcard);
    update_post_meta($idPost,'mobile',$mobile);
    update_post_meta($idPost,'address',$address);

    $customer_id = get_field('idcustomer',$idPost);
    if($_FILES["file1"]["name"]!="") {
        $parts1=pathinfo($_FILES["file1"]["name"]);
        $ext1=".".strtolower($parts1["extension"]);	
        $filename = strtolower($parts1["filename"]);
        $custom_name = $customer_id.'_front';
        
        $attach_file = $custom_name.$ext1;
        move_uploaded_file($_FILES["file1"]["tmp_name"],$_SERVER['DOCUMENT_ROOT']."/data/uploads/customers/".$attach_file);
        $linkFile_front="http://$_SERVER[HTTP_HOST]/data/uploads/customers/".$attach_file;
        update_post_meta($idPost, 'ic_front', $linkFile_front);
    }
    if($_FILES["file2"]["name"]!="") {
        $parts1=pathinfo($_FILES["file2"]["name"]);
        $ext1=".".strtolower($parts1["extension"]);	
        $filename = strtolower($parts1["filename"]);
        $custom_name = $customer_id.'_back';
        
        $attach_file = $custom_name.$ext1;
        move_uploaded_file($_FILES["file2"]["tmp_name"],$_SERVER['DOCUMENT_ROOT']."/data/uploads/customers/".$attach_file);
        $linkFile_back="http://$_SERVER[HTTP_HOST]/data/uploads/customers/".$attach_file;
        update_post_meta($idPost, 'ic_back', $linkFile_back);
    }

    header('Location:'.APP_URL.'customers');
}


?>