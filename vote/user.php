<?
/*
睹罺罺
ら戳2005.7.24
セ1
穝email爹ノめ矪瞶
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
<title>舧眤<? echo $email;?></title>
</head>

<body>
舧眤<? echo $email;?>眤竒セщ布╰参爹Θ╰参竒盢眤材Ωщ布ず甧щ布挡狦い<br>
舧眤膥尿把セㄤ兜ヘщ布щ布兜ヘ盢ぃ惠璶眤Μ秎ン币笆巨
</body>
</html>
