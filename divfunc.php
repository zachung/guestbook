<!--link rel="stylesheet" type="text/css" href="mystyle.css" /-->
<script src="jquery-1.9.1.js"></script>
<?php
function DivLogin()
{
  ?>
    <form class="form-horizontal" name="login" method="POST">
      <div class="control-group">
	<label class="control-label" for="inputEmail">帳號：</label>
	<div class="controls">
	  <input type="text" id="inputEmail" placeholder="Email" name="loginname">
	</div>
      </div>
      <div class="control-group">
	<label class="control-label" for="inputPswd">密碼：</label>
	<div class="controls">
	  <input type="password" id="inputPswd" placeholder="Password" name="loginpswd">
	</div>
      </div>
      <div class="control-group">
	<div class="controls">
	  <button type="submit" class="btn">Log In</button>
	</div>
      </div>
    </form>
  <?php
    if(isset($_POST['loginname']) && !empty($_POST['loginname']))
    {
	$rs = checklogin($_POST['loginname'], $_POST['loginpswd']);
	$nT = mysql_num_rows($rs);
	if($nT)
	{
	  setsession($_POST['loginname'], $rs);
	  header("location:index.php");
	}
	else CommandTip("登入失敗");
    }
}
function DivTopmenu()
{
  ?>
    <div class="navbar">
      <!--Header-->
      <a href="index.php" id="tip"><h1>GuestBook</h1></a>
      <div class="navbar-inner">
        <div class="container">
          <ul class="nav nav-pills">
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">Active<span class="caret"></span></a>
	          <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel1">
  <?php
  if(islogin()){
  ?>
	            <li id="addmsg"><a data-toggle="modal" role="button" href="#modal-addmsg" title="留言">AddMsg</a></li>
                <li id="delmsg"><a data-toggle="modal" role="button" href="#modal-delmsg" title="刪除">DelMsg</a></li>
                <li class="divider"></li>
	            <li class="dropdown-submenu">
                  <a tabindex="-1" href="#">Setting</a>
                  <ul class="dropdown-menu">
	                <li class="disabled"><a data-toggle="modal" role="button" href="#modal-setting" title="設定">Setting</a></li>
	                <li id="upload"><a data-toggle="modal" role="button" href="#modal-upload" title="上傳">Upload icon</a></li>
                  </ul>
                </li>
  <?php } ?>
              </ul>
	        </li>
          </ul>
	      <ul class="nav nav-pills pull-right">
	        <li id="signup"><a data-toggle="modal" role="button" href="#modal-signup" title="註冊">Sign Up</a></li>
	        <li id="login"><a data-toggle="modal" role="button" href="#modal-login" title="登入">Log In</a></li>
	        <li id="logout"><a href="logout.php" title="登出">Log Out</a></li>
	      </ul>
        </div>
      </div>
    </div>
    <!--Modal login-->
    <div id="modal-login" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
	    <h3 id="myModalLabel">Log In</h3>
      </div>
      <div class="modal-body">
	    <?php DivLogin(); ?>
      </div>
    </div>
    <!--Modal signup-->
    <div id="modal-signup" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    	<h3 id="myModalLabel">Sign Up</h3>
      </div>
      <div class="modal-body">
	    <?php DivRegister(); ?>
      </div>
    </div>
    <!--Modal addmsg-->
    <div id="modal-addmsg" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
	    <h3 id="myModalLabel">Add Message</h3>
      </div>
      <div class="modal-body">
	    <?php DivAddMsg($_SESSION['ssnUSERGUID'], $_SESSION['ssnUSERNAME']); ?>
      </div>
    </div>
    <!--Modal delmsg-->
    <div id="modal-delmsg" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
	    <h3 id="myModalLabel">Delete Message</h3>
      </div>
      <div class="modal-body">
	    <?php DivDelMsg(); ?>
      </div>
    </div>
    <!--Modal upload-->
    <div id="modal-upload" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
	    <h3 id="myModalLabel">Delete Message</h3>
      </div>
      <div class="modal-body">
	    <?php DivUpload(); ?>
      </div>
    </div>
  <?php
}
function DivRegister()
{
  ?>
    <form class="form-horizontal" name="register" method="POST">
      <div class="control-group">
	<label class="control-label" for="inputEmail">帳號：</label>
	<div class="controls">
	  <input type="text" id="inputEmail" placeholder="Email" name="registername">
	</div>
      </div>
      <div class="control-group">
	<label class="control-label" for="inputPswd">密碼：</label>
	<div class="controls">
	  <input type="text" id="inputPswd" placeholder="Password" name="registerpswd">
	</div>
      </div>
      <div class="control-group">
	<label class="control-label" for="inputPswd2">再次輸入密碼：</label>
	<div class="controls">
	  <input type="text" id="inputPswd2" placeholder="">
	</div>
      </div>
      <div class="control-group">
	<div class="controls">
	  <button type="submit" class="btn">Sign Up</button>
	</div>
      </div>
    </form>
  <?php
    if(isset($_POST['registername']) && !empty($_POST['registername']))
    {
	if(checkregister($_POST['registername']))
	  CommandTip("已註冊的帳號!");
	else
	{
	  if($_POST['registerpswd'] != $_POST['repswd'])
	    CommandTip("兩次輸入密碼不符!");
	  else
	  {
	    adduser($_POST['registername'], $_POST['registerpswd'], '1');
	    header("location:index.php");
	    CommandTip("註冊成功");
	  }
	}
    }
}
function DivAddMsg($userGUID, $userNAME)
{
  ?>
    <form class="row-fluid" name="addmsg" method="POST">
      <div class="span3">
        <img class="img-polaroid" src="users_icon/<?php echo $userNAME.".jpg"; ?>" alt="" style="height:100px">
      </div>
      <div class="span9">
	    <label><?php echo $userGUID."(".$userNAME.")"; ?></label>
	    <textarea class="input-block-level" rows="5" placeholder="輸入留言內容.." name="content"></textarea>
      </div>
	  <button class="btn pull-right" type="submit">送出</button>
    </form>
  <?php
    //留言送出提示
    if(isset($_POST['content']) && !empty($_POST['content']))
    {
	addMessage($userGUID, $_POST['content'], date("Y-m-d H:i:s"), $userNAME);
	CommandTip("留言已送出");
    }
}
function DivDelMsg()
{
  ?>
    <form class="form-horizontal" name="delmsg" method="POST">
      <div class="control-group">
	    <label class="control-label" for="inputdel_index">刪除留言編號：</label>
	    <div class="controls">
	      <div class="input-append">
	        <input type="text" id="inputdel_index" placeholder="del number" name="del_index">
	        <button type="submit" class="btn">刪除</button>
          </div>
        </div>
        <div class="controls">
        </div>
      </div>
    </form>
  <?php
    if(isset($_POST['del_index']) && !empty($_POST['del_index']))
    {
	if(preg_match("/^[0-9]*$/", $_POST['del_index']))
	{
	  delMessage($_POST['del_index']);
	  CommandTip("已刪除留言".$_POST['del_index']);
	}
	else
	  CommandTip("輸入錯誤!");
    }
}
function DivUpload()
{
  ?>
    <form class="form-horizontal" name="upload" method="POST" enctype="multipart/form-data">
      <div class="control-group">
	    <label class="control-label" for="file">上傳頭像(20Kb)：</label>
	    <div class="controls">
	      <input type="file" id="file" placeholder="del number" name="file">
	      <button type="submit" class="btn">上傳</button>
        </div>
      </div>
    </form>
  <?php
    if(isset($_FILES['file']) && !empty($_FILES['file']))
    {
	Upicon($_FILES['file']);
    }
}
function Divfooter()
{
    echo "網站最後修改時間：".date("Y-m-d H:i:s", getlastmod());
}
function Upicon($file)
{
  if((($file['type'] == "image/gif")
    || ($file['type'] == "image/jpeg")
    || ($file['type'] == "image/pjpeg"))
    && ($file['size'] < 20480))
  {
    if($file['error'] > 0)
	CommandTip("上傳失敗!");
    else
    {
	echo "Upload: ".$file['name']."<br />";
	echo "Type: ".$file['type']."<br />";
	echo "Size: ".($file['size']/1024)." Kb<br />";
	echo "Stored in: ".$file['tmp_name']."<br />";

	//$rs = explode('.', $file['name']);
	//$exten = $rs[count($rs)-1];
	$exten = "jpg";
	$stpath = "users_icon/".$_SESSION['ssnUSERNAME'].".".$exten;

	if(file_exists($stpath))
	{
	  CommandTip("檔案已存在!");
	}
	else
	{
	  move_uploaded_file($file['tmp_name'], $stpath);
	  CommandTip("檔案已成功上傳");
	}
    }
  }
  else
    CommandTip("檔案不符規定!");
}
function CommandTip($tip)
{
  ?>
    <span id="commandtip" class="badge">
	<?php echo $tip; ?>
    </span>
<script>
  $("span#commandtip").addClass("badge-warning");
</script>
  <?php
}
?>
