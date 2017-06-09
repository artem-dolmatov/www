<?PHP 
/***********************************************************************************
Функция img_resize(): генерация thumbnails
Параметры:
  $src             - имя исходного файла
  $dest            - имя генерируемого файла
  $width, $height  - ширина и высота генерируемого изображения, в пикселях
Необязательные параметры:
  $type            - 0 - квадратная картинка, 1 - уменьшается пропорционально
  $rgb             - цвет фона, по умолчанию - белый
  $quality         - качество генерируемого JPEG, по умолчанию - максимальное (100)
***********************************************************************************/
function img_resize($src, $dest, $width, $height, $type=1, $rgb=0xFFFFFF, $quality=100)
{
  if (!file_exists($src)) return false;
 
  $size = getimagesize($src);
 
  if ($size === false) return false;
 
  // Определяем исходный формат по MIME-информации, предоставленной
  // функцией getimagesize, и выбираем соответствующую формату
  // imagecreatefrom-функцию.
  $format = strtolower(substr($size['mime'], strpos($size['mime'], '/')+1));
  $icfunc = "imagecreatefrom" . $format;
  if (!function_exists($icfunc)) return false;
  
  $w_src = $size[0];
  $h_src = $size[1];
  
  if ($type == 1)
  {
    $x_ratio = $width / $size[0];
    $y_ratio = $height / $size[1];
 
    $ratio       = min($x_ratio, $y_ratio);
    $use_x_ratio = ($x_ratio == $ratio);
 
    $new_width   = $use_x_ratio  ? $width  : floor($size[0] * $ratio);
    $new_height  = !$use_x_ratio ? $height : floor($size[1] * $ratio);
    $new_left    = $use_x_ratio  ? 0 : floor(($width - $new_width) / 2);
    $new_top     = !$use_x_ratio ? 0 : floor(($height - $new_height) / 2);
 
    $isrc = $icfunc($src);
    $idest = imagecreatetruecolor($width, $height);
 
    imagefill($idest, 0, 0, $rgb);
    imagecopyresampled($idest, $isrc, $new_left, $new_top, 0, 0, 
        $new_width, $new_height, $size[0], $size[1]);
 
    imagejpeg($idest, $dest, $quality);
 
    imagedestroy($isrc);
    imagedestroy($idest);
  }
  elseif($type==0)
  {
    // создаём пустую квадратную картинку 
    // важно именно truecolor!, иначе будем иметь 8-битный результат 
    $idest = imagecreatetruecolor($width,$width);
    $isrc = $icfunc($src);

     // вырезаем квадратную серединку по x, если фото горизонтальное    
    if ($w_src>$h_src) 
        imagecopyresized($idest, $isrc, 0, 0,
            round((max($w_src,$h_src)-min($w_src,$h_src))/2),
            0, $width, $width, min($w_src,$h_src), min($w_src,$h_src));

    // вырезаем квадратную верхушку по y, 
    // если фото вертикальное (хотя можно тоже серединку) 
    if ($w_src<$h_src) 
        imagecopyresized($idest, $isrc, 0, 0, 0, 0, $width, $width,
        min($w_src,$h_src), min($w_src,$h_src)); 

    // квадратная картинка масштабируется без вырезок 
    if ($w_src==$h_src) 
        imagecopyresized($idest, $isrc, 0, 0, 0, 0, $width, $width, $w_src, $w_src); 

	// вывод картинки и очистка памяти 
	imagejpeg($idest,$dest,$quality); 
	imagedestroy($idest); 
	imagedestroy($isrc); 
  }
  return true;
 
}

function gen_name($lenght=10) 
{
    $chars="qazxswedcvfrtgbnhyujmkiolp1234567890"; 
    $size=StrLen($chars)-1; 
    $password=''; 
    while($lenght--) $password.=$chars[rand(0,$size)]; 
    return $password;
}