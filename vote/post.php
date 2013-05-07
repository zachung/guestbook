<?
while (list($var, $val) = each($_POST)) 
{ 
echo "$var=$val<br>"; 
}

while (list($var,$val) = each($_POST['item'])) 
{ 
echo "$var=-$val<br>"; 
}

reset($_POST['item']);
while (list($key,$val) = each($_POST['item']))
{
echo "$key=>$val<br>";
}
?>