<?
/*
作者：亂糟糟
日期：2005.7.24
版本：1
功能：新email註冊用戶處理。
*/
include("conn.php");
$query  = "select * from voteguest where `count`=0 and md5(md5(id))='".trim($_GET['u'])."'";
$result = mysql_query($query, $id); 
while($row  = mysql_fetch_array($result))
{
	$query  = "update voteitem set count=count+1 where (id in ".$row['new'].")";
	$result = mysql_query($query, $id); 
	$query  = "update voteguest set count=1,new=0 where id=".$row['id'];
	$result = mysql_query($query, $id); 
	$email  = $row['text'];
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>歡迎您，<? echo $email;?></title>
</head>

<body>
歡迎您，<? echo $email;?>，您已經在本站投票系統註冊成功！系統已經將您第一次投票的內容納入投票結果中。<br>
歡迎您以後繼續參加本站其他項目的投票。以後的投票項目將不再需要您收取郵件啟動操作。
</body>
</html>
