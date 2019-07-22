<?php
/*
	File: remove_ok.php
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

$passwdErr = "";
$passwd = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
   // 1. 비밀번호
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

// 내용 비어있는지 확인
if ( !empty($passwd) ){
  $count = $SUCCESS;
}

if ( !empty($passwdErr) ){
  echo $passwdErr;
  echo "<br>";
}

// 삭제하기
if ( $count == $SUCCESS )
{
  
//  echo "삭제 예정";
  $schedule = new Schedule();
  $schedule->setId($scheduleId);
  $schedule->setPasswd( $passwd );
  
  $result = $calCrud->remove($boardName, $schedule);
  
  if ( $result == 1 )
  {
    header("Location: index.php?mode=list&boardName=$boardName&year=$year&month=$month"); 
  }
  
}

?>