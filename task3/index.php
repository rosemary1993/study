<?php
session_start();
//控制session是否过期
if(isset($_SESSION['username']))
{
    //20分钟内一直没刷新
    if (!isset($_SESSION['login_time'])||(time()-$_SESSION['login_time'])>1200)
      {
        unset($_SESSION['username']);
        $_SESSION['login_time']='';
      }
    //20分钟有过刷新
    else
        $_SESSION['login_time']=time();

}
?>

<html>
<head>
	<title>主界面</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
</head>
<body>
<div id="loginlink">
<a href="logincontrol.php?a=relogin" id="hd">亲，请登录</a>
<a href="logincontrol.php?a=loginout" class="out" id="out"></a>
</div>
<table border="1" >
<tr>
<td><a href="stuInformation.php">学生信息</a></td>
<td><a href="lession.php">课程安排</a></td>
<td><a href="grace.php">成绩查询</a></td>
<td><a href="kaoshi.php">考试安排</a></td>
</tr>
</table>
<script type="text/javascript">

  //获得登录成功的用户名
    function getParam() {

      <?php
      if (isset($_SESSION['username']))      //判断用户是否登录，防止用户跳过登录通过URL直接访问
      {
          echo 'return "' . $_SESSION['username'] . '";';
      }
      else
      {
          echo 'return "";';
      }
      ?>
      
    }     
    var username=getParam();
    //如果登录了则可以访问一些私人信息，类似于淘宝登陆后的效果
    if(username)
    {
    	document.getElementById("out").innerHTML="退出";
    	document.getElementById("hd").innerHTML='欢迎'+username;
    }
    
	</script>
</body>
</html>
