<?php
//phpinfo();
require_once("./phpqrcode.php");
$data = 'https://www.yichuwuyou.com/h5/club/?ucode=D68AAEB7C751EAD77CDB37FE8B3CA7C8&id=1&do=join';//内容
$level = 'L';// 纠错级别：L、M、Q、H
$size = 4;//元素尺寸
$margin = 1;//边距
$outfile = 'test.png';
$saveandprint = false;// true直接输出屏幕  false 保存到文件中
$back_color = 0xFFFFFF;//白色底色
$fore_color = 0x000000;//黑色二维码色 若传参数要hexdec处理，如 $fore_color = str_replace('#','0x',$fore_color); $fore_color = hexdec('0xCCCCCC');

$QRcode = new \QRcode();

//生成png图片
$QRcode->png($data, $outfile, $level, $size, $margin, $saveandprint, $back_color, $fore_color);

//图片一
$path_1= 'back.png';
//图片二
$path_2= 'test.png';//创建图片对象
//图片三
$path_3= 'logo.png';//创建图片对象

//imagecreatefrompng($filename)--由文件或 URL 创建一个新图象
$image_1= imagecreatefrompng($path_1);
$image_2= imagecreatefrompng($path_2);
$image_3 = imagecreatefrompng($path_3);
$pw = imagesx($image_3);
$ph = imagesy($image_3);
$dstImage = imagecreatetruecolor($pw, $ph);
$white = imagecolorallocate($dstImage,  255, 255, 255);#背景色
imagefilledrectangle($dstImage, 0, 0, $pw, $ph, $white);
imagecopyresampled($dstImage, $image_3, 0, 0, 0, 0, $pw, $ph, $pw, $ph);
//合成图片
imagecopymerge($image_2,$dstImage, (imagesx($image_2)-$pw)/2, (imagesy($image_2)-$ph)/2, 0, 0, $pw, $ph, 100);
//imagecopymerge ( resource $dst_im , resource $src_im , int $dst_x , int $dst_y , int $src_x , int $src_y , int $src_w , int $src_h , int $pct )---拷贝并合并图像的一部分
imagecopymerge($image_1,$image_2, 25, imagesy($image_1)-imagesy($image_2)-25, 0, 0, imagesx($image_2), imagesy($image_2), 100);
//将 src_im 图像中坐标从 src_x，src_y 开始，宽度为 src_w，高度为 src_h 的一部分拷贝到 dst_im 图像中坐标为 dst_x 和 dst_y 的位置上。两图像将根据 pct 来决定合并程度，其值范围从 0 到 100。当 pct = 0 时，实际上什么也没做，当为 100 时对于调色板图像本函数和 imagecopy() 完全一样，它对真彩色图像实现了 alpha 透明。imagecopymerge($image_1,$image_2, 0, 0, 0, 0, imagesx($image_2), imagesy($image_2), 100);// 输出合成图片

$merge= 'merge.png';
var_dump(imagepng($image_1,'./merge.png'));
