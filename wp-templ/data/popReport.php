<?php
include($_SERVER["DOCUMENT_ROOT"] . "/app_config.php");
include(APP_PATH."admin/wp-load.php");
?>

<div class="blockPage blockPage--full">
        <h2 class="h2_page">Thông tin hậu phẫu</h2>
            <form action="<?php echo APP_URL; ?>data/editSurgery.php" method="post" enctype="multipart/form-data" id="addServices">
            <?php
                $id_sur = $_GET['idSurgery'];
            ?>
            <h3 class="h3_page">Tường trình phẫu thuật</h3>
            <div class="flexBox flexBox--between flexBox__form flexBox__form--3">
                <textarea class="inputForm" name="report" id="report"><?php the_field('report'); ?></textarea>
            </div>

            <h3 class="h3_page">Vật tư sử dụng</h3>
            <table class="tblPage">
                <thead>
                    <tr>
                        <td>Vật tư</td>
                        <td>Đơn vị</td>
                        <td>Số lượng</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $n=0;
                        $wp_query = new WP_Query();
                        $param=array(
                        'post_type'=>'supplies',
                        'order' => 'DESC',
                        'posts_per_page' => '-1',
                        );
                        $wp_query->query($param);
                        if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                        $n++;
                    ?>
                    <tr>
                        <td><?php the_title(); ?></td>
                        <td>Cái</td>
                        <td>
                        <p class="inputBlock customSelect">
                        <select name="supplies<?php echo $n; ?>">
                            <?php for($i=0;$i<=10;$i++) { ?>
                            <option value="<?php the_title(); ?>-<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php } ?>
                        </select>
                        </p>
                        </td>
                    </tr>
                    <?php endwhile;endif; ?>
                </tbody>
            </table>
            <input type="hidden" name="idSurgery" id="idSurgery" value="<?php echo $_COOKIE['sur_cookies']; ?>" >
            <input type="hidden" name="action" value="ekip_report" >
            <?php
            $surger_cf = get_field('services_list',$_COOKIE['sur_cookies']);
            $surger_remain = array();
            for($i=0; $i < count($surger_cf); $i++){
                if($surger_cf[$i]['do']!='yes') {
                    $surger_remain[]=$surger_cf[$i]['name'];
                }
            }
            $remin_s = count($surger_remain);
            if($remin_s==0) {
            ?>
            <input type="hidden" name="status" value="hauphau" >
            <?php } else { ?>
            <input type="hidden" name="status" value="phauthuat" >
            <?php } ?>
            <input class="btnSubmit" type="submit" name="submit" value="Hoàn tất">
        </form>
</div>