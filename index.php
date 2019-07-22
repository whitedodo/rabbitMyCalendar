<?php

/*
  Subject: Calendar Project
  Create Date: 2019-07-10
  File: index.php
  Author: Dodo
  E mail: rabbit.white@daum.net
          (jungwy@kumoh.ac.kr)
  Description:  
*/

header("Content-Type: text/html; charset=UTF-8");
header('X-Frame-Options: DENY');  // 'X-Frame-Options'

$root = "/host/home2/rabbit2me/html";
$folder = "/miniProject/calendar";
$rootDir = $root . $folder;

require_once $rootDir . "/controller/calendar_func.php";
require_once $rootDir . "/function.php";
require_once $rootDir . "/crypt.php";

$year = $_GET['year'];
$month = $_GET['month'];
$day = $_GET['day'];

$mode = $_GET['mode'];
$boardName = $_GET['boardName'];
$scheduleId = $_GET['scheduleId'];

if ( empty( $mode ) ){
  $mode = $_POST['mode'];
}

if ( empty( $boardName ) ) {
  $boardName = $_POST['boardName'];
}

if ( empty( $scheduleId ) ) {
  $scheduleId = $_POST['scheduleId'];
}

$cal = new Calendar_Fn($rootDir, $year, $month, $boardName);
$cal->setDay($day);               // 일자(선택사항)
$cal->setScheduleId($scheduleId); // 스케줄 고유키

$cal->chooseMode($mode);

?>