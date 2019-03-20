<?php
include($_SERVER["DOCUMENT_ROOT"] . "/projects/klain/app_config.php");
if(!$_COOKIE['login_cookies']) {    
	header('Location:'.APP_URL.'login');
}
include(APP_PATH."libs/head.php"); 
?>
</head>

<body id="customer">
<!--===================================================-->
<div class="flexBox flexBox--between flexBox--wrap">
    <?php include(APP_PATH."libs/sidebar.php"); ?>
	<div id="wrapper">
	<!--===================================================-->
	<!--Header-->
	<?php include(APP_PATH."libs/header.php"); ?>
	<!--/Header-->
	
	<div class="blockPage blockPage--full maxW">
	<?php include(APP_PATH."libs/searchBlock.php"); ?>
			
			<h2 class="h2_page">Danh sách khách hàng</h2>
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
				$wp_query = new WP_Query();
				if(($_COOKIE['role_cookies']=='sale')||($_COOKIE['role_cookies']=='tvv')) {
					$param = array (
						'posts_per_page' => '20',
						'post_type' => 'customers',
						'post_status' => 'publish',
						'order' => 'DESC',
						'paged' => $paged,
						'meta_query'	=> array(
							array(
								'key' => 'creator',
								'value' => $_COOKIE['name_cookies'],
								'compare' => 'LIKE'
							),
						)
						);
				} else {
					$param = array (
						'posts_per_page' => '20',
						'post_type' => 'customers',
						'post_status' => 'publish',
						'order' => 'DESC',
						'paged' => $paged,
						);
				}		
				$wp_query->query($param);
				if($wp_query->have_posts()): while($wp_query->have_posts()) :$wp_query->the_post();
				?>
				<tr>
					<td><?php the_field('idcustomer'); ?></td>
					<td><?php the_title(); ?></td>
					<td><?php the_field('mobile'); ?></td>
					<td><?php the_field('idcard'); ?></td>
					<td class="last"><a href="<?php the_permalink(); ?>"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a></td>
				</tr>
				<?php endwhile;endif;  ?>
			</tbody>
		</table>
		<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
	</div>


	<!--Footer-->
	<?php include(APP_PATH."libs/footer.php"); ?>
	<!--/Footer-->
	
	</div>
	<!--/wrapper-->
	
</div>	

</body>
</html>	