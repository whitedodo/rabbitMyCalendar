<?php

/*
  Subject: Calendar Project
  Create Date: 2019-07-11
  File: remove.php
  Author: Dodo
  E mail: rabbit.white@daum.net
          (jungwy@kumoh.ac.kr)
  Description:
  1. 2019-07-23 / CSS3 작업 및 W3C 표준화 작업/ Dodo / rabbit.white at daum dot net

*/

$calCrud = new Calendar_Crud();

?>

  <link rel="stylesheet" href="css/style.css">
  <title>Remove - Rabbit My Calendar</title>
</head>
<form method="POST" action="index.php">
<input type="hidden" name="mode" value="remove_ok">
<input type="hidden" name="scheduleId" value="<?=$scheduleId;?>">
<input type="hidden" name="boardName" value="<?=$boardName;?>">

<table class="table_write">
  <tr>
    <td>
      <h3>일정 삭제(Remove Schedule)</h3>
    </td>
  </tr>
</table>

<table class="table_write">
  <tr>
    <td class='td_remove_passwd1_theme'>
      <span class="content_Write_Black">비밀번호확인<br>(Check Password)</span>
    </td>
    <td class='txt_remove_txtPasswd1'>
      <input type="password" name="passwd" style="width:100%;">
    </td>
  </tr>
  
  <tr>
    <td class='td_remove_submit' colspan="2">
      <input type="submit" value="질의(Queries)" class="txt_remove_submit">
    </td>
  </tr>
</table>
</form>