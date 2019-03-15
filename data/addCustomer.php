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
        $content = $_POST['advise_f'];
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

        add_post_meta($pid, 'timeline', 1, true);
        $sub_field_name1 = 'timeline'.'_0_'.'date';
        $sub_field_name2 = 'timeline'.'_0_'.'content';
        $sub_field_name3 = 'timeline'.'_0_'.'adviser';
        update_post_meta($pid, $sub_field_name1, 'test', true);
        update_post_meta($pid, $sub_field_name2, $content, true);
        update_post_meta($pid, $sub_field_name3, $creator, true);

        
        header('Location:'.APP_URL.'customers');
    }
?>