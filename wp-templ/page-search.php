<?php /* Template Name: Search */ ?>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/projects/klain/app_config.php");
include(APP_PATH."libs/head.php"); 
?>
</head>

<body id="login">
<!--===================================================-->
<div id="wrapper">
<!--===================================================-->
<!--Header-->
<?php include(APP_PATH."libs/header.php"); ?>
<!--/Header-->

<div class="flexBox flexBox--between textBox flexBox--wrap">
<div class="blockPage blockPage--full">
    <h2 class="h2_page">Kết quả tìm kiếm</h2>
        <table class="tblPage">
		<thead>
			<tr>
				<td>ID</td>
				<td>Họ tên</td>
				<td>Số điện thoại</td>
				<td>Số CMND</td>
				<td>Chi tiết</td>
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
				<td><?php the_field('idcustomer'); ?></td>
				<td><?php the_field('fullname'); ?></td>
				<td><?php the_field('mobile'); ?></td>
				<td><?php the_field('idcard'); ?></td>
				<td class="last"><a href="<?php the_permalink(); ?>"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a></td>
			</tr>
			<?php endwhile;endif;  ?>
		</tbody>
    </table>
    
    <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>

</div>
</div>


<!--Footer-->
<?php include(APP_PATH."libs/footer.php"); ?>
<!--/Footer-->
<!--===================================================-->
</div>
<!--/wrapper-->
<!--===================================================-->

</body>
</html>	