<?php
include($_SERVER["DOCUMENT_ROOT"] . "/app_config.php");
include(APP_PATH."admin/wp-load.php");

$mobile = $_POST['username'];
$pw = md5($_POST['password']);
	$arr_user = array();
	$wp_query = new WP_Query();
	$param = array (
	's' => $username,	
	'posts_per_page' => '-1',
	'post_type' => 'users',
	'post_status' => 'publish',
	'meta_query' => array(
		array(
		'key' => 'mobile',
		'value' => $mobile,
		'compare' => '='
		))
	);
	$wp_query->query($param);
	$numb_result = count($wp_query->query($param));
	if($numb_result > 0) {
		while($wp_query->have_posts()) :$wp_query->the_post();
			$username = $post->post_title;
			$fullname = get_field('fullname');
			$pass_real = get_field('password');
			$terms = get_the_terms($post->ID, 'userscat');
			foreach($terms as $term) { 
				$role_user = $term->slug;
			}
			if($pass_real==$pw) {
				setcookie('login_cookies', $username, time() + (86400 * 30), "/");
				setcookie('role_cookies', $role_user, time() + (86400 * 30), "/");
				setcookie('name_cookies', $fullname, time() + (86400 * 30), "/");
				header('Location:'.APP_URL);
			}
			else {
				header('Location:'.APP_URL.'login');
			}
		endwhile;
	} else {
		header('Location:'.APP_URL.'login');
	}
?>