<?php

/*
  Subject: Calendar Project
  Create Date: 2019-07-10 ~ 2019-07-11
  File: write.php
  Author: Dodo
  E mail: rabbit.white@daum.net
          (jungwy@kumoh.ac.kr)
  Description:
  1. 2019-07-23 / CSS3 작업 및 W3C 표준화 작업/ Dodo / rabbit.white at daum dot net
  
*/
  
?>
  <link rel="stylesheet" href="css/style.css">
  <title>Write - Rabbit My Calendar</title>
</head>
<body>

<form method="POST" action="index.php">
<input type="hidden" name="mode" value="write_ok">
<input type="hidden" name="boardName" value="<?=$boardName;?>">

<table class="table_write">
  <tr>
    <td colspan="10">
      <h3>일정 입력(Writing Schedule)</h3>
    </td>
  </tr>
  <tr>
    <td class='td_write_startYear_theme'>
      <span class="content_Write_Black">시작년<br>(Start Year)</span>
    </td>
    <td class='txt_write_txtDate'>
      <select name="start_year">
        <?php
          for ( $i = 1900; $i < ( date("Y") + 10 ); $i++ ){
            echo "<option value='". $i . "'>" . $i . "</option>";
          }
        ?>
      </select>
    </td>
    <td class='td_write_startMonth_theme'>
      <span class="content_Write_Black">시작월<br>(Start Month)</span>
    </td>
    <td class='txt_write_txtDate'>
      <select name="start_month">
        <?php
          for ( $i = 1; $i <= 12; $i++ ){
            echo "<option value='". $i . "'>" . $i . "</option>";
          }
        ?>
      </select>
    </td>
    <td class='td_write_startDay_theme'>
      <span class="content_Write_Black">시작일<br>(Start Day)</span>
    </td>
    <td class='txt_write_txtDate'>
      <select name="start_day">
        <?php
          for ( $i = 1; $i <= 31; $i++ ){
            echo "<option value='". $i . "'>" . $i . "</option>";
          }
        ?>
      </select>
    </td>
    <td class='td_write_startHour_theme'>
      <span class="content_Write_Black">시작시간<br>(Start Hour)</span>
    </td>
    <td class='txt_write_txtDate'>
      <select name="start_hour">
        <?php
          for ( $i = 0; $i <= 23; $i++ ){
            echo "<option value='". $i . "'>" . $i . "</option>";
          }
        ?>
      </select>
    </td>
    <td class='td_write_startMin_theme'>
      <span class="content_Write_Black">시작분<br>(Start Miniute)</span>
    </td>
    <td class='txt_write_txtDate'>
      <select name="start_miniute">
        <?php
          for ( $i = 0; $i <= 59; $i++ ){
            echo "<option value='". $i . "'>" . $i . "</option>";
          }
        ?>
      </select>
    </td>
  </tr>
  <tr>
    <td class='td_write_endYear_theme'>
      <span class="content_Write_Black">종료년<br>(End Year)</span>
    </td>
    <td class='txt_write_txtDate'>
      <select name="end_year">
        <?php
          for ( $i = 1900; $i < ( date("Y") + 10 ); $i++ ){
            echo "<option value='". $i . "'>" . $i . "</option>";
          }
        ?>
      </select>
    </td>
    <td class='td_write_endMonth_theme'>
      <span class="content_Write_Black">종료월<br>(End Month)</span>
    </td>
    <td class='txt_write_txtDate'>
      <select name="end_month">
        <?php
          for ( $i = 1; $i <= 12; $i++ ){
            echo "<option value='". $i . "'>" . $i . "</option>";
          }
        ?>
      </select>
    </td>
    <td class='td_write_endDay_theme'>
      <span class="content_Write_Black">종료일<br>(End Day)</span>
    </td>
    <td class='txt_write_txtDate'>
      <select name="end_day">
        <?php
          for ( $i = 1; $i <= 31; $i++ ){
            echo "<option value='". $i . "'>" . $i . "</option>";
          }
        ?>
      </select>
    </td>
    <td class='td_write_endHour_theme'>
      <span class="content_Write_Black">종료시간<br>(End Hour)</span>
    </td>
    <td class='txt_write_txtDate'>
      <select name="end_hour">
        <?php
          for ( $i = 0; $i <= 23; $i++ ){
            echo "<option value='". $i . "'>" . $i . "</option>";
          }
        ?>
      </select>
    </td>
    <td class='td_write_endMin_theme'>
      <span class="content_Write_Black">종료분<br>(End Miniute)</span>
    </td>
    <td class='txt_write_txtDate'>
      <select name="end_miniute">
        <?php
          for ( $i = 0; $i <= 59; $i++ ){
            echo "<option value='". $i . "'>" . $i . "</option>";
          }
        ?>
      </select>
    </td>
  </tr>
  <tr>
    <td class='td_write_subject_theme'>
      <span class="content_Write_Black">제목<br>(Subject)</span>
    </td>
    <td class='txt_write_txtSubject' colspan="9">
      <input type="text" name="subject" style="width:100%;">
    </td>
  </tr>
  <tr>
    <td class='td_write_contents_theme'>
      <span class="content_Write_Black">내용<br>(Contents)</span>
    </td>
    <td class='txt_write_txtContents' colspan="9">
      <textarea name="contents" cols="40" rows="8" style="width:100%;height:100px;"></textarea>
    </td>
  </tr>
  <tr>
    <td class='td_write_passwd1_theme'>
      <span class="content_Write_Black">비밀번호<br>(Password)</span>
    </td>
    <td class='txt_write_txtPasswd1' colspan="9">
      <input type="password" name="passwd" style="width:100%;">
    </td>
  </tr>
  <tr>
    <td class='td_write_passwd2_theme'>
      <span class="content_Write_Black">비밀번호확인<br>(Check Password)</span>
    </td>
    <td class='txt_write_txtPasswd2' colspan="9">
      <input type="password" name="passwd2" style="width:100%;">
    </td>
  </tr>
  
  <tr>
    <td class='txt_write_submit' colspan="10">
      <input type="submit" value="추가(Add)" class='btn_write_submit'>
    </td>
  </tr>
</table>
</form>
