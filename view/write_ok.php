<?php
/*
	File: write_ok.php
	Author: Dodo
	Created by 2019-07-11
  E mail: rabbit.white@daum.net
          (jungwy@kumoh.ac.kr)
	Description: write.php에서 사용됨.
	2019-07-11 / 캘린더 일정 등록 기능 구현 / Dodo
*/

$calCrud = new Calendar_Crud();
$schedule;
$calendarFn = new CalendarFn();
$pattern = $calendarFn->passwordPattern();

$count = -1;
$SUCCESS = 13;

$start_dateErr = $start_yearErr = $start_monthErr = $start_dayErr = $start_hourErr = $start_miniute = "";
$end_dateErr = $end_yearErr = $end_monthErr = $end_dayErr = $end_hourErr = $end_miniute = "";
$subjectErr = $contentsErr = $passwdErr = $passwdChkErr = "";

$start_date = $start_year = $start_month = $start_day = $start_hour = $start_miniute = "";
$end_date = $end_year = $end_month = $end_day = $end_hour = $end_miniute = "";
$subject = $contents = $passwd = $passwd2 = $regidate = $ip = $count = "";

//echo $_POST["passwd"];

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
       $contentsErr = "Contents is required(작성자는 필수이다)";
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
      
       if(!preg_match($pattern , $passwd)){
          $passwd = "";
          $passwdErr = "8~15,대소문자,특수문자조합(8-15, uppercase and lowercase letters, special characters combined)";
       }
       
   }

   // 6. 비밀번호 확인    
   if (empty($_POST["passwd2"])) {
      $passwdChkErr = "Password Check Error(비밀번호 확인 오류)";
      $count++;
      
   }else {
      $passwd2 = $calendarFn->test_input($_POST["passwd2"]);
      
      if ( $passwd != $passwd2 ){
         $passwdChkErr = "Password Check Error(비밀번호 확인 오류)";
      }
      
      if(!preg_match($pattern , $passwd2)){
          $passwd2 = "";
          $passwdChkErr = "8~15,대소문자,특수문자조합(8-15, uppercase and lowercase letters, special characters combined)";
      }
      
   }
   
} // end of if



$start_date = mktime((int)$start_hour, (int)$start_miniute, 0, $start_month, $start_day, $start_year);
$end_date = mktime((int)$end_hour, (int)$end_miniute, 0, $end_month, $end_day, $end_year);

//echo $start_date;

// 내용 비어있는지 확인
if ( !empty($start_date) && 
     !empty($end_date) &&
     !empty($subject) &&
     !empty($contents) && 
     !empty($passwd) && 
     !empty($passwd2) ){
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

if ( !empty($passwdChkErr) ){
  echo $passwdChkErr;
  echo "<br>";  
}

// 게시글 담기
if ( $count == $SUCCESS )
{ 
//  echo "쓰기 예정";
  $schedule = new Schedule();
  $schedule->setStartDate( date("Y-m-d H:i:s", $start_date ));
  $schedule->setEndDate( date("Y-m-d H:i:s", $end_date ));
  $schedule->setSubject( $subject );
  $schedule->setContents( $contents );
  $schedule->setPasswd( $passwd );
  $schedule->setRegidate(date("Y-m-d H:i:s"));
  $schedule->setIp($_SERVER["REMOTE_ADDR"]);
  $schedule->setCount(0);
  
//  echo $boardName;
  
  // 글 등록(Article - Register)
  $result = $calCrud->write($boardName, $schedule);

  if ( $result == 1 ) {
    $year = date("Y");
    $month = date("m");
    header("Location: index.php?mode=list&boardName=$boardName&year=$year&month=$month"); 
  }
}

?>