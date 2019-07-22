<?php

/*
  Subject: Calendar Project
  Create Date: 2019-07-10 ~ 2019-07-11
  File: calendar_crud.php
  Author: Dodo
  E mail: rabbit.white@daum.net
          (jungwy@kumoh.ac.kr)
  Description:
  1. 2019-07-23 / CSS3 작업 및 W3C 표준화 작업/ Dodo / rabbit.white at daum dot net
  
*/

class Calendar_Crud{
  
  private $calView;
  private $conn;
	private $crypt;
	
  // 생성자
  public function __construct(){
    $this->calView = new CalendarView();
		$this->conn = new Connect('userHost', 'userId', 'userPwd', 'dbName');
		$this->crypt = new Bcrypt();
  }
  
  // 소멸자
  public function __destruct(){

  }
  
  public function getCalView(){
    return $this->calView;
  }
  
  public function setCalView($calView){
    $this->calView = $calView;
  }
  
  public function create(){
    
    $year = $this->calView->getYear();
    $month = $this->calView->getMonth();
    
    $yoil = array("일","월","화","수","목","금","토");
    
    // echo $year;
    
    // 1. 총일수 구하기
    $this->calView->setLastDay ( date("t", strtotime( $year . "-" . $month) ) );
    $last_day = $this->calView->getLastDay();
    
    // 2. 시작요일 구하기
    $this->calView->setStartWeek( date("w", strtotime($year . "-" . $month)) );
    $start_week = $this->calView->getStartWeek();
    
    // 3. 총 몇 주인지 구하기
    $this->calView->setTotalWeek( ceil( ( $last_day + $start_week ) / 7) );
    
    // 4. 마지막 주 구하기
    $this->calView->setLastWeek( date('t', strtotime($year . "-" . $month) . "-" . $last_day) );
    
    //echo $last_day . "**";
    //echo $last_week;
    
  }
  
  public function readArticle($boardName, $y, $m, $d){
    
		$security = new Security();
		
    $link = mysql_connect($this->conn->getHost(), 
		                      $this->conn->getUser(), 
		                      $this->conn->getPw()) or 
		                      die('Could not connect' . mysql_error());
				                      
		$start = mktime(0, 0, 0, $m, $d, $y );
		$start_date = date("Y-m-d H:m:s" , $start);
		
		$end = mktime(23, 59, 59, $m, $d, $y );
		$end_date = date("Y-m-d H:m:s", $end);
		                      
		mysql_set_charset('utf8',$link);
		
		mysql_select_db($this->conn->getDBName()) or die('Could not select database');
		
    mysql_query("set session character_set_connection=utf8;");
    mysql_query("set session character_set_results=utf8;");
    mysql_query("set session character_set_client=utf8;");
    
    $query = sprintf("SELECT id, startDate, endDate, subject, contents, passwd, regidate, ip, count " . 
		         "FROM schedule_%s " . 
		         "WHERE ((startDate >= '%s' AND startDate <= '%s') " .
		         "OR (endDate >= '%s' AND endDate <= '%s')) " .
		         "OR (startDate <= '%s' AND endDate >= '%s') " .
		         "ORDER BY id DESC ",
             mysql_real_escape_string($boardName),
             mysql_real_escape_string($start_date),
             mysql_real_escape_string($end_date),
             mysql_real_escape_string($start_date),
             mysql_real_escape_string($end_date),
             mysql_real_escape_string($start_date),
             mysql_real_escape_string($end_date));

//  echo $query;

		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
		
    // DB Article
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {			
			echo htmlentities($row['subject'], ENT_QUOTES | ENT_IGNORE, "UTF-8");
			echo "<br>";
		}
		
		// Free resultset
		mysql_free_result($result);
		
		// Closing connection
		mysql_close($link);
    
  }
  
  public function readSchedule($boardName, $id){
    		
    $link = mysql_connect($this->conn->getHost(), 
		                      $this->conn->getUser(), 
		                      $this->conn->getPw()) or 
		                      die('Could not connect' . mysql_error());
				                      
		$start = mktime(0, 0, 0, $m, $d, $y );
		$start_date = date("Y-m-d H:m:s" , $start);
		
		$end = mktime(23, 59, 59, $m, $d, $y );
		$end_date = date("Y-m-d H:m:s", $end);
		                      
		mysql_set_charset('utf8',$link);
		
		mysql_select_db($this->conn->getDBName()) or die('Could not select database');
		
    mysql_query("set session character_set_connection=utf8;");
    mysql_query("set session character_set_results=utf8;");
    mysql_query("set session character_set_client=utf8;");
    
    $query = sprintf("SELECT id, startDate, endDate, subject, contents, passwd, regidate, ip, count " . 
		         "FROM schedule_%s " . 
		         "WHERE id = %s ",
             mysql_real_escape_string($boardName),
             mysql_real_escape_string($id));

//    echo $query;

		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
		
    // DB Article
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {			
			
			$s_year = date("Y", strtotime( $row['startDate'] ));
			$s_month = date("m", strtotime( $row['startDate'] ));
			$s_day = date("d", strtotime( $row['startDate'] ));
			$s_hour = date("h", strtotime( $row['startDate'] ));
			$s_min = date("i", strtotime( $row['startDate'] ));

			$e_year = date("Y", strtotime( $row['endDate'] ));
			$e_month = (int)(date("m", strtotime( $row['endDate'] )) );
			$e_day = date("d", strtotime( $row['endDate'] ));
			$e_hour = date("h", strtotime( $row['endDate'] ));
			$e_min = date("i", strtotime( $row['endDate'] ));

			
			echo "\t\t\t\t\t";
			echo "<!-- 본문 -->";
			echo "\n";
			echo "\t\t\t\t\t";
			echo "<table class='table_write'>\n";
			echo "\n\n";
			echo "\t\t\t\t\t";
			echo "<tr>\n";
			echo "\t\t\t\t\t";
      echo "<td class='td_modify_startYear_theme'>";
      echo "\n\n\n";
			echo "\t\t\t\t\t";
      echo "<span class='content_Write_Black'>시작년<br>(Start Year)</span>";
      echo "\n\n\n";
			echo "\t\t\t\t\t";
      echo "</td>\n";
			echo "\t\t\t\t\t";
			echo "<td class='txt_modify_txtDate'>\n";
			echo "\t\t\t\t\t";
      echo "<select name='start_year'>\n\n";
			echo "\t\t\t\t\t";
      echo "\n";
      
      // 등록된 현재년도      
 			echo "\t\t\t\t\t";
      echo "<option value='" . $s_year . "'>";
      echo $s_year;
      echo "</option>";
      echo "\n";

      for ( $i = 1900; $i < ( date("Y") + 10 ); $i++ ){
   			echo "\t\t\t\t\t";
        echo "<option value='". $i . "'>" . $i . "</option>\n";
      }
      
 			echo "\t\t\t\t\t";
      echo "\n</select>\n";
      echo "\n\n";
      echo "</td>\n\n";
      
      echo "\n\n";
      echo "<td class='td_modify_startMonth_theme'>";
      echo "\n\n";
      
      echo "<span class='content_Write_Black'>시작월<br>(Start Month)</span>";
      echo "\n";
			echo "\t\t\t\t\t";
      echo "</td>";
      echo "\n";
			echo "\t\t\t\t\t";
      echo "<td class='txt_modify_txtDate'>";
      echo "\n";
			echo "\t\t\t\t\t";

      // 등록된 시작월
			echo "<select name='start_month'>";
			
   			echo "\t\t\t\t\t";
        echo "<option value='". $s_month . "'>";
        echo $s_month;
        echo "</option>\n";
			
      for ( $i = 1; $i <= 12; $i++ ){
   			echo "\t\t\t\t\t";
        echo "<option value='". $i . "'>" . $i . "</option>\n";
      }
      echo "\n</select>";
      echo "\n";
			echo "\t\t\t\t\t";
      echo "</td>";
			echo "\t\t\t\t\t";
      echo "<td class='td_modify_startDay_theme'>";
 			echo "\t\t\t\t\t";
      echo "<span class='content_Write_Black'>시작일<br>(Start Day)</span>";
			echo "\t\t\t\t\t";
      echo "</td>\n";
			echo "\t\t\t\t\t";
			echo "<td class='txt_modify_txtDate'>";
			
      echo "<select name='start_day'>";
      
      // 등록된 시작일
			echo "\t\t\t\t\t";
      echo "<option value='". $s_day . "'>";
      echo $s_day;
      echo "</option>\n";
      
      echo "\n\n";
      for ( $i = 1; $i <= 31; $i++ ){
        echo "<option value='". $i . "'>" . $i . "</option>";
      }
      
      echo "\t\t\t\t\t";
      echo "</select>";
      echo "\n\n";
			echo "\t\t\t\t\t";
      echo "</td>";

			echo "\t\t\t\t\t";
      echo "<td class='td_modify_startHour_theme'>\n";
			echo "\t\t\t\t\t";
      echo "<span class='content_Write_Black'>시작시간<br>(Start Hour)</span>\n\n";
			echo "\t\t\t\t\t";

      echo "</td>";
      
      echo "\n\n";
			echo "\t\t\t\t\t";
      echo "<td class='txt_modify_txtDate'>";
      echo "\n\n";
			echo "\t\t\t\t\t";
      echo "<select name='start_hour'>";
      
      // 등록된 시작시간
			echo "\t\t\t\t\t";
      echo "<option value='". $s_hour . "'>";
      echo $s_hour;
      echo "</option>\n";
  
      for ( $i = 0; $i <= 23; $i++ ){
  			echo "\t\t\t\t\t";
        echo "<option value='". $i . "'>" . $i . "</option>";
        echo "\n\n";
      }
      
      echo "\t\t\t";
      echo "</select>";
      echo "\n\n";
			echo "\t\t\t\t\t";
      echo "</td>";
      echo "\n\n\n";
      
			echo "\t\t\t\t\t";
      echo "<td class='td_modify_startMin_theme'>";
      echo "<span class='content_Write_Black'>시작분<br>(Start Miniute)</span>";
      
      echo "\n\n";
      echo "</td>";
      echo "\n\n";
      
      echo "\t\t\t\t\t";
      echo "<td class='txt_modify_txtDate'>";
      
      echo "<select name='start_miniute'>";
      
      // 등록된 시작분
			echo "\t\t\t\t\t";
      echo "<option value='". $s_min . "'>";
      echo $s_min;
      echo "</option>\n";
      
      echo "\n\n";
      
      for ( $i = 0; $i <= 59; $i++ ){
        echo "\t\t\t";
        echo "<option value='". $i . "'>" . $i . "</option>";
        echo "\n\n";
      }
      
      echo "\t\t\t\t\t";
      echo "</select>";
      echo "\n\n";
      
      echo "</td>\n";
			echo "\t\t\t\t\t";
      echo "</tr>\n";
			echo "\t\t\t\t\t";

      echo "<tr>";
      echo "\n";
			echo "<td class='td_modify_endYear_theme'>\n";
			echo "\t\t\t\t\t";
			echo "<span class='content_Write_Black'>종료년<br>(End Year)</span>\n";
			echo "\t\t\t\t\t";

      echo "</td>\n";
			echo "\t\t\t\t\t";
      echo "    <td class='txt_modify_txtDate'>";
      echo "\n\n";
			echo "\t\t\t\t\t";
      echo "<select name='end_year'>";
      
      // 등록된 종료년
			echo "\t\t\t\t\t";
      echo "<option value='". $e_year . "'>";
      echo $e_year;
      echo "</option>\n";
      
      echo "\n\n";
      
      for ( $i = 1900; $i < ( date("Y") + 10 ); $i++ ){
        echo "\t\t\t\t\n";
        echo "<option value='". $i . "'>";
        echo $i;
        echo "</option>";
        echo "\n\n";
      }
      
      echo "\t\t\t\t\t";
      echo "</select>";
      
      echo "\n";
			echo "\t\t\t\t\t";
      echo "</td>";
			echo "\t\t\t\t\t";
      echo "    <td class='td_modify_endMonth_theme'>";
      echo "\n";
      
			echo "\t\t\t\t\t";
			echo "<span class='content_Write_Black'>종료월<br>(End Month)";
			echo "</span>";
			echo "\t\t\t\t\t";
			echo "\n\n";
      echo "</td>";
			echo "\t\t\t\t\t";
			
			echo "<td class='txt_modify_txtDate'>";
			echo "\n\n";
			echo "<select name='end_month'>";

      // 등록된 종료월
			echo "\t\t\t\t\t";
      echo "<option value='". $e_month . "'>";
      echo $e_month;
      echo "</option>\n";

      for ( $i = 1; $i <= 12; $i++ ){
  			echo "\t\t\t\t\t";
        echo "<option value='". $i . "'>" . $i . "</option>";
        echo "\n\n";
      }
      
			echo "\t\t\t\t\t";
      echo "</select>";
      echo "\n\n";
      
      echo "</td>";
      echo "\n";
			echo "\t\t\t\t\t";
      echo "<td class='td_modify_endDay_theme'>";
      echo "\n";

      echo "<span class='content_Write_Black'>종료일<br>(End Day)";
      echo "</span>\n";
      
			echo "\t\t\t\t\t";
			echo "\n";
			echo "\t\t\t\t\t";
      echo "</td>";
      
			echo "\t\t\t\t\t";
      echo "<td class='txt_modify_txtDate'>";
      
      echo "\n\n";
			echo "\t\t\t\t\t";
			
			echo "<select name='end_day'>";
			echo "\n\n";
			
      // 등록된 종료일
			echo "\t\t\t\t\t";
      echo "<option value='". $e_day . "'>";
      echo $e_day;
      echo "</option>\n";
			
      for ( $i = 1; $i <= 31; $i++ ){
  			echo "\t\t\t\t\t";
        echo "<option value='". $i . "'>" . $i . "</option>";
        echo "\n\n";
      }
  
      echo "</select>";
      echo "\n";
      
      echo "</td>\n";
      echo "<td class='td_modify_endHour_theme'>";
      echo "\n";
			echo "\t\t\t\t\t";
			echo "<span class='content_Write_Black'>종료시간<br>(End Hour)";
			echo "</span>";
			echo "\n";
			
			echo "\t\t\t\t\t";
			echo "</td>";
			echo "\n";
			
			echo "<td class='txt_modify_txtDate'>\n\n";
			echo "\t\t\t\t\t";
			echo "      <select name='end_hour'>";
			echo "\n\n";
			
      // 등록된 종료시간
			echo "\t\t\t\t\t";
      echo "<option value='". $e_hour . "'>";
      echo $e_hour;
      echo "</option>\n";
			
      for ( $i = 0; $i <= 23; $i++ ){
  			echo "\t\t\t\t\t";
        echo "<option value='". $i . "'>" . $i . "</option>";
        echo "\n\n";
      }
      
			echo "\t\t\t\t\t";      
      echo "</select>";
      echo "\n\n";
			echo "\t\t\t\t\t";
      echo "</td>";
      echo "\n\n";
      
			echo "\t\t\t\t\t";
      echo "<td class='td_modify_endMin_theme'>";
			echo "\t\t\t\t\t";
      echo "<span class='content_Write_Black'>종료분<br>(End Miniute)</span>";
			echo "\t\t\t\t\t";
			echo "\n\n";
			echo "\t\t\t\t\t";
      echo "</td>";
      echo "\n\n";

			echo "\t\t\t\t\t";
      echo "<td class='txt_modify_txtDate'>";
      echo "<select name='end_miniute'>";
      
      // 등록된 종료분
			echo "\t\t\t\t\t";
      echo "<option value='". $e_min . "'>";
      echo $e_min;
      echo "</option>\n";
      
      for ( $i = 0; $i <= 59; $i++ ){
  			echo "\t\t\t\t\t";
        echo "<option value='". $i . "'>" . $i . "</option>";
        echo "\n\n";
      }
      
			echo "\t\t\t\t\t";
      echo "</select>";
      echo "\n\n";
      
			echo "\t\t\t\t\t";
      echo "</td>\n";
			echo "\t\t\t\t\t";
      echo "</tr>";
      echo "\n";
			echo "\t\t\t\t\t";
      echo "<tr>";
			echo "\t\t\t\t\t";
			echo "<td class='td_modify_subject_theme'>";
			
			echo "\n";
			echo "\t\t\t\t\t";
			echo "<span class='content_Write_Black'>제목<br>(Subject)</span>";
			echo "\n";
			echo "</td>";
			
			echo "\t\t\t\t\t";
      echo "<td class='txt_modify_txtSubject' colspan='9'>";
      echo "\n";
      
			echo "\t\t\t\t\t";
      echo "<input type='text' name='subject' style='width:100%;' value='";
      echo $row['subject'];
      echo "'>";
      echo "\n";
			echo "\t\t\t\t\t";
      echo "\n";
      echo "</td>";
      echo "\n";
			echo "\t\t\t\t\t";
      echo "</tr>";
      echo "\n";
      
			echo "\t\t\t\t\t";
			echo "<tr>\n";
			echo "\t\t\t\t\t\n";
			echo "<td class='td_modify_contents_theme'>";
			echo "\n\n";
			echo "\t\t\t\t\t";

			echo "<span class='content_Write_Black'>내용<br>(Contents)</span>";
			echo "\n\n";
			echo "\t\t\t\t\t";
      echo "</td>\n\n";
      
      echo "\t\t\t\t\t";
      echo "<td class='txt_modify_txtContents' colspan='9'>";
      echo "\n\n";
      echo "\t\t\t\t\t";
      echo "      <textarea name='contents' cols='40' rows='8' style='width:100%;height:100px;'>";
      echo $row['contents'];
      echo "</textarea>";

      echo "\t\t\t\t\t";
      echo "\n\n";
      echo "\t\t\t\t\t";
      echo "</td>";
      echo "\n\n";
      echo "\t\t\t\t\t";
      echo "</tr>\n";
      echo "\t\t\t\t\t";
      echo "<tr>";
      echo "\t\t\t\t\t";
      echo "<td class='td_modify_passwd1_theme'>";
      echo "\n\n\n";
      echo "\t\t\t\t\t";
      
      echo "<span class='content_Write_Black'>비밀번호<br>(Password)</span>";
      echo "\n\n\n";

      echo "\t\t\t\t\t";
      echo "    </td>";
      echo "\t\t\t\t\t";
      
      echo "<td class='txt_modify_txtPasswd1' colspan='9'>";
      echo "\n\n";
      echo "\t\t\t\t\t";
      echo "<input type='password' name='passwd' style='width:100%;'>";
      echo "\t\t\t\t\t";
      echo "</td>";
      echo "\t\t\t\t\t";
      
      echo "  </tr>";
      echo "\n";
      echo "\t\t\t\t\t";
      echo "\n";
      echo "</table>";
			
		}
		
		// Free resultset
		mysql_free_result($result);
		
		// Closing connection
		mysql_close($link);
    
  }
  
  // 2019-07-11 17:21:00
  // Author: Dodo
  // read.php
  // Description:
  //
  public function readList($boardName, $y, $m, $d){
    		
    $link = mysql_connect($this->conn->getHost(), 
		                      $this->conn->getUser(), 
		                      $this->conn->getPw()) or 
		                      die('Could not connect' . mysql_error());
				                      
		$start = mktime(0, 0, 0, $m, $d, $y );
		$start_date = date("Y-m-d H:m:s" , $start);
		
		$end = mktime(23, 59, 59, $m, $d, $y );
		$end_date = date("Y-m-d H:m:s", $end);
		                      
		mysql_set_charset('utf8',$link);
		
		mysql_select_db($this->conn->getDBName()) or die('Could not select database');
		
    mysql_query("set session character_set_connection=utf8;");
    mysql_query("set session character_set_results=utf8;");
    mysql_query("set session character_set_client=utf8;");
    
    $query = sprintf("SELECT id, startDate, endDate, subject, contents, passwd, regidate, ip, count " . 
		         "FROM schedule_%s " . 
		         "WHERE ((startDate >= '%s' AND startDate <= '%s') " .
		         "OR (endDate >= '%s' AND endDate <= '%s')) " .
		         "OR (startDate <= '%s' AND endDate >= '%s') " .
		         "ORDER BY id DESC ",
             mysql_real_escape_string($boardName),
             mysql_real_escape_string($start_date),
             mysql_real_escape_string($end_date),
             mysql_real_escape_string($start_date),
             mysql_real_escape_string($end_date),
             mysql_real_escape_string($start_date),
             mysql_real_escape_string($end_date));

//  echo $query;

		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
		
    // DB Article
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {			
			
			echo "\t\t\t";
			echo "<!-- 제목 -->\n";
			echo "\t\t\t";
      echo "<table class='table_write'>\n";
			echo "\t\t\t\t";
			echo "<tr>\n";
			echo "\t\t\t\t\t";
			echo "<td class='td_read_num_theme'>\n";
			echo "\t\t\t\t\t\t";
      echo "<div class='content_Black'>번호(ID)</div>\n";
			echo "\t\t\t\t\t";
      echo "</td>";
			echo "\t\t\t\t\t";
      echo "<td class='txt_read_num'>\n";
			echo "\t\t\t\t\t\t";
      echo "<div class='content_Black'>\n";
      echo htmlentities($row['id'], ENT_QUOTES | ENT_IGNORE, "UTF-8");
      echo "</div>\n";
			echo "\t\t\t\t\t\t\t";
      echo "</td>\n";
			echo "\t\t\t\t";
      echo "<td class='td_read_subject_theme'>\n";
 			echo "\t\t\t\t\t";
      echo "<div class='content_Black'>제목(Subject)</div>\n";
			echo "\t\t\t\t\t";
      echo "</td>\n";
			echo "\t\t\t\t\t";
      echo "<td class='txt_read_subject'>\n";
			echo "\t\t\t\t\t\t";
      echo "<div class='content_Black'>";
      echo htmlentities($row['subject'], ENT_QUOTES | ENT_IGNORE, "UTF-8");
      echo "</div>\n";
			echo "\t\t\t\t\t";
      echo "</td>\n";
			echo "\t\t\t\t";
      echo "</tr>\n";
      echo "</table>\n";
      
      echo "\n";
			echo "\t\t\t";
      echo "<!-- 시작, 종료일자 -->\n\n";
 			echo "\t\t\t\t";
      echo "<table class='table_write'>\n";
 			echo "\t\t\t\t";
      echo "  <tr>\n";
			echo "\t\t\t\t\t";
      echo "<td class='td_read_startDate_theme'>\n";
 			echo "\t\t\t\t\t";
      echo "<div class='content_Black'>시작년월일 - (시간, 분)<br>\n";
			echo "\t\t\t\t\t\t";
      echo "Start Date(Year, Month, Day, Hour, Miniute)</div>\n";
			echo "\t\t\t\t\t";
      echo "</td>\n";
			echo "\t\t\t\t\t\t";
      echo "<td class='txt_read_startDate'>\n";
 			echo "\t\t\t\t\t";
      echo "<div class='content_Black'>";
      echo htmlentities($row['startDate'], ENT_QUOTES | ENT_IGNORE, "UTF-8");
      echo "</div>\n";
			echo "\t\t\t\t\t\t";

      echo "</td>\n";
			echo "\t\t\t\t\t";
      echo "<td class='td_read_endDate_theme'>";
			echo "\t\t\t\t\t\t";
      echo "<div class='content_Black'>종료년월일 - (시간, 분)<br>\n";
      echo "End Date(Year, Month, Day, Hour, Miniute)</div>\n";
      echo "\t\t\t\t\t";
      echo "</td>\n";
			echo "\t\t\t\t\t\t";
      echo "<td class='txt_read_endDate'>";
			echo "\t\t\t\t\t\t";
      echo "<div class='content_Black'>";
      echo htmlentities($row['endDate'], ENT_QUOTES | ENT_IGNORE, "UTF-8");
      echo "</div>";
			echo "\t\t\t\t\t\t";
      echo "</td>\n";
			echo "\t\t\t\t\t";
      echo "</tr>\n";
      echo "</table>";
      
      echo "\n\n";
      
      echo "<!-- 내용 -->\n";
      echo "<table class='table_write'>\n";
			echo "\t\t\t\t";
      echo " <tr>\n";
			echo "\t\t\t\t\t";
			echo "<td class='td_read_memo_theme'>\n";
			echo "\t\t\t\t\t\t";
			echo "<div class='content_Black'>내용<br>\n";
      echo "(Contents)</div>\n";
      echo "</td>\n";
      echo "\n\n\n\n";
			echo "\t\t\t\t\t";
      echo "</tr>\n";
      echo "<tr>\n";
			echo "\t\t\t\t\t";
			echo "\n";
			echo "\t\t\t\t\t";
			echo "<td style='padding-top:10px;padding-bottom:10px;'>\n";
			echo "\t\t\t\t\t\t";
      echo "<div class='content_Black'>\n";
			echo "\t\t\t\t";
      echo htmlentities($row['contents'], ENT_QUOTES | ENT_IGNORE, "UTF-8");
 			echo "\t\t\t\t";
      echo "</div>\n\n";
			echo "\t\t\t\t\t";
      echo "</td>\n";
			echo "\t\t\t\t";
      echo "</tr>\n";
      echo "</table>\n";
      
      echo "\n";
      
      echo "<!-- 등록일자 및 기능 -->\n";
      echo "<table class='table_write' style='border-bottom:1px solid #e2e2e2'>\n";
			echo "\t\t\t\t\n";
			echo "<tr>\n";
			echo "\t\t\t\t\n";
      echo "<td class='td_read_regiDate_theme'>\n";
			echo "\t\t\t\t\t";
			echo "<div class='content_Black'>등록일자<br>\n";
      echo "(Regidate)</div>\n";
			echo "\t\t\t\t\t\t";
      echo "</td>\n";
 			echo "\t\t\t\t\t\t";
      echo "<td class='txt_read_regidate'>\n";
			echo "\t\t\t\t\t\t";
			echo "\n\n";
			echo "\t\t\t\t\t\t";
			echo "<div class='content_Black'>";
      echo htmlentities($row['regidate'], ENT_QUOTES | ENT_IGNORE, "UTF-8");
			echo "</div>\n";
      echo "</td>\n";
      echo "\n\n";
          
      echo "<td class='td_read_func_theme'>\n";
			echo "\t\t\t\t\t\t\n";
      echo "<div class='content_Black'>기능<br>\n";
      echo "(Function)</div>\n";
			echo "\t\t\t\t\t\t";
			echo "</td>\n";

			echo "<td>";
			echo "\n";
      echo "<div class='content_Black'>";
      echo "<a href='index.php?mode=modify&boardName=";
      echo $boardName;
      echo "&scheduleId=";
      echo $row['id'];
      echo "'>";
      echo "수정(Modify)";
      echo "</a>";
      echo "<br>";
      echo "\n";
      echo "<a href='index.php?mode=remove&boardName=";
      echo $boardName;
      echo "&scheduleId=";
      echo $row['id'];
      echo "'>";
      echo "\n";
      echo "삭제(Remove)\n";
      echo "</a>";
			echo "\t\t\t\t";
      echo "</div>";
			echo "\t\t\t\t\t\t";
      echo "</td>\n\n";
			echo "\t\t\t\t\t\t";
			echo "</tr>\n";
			echo "</table>\n";
			echo "</form>\n";
			
		}
		
		// Free resultset
		mysql_free_result($result);
		
		// Closing connection
		mysql_close($link);
  
  } // end of function
  
  public function isSchedule($boardName, $id){
    
    $link = mysql_connect($this->conn->getHost(), 
		                      $this->conn->getUser(), 
		                      $this->conn->getPw()) or 
		                      die('Could not connect' . mysql_error());
		                      
		mysql_set_charset('utf8',$link);
		
		mysql_select_db($this->conn->getDBName()) or die('Could not select database');
		
    mysql_query("set session character_set_connection=utf8;");
    mysql_query("set session character_set_results=utf8;");
    mysql_query("set session character_set_client=utf8;");
    
    $query = sprintf("SELECT id, startDate, endDate, subject, contents, passwd, regidate, ip, count " . 
		         "FROM schedule_%s " . 
		         "WHERE id = %s",
             mysql_real_escape_string($boardName),
             mysql_real_escape_string($id));

//  echo $query;

		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
		
		$id = "";
    // DB Article
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$id = $row['id'];
		}
		
		// Free resultset
		mysql_free_result($result);
		
		// Closing connection
		mysql_close($link);
    
    
		if ( empty($id) )
		  return false;
	  else
	    return true;
  }
  
  public function isPasswd($boardName, $id, $passwd){

    $link = mysql_connect($this->conn->getHost(), 
		                      $this->conn->getUser(), 
		                      $this->conn->getPw()) or 
		                      die('Could not connect' . mysql_error());
		                      
		mysql_set_charset('utf8',$link);
		
		mysql_select_db($this->conn->getDBName()) or die('Could not select database');
		
    mysql_query("set session character_set_connection=utf8;");
    mysql_query("set session character_set_results=utf8;");
    mysql_query("set session character_set_client=utf8;");
    
    
		$password = $this->crypt->decrypt( $passwd );
    
    $query = sprintf("SELECT id, startDate, endDate, subject, contents, passwd, regidate, ip, count " . 
		         "FROM schedule_%s " . 
		         "WHERE id = %s",
             mysql_real_escape_string($boardName),
             mysql_real_escape_string($id));

//  echo $query;

		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
		
		$id = "";
    // DB Article
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		  
			if ( strcmp( $row['passwd'], $password ) == 0 ){
			  $id = "1";
			}else{
			
			} // end of if
			
		} // end of while
		
		// Free resultset
		mysql_free_result($result);
		
		// Closing connection
		mysql_close($link);
    
    
		if ( empty($id) )
		  return false;
	  else
	    return true;
  }
  
  public function write($boardName, $schedule){
    
    $link = mysql_connect($this->conn->getHost(), 
		                      $this->conn->getUser(), 
		                      $this->conn->getPw()) or 
		                      die('Could not connect' . mysql_error());
		                      
		mysql_set_charset('utf8', $link);
		
		mysql_select_db($this->conn->getDBName()) or die('Could not select database');

    mysql_query("set session character_set_connection=utf8;");
    mysql_query("set session character_set_results=utf8;");
    mysql_query("set session character_set_client=utf8;");
		
		$password = $this->crypt->decrypt( $schedule->getPasswd() );
		
	  $query = sprintf("INSERT INTO `schedule_%s` (`startDate`, `endDate`, " . 
		                 "`subject`, `contents`, `passwd`, `regidate`, `ip`, `count`) " .
        		         "VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
	                   mysql_real_escape_string($boardName),
	                   mysql_real_escape_string($schedule->getStartDate()),
	                   mysql_real_escape_string($schedule->getEndDate()),
	                   mysql_real_escape_string($schedule->getSubject()),
	                   mysql_real_escape_string($schedule->getContents()),
	                   mysql_real_escape_string($password),
	                   mysql_real_escape_string($schedule->getRegidate()),
	                   mysql_real_escape_string($schedule->getIp()),
	                   mysql_real_escape_string($schedule->getCount()));  // SQL Injection 점검
		
		//echo "야야야야" . $schedule->getStartDate();
	  //echo $query;
		
		$result = mysql_query($query, $link) or die('Query failed: ' . mysql_error());
	  
		// Closing connection
		mysql_close($link);
	  
	  return $result;
    
  } // end of function
  
  public function update($boardName, $schedule){
    
    $link = mysql_connect($this->conn->getHost(), 
		                      $this->conn->getUser(), 
		                      $this->conn->getPw()) or 
		                      die('Could not connect' . mysql_error());
		                      
		mysql_set_charset('utf8', $link);
		
		mysql_select_db($this->conn->getDBName()) or die('Could not select database');

    mysql_query("set session character_set_connection=utf8;");
    mysql_query("set session character_set_results=utf8;");
    mysql_query("set session character_set_client=utf8;");
		
	  $query = sprintf("UPDATE `schedule_%s` SET `startDate` = '%s', `endDate` = '%s', " .
	                   "`subject` = '%s', `contents` = '%s' WHERE `schedule_%s`.`id` = '%s'",
	                   mysql_real_escape_string($boardName),
                     mysql_real_escape_string($schedule->getStartDate()),
                     mysql_real_escape_string($schedule->getEndDate()),
                     mysql_real_escape_string($schedule->getSubject()),
                     mysql_real_escape_string($schedule->getContents()),
                     mysql_real_escape_string($boardName),
	                   mysql_real_escape_string($schedule->getId()));       // SQL Injection 점검
	                   
		//echo "야야야야" . $schedule->getStartDate();
	  //echo $query;
		
		$result = mysql_query($query, $link) or die('Query failed: ' . mysql_error());
	  
		// Closing connection
		mysql_close($link);
	  
	  return $result;
    
  } // end of function
  
  public function remove($boardName, $schedule){
    
    $link = mysql_connect($this->conn->getHost(), 
		                      $this->conn->getUser(), 
		                      $this->conn->getPw()) or 
		                      die('Could not connect' . mysql_error());
		                      
		mysql_set_charset('utf8', $link);
		
		$password = $this->crypt->decrypt( $schedule->getPasswd() );
		
		mysql_select_db($this->conn->getDBName()) or die('Could not select database');

    mysql_query("set session character_set_connection=utf8;");
    mysql_query("set session character_set_results=utf8;");
    mysql_query("set session character_set_client=utf8;");
		
	  $query = sprintf("DELETE FROM `schedule_%s` WHERE `id` = '%s' AND `passwd` = '%s'" ,
	                   mysql_real_escape_string($boardName),
	                   mysql_real_escape_string($schedule->getID()),
	                   mysql_real_escape_string($password));       // SQL Injection 점검
	                   
		//echo "야야야야" . $schedule->getStartDate();
	  echo $query;
		
		$result = mysql_query($query, $link) or die('Query failed: ' . mysql_error());
	  
		// Closing connection
		mysql_close($link);
	  
	  return $result;
    
  } // end of function
  
}

?>