<?
/*
�@�̡G���V�V
����G2005.7.24
�����G1
�\��G�semail���U�Τ�B�z�C
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
<title>�w��z�A<? echo $email;?></title>
</head>

<body>
�w��z�A<? echo $email;?>�A�z�w�g�b�����벼�t�ε��U���\�I�t�Τw�g�N�z�Ĥ@���벼�����e�ǤJ�벼���G���C<br>
�w��z�H���~��ѥ[������L���ت��벼�C�H�᪺�벼���رN���A�ݭn�z�����l��Ұʾާ@�C
</body>
</html>
