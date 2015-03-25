<?php
require_once"sqlhelper.class.php";
header("charset=UTF-8");
$sql="insert into users (username,password) values ('王其','jkl')";
$sql1="select * from users";
		$sqlhelper=new Sqlhelper("localhost","root","qwe123");
		$sqlhelper->connect_db();

		//这里暂时把选择的数据库写死
        $sqlhelper->select_db("rosemary");
	   // $sqlhelper->operate_db($sql);
	    var_dump($sqlhelper->select_data($sql1));
		$sqlhelper->close_db();
?>