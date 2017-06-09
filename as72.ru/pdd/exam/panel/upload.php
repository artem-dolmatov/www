<?php
 
Class Gallery {
 
    // Путь для хранения  
    var $imgDir = '../img/';
 
    var $thumbDir = '../imgbig/';
 
    // Размер маленьких изображений
    var $imgWidth = 600;
    var $imgHeight = 300;
 
    //Размер большого изображения
    var $imgWidthB = 1000;
    var $imgHeightB = 1000;
 
    var $imgName = '';
    
    // Разрешенные форматы изображений
    var $exts = array(2 => 'jpg');
                      /*1 => 'gif',
                      3 => 'png');*/
 
    //var $extList = array('image/gif', 'image/jpeg', 'image/png');
    var $extList = array('image/jpeg');
 
    function __construct() {
        //$this->imgDir .= date('n') . '/';
        //$this->thumbDir .= date('n') . '/';

        if(!is_dir($this->imgDir) or !is_dir($this->thumbDir)) {
            echo 'Директория не найдена.<br/>'.$this->imgDir . ' and ' . $this->thumbDir;
        }
    }
 
    // Проверка изображения
    private function checkImg($img) {
        
        if(!is_file($img['tmp_name'])) die('Переданные данные не корректны');
 
        $data = getimagesize($img['tmp_name']);
        $filesize = filesize($img['tmp_name']);
        $format = explode('.',$img['name']);

        if(!in_array(strtolower($format[count($format)-1]), $this->exts)) die('Не верный формат');
        if($filesize ==  0) die('Ошибка записи изображения на сервер');
 
        if($data[0] > $this->imgWidthB || $data[1] > $this->imgHeightB) 
            die('Максимальный размер изображения ' . $this->imgWidthB . 'x' . $this->imgHeightB);
        
        if(!isset($this->exts[$data[2]])) die('Размер изображения не соответствует прописным в параметрах ' . $data[2]);
        if(!in_array($img['type'], $this->extList) || !in_array($data['mime'], $this->extList)) die('Файл не является изображением');
  
        $result = array('width' => $data[ 0],
                        'height' => $data[1],
                        'extension' => $this->exts[$data[2]],
                        'size' => $filesize);
       
        return $result;
    }
 
    public function loadImg($img) {
        
        $data = $this->checkImg($img);
 
        if(!is_array($data)) die('Файл не является изображением');
 
        $this->imgName = $this->imgNewName($data['extension']);
        if(!move_uploaded_file($img['tmp_name'], $this->imgDir.$this->imgName)) die('Формат изображения не соответствует прописным в параметрах');
 
        $this->creatThumb($data['extension'], $this->imgName);
  
        return $this->imgName;
    }
 
    private function creatThumb($type, $name) {
 
        switch($type) {
            /*case 'gif':
            $src_img = imagecreatefromgif($this->imgDir.$name);
            break;*/
 
            case 'jpg':
            $src_img = imagecreatefromjpeg($this->imgDir.$name);
            break;
 
            /*case 'png':
            $src_img = imagecreatefrompng($this->imgDir.$name);
            break;*/
        }
 
        $old_w = imagesx($src_img);
        $old_h = imagesy($src_img);
 
        $ratio1 = $old_w/$this->imgWidth;
        $ratio2 = $old_h/$this->imgHeight;
 
        if($ratio1>$ratio2) {
            $thumb_w=$this->imgWidth;
            $thumb_h=$old_h/$ratio1;
        }
        else {
            $thumb_h=$this->imgHeight;
            $thumb_w=$old_w/$ratio2;
        }
 
        $im = imagecreatetruecolor($thumb_w, $thumb_h);
        imagecopyresampled($im,$src_img, 0, 0, 0, 0,$thumb_w,$thumb_h,$old_w,$old_h)
;

        switch($type) {
            /*case 'gif':
            imagegif($im, $this->thumbDir.$name);
            break;*/
 
            case 'jpg':
            imagejpeg($im, $this->thumbDir.$name);
            break;
 
            /*case 'png':
            imagepng($im, $this->thumbDir.$name);
            break;*/
        }
    }
 
    // Метод для генерации названий
    private function imgNewName($type, $length=2) {
        $chars = "abcdefghijklmnopqrstuvwxyz";
        $imgName = "";
        $clen = strlen($chars) - 1;
        
        while (strlen($imgName) < $length) { 
            $imgName .= $chars[mt_rand(0,$clen)];   
        } 
    
        $imgName = $imgName . '_' . mt_rand(1000,9999) . '.' . $type;
        
        if(file_exists($this->imgDir.$imgName)) {
            $imgName = $this->imgNewName($type);
        }
        
        return $imgName;
    }
 
}
 
$img1 = new Gallery();

if(isset($_FILES['uploadfile'])) {
 
    if($img1->loadImg($_FILES['uploadfile'])) {
        echo $img1->imgName;
    }
    else echo 'ошибка загрузки';
} else echo 'файл не выбран';