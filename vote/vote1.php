<?
/*
作者：亂糟糟
日期：2005.7.24
版本：1
功能：從調查表中選取調查項目，從主資料表中取相應的細目， 接收到訪客提交的選擇後，先查看該email是否註冊，是則直接該選項+1、IP+1；否則，寫入newsuser資料表，等待確認。
*/
include("conn.php");

$Vid = $_GET['id'];
if (!preg_match("/^[0-9]*$/",$Vid)) $Vid = 1; 
$query    = "select * from vote where id=".$Vid." and valuedate>=now()";
$result   = mysql_query($query, $id); 
$rows     = mysql_num_rows($result);
if($rows <1)
{
  $js    .= "該調查不存在或已過期！";
}
else
{
  $row    = mysql_fetch_array($result);
  $js    .= '<form action="voteact.php" method="post">';
  $js    .= '<table align="center" border="0" cellspacing="1" cellpadding="0" width="380"><tr bgcolor="#F4A612" height="40"><td colspan="2"><b>'.$row['title'].'</b></td></tr>';
  $js    .=($row['desc']==""?'':'<tr height="40" bgcolor="#FFFFFF"><td width="90">&nbsp;投票說明：</td><td>'.$row['desc'].'</td></tr>');
  $js    .='<tr height="40" bgcolor="#FFFFFF"><td width="90">&nbsp;有效期限：</td><td>'.$row['valuedate'].'</td></tr>';
  $js    .='<tr height="40" bgcolor="#FFFFFF"><td width="90">&nbsp;投票限制：</td><td>'.($row['isuser']==0?'不限制每用戶投票次數':'限制每用戶可投票'.$row['isuser'].'次').'；'.($row['perip']==0?'不限制每IP投票次數':($row['perip']<0?'限制每IP總共可投票':'限制每IP每天可投票').abs($row['perip']).'次').'</td></tr>';
  $js    .='<tr height="40" bgcolor="#FFFFFF"><td valign="top" width="90"><table border="0" cellspacing="0" cellpadding="0"><tr height="40"><td>&nbsp;投票選項：</td></tr></table></td><td>';
  $query  = "select * from voteitem where Vid=".$Vid;
  $result = mysql_query($query, $id); 
  if($row['class']==0)
  {
    while($row1 =mysql_fetch_array($result))
    {
     $js    .=  '  <input name="item[]" type="radio" value="'.$row1['id'].'">'.$row1['desc']."<br>";
    }
  }
  else
  {
    while($row1 =mysql_fetch_array($result))
    {
      $js    .= '  <input name="item[]" type="checkbox" value="'.$row1['id'].'">'.$row1['desc']."<br>";
    }
  }
  if($row['isuser']==0)
  {
  }
  else
  {
    $js    .= '<br>  您的Email：  <input type="text" name="email" class="input1" size="43"><br>  （提示：如第一次參加本站投票，請收取電子郵件根據提示啟用。）<br>';
  }
  $js    .= '<br><center><input type="submit" name="Submit" value="投票"></center><br></td></tr></table></form>';
}
?>
document.write('<? echo $js;?>');
