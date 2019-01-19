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
<div id="wrapper">
<!--===================================================-->
<!--Header-->
<?php include(APP_PATH."libs/header.php"); ?>
<!--/Header-->


<div class="blockPage blockPage--full maxW">
        <h2 class="h2_page">Tìm kiếm thông tin khách hàng</h2>
        <form action="" method="post">
			<p class="inputBlock ui-widget">
            <input type="text" id="tags" name="search" class="inputForm" placeholder="Tìm kiếm" />
            <input type="submit" class="submitBtn searchBtn">
            </p>
        </form>
</div>

<div class="blockPage blockPage--full maxW">

		<div class="buttonBar">
			<a href="<?php echo APP_URL ?>add-customer/"><i class="fa fa-user-plus" aria-hidden="true"></i>Tạo khách hàng mới</a>
			<a href="javascript:void(0)" onClick="window.location.href=window.location.href"><i class="fa fa-refresh" aria-hidden="true"></i>Cập nhật hệ thống</a>
		</div>
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
			if(($_COOKIE['role_cookies']=='manager')||($_COOKIE['role_cookies']=='counter')) {
				if($_POST['search']=='') {
					$param = array (
					'posts_per_page' => '20',
					'post_type' => 'customers',
					'post_status' => 'publish',
					'order' => 'DESC',
					'paged' => $paged,
					);
				} else {
					$param = array (
						'posts_per_page' => '-1',
						'post_type' => 'customers',
						'post_status' => 'publish',
						'order' => 'DESC',
						'meta_query' => array(
						array(
						'key' => 'mobile',
						'value' => $_POST['search'],
						'compare' => '='
						))
					);
				}
			} else {
				$param = array (
					'posts_per_page' => '20',
					'post_type' => 'customers',
					'post_status' => 'publish',
					'order' => 'DESC',
					'meta_query' => array(
					array(
					'key' => 'creator',
					'value' =>  $_COOKIE['name_cookies'],
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