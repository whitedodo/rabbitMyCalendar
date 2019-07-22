<?php

/*
  Subject: Calendar Project
  Create Date: 2019-07-10
  File: write.php
  Author: Dodo
  E mail: rabbit.white@daum.net
          (jungwy@kumoh.ac.kr)
  Description:
  1. 2019-07-23 / CSS3 작업 및 W3C 표준화 작업/ Dodo / rabbit.white at daum dot net
*/

$calCrud = new Calendar_Crud();
?>
  <link rel="stylesheet" href="css/style.css">
  <title>Read - Rabbit My Calendar</title>
</head>
<body>

<form method="POST" action="index.php">
<input type="hidden" name="mode" value="modify_ok">
<input type="hidden" name="boardName" value="<?=$boardName;?>">
<table class="table_write">
  <tr>
    <td>
      <h3>일정 내용(View - Schedule)</h3>
    </td>
  </tr>
</table>

<?php
  $calCrud->readList($boardName, $year, $month, $day);
?>

