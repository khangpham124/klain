<?php
add_theme_support('post-thumbnails');
include($_SERVER["DOCUMENT_ROOT"] . "/app_config.php");
//login logo
function custom_login_logo() {
        echo '<style type="text/css">h1 a { background: url('.get_bloginfo('template_directory').'/images/logo.png) 50% 50% no-repeat !important; }</style>';
}

add_action('login_head', 'custom_login_logo');


//timthumb

define('THEME_DIR', get_template_directory_uri());
/* Timthumb CropCropimg */
function thumbCrop($img='', $w=false, $h=false, $zc=1){
    if($h)
        $h = "&amp;h=$h";
    else
        $h = "";
        
    if($w)
        $w = "&amp;w=$w";
    else
        $w = "";
    $img = str_replace(get_bloginfo('url'), '', $img);
    $image_url = THEME_DIR . "/timthumb/timthumb.php?src=" . $img . $h . $w ;
    return $image_url;

}
$image_cache = THEME_DIR . "/php/cache/";
chmod($image_cache, 0777);

// 管理画面サイドバーメニュー非表示
function remove_menus () {
    if (!current_user_can('level_9')) { //level9以下のユーザーの場合メニューをunsetする
    global $menu;
    var_dump($menu);
    unset($menu[2]);//ダッシュボード
    unset($menu[4]);//メニューの線1
    unset($menu[5]);//投稿
    unset($menu[15]);//リンク
    unset($menu[20]);//ページ
    unset($menu[25]);//コメント
    unset($menu[59]);//メニューの線2
    unset($menu[60]);//テーマ
    unset($menu[65]);//プラグイン
    unset($menu[70]);//プロフィール
    unset($menu[75]);//ツール
    unset($menu[80]);//設定
    unset($menu[90]);//メニューの線3
    }
}
add_action('admin_menu', 'remove_menus');

function custom_admin_footer() {
    echo 'Develop by Teddycoder';
}
add_filter('admin_footer_text', 'custom_admin_footer');

/* term drop down function */
function todo_restrict_manage_posts() {
    global $typenow;
    $args=array( 'public' => true, '_builtin' => false );
    $post_types = get_post_types($args);
    if ( in_array($typenow, $post_types) ) {
    $filters = get_object_taxonomies($typenow);
        foreach ($filters as $tax_slug) {
            $tax_obj = get_taxonomy($tax_slug);
            wp_dropdown_categories(array(
                'show_option_all' => __('カテゴリー '),
                'taxonomy' => $tax_slug,
                'name' => $tax_obj->name,
                'orderby' => 'term_order',
                'selected' => $_GET[$tax_obj->query_var],
                'hierarchical' => $tax_obj->hierarchical,
                'show_count' => false,
                'hide_empty' => true
            ));
        }
    }
}
function todo_convert_restrict($query) {
    global $pagenow;
    global $typenow;
    if ($pagenow=='edit.php') {
        $filters = get_object_taxonomies($typenow);
        foreach ($filters as $tax_slug) {
            $var = &$query->query_vars[$tax_slug];
            if ( isset($var) ) {
                $term = get_term_by('id',$var,$tax_slug);
                $var = $term->slug;
            }
        }
    }
    return $query;
}
add_action( 'restrict_manage_posts', 'todo_restrict_manage_posts' );
add_filter('parse_query','todo_convert_restrict');
/* term drop down function end*/



//for archives
global $my_archives_post_type;
add_filter( 'getarchives_where', 'my_getarchives_where', 10, 2 );
function my_getarchives_where( $where, $r ) {
  global $my_archives_post_type;
  if ( isset($r['post_type']) ) {
    $my_archives_post_type = $r['post_type'];
    $where = str_replace( '\'post\'', '\'' . $r['post_type'] . '\'', $where );
  } else {
    $my_archives_post_type = '';
  }
  return $where;
}
add_filter( 'get_archives_link', 'my_get_archives_link' );
function my_get_archives_link( $link_html ) {
  global $my_archives_post_type;
  if ( '' != $my_archives_post_type )
    $add_link .= '?post_type=' . $my_archives_post_type;
	$link_html = preg_replace("/href=\'(.+)\'\s/","href='$1".$add_link."'",$link_html);

  return $link_html;
}

// paging
$option_posts_per_page = get_option( 'posts_per_page' );
add_action( 'init', 'my_modify_posts_per_page', 0);
function my_modify_posts_per_page() {
    add_filter( 'option_posts_per_page', 'my_option_posts_per_page' );
}


// Custom post

//sample
add_action('init', 'my_custom_users');
function my_custom_users()
{
  $labels = array(
    'name' => _x('Users', 'post type general name'),
    'singular_name' => _x('Users', 'post type singular name'),
    'add_new' => _x('Add Users', 'news'),
    'add_new_item' => __('Add new item'),
    'edit_item' => __('Edit Users'),
    'new_item' => __('New Item'),
    'view_item' => __('View Item'),
    'search_staff' => __('sample記事を探す'),
    'not_found' =>  __('Not found'),
    'not_found_in_trash' => __('Not found'),
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => 5,
    'supports' => array('title','thumbnail'),
    'has_archive' => true
  );
  register_post_type('users',$args);
}


add_action('init', 'my_custom_customers');
function my_custom_customers()
{
  $labels = array(
    'name' => _x('Customers', 'post type general name'),
    'singular_name' => _x('Customers', 'post type singular name'),
    'add_new' => _x('Add Customers', 'news'),
    'add_new_item' => __('Add new item'),
    'edit_item' => __('Edit Customers'),
    'new_item' => __('New Item'),
    'view_item' => __('View Item'),
    'search_staff' => __('sample記事を探す'),
    'not_found' =>  __('Not found'),
    'not_found_in_trash' => __('Not found'),
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => 5,
    'supports' => array('title'),
    'has_archive' => true
  );
  register_post_type('customers',$args);
}

add_action('init', 'my_custom_services');
function my_custom_services()
{
  $labels = array(
    'name' => _x('Services', 'post type general name'),
    'singular_name' => _x('Services', 'post type singular name'),
    'add_new' => _x('Add Services', 'news'),
    'add_new_item' => __('Add new item'),
    'edit_item' => __('Edit Services'),
    'new_item' => __('New Item'),
    'view_item' => __('View Item'),
    'search_staff' => __('sample記事を探す'),
    'not_found' =>  __('Not found'),
    'not_found_in_trash' => __('Not found'),
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => 5,
    'supports' => array('title','editor','thumbnail'),
    'has_archive' => true
  );
  register_post_type('services',$args);
}

add_action ('init','create_servicescat_taxonomy','0');
function create_servicescat_taxonomy () {
	$taxonomylabels = array(
	'name' => _x('servicescat','post type general name'),
	'singular_name' => _x('servicescat','post type singular name'),
	'search_items' => __('servicescat'),
	'all_items' => __('servicescat'),
	'parent_item' => __( 'Parent Cat' ),
	'parent_item_colon' => __( 'Parent Cat:' ),
	'edit_item' => __('Edit item'),
	'add_new_item' => __('Add new item'),
	'menu_name' => __( 'categories' ),
	);
	$args = array(
	'labels' => $taxonomylabels,
	'hierarchical' => true,
	'has_archive' => true,
	'show_ui' => true,
	 'query_var' => true,
	 'rewrite' => array( 'slug' => 'servicescat' )
	);
    register_taxonomy('servicescat','services',$args);
}

add_action ('init','create_typecat_taxonomy','0');
function create_typecat_taxonomy () {
	$taxonomylabels = array(
	'name' => _x('typecat','post type general name'),
	'singular_name' => _x('typecat','post type singular name'),
	'search_items' => __('typecat'),
	'all_items' => __('typecat'),
	'parent_item' => __( 'Parent Cat' ),
	'parent_item_colon' => __( 'Parent Cat:' ),
	'edit_item' => __('Edit item'),
	'add_new_item' => __('Add new item'),
	'menu_name' => __( 'Type' ),
	);
	$args = array(
	'labels' => $taxonomylabels,
	'hierarchical' => true,
	'has_archive' => true,
	'show_ui' => true,
	 'query_var' => true,
	 'rewrite' => array( 'slug' => 'typecat' )
	);
    register_taxonomy('typecat','services',$args);
}


add_action('init', 'my_custom_ekip');
function my_custom_ekip()
{
  $labels = array(
    'name' => _x('Ekip', 'post type general name'),
    'singular_name' => _x('Ekip', 'post type singular name'),
    'add_new' => _x('Add Ekip', 'news'),
    'add_new_item' => __('Add new item'),
    'edit_item' => __('Edit Ekip'),
    'new_item' => __('New Item'),
    'view_item' => __('View Item'),
    'search_staff' => __('sample記事を探す'),
    'not_found' =>  __('Not found'),
    'not_found_in_trash' => __('Not found'),
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => 5,
    'supports' => array('title','editor'),
    'has_archive' => true
  );
  register_post_type('ekip',$args);
}

add_action('init', 'my_custom_surgery');
function my_custom_surgery()
{
  $labels = array(
    'name' => _x('Surgery', 'post type general name'),
    'singular_name' => _x('Surgery', 'post type singular name'),
    'add_new' => _x('Add Surgery', 'news'),
    'add_new_item' => __('Add new item'),
    'edit_item' => __('Edit Surgery'),
    'new_item' => __('New Item'),
    'view_item' => __('View Item'),
    'search_staff' => __('sample記事を探す'),
    'not_found' =>  __('Not found'),
    'not_found_in_trash' => __('Not found'),
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => 5,
    'supports' => array('title'),
    'has_archive' => true
  );
  register_post_type('Surgery',$args);
}

// make taxonomy
add_action ('init','create_userscat_taxonomy','0');
function create_userscat_taxonomy () {
	$taxonomylabels = array(
	'name' => _x('userscat','post type general name'),
	'singular_name' => _x('userscat','post type singular name'),
	'search_items' => __('userscat'),
	'all_items' => __('userscat'),
	'parent_item' => __( 'Parent Cat' ),
	'parent_item_colon' => __( 'Parent Cat:' ),
	'edit_item' => __('Edit item'),
	'add_new_item' => __('Add new item'),
	'menu_name' => __( 'categories' ),
	);
	$args = array(
	'labels' => $taxonomylabels,
	'hierarchical' => true,
	'has_archive' => true,
	'show_ui' => true,
	 'query_var' => true,
	 'rewrite' => array( 'slug' => 'userscat' )
	);
    register_taxonomy('userscat','users',$args);
}

add_action('init', 'my_custom_supplies');
function my_custom_supplies()
{
  $labels = array(
    'name' => _x('Supplies', 'post type general name'),
    'singular_name' => _x('Supplies', 'post type singular name'),
    'add_new' => _x('Add Supplies', 'news'),
    'add_new_item' => __('Add new item'),
    'edit_item' => __('Edit Supplies'),
    'new_item' => __('New Item'),
    'view_item' => __('View Item'),
    'search_staff' => __('sample記事を探す'),
    'not_found' =>  __('Not found'),
    'not_found_in_trash' => __('Not found'),
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => 5,
    'supports' => array('title'),
    'has_archive' => true
  );
  register_post_type('supplies',$args);
}

// Deal with images uploaded from the front-end while allowing ACF to do it's thing
function my_acf_pre_save_post($post_id) {

  if ( !function_exists('wp_handle_upload') ) {
  require_once(ABSPATH . 'wp-admin/includes/file.php');
  }
  
  // Move file to media library
  $movefile = wp_handle_upload( $_FILES['my_image_upload'], array('test_form' => false) );
  
  // If move was successful, insert WordPress attachment
  if ( $movefile && !isset($movefile['error']) ) {
  $wp_upload_dir = wp_upload_dir();
  $attachment = array(
  'guid' => $wp_upload_dir['url'] . '/' . basename($movefile['file']),
  'post_mime_type' => $movefile['type'],
  'post_title' => preg_replace( '/\.[^.]+$/', ”, basename($movefile['file']) ),
  'post_content' => ”,
  'post_status' => 'inherit'
  );
  $attach_id = wp_insert_attachment($attachment, $movefile['file']);
  
  // Assign the file as the featured image
  set_post_thumbnail($post_id, $attach_id);
  update_field('my_image_upload', $attach_id, $post_id);
  
  }
  
  return $post_id;
  
  }
  
  
  add_filter('acf/pre_save_post' , 'my_acf_pre_save_post');



add_action('init', 'my_custom_medical');
function my_custom_medical()
{
  $labels = array(
    'name' => _x('Medical', 'post type general name'),
    'singular_name' => _x('Medical', 'post type singular name'),
    'add_new' => _x('Add Medical', 'news'),
    'add_new_item' => __('Add new item'),
    'edit_item' => __('Edit Medical'),
    'new_item' => __('New Item'),
    'view_item' => __('View Item'),
    'search_staff' => __('sample記事を探す'),
    'not_found' =>  __('Not found'),
    'not_found_in_trash' => __('Not found'),
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => 5,
    'supports' => array('title'),
    'has_archive' => true
  );
  register_post_type('Medical',$args);
}

add_action('init', 'my_custom_care');
function my_custom_care()
{
  $labels = array(
    'name' => _x('Care', 'post type general name'),
    'singular_name' => _x('Care', 'post type singular name'),
    'add_new' => _x('Add Care', 'news'),
    'add_new_item' => __('Add new item'),
    'edit_item' => __('Edit Care'),
    'new_item' => __('New Item'),
    'view_item' => __('View Item'),
    'search_staff' => __('sample記事を探す'),
    'not_found' =>  __('Not found'),
    'not_found_in_trash' => __('Not found'),
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => 5,
    'supports' => array('title'),
    'has_archive' => true
  );
  register_post_type('care',$args);
}



function get_keys_for_duplicate_values($my_arr, $clean = false) {
  if ($clean) {
      return array_unique($my_arr);
  }

  $dups = $new_arr = array();
  foreach ($my_arr as $key => $val) {
    if (!isset($new_arr[$val])) {
       $new_arr[$val] = $key;
    } else {
      if (isset($dups[$val])) {
         $dups[$val][] = $key;
      } else {
         $dups[$val] = array($key);
         // Comment out the previous line, and uncomment the following line to
         // include the initial key in the dups array.
         // $dups[$val] = array($new_arr[$val], $key);
      }
    }
  }
  return $dups;
}






function arphabet_widgets_init() {

	register_sidebar( array(
		'name'          => 'Home right sidebar',
		'id'            => 'home_right_1',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'arphabet_widgets_init' );
