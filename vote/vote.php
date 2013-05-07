<?
/*
作者：亂糟糟
日期：2005.7.24
版本：1
功能：從調查表中選取調查項目，從主表中取相應的細目， 接收到訪客提交的選擇後，先查看該email是否註冊，是則直接該選項+1、IP+1；否則，寫入newsuser表，等待確認。
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
  $js    .= '  <b>'.$row['title']."</b><br>".($row['des']==""?"":$row['des']."<br>");
  $query  = "select * from voteitem where Vid=".$Vid;
  $result = mysql_query($query, $id); 
  if($row['class']==0)
  {
    while($row1 =mysql_fetch_array($result))
    {
     $js    .=  '  <input name="item[]" type="radio" value="'.$row1['id'].'">'.$row1['des']."<br>";
    }
  }
  else
  {
    while($row1 =mysql_fetch_array($result))
    {
      $js    .= '  <input name="item[]" type="checkbox" value="'.$row1['id'].'">'.$row1['des']."<br>";
    }
  }
  if($row['isuser']==0)
  {
  }
  else
  {
    $js    .= '<br>  您的Email：  <input type="text" name="email" class="input" size="43"><br>  （提示：如第一次參加本站投票，請收取郵件根據提示啟用。）<br>';
  }
  $js    .= '  <input type="submit" name="Submit" value="提交"></form>';
}
?>
document.write('<? echo $js;?>');

