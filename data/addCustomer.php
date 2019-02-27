<?php
include($_SERVER["DOCUMENT_ROOT"] . "/projects/klain/app_config.php");
include(APP_PATH."admin/wp-load.php");
    if($_POST['action']=='create') {
        // $idcustomer = 'KLAIN_'.rand(10,100);
        $fullname = $_POST['fullname'];
        $idcard = $_POST['idcard'];
        $mobile = str_replace(' ','',$_POST['mobile']);
        $facebook = $_POST['facebook'];
        $address = $_POST['address'];
        $creator = $_POST['creator'];
        $day = $_POST['day'];
        $month = $_POST['month'];
        $year = $_POST['year'];
        $birth = $day.'-'.$month.'-'.$day;
        
        $customer_post = array(
            'post_title'    => $fullname,
            'post_status'   => 'publish',
            'post_type' => 'customers',
        );
        $pid = wp_insert_post($customer_post); 
        add_post_meta($pid, 'fullname', $fullname);
        add_post_meta($pid, 'idcard', $idcard);
        add_post_meta($pid, 'mobile', $mobile);
        add_post_meta($pid, 'facebook', $facebook);
        add_post_meta($pid, 'address', $address);
        add_post_meta($pid, 'birthday', $birth);
        add_post_meta($pid, 'creator', $creator);
        header('Location:'.APP_URL.'customers');
    }
?>