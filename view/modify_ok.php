<?php
/*
	File: modify_ok.php
	Author: Dodo 
  E mail: rabbit.white@daum.net
          (jungwy@kumoh.ac.kr)
	Created by 2019-07-11
	Description: modify.php에서 사용됨.
*/

$calendarFn = new CalendarFn();
$calCrud = new Calendar_Crud();
//$pattern = $calendarFn->passwordPattern();
$year = date("Y");
$month = date("m");

// 일정 존재여부
$result = $calCrud->isSchedule($boardName, $scheduleId);

if ( !$result ){
  echo "<script>alert(\"일정이 존재하지 않습니다.\n";
  echo "(This schedule post does not exist.)\");";
  echo "location.href(\"index.php?boardName=$boardName&year=$year&month=$month\");";
  echo "</script>";
} 

$count = -1;
$SUCCESS = 13;

$start_dateErr = $start_yearErr = $start_monthErr = $start_dayErr = $start_hourErr = $start_miniute = "";
$end_dateErr = $end_yearErr = $end_monthErr = $end_dayErr = $end_hourErr = $end_miniute = "";
$subjectErr = $contentsErr = $passwdErr = $passwdChkErr = "";

$start_date = $start_year = $start_month = $start_day = $start_hour = $start_miniute = "";
$end_date = $end_year = $end_month = $end_day = $end_hour = $end_miniute = "";
$subject = $contents = $passwd = $passwd2 = $regidate = $ip = $count = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

   // 1. 시작일자
   if (empty($_POST["start_year"])) { // 년
       $start_yearErr = "startYear is required";
       $count++;
   }else {
       $start_year = $calendarFn->test_input($_POST["start_year"]);
   }
   
   if (empty($_POST["start_month"])) { // 월
       $start_monthErr = "startMonth is required";
       $count++;
   }else {
       $start_month = $calendarFn->test_input($_POST["start_month"]);
   }
   
   if (empty($_POST["start_day"])) {
       $start_dayErr = "startDay is required";
       $count++;
   }else {
       $start_day = $calendarFn->test_input($_POST["start_day"]);
   }
   
   if (empty($_POST["start_hour"])) {
       $start_hourErr = "startHour is required";
       $count++;
   }else {
       $start_hour = $calendarFn->test_input($_POST["start_hour"]);
   }
   
   if (empty($_POST["start_miniute"])) {
       $start_miniuteErr = "startMiniute is required";
       $count++;
   }else {
       $start_miniute = $calendarFn->test_input($_POST["start_miniute"]);
   }
   
   // 2. 종료일자
   if (empty($_POST["end_year"])) { // 년
       $end_yearErr = "endYear is required";
       $count++;
   }else {
       $end_year = $calendarFn->test_input($_POST["end_year"]);
   }
   
   if (empty($_POST["end_month"])) { // 월
       $end_yearErr = "endYear is required";
       $count++;
   }else {
       $end_month = $calendarFn->test_input($_POST["end_month"]);
   }
   
   if (empty($_POST["end_day"])) { // 일
       $end_dayErr = "endDay is required";
       $count++;
   }else {
       $end_day = $calendarFn->test_input($_POST["end_day"]);
   }
   
   if (empty($_POST["end_hour"])) { // 시
       $end_hourErr = "endHour is required";
       $count++;
   }else {
       $end_hour = $calendarFn->test_input($_POST["end_hour"]);
   }
   
   if (empty($_POST["end_miniute"])) { // 분
       $end_miniuteErr = "endMiniute is required";
       $count++;
   }else {
       $end_miniute = $calendarFn->test_input($_POST["end_miniute"]);
   }
  
   // 3. 제목
   if (empty($_POST["subject"])) {
       $subjectErr = "Subject is required";
       $count++;
   }else {
       $subject = $calendarFn->test_input($_POST["subject"]);
   }
   
   // 4. 내용
   if (empty($_POST["contents"])) {
       $contentsErr = "Contents is required(내용은 필수이다)";
       $count++;
   }else {
       $contents = $calendarFn->test_input($_POST["contents"]);
   }
    
   // 5. 비밀번호
   if (empty($_POST["passwd"])) {
       $passwdErr = "Password is required(비밀번호는 필수이다)";
       $count++;
   }else {
       $passwd = $calendarFn->test_input($_POST["passwd"]);
       $result = $calCrud->isPasswd($boardName, $scheduleId, $passwd);
       
       if ( !$result ){
          echo "<script>alert(\"비밀번호가 일치하지 않습니다.\n";
          echo "(Password do not match.)\");";
          echo "window.history.back();";
          echo "</script>";
       }
       else{
         $count++;
       }
   }
   
} // end of if

// 일자 생성
$start_date = mktime((int)$start_hour, (int)$start_miniute, 0, $start_month, $start_day, $start_year);
$end_date = mktime((int)$end_hour, (int)$end_miniute, 0, $end_month, $end_day, $end_year);

//echo $start_date;

// 내용 비어있는지 확인
if ( !empty($start_date) && 
     !empty($end_date) &&
     !empty($subject) &&
     !empty($contents) && 
     !empty($passwd) ){
  $count = $SUCCESS;
}

// 오류 메시지 출력
if ( !empty($subjectErr ) ){
  echo $subjectErr;
  echo "<br>";
}

if ( !empty($contentErr) ){
  echo $contentErr;
  echo "<br>";  
}

if ( !empty($passwdErr) ){
  echo $passwdErr;
  echo "<br>";
}

// 수정하기
if ( $count == $SUCCESS )
{
  
//  echo "수정 예정";
  $schedule = new Schedule();
  $schedule->setId($scheduleId);
  $schedule->setStartDate( date("Y-m-d H:i:s", $start_date ));
  $schedule->setEndDate( date("Y-m-d H:i:s", $end_date ));
  $schedule->setSubject( $subject );
  $schedule->setContents( $contents );
  $schedule->setPasswd( $passwd );
  
  $result = $calCrud->update($boardName, $schedule);
  
  if ( $result == 1 )
  {
    header("Location: index.php?mode=list&boardName=$boardName&year=$year&month=$month"); 
  }
  
}

?>