<?php
session_start();

//class User
//{
  //比對帳號密碼
  function checklogin($loginname, $loginpswd)
  {
    $sql = "SELECT GUID, LEVEL FROM users ";
    $sql .= "WHERE EMAIL = '".$loginname."' ";
    $sql .= "AND PASSWORD = password('".$loginpswd."')";
    $rs = mysql_query($sql);
    return $rs;
  }
  function checkregister($rename)
  {
    $sql = "SELECT * FROM users ";
    $sql .= "WHERE EMAIL = '".$rename."'";
    $rs = mysql_query($sql);
    $nT = mysql_num_rows($rs);
    return (bool)($nT);
  }
  function adduser($name, $pswd, $level)
  {
    $sql = "INSERT INTO ";
    $sql .= "users (EMAIL, PASSWORD, LEVEL) ";
    $sql .= "VALUES('".$name."', password('".$pswd."'), ".$level.")";
    $rs = mysql_query($sql);
  }
  //依檢查結果分別導向主作業畫面OR錯誤警告畫面
  function setsession($name, $rs)
  {
    list($realname, $userlevel)=mysql_fetch_row($rs);

    //設定session變數之初值
    $_SESSION["ssnUSERNAME"] = $name;
    $_SESSION["ssnUSERGUID"] = $realname ? $realname : $name;
    $_SESSION["ssnUSERLEVEL"] = $userlevel;
  }
//}
function islogin()
{
  return (isset($_SESSION["ssnUSERNAME"]) && !empty($_SESSION["ssnUSERNAME"]));
}
