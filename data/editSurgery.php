<?php
include($_SERVER["DOCUMENT_ROOT"] . "/projects/klain/app_config.php");
include(APP_PATH."admin/wp-load.php");
    if($_POST['action']=='edit') {
        

        $accept = $_POST['accept'];
        $approve = $_POST['approve'];
        $price_sale = $_POST['price_sale'];
        $pid = $_POST['idSurgery'];
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
?>