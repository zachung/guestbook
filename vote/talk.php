<?
include('conn.php');
$owner = 0;
function change($text)
{
return str_replace(" ","&nbsp;",str_replace(chr(13),"<br>",str_replace(">","&gt;",str_replace("<","&lt;",$text))));
}

if ($_POST['content']!='' and $_POST['gbid']=='' and $_POST['act']=='insert')
{
	$query = "insert into guestbook (name,url,title,tel,mail,content,ip,addtime,owner) values ('".$_POST['name']."','".$_POST['url']."','".$_POST['title']."','".$_POST['tel']."','".$_POST['mail']."','".$_POST['content']."','".$_SERVER['REMOTE_ADDR']."',now(),".$owner.")";
	$result = mysql_query($query, $id); 
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>VOTE管理</title>
</head>
<body>
<table width="750" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#3F8805" style="border-collapse: collapse">
  <tr>
    <td width="190" align="left" >
       <img src="img/gb.gif" width="152" height="52" align="absmiddle">
    </td>
    <td width="560">
      <font color="red">請注意：</font><br>
      1、非常歡迎您就本網站的服務提出好的建議。<br>
      2、請勿在此發表攻擊政府、政策和他人的過激言論，也請不要發表與本站無關的話題，OK？
    </td>
  </tr>
</table>

<form method=post action="guestbook.php" name="gb" onsubmit="return checkName()">
<table width="750" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#3F8805" style="border-collapse: collapse">
  <tr>
    <td colspan="2" bgcolor="#eefee0" align="left">
      <img src="img/gb-add.gif" align="absmiddle"> :::: 請 您 留 言 ::::
    </td>
  </tr>
  <tr>
    <td width="30%" align="center">
      姓名：<input name="name" size="27"><br>
      首頁：<input name="url" size="27" value="http://"><br>
      主題：<input name="title" size="27"><br>
      電話：<input name="tel" size="27"><br>
      Email:<input name="mail" size="27">
    </td>
    <td width="70%" height="160" align="center" valign="middle">
      <textarea rows="8" name="content" cols="80" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px"></textarea><br>
      <input name="act" type="hidden" value="insert">
      <input name="gbid" type="hidden" value="">
      <input type="submit" value="提 交">
      <input type="reset" value="重 填">
    </td>
  </tr>
</table>
</form>
<script>
function checkName() {
   if (gb.name.value=="" & gb.act.value=="insert"){
     alert("請輸入姓名，謝謝！");
     return false;
   }
   return true;
 }
</script>



<?
	$perpage=10;//每頁顯示10條記錄
	$_GET['p']==''?$p=1:$p=$_GET['p'];
	$query = "select * from guestbook where del!=1 and owner=".$owner." order by id desc limit ".$perpage * ($p -1).",".$perpage; 
	$result = mysql_query($query, $id); 
	while ($row = mysql_fetch_array($result))
	{
?>
<table width="750" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#3F8805" style="border-collapse: collapse">
  <tr>
    <td bgcolor="#eefee0" align="left" width="75%" height="20">
	  <img src="/img/gb-index2.gif" align="absmiddle" title="<? echo $row['ip']?>"><? echo $row['name'].' '.$row['addtime'].' 說'?>
	</td>
    <td height="20" bgcolor="#eefee0" width="25%" align="right">
	  <img border="0" src="img/gb-mail.gif" align="absmiddle" title="<? echo $row['mail']?>">&nbsp;<? if ($row['url']!=''){ echo '<a href="'.$row['url'].'" target="_blank">';}?><img border="0" src="img/gb-url.gif" align="absmiddle"><? if ($row['url']!=''){ echo '</a>';}?>&nbsp;
	</td>
  </tr>
  <tr>
    <td colspan="2" height="120" style="WORD-WRAP:break-word">
      <table width="97%" align="center" border="0">
        <tr>
          <td>
            <? echo change($row['content']);?>
          </td>
        </tr>
	   <? if ($row['reply']!=""){?>
        <table width="95%" align="center" border="0">
          <tr>
            <td>
              <font color="blue">回覆：</font><br><? echo change($row['reply']);?>
            </td>
         </tr>
       </table><? }?>
    </table>
    </td>
  </tr>
</table>
<br>
<?
	}
?>


<table width="750" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#3F8805" style="border-collapse: collapse">
  <tr>
    <td>
<?	
	$query  = "select count(*) from guestbook where del!=1 and owner=".$owner; 
	$result = mysql_query($query, $id); 
	$row    = mysql_fetch_array($result);
	if ($row[0]<1) {
	echo '<font color=red>現在還沒有留言。</font>';
	}
	else{
	}
 $perpage    = 10;//如果頁碼太多，每次只顯示10個頁碼
 $totalpage  = ceil($row[0]/$perpage);//總頁碼
 $page       = floor($p/$perpage);//第幾屏顯示頁碼,1-10頁，都顯示同樣的一行
 if ($p > $perpage){//總頁數大於10，就有前翻十筆<<
?>
<a href="guestbook.php?p=<? echo ($page - 1)*$perpage+1;?>">&lt;&lt;</a>&nbsp;
<?
}
for($m=$page*$perpage; $m<($totalpage>($page+1)*$perpage?($page+1)*$perpage:$totalpage); $m++){//如果最後一屏不足10個頁碼，就要減少循環次數
?>
      <a  href="guestbook.php?p=<? echo ($m+1); ?>" target="_self"><? echo ($m+1);?></a>&nbsp;&nbsp;
<? }
if ($totalpage>($page+1)*$perpage)//後翻十筆
{?>
<a href="guestbook.php?p=<? echo ($page+1)*$perpage+1;?>">&gt;&gt;</a>&nbsp;
<?
}
?>
    </td>
  </tr>
</table>
</body>
</html>