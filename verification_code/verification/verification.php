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
	//��������ɵ���֤��ŵ�session�У���֤��ʱ����
	$_SESSION['product_code']=$code;
	header("Content-type:image/png");
	//����һ����֤���ͼƬ
	$im=imagecreate($width, $height);
	//Ϊͼ�������ɫ
	$black=imagecolorallocate($im, 0, 0, 0);
	$gray=imagecolorallocate($im, 200, 200, 200);
	$bgcolor=imagecolorallocate($im, 255, 255, 255);
	//�����ɫ
	imagefill($im, 0, 0, $gray);

	//��ͼƬ��һ���߿�
	imagerectangle($im, 0, 0, $width-1, $height-1, $black);

	//��ͼƬ�����ɴ����ĺڵ����������
	for ($i=0; $i <100 ; $i++)
	{ 
		imagesetpixel($im, rand(0,$width), rand(0,$height), $black);
	}
    
    //���������ʾ�ڻ����ϣ��ַ���ˮƽ����λ�ö���һ��������Χ�������
    $strx = rand(3, 8); 
    for ($i = 0; $i < $num; $i++) { 
        $strpos = rand(1, 9); 
        imagestring($im, 6, $strx, $strpos, substr($code, $i, 1), $black); 
        $strx += rand(8, 12); 
    } 
    imagepng($im);//���ͼƬ 
    imagedestroy($im);//�ͷ�ͼƬ��ռ�ڴ�
}
?>
