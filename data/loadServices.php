<?php
include($_SERVER["DOCUMENT_ROOT"] . "/projects/klain/app_config.php");
include(APP_PATH."admin/wp-load.php");
$services = $_GET['services'];
$count = $_GET['count'];
?>

<div class="flexBox flexBox--between flexBox__form flexBox__form--3 mt10">
    <p class="inputBlock customSelect mt0">
        <select name="services<?php echo $count; ?>" class="services servicesSl">
            <option value="">Lựa chọn dịch vụ</option>
            <?php
                $wp_query = new WP_Query();
                $param = array (
                    'posts_per_page' => '-1',
                    'post_type' => 'services',
                    'post_status' => 'publish',
                    'order' => 'DESC',
                    'meta_query' => array(
                        array(
                        'key' => 'main',
                        'value' => $services,
                        'compare' => '='
                        ))
                );
                $wp_query->query($param);
                if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
            ?>
                <option data-image="<?php echo get_field('numb_image'); ?>" data-type="<?php echo $typecat_serve; ?>" data-price="<?php echo get_field('price'); ?>" class="<?php echo $type_serve; ?>" value="<?php the_title(); ?>"><?php the_title(); ?></option>
            <?php endwhile;endif; ?>
        </select>
    </p>
    <p class="inputBlock">
    <input type="text" class="inputForm priceNumb" readonly name="price_<?php echo $count; ?>" value="" placeholder="Giá" />
    </p>
    <p class="inputBlock inputNumber">
        <input type="text" data-type="number" class="inputForm" name="sale_discount_<?php echo $count; ?>" id="discount" value="" placeholder="Giá giảm" />
        <span></span>
    </p>
</div>
