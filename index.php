<!DOCTYPE html>
<?php
  //mysql_query("SET NAMES 'UTF8'");
  include("guestBook/messageboard.php");
  include("check.php");
  include("divfunc.php");
?>
<html>
<head>
<!--script src="test.js"></script-->
<script src="jquery-1.9.1.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" type="text/css" href="mystyle.css">
<?php header("Content-Type:text/html; charset=utf-8"); ?>
	<title>GuestBook</title>
	</head>
	<body>
<div class="container-fluid">
  <div class="span12">
    <!--Top Menu-->
    <?php
      DivTopmenu();
    ?>
  </div>
  <div class="span12">
	<!--//已登入
	  //$userGUID = $_SESSION['ssnUSERGUID'];
	  //$userNAME = $_SESSION['ssnUSERNAME'];
	  //$userLEVEL = $_SESSION['ssnUSERLEVEL'];
    -->
    <!--顯示留言數-->
    <?php howMany();?>
        <!--顯示留言-->
        <?php showMessage();?>
    <div class="navbar navbar-inner" style="text-align:center">
      <?php	Divfooter();?>
    </div>
  </div>
</div>


<?php

//設定使用者看到的menulist
  if(isset($_SESSION['ssnUSERLEVEL']))
  {
    ?>
	  <script>$("li#login").hide();</script>
    <?php
    if($_SESSION['ssnUSERLEVEL'] > 0)
    { ?>
	<script>
	  $("li#signup").hide();
	</script>
    <?php }
    if($_SESSION['ssnUSERLEVEL'] < 1)
    { ?>
	<script>
	  $("li#upload").hide();
	  $("li#setting").hide();
	</script>
    <?php }
    if($_SESSION['ssnUSERLEVEL'] < 5)
    { ?>
	<script>
	  $("li#delmsg").hide();
	</script>
    <?php }
  }
  else
  {
    ?>
	  <script>$("li#logout").hide();</script>
    <?php
  }

?>
	</body>
</html>
