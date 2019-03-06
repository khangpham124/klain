<?php
include($_SERVER["DOCUMENT_ROOT"] . "/projects/klain/app_config.php");
include(APP_PATH."admin/wp-load.php");
if($_POST['action']!='') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $numb_img = $_POST['numb_img'];
    $services = $_POST['services'];
    $main = $_POST['main'];
    $type = $_POST['type'];
    $user_post = array(
        'post_title'    => $name,
        'post_status'   => 'publish',
        'post_type' => 'services',
    );
    $pid = wp_insert_post($user_post); 
    wp_set_object_terms( $pid, $services, 'servicescat' );
    wp_set_object_terms( $pid, $type, 'typecat' );
    add_post_meta($pid, 'price', $price);
    add_post_meta($pid, 'main', $main);
    header('Location:'.APP_URL.'services');
}
?>