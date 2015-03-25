<?php
class Sqlhelper
{
    private $host;
    private $user;
    private $pwd;
    private $conn;
//初始化类属性
   public function __construct($host, $user, $pwd) 
    {
        $this->host = $host;
        $this->user = $user;
        $this->pwd = $pwd;
    }
//连接数据库
    function connect_db()
   {
        $this->conn=mysql_connect($this->host,$this->user,$this->pwd) ;
        if(!$this->conn)
          {
            die("连接数据库失败".mysql_error()) ;	
          }
          
   }

//选择数据库  这里的参数是个变量是打算动态的选择数据库
    function select_db($database)
    {
	mysql_select_db($database,$this->conn);
    mysql_query("set names utf8");
    
    }

//对数据库的增 删 改 
    function operate_db($sql)
    {
	    $data=mysql_query($sql,$this->conn);
		if(!$data)
		{
			die("数据操作失败".mysql_error());
		}
		else
			echo "数据操作成功";
	
    }

//查找数据， 把查找的数据用一个数组的形式返回，就可以在该函数中及时的释放资源$res了
    function select_data($sql)
    {
	    $data=array();

	    $res=mysql_query($sql,$this->conn);
	     while($row=mysql_fetch_assoc($res))
	    {
         
		    $data[]=$row;
	    }
	    mysql_free_result($res);
	    return $data;
    }

    function close_db()
    {
	mysql_close($this->conn);
    }
}
?>