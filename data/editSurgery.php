<?php
include($_SERVER["DOCUMENT_ROOT"] . "/projects/klain/app_config.php");
include(APP_PATH."admin/wp-load.php");
require_once( APP_PATH . 'admin/wp-admin/includes/image.php' );
require_once( APP_PATH . 'admin/wp-admin/includes/file.php' );
require_once( APP_PATH . 'admin/wp-admin/includes/media.php' );

    $pid = $_POST['idSurgery'];
    

    // TEMP MEDICAL

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
        $remain = $_POST['remain'];

        update_post_meta($pid,'deposit',$deposit);
        update_post_meta($pid,'debt',$debt);
        update_post_meta($pid,'cash_money',$cash_money);
        update_post_meta($pid,'bank_money',$bank_money);
        update_post_meta($pid,'visa_money',$visa_money);


        update_post_meta($pid,'remain',$remain);
        update_post_meta($pid,'payment_status',$statusPay);
        update_post_meta($pid,'status',$status);
        $approve_cf = get_field('approve',$pid);
        if($approve_cf!='') {
            update_post_meta($pid,'process','yes');
        }
    
        header('Location:'.APP_URL.'surgery');
    }


// DOCTOR PART    
    if($_POST['action']=='edit_bsnk') {
        $status = $_POST['status'];
        update_post_meta($pid,'status',$status);


        $idMedical = 'MED_'.get_the_title($pid);
        update_post_meta($pid,'idmedical',$idMedical );
        $medical_post = array(
            'post_title'    => $idMedical,
            'post_status'   => 'publish',
            'post_type' => 'medical',
        );
        $pid_med = wp_insert_post($medical_post);




        //UPLOAD IMAGEIMAGE
        $numb_image = $_POST['numb_image'];
        $imgBefore = array();
        for($i=0;$i<=$numb_image;$i++) {
            if($_FILES["file$i"]["name"]!="") {
                $parts1=pathinfo($_FILES["file$i"]["name"]);
                $ext1=".".strtolower($parts1["extension"]);	
                $filename = strtolower($parts1["filename"]);
                $img_name = get_the_title($pid).'_'.$i;
                
                $attach_file = $img_name.$ext1;
                move_uploaded_file($_FILES["file$i"]["tmp_name"],$_SERVER['DOCUMENT_ROOT']."/projects/klain/data/uploads/surgery/".$attach_file);
                ${'linkFile_'.$i}="http://$_SERVER[HTTP_HOST]/projects/klain/data/uploads/surgery/".$attach_file;
                $imgBefore[] = $attach_file;

                add_post_meta($pid_med, 'image_before', $imgBefore);
            }
        }

        $bsnk = $_POST['bsnk'];
        add_post_meta($pid_med,'bsnk_name',$bsnk);

        for($i=0;$i<=96;$i++) {
            ${'f_'.$i} = $_POST["f_$i"];
        }
        $detail_med = '
        <table class="tblPage">
                        <tr>
                            <th>Quá trình bệnh lý</th>
                            <td><textarea class="inputForm" name="f_1" placeholder=""></textarea></td>
                        </tr>
                        <tr>
                            <th>Dị ứng thuốc</th>
                            <td>
                                <p class="inputBlock borderBox">
                                    <input type="radio" class="radioForm" id="f_2" name="hasSur" value="Có" /><label class="labelReg" for="f_2">Có</label>
                                    <input type="radio" class="radioForm" id="f_3" name="hasSur" value="Không" /><label class="labelReg" for="f_3">Không</label>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th>Dị ứng thức ăn</th>
                            <td>
                                <p class="inputBlock borderBox">
                                    <input type="radio" class="radioForm" id="f_4" name="hasSur" value="Có" /><label class="labelReg" for="f_4">Có</label>
                                    <input type="radio" class="radioForm" id="f_5" name="hasSur" value="Không" /><label class="labelReg" for="f_5">Không</label>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th>Tiền căn nội khoa</th>
                            <td>
                            <textarea class="inputForm" name="f_6" placeholder=""></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>Tiền căn ngoại khoa</th>
                            <td>
                            <textarea class="inputForm" name="f_7" placeholder=""></textarea>
                            </td>
                        </tr>  
                        <tr>
                            <th>Kinh nguyệt</th>
                            <td>
                            <textarea class="inputForm" name="f_8" placeholder=""></textarea>
                            </td>
                        </tr>   
                        <tr>
                            <th>Di truyền</th>
                            <td>
                            <textarea class="inputForm" name="f_9" placeholder=""></textarea>
                            </td>
                        </tr>   
                        <tr>
                            <th>Đặc điểm liên quan bệnh</th>
                            <td>
                                <input type="checkbox" class="inputForm" name="f_10" id="f_10_1" value="Dị ứng" /><label for="f_10_1">Dị ứng</label>
                                <input type="checkbox" class="inputForm" name="f_10" id="f_10_2" value="Ma tuý" /><label for="f_10_2">Ma tuý</label>
                                <input type="checkbox" class="inputForm" name="f_10" id="f_10_3" value="Rượu bia" /><label for="f_10_3">Rượu bia</label>
                                <input type="checkbox" class="inputForm" name="f_10" id="f_10_4" value="Thuốc lá" /><label for="f_10_4" >Thuốc lá</label>
                                <input type="checkbox" class="inputForm" name="f_10" id="f_10_5" value="Thuốc lào" /><label for="f_10_5">Thuốc lào</label>
                                <input type="checkbox" class="inputForm" name="f_10" id="f_10_6" value="Khác" /><label for="f_10_6">Khác</label>
                            </td>
                        </tr>                
                    </table>                
                
                    <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                        <div class="inputBlock">
                            <label class="smallLabel">Mạch</label>
                            <input type="text" class="inputForm" name="f_11" value="" placeholder="Mạch" />
                            <label class="smallLabel">Nhiệt độ</label>
                            <input type="text" class="inputForm" name="f_12" value="" placeholder="Nhiệt độ" />
                            <label class="smallLabel">Huyết áp</label>
                            <input type="text" class="inputForm" name="f_13" value="" placeholder="Huyết áp" />
                        </div>
                        <div class="inputBlock">
                            <label class="smallLabel">Nhịp thở</label>
                            <input type="text" class="inputForm" name="f_14" value="" placeholder="Nhịp thở" />
                            <label class="smallLabel">Cân nặng</label>
                            <input type="text" class="inputForm" name="f_15" value="" placeholder="Cân nặng" />
                        </div>
                    </div>

                    <h4 class="h4_page">Khám bệnh</h4>
                    <table class="tblPage">
                        <tr>
                            <th>Toàn thân</th>
                            <td><textarea class="inputForm" name="f_16" placeholder=""></textarea></td>
                        </tr>
                        <tr>
                            <th>Bệnh ngoại khoa</th>
                            <td><textarea class="inputForm" name="f_17" placeholder=""></textarea></td>
                        </tr>
                    </table>    
                    <div class="inputBlock">
                        <h4 class="h4_page">Các cơ quan</h4>
                        <ul class="tabItem tabItem--4 flexBox flexBox--center flexBox--wrap">
                            <li><a href="javascript:void(0)"  data-id="tab1">MŨI</a></li>
                            <li><a href="javascript:void(0)"  data-id="tab2">MẶT</a></li>
                            <li><a href="javascript:void(0)"  data-id="tab3">CẰM</a></li>
                            <li><a href="javascript:void(0)"  data-id="tab4">KHÁC</a></li>
                        </ul>

                        <div class="tabContent">
                            <div class="tabBox" id="tab1">
                                <table class="tblPage">
                                    <tr>
                                        <th>Số lần phẫu thuật mũi</th>
                                        <td>
                                        <p class="inputBlock customSelect">
                                            <select name="f_18">
                                                <option value="">Số lần</option>
                                                <?php for($i=0;$i<=10;$i++) { ?>
                                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                                <?php } ?>
                                            </select>
                                        </p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Mũi hiện tại</th>
                                        <td>
                                        <p class="mb10">
                                            <input type="radio" class="radioForm" id="f_19_1" name="f_19" value="Mũi silastic" /><label class="labelReg" for="f_19_1">Mũi silastic</label>
                                            <input type="radio" class="radioForm" id="f_19_2" name="f_19" value="Mũi bọc sụn" /><label class="labelReg" for="f_19_2">Mũi bọc sụn</label>
                                            <input type="radio" class="radioForm" id="f_19_3" name="f_19" value="Mũi cấu trúc" /><label class="labelReg" for="f_19_3">Mũi cấu trúc</label>
                                        </p>
                                        <input type="text" class="inputForm mb10" name="f_20" value="" placeholder="Hình dạng tổng quát" />
                                        <input type="text" class="inputForm" name="f_21" value="" placeholder="Sẹo vùng mũi" />
                                        </td>
                                    </tr>


                                    <tr>
                                        <th>Sóng mũi</th>
                                        <td>
                                        <div class="mb10">
                                        <label class="smallLabel">Xượng mũi (gồ)</label>
                                        <input type="radio" class="radioForm" id="f_22_1" name="f_22" value="Có" /><label class="labelReg" for="f_22_1">Có</label>
                                        <input type="radio" class="radioForm" id="f_22_2" name="f_22" value="Không" /><label class="labelReg" for="f_22_2">Không</label>
                                        <label class="smallLabel">Lệch</label>
                                        <input type="radio" class="radioForm" id="f_23_1" name="f_23" value="Có" /><label class="labelReg" for="f_23_1">Có</label>
                                        <input type="radio" class="radioForm" id="f_23_2" name="f_23" value="Không" /><label class="labelReg" for="f_23_2">Không</label>

                                        <label class="smallLabel">Bè</label>
                                        <input type="radio" class="radioForm" id="f_24_1" name="f_24" value="Có" /><label class="labelReg" for="f_24_1">Có</label>
                                        <input type="radio" class="radioForm" id="f_24_2" name="f_24" value="Không" /><label class="labelReg" for="f_24_2">Không</label>

                                        <label class="smallLabel">Đục xương</label>
                                        <input type="radio" class="radioForm" id="f_25_1" name="f_25" value="Có" /><label class="labelReg" for="f_25_1">Có</label>
                                        <input type="radio" class="radioForm" id="f_25_2" name="f_25" value="Không" /><label class="labelReg" for="f_25_2">Không</label>
                                        </div>
                                
                                        <input type="text" class="inputForm" name="f_26" value="" placeholder="Vị trí Radix" />
                                        </td>
                                    </tr>


                                    <tr>
                                        <th>Đầu mũi</th>
                                        <td>
                                        <label class="smallLabel">To</label>
                                        <input type="radio" class="radioForm" id="f_27_1" name="f_27" value="Có" /><label class="labelReg" for="f_27_1">Có</label>
                                        <input type="radio" class="radioForm" id="f_27_2" name="f_27" value="Không" /><label class="labelReg" for="f_27_2">Không</label>
                                        <label class="smallLabel">Mô mềm đầu mũi</label>
                                        <input type="radio" class="radioForm" id="f_28_1" name="f_28" value="Nhiều" /><label class="labelReg" for="f_28_1">Nhiều</label>
                                        <input type="radio" class="radioForm" id="f_28_2" name="f_28" value="Ít" /><label class="labelReg" for="f_28_2">Ít</label>
                                        <label class="smallLabel">Đầu mũi ngắn</label>
                                        <input type="radio" class="radioForm" id="f_29_1" name="f_29" value="Nhiều" /><label class="labelReg" for="f_29_1">Nhiều</label>
                                        <input type="radio" class="radioForm" id="f_29_2" name="f_29" value="Ít" /><label class="labelReg" for="f_29_2">Ít</label>

                                        <label class="smallLabel">Góc mũi môi</label>
                                        <input type="radio" class="radioForm" id="f_30_1" name="f_30" value="Hếch" /><label class="labelReg" for="f_30_1">Hếch</label>
                                        <input type="radio" class="radioForm" id="f_30_2" name="f_30" value="Không hếch" /><label class="labelReg" for="f_30_2">Không hếch</label>

                                        <label class="smallLabel">Da mũi</label>
                                        <input type="radio" class="radioForm" id="f_31_1" name="f_31" value="Dày" /><label class="labelReg" for="f_31_1">Dày</label>
                                        <input type="radio" class="radioForm" id="f_31_2" name="f_31" value="Mỏng" /><label class="labelReg" for="f_31_2">Mỏng</label>

                                        <label class="smallLabel">Độ nảy đầu mũi</label>
                                        
                                        <input type="radio" class="radioForm" id="f_32_1" name="f_32" value="no" /><label class="labelReg" for="f_32_1">1</label>
                                        <input type="radio" class="radioForm" id="f_32_2" name="f_32" value="no" /><label class="labelReg" for="f_32_2">2</label>
                                        <input type="radio" class="radioForm" id="f_32_3" name="f_32" value="no" /><label class="labelReg" for="f_32_3">3</label>
                                        <input type="radio" class="radioForm" id="f_32_4" name="f_32" value="no" /><label class="labelReg" for="f_32_4">4</label>
                                        <input type="radio" class="radioForm" id="f_32_5" name="f_32" value="no" /><label class="labelReg" for="f_32_5">5</label>
                                        

                                        <label class="smallLabel">Đánh giá vách ngăn</label>
                                        <div class="flexBox flexBox--between flexBox__form flexBox__form--2 mb10">
                                            <div class="inputBlock borderBox">
                                                <label class="smallLabel">Vẹo</label>
                                                <input type="radio" class="radioForm" id="f_33_1" name="f_33" value="Có" /><label class="labelReg" for="f_33_1">Có</label>
                                                <input type="radio" class="radioForm" id="f_33_2" name="f_33" value="Không" /><label class="labelReg" for="f_33_2">Không</label>
                                            </div>
                                            <div class="inputBlock borderBox">
                                                <label class="smallLabel">Cong Lõm</label>
                                                <input type="radio" class="radioForm" id="f_34_1" name="f_34" value="Trái" /><label class="labelReg" for="f_34_1">Trái</label>
                                                <input type="radio" class="radioForm" id="f_34_2" name="f_34" value="Phải" /><label class="labelReg" for="f_34_2">Phải</label>
                                            </div>
                                        </div>
                                        <input type="text" class="inputForm mb10" name="f_35" value="" placeholder="Vật liệu sử dụng" />
                                        <input type="text" class="inputForm" name="f_36" value="" placeholder="Cách dựng trụ" />

                                        <label class="smallLabel">Tien dinh mui</label>
                                        <input type="radio" class="radioForm" id="f_37_1" name="f_37" value="Không khuyết" /><label class="labelReg" for="f_37_1">Không khuyết</label>
                                        <input type="radio" class="radioForm" id="f_37_2" name="f_37" value="Khuyết" /><label class="labelReg" for="f_37_2">Khuyết</label>
                                        <input type="text" class="inputForm mb10" name="f_38" value="" placeholder="Cần ghép chỗ khuyết" />
                                        </td>
                                    </tr>


                                    <tr>
                                        <th>Cánh mũi</th>
                                        <td>
                                            <input type="radio" class="radioForm" id="f_39_1" name="f_39" value="Mỏng" /><label class="labelReg" for="f_39_1">Mỏng</label>
                                            <input type="radio" class="radioForm" id="f_39_2" name="f_39" value="Dày" /><label class="labelReg" for="f_39_2">Dày</label>
                                            <input type="radio" class="radioForm" id="f_39_3" name="f_39" value="Cong nhìều" /><label class="labelReg" for="f_39_3">Cong nhìều</label>
                                            <input type="radio" class="radioForm" id="f_39_4" name="f_39" value="Cong ít" /><label class="labelReg" for="f_39_4">Cong ít</label>
                                            <div class="mt10">
                                                <input type="text" class="inputForm mb10" name="f_40" value="" placeholder="Cắt cánh mũi?" />
                                                <input type="text" class="inputForm" name="f_41" value="" placeholder="Treo cánh mũi?" />
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <th>Nền mũi</th>
                                        <td>when the browser window is resized,
                                            <p class="mb10">
                                                <input type="radio" class="radioForm" id="f_42_1" name="f_42" value="Cao" /><label class="labelReg" for="f_42_1">Cao</label>
                                                <input type="radio" class="radioForm" id="f_42_2" name="f_42" value="Thấp" /><label class="labelReg" for="f_42_2">Thấp</label>
                                                <input type="text" class="inputForm" name="f_43" value="" placeholder="Rãnh mũi nông sâu?" />
                                            </p>
                                            <label class="smallLabel">Đường khính nền mũi / khoảng cách 2 khoé mắt</label>
                                            <input type="radio" class="radioForm" id="f_44_1" name="f_44" value="Rộng" /><label class="labelReg" for="f_44_1">Rộng</label>
                                            <input type="radio" class="radioForm" id="f_44_2" name="f_44" value="Bằng" /><label class="labelReg" for="f_44_2">Bằng</label>
                                            <input type="radio" class="radioForm" id="f_44_3" name="f_44" value="Nhỏ" /><label class="labelReg" for="f_44_3">Nhỏ</label>
                                            <input type="text" class="inputForm" name="f_45" value="" placeholder="Thu nền mũi ?" /> 
                                        </td>
                                    </tr>


                                    <tr>
                                        <th>Sụn cánh mũi</th>
                                        <td>
                                        <p class="mb10">
                                            <input type="radio" class="radioForm" id="f_46_1" name="f_46" value="Nhỏ" /><label class="labelReg" for="f_46_1">Nhỏ</label>
                                            <input type="radio" class="radioForm" id="f_46_2" name="f_46" value="To" /><label class="labelReg" for="f_46_2">To</label>
                                        </p>
                                        <input type="text" class="inputForm" name="f_47" value="" placeholder="Bị biến dạng?" />
                                        </td>
                                    </tr>


                                    <tr>
                                        <th>Mũi khi cười bị kéo dài</th>
                                        <td>
                                        <input type="radio" class="radioForm" id="f_48_1" name="f_48" value="Có" /><label class="labelReg" for="f_48_1">Có</label>
                                        <input type="radio" class="radioForm" id="f_48_2" name="f_48" value="Không" /><label class="labelReg" for="f_48_2">Không</label>
                                        </td>
                                    </tr>

                                </table>
                            </div>
                            <div class="tabBox" id="tab2">
                                <h4 class="h4_page">MÍ TRÊN</h4>
                                <table class="tblPage">
                                    <tr>
                                        <th>Số lần phẫu thuật mũi</th>
                                        <td>
                                        <p class="inputBlock customSelect">
                                            <select name="f_49">
                                                <option value="">Số lần</option>
                                                <?php for($i=0;$i<=10;$i++) { ?>
                                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                                <?php } ?>
                                            </select>
                                        </p>
                                        <p class="mb10">
                                            <input type="radio" class="radioForm" id="f_50_1" name="f_50" value="Nhấn mí" /><label class="labelReg" for="f_50_1">Nhấn mí</label>
                                            <input type="radio" class="radioForm" id="f_50_2" name="f_50" value="Cắt mí" /><label class="labelReg" for="f_50_2">Cắt mí</label>
                                        </p>
                                        
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Mô tả mí hiện tại</th>
                                        <td>
                                            <p class="mb10">
                                                <label class="smallLabel">Có mí </label>
                                                <input type="radio" class="radioForm" id="f_51_1" name="f_51" value="Có" /><label class="labelReg" for="f_51_1">Có</label>
                                                <input type="radio" class="radioForm" id="f_51_2" name="f_51" value="Không" /><label class="labelReg" for="f_51_2">Không</label>
                                            </p>
                                            
                                            <p class="mb10">
                                                <label class="smallLabel">Độ dư da 2 bên</label>
                                                <input type="radio" class="radioForm" id="f_52_1" name="f_52" value="Đều" /><label class="labelReg" for="f_52_1">Đều</label>
                                                <input type="radio" class="radioForm" id="f_52_2" name="f_52" value="Không Đều" /><label class="labelReg" for="f_52_2">Không Đều</label>
                                            </p>
                                            <p class="mb10">
                                                <label class="smallLabel">Da dư làm nhở mắt</label>
                                                <input type="radio" class="radioForm" id="f_53_1" name="f_53" value="Có" /><label class="labelReg" for="f_53_1">Có</label>
                                                <input type="radio" class="radioForm" id="f_53_2" name="f_53" value="Không" /><label class="labelReg" for="f_53_2">Không</label>
                                            </p>
                                            <textarea class="inputForm" name="f_54" placeholder="Ghi chú khác"></textarea>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th>Khe mí hai bên</th>
                                        <td>
                                        <p class="mb10">
                                            <label class="smallLabel">Có yếu cơ nâng mi hay chênh lệch?</label>
                                            <input type="radio" class="radioForm" id="f_55_1" name="f_55" value="yes" /><label class="labelReg" for="f_55_1">Có</label>
                                            <input type="radio" class="radioForm" id="f_55_2" name="f_55" value="no" /><label class="labelReg" for="f_55_2">Không</label>
                                        </p>
                                        <p class="mb10">
                                            <label class="smallLabel">Có sự hỗ trợ mở mắt của các cơ lân cận ?</label>
                                            <input type="radio" class="radioForm" id="f_56_1" name="f_56" value="yes" /><label class="labelReg" for="f_56_1">Có</label>
                                            <input type="radio" class="radioForm" id="f_56_2" name="f_56" value="no" /><label class="labelReg" for="f_56_2">Không</label>
                                        </p>
                                        </td>
                                    </tr>  

                                    <tr>
                                        <th>Góc mắt trong</th>
                                        <td><input type="text" class="inputForm" name="f_57" value="" placeholder="Mô tả" /> </td>
                                    </tr>
                                    
                                    <tr>
                                        <th>Góc mắt ngoài</th>
                                        <td><input type="text" class="inputForm" name="f_58" value="" placeholder="Mô tả" /> </td>
                                    </tr>


                                    <tr>
                                        <th>Mỡ mắt</th>
                                        <td>
                                            <input type="text" class="inputForm" name="f_59"  value="" placeholder="Mỡ góc trong" />
                                            <input type="text" class="inputForm" name="f_60"  value="" placeholder="Mỡ góc ngoài" />
                                            <input type="text" class="inputForm" name="f_61"  value="" placeholder="thiếu vùng nào" />
                                        </td>
                                    </tr>  

                                    <tr>
                                        <th>Mô duới mắt</th>
                                        <td>
                                            <input type="radio" class="radioForm" id="f_62_1" name="f_62" value="Nhão" /><label class="labelReg" for="f_62_1">Nhão</label>
                                            <input type="radio" class="radioForm" id="f_62_2" name="f_62" value="Căng" /><label class="labelReg" for="f_62_2">Căng</label>
                                        </td>
                                    </tr>  
                                    <tr>
                                        <th>Mô dưới da</th>
                                        <td>
                                            <input type="radio" class="radioForm" id="f_63_1" name="f_63" value="Nhiều" /><label class="labelReg" for="f_63_1">Nhiều</label>
                                            <input type="radio" class="radioForm" id="f_63_2" name="f_63" value="Ít" /><label class="labelReg" for="f_63_2">Ít</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Sa tuyến lệ</th>
                                        <td>
                                            <input type="radio" class="radioForm" id="f_64_1" name="f_64" value="Có" /><label class="labelReg" for="f_64_1">Có</label>
                                            <input type="radio" class="radioForm" id="f_64_2" name="f_64" value="Không" /><label class="labelReg" for="f_64_2">Không</label>
                                        </td>
                                    </tr> 
                                    
                                    <tr>
                                        <th>Lông mi</th>
                                        <td>
                                            <input type="radio" class="radioForm" id="f_65_1" name="f_65" value="Ngắn" /><label class="labelReg" for="f_65_1">Ngắn</label>
                                            <input type="radio" class="radioForm" id="f_65_2" name="f_65" value="Dài" /><label class="labelReg" for="f_65_2">Dài</label>
                                            <p class="mb10">
                                            <label class="smallLabel">Độ vểnh lông mi</label>
                                            <input type="radio" class="radioForm" id="f_66_1" name="f_66" value="Nhiều" /><label class="labelReg" for="f_66_1">Nhiều</label>
                                            <input type="radio" class="radioForm" id="f_66_2" name="f_66" value="Ít" /><label class="labelReg" for="f_66_2">Ít</label>
                                            </p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Cung mày</th>
                                        <td>
                                            <input type="text" class="inputForm" name="f_67"  value="" placeholder="Vị trí cung mày so vớ gờ xương ổ mắt" />
                                            <input type="text" class="inputForm" name="f_68"  value="" placeholder="Khoảng cách cung mày và nếp mí" />
                                            <input type="radio" class="radioForm" id="f_69_1" name="f_69" value="Đều" /><label class="labelReg" for="f_69_1">Đều</label>
                                            <input type="radio" class="radioForm" id="f_69_2" name="f_69" value="Không Đều" /><label class="labelReg" for="f_69_2">Không Đều</label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Lưu ý</th>
                                        <td>
                                            <input type="text" class="inputForm" name="f_70"  value="" placeholder="Khi khách nhắm mở mắt" />
                                            <input type="text" class="inputForm" name="f_71"  value="" placeholder="Khi khách cười" />
                                            <input type="text" class="inputForm" name="f_72"  value="" placeholder="Nếp nhăn đuội mắt" />
                                        </td>
                                    </tr> 
                                </table> 
                                
                                <h4 class="h4_page">MÍ DƯỚI</h4>
                                <table class="tblPage">
                                    <tr>
                                        <th>Số lần phẫu thuật mũi</th>
                                        <td>
                                        <p class="inputBlock customSelect">
                                            <select name="f_73">
                                                <option value="">Số lần</option>
                                                <?php for($i=0;$i<=10;$i++) { ?>
                                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                                <?php } ?>
                                            </select>
                                        </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Đánh giá</th>
                                        <td>
                                            <input type="text" class="inputForm" name="f_74"  value="" placeholder="Đánh giá vùng thừa, vùng thiếu mỡ, mô mi dưới" />
                                            <input type="text" class="inputForm" name="f_75"  value="" placeholder="Tình trạng sa trễ , yếu mi dưới" />
                                            <input type="text" class="inputForm" name="f_76"  value="" placeholder="Tình trạng khi khách cười" />
                                            <p class="mb10">
                                            <label class="smallLabel">Bờ mi có tiền tuyến đồng tử</label>
                                            <input type="radio" class="radioForm" id="f_77_1" name="f_77" value="Có" /><label class="labelReg" for="f_77_1">Có </label>
                                            <input type="radio" class="radioForm" id="f_77_2" name="f_77" value="Không" /><label class="labelReg" for="f_77_2">Không</label>
                                            </p>
                                            <p class="mb10">
                                            <label class="smallLabel">Có hở tròng trắng</label>
                                            <input type="radio" class="radioForm" id="f_78_1" name="f_78" value="Có" /><label class="labelReg" for="f_78_1">Có </label>
                                            <input type="radio" class="radioForm" id="f_78_2" name="f_78" value="Không" /><label class="labelReg" for="f_78_2">Không</label>
                                            </p>
                                        </td>
                                    </tr>     

                                </table>     
                            </div>
                            <div class="tabBox" id="tab3">
                                <table class="tblPage">
                                    <tr>
                                        <th>Số lần phẫu thuật</th>
                                        <td>
                                            <input type="radio" class="radioForm" id="f_79_1" name="f_79" value="yes" /><label class="labelReg" for="f_79_1">Đều</label>
                                            <input type="radio" class="radioForm" id="f_79_2" name="f_79" value="no" /><label class="labelReg" for="f_79_2">Không đều</label>
                                            <input type="text" class="inputForm" name="f_80"  value="" placeholder="Bên nào nhô nhiều?" />
                                            <input type="text" class="inputForm" name="f_81"  value="" placeholder="Thiếu cằm chiều nào?" />
                                        </td>
                                    </tr>
                                    </table>
                            </div>
                            <div class="tabBox" id="tab4">
                                <div class="inputBlock">
                                <input type="text" class="inputForm" name="f_82"  value="" placeholder="Tuần hoàn" />
                                <input type="text" class="inputForm" name="f_83"  value="" placeholder="Răng hàm mặt" />
                                <input type="text" class="inputForm" name="f_84"  value="" placeholder="Hô hấp" />
                                <input type="text" class="inputForm" name="f_85"  value="" placeholder="Thân tiết niệu, sinh dục">
                                <input type="text" class="inputForm" name="f_86"  value="" placeholder="Thần kinh" />
                                <input type="text" class="inputForm" name="f_87"  value="" placeholder="Nội tiết,dinh dưỡng, các bệnh lý khác" />
                                <input type="text" class="inputForm" name="f_88"  value="" placeholder="Tiêu hoá" />
                                <input type="text" class="inputForm" name="f_89"  value="" placeholder="Cơ Xương khớp" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <h4 class="h4_page">Các xét nghiệm cận lâm sàng cần thực hiện</h4>
                    <div class="inputBlock">
                        <textarea class="inputForm" name="f_90" placeholder=""></textarea>
                    </div>
                    <h4 class="h4_page">Tóm tắt bệnh án</h4>
                    <div class="inputBlock">
                        <textarea class="inputForm" name="f_91" placeholder=""></textarea>
                    </div>

                    <h3 class="h3_page">Chuẩn đoán khi vào khoa</h3>
                        <div class="inputBlock">
                        <input type="text" class="inputForm" name="f_92"  value="" placeholder="Bệnh chính" />
                        <input type="text" class="inputForm" name="f_93"  value="" placeholder="Bệnh kèm theo" />
                        <input type="text" class="inputForm" name="f_94"  value="" placeholder="Phân biệt" />
                        </div>
                    <h3 class="h3_page">Tiên lượng</h3>   
                        <div class="inputBlock">
                        <input type="text" class="inputForm" name="f_95"  value="" placeholder="Bệnh chính" /> 
                        </div>
                    <h3 class="h3_page">Hướng điều trị</h3>   
                    <div class="inputBlock">
                        <textarea class="inputForm" name="f_96" placeholder=""></textarea>
                    </div> 
        ';
        add_post_meta($pid_med,'detail_med',$detail_med);
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