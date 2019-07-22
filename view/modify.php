<?php

/*
  Subject: Calendar Project
  Create Date: 2019-07-11
  File: modify.php
  Author: Dodo
  E mail: rabbit.white@daum.net
          (jungwy@kumoh.ac.kr)
  Description:
  1. 2019-07-23 / CSS3 작업 및 W3C 표준화 작업/ Dodo / rabbit.white at daum dot net
  
*/

$calCrud = new Calendar_Crud();

?>
  <link rel="stylesheet" href="css/style.css">
  <title>Modify - Rabbit My Calendar</title>
</head>
<body>

<form method="POST" action="index.php">
<input type="hidden" name="mode" value="modify_ok">
<input type="hidden" name="scheduleId" value="<?=$scheduleId;?>">
<input type="hidden" name="boardName" value="<?=$boardName;?>">

<table class="table_write">
  <tr>
    <td>
      <h3>일정 수정(Modify Schedule)</h3>
    </td>
  </tr>
</table>

<?php 
  $calCrud->readSchedule($boardName, $scheduleId);
?>

<!-- 수정 기능-->
<table class="table_write">
  <tr>
    <td class="txt_modify_submit">
      <input type="submit" value="질의(Queries)" class="btn_modify_submit">
    </td>
  </tr>
</table>
</form>
