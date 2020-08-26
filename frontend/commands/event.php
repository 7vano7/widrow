<?php
$file = '/frontend/runtime/logs/cron.log';
$link = mysqli_connect('localhost', 'bzczfvjo', 'B6qyFBq0@D+v37', 'bzczfvjo_archery') or die("Не могу соединиться с MySQL.");
$delete = mysqli_query($link, "DELETE FROM `events_day`");

$date = date('Y-m-d H:i:s');
try{
    $current = mysqli_query($link, "SELECT * FROM calendar WHERE date_begin <= '$date' AND date_end >= '$date'");

    if($current)
    {
        while($model = mysqli_fetch_assoc($current))
        {
            $photo = $model['photo'];
            $status = $model['status'];
            $url = $model['url'];
            $id = $model['id'];
            $cal_lang = mysqli_query($link, "SELECT * FROM calendar_lang WHERE calendar_id = '$id'");
            if(!$cal_lang)
            {
                return false;
            }
            while($cal = mysqli_fetch_assoc($cal_lang))
            {
                $lang = $cal['lang'];
                $title = $cal['title'];
                $query = mysqli_query($link, "INSERT INTO events_day SET 
                lang = '$lang',
                photo = '$photo',
                status = '$status',
                url = '$url',
                title = '$title'");
            }
        }
    }
}catch(Exception $e)
{
    $current = file_get_contents($file);
    $current .= $e->getMessage();
    file_put_contents($file, $current);
}