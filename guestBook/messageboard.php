<?php
include("mylink.php");
//class MessageBoard{
    //新增留言的方法
    function addMessage($name,$msg,$date,$email)
    {
        $sql="INSERT INTO mess (NAME, CONTENT, TIME, EMAIL)";

	//<--1-->
	//$msg="This's one line\r\nand This is another\r\nand this line has \ta tab";
	//$msg=str_replace('\'', '\\\'', $msg);
        //$sql .="VALUES('$name','".nl2br($msg)."','$date','$email')";

	//<--2-->
        $sql .="VALUES('$name','".addslashes(nl2br($msg))."','$date','$email')";

	//<--3-->
	
        $result = mysql_query($sql)or die(mysql_error());
        //nl2br換行
    }
    //顯示留言的方法
    function showMessage()
    {
    ?>
    <div class="row-fluid">
	  <div class="span12 content">
      <div class="pagination pagination-mini pagination-right">
        <ul>
          <li class=""><a href="#">&laquo;</a></li>
          <li class="active"><a href="#">1</a></li>
          <li class=""><a href="#">2</a></li>
          <li class=""><a href="#">&raquo;</a></li>
        </ul>
      </div>
    <?php
	    mysql_query("SET NAMES 'utf8'");
        $show_sql = "SELECT * FROM mess ORDER BY ITEM DESC";
        $show_result = mysql_query($show_sql)or die(mysql_error());
        while($record = mysql_fetch_array($show_result))
        {
	    ?>
	      <div class="row-fluid">
	        <div class="span2 well well-small">
	          <?php
		        echo "No.".$record['ITEM']."<br />";
	          ?>
		      <img src="users_icon/<?php echo $record['EMAIL'].".jpg"; ?>" alt="" style="height:50px"><br />
	          <?php
	            echo $record['NAME']."<br />(".$record['EMAIL'].")"."<br />";
	          ?>
	        </div>
	        <div class="span10">
	        <?php
              echo "<div class=\"well\"><p>".$record['CONTENT']."</p></div>";
              echo '<div style="float:right"><p>留言時間：'.$record['TIME']."</p></div>";
	        ?>
	        </div>
	      </div>
	    <?php } ?>
      </div>
    </div>
    <?php
    }
    //傳回目前留言筆數的方法
    function howMany()
    {
        $result = mysql_query("SELECT COUNT(ITEM) FROM mess;")or die (mysql_error());
        $total = mysql_fetch_row($result);
        echo  "共有".$total[0]."筆留言";
    }
    //刪除某筆資料
    function delMessage($del_index)
    {
	$sql = "DELETE FROM mess WHERE ITEM = $del_index";
        mysql_query($sql)or die(mysql_error());
    }
//}
?>
