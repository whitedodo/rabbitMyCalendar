<?php

/*
  Subject: Calendar Project
  Create Date: 2019-07-10
  File: Calendar_func.php
  Author: Dodo
  E mail: rabbit.white@daum.net
          (jungwy@kumoh.ac.kr)
  Description:
  
*/

class Calendar_Fn{
  
  private $rootDir;
  private $year;
  private $month;
  private $day;
  private $boardName;
  private $scheduleId;
  
  public function __construct($rootDir, $year, $month, $boardName){

    $this->setRootDir( $rootDir );
    $this->setYear( $year );
    $this->setMonth( $month );
    $this->setBoardName( $boardName );
    
  }
  
  public function __destruct(){
    
  }
  
  public function getRootDir(){
    return $this->rootDir;
  }
  
  public function getYear(){
    return $this->year;
  }
  
  public function getMonth(){
    return $this->month;
  }
  
  public function getDay(){
    return $this->day;
  }
  
  public function getBoardName(){
    return $this->boardName;
  }
  
  public function getScheduleId(){
    return $this->scheduleId;
  }
  
  public function setRootDir($rootDir){
    $this->rootDir = $rootDir;
  }
  
  public function setYear($year){
    $this->year = $year;
  }
  
  public function setMonth($month){
    $this->month = $month;
  }
  
  public function setDay($day){
    $this->day = $day;
  }
  
  public function setBoardName($boardName){
    $this->boardName = $boardName;
  }
  
  public function setScheduleId($scheduleId){
    $this->scheduleId = $scheduleId;
  }
  
  public function chooseMode($choose){
    
    $year = $this->getYear();
    $month = $this->getMonth();
    $day = $this->getDay();
    
    $calFn = new CalendarFn();
    $start = $calFn->getExecutionTime();
    $boardName = $this->getBoardName();
    $scheduleId = $this->getScheduleId();
    
    // Calendar 클래스 불러오기
    require_once $this->getRootDir() . "/model/connect.php";
    require_once $this->getRootDir() . "/model/schedule.php";
    require_once $this->getRootDir() . "/model/calendarView.php";
    require_once $this->getRootDir() . "/function.php";
    require_once $this->getRootDir() . "/controller/calendar_crud.php";
    
    // 유형별 모드
    if ( strcmp ($choose, 'write' ) == 0 ){
      require_once $this->getRootDir() . "/view/header.php";      
      require_once $this->getRootDir() . "/view/write.php";
      require_once $this->getRootDir() . "/view/footer.php";
      
    }
    else if ( strcmp ($choose, 'write_ok') == 0 ){
      
      require_once $this->getRootDir() . "/view/write_ok.php";
      
    }else if ( strcmp ($choose, 'remove' ) == 0 ){
      require_once $this->getRootDir() . "/view/header.php";      
      require_once $this->getRootDir() . "/view/remove.php";
      require_once $this->getRootDir() . "/view/footer.php";
    
    }else if ( strcmp ($choose, 'remove_ok' ) == 0 ){
     
      require_once $this->getRootDir() . "/view/remove_ok.php";
      
    }else if ( strcmp ($choose, 'read' ) == 0 ) {
      require_once $this->getRootDir() . "/view/header.php";
      require_once $this->getRootDir() . "/view/read.php";
      require_once $this->getRootDir() . "/view/footer.php";
      
    }else if ( strcmp ($choose, 'modify' ) == 0 ) {
      require_once $this->getRootDir() . "/view/header.php";      
      require_once $this->getRootDir() . "/view/modify.php";
      require_once $this->getRootDir() . "/view/footer.php";
    }else if ( strcmp ($choose, 'modify_ok' ) == 0 ) {
    
      require_once $this->getRootDir() . "/view/modify_ok.php";
      
    }else if ( strcmp ($choose, 'list' ) == 0 ) {
      require_once $this->getRootDir() . "/view/header.php";
      require_once $this->getRootDir() . "/view/list.php";
      require_once $this->getRootDir() . "/view/footer.php";
      //echo "참";
      
    }else{
      
    } // end of if
    
  } // end of function
  
}

?>