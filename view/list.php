<?php
/*
  Subject: Calendar Project
  Create Date: 2019-07-10
  File: list.php
  Author: Dodo
  E mail: rabbit.white@daum.net
          (jungwy@kumoh.ac.kr)
  Description:
  1. 2019-07-11 / 일정 상세 추가 / Dodo / rabbit.white at daum dot net
  2. 2019-07-23 / CSS3 작업 및 W3C 표준화 작업/ Dodo / rabbit.white at daum dot net
*/

  $calCrud = new Calendar_Crud();
  $cal = $calCrud->getCalView();
  $day1;
  $day2;
  
  $cal->setYear($year);
  $cal->setMonth($month);
  
  $calCrud->setCalView($cal);
  $calCrud->create();
  $cal = $calCrud->getCalView();
    
  $last_day = $cal->getLastDay();
  $start_week = $cal->getStartWeek();
  $total_week = $cal->getTotalWeek();
  $last_week = $cal->getLastWeek();
  
?>
  <link rel="stylesheet" href="css/style.css" type="text/css">
  <title>List - Rabbit My Calendar</title>
  
</head>
<body>

<table id="table">

  <tr>
    <td colspan="7">
      <!-- 일정 상단 구현 -->
      <table >
        <tr>
          <td>
            <h3><?=$year . "-" . $month ?></h3>
          </td>
        </tr>
        <tr>
          <td>
            <!-- index.php  GET전달-->
            <form method="get" action="index.php">
              <input type="hidden" name="mode" value="list">
              <input type="hidden" name="boardName" value="<?=$boardName;?>">
              <select name="year">
                <?php
                    echo "<option value='". $year . "'>" . $year . "</option>";
                ?>
                <?php
                  for ( $i = 1900; $i < ( date("Y") + 10 ); $i++ ){
                    echo "<option value='". $i . "'>" . $i . "</option>";
                  }
                ?>
              </select>
              <select name="month">
                <?php
                    echo "<option value='". $month . "'>" . $month . "</option>";
                ?>
                <?php
                  for ( $i = 1; $i <= 12; $i++ ){
                    echo "<option value='". $i . "'>" . $i . "</option>";
                  }
                ?>
              </select>
              <input type="submit" value="Queries(조회)"/>
            </form>
            <button type="button"
             onclick="location.href='index.php?mode=write&boardName=<?=$boardName; ?>' ">쓰기(Write)</button>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td class='td_list_day_title_theme'>
      <div style="font-size:12px;font-weight:bold;">일(Sun)</div>
    </td>
    <td class='td_list_day_title_theme'>
      <div style="font-size:12px;font-weight:bold;">월(Mon)</div>
    </td>
    <td class='td_list_day_title_theme'>
      <div style="font-size:12px;font-weight:bold;">화(Tue)</div>
    </td>
    <td class='td_list_day_title_theme'>
      <div style="font-size:12px;font-weight:bold;">수(Wed)</div>
    </td>
    <td class='td_list_day_title_theme'>
      <div style="font-size:12px;font-weight:bold;">목(Thu)</div>
    </td>
    <td class='td_list_day_title_theme'>
      <div style="font-size:12px;font-weight:bold;">금(Fri)</div>
    </td>
    <td class='td_list_day_title_theme'>
      <div style="font-size:12px;font-weight:bold;">토(Sat)</div>
    </td>
  </tr>
       
  <?
    // 5. 화면에 표시할 화면의 초기값을 1로 설정
    $day1 = 1;
    $day2 = 1;

    // 6. 총 주 수에 맞춰서 세로줄 만들기
    for($i=1; $i <= $total_week; $i++){?>
  <tr>
    <?
        // 7. 총 가로칸 만들기
        for ($j = 0; $j < 7; $j++){
    ?>
    <td class='td_list_memo_theme'>
      <?
        // 8. 첫번째 주이고 시작요일보다 $j가 작거나 마지막주이고 $j가 마지막 요일보다 크면 표시하지 않아야하므로
        //    그 반대의 경우 -  ! 으로 표현 - 에만 날자를 표시한다.
        if (!(($i == 1 && $j < $start_week) || ($i == $total_week && $j > $last_week))){
          
            
            if($j == 0){
                // 9. $j가 0이면 일요일이므로 빨간색
                echo "<span class='content_Red'>";
            }else if($j == 6){
                // 10. $j가 0이면 일요일이므로 파란색
                echo "<span class='content_Blue'>";
            }else{
                // 11. 그외는 평일이므로 검정색
                echo "<span class='content_Black'>";
            }

            // 12. 오늘 날짜면 굵은 글씨
            if($year == date("Y") &&
               $month == date("m") &&
               $day1 == date("j")
              )
            {
                echo "<b>";
            }
           
            // 13. 날짜 출력
            if ( $day1 <= $last_week ){
              ?>
              
              <?php
                echo $day1;
                echo "<a href='index.php?mode=read&boardName=$boardName&year=$year&month=$month&day=$day1' class='c2'>";
                echo " >>";
                echo "</a>";
              ?>
              
              <?php
            }
            
            if($year == date("Y") &&
               $month == date("m") &&
               $day1 == date("j")
            )
              {
                echo "</b>";
            }

            echo "</span>";

            // 14. 날짜 증가
            $day1++;
        }
        ?>
    </td>
    <?}?>
  </tr>
  
  
    <tr>
    <?
        // 7. 총 가로칸 만들기
        for ($k=0; $k < 7; $k++){
    ?>
    <td class='td_list_memo_theme'>
      <?
        // 8. 첫번째 주이고 시작요일보다 $k가 작거나 마지막주이고 $k가 마지막 요일보다 크면 표시하지 않아야하므로
        //    그 반대의 경우 -  ! 으로 표현 - 에만 날자를 표시한다.
        if (!(($i == 1 && $k < $start_week) || ($i == $total_week && $k > $last_week))){

            if($k == 0){
                // 9. $k가 0이면 일요일이므로 빨간색
                echo "<span class='content_Red'>";
            }else if($k == 6){
                // 10. $k가 0이면 일요일이므로 파란색
                echo "<span class='content_Blue'>";
            }else{
                // 11. 그외는 평일이므로 검정색
                echo "<span class='content_Black'>";
            }

            // 12. 오늘 날짜면 굵은 글씨
            if($year == date("Y") &&
               $month == date("m") &&
               $day2 == date("k")
              )
            {
                echo "<b>";
            }
           
            // 13. 날짜 출력
            if ( $day2 <= $last_week ){
              $calCrud->readArticle ( $boardName, $year, $month, $day2);
            }
            
            if($year == date("Y") &&
               $month == date("m") &&
               $day2 == date("k")
            )
              {
                echo "</b>";
            }

            echo "</span>";

            // 14. 날짜 증가
            $day2++;
        }
        ?>
    </td>
    <?}?>
  </tr>
  <?}?>
</table>
