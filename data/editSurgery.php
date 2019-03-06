<?php
include($_SERVER["DOCUMENT_ROOT"] . "/projects/klain/app_config.php");
include(APP_PATH."admin/wp-load.php");
require_once( APP_PATH . 'admin/wp-admin/includes/image.php' );
require_once( APP_PATH . 'admin/wp-admin/includes/file.php' );
require_once( APP_PATH . 'admin/wp-admin/includes/media.php' );

    $pid = $_POST['idSurgery'];
    
    if($_POST['action']=='edit_info') {
        $doctor_advise = $_POST['doctor_advise'];
        $doctor_advise .='<br>Chỉnh sửa lần cuối:'.$_POST['name_edit'];
    
        if($_POST['status']) {
            $status = $_POST['status'];
            update_post_meta($pid,'status',$status);
        }
        update_post_meta($pid,'doctor_advise',$doctor_advise);
        header('Location:'.APP_URL);
    }

    if($_POST['action']=='edit') {
        $accept = $_POST['accept'];
        $approve = $_POST['approve'];
        $price_sale = $_POST['price_sale'];
        update_post_meta($pid,'accept',$accept);
        update_post_meta($pid,'approve',$approve);
        update_post_meta($pid,'sale_discount',$price_sale);

            $idCustomer = $_POST['idCustomer'];
            $cusId_post = $_POST['cusId_post'];
            update_post_meta($cusId_post, 'idcustomer', $idCustomer);

            $status = $_POST['status'];
            $methodPay = $_POST['methodPay'];
            $infoPay = $_POST['infoPayment'];
            $statusPay = $_POST['statusPay'];
            $deposit = $_POST['deposit'];
            $payDetail ='
            <strong>Phương thức thanh toán:</strong>'.$methodPay.'<br>';
            if($_POST['deposit']!='') {
                $payDetail .='
                Số tiền cọc:'.$_POST['deposit'].'<br>
                ';
            }
            if($methodPay!='cash') {
                $payDetail .='
                <div>Phương thức thanh toán:</div>'.$infoPay;
            }
            update_post_meta($pid,'payment_status',$statusPay);
            update_post_meta($pid,'payment_detail',$payDetail);
            update_post_meta($pid,'status',$status);
    
        header('Location:'.APP_URL.'surgery');
    }

    if($_POST['action']=='edit_bsnk') {
        $status = $_POST['status'];
        $bsnk = $_POST['bsnk'];
        
        update_post_meta($pid,'bsnk_name',$bsnk);
        update_post_meta($pid,'status',$status);

        //UPLOAD IMAGEIMAGE
        // $numb_image = $_POST['numb_image'];
        // for($i=0;$i<=$numb_image;$i++) {
        //     ${'attach_id'.$i} = media_handle_upload('file'.$i, $pid);
        //     update_option('option_image', ${'attach_id'.$i});
        //     update_post_meta($pid, '_my_file_upload', ${'attach_id'.$i});
        //     update_post_meta($pid,'image_before',${'attach_id'.$i});
        //     ${'sub_field_name'.$i} = 'image_before'.'_'.$i.'_'.'img';
        //     var_dump(${'attach_id'.$i});
            
        //     update_field($pid, ${'sub_field_name'.$i}, wp_get_attachment_image_src(${'attach_id'.$i}) , false);
        // }
        header('Location:'.APP_URL.'surgery');
    }

    if($_POST['action']=='edit_bsk') {
        $status = $_POST['status'];
        update_post_meta($pid,'status',$status);
        header('Location:'.APP_URL.'surgery');
    }

    if($_POST['action']=='ekip_create') {
        $room = $_POST['room'];
        $status = $_POST['status'];
        $time_room = date('Ymd_Hi');
        $idRoom = 'RM_'.$room.'_'.$time_room;
        update_post_meta($pid,'status',$status);
        update_post_meta($pid,'ekip',$idRoom);


        $reg_dr = $_POST['check01'];
        $reg_mc = $_POST['check02'];
        $reg_pm = $_POST['check03'];
        $reg_ktv = $_POST['check04'];

        $doctor1 = "";
        for($i=0; $i < count($reg_dr); $i++)
        {
            $doctor1 .= $reg_dr[$i]."<br>";
        }
        if($doctor1 != "") $doctor1 = substr($doctor1,0,strlen($string)-2);
        
        echo $doctor1;
        $room_post = array(
            'post_title'    => $idRoom,
            'post_status'   => 'publish',
            'post_type' => 'ekip',
        );
        $pid_ekip = wp_insert_post($room_post);
        add_post_meta($pid_ekip, 'doctor1', $doctor1);
        add_post_meta($pid_ekip, 'nursing1', $nursing1);
        add_post_meta($pid_ekip, 'nursing2', $nursing2);
        add_post_meta($pid_ekip, 'nursing3', $nursing3);
        add_post_meta($pid_ekip, 'nursing4', $nursing4);
        add_post_meta($pid_ekip, 'nursing5', $nursing5);
        add_post_meta($pid_ekip, 'ktv', $ktv);
        add_post_meta($pid_ekip, 'input', $input);
        add_post_meta($pid_ekip, 'room', $room);
        
        //header('Location:'.APP_URL.'surgery');
    }

    if($_POST['action']=='ekip_report') {
        $list_supplies = get_posts(array(
            'numberposts' => -1,
            'post_type' => 'supplies',
            ));
        //$supplies = Array();    
        $numb_supplies = count($list_supplies);
        for($u=0;$u<=$numb_supplies;$u++) {
            ${'supply_'.$u} = $_POST['supplies'.$u];
            $supplies .= ${'supply_'.$u}.'<br>';
        }
        update_post_meta($pid,'supplies',$supplies);
        $status = $_POST['status'];
        $report = $_POST['report'];
        update_post_meta($pid,'status',$status);
        update_post_meta($pid,'report',$report);
        
       header('Location:'.APP_URL.'surgery');
    }

    if($_POST['action']=='cskh_edit') {
        $status = $_POST['status'];
        $name_cskh = $_POST['name_cskh'];
        
        update_post_meta($pid,'status',$status);

        $stt1 = $_POST['after_surgery'];
        $message1 = $_POST['message_1'];
        $voice1 = $_POST['custommer_voice_1'];
        $rate1 = $_POST['rating_1'];
        $rate1 = $_POST['rating_1'];
        update_post_meta($pid,'status_1',$stt1);
        update_post_meta($pid,'message_1',$message1);
        update_post_meta($pid,'custommer_voice_1',$voice1);
        update_post_meta($pid,'rating_1',$rate1);
        

        $stt2 = $_POST['after_1day'];
        $message2 = $_POST['message_2'];
        $voice2 = $_POST['custommer_voice_2'];
        $rate2 = $_POST['rating_2'];
        update_post_meta($pid,'status_2',$stt2);
        update_post_meta($pid,'message_2',$message2);
        update_post_meta($pid,'custommer_voice_2',$voice2);
        update_post_meta($pid,'rating_2',$rate2);

        $stt3 = $_POST['after_5day'];
        $message3 = $_POST['message_3'];
        $voice3 = $_POST['custommer_voice_3'];
        $rate3 = $_POST['rating_3'];
        update_post_meta($pid,'status_3',$stt3);
        update_post_meta($pid,'message_3',$message3);
        update_post_meta($pid,'custommer_voice_3',$voice3);
        update_post_meta($pid,'rating_3',$rate3);

        $stt4 = $_POST['after_10day'];
        $message4 = $_POST['message_4'];
        $voice4 = $_POST['custommer_voice_4'];
        $rate4 = $_POST['rating_4'];
        update_post_meta($pid,'status_4',$stt4);
        update_post_meta($pid,'message_4',$message4);
        update_post_meta($pid,'custommer_voice_4',$voice4);
        update_post_meta($pid,'rating_4',$rate4);

        $stt5 = $_POST['after_1month'];
        $message5 = $_POST['message_5'];
        $voice5 = $_POST['custommer_voice_5'];
        $rate5 = $_POST['rating_5'];
        update_post_meta($pid,'status_5',$stt5);
        update_post_meta($pid,'message_5',$message5);
        update_post_meta($pid,'custommer_voice_5',$voice5);
        update_post_meta($pid,'rating_5',$rate5);
        header('Location:'.APP_URL.'surgery');
    }

?>