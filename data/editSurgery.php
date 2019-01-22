<?php
include($_SERVER["DOCUMENT_ROOT"] . "/projects/klain/app_config.php");
include(APP_PATH."admin/wp-load.php");
require_once( APP_PATH . 'admin/wp-admin/includes/image.php' );
require_once( APP_PATH . 'admin/wp-admin/includes/file.php' );
require_once( APP_PATH . 'admin/wp-admin/includes/media.php' );

$pid = $_POST['idSurgery'];
    if($_POST['action']=='edit') {
        

        $accept = $_POST['accept'];
        $approve = $_POST['approve'];
        $price_sale = $_POST['price_sale'];
        update_post_meta($pid,'accept',$accept);
        update_post_meta($pid,'approve',$approve);
        update_post_meta($pid,'sale_discount',$price_sale);

        if($accept!=''){
            $idCustomer = $_POST['idCustomer'];
            $cusId_post = $_POST['cusId_post'];
            update_post_meta($cusId_post, 'idcustomer', $idCustomer);



            $status = $_POST['status'];
            $methodPay = $_POST['methodPay'];
            $statusPay = $_POST['statusPay'];
            $deposit = $_POST['deposit'];
            $payDetail ='
            <strong>Phương thức thanh toán:</strong>'.$_POST['methodPay'].'<br>
            <strong>Tình trạng thanh toán:</strong>'.$_POST['statusPay'].'<br>
            ';

            if($_POST['deposit']!='') {
                $payDetail .='
                Số tiền cọc:'.$_POST['deposit'].'<br>
                ';
            }
            update_post_meta($pid,'payment_status',$statusPay);
            update_post_meta($pid,'payment_detail',$payDetail);
            update_post_meta($pid,'status',$status);
        }
        header('Location:'.APP_URL.'surgery');
    }

    if($_POST['action']=='edit_bsnk') {
        $status = $_POST['status'];
        

        update_post_meta($pid,'status',$status);

        //UPLOAD IMAGEIMAGE
        $numb_image = $_POST['numb_image'];
        for($i=0;$i<=$numb_image;$i++) {
            ${'attach_id'.$i} = media_handle_upload('file'.$i, $pid);
            update_option('option_image', ${'attach_id'.$i});
            update_post_meta($pid, '_my_file_upload', ${'attach_id'.$i});
            update_post_meta($pid,'image_before',${'attach_id'.$i});
            ${'sub_field_name'.$i} = 'image_before'.'_'.$i.'_'.'img';
            var_dump(${'attach_id'.$i});
            
            update_field($pid, ${'sub_field_name'.$i}, wp_get_attachment_image_src(${'attach_id'.$i}) , false);
        }
    }

    if($_POST['action']=='edit_bsk') {
        $status = $_POST['status'];
        update_post_meta($pid,'status',$status);
        header('Location:'.APP_URL.'surgery');
    }

    if($_POST['action']=='ekip_create') {
        $room = $_POST['room'];
        $time_room = date('Ymd_Hi');
        $idRoom = 'RM_'.$room.'_'.$time_room;
        update_post_meta($pid,'status',$status);
        update_post_meta($pid,'ekip',$idRoom);


        $doctor1 = $_POST['doctor1'];
        $doctor2 = $_POST['doctor2'];
        $nursing1 = $_POST['nursing1'];
        $nursing2 = $_POST['nursing1'];
        $nursing3 = $_POST['nursing1'];
        $nursing4 = $_POST['nursing1'];
        $nursing5 = $_POST['nursing1'];
        $ktv = $_POST['ktv'];
        $input = $_POST['input'];

        $room_post = array(
            'post_title'    => $idRoom,
            'post_status'   => 'publish',
            'post_type' => 'ekip',
        );
        $pid_ekip = wp_insert_post($room_post); 
        add_post_meta($pid_ekip, 'doctor1', $doctor1);
        add_post_meta($pid_ekip, 'doctor1', $doctor2);
        add_post_meta($pid_ekip, 'nursing1', $nursing1);
        add_post_meta($pid_ekip, 'nursing2', $nursing2);
        add_post_meta($pid_ekip, 'nursing3', $nursing3);
        add_post_meta($pid_ekip, 'nursing4', $nursing4);
        add_post_meta($pid_ekip, 'nursing5', $nursing5);
        add_post_meta($pid_ekip, 'ktv', $ktv);
        add_post_meta($pid_ekip, 'input', $input);
        add_post_meta($pid_ekip, 'room', $room);
        header('Location:'.APP_URL.'surgery');
    }

    if($_POST['action']=='ekip_create') {
        $list_supplies = get_posts(array(
            'numberposts' => -1,
            'post_type' => 'supplies',
            ));
        $supplies = Array();    
        $numb_supplies = count($list_supplies);
        for($u=0;$u<=$numb_supplies;$u++) {
            ${'supply_'.$u} = $_POST['supplies'.$u];
            $supplies[] = ${'supply_'.$u};
        }
        var_dump($supplies);
        update_post_meta($pid,'supplies',$supplies);
        $status = $_POST['status'];
        $report = $_POST['report'];
        update_post_meta($pid,'status',$status);
        update_post_meta($pid,'report',$status);
        
        header('Location:'.APP_URL.'surgery');
    }

?>