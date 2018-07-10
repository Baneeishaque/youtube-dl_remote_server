<?php

include_once 'config.php';

$name = filter_input(INPUT_POST, 'name');
//echo "Host : ".$name;

$select_host_sql = "SELECT `id` FROM `hosts` WHERE `name`='$name'";

$result_array = array();

if (!$select_host_result = $aria2_remote_connection->query($select_host_sql)) {
    $result_array = array("error_status" => "1", "error" => $aria2_remote_connection->error, "error_number" => $aria2_remote_connection->errorno);
} else {
    //Status 1 : Live
    if ($select_host_result->num_rows === 0) {
        $insert_update_host_sql = "INSERT INTO `hosts`(`name`, `status`, `nick`, `insertion_date_time`, `modification_date_time`) VALUES ('$name',1,'$name',CONVERT_TZ(NOW(),'-05:30','+00:00'),CONVERT_TZ(NOW(),'-05:30','+00:00'))";
    } else {
        $insert_update_host_sql = "UPDATE `hosts` SET `status`=1,`modification_date_time`=CONVERT_TZ(NOW(),'-05:30','+00:00') WHERE `name`='$name'";
    }
    if (!$aria2_remote_connection->query($insert_update_host_sql)) {
        $result_array = array("error_status" => "1", "error_number" => $aria2_remote_connection->errorno, "error" => $aria2_remote_connection->error);
    } else {
        $result_array = array("error_status" => "0");
    }
}

echo json_encode($result_array);
