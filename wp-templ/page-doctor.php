<?php /* Template Name: Form Counter */ ?>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/projects/klain/app_config.php");
// include(APP_PATH."libs/checklog.php");
if(!$_COOKIE['login_cookies']) {    
	header('Location:'.APP_URL.'login');
}
include(APP_PATH."libs/head.php"); 
?>
</head>

<body id="doctor">
<div class="flexBox flexBox--between flexBox--wrap">
<?php include(APP_PATH."libs/sidebar.php"); ?>
<div id="wrapper">
<!--===================================================-->
<!--Header-->
<?php include(APP_PATH."libs/header.php"); ?>
<!--/Header-->

<div class="flexBox flexBox--between textBox flexBox--wrap maxW">
    <div class="blockPage blockPage--full">
        <h2 class="h2_page">Thông tin bệnh án</h2>
            <?php
                $id_sur = $_GET['idSurgery'];
                if($id_sur) {
                $wp_query = new WP_Query();
                $param = array (
                'posts_per_page' => '-1',
                'post_type' => 'surgery',
                'post_status' => 'publish',
                'order' => 'DESC',
                'p'=> $id_sur
                );
                $wp_query->query($param);
                if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
            ?>
            <h3 class="h3_page">Thông tin khách hàng</h3>
            <div class="flexBox flexBox--between flexBox__form flexBox__form--2 mb30">
                <p class="inputBlock">
                <input type="text" class="inputForm" name="fullname" placeholder="Họ tên" readonly value="<?php the_field('fullname'); ?>" />
                </p>
                <p class="inputBlock">
                <input type="text" class="inputForm" name="mobile" placeholder="Mobile" readonly value="<?php echo get_field('idcustomer',get_field('cusid_post')); ?>" />
                </p>
            </div> 


            <form action="<?php echo APP_URL; ?>data/editSurgery.php" method="post" enctype="multipart/form-data">
                <?php 
                    $id_med = get_field('idmedical');
                    if($id_med!='') {
                    $param = array (
                        'posts_per_page' => '1',
                        'post_type' => 'medical',
                        'post_status' => 'publish',
                        'order' => 'DESC',
                        'p'=>$id_med
                    );
                    $posts_array = get_posts( $param );
                    foreach ($posts_array as $medical ) {
                ?>
                <?php echo get_field('bsnk_advise',$medical->ID); } ?>
                <?php } else { ?>
                <h3 class="h3_page">Bệnh Án</h3>
                <h4 class="h4_page">Dịch vụ yêu cầu</h4>
                <?php
                    $listService = get_field('services');
                    $listServices = explode('<br>',$listService);
                ?>
                <?php foreach($listServices as $serv) {
                    echo $serv.'<br>';
                }    
                ?>
                <h4 class="h4_page">Hỏi bệnh</h4>
                    <table class="tblPage">
                        <tr>
                            <th>Quá trình bệnh lý</th>
                            <td><textarea class="inputForm" name="f_1" placeholder=""></textarea></td>
                        </tr>
                        <tr>
                            <th>Dị ứng thuốc</th>
                            <td>
                                <p class="inputBlock borderBox">
                                    <input type="radio" class="radioForm" id="f_2" name="f_3" value="Có" /><label class="labelReg" for="f_2">Có</label>
                                    <input type="radio" class="radioForm" id="f_3" name="f_3" value="Không" /><label class="labelReg" for="f_3">Không</label>
                                </p>
                                <textarea class="inputForm" name="f_2" placeholder="Thuốc dị ứng"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>Dị ứng thức ăn</th>
                            <td>
                                <p class="inputBlock borderBox">
                                    <input type="radio" class="radioForm" id="f_4" name="f_5" value="Có" /><label class="labelReg" for="f_4">Có</label>
                                    <input type="radio" class="radioForm" id="f_5" name="f_5" value="Không" /><label class="labelReg" for="f_5">Không</label>
                                </p>
                                <textarea class="inputForm" name="f_4" placeholder="Thức ăn dị ứng"></textarea>
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
                                <input type="checkbox"  name="f_10[]" id="f_10_1" value="Dị ứng" /><label for="f_10_1">Dị ứng</label>
                                <input type="checkbox"  name="f_10[]" id="f_10_2" value="Ma tuý" /><label for="f_10_2">Ma tuý</label>
                                <input type="checkbox"  name="f_10[]" id="f_10_3" value="Rượu bia" /><label for="f_10_3">Rượu bia</label>
                                <input type="checkbox"  name="f_10[]" id="f_10_4" value="Thuốc lá" /><label for="f_10_4" >Thuốc lá</label>
                                <input type="checkbox"  name="f_10[]" id="f_10_5" value="Thuốc lào" /><label for="f_10_5">Thuốc lào</label>
                                <input type="checkbox"  name="f_10[]" id="f_10_6" value="Khác" /><label for="f_10_6">Khác</label>
                            </td>
                        </tr>                
                    </table>                
                
                    <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                        <div class="inputBlock">
                            <h5 class="h5_page">Mạch</h5>
                            <input type="text" class="inputForm mb10" name="f_11" value="" placeholder="Mạch" /><br>
                            <h5 class="h5_page">Nhiệt độ</h5>
                            <input type="text" class="inputForm mb10" name="f_12" value="" placeholder="Nhiệt độ" /><br>
                            <h5 class="h5_page">Huyết áp</h5>
                            <input type="text" class="inputForm mb10" name="f_13" value="" placeholder="Huyết áp" />
                        </div>
                        <div class="inputBlock">
                            <h5 class="h5_page">Nhịp thở</h5>
                            <input type="text" class="inputForm mb10" name="f_14" value="" placeholder="Nhịp thở" /><br>
                            <h5 class="h5_page">Cân nặng</h5>
                            <input type="text" class="inputForm mb10" name="f_15" value="" placeholder="Cân nặng" />
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
                                        <h5 class="h5_page">Xượng mũi (gồ)</h5>
                                        <input type="radio" class="radioForm" id="f_22_1" name="f_22" value="Có" /><label class="labelReg" for="f_22_1">Có</label>
                                        <input type="radio" class="radioForm" id="f_22_2" name="f_22" value="Không" /><label class="labelReg" for="f_22_2">Không</label>
                                        <h5 class="h5_page">Lệch</h5>
                                        <input type="radio" class="radioForm" id="f_23_1" name="f_23" value="Có" /><label class="labelReg" for="f_23_1">Có</label>
                                        <input type="radio" class="radioForm" id="f_23_2" name="f_23" value="Không" /><label class="labelReg" for="f_23_2">Không</label>

                                        <h5 class="h5_page">Bè</h5>
                                        <input type="radio" class="radioForm" id="f_24_1" name="f_24" value="Có" /><label class="labelReg" for="f_24_1">Có</label>
                                        <input type="radio" class="radioForm" id="f_24_2" name="f_24" value="Không" /><label class="labelReg" for="f_24_2">Không</label>

                                        <h5 class="h5_page">Đục xương</h5>
                                        <input type="radio" class="radioForm" id="f_25_1" name="f_25" value="Có" /><label class="labelReg" for="f_25_1">Có</label>
                                        <input type="radio" class="radioForm" id="f_25_2" name="f_25" value="Không" /><label class="labelReg" for="f_25_2">Không</label>
                                        </div>
                                
                                        <input type="text" class="inputForm" name="f_26" value="" placeholder="Vị trí Radix" />
                                        </td>
                                    </tr>


                                    <tr>
                                        <th>Đầu mũi</th>
                                        <td>
                                        <h5 class="h5_page">To</h5>
                                        <input type="radio" class="radioForm" id="f_27_1" name="f_27" value="Có" /><label class="labelReg" for="f_27_1">Có</label>
                                        <input type="radio" class="radioForm" id="f_27_2" name="f_27" value="Không" /><label class="labelReg" for="f_27_2">Không</label>
                                        <h5 class="h5_page">Mô mềm đầu mũi</h5>
                                        <input type="radio" class="radioForm" id="f_28_1" name="f_28" value="Nhiều" /><label class="labelReg" for="f_28_1">Nhiều</label>
                                        <input type="radio" class="radioForm" id="f_28_2" name="f_28" value="Ít" /><label class="labelReg" for="f_28_2">Ít</label>
                                        <h5 class="h5_page">Đầu mũi ngắn</h5>
                                        <input type="radio" class="radioForm" id="f_29_1" name="f_29" value="Nhiều" /><label class="labelReg" for="f_29_1">Nhiều</label>
                                        <input type="radio" class="radioForm" id="f_29_2" name="f_29" value="Ít" /><label class="labelReg" for="f_29_2">Ít</label>

                                        <h5 class="h5_page">Góc mũi môi</h5>
                                        <input type="radio" class="radioForm" id="f_30_1" name="f_30" value="Hếch" /><label class="labelReg" for="f_30_1">Hếch</label>
                                        <input type="radio" class="radioForm" id="f_30_2" name="f_30" value="Không hếch" /><label class="labelReg" for="f_30_2">Không hếch</label>

                                        <h5 class="h5_page">Da mũi</h5>
                                        <input type="radio" class="radioForm" id="f_31_1" name="f_31" value="Dày" /><label class="labelReg" for="f_31_1">Dày</label>
                                        <input type="radio" class="radioForm" id="f_31_2" name="f_31" value="Mỏng" /><label class="labelReg" for="f_31_2">Mỏng</label>

                                        <h5 class="h5_page">Độ nảy đầu mũi</h5>
                                        
                                        <input type="radio" class="radioForm" id="f_32_1" name="f_32" value="no" /><label class="labelReg" for="f_32_1">1</label>
                                        <input type="radio" class="radioForm" id="f_32_2" name="f_32" value="no" /><label class="labelReg" for="f_32_2">2</label>
                                        <input type="radio" class="radioForm" id="f_32_3" name="f_32" value="no" /><label class="labelReg" for="f_32_3">3</label>
                                        <input type="radio" class="radioForm" id="f_32_4" name="f_32" value="no" /><label class="labelReg" for="f_32_4">4</label>
                                        <input type="radio" class="radioForm" id="f_32_5" name="f_32" value="no" /><label class="labelReg" for="f_32_5">5</label>
                                        

                                        <h5 class="h5_page">Đánh giá vách ngăn</h5>
                                        <div class="flexBox flexBox--between flexBox__form flexBox__form--2 mb10">
                                            <div class="inputBlock borderBox">
                                                <h5 class="h5_page">Vẹo</h5>
                                                <input type="radio" class="radioForm" id="f_33_1" name="f_33" value="Có" /><label class="labelReg" for="f_33_1">Có</label>
                                                <input type="radio" class="radioForm" id="f_33_2" name="f_33" value="Không" /><label class="labelReg" for="f_33_2">Không</label>
                                            </div>
                                            <div class="inputBlock borderBox">
                                                <h5 class="h5_page">Cong Lõm</h5>
                                                <input type="radio" class="radioForm" id="f_34_1" name="f_34" value="Trái" /><label class="labelReg" for="f_34_1">Trái</label>
                                                <input type="radio" class="radioForm" id="f_34_2" name="f_34" value="Phải" /><label class="labelReg" for="f_34_2">Phải</label>
                                            </div>
                                        </div>
                                        <input type="text" class="inputForm mb10" name="f_35" value="" placeholder="Vật liệu sử dụng" />
                                        <input type="text" class="inputForm" name="f_36" value="" placeholder="Cách dựng trụ" />

                                        <h5 class="h5_page">Tien dinh mui</h5>
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
                                        <td>
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
                                                <h5 class="h5_page">>Có mí </h5>
                                                <input type="radio" class="radioForm" id="f_51_1" name="f_51" value="Có" /><label class="labelReg" for="f_51_1">Có</label>
                                                <input type="radio" class="radioForm" id="f_51_2" name="f_51" value="Không" /><label class="labelReg" for="f_51_2">Không</label>
                                            </p>
                                            
                                            <p class="mb10">
                                            <h5 class="h5_page">Độ dư da 2 bên</h5>
                                                <input type="radio" class="radioForm" id="f_52_1" name="f_52" value="Đều" /><label class="labelReg" for="f_52_1">Đều</label>
                                                <input type="radio" class="radioForm" id="f_52_2" name="f_52" value="Không Đều" /><label class="labelReg" for="f_52_2">Không Đều</label>
                                            </p>
                                            <p class="mb10">
                                            <h5 class="h5_page">Da dư làm nhở mắt</h5>
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
                                            <h5 class="h5_page">Bờ mi có tiền tuyến đồng tử</h5>
                                            <input type="radio" class="radioForm" id="f_77_1" name="f_77" value="Có" /><label class="labelReg" for="f_77_1">Có </label>
                                            <input type="radio" class="radioForm" id="f_77_2" name="f_77" value="Không" /><label class="labelReg" for="f_77_2">Không</label>
                                            </p>
                                            <p class="mb10">
                                            <h5 class="h5_page">Có hở tròng trắng</h5>
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


                    <h4 class="h4_page">Hình ảnh trước phẫu thuật</h4>
                    <?php
                    $numb_image = get_field('numb_image');
                    for($i=1;$i<=$numb_image;$i++) {
                    ?>
                    <label class="file">
                        <input type="file" name="file<?php echo $i; ?>" id="file<?php echo $i; ?>" accept="image/*" capture="camera">
                        <span class="file-custom"></span>
                    </label>
                    <?php } ?>
                <?php } ?>

                <h3 class="h3_page">Dành riêng cho BSK</h3>    
                <textarea class="inputForm" <?php if($_COOKIE['role_cookies']!='boss') { ?>readonly<?php } ?> name="bsk" id="bsk"></textarea>
                
                <input type="hidden" name="idSurgery" value="<?php echo $_GET['idSurgery']; ?>" >
                <?php if($_COOKIE['role_cookies']=='doctor') { ?>
                    <input type="hidden" name="status" value="bsnk" >
                    <input type="hidden" name="bsnk" value="<?php echo $_COOKIE['name_cookies']; ?>" >
                    <!-- <input type="hidden" name="numb_image" value="<?php echo $numb_image; ?>" > -->
                    <input type="hidden" name="action" value="edit_bsnk" >
                    <div class="flexBox flexBox--arround flexBox__form flexBox__form--2">
                        <input class="btnSubmit" type="submit" name="submit" value="Cập nhật">
                        <a href="javascript:void(0)" class=" callPopup btnSubmit">Trả quầy</a>
                    </div>
                <?php } else {  ?>
                    <input type="hidden" name="status" value="bsk" >
                    <input type="hidden" name="bsk" value="<?php echo $_COOKIE['name_cookies']; ?>" >
                    <input type="hidden" name="action" value="edit_bsk" >
                    <div class="flexBox flexBox--arround flexBox__form flexBox__form--2">
                        <input class="btnSubmit" type="submit" name="submit" value="Cập nhật">
                        <a href="javascript:void(0)" class=" callPopup btnSubmit">Trả quầy</a>
                    </div>
                <?php } ?>

                <div class="popUp">
                    <h3 class="h3_page">Huỷ dịch vụ</h3>
                    <p class="inputBlock">
                        <input type="text" class="inputForm" name="reason_cancel" id="reason_cancel" placeholder="Lý do huỷ" />
                    </p>
                    <div class="flexBox flexBox--arround flexBox__form--2">
                        <a href="<?php echo APP_URL; ?>data/changeStt.php?idSurgery=<?php echo $post->ID; ?>&change=huy" class="btnSubmit" title="Hoàn tất">Huỷ</a>
                        <a href="javascript:void(0)" class="btnSubmit cancel">Quay lại</a>
                    </div>
                </div> 
            </form>
        <?php endwhile;endif; ?>
        <?php } ?>
    </div>
</div>


<!--Footer-->
<?php include(APP_PATH."libs/footer.php"); ?>
<!--/Footer-->
<!--===================================================-->
</div>
<!--/wrapper-->
</div>
<script type="text/javascript">
    $('#tab1').show();
    $('.tabItem li:nth-child(1)').addClass('active');
    $('.tabItem li').click(function() {
        $('.tabItem li').removeClass('active');
        $(this).toggleClass('active');
        var tabId = $(this).find('a').attr('data-id');
        $('.tabBox').fadeOut(200);
        $('#'+tabId).fadeIn(200);
    });       
    
    $('.callPopup').click(function() {
        $('.overlay').fadeIn(200);
        $('.popUp').fadeIn(200);
    });

    $('.overlay').click(function() {
        $(this).fadeOut(200);
        $('.popUp').fadeOut(200);
    });
    $('.cancel').click(function() {
        $('.overlay').fadeOut(200);
        $('.popUp').fadeOut(200);
    });
</script>

<div class="overlay"></div>


</body>
</html>	