<?php
require_once("loginmodel.php");
session_start();
//获取url中的方法
$action=$_GET['a'];
//用户之前没选择自动登录时登录
if($action=="login")
{
	login();
	exit;
}
//用户点击退出
else if($action=="loginout")
{
loginout();
exit;
}

//用户在登录状态
if (!empty($_SESSION['username']))     
{
    exit;
}
else
{
	//没有登录且之前没有选择自动登录
	if(empty($_COOKIE['username'])||empty($_COOKIE['password']))
		header('location:login.html');
	else
		{
		    $_SESSION['username'] = $_COOKIE['username']; 
	      $_SESSION['login_time'] = time();
        header('location:index.php');
    }
}
//登录函数
function login()
{
	  $username=$_POST['username'];
    $password=md5($_POST['password']);
      
    //判断用户是否输入了账号或密码   
    if(empty($username)||empty($password))
    {
 	      return 0;
    }
    else
    {   
        //查库验证
        $useroprate=new usersOperate();
        $res =$useroprate->logincheck($username,$password);
      //验证成功写入session
        if ($res=="succ") 
        {
	        $_SESSION['username'] = $username;
          $_SESSION['login_time'] = time();              
        }

    //如果用户选择了自动登录
    if(isset($_POST['remember'])&&$_POST['remember']=='yes')
       {
	        setcookie("username", $username, time()+3600*24*365);  
          setcookie("password", $password, time()+3600*24*365); 
       }
    }
    echo $res;
}
//退出登录
    function  loginout()
    {
       
       unset($_SESSION['username']);  
      if(!empty($_COOKIE['username']) || !empty($_COOKIE['password']))
        {  
            setcookie("username", null, time()-3600*24*365);  
            setcookie("password", null, time()-3600*24*365);  
        }
       header('location:login.html');
     }
?>