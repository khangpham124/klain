<?php
include($_SERVER["DOCUMENT_ROOT"] . "/app_config.php");
include(APP_PATH."admin/wp-load.php");
$pid = $_POST['idPost'];

if($_POST['action']=='createSchedule') {
    $datechose = $_POST['datechose'];
    $problem = $_POST['problem'];
    $url = $_POST['url'];
    $listCare = get_field('listcare',$pid);
    $create_time = strtotime($datechose);

    if($create_time <= $listCare[5]['expire'] ) {
        echo 'time add:'.$create_time.'<br>';
        $s=0;
        foreach($listCare as $exp) {
            if($create_time > $exp['expire']) {
                $s++;
            }
        }
        $key = $s - 1;
        
        $oldDay = date('d/m/Y', $listCare[$key]['expire']);
        $note = 'Ngày khám theo đúng lịch:'.$oldDay;
        update_post_meta($pid, 'listcare'.'_'.$key.'_'.'stt' ,$problem, false);
        update_post_meta($pid, 'listcare'.'_'.$key.'_'.'note' ,$note, false);
        update_post_meta($pid, 'listcare'.'_'.$key.'_'.'expire' ,$create_time, false);
    } else {
        $curr_sche = count($listCare);
        $key = $curr_sche;
        $listCare[] = array(
            'expire' => $create_time,
            'name' => $name_cskh,
            'stt' => $problem,
        );
        update_field('listcare', $listCare, $pid);
    }
    
    header('Location:'.$url);
}
?>