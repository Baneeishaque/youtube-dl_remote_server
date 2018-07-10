<?php

include_once 'config.php';

header('Access-Control-Allow-Origin: *');

//$line_seperator='<br/>';
$line_seperator='\n';

$url = filter_input(INPUT_GET, 'url');
//echo "Encoded URL is " . $url . $line_seperator;

$encoding_result = base64_decode($url, TRUE);
if ($encoding_result != FALSE) {
    echo "Decoded URL is " . $encoding_result . $line_seperator;
} else {
    echo "Failed to decode the URL..." . $line_seperator;
}

$insert_task_sql = "INSERT INTO `tasks` (`url`,`insertion_date_time`) VALUES ('$encoding_result', CONVERT_TZ(NOW(),'-05:30','+00:00'))";

//echo "Insert Task SQL is " . $insert_task_sql. $line_seperator;

if (!$aria2_remote_connection->query($insert_task_sql)) {
    echo "Insertion Error, Error_number " . $aria2_remote_connection->errorno . ", Error " . $aria2_remote_connection->error. $line_seperator;
} else {
    echo "Insertion success". $line_seperator;
}