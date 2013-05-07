<?
/*
作者：亂糟糟
日期：2005.7.24
版本：1
功能：顯示投票結果。
*/
include("conn.php");
$Vid = $_GET['id'];
if (!preg_match("/^[0-9]*$/",$Vid)) $Vid = 1; 
//取得voteid
$query = "
SELECT 
  `vote`.`title`,
  sum(`voteitem`.`count`) as count
FROM
  `voteitem`
  INNER JOIN `vote` ON (`voteitem`.`Vid` = `vote`.`id`)
Where
`vote`.`id`=".$Vid."
Group by `vote`.`id`";
$result = mysql_query($query, $id); 
$row    = mysql_fetch_array($result);
$total  = $row['count'];

$js .= '<TABLE width="380" border="0" cellspacing="1" cellpadding="0" align="center">';
$js .= '	<tr height="60"><td colspan="4">調查題目：'.$row['title']."<br><br><center><b>總票數：</b>".$total."</center></td></tr>";
$js .= '	<tr bgcolor="#F4A612" height="40"><td width="90" align="center" class="middle"><b><font color=white>選　項</font></b></td><td align="center" class="middle"><b><font color=white>票數</font></b></td><td align="center" class="middle"><b><font color=white>比例</font></b></td><td align="center" class="middle"><b><font color=white>圖示</font></b></td></tr>';

$query  = "SELECT `desc`,`count`,`img` FROM `voteitem` WHERE `Vid`=".$Vid;
$result = mysql_query($query, $id); 
while ($row = mysql_fetch_array($result))
{
//	$js .= '	<tr height="40" bgcolor="#FFFFFF"><td>'.$row['desc'].'</td><td><table border="0"><tr><td>'.$row['count']."&nbsp;</td><td>".sprintf("%01.2f",($row['count']/$total*100)).'%</td><td><img src="'.$row['img'].'" height="6" width="'.(300*($row['count']/$total)).'"></td></tr></table></td></tr>';
	$js .= '	<tr height="40" bgcolor="#FFFFFF"><td><table width="99%" align="center"><tr><td>'.$row['desc'].'</td></tr></table></td><td align="right">'.$row['count'].'&nbsp;</td><td align="right">'.sprintf("%01.0f",($row['count']/$total*100)).'%&nbsp;</td><td><img src="'.$row['img'].'" height="6" width="'.(300*($row['count']/$total)).'"></td></tr>';
}
$js .= "</table>";
?>
document.write('<? echo $js;?>');
