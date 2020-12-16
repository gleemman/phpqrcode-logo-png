# phpqrcode-logo-png
phpqrcode生成带png的logo图标一些问题

png格式的logo通过php的GD库函数copy到二维码上时背景色会变成黑色；必须要把png格式的logo转成真彩的

$dstImage = imagecreatetruecolor($pw, $ph);

$white = imagecolorallocate($dstImage,  255, 255, 255);#背景色

imagefilledrectangle($dstImage, 0, 0, $pw, $ph, $white);

imagecopyresampled($dstImage, $image_3, 0, 0, 0, 0, $pw, $ph, $pw, $ph);
