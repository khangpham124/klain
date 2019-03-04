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
<!--===================================================-->
<div id="wrapper">
<!--===================================================-->
<!--Header-->
<?php include(APP_PATH."libs/header.php"); ?>
<!--/Header-->

<div class="flexBox flexBox--between textBox flexBox--wrap maxW">
    <div class="blockPage blockPage--full">
        <h2 class="h2_page">Thong tin benh an</h2>
            <?php
                $id_sur = $_GET['idSurgery'];
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
            <div class="flexBox flexBox--between flexBox__form flexBox__form--3">
                <p class="inputBlock">
                <input type="text" class="inputForm" name="fullname" placeholder="Họ tên" readonly value="<?php the_field('fullname'); ?>" />
                </p>
                <p class="inputBlock">
                <input type="text" class="inputForm" name="idcard" placeholder="Só CMND" readonly value="<?php the_field('idcard'); ?>" />
                </p>
                <p class="inputBlock">
                <input type="text" class="inputForm" name="mobile" placeholder="Mobile" readonly value="<?php the_field('mobile'); ?>" />
                </p>
            </div>

            <form action="<?php echo APP_URL; ?>data/editSurgery.php" method="post" enctype="multipart/form-data">
                <h3 class="h3_page">Bệnh Án</h3>
                    <h4 class="h4_page">Dịch vụ yêu cầu : <?php the_field('services'); ?></h4>
                    <h4 class="h4_page">Hoi benh</h4>
                    <div class="inputBlock">
                        <label class="smallLabel">Qua trinh benh ly</label>
                        <textarea class="inputForm" name="howto" placeholder=""></textarea>
                        <div class="flexBox flexBox--between flexBox__form flexBox__form--2 mb10">
                            <p class="inputBlock borderBox" id="radHis">
                                <label class="smallLabel">Di ung thuoc</label>
                                <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Co</label>
                                <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Khong</label>
                            </p>
                            <p class="inputBlock borderBox" id="radHis">
                                <label class="smallLabel">Di ung thuc an</label>
                                <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Co</label>
                                <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Khong</label>
                            </p>
                        </div>
                        <label class="smallLabel">Tien can noi khoa</label>
                        <textarea class="inputForm" name="howto" placeholder=""></textarea>
                        <label class="smallLabel">Tien can ngoai khoa</label>
                        <textarea class="inputForm" name="howto" placeholder=""></textarea>
                        <label class="smallLabel">Kinh nguyet</label>
                        <textarea class="inputForm" name="howto" placeholder=""></textarea>
                        <label class="smallLabel">Gia dinh</label>
                        <textarea class="inputForm" name="howto" placeholder=""></textarea>
                    </div>

                     <h4 class="h4_page">Khám bệnh</h4>
                    <div class="inputBlock">
                        <label class="smallLabel">Toàn thân</label>
                        <textarea class="inputForm" name="howto" placeholder=""></textarea>
                        <div class="flexBox flexBox--between flexBox__form flexBox__form--2">
                            <div class="inputBlock">
                                <label class="smallLabel">Mạch</label>
                                <input type="text" class="inputForm" name="discount" id="discount" value="" placeholder="Giá giảm" />
                                <label class="smallLabel">Nhiệt đõ</label>
                                <input type="text" class="inputForm" name="discount" id="discount" value="" placeholder="Giá giảm" />
                                <label class="smallLabel">Huyết áp</label>
                                <input type="text" class="inputForm" name="discount" id="discount" value="" placeholder="Giá giảm" />
                            </div>
                            <div class="inputBlock">
                                <label class="smallLabel">Nhịp thở</label>
                                <input type="text" class="inputForm" name="discount" id="discount" value="" placeholder="Giá giảm" />
                                <label class="smallLabel">Can nang</label>
                                <input type="text" class="inputForm" name="discount" id="discount" value="" placeholder="Giá giảm" />
                            </div>
                        </div>


                        <label class="smallLabel">Bệnh ngoại khoa</label>
                        <textarea class="inputForm" name="howto" placeholder=""></textarea>

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
                                            <select>
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
                                            <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Mũi silastic</label>
                                            <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Mũi bọc sụn</label>
                                            <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Mũi cấu trúc</label>
                                        </p>
                                        <input type="text" class="inputForm mb10" name="" id="" value="" placeholder="Hình dạng tổng quát" />
                                        <input type="text" class="inputForm" name="" id="" value="" placeholder="Sẹo vùng mũi" />
                                        </td>
                                    </tr>


                                    <tr>
                                        <th>Sóng mũi</th>
                                        <td>
                                        <div class="mb10">
                                        <label class="smallLabel">Xượng mũi (gồ)</label>
                                        <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Có</label>
                                        <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Không</label>
                                        <label class="smallLabel">Lệch</label>
                                        <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Có</label>
                                        <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Không</label>

                                        <label class="smallLabel">Bè</label>
                                        <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Có</label>
                                        <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Không</label>

                                        <label class="smallLabel">Đục xương</label>
                                        <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Có</label>
                                        <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Không</label>
                                        </div>
                                
                                        <input type="text" class="inputForm" name="discount" id="discount" value="" placeholder="Vi tri Radix" />
                                        </td>
                                    </tr>


                                    <tr>
                                        <th>Đầu mũi</th>
                                        <td>
                                        <label class="smallLabel">To</label>
                                        <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Co</label>
                                        <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Không</label>
                                        <label class="smallLabel">Mô mềm đầu mũi</label>
                                        <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Nhiều</label>
                                        <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Ít</label>
                                        <label class="smallLabel">Đầu mũi ngắn</label>
                                        <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Nhiều</label>
                                        <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Ít</label>

                                        <label class="smallLabel">Góc mũi môi</label>
                                        <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Hech</label>
                                        <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Khong hech</label>

                                        <label class="smallLabel">Da mũi</label>
                                        <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Day</label>
                                        <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Mong</label>

                                        <label class="smallLabel">Độ nảy đầu mũi</label>
                                        
                                        <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">1</label>
                                        <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">2</label>
                                        <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">3</label>
                                        <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">4</label>
                                        <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">5</label>
                                        

                                        <label class="smallLabel">Đánh giá vách ngăn</label>
                                        <div class="flexBox flexBox--between flexBox__form flexBox__form--2 mb10">
                                            <div class="inputBlock borderBox">
                                                <label class="smallLabel">Vẹo</label>
                                                <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Có</label>
                                                <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Không</label>
                                            </div>
                                            <div class="inputBlock borderBox">
                                                <label class="smallLabel">Cong Lõm</label>
                                                <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Trái</label>
                                                <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Phải</label>
                                            </div>
                                        </div>
                                        <input type="text" class="inputForm mb10" name="discount" id="discount" value="" placeholder="Vật liệu sử dụng" />
                                        <input type="text" class="inputForm" name="discount" id="discount" value="" placeholder="Cách dựng trụ" />

                                        <label class="smallLabel">Tien dinh mui</label>
                                        <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Không khuyết</label>
                                        <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Khuyết</label>
                                        <input type="text" class="inputForm mb10" name="discount" id="discount" value="" placeholder="Cần ghép chỗ khuyết" />
                                        </td>
                                    </tr>


                                    <tr>
                                        <th>Cánh mũi</th>
                                        <td>
                                            <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Mỏng</label>
                                            <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Dày</label>
                                            <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Cong nhìều</label>
                                            <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Cong ít</label>
                                            <div class="mt10">
                                                <input type="text" class="inputForm mb10" name="discount" id="discount" value="" placeholder="Cắt cánh mũi?" />
                                                <input type="text" class="inputForm" name="discount" id="discount" value="" placeholder="Treo cánh mũi?" />
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <th>Nền mũi</th>
                                        <td>
                                            <p class="mb10">
                                                <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Cao</label>
                                                <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Thấp</label>
                                                <input type="text" class="inputForm" name="discount" id="discount" value="" placeholder="Rãnh mũi nông sâu?" />
                                            </p>
                                            <label class="smallLabel">Đường khính nền mũi / khoảng cách 2 khoé mắt</label>
                                            <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Rộng</label>
                                            <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Bằng</label>
                                            <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Nhỏ</label>
                                            <input type="text" class="inputForm" name="discount" id="discount" value="" placeholder="Thu nền mũi ?" /> 
                                        </td>
                                    </tr>


                                    <tr>
                                        <th>Sụn cánh mũi</th>
                                        <td>
                                        <p class="mb10">
                                            <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Nho</label>
                                            <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">To</label>
                                        </p>
                                        <input type="text" class="inputForm" name="discount" id="discount" value="" placeholder="Bi bien dang?" />
                                        </td>
                                    </tr>


                                    <tr>
                                        <th>Mũi khi cười bị kéo dài</th>
                                        <td>
                                        <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Có</label>
                                        <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Không</label>
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
                                            <select>
                                                <option value="">Số lần</option>
                                                <?php for($i=0;$i<=10;$i++) { ?>
                                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                                <?php } ?>
                                            </select>
                                        </p>
                                        <p class="mb10">
                                            <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Nhấn mí</label>
                                            <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Cắt mí</label>
                                        </p>
                                        
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Mô tả mí hiện tại</th>
                                        <td>
                                            <p class="mb10">
                                                <label class="smallLabel">Có mí </label>
                                                <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Có</label>
                                                <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Không</label>
                                            </p>
                                            
                                            <p class="mb10">
                                                <label class="smallLabel">Độ dư da 2 bên</label>
                                                <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Đều</label>
                                                <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Không Đều</label>
                                            </p>
                                            <p class="mb10">
                                                <label class="smallLabel">Da dư làm nhở mắt</label>
                                                <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Có</label>
                                                <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Không</label>
                                            </p>
                                            <textarea class="inputForm" name="bsk" id="bsk" placeholder="Ghi chú khác"></textarea>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <th>Khe mí hai bên</th>
                                        <td>
                                        <p class="mb10">
                                            <label class="smallLabel">Có yếu cơ nâng mi hay chênh lệch?</label>
                                            <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Có</label>
                                            <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Không</label>
                                        </p>
                                        <p class="mb10">
                                            <label class="smallLabel">Có sự hỗ trợ mở mắt của các cơ lân cận ?</label>
                                            <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Có</label>
                                            <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Không</label>
                                        </p>
                                        </td>
                                    </tr>  

                                    <tr>
                                        <th>Góc mắt trong</th>
                                        <td><input type="text" class="inputForm" name="discount" id="discount" value="" placeholder="Mô tả" /> </td>
                                    </tr>
                                    
                                    <tr>
                                        <th>Góc mắt ngoài</th>
                                        <td><input type="text" class="inputForm" name="discount" id="discount" value="" placeholder="Mô tả" /> </td>
                                    </tr>


                                    <tr>
                                        <th>Mỡ mắt</th>
                                        <td>
                                            <input type="text" class="inputForm" name="discount" id="discount" value="" placeholder="Mỡ góc trong" />
                                            <input type="text" class="inputForm" name="discount" id="discount" value="" placeholder="Mỡ góc ngoài" />
                                            <input type="text" class="inputForm" name="discount" id="discount" value="" placeholder="thiếu vùng nào" />
                                        </td>
                                    </tr>  

                                    <tr>
                                        <th>Mô duới mắt</th>
                                        <td>
                                            <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Nhão</label>
                                            <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Căng</label>
                                        </td>
                                    </tr>  
                                    <tr>
                                        <th>Mô dưới da</th>
                                        <td>
                                            <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Nhiều</label>
                                            <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Ít</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Sa tuyến lệ</th>
                                        <td>
                                            <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Có</label>
                                            <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Không</label>
                                        </td>
                                    </tr> 
                                    
                                    <tr>
                                        <th>Lông mi</th>
                                        <td>
                                            <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Ngắn</label>
                                            <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Dài</label>
                                            <p class="mb10">
                                            <label class="smallLabel">Độ vểnh lông mi</label>
                                            <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Nhiều</label>
                                            <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Ít</label>
                                            </p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Cung mày</th>
                                        <td>
                                            <input type="text" class="inputForm" name="discount" id="discount" value="" placeholder="Vị trí cung mày so vớ gờ xương ổ mắt" />
                                            <input type="text" class="inputForm" name="discount" id="discount" value="" placeholder="Khoảng cách cung mày và nếp mí" />
                                            <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Đều</label>
                                            <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Không Đều</label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Lưu ý</th>
                                        <td>
                                            <input type="text" class="inputForm" name="discount" id="discount" value="" placeholder="Khi khách nhắm mở mắt" />
                                            <input type="text" class="inputForm" name="discount" id="discount" value="" placeholder="Khi khách cười" />
                                            <input type="text" class="inputForm" name="discount" id="discount" value="" placeholder="Nếp nhăn đuội mắt" />
                                        </td>
                                    </tr> 
                                </table> 
                                
                                <h4 class="h4_page">MÍ DƯỚI</h4>
                                <table class="tblPage">
                                    <tr>
                                        <th>Số lần phẫu thuật mũi</th>
                                        <td>
                                        <p class="inputBlock customSelect">
                                            <select>
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
                                            <input type="text" class="inputForm" name="discount" id="discount" value="" placeholder="Đánh giá vùng thừa, vùng thiếu mỡ, mô mi dưới" />
                                            <input type="text" class="inputForm" name="discount" id="discount" value="" placeholder="Tình trạng sa trễ , yếu mi dưới" />
                                            <input type="text" class="inputForm" name="discount" id="discount" value="" placeholder="Tình trạng khi khách cười" />
                                            <p class="mb10">
                                            <label class="smallLabel">Bờ mi có tiền tuyến đồng tử</label>
                                            <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Có </label>
                                            <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Không</label>
                                            </p>
                                            <p class="mb10">
                                            <label class="smallLabel">Có hở tròng trắng</label>
                                            <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Có </label>
                                            <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Không</label>
                                            </p>
                                        </td>
                                    </tr>     

                                </table>     
                            </div>
                            <div class="tabBox" id="tab3">
                                <table class="tblPage">
                                    <tr>
                                        <th>Số lần phẫu thuật mũi</th>
                                        <td>
                                            <input type="radio" class="radioForm" id="rad3" name="hasSur" value="yes" /><label class="labelReg" for="rad3">Đều</label>
                                            <input type="radio" class="radioForm" id="rad4" name="hasSur" value="no" /><label class="labelReg" for="rad4">Không đều</label>
                                            <input type="text" class="inputForm" name="discount" id="discount" value="" placeholder="Bên nào nhô nhiều?" />
                                            <input type="text" class="inputForm" name="discount" id="discount" value="" placeholder="Thiếu cằm chiều nào?" />
                                        </td>
                                    </tr>
                                    </table>
                            </div>
                            <div class="tabBox" id="tab4">
                                
                            </div>
                        </div>
                    </div>





                    <!-- <h4 class="h4_page">Hình ảnh trước phẫu thuật</h4>
                    <?php
                    // $numb_image = get_field('numb_image');
                    // for($i=1;$i<=$numb_image;$i++) {
                    ?>
                    <label class="file">
                        <input type="file" name="file<?php echo $i; ?>" id="file<?php echo $i; ?>" accept="image/*" capture="camera">
                        <span class="file-custom"></span>
                    </label>
                    <?php //} ?> -->
                
                <h3 class="h3_page">Dành riêng cho BSK</h3>    
                <textarea class="inputForm" <?php if($_COOKIE['role_cookies']!='boss') { ?>readonly<?php } ?> name="bsk" id="bsk"></textarea>
                
                <input type="hidden" name="idSurgery" value="<?php echo $_GET['idSurgery']; ?>" >
                <?php if($_COOKIE['role_cookies']=='doctor') { ?>
                    <input type="hidden" name="status" value="bsnk" >
                    <input type="hidden" name="bsnk" value="<?php echo $_COOKIE['name_cookies']; ?>" >
                    <input type="hidden" name="numb_image" value="<?php echo $numb_image; ?>" >
                    <input class="btnSubmit" type="submit" name="submit" value="Cập nhật">
                    <input type="hidden" name="action" value="edit_bsnk" >
                <?php } else {  ?>
                    <input type="hidden" name="status" value="bsk" >
                    <input class="btnSubmit" type="submit" name="submit" value="Tạo">
                    <input type="hidden" name="bsk" value="<?php echo $_COOKIE['name_cookies']; ?>" >
                    <input type="hidden" name="action" value="edit_bsk" >
                <?php } ?>    
            </form>
        <?php endwhile;endif; ?>    
    </div>
</div>


<!--Footer-->
<?php include(APP_PATH."libs/footer.php"); ?>
<!--/Footer-->
<!--===================================================-->
</div>
<!--/wrapper-->
<!--===================================================-->
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
</script>

</body>
</html>	