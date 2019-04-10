<?php
include($_SERVER["DOCUMENT_ROOT"] . "/app_config.php");
include(APP_PATH."admin/wp-load.php");
$pid = $_POST['idPost'];

if($_POST['action']=='createSchedule') {
    $datechose = $_POST['datechose'];
    $problem = $_POST['problem'];
    $url = $_POST['url'];

    $create_time = strtotime($datechose);
    echo 'time add:'.$create_time.'<br>';
    $listCare = get_field('listcare',$pid);
    $s=0;
    foreach($listCare as $exp) {
        if($create_time > $exp['expire']) {
            $s++;
        }
    }
    $key = $s - 1;
    
    $oldDay = date('d/m/Y', $listCare[$key]['expire']);
    $note = 'Ngày khám theo đúng lịch:'.$oldDay;
    update_post_meta($pid, 'listcare'.'_'.$key.'_'.'note' ,$note, false);
    update_post_meta($pid, 'listcare'.'_'.$key.'_'.'expire' ,$create_time, false);
    header('Location:'.$url);
}
?>