<?php
require_once"sqlhelper.class.php";

class usersOperate{
	//登录验证
	function logincheck($username,$password)
	{
		//通过用户名检索出密码
	    $sql="select password from users where username='$username'";
		$sqlhelper=new Sqlhelper("localhost","root","qwe123");
		$sqlhelper->connect_db();

		//这里暂时把选择的数据库写死
        $sqlhelper->select_db("my_db");
		$result=$sqlhelper->select_data($sql);
        //var_dump($result);
		//账号存在，则比对密码
		if($result)
		{
			//这样能防止SQL注入
			if($password==$result[0]['password'])
			    {
			    	return 'succ';
 	            }
		    else
			    return 2; //密码错误在返回2
		}
		else
			return 1; //账户不存在返回1

	}
    
	
}
?>