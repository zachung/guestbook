<?php
include("configure.php");
//建立資料庫連線
  $link = mysql_connect($cfgDB_HOST, $cfgDB_USERNAME, $cfgDB_PASSWORD) or die("MySQL伺服器連接失敗：".mysql_error());
  mysql_query("SET NAMES 'UTF8'");
//選擇資料庫
  mysql_select_db($cfgDB_NAME,$link);
?>
