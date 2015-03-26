<?php
session_start();
getCode(4,80,25);
function getCode($num,$width,$height)
{
	$str="23456789abcdefghijklmnopqrstuvwxyz";
	$code="";
	for ($i=0; $i <$num ; $i++)
	{ 
		$code.=$str[rand(0,strlen($str)-1)];
	}
	//把随机生成的验证码放到session中，验证的时候用
	$_SESSION['product_code']=$code;
	header("Content-type:image/png");
	//创建一个验证码的图片
	$im=imagecreate($width, $height);
	//为图像分配颜色
	$black=imagecolorallocate($im, 0, 0, 0);
	$gray=imagecolorallocate($im, 200, 200, 200);
	$bgcolor=imagecolorallocate($im, 255, 255, 255);
	//填充颜色
	imagefill($im, 0, 0, $gray);

	//给图片画一个边框
	imagerectangle($im, 0, 0, $width-1, $height-1, $black);

	//在图片上生成大量的黑点起干扰作用
	for ($i=0; $i <100 ; $i++)
	{ 
		imagesetpixel($im, rand(0,$width), rand(0,$height), $black);
	}
    
    //将随机数显示在画布上，字符的水平间距和位置都按一定波动范围随机生成
    $strx = rand(3, 8); 
    for ($i = 0; $i < $num; $i++) { 
        $strpos = rand(1, 9); 
        imagestring($im, 6, $strx, $strpos, substr($code, $i, 1), $black); 
        $strx += rand(8, 12); 
    } 
    imagepng($im);//输出图片 
    imagedestroy($im);//释放图片所占内存
}
?>
