<?php
include($_SERVER["DOCUMENT_ROOT"] . "/projects/klain/app_config.php");
include(APP_PATH."admin/wp-load.php");
require_once( APP_PATH . 'admin/wp-admin/includes/image.php' );
require_once( APP_PATH . 'admin/wp-admin/includes/file.php' );
require_once( APP_PATH . 'admin/wp-admin/includes/media.php' );

    $pid = $_POST['idSurgery'];

    // TEMP MEDICAL

    // if($_POST['action']=='edit_info') {
        // $doctor_advise = $_POST['doctor_advise'];
        // $doctor_advise .='<br>Chỉnh sửa lần cuối:'.$_POST['name_edit'];
    
        // if($_POST['status']) {
        //     $status = $_POST['status'];
        //     update_post_meta($pid,'status',$status);
        // }
        // update_post_meta($pid,'doctor_advise',$doctor_advise);


        // mkdir('path/to/directory', 0777, true);
        // $imgBefore = array();
        // for($i=0;$i<=$numb_image;$i++) {
        //     if($_FILES["file$i"]["name"]!="") {
        //         $parts1=pathinfo($_FILES["file$i"]["name"]);
        //         $ext1=".".strtolower($parts1["extension"]);	
        //         $filename = strtolower($parts1["filename"]);
        //         $img_name = get_the_title($pid).'_'.$i;
                
        //         $attach_file = $img_name.$ext1;
        //         move_uploaded_file($_FILES["file$i"]["tmp_name"],$_SERVER['DOCUMENT_ROOT']."/projects/klain/data/uploads/surgery/".$attach_file);
        //         ${'linkFile_'.$i}="http://$_SERVER[HTTP_HOST]/projects/klain/data/uploads/surgery/".$attach_file;
        //         $imgBefore[] = $attach_file;

        //         add_post_meta($pid_med, 'image_before', $imgBefore);
        //     }
        // }
    
     //   header('Location:'.APP_URL);
    // }

    

    // TEMP EKIP

    if($_POST['action']=='edit_info') {
        $doctor_advise = $_POST['doctor_advise'];
        
        $doctor_advise .='<br>Chỉnh sửa lần cuối:'.$_POST['name_edit'];
        if($_POST['status']) {
            echo $status = $_POST['status'];
            update_post_meta($pid,'status',$status);
        }
        update_post_meta($pid,'doctor_advise',$doctor_advise);
        // header('Location:'.APP_URL);
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
        }    

        $customer_id = get_field('idcustomer',$cusid_post);
        if($_FILES["file1"]["name"]!="") {
            $parts1=pathinfo($_FILES["file1"]["name"]);
            $ext1=".".strtolower($parts1["extension"]);	
            $filename = strtolower($parts1["filename"]);
            $custom_name = $customer_id.'_front';
            
            $attach_file = $custom_name.$ext1;
            move_uploaded_file($_FILES["file1"]["tmp_name"],$_SERVER['DOCUMENT_ROOT']."/projects/klain/data/uploads/customers/".$attach_file);
            $linkFile_front="http://$_SERVER[HTTP_HOST]/projects/klain/data/uploads/customers/".$attach_file;
        }
        if($_FILES["file2"]["name"]!="") {
            $parts1=pathinfo($_FILES["file2"]["name"]);
            $ext1=".".strtolower($parts1["extension"]);	
            $filename = strtolower($parts1["filename"]);
            $custom_name = $customer_id.'_back';
            
            $attach_file = $custom_name.$ext1;
            move_uploaded_file($_FILES["file2"]["tmp_name"],$_SERVER['DOCUMENT_ROOT']."/projects/klain/data/uploads/customers/".$attach_file);
            $linkFile_back="http://$_SERVER[HTTP_HOST]/projects/klain/data/uploads/customers/".$attach_file;
        }

        update_post_meta($cusid_post, 'ic_front', $linkFile_front);
        update_post_meta($cusid_post, 'ic_back', $linkFile_back);
            
        

        $accept = $_POST['accept'];
        $approve = $_POST['approve'];
        $sale_discount = $_POST['sale_discount'];
        

        update_post_meta($pid,'accept',$accept);
        if(get_field('approve',$pid)=='') {
            update_post_meta($pid,'approve',$approve);
        }
        update_post_meta($pid,'sale_discount',$sale_discount);


        $status = $_POST['status'];
        $methodPay = $_POST['methodPay'];

        $cash_money = $_POST['cash_money'];
        $bank_money = $_POST['bank_money'];
        $visa_money = $_POST['visa_money'];

        $statusPay = $_POST['statusPay'];
        $deposit = $_POST['deposit'];
        $debt = $_POST['debt'];
        $debter = $_POST['debter'];
        $guy = $_POST['guy'];
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
        update_post_meta($pid,'remain',$remain);
        update_post_meta($pid,'payment_status',$statusPay);
        update_post_meta($pid,'status',$status);
        $approve_cf = get_field('approve',$pid);
        if($approve_cf!='') {
            update_post_meta($pid,'process','yes');
        }
    
        header('Location:'.APP_URL);
    }


// DOCTOR PART    
    if($_POST['action']=='edit_bsnk') {
        $reason = $_POST['reason'];
        if($reason!='') {
            $status = 'huy';    
        } else {
            $status = $_POST['status'];
            $idMedical = 'MED_'.get_the_title($pid);
            update_post_meta($pid,'idmedical',$idMedical );
            $medical_post = array(
                'post_title'    => $idMedical,
                'post_status'   => 'publish',
                'post_type' => 'medical',
            );
            $pid_med = wp_insert_post($medical_post);

            //UPLOAD IMAGEIMAGE
            

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
        header('Location:'.APP_URL.'surgery');
    }


// BSK PART    
    if($_POST['action']=='edit_bsk') {
        $status = $_POST['status'];
        $bsk = $_POST['bsk'];
        update_post_meta($pid,'status',$status);
        update_post_meta($pid,'bsk',$bsk);
        header('Location:'.APP_URL.'surgery');
    }

// EKIP PART
    if($_POST['action']=='ekip_create') {
        // CREAT EKIP
        $room = $_POST['room'];
        $status = $_POST['status'];
        $time_room = date('Ymd_Hi');
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
        for($i=0; $i < count($getServ_surgery); $i++){
            $name_list[]=$getServ_surgery[$i]['name'];
        }

        foreach($startSur as $s) {
            $key = array_search($s,$name_list);
            add_post_meta($pid, 'services_list'.'_'.$key.'_'.'do' ,'yes', false);
            add_post_meta($pid, 'services_list'.'_'.$key.'_'.'ekip' ,$idRoom, false);
        }
        
        // UPDATE SERVICES
        
        header('Location:'.APP_URL.'surgery');
    }


// AFTER SURGERY
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


// CARE PART    
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