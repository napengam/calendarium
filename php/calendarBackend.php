<?php

include __DIR__ . '/hgsCalendar.php';

///////////////////////////////////////
/////////////////  MAIN ///////////////
///////////////////////////////////////


$json = json_decode(file_get_contents('php://input'), true);
$y = $json['y'];
$m = $json['m'];
$target = $json['target'];
$cal = new hgsCalendar();
$json['result'] = $cal->make_calendar($m, $y, $target);
echo json_encode($json);
