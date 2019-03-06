<?php
include($_SERVER["DOCUMENT_ROOT"] . "/projects/klain/app_config.php");
include(APP_PATH."admin/wp-load.php");
?>

<h2 class="h2_page">Kết quả tìm kiếm</h2>
<table class="tblPage">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Họ tên</td>
                    <td>Số điện thoại</td>
                    <td>Địa chỉ</td>
                    <td>Số CMND</td>
                    <td>Facebook</td>
                </tr>
            </thead>
            <tbody>
            <?php
            $search = $_POST['search'];
			$wp_query = new WP_Query();
			if($_POST['option']=='title') {
					$param = array (
                    's' => $search,      
					'posts_per_page' => '20',
					'post_type' => 'customers',
					'post_status' => 'publish',
					'order' => 'DESC',
					'paged' => $paged,
					);
            }
            if($_POST['option']=='id') {
				$param = array (
					'posts_per_page' => '20',
					'post_type' => 'customers',
					'post_status' => 'publish',
					'order' => 'DESC',
					'meta_query' => array(
					array(
					'key' => 'idcustomer',
					'value' =>  $search,
					'compare' => '='
					))	
				);
            }	
            if($_POST['option']=='mobile') {
				$param = array (
					'posts_per_page' => '20',
					'post_type' => 'customers',
					'post_status' => 'publish',
					'order' => 'DESC',
					'meta_query' => array(
					array(
					'key' => 'mobile',
					'value' =>  $search,
					'compare' => '='
					))	
				);
            }	
            if($_POST['option']=='idcard') {
				$param = array (
					'posts_per_page' => '20',
					'post_type' => 'customers',
					'post_status' => 'publish',
					'order' => 'DESC',
					'meta_query' => array(
					array(
					'key' => 'idcard',
					'value' =>  $search,
					'compare' => '='
					))	
				);
            }	
            
			$wp_query->query($param);
			if($wp_query->have_posts()): while($wp_query->have_posts()) :$wp_query->the_post();
			?>
                <tr>
                    <td id="cus_id"><?php if(get_field('idcustomer')==''){ ?>Chưa có<?php } else { echo get_field('idcustomer'); } ?></td>
                    <td id="cus_name"><?php the_title(); ?></td>
                    <td id="cus_mobile"><?php the_field('mobile') ?></td>
                    <td id="cus_add"><?php the_field('address') ?></td>
                    <td id="cus_idcard"><?php the_field('idcard') ?></td>
                    <td class="last text"><a href="javascript:void(0)" id="getData">Sử dụng</i></a></td>
                </tr>
        <?php endwhile; endif; ?>
    </tbody>
</table>