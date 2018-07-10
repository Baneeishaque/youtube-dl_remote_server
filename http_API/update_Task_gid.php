<?php

include_once 'config.php';

$id = filter_input(INPUT_POST, 'id');
$gid = filter_input(INPUT_POST, 'gid');

//Status 1 : Added to downloads
$update_task_sql = "UPDATE `tasks` SET `gid`='$gid',`status`=1,`modification_date_time`=CONVERT_TZ(NOW(),'-05:30','+00:00') WHERE `id`=$id";

//echo $update_task_sql;

if (!$aria2_remote_connection->query($update_task_sql)) {
    $result_array = array("error_status" => "1", "error_number" => $aria2_remote_connection->errorno, "error" => $aria2_remote_connection->error);
} else {
    $result_array = array("error_status" => "0");
}
echo json_encode($result_array);
