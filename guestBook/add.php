<?php
include("mylink.php");
include("messageboard.php");
if(isset($_POST['name'])&&!empty($_POST['name']))
//檢查name欄位有沒有被輸入
{
    $obj = new MessageBoard;
    //呼叫addMessage方法 新增留言
    $obj->addMessage($_POST['name'],$_POST['content'],$_POST['time']);
    echo "<font color='red'><h2>留言已送出</h2></font>，<a href='myboard.php'>回留言列表嗎?</a><br/>";
}
else
{
    echo "<font color='red'>您好，請至少輸入姓名</font><br/>";
}
?>
新增留言
<form name="form1" action="" method="POST">
留言人 :<input type="text" name="name"><br/>
內容 :<textarea name="content" cols="45" rows="5"></textarea> <br/>
<input type="hidden" name="time" value="<?php echo date('Y-m-d H:i:s');?>"/>
<input type="submit" value="送出"/>
</form>
