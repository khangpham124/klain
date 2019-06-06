<?php
include($_SERVER["DOCUMENT_ROOT"] . "/app_config.php");
include(APP_PATH."admin/wp-load.php");
include($_SERVER["DOCUMENT_ROOT"].'/Net/SFTP.php');
$sftp = new Net_SFTP($sftpServer);
$pid = $_POST['idSurgery'];

    // TEMP EKIP

    if($_POST['action']=='reFund') {
        $refundRs = $_POST['refundRs'];
        $refund = $_POST['refund'];
        $debt_date = $_POST['debt_date'];
        $debt_get = $_POST['debt_get'];
        $url = $_POST['url'];
        update_post_meta($pid,'refundRs',$refundRs);
        update_post_meta($pid,'numbrf',$refund);
        $list = get_field('treepay',$pid);
        if( have_rows('treepay',$pid)) {
            $treepay = array();
            foreach($list as $m => $v) {
                $treepay[] = array(
                    array(
                        $m => $v 
                    )
                );
            }
            $treepay[] = array(
                'money' => $refund,
                'date' => $debt_date,
                'name' => $debt_get,
                'note' => $refundRs,
            );
            update_field('treepay', $treepay, $pid);
        } else {
            $treepay = array();
            $treepay[] = array(
                'money' => $refund,
                'date' => $debt_date,
                'name' => $debt_get,
                'note' => $refundRs,
            );
            update_field('treepay', $treepay, $pid);
        }
        header('Location:'.$url);
    }

    if($_POST['action']=='paidDebt') {
        $debt_paid = $_POST['debt_paid'];
        $debt_date = $_POST['debt_date'];
        $debt_get = $_POST['debt_get'];
        $url = $_POST['url'];

        
        if(get_field('payment_status',$pid)=='Nợ') {
            $current_debt = get_field('debt',$pid);
            $current_remain = get_field('remain',$pid);
            $current_collect = get_field('collect',$pid);
            $remain_debt = $current_debt - $debt_paid;
            $new_reamin = $current_remain - $debt_paid;
            $new_collect = $current_collect + $debt_paid;

            update_post_meta($pid,'remain',$new_reamin);
            update_post_meta($pid,'collect',$new_collect);
            update_post_meta($pid,'debt',$remain_debt);
            if($remain_debt==0) {
                update_post_meta($pid,'payment_status','Thu đủ');
            }
        }

        if(get_field('payment_status',$pid)=='Đặt cọc') {
            $current_deposit = get_field('deposit',$pid);
            $current_remain = get_field('remain',$pid);
            $current_collect = get_field('collect',$pid);
            $new_reamin = $current_remain - $debt_paid;
            $new_deposit = $current_deposit + $debt_paid;
            $new_collect = $current_collect + $debt_paid;
            update_post_meta($pid,'deposit',$new_deposit);
            update_post_meta($pid,'remain',$new_reamin);
            update_post_meta($pid,'collect',$new_collect);
            if($new_reamin==0) {
                update_post_meta($pid,'payment_status','Thu đủ');
            }
        }
        
        update_post_meta($pid,'remain',$new_reamin);
        update_post_meta($pid,'remain_depo',$new_remain_depo);

        $list = get_field('treepay',$pid);
        if( have_rows('treepay',$pid)) {
            $treepay = array();
            foreach($list as $m => $v) {
                $treepay[] = array(
                    array(
                        $m => $v 
                    )
                );
            }
            $treepay[] = array(
                'money' => $debt_paid,
                'date' => $debt_date,
                'name' => $debt_get,
            );
            update_field('treepay', $treepay, $pid);
        } else {
            $treepay = array();
            $treepay[] = array(
                'money' => $debt_paid,
                'date' => $debt_date,
                'name' => $debt_get,
            );
            update_field('treepay', $treepay, $pid);
        }
        
        
        header('Location:'.$url);
    }

    if($_POST['action']=='edit_info') {
        // DR ADVISE
        $doctor_advise = $_POST['doctor_advise'];
        $url = $_POST['url'];
        $doctor_advise .='<br>Chỉnh sửa lần cuối:'.$_POST['name_edit'];
        if($_POST['status']) {
            echo $status = $_POST['status'];
            update_post_meta($pid,'status',$status);
        }
        update_post_meta($pid,'doctor_advise',$doctor_advise);
        header('Location:'.$url);
        // UPLOAD IMAGE
        if($_POST['upload']) {
            if ($sftp->login($sftpUsername, $sftpPassword)){
                $s=0;
                $listService = get_field('services_list',$pid);
                if (!$sftp->file_exists(APP_PATH_UPLOAD."surgery/".get_the_title($pid))) {
                    $sftp->mkdir(APP_PATH_UPLOAD."surgery/".get_the_title($pid), 0777, true);
                }
                foreach($listService as $serv) {
                    
                    $imgBefore = $serv['image_before'];
                    $imgAfter = $serv['image_after'];
                    $args = array("post_type" => "services", "s" => $serv['name']);
                    $query = get_posts( $args );
                    foreach ($query as $querys ) {
                        $ids = $querys->ID;
                    }
                    
                    $numb_image = get_field('numb_image',$ids);
                        for($i=0;$i<$numb_image;$i++) { 
                            // UPLOAD BEFORE
                            if($_FILES["file{$i}{$s}_before"]["name"]!="") {
                                $parts1=pathinfo($_FILES["file{$i}{$s}_before"]["name"]);
                                $ext1=".".strtolower($parts1["extension"]);	
                                $filename = strtolower($parts1["filename"]);
                                $img_name = $filename.'_'.$i.'_'.$s.'_before';
                                $attach_file = $img_name.$ext1;
                                $sftp->put(
                                    APP_PATH_UPLOAD."surgery/".get_the_title($pid)."/".$attach_file, file_get_contents($_FILES["file{$i}{$s}_before"]["tmp_name"])
                                );
                                $imgBefore .= $attach_file.',';
                            }
                            // UPLOAD AFTER    
                            if($_FILES["file{$i}{$s}_after"]["name"]!="") {
                                $parts1=pathinfo($_FILES["file{$i}{$s}_after"]["name"]);
                                $ext1=".".strtolower($parts1["extension"]);	
                                $filename = strtolower($parts1["filename"]);
                                $img_name = $filename.'_'.$i.'_'.$s.'_after';
                                $attach_file = $img_name.$ext1;
                                $sftp->put(
                                    APP_PATH_UPLOAD."surgery/".get_the_title($pid)."/".$attach_file, file_get_contents($_FILES["file{$i}{$s}_after"]["tmp_name"])
                                );
                                $imgAfter .= $attach_file.',';
                            }
                        }
                    
                    update_post_meta($pid, 'services_list'.'_'.$s.'_'.'image_before' ,$imgBefore, false);
                    update_post_meta($pid, 'services_list'.'_'.$s.'_'.'image_after' ,$imgAfter, false);
                    $s++;
                }
            }
            header('Location:'.$url.'?tab=6');
        }
        
    }

    if($_POST['action']=='wait_mng') {
        $debt = $_POST['debt'];
        $guy = $_POST['guy'];
        $url = $_POST['url'];
        update_post_meta($pid,'guy',$guy);
        update_post_meta($pid,'debt',$debt);
        header('Location:'.$url);
    }

    // COUNTER PART
    if($_POST['action']=='edit') {
        
        $cusid_post = $_POST['cusid_post'];
        if((get_field('idcustomer',$cusid_post))=='') {
            $count=file_get_contents(APP_PATH."data/cus_no.txt");
            $file=fopen(APP_PATH."data/cus_no.txt","w");
            $down=$count+1;
            fwrite($file,$down);
            $idCustomer = 'CUS_'.date("Y").'_'.date("m").'_'.$count;
            update_post_meta($cusid_post, 'idcustomer', $idCustomer);
            $my_post = array(
                'ID'           => $pid,
                'post_title'   => $idCustomer.'_'.get_the_title($pid),
            );
            wp_update_post( $my_post );
        }    

        $customer_id = get_field('idcustomer',$cusid_post);
        $my_post = array(
            'ID'           => $pid,
            'post_title'   => $customer_id.'_'.get_the_title($pid),
        );
        wp_update_post( $my_post );

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
                update_post_meta($cusid_post, 'ic_front', $linkFile_front);
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
                update_post_meta($cusid_post, 'ic_back', $linkFile_back);
            }
        }

        $fullname = $_POST['fullname'];
        $idcard = $_POST['idcard'];
        $mobile = $_POST['mobile'];
        $address = $_POST['address'];
        $day = $_POST['day'];
        $month = $_POST['month'];
        $year = $_POST['year'];
        $birth = $day.'-'.$month.'-'.$year;
        $cus_update = array(
            'post_title'    => $fullname,
            'ID'         => $cusid_post,
        );
        wp_update_post( $cus_update );
        update_post_meta($cusid_post,'idcard',$idcard);
        update_post_meta($cusid_post,'mobile',$mobile);
        update_post_meta($cusid_post,'address',$address);
        update_post_meta($cusid_post, 'birthday', $birth);
            
        
        $url = $_POST['url'];
        $accept = $_POST['accept'];
        $approve = $_POST['approve'];
        $sale_discount = $_POST['sale_discount'];
        $hide_tt_final = $_POST['hide_tt_final'];
        

        update_post_meta($pid,'accept',$accept);
        if(get_field('approve',$pid)=='') {
            update_post_meta($pid,'approve',$approve);
        }
        update_post_meta($pid,'sale_discount',$sale_discount);
        update_post_meta($pid,'total_final',$hide_tt_final);


        $status = $_POST['status'];
        $methodPay = $_POST['methodPay'];

        $cash_money = str_replace(array(',','.'),array('',''),$_POST['cash_money']);
        $bank_money = str_replace(array(',','.'),array('',''),$_POST['bank_money']);
        $visa_money = str_replace(array(',','.'),array('',''),$_POST['remavisa_moneyin']);

        $statusPay = $_POST['statusPay'];
        $deposit = $_POST['deposit'];
        $debt = $_POST['debt'];
        $debter = $_POST['debter'];
        $guy = $_POST['guy'];
        $collect = str_replace(array(',','.'),array('',''),$_POST['collect']);
        $remain = str_replace(array(',','.'),array('',''),$_POST['remain']);

        $nameBank = $_POST['nameBank'];

        if((get_field('approve2',$pid)=='')&&($debter=='yes')) {
            update_post_meta($pid,'approve2',$approve);
            update_post_meta($pid,'guy',$guy);
            update_post_meta($pid,'debt',$debt);
            update_post_meta($pid,'debter',$debter);
        }

        update_post_meta($pid,'deposit',$deposit);
        update_post_meta($pid,'cash_money',$cash_money);
        update_post_meta($pid,'bank_money',$bank_money);
        update_post_meta($pid,'visa_money',$visa_money);

        update_post_meta($pid,'chose_bank',$nameBank);
        update_post_meta($pid,'collect',$collect);
        update_post_meta($pid,'remain',$remain);
        update_post_meta($pid,'payment_status',$statusPay);
        update_post_meta($pid,'status',$status);
        $approve_cf = get_field('approve',$pid);
        if($approve_cf!='') {
            update_post_meta($pid,'process','yes');
        }
        $treepay = array();
            $treepay[] = array(
                'money' => $collect,
                'date' => $_POST['datePaid'],
                'name' => $_POST['counter'],
            );
            update_field('treepay', $treepay, $pid);
        header('Location:'.$url);
    }


// DOCTOR PART    
    if($_POST['action']=='edit_bsnk') {
        $reason = $_POST['reason_cancel'];
        if($reason!='') {
            $status = 'huy';
            update_post_meta($pid,'reason_cancel',$reason); 
        } else {
            $status = $_POST['status'];
            $idMedical = 'MED_'.get_the_title($pid);
            update_post_meta($pid,'idmedical',$idMedical);
            $medical_post = array(
                'post_title'    => $idMedical,
                'post_status'   => 'publish',
                'post_type' => 'medical',
            );
            $pid_med = wp_insert_post($medical_post);

            $bsnk = $_POST['bsnk'];
            add_post_meta($pid_med,'bsnk_name',$bsnk);

            for($i=0;$i<=96;$i++) {
                ${'f_'.$i} = $_POST["f_$i"];
            }
            $detail_med = '
            <table class="tblPage">
                            <tr>
                                <th>Quá trình bệnh lý</th>
                                <td><textarea class="inputForm" name="f_1" placeholder="">'.$_POST["f_1"].'</textarea></td>
                            </tr>
                            <tr>
                                <th>Dị ứng thuốc</th>
                                <td>
                                    <p class="inputBlock borderBox">'.$_POST["f_3"].'</p>
                                    <div class="inputBlock borderBox">'.$_POST["f_2"].'</dib>
                                </td>
                            </tr>
                            <tr>
                                <th>Dị ứng thức ăn</th>
                                <td>
                                    <p class="inputBlock borderBox">'.$_POST["f_5"].'</p>
                                    <div class="inputBlock borderBox">'.$_POST["f_4"].'</dib>
                                </td>
                            </tr>
                            <tr>
                                <th>Tiền căn nội khoa</th>
                                <td>
                                <textarea class="inputForm" name="f_6" placeholder="">'.$_POST["f_6"].'</textarea>
                                </td>
                            </tr>
                            <tr>
                                <th>Tiền căn ngoại khoa</th>
                                <td>
                                <textarea class="inputForm" name="f_7" placeholder="">'.$_POST["f_7"].'</textarea>
                                </td>
                            </tr>  
                            <tr>
                                <th>Kinh nguyệt</th>
                                <td>
                                <textarea class="inputForm" name="f_8" placeholder="">'.$_POST["f_8"].'</textarea>
                                </td>
                            </tr>   
                            <tr>
                                <th>Di truyền</th>
                                <td>
                                <textarea class="inputForm" name="f_9" placeholder="">'.$_POST["f_9"].'</textarea>
                                </td>
                            </tr>   
                            <tr>
                                <th>Đặc điểm liên quan bệnh</th>
                                <td>
                                '.$_POST["f_10"].'
                                </td>
                            </tr>                
                        </table>                
                    
                        <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                            <div class="inputBlock">
                                <h5 class="h5_page">Mạch</h5>
                                <input type="text" class="inputForm" name="f_11" value="'.$_POST["f_11"].'" placeholder="Mạch" />
                                <h5 class="h5_page">Nhiệt độ</h5>
                                <input type="text" class="inputForm" name="f_12" value="'.$_POST["f_12"].'" placeholder="Nhiệt độ" />
                                <h5 class="h5_page">Huyết áp</h5>
                                <input type="text" class="inputForm" name="f_13" value="'.$_POST["f_13"].'" placeholder="Huyết áp" />
                            </div>
                            <div class="inputBlock">
                                <h5 class="h5_page">Nhịp thở</h5>
                                <input type="text" class="inputForm" name="f_14" value="'.$_POST["f_14"].'" placeholder="Nhịp thở" />
                                <h5 class="h5_page">Cân nặng</h5>
                                <input type="text" class="inputForm" name="f_15" value="'.$_POST["f_15"].'" placeholder="Cân nặng" />
                            </div>
                        </div>

                        <h4 class="h4_page">Khám bệnh</h4>
                        <table class="tblPage">
                            <tr>
                                <th>Toàn thân</th>
                                <td><textarea class="inputForm" name="f_16" placeholder="">'.$_POST["f_16"].'</textarea></td>
                            </tr>
                            <tr>
                                <th>Bệnh ngoại khoa</th>
                                <td><textarea class="inputForm" name="f_17" placeholder="">'.$_POST["f_17"].'</textarea></td>
                            </tr>
                        </table>    
                        <div class="inputBlock">
                            <h4 class="h4_page">Các cơ quan</h4>
                            <div class="tabContent">
                            <ul class="tabItem tabItem--4 flexBox flexBox--center flexBox--wrap">
                                <li><a href="javascript:void(0)"  data-id="tab1">MŨI</a></li>
                            </ul>
                                <div class="tabBox" id="tab1">
                                    <table class="tblPage">
                                        <tr>
                                            <th>Số lần phẫu thuật mũi</th>
                                            <td>
                                            '.$_POST["f_18"].'
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Mũi hiện tại</th>
                                            <td>
                                            <p class="mb10">
                                            '.$_POST["f_19"].'
                                            </p>
                                            <h5 class="h5_page">Hình dạng tổng quát</h5>
                                            <input type="text" class="inputForm mb10" name="f_20" value="'.$_POST["f_20"].'" />
                                            <h5 class="h5_page">Sẹo vùng mũi</h5>
                                            <input type="text" class="inputForm" name="f_21" value="'.$_POST["f_21"].'" placeholder="" />
                                            </td>
                                        </tr>


                                        <tr>
                                            <th>Sóng mũi</th>
                                            <td>
                                            <div class="mb10">
                                            <h5 class="h5_page">Xượng mũi (gồ)</h5>
                                            <p>'.$_POST["f_22"].'</p>
                                            <h5 class="h5_page">Lệch</h5>
                                            <p>'.$_POST["f_23"].'</p>
                                            <h5 class="h5_page">Bè</h5>
                                            <p>'.$_POST["f_24"].'</p>
                                            <h5 class="h5_page">Đục xương</h5>
                                            <p>'.$_POST["f_25"].'</p>
                                            </div>
                                            <h5 class="h5_page">Vị trí Radix</h5>
                                            <input type="text" class="inputForm" name="f_26" value="'.$_POST["f_26"].'" placeholder="" />
                                            </td>
                                        </tr>


                                        <tr>
                                            <th>Đầu mũi</th>
                                            <td>
                                            <h5 class="h5_page">To</h5>
                                            <p>'.$_POST["f_27"].'</p>
                                            <h5 class="h5_page">Mô mềm đầu mũi</h5>
                                            <p>'.$_POST["f_28"].'</p>
                                            <h5 class="h5_page">Đầu mũi ngắn</h5>
                                            <p>'.$_POST["f_29"].'</p>
                                            <h5 class="h5_page">Góc mũi môi</h5>
                                            <p>'.$_POST["f_30"].'</p>
                                            <h5 class="h5_page">Da mũi</h5>
                                            <p>'.$_POST["f_31"].'</p>
                                            <h5 class="h5_page">Độ nảy đầu mũi</h5>
                                            <p>'.$_POST["f_32"].'</p>
                                            
                                            <h5 class="h5_page">Đánh giá vách ngăn</h5>
                                            <div class="flexBox flexBox--between flexBox__form flexBox__form--2 mb10">
                                                <div class="inputBlock borderBox">
                                                    <h5 class="h5_page">Vẹo</h5>
                                                    <p>'.$_POST["f_33"].'</p>
                                                </div>
                                                <div class="inputBlock borderBox">
                                                    <h5 class="h5_page">Cong Lõm</h5>
                                                    <p>'.$_POST["f_34"].'</p>
                                                </div>
                                            </div>
                                            <h5 class="h5_page">Vật liệu sử dụng</h5>
                                            <input type="text" class="inputForm mb10" name="f_35" value="'.$_POST["f_35"].'" placeholder="" />
                                            <h5 class="h5_page">Cách dựng trụ</h5>
                                            <input type="text" class="inputForm" name="f_36" value="'.$_POST["f_36"].'" placeholder="" />

                                            <h5 class="h5_page">Tiền đình mũi</h5>
                                            <p>'.$_POST["f_37"].'</p>
                                            <h5 class="h5_page">Cần ghép chỗ khuyết</h5>
                                            <input type="text" class="inputForm mb10" name="f_38" value="'.$_POST["f_38"].'" placeholder="" />
                                            </td>
                                        </tr>


                                        <tr>
                                            <th>Cánh mũi</th>
                                            <td>
                                            <p>'.$_POST["f_39"].'</p>
                                                <div class="mt10">
                                                    <h5 class="h5_page">Cắt cánh mũi?</h5>
                                                    <input type="text" class="inputForm mb10" name="f_40" value="'.$_POST["f_40"].'" placeholder="" />
                                                    <h5 class="h5_page">Treo cánh mũi?</h5>
                                                    <input type="text" class="inputForm" name="f_41" value="'.$_POST["f_41"].'" placeholder="" />
                                                </div>
                                            </td>
                                        </tr>


                                        <tr>
                                            <th>Nền mũi</th>
                                            <td>
                                                <p class="mb10">
                                                    <p>'.$_POST["f_42"].'</p>
                                                    <h5 class="h5_page">Rãnh mũi nông sâu?</h5>
                                                    <input type="text" class="inputForm" name="f_43" value="'.$_POST["f_43"].'" placeholder="" />
                                                </p>
                                                <h5 class="h5_page">Đường khính nền mũi / khoảng cách 2 khoé mắt</h5>
                                                <p>'.$_POST["f_44"].'</p>
                                                <h5 class="h5_page">Thu nền mũi ?</h5>
                                                <input type="text" class="inputForm" name="f_45" value="'.$_POST["f_45"].'" placeholder="" /> 
                                            </td>
                                        </tr>


                                        <tr>
                                            <th>Sụn cánh mũi</th>
                                            <td>
                                            <p class="mb10">
                                            <p>'.$_POST["f_46"].'</p>
                                            </p>
                                            <h5 class="h5_page">Bị biến dạng?</h5>
                                            <input type="text" class="inputForm" name="f_47" value="'.$_POST["f_47"].'" placeholder="" />
                                            </td>
                                        </tr>


                                        <tr>
                                            <th>Mũi khi cười bị kéo dài</th>
                                            <td>
                                            <p>'.$_POST["f_48"].'</p>
                                            </td>
                                        </tr>

                                    </table>
                                </div>

                                <ul class="tabItem tabItem--4 flexBox flexBox--center flexBox--wrap">
                                <li><a href="javascript:void(0)"  data-id="tab2">MẶT</a></li>
                            </ul>
                                <div class="tabBox" id="tab2">
                                    <h4 class="h4_page">MÍ TRÊN</h4>
                                    <table class="tblPage">
                                        <tr>
                                            <th>Số lần phẫu thuật mũi</th>
                                            <td>
                                            <p>'.$_POST["f_49"].'</p>
                                            <p>'.$_POST["f_50"].'</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Mô tả mí hiện tại</th>
                                            <td>
                                                <p class="mb10">
                                                    <h5 class="h5_page">Có mí </h5>
                                                    <p>'.$_POST["f_51"].'</p>
                                                </p>
                                                
                                                <p class="mb10">
                                                    <h5 class="h5_page">Độ dư da 2 bên</h5>
                                                    <p>'.$_POST["f_52"].'</p>
                                                </p>
                                                <p class="mb10">
                                                    <h5 class="h5_page">Da dư làm nhở mắt</h5>
                                                    <p>'.$_POST["f_53"].'</p>
                                                </p>
                                                <h5 class="h5_page">Ghi chú khác</h5>
                                                <textarea class="inputForm" name="f_54" placeholder="">'.$_POST["f_54"].'</textarea>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <th>Khe mí hai bên</th>
                                            <td>
                                            <p class="mb10">
                                                <h5 class="h5_page">Có yếu cơ nâng mi hay chênh lệch?</h5>
                                                <p>'.$_POST["f_55"].'</p>
                                            </p>
                                            <p class="mb10">
                                                <h5 class="h5_page">Có sự hỗ trợ mở mắt của các cơ lân cận ?</h5>
                                                <p>'.$_POST["f_56"].'</p>
                                            </p>
                                            </td>
                                        </tr>  

                                        <tr>
                                            <th>Góc mắt trong</th>
                                            <td><input type="text" class="inputForm" name="f_57" value="'.$_POST["f_57"].'" placeholder="Mô tả" /></td>
                                        </tr>
                                        
                                        <tr>
                                            <th>Góc mắt ngoài</th>
                                            <td><input type="text" class="inputForm" name="f_58" value="'.$_POST["f_58"].'" placeholder="Mô tả" /></td>
                                        </tr>


                                        <tr>
                                            <th>Mỡ mắt</th>
                                            <td>
                                                <h5 class="h5_page">Mỡ góc trong</h5>
                                                <input type="text" class="inputForm" name="f_59"  value="'.$_POST["f_59"].'" placeholder="" />
                                                <h5 class="h5_page">Mỡ góc ngoài</h5>
                                                <input type="text" class="inputForm" name="f_60"  value="'.$_POST["f_60"].'" placeholder="" />
                                                <h5 class="h5_page">thiếu vùng nào</h5>
                                                <input type="text" class="inputForm" name="f_61"  value="'.$_POST["f_61"].'" placeholder="" />
                                            </td>
                                        </tr>  

                                        <tr>
                                            <th>Mô duới mắt</th>
                                            <td>
                                            <p>'.$_POST["f_62"].'</p>
                                            </td>
                                        </tr>  
                                        <tr>
                                            <th>Mô dưới da</th>
                                            <td>
                                            <p>'.$_POST["f_63"].'</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Sa tuyến lệ</th>
                                            <td>
                                            <p>'.$_POST["f_64"].'</p>
                                            </td>
                                        </tr> 
                                        
                                        <tr>
                                            <th>Lông mi</th>
                                            <td>
                                                <p>'.$_POST["f_65"].'</p>
                                                <p class="mb10">
                                                <h5 class="h5_page">Độ vểnh lông mi</h5>
                                                <p>'.$_POST["f_66"].'</p>
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Cung mày</th>
                                            <td>
                                                <h5 class="h5_page">Vị trí cung mày so vớ gờ xương ổ mắt</h5>
                                                <input type="text" class="inputForm" name="f_67"  value='.$_POST["f_67"].'"" placeholder="" />
                                                <h5 class="h5_page">Khoảng cách cung mày và nếp mí</h5>
                                                <input type="text" class="inputForm" name="f_68"  value="'.$_POST["f_68"].'" placeholder="" />
                                                <p>'.$_POST["f_69"].'</p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Lưu ý</th>
                                            <td>
                                                <h5 class="h5_page">Khi khách nhắm mở mắt</h5>
                                                <input type="text" class="inputForm" name="f_70"  value="'.$_POST["f_70"].'" placeholder="" />
                                                <h5 class="h5_page">Khi khách cười</h5>
                                                <input type="text" class="inputForm" name="f_71"  value="'.$_POST["f_71"].'" placeholder="" />
                                                <h5 class="h5_page">Nếp nhăn đuội mắt</h5>
                                                <input type="text" class="inputForm" name="f_72"  value="'.$_POST["f_72"].'" placeholder="" />
                                            </td>
                                        </tr> 
                                    </table> 
                                    
                                    <h4 class="h4_page">MÍ DƯỚI</h4>
                                    <table class="tblPage">
                                        <tr>
                                            <th>Số lần phẫu thuật mũi</th>
                                            <td>
                                            <p>'.$_POST["f_73"].'</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Đánh giá</th>
                                            <td>
                                                <h5 class="h5_page">Đánh giá vùng thừa, vùng thiếu mỡ, mô mi dưới</h5>
                                                <input type="text" class="inputForm" name="f_74"  value="'.$_POST["f_74"].'" placeholder="Đánh giá vùng thừa, vùng thiếu mỡ, mô mi dưới" />
                                                <h5 class="h5_page">Tình trạng sa trễ , yếu mi dưới</h5>
                                                <input type="text" class="inputForm" name="f_75"  value="'.$_POST["f_75"].'" placeholder="Tình trạng sa trễ , yếu mi dưới" />
                                                <h5 class="h5_page">Tình trạng khi khách cười</h5>
                                                <input type="text" class="inputForm" name="f_76"  value="'.$_POST["f_76"].'" placeholder="Tình trạng khi khách cười" />
                                                <p class="mb10">
                                                <h5 class="h5_page">Bờ mi có tiền tuyến đồng tử</h5>
                                                '.$_POST["f_77"].'
                                                </p>
                                                <p class="mb10">
                                                <h5 class="h5_page">Có hở tròng trắng</h5>
                                                '.$_POST["f_78"].'
                                                </p>
                                            </td>
                                        </tr>     

                                    </table>     
                                </div>
                                <ul class="tabItem tabItem--4 flexBox flexBox--center flexBox--wrap">
                                    <li><a href="javascript:void(0)"  data-id="tab3">CẰM</a></li>
                                </ul>
                                <div class="tabBox" id="tab3">
                                    <table class="tblPage">
                                        <tr>
                                            <th>Số lần phẫu thuật</th>
                                            <td>
                                                <p>'.$_POST["f_79"].'</p>
                                                <h5 class="h5_page">Bên nào nhô nhiều?</h5>
                                                <input type="text" class="inputForm" name="f_80"  value="'.$_POST["f_80"].'" placeholder="Bên nào nhô nhiều?" />
                                                <h5 class="h5_page">Thiếu cằm chiều nào?</h5>
                                                <input type="text" class="inputForm" name="f_81"  value="'.$_POST["f_81"].'" placeholder="Thiếu cằm chiều nào?" />
                                            </td>
                                        </tr>
                                        </table>
                                </div>
                                <ul class="tabItem tabItem--4 flexBox flexBox--center flexBox--wrap">
                                    <li><a href="javascript:void(0)"  data-id="tab4">KHÁC</a></li>
                                </ul>
                                <div class="tabBox" id="tab4">
                                    <div class="inputBlock">
                                    <h5 class="h5_page">Tuần hoàn</h5>
                                    <input type="text" class="inputForm" name="f_82"  value="'.$_POST["f_82"].'" placeholder="Tuần hoàn" />
                                    <h5 class="h5_page">Răng hàm mặt</h5>
                                    <input type="text" class="inputForm" name="f_83"  value="'.$_POST["f_83"].'" placeholder="Răng hàm mặt" />
                                    <h5 class="h5_page">Hô hấp</h5>
                                    <input type="text" class="inputForm" name="f_84"  value="'.$_POST["f_84"].'" placeholder="Hô hấp" />
                                    <h5 class="h5_page">Thân tiết niệu, sinh dục</h5>
                                    <input type="text" class="inputForm" name="f_85"  value="'.$_POST["f_85"].'" placeholder="Thân tiết niệu, sinh dục">
                                    <h5 class="h5_page">Thần kinh</h5>
                                    <input type="text" class="inputForm" name="f_86"  value="'.$_POST["f_86"].'" placeholder="Thần kinh" />
                                    <h5 class="h5_page">Nội tiết,dinh dưỡng, các bệnh lý khác</h5>
                                    <input type="text" class="inputForm" name="f_87"  value="'.$_POST["f_87"].'" placeholder="Nội tiết,dinh dưỡng, các bệnh lý khác" />
                                    <h5 class="h5_page">Tiêu hoá</h5>
                                    <input type="text" class="inputForm" name="f_88"  value="'.$_POST["f_88"].'" placeholder="Tiêu hoá" />
                                    <h5 class="h5_page">Cơ Xương khớp</h5>
                                    <input type="text" class="inputForm" name="f_89"  value="'.$_POST["f_89"].'" placeholder="Cơ Xương khớp" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h4 class="h4_page">Các xét nghiệm cận lâm sàng cần thực hiện</h4>
                        <div class="inputBlock">
                            <textarea class="inputForm" name="f_90" placeholder="">'.$_POST["f_90"].'</textarea>
                        </div>
                        <h4 class="h4_page">Tóm tắt bệnh án</h4>
                        <div class="inputBlock">
                            <textarea class="inputForm" name="f_91" placeholder="">'.$_POST["f_91"].'</textarea>
                        </div>

                        <h3 class="h3_page">Chuẩn đoán khi vào khoa</h3>
                            <div class="inputBlock">
                            <h5 class="h5_page">Bệnh chính</h5>
                            <input type="text" class="inputForm" name="f_92"  value="'.$_POST["f_92"].'" placeholder="Bệnh chính" />
                            <h5 class="h5_page">Bệnh kèm theo</h5>
                            <input type="text" class="inputForm" name="f_93"  value="'.$_POST["f_93"].'" placeholder="" />
                            <h5 class="h5_page">Phân biệt</h5>
                            <input type="text" class="inputForm" name="f_94"  value="'.$_POST["f_94"].'" placeholder="" />
                            </div>
                        <h3 class="h3_page">Tiên lượng</h3>   
                            <div class="inputBlock">
                            <input type="text" class="inputForm" name="f_95"  value="'.$_POST["f_95"].'" placeholder="Bệnh chính" /> 
                            </div>
                        <h3 class="h3_page">Hướng điều trị</h3>   
                        <div class="inputBlock">
                            <textarea class="inputForm" name="f_96" placeholder="">'.$_POST["f_96"].'</textarea>
                        </div> 
                    ';
                add_post_meta($pid_med,'bsnk_advise',$detail_med);
        }
        update_post_meta($pid,'status',$status);
        header('Location:'.APP_URL);
    }


// BSK PART    
    if($_POST['action']=='edit_bsk') {
        $status = $_POST['status'];
        $bsk = $_POST['bsk'];
        update_post_meta($pid,'status',$status);
        update_post_meta($pid,'bsk',$bsk);
        header('Location:'.APP_URL);
    }

// EKIP PART
    if($_POST['action']=='ekip_create') {
        // CREAT EKIP
        $room = $_POST['room'];
        $status = $_POST['status'];
        $time_room = time();
        $idRoom = 'RM_'.$room.'_'.$time_room;
        update_post_meta($pid,'status',$status);
    
        $reg_dr = $_POST['check01'];
        $reg_mc = $_POST['check02'];
        $reg_pm = $_POST['check03'];
        $reg_ktv = $_POST['check04'];
        $input = $_POST['input'];

        $doctor1 = "";
        for($i=0; $i < count($reg_dr); $i++)
        {
            $doctor1 .= $reg_dr[$i]."<br>";
        }

        $doctor2 = "";
        for($i=0; $i < count($reg_mc); $i++)
        {
            $doctor2 .= $reg_mc[$i]."<br>";
        }
        

        $pm = "";
        for($i=0; $i < count($reg_pm); $i++)
        {
            $pm .= $reg_pm[$i]."<br>";
        }
        

        $ktv_list = "";
        for($i=0; $i < count($reg_ktv); $i++)
        {
            $ktv_list .= $reg_ktv[$i]."<br>";
        }
    
        
        $room_post = array(
            'post_title'    => $idRoom,
            'post_status'   => 'publish',
            'post_type' => 'ekip',
        );
        $pid_ekip = wp_insert_post($room_post);
        add_post_meta($pid_ekip, 'doctor1', $doctor1);
        add_post_meta($pid_ekip, 'doctor2', $doctor2);
        add_post_meta($pid_ekip, 'nursing_team', $pm);
        
        add_post_meta($pid_ekip, 'ktv', $ktv_list);
        add_post_meta($pid_ekip, 'input', $input);
        add_post_meta($pid_ekip, 'room', $room);
        // CREAT EKIP

        // UPDATE SERVICES
        $startSur = $_POST['startSur'];
        $getServ_surgery = get_field('services_list',$pid);

        $name_list = array();
        $cookies_do = "";
        for($i=0; $i < count($getServ_surgery); $i++){
            $name_list[]=$getServ_surgery[$i]['name'];
        }

     
        foreach($startSur as $s) {
            $key = array_search($s,$name_list);
            update_post_meta($pid, 'services_list'.'_'.$key.'_'.'do' ,'yes', false);
            update_post_meta($pid, 'services_list'.'_'.$key.'_'.'ekip' ,$idRoom, false);
            $cookies_do .= $key.',';
        }
        setcookie('did_cookies', $cookies_do, time() + (86400 * 30), "/");
        setcookie('sur_cookies', $pid, time() + (86400 * 30), "/");
        setcookie('room_cookies', $pid, time() + (86400 * 30), "/");
        // UPDATE SERVICES
        
        header('Location:'.APP_URL);
    }
    
// AFTER SURGERY
    if($_POST['action']=='ekip_report') {
        $list_supplies = get_posts(array(
            'numberposts' => -1,
            'post_type' => 'supplies',
            ));
        $numb_supplies = count($list_supplies);
        $listSupp ="
            <table>
                <tr>
                    <td>Vật tư</td>
                    <td>Số lượng</td>
                <tr>
            </table>
        ";
        for($u=0;$u<=$numb_supplies;$u++) {
            ${'supply_'.$u} = $_POST['supplies'.$u];
            $supplies = explode('-',${'supply_'.$u});
            if($supplies[1]!=0) {
                $listSupp .='
                <table>
                    <tr>
                        <td>'.$supplies[0].'</td>
                        <td>'.$supplies[1].'</td>
                    <tr>
                </table>
                ';
            }
            
        }
        $report = $_POST['report'];
        $report .= $listSupp;
        $date_end = date('d-m-Y');

        $cookies_do = explode(',',$_COOKIE['did_cookies']);
        
        foreach($cookies_do as $did_k) {
            update_post_meta($pid, 'services_list_'.$did_k.'_'.'report' ,$report, false);
            update_post_meta($pid, 'services_list_'.$did_k.'_'.'end' ,$date_end, false);
        }

        $status = $_POST['status'];
        update_post_meta($pid,'status',$status);
        setcookie('did_cookies','', time() + 86400, "/");
        setcookie('sur_cookies','', time() + 86400, "/");
        setcookie('room_cookies','', time() + 86400, "/");
        header('Location:'.APP_URL);
    }


// CARE PART    
    if($_POST['action']=='edit_cshp') {
        // INFO
        $status = $_POST['status'];
        $name_cskh = $_POST['name_cskh'];
        $time_care = date('d-m-Y');
        $time = $_POST['time'];
        $time_end = $_POST['end'];
        
        
        $customer_mess = $_POST['customer_mess'];
        $rating = $_POST['rating'];
        $stt = $_POST['stt'];
        $nurse_mess = $_POST['nurse_mess'];
        $doctor = $_POST['doctor'];
        $url = $_POST['url'];
        $numb_serv = $_POST['numb'];
        $idPost = $_POST['idPost'];
        $summary = $_POST['summary'];

        $careId = 'CARE-'.get_the_title($pid).'-'.$summary ;
        // DEFINE
        $after_day_1 = $time_end;
        $after_day_2 = 86400 + $time_end;
        $after_day_3 = 259200 + $time_end;
        $after_day_4 = 432000 + $time_end;
        $after_day_5 = 864000 + $time_end;
        $after_day_6 = 2592000 + $time_end;

        
        if($time=="firsttime") {
            $listService = get_field('services_list',$pid);
            $ls = 0;
            foreach($listService as $serv) {
                if($serv['type']==$summary) {
                    update_post_meta($pid, 'services_list'.'_'.$ls.'_'.'care' ,$careId, false);
                }
                $ls++;
            }
             $care_post = array(
                'post_title'    => $careId,
                'post_status'   => 'publish',
                'post_type' => 'care',
            );
            $pid_care = wp_insert_post($care_post);

            $listCare = array();
            $listCare[] = array(
                'expire' => $after_day_1,
                'name' => $name_cskh,
                'time' => $time_care,
                'stt' => $stt,
                'customer_mess' => $customer_mess,
                'nurse_mess' => $nurse_mess,
                'doctor' => $doctor,
                'rating' => $rating,
                'care' => 'care',
            );
            $listCare[] = array(
                'expire' => $after_day_2,
            );
            $listCare[] = array(
                'expire' => $after_day_3,
            );
            $listCare[] = array(
                'expire' => $after_day_4,
            );
            $listCare[] = array(
                'expire' => $after_day_5,
            );
            $listCare[] = array(
                'expire' => $after_day_6,
            );
            update_field('listcare', $listCare, $pid_care);
            update_post_meta($pid,'status',$status);
        }

        if($time=="after1day") {
            update_post_meta($idPost, 'listcare_1_name' ,$name_cskh, false);
            update_post_meta($idPost, 'listcare_1_customer_mess' ,$customer_mess, false);
            update_post_meta($idPost, 'listcare_1_stt' ,$stt, false);
            update_post_meta($idPost, 'listcare_1_nurse_mess' ,$nurse_mess, false);
            update_post_meta($idPost, 'listcare_1_doctor' ,$doctor, false);
            update_post_meta($idPost, 'listcare_1_rating' ,$rating, false);
        }

        if($time=="after3day") {
            update_post_meta($idPost, 'listcare_2_name' ,$name_cskh, false);
            update_post_meta($idPost, 'listcare_2_customer_mess' ,$customer_mess, false);
            update_post_meta($idPost, 'listcare_2_stt' ,$stt, false);
            update_post_meta($idPost, 'listcare_2_nurse_mess' ,$nurse_mess, false);
            update_post_meta($idPost, 'listcare_2_doctor' ,$doctor, false);
            update_post_meta($idPost, 'listcare_2_rating' ,$rating, false);
        }

        if($time=="after5day") {
            update_post_meta($idPost, 'listcare_3_name' ,$name_cskh, false);
            update_post_meta($idPost, 'listcare_3_customer_mess' ,$customer_mess, false);
            update_post_meta($idPost, 'listcare_3_stt' ,$stt, false);
            update_post_meta($idPost, 'listcare_3_nurse_mess' ,$nurse_mess, false);
            update_post_meta($idPost, 'listcare_3_doctor' ,$doctor, false);
            update_post_meta($idPost, 'listcare_3_rating' ,$rating, false);
        }

        if($time=="after10day") {
            update_post_meta($idPost, 'listcare_4_name' ,$name_cskh, false);
            update_post_meta($idPost, 'listcare_4_customer_mess' ,$customer_mess, false);
            update_post_meta($idPost, 'listcare_4_stt' ,$stt, false);
            update_post_meta($idPost, 'listcare_4_nurse_mess' ,$nurse_mess, false);
            update_post_meta($idPost, 'listcare_4_doctor' ,$doctor, false);
            update_post_meta($idPost, 'listcare_4_rating' ,$rating, false);
        }

        if($time=="after30day") {
            update_post_meta($idPost, 'listcare_5_name' ,$name_cskh, false);
            update_post_meta($idPost, 'listcare_5_customer_mess' ,$customer_mess, false);
            update_post_meta($idPost, 'listcare_5_stt' ,$stt, false);
            update_post_meta($idPost, 'listcare_5_nurse_mess' ,$nurse_mess, false);
            update_post_meta($idPost, 'listcare_5_doctor' ,$doctor, false);
            update_post_meta($idPost, 'listcare_5_rating' ,$rating, false);
        }

        $listCare = get_field('listcare',$idPost);
        for($ad=6;$ad<count($listCare);$ad++){
            echo $moreCare = "moreCare_".$ad;
            if($time==$moreCare) {
                update_post_meta($idPost, 'listcare_'.$ad.'_name' ,$name_cskh, false);
                update_post_meta($idPost, 'listcare_'.$ad.'_customer_mess' ,$customer_mess, false);
                update_post_meta($idPost, 'listcare_'.$ad.'_stt' ,$stt, false);
                update_post_meta($idPost, 'listcare_'.$ad.'_nurse_mess' ,$nurse_mess, false);
                update_post_meta($idPost, 'listcare_'.$ad.'_doctor' ,$doctor, false);
                update_post_meta($idPost, 'listcare_'.$ad.'_rating' ,$rating, false);
            }
        }
        // TIME
        header('Location:'.$url);
    }

?>