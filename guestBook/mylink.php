<?php
  $con = mysql_connect("localhost", "zach", "760611");
  if(!$con) die('Could not connect: '. mysql_error());
  mysql_query("SET NAMES 'UTF8'");
  mysql_select_db("zachdb");

?>
