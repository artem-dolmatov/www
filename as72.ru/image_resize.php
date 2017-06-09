<?PHP 
/***********************************************************************************
������� img_resize(): ��������� thumbnails
���������:
  $src             - ��� ��������� �����
  $dest            - ��� ������������� �����
  $width, $height  - ������ � ������ ������������� �����������, � ��������
�������������� ���������:
  $type            - 0 - ���������� ��������, 1 - ����������� ���������������
  $rgb             - ���� ����, �� ��������� - �����
  $quality         - �������� ������������� JPEG, �� ��������� - ������������ (100)
***********************************************************************************/
function img_resize($src, $dest, $width, $height, $type=1, $rgb=0xFFFFFF, $quality=100)
{
  if (!file_exists($src)) return false;
 
  $size = getimagesize($src);
 
  if ($size === false) return false;
 
  // ���������� �������� ������ �� MIME-����������, ���������������
  // �������� getimagesize, � �������� ��������������� �������
  // imagecreatefrom-�������.
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
    // ������ ������ ���������� �������� 
    // ����� ������ truecolor!, ����� ����� ����� 8-������ ��������� 
    $idest = imagecreatetruecolor($width,$width);
    $isrc = $icfunc($src);

     // �������� ���������� ��������� �� x, ���� ���� ��������������    
    if ($w_src>$h_src) 
        imagecopyresized($idest, $isrc, 0, 0,
            round((max($w_src,$h_src)-min($w_src,$h_src))/2),
            0, $width, $width, min($w_src,$h_src), min($w_src,$h_src));

    // �������� ���������� �������� �� y, 
    // ���� ���� ������������ (���� ����� ���� ���������) 
    if ($w_src<$h_src) 
        imagecopyresized($idest, $isrc, 0, 0, 0, 0, $width, $width,
        min($w_src,$h_src), min($w_src,$h_src)); 

    // ���������� �������� �������������� ��� ������� 
    if ($w_src==$h_src) 
        imagecopyresized($idest, $isrc, 0, 0, 0, 0, $width, $width, $w_src, $w_src); 

	// ����� �������� � ������� ������ 
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