<?php

/*
  Subject: Calendar Project
  Create Date: 2019-07-10
  File: Calendar.php
  Author: Dodo
  E mail: rabbit.white@daum.net
  Description:
  
*/

class CalendarView{
  
  private $year;
  private $month;
  private $last_day;
  private $start_week;
  private $total_week;
  private $last_week;

  public function getYear(){
    return $this->year;
  }
  
  public function getMonth(){
    return $this->month;
  }
  
  public function getLastDay(){
    return $this->last_day;
  }
  
  public function getStartWeek(){
    return $this->start_week;
  }
  
  public function getTotalWeek(){
    return $this->total_week;
  }
  
  public function getLastWeek(){
    return $this->last_week;
  }
  
  public function setYear($year){
    $this->year = $year;
  }
  
  public function setMonth($month){
    $this->month = $month;
  }
  
  public function setLastDay($last_day){
    $this->last_day = $last_day;
  }
  
  public function setStartWeek($start_week){
    $this->start_week = $start_week;
  }
  
  public function setTotalWeek($total_week){
    $this->total_week = $total_week;
  }
  
  public function setLastWeek($last_week){
    $this->last_week = $last_week;
  }
  
  
  
}


?>