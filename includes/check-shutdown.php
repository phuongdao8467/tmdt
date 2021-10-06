<?php
//read file shutsown-log.txt
$myfile = fopen("shutdown-log.txt", "r") or die("Unable to open file!");
$date_shutdown=fgets($myfile);
$day_shutdown=substr($date_shutdown,0,2);
$month_shutdown=substr($date_shutdown,3,2);
$year_shutdown=substr($date_shutdown,6,4);
$date_shutdown=$year_shutdown.'-'.$month_shutdown.'-'.$day_shutdown;
$time_shutdown=fgets($myfile);
fclose($myfile);
//read file restart-log.txt
$myfile = fopen("restart-log.txt", "r") or die("Unable to open file!");
$date_restart=fgets($myfile);
$day_restart=substr($date_restart,0,2);
$month_restart=substr($date_restart,3,2);
$year_restart=substr($date_restart,6,4);
$date_restart=$year_restart.'-'.$month_restart.'-'.$day_restart;
$time_restart=fgets($myfile);
fclose($myfile);
$shutdown=new DateTime($date_shutdown.' '.$time_shutdown);
$current=new DateTime(date("Y-m-d H:i:s"));
$restart=new DateTime($date_restart.' '.$time_restart);
$check=true;
if (($shutdown<$current && $current<$restart)||($shutdown>$restart && $shutdown<=$current)){
    $check=false;
} else {
    $check=true;
}

    if ($check == false) {
        header( "Location: warning.php");
    }
