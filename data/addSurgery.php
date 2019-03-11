<?php
include($_SERVER["DOCUMENT_ROOT"] . "/projects/klain/app_config.php");
include(APP_PATH."admin/wp-load.php");

    if($_POST['action']=='create') {

        $count=file_get_contents(APP_PATH."data/sur_no.txt");
        $file=fopen(APP_PATH."data/sur_no.txt","w");
        $down=$count+1;
        fwrite($file,$down);
        $idsurgery = 'SUR_'.date("Y").'_'.date("m").'_'.$count;
        // create id

        $fullname = $_POST['fullname'];
        $mobile = $_POST['mobile'];
        $cusId_post = $_POST['cusid_post'];


        $advise = $_POST['advise'];
        $adviser = $_POST['adviser'];
        $channel = $_POST['channel'];
        $date = $_POST['datechose'];
        $time = strtotime($_POST['datechose']);
        $hasSur = $_POST['hasSur'];


        if($hasSur=='yes') {
            $detail_history = '
            Chi tiết ca phẫu thuật trước<br>
            <strong>Phương pháp thực hiện:</strong>'.$_POST['howto'].'<br>
            <strong>Bác sĩ:</strong>'.$_POST['doctorOld'].'<br>
            <strong>Tình trạng:</strong>'.$_POST['statusOld'].'<br>
            <br>
            <strong>Thời điểm phẫu thuật:</strong><br>
            '.$_POST['oldtime'].'<br>
            <strong>Lý do làm lại:</strong>'.$_POST['reason'].'<br>
            ';
        }
        
        $self_status = $_POST['self_status'];

        
        $target ='';
        if($_POST['size_nguc']!='') {
            $target .='
            Dịch vụ ngực:<br>
            kích thước:'.$_POST['size_nguc'].'<br>
            ';
        }

        if($_POST['shape']!='') {
            $target .='
            Dáng ngực:'.$_POST['shape'].'<br>
            ';
        }

        if($_POST['styleT']!='') {
            $target .='
            Loại túi:'.$_POST['styleT'].'<br>
            ';
        }

        if($_POST['plus']!='') {
            $target .='
            Loại túi:'.$_POST['plus'].'<br>
            ';
        }

        if($_POST['size_mong']!='') {
            $target .='
            Dịch vụ mông:<br>
            kích thước:'.$_POST['size_mong'].'<br>
            ';
        }

        if($_POST['styleT1']!='') {
            $target .='
            Loại túi:'.$_POST['styleT1'].'<br>
            ';
        }

        if($_POST['stomach']!='') {
            $target .='
            Dịch vụ hút mỡ bụng:<br>
            Vị trí:'.$_POST['stomach'].'<br>
            ';
        }

        if($_POST['shape_hm']!='') {
            $target .='
            Tạo hình bụng:'.$_POST['shape_hm'].'<br>
            ';
        }
        
        if($_POST['arm']!='') {
            $target .='
            Dịch vụ hút mỡ bắp tay:<br>
            '.$_POST['arm'].'<br>
            ';
        }

        if($_POST['thighs']!='') {
            $target .='
            Dịch vụ hút mỡ đùi:<br>
            '.$_POST['thighs'].'<br>
            ';
        }

        if($_POST['origin']!='') {
            $target .='
            Cấu trúc nguyên thuỷ:<br>
            '.$_POST['origin'].'<br>
            ';
        }
        
        if($_POST['target']!='') {
            $target .='
            Mong muốn của khách hàng:<br>
            '.$_POST['target'].'<br>
            '.$_POST['target_text'].'<br>
            ';
        }

        $caution = $_POST['caution'];
        $doctor_advise = $_POST['doctor_advise'];
        $cus_note = $_POST['cus_note'];


        $services = $_POST['services'];
        $service_2 = $_POST['services_2'];
        $service_3 = $_POST['services_3'];
        
        $price=(int)$_POST['price'];
        $price_2=(int)$_POST['price_2'];
        $price_3=(int)$_POST['price_3'];

        $discount=$_POST['sale_discount'];
        $discount_2=$_POST['sale_discount_2'];
        $discount_3=$_POST['sale_discount_3'];


        
        $numb_image = $_POST['numb_image'];
        if($_POST['submit']!='') {
            $status = $_POST['status'];
        } else {
            $status = 'pending';
        }

        $customer_post = array(
            'post_title'    => $idsurgery,
            'post_status'   => 'publish',
            'post_type' => 'surgery',
        );
        $pid = wp_insert_post($customer_post);
        add_post_meta($pid, 'fullname', $fullname);
        add_post_meta($pid, 'mobile', $mobile);
        add_post_meta($pid, 'cusid_post', $cusId_post);
        add_post_meta($pid, 'advise', $advise);
        add_post_meta($pid, 'adviser', $adviser);
        add_post_meta($pid, 'channel', $channel);
        add_post_meta($pid, 'services', $services);
        add_post_meta($pid, 'services_2', $service_2);
        add_post_meta($pid, 'services_3', $services_3);
        add_post_meta($pid, 'date', $date);
        add_post_meta($pid, 'time', $time);
        add_post_meta($pid, 'hasSur', $hasSur);
        add_post_meta($pid, 'detail_history', $detail_history);
        add_post_meta($pid, 'self_status', $self_status);
        add_post_meta($pid, 'caution', $caution);
        add_post_meta($pid, 'target', $target);
        add_post_meta($pid, 'target', $target);
        add_post_meta($pid, 'doctor_advise', $doctor_advise);
        add_post_meta($pid, 'cus_note', $cus_note);
        add_post_meta($pid, 'status', $status);
        add_post_meta($pid, 'price', $price);
        add_post_meta($pid, 'price', $price);
        add_post_meta($pid, 'price_2', $price_2);
        add_post_meta($pid, 'price_3', $price_3);
        add_post_meta($pid, 'sale_discount', $discount);
        add_post_meta($pid, 'sale_discount_2', $discount_2);
        add_post_meta($pid, 'sale_discount_3', $discount_3);
        add_post_meta($pid, 'numb_image', $numb_image);

        header('Location:'.APP_URL.'surgery');
    }
?>