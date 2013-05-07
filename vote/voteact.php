<?
/*
作者：亂糟糟
日期：2005.7.24
版本：1
功能：從調查表中選取調查項目，從主表中取相應的細目， 接收到訪客提交的選擇後，先查看該email是否註冊，是則直接該選項+1、IP+1；否則，寫入newsuser表，發送郵件等待確認。
*/
include("conn.php");
//取得voteid
//$query  = "select Vid from voteitem where id=".$_POST['item'][0];
$query = "
SELECT 
  `vote`.`id`,
  `vote`.`isuser`,
  `vote`.`perip`,
  `vote`.`valuedate`
FROM
  `vote`
  INNER JOIN `voteitem` ON (`vote`.`id` = `voteitem`.`Vid`)
WHERE `voteitem`.`id`=".$_POST['item'][0];
$result = mysql_query($query, $id); 
$row    = mysql_fetch_array($result);
$Vid    = $row['id'];
$isuser = $row['isuser'];
$perip  = $row['perip'];
/*
while (list($key,$val) = each($_POST['item']))
{
  $item  .=  $val.",";
}
$item     = substr($item,0,-1);
*/
$item  = implode(",",$_POST['item']);

function checkip($perip,$Vid,$id)//檢查是否有IP限制
{
	if ($perip==0)//不限制
	{
		return 1;
	}
	else
	{
		$query  = "
		SELECT 
		  `count`
		FROM
		  `voteguest`
		WHERE
		  `Vid` = ".$Vid." and class=0".($perip<0?"":" and `date` = now()")." and `text` = '".$_SERVER['REMOTE_ADDR']."'";//$perip = -1,限制IP，但不是限制到每一天
		$result = mysql_query($query, $id); 
		if (mysql_num_rows($result)<1)//今日尚未有本IP投票
		{
			$query  = "insert voteguest (Vid,class,text,date,count) values (".$Vid.",'0','".$_SERVER['REMOTE_ADDR']."',now(),1)";
			$result = mysql_query($query, $id); 
			return 1;
		}
		else
		{
			$row    = mysql_fetch_array($result);
			if (abs($perip) > $row['count']) //今日IP限制尚未達到
			{
				$query  = "update voteguest set count=count+1 where Vid=".$Vid." and class=0 and ".($perip == -1?"":"`date` = now()")." and `text` = '".$_SERVER['REMOTE_ADDR']."'";
				$result = mysql_query($query, $id); 
				return 1;
			}
			else//限制IP，今日限制數量已滿
			{
				return 0;
			}
		}
	}
}

//判斷是否是新的email用戶
function checkemail($isuser,$Vid,$email,$item,$id)
{
	if ($isuser<1)
	{
		return 1;
	}
	else
	{
		if($email=="" or strpos($email,"@")<1) return -2;
		$query  =  "select count(*) from voteguest where class=1 and new='0' and text='".$email."'";
		$result = mysql_query($query, $id); 
		$row    = mysql_fetch_array($result);
		if ($row[0]<1)
		{
			$query     = "insert voteguest (class,text,Vid,count,date,new) values (1,'".$email."','".$Vid."',0,now(),'(".$item.")')";
			$result    = mysql_query($query, $id); 
			$content   = "您好，歡迎您參加投票，因為您是第一次在本站投票，請連上下面的地址啟用您的email地址：http://www.railnet.cn/ccp/vote/user.php?u=".md5(md5(mysql_insert_id()));
			mail($email,"謝謝您參加投票並請激活您的郵件地址",$content);
			//$message   = "您好，歡迎您參加投票，因為您是第一次在本站投票，請根據您收到的電子郵件啟用您的email地址。<br>";
			return 0;
		}
		else
		{
			$query  = "
			SELECT 
			  `count`
			FROM
			  `voteguest`
			WHERE
			  `Vid` = ".$Vid." and class=1 and text='".$email."'";
			$result = mysql_query($query, $id); 
			if (mysql_num_rows($result)<1)//尚未有本用戶投票
			{
				$query  = "insert voteguest (class,Vid,text,date,count) values ('1',".$Vid.",'".$email."',now(),1)";
				$result = mysql_query($query, $id); 
				return 1;
			}
			else
			{
				$row    = mysql_fetch_array($result);
				if ($isuser > $row['count']) //限制投票次數尚未達到
				{
					$query  = "update voteguest set count=count+1 where Vid=".$Vid." and class=1 and text='".$email."'";
					$result = mysql_query($query, $id); 
					return 1;
				}
				else//限制限制次數已滿
				{
					//echo "你使用的電腦今日已經參加過投票,請明日再投。";
					return -1;
				}
			}

		}
	}
}

if (checkip($perip,$Vid,$id))
{
	switch (checkemail($isuser,$Vid,trim($_POST['email']),$item,$id)){
	case 1:
		$query     =  "update voteitem set `count`=`count`+ 1 where (id in (".$item."))";
		//$query  .=  "update voteip set `count`=`count`+ 1 where Vid=1 and date=now()";
		$result    =  mysql_query($query, $id); 
		$message   = "謝謝，您已投票成功。<br>";
		break;
	case 0:
		$message   = "歡迎您第一次在本站投票，請馬上連上您的電子郵件，按照提示啟用您的email地址。";
		break;
	case -1:
		$message   = "你已經參加多次本項目投票，謝謝，歡迎您熱情參與其他投票項目。";
		break;
	default:
		$message   = "請填寫正確的email地址。";
		break;
	}
}
else
{
	$message = "您使用的電腦已經參加過投票！歡迎您參加本站其他項目的投票";
}




?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>vote處理</title>
<style type="text/css">
<!--
td {
	font-size: 12px;
	line-height: 1.6;
}
.middle {
	font-family: Verdana, 宋體,Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-style: normal;
	line-height: 1.6;
}
-->
</style>
</head>

<body>
<table  width="400" bgcolor="#FFEA99" border="0" cellspacing="0" cellpadding="0" align="center">
<tr><td><?
//echo  $_SERVER['REMOTE_ADDR'];
echo $message;
//echo $query;
?></td></tr>
<tr><td>
<script language="javascript" src="voteshow.php?id=1"></script></td></tr><tr height="40"><td>&nbsp;</td></tr></table>



</body>
</html>
