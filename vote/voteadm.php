<?
/*
作者：亂糟糟
日期：2005.7.24
版本：1
功能：後台管理，列出某個投票的各參數和各個選項。
*/
include("conn.php");

$Vid = $_GET['id'];
if (!preg_match("/^[0-9]*$/",$Vid)) $Vid = 1; 
if (isset($_POST['v'])){
switch($_POST['v']){
	case "1":
		switch($_POST['act']){
		case "insert":
			$query  = "insert vote (`title`,`desc`,`class`,`talk`,`valuedate`,`isuser`,`perip`) values ('".$_POST['title']."','".$_POST['desc']."',".$_POST['class'].",".$_POST['talk'].",'".$_POST['date']."',".($_POST['a'] * $_POST['isuser']).",".($_POST['b'] * $_POST['perip']).")";
			break;
		case "mod":
			$query  = "update vote set `title`='".$_POST['title']."',`desc`='".$_POST['desc']."',`class`=".$_POST['class'].",`talk`=".$_POST['talk'].",`valuedate`='".$_POST['date']."',`isuser`=".($_POST['a'] * $_POST['isuser']).",`perip`=".($_POST['b'] * $_POST['perip'])." where id=".$_POST['vid'];
			break;
		}
		break;
	case "2":
		switch($_POST['act']){
			case "insert":
				$query  = "insert voteitem (`Vid`,`desc`,`img`,`count`) values (".$_POST['vid'].",'".$_POST['vtdesc']."','".$_POST['vtimg']."',0)";
				break;
			case "del":
				$query  = "delete from voteitem where id=".$_POST['vtid'];
				break;
			case "mod":
				$query  = "update voteitem set `desc`='".$_POST['vtdesc']."',`img`='".$_POST['vtimg']."',`count`=".$_POST['vtcount']." where id=".$_POST['vtid'];
				break;
		}
		break;
}
$aa = $query;
$result   = mysql_query($query, $id); 
if ($Vid=="") $Vid = mysql_insert_id();
}

if ($Vid<>"")
{
$query    = "select * from vote where id=".$Vid;
$result   = mysql_query($query, $id); 
$rows     = mysql_num_rows($result);
$row      = mysql_fetch_array($result);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>VOTE管理</title>
<style type="text/css">
<!--
body {
	font-family: Verdana, 宋體,Arial, Helvetica, sans-serif;
	font-size: 12px;
	line-height: 1.6;
}
a {
	FONT-FAMILY: "Verdana", "宋體";
	TEXT-DECORATION: none;
	line-height: 145%;
	color: #0F0CBF;
}

.select {
	font-family: Verdana, "宋體", Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-style: normal;
	line-height: normal;
	color: #000099;
}
.title {
	font-family: "宋體", Verdana, Arial, Helvetica, sans-serif;
	font-size: 18px;
	font-style: normal;
	line-height: normal;
	text-align: center;
	font-weight: bold;
	color: #000099;
}

.big {
	font-family: Verdana, 宋體,Arial, Helvetica, sans-serif;
	font-size: 16px;
	font-style: normal;
	line-height: 1.6;
}
.middle {
	font-family: Verdana, 宋體,Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-style: normal;
	line-height: 1.6;
}
.small {
	font-family: Verdana, 宋體,Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-style: normal;
	line-height: 1.6;
}
.input {
	border-bottom-width: 1px;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: solid;
	border-left-style: none;
	border-bottom-color: #33CCFF;
	font-family: Verdana;
	font-size: 12px;
	color: #0000CC;
}

-->
</style>
</head>

<body><?//  echo $aa;?>
<table width="480" border="0" cellspacing="0" cellpadding="0" align="center">
<form action="voteadm.php?id=<? echo $Vid;?>" name="vote" method="post">
<tr><td height="30" bgcolor="#9999FF" class="middle"><font color="#FFFFFF">
  <li><b><? echo $row['title']."(調查代號：".$row['id'].")";?></b></li></font></td></tr>
<tr><td height="35">
標題：<input name="title" size="70" type="text" class="input" value="<? echo $row['title']?> "></td></tr><tr><td height="25">
描述：<input name="desc" size="70" type="text" class="input" value="<? echo $row['desc']?>"></td></tr><tr><td height="25">
類別：<input name="class" type="radio" value="0"<? echo ($row['class']==0? " checked":"")?>>單選 <input name="class"  type="radio" value="1"<? echo ($row['class']==1?" checked":"")?>>
多選 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;評論：
<input type="radio" name="talk" value="1" <? echo ($row['talk']==1? " checked":"")?>>允許<input type="radio" name="talk" value="0" <? echo ($row['talk']==0? " checked":"")?>>不允許</td>
</tr><tr><td height="25">
截至：<input name="date" type="text" size="70" class="input" value="<? echo $row['valuedate']?>"></td></tr><tr><td height="25">
用戶：<input name="a" onclick="email2()"  type="radio" value="0" <? echo ($row['isuser']==0?'checked':'')?>>不限制<input name="a" onclick="email1()"  type="radio" value="1" <? echo ($row['isuser']==0?'':'checked')?>>限制每用戶可投票次數為：<input name="isuser" type="text" class="input" size="2" value="<? echo $row['isuser']?>"<? echo ($row['isuser']==0?' style="visibility:hidden "':'') ?>></td></tr><tr><td height="25">
每IP：<input name="b" onclick="ip2()"  type="radio" value="0" <? echo ($row['perip']==0?'checked':'')?>>不限制<input name="b" onclick="ip1()"  type="radio" value="-1" <? echo ($row['perip']<0?'checked':'')?>>限制每IP總共可投票次數為：<input name="b" onclick="ip1()"  type="radio" value="1" <? echo ($row['perip']>0?'checked':'')?>>限制每IP每天可投票次數為：<input name="perip" type="text" size="2" class="input" value="<? echo abs($row['perip'])?>"<? echo ($row['perip']==0?' style="visibility:hidden "':'')?>>
</td></tr><tr><td align="center"><input name="v" type="hidden" value="1"><input name="vid" type="hidden" value="<? echo $Vid;?>">
<?
if (isset($_GET['id']))
{
?>
<input type="submit"  onclick="javascript:document.vote.act.value='mod';document.vote.submit()" value="修改這個調查">
<?
}
else
{
?>
<input type="submit"  onclick="javascript:document.vote.act.value='insert';document.vote.submit()" value="添加新調查">
<? } ?>
<input name="act" type="hidden" value=""></td></tr></form></table><br>
<?
if (isset($_GET['id']))
{
?>
<table  width="480" border="0" cellspacing="0" cellpadding="0" align="center">
<tr bgcolor="#9999FF" class="middle" align="center">
	<td width="60" align="center" height="48"><b>序號</b></td>
	<td width="355" align="center"><b>選項描述及圖形</b></td>
	<td width="65" align="center"><b>投票數量</b></td></tr>
	<form action="voteadm.php?id=<? echo $Vid;?>" name="item" method="post">
<?
$query    = "select * from voteitem where Vid=".$Vid;
$result   = mysql_query($query, $id); 
$i        = 1;
while($row = mysql_fetch_array($result))
{
  $bgcolor = ($bgcolor  == ' bgcolor="#EAEFF5"' ? ' ' : ' bgcolor="#EAEFF5"' );
  echo '<tr '.$bgcolor.' valign="middle"><td height="48"><input name="vid" value="'.$row['id'].'" onclick="javascript:document.item.vtid.value=\''.$row['id'].'\';document.item.vtdesc.value=\''.$row['desc'].'\';document.item.vtimg.value=\''.$row['img'].'\';document.item.vtcount.value=\''.$row['count'].'\';"  type="radio">'.$i.'</td><td>'.$row['desc'].' <br>('.$row['img'].') </td><td align="center">'.$row['count'].'</td>'.chr(10);
  $i++;
}

?>
<tr valign="middle"><td height="48"><input name="v" type="hidden" value="2"><input name="vid" type="hidden" value="<? echo $Vid;?>"><input name="vtid" type="hidden" value=""><input name="act" type="hidden" value=""></td><td align="center"><input name="vtdesc" class="input" size="58"><br><input name="vtimg" class="input" size="58"></td><td align="center"><input name="vtcount" class="input" size="6"></td></tr>
<tr><td align="center" colspan="3" height="28"><input name="" onclick="javascript:document.item.act.value='insert';document.item.submit()" type="button" value="增加"> &nbsp;&nbsp;&nbsp;&nbsp;<input name="Input"  onclick="javascript:document.item.act.value='del';document.item.submit()" type="button" value="刪除"> &nbsp;&nbsp;&nbsp;&nbsp;  <input name="Input2" onclick="javascript:document.item.act.value='mod';document.item.submit()" type="button" value="修改"> </td>
</tr>
</table>
<?
}
?>
<script language="javascript">
function email1()
{
  vote.isuser.style.visibility="visible";
}
function email2()
{
  vote.isuser.style.visibility="hidden";
}

function ip1()
{
  vote.perip.style.visibility="visible";
}
function ip2()
{
  vote.perip.style.visibility="hidden";
}

</script>
</body>
</html>
