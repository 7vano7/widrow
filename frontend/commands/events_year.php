<?php

$file = '/frontend/runtime/logs/cron.log';

$link = mysqli_connect('localhost', 'bzczfvjo', 'B6qyFBq0@D+v37', 'bzczfvjo_archery') or die("Не могу соединиться с MySQL.");
$date = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s'), '-5 year'));

try{
    $current = mysqli_query($link, "DELETE FROM calendar WHERE type = 0 AND date_end <= '$date'");

}catch(Exception $e)
{
    $current = file_get_contents($file);
    $current .= $e->getMessage();
    file_put_contents($file, $current);
}