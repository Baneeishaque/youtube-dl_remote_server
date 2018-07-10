<?php

$cpanel_username = "vfmobo6d";
$aria2_remote_connection = new mysqli("localhost", $cpanel_username . "_ndk", "aA9895204814", $cpanel_username . "_youtube-dl_remote");

if ($aria2_remote_connection->connect_errno) {
//    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    $result_array = array();
    array_push($result_array, array("error_status" => "1", "error" => $aria2_remote_connection->connect_error, "error_number" => $aria2_remote_connection->connect_errno));
    echo json_encode($result_array);
    exit;
}