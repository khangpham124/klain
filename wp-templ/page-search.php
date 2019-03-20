<?php /* Template Name: Search */ ?>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/projects/klain/app_config.php");
include(APP_PATH."libs/head.php"); 
?>
</head>

<body id="search">
<div class="flexBox flexBox--between flexBox--wrap">
<?php include(APP_PATH."libs/sidebar.php"); ?>
<div id="wrapper">
<!--===================================================-->
<!--Header-->
<?php include(APP_PATH."libs/header.php"); ?>
<!--/Header-->

<div class="flexBox flexBox--between textBox flexBox--wrap">
<div class="blockPage blockPage--full">
    <h2 class="h2_page">Kết quả tìm kiếm</h2>
		<?php
			$search = $_POST['search'];
			$action = $_POST['action'];
			if($action=='') {
		?>
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
		<?php } else { ?>
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
				$param = array (
				's' => $search,      
				'posts_per_page' => '20',
				'post_type' => 'surgery',
				'post_status' => 'publish',
				'order' => 'DESC',
				'paged' => $paged,
				);
				$wp_query->query($param);
				if($wp_query->have_posts()): while($wp_query->have_posts()) :$wp_query->the_post();
				?>
				<tr >
					<td>
						<?php
						$stt = get_field('status');
						switch ($stt) {
							case "tvv":
								$stt_text = "Tư vấn viên";
							break;
							case "pending":
								$stt_text = "Chờ khám";
							break;
							case "quay":
								$stt_text = "Quầy";
							break;
							case "bsnk":
								$stt_text = "Bác sĩ ngoại khoa";
							break;
							case "bsk":
								$stt_text = "Bác sĩ Khải";
							break;
							case "batdau":
								$stt_text = "Đang mổ";
							break;
							case "phauthuat":
								$stt_text = "Phẫu thuật";
							break;
							case "hauphau":
								$stt_text = "Hậu phẫu";
							break;
							case "cshp":
								$stt_text = "CSKH";
							break;
							case "huy":
								$stt_text = "Đã Huỷ";
							break;
						}
						?>
						<?php if($stt=='batdau') { ?>
							<i class="fa fa-lock" aria-hidden="true"></i>
						<?php } ?>
						<span class="noteColor note--<?php echo $stt ?>"></span>
						<em><?php echo $stt_text ?></em>
					</td>
					<td><?php the_title(); ?></td>
					<td><?php the_field('fullname'); ?></td>
					<td><?php the_field('mobile'); ?></td>
					<?php if(($_COOKIE['role_cookies']=='manager')||($_COOKIE['role_cookies']=='boss')) { ?>
						<td class="last">
						<a href="<?php echo APP_URL; ?>form-counter/?idSurgery=<?php echo $post->ID; ?>" title="Quầy"><i class="fa fa-print" aria-hidden="true"></i></a>
						<a href="<?php echo APP_URL; ?>doctor-confirm/?idSurgery=<?php echo $post->ID; ?>" title="Bác sĩ khám"><i class="fa fa-stethoscope" aria-hidden="true"></i></a>
						<a href="<?php echo APP_URL; ?>ekip-surgery/?idSurgery=<?php echo $post->ID; ?>&idEkip=<?php echo $idEkip; ?>" title="Ca mổ"><i class="fa fa-heartbeat" aria-hidden="true"></i></a>
						<a href="<?php the_permalink(); ?>" title="Chi tiết"><i class="fa fa-info-circle" aria-hidden="true"></i></a></td>
						</td>        
					<?php } ?>

					<?php if($_COOKIE['role_cookies']=='counter') { ?>
						<td class="last">
							<a href="<?php echo APP_URL; ?>form-counter/?idSurgery=<?php echo $post->ID; ?>"><i class="fa fa-print" aria-hidden="true"></i></a>
							<?php if($stt=='quay') { ?>
							<a href="<?php echo APP_URL; ?>print?idSurgery=<?php echo $id_sur; ?>&form=counter" class="btnPrint <?php if(get_field('accept')=='no') { ?>disable<?php } ?>">In phiếu thu</a>
							<?php } ?>
							<a href="<?php the_permalink(); ?>" title="Chi tiết"><i class="fa fa-info-circle" aria-hidden="true"></i></a></td>
						</td>
					<?php } ?>

					<?php if(($_COOKIE['role_cookies']=='tvv')||($_COOKIE['role_cookies']=='sale')) { ?>
					<td class="last">
						<a href="<?php echo APP_URL; ?>print?idSurgery=<?php echo $post->ID; ?>&form=tvv"><i class="fa fa-print" aria-hidden="true"></i></a>
						<a href="<?php the_permalink(); ?>" title="Chi tiết"><i class="fa fa-info-circle" aria-hidden="true"></i></a></td>
					</td>
					<?php } ?>
					
					<?php if($_COOKIE['role_cookies']=='doctor') { ?>
						<?php if($stt=='pending') { ?>
						<td class="last"> <a href="<?php the_permalink(); ?>" title="Chi tiết"><i class="fa fa-info-circle" aria-hidden="true"></i></a></td></td>
						<?php } else { ?>
						<td class="last"><a href="<?php echo APP_URL; ?>doctor-confirm/?idSurgery=<?php echo $post->ID; ?>"><i class="fa fa-stethoscope" aria-hidden="true"></i></a></td>
						<?php } ?>
					<?php } ?>

					<?php if($_COOKIE['role_cookies']=='room') { 
					?>
					<?php if(($stt=='bsk')||($stt=='bsnk')||($stt=='batdau')) { ?>
						<td class="last">
							<?php if($stt=='batdau') { ?>
								<a href="<?php echo APP_URL; ?>data/changeStt.php?idSurgery=<?php echo $post->ID; ?>&change=phauthuat" title="Hoàn tất"><i class="fa fa-check-circle" aria-hidden="true"></i></a>
								<a href="<?php the_permalink(); ?>" title="Chi tiết"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
							<?php } else { ?>
								<a href="<?php echo APP_URL; ?>ekip-surgery/?idSurgery=<?php echo $post->ID; ?>"><i class="fa fa-heartbeat" aria-hidden="true"></i></a>
							<?php } ?>    
						</td>
					<?php } else { ?>
						<td class="last"><a href="<?php echo APP_URL; ?>after-surgery/?idSurgery=<?php echo $post->ID; ?>"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a></td>
					<?php } ?>

					<?php } ?>

					<?php if($_COOKIE['role_cookies']=='customer-care') { ?>
						<td class="last"> <a href="<?php the_permalink(); ?>" title="Chi tiết"><i class="fa fa-info-circle" aria-hidden="true"></i></a></td></td>
					<?php } ?>
				</tr>
				<?php endwhile;endif;  ?>
			</tbody>
			</table> 
			<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
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

</body>
</html>	