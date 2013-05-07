<?php
include("messageboard.php");
?>
<html>
    <head>
    <title>GuestBook</title>
    <meta http-equiv="content-type" content="text/html;charset=UTF8"/>
    </head>
<body>
    <?php
    $obj = new MessageBoard;
    echo "<h2>GuestBook</h2>";
    echo "網站最後修改時間：".date("Y-m-d H:i:s", getlastmod())."<br/>";
    if(!empty($_POST['del_index']))
    if(isset($_POST['del_index']) && preg_match("/^[0-9]*$/",$_POST['del_index']))
    {
	$obj->delMessage($_POST['del_index']);
	echo "<font color='red'><h2>已刪除留言".$_POST['del_index']."</h2></font>";
    }
    else
	echo "<font color='red'><h2>輸入錯誤或找不到資料</h2></font>";
    $obj->howMany();
    ?>
    <br/><a href="add.php">我要留言</a><br/>
    <form name="form1" cation="" method="post">
    請選擇要刪除的留言編號：
    <input name="del_index" type="text" width="3"/>
    <input type="submit" value="送出"/>
    </form>
    <div>
    <?php
    $obj->showMessage();
    ?>
    </div>
</body>
</html>
