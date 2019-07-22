<?php

/*
	File: schedule.php
	Author: Dodo 
  E mail: rabbit.white@daum.net
          (jungwy@kumoh.ac.kr)
	Created by 2019-07-10
	Description: 
*/

class Schedule{
  
  private $id;
  private $startDate;
  private $endDate;
  private $subject;
  private $contents;
  private $passwd;
  private $regidate;
  private $ip;
  private $count;
  
  public function __construct(){
    
  }
  
  public function __destruct(){
    
  }
  
  public function getId(){
    return $this->id;
  }
  
  public function getStartDate(){
    return $this->startDate;
  }
  
  public function getEndDate(){
    return $this->endDate;
  }
  
  public function getSubject(){
    return $this->subject;
  }
  
  public function getContents(){
    return $this->contents;
  }
  
  public function getPasswd(){
    return $this->passwd;
  }
  
  public function getRegidate(){
    return $this->regidate;
  }
  
  public function getIp(){
    return $this->ip;
  }
  
  public function getCount(){
    return $this->count;
  }
  
  public function setId($id){
    $this->id = $id;
  }
  
  public function setStartDate($startDate){
    $this->startDate = $startDate;
  }
  
  public function setEndDate($endDate){
    $this->endDate = $endDate;
  }
  
  public function setSubject($subject){
    $this->subject = $subject;
  }
  
  public function setContents($contents){
    $this->contents = $contents;
  }
  
  public function setPasswd($passwd){
    $this->passwd = $passwd;
  }
  
  public function setRegidate($regidate){
    $this->regidate = $regidate;
  }
  
  public function setIp($ip){
    $this->ip = $ip;
  }
  
  public function setCount($count){
    $this->count = $count;
  }
  
}


?>