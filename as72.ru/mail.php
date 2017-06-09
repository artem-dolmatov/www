<?php
	
	// заказ расчета стоимости вождения
	if(isset($_POST['message2'])) {
               send_mime_mail('robot', 'robot@as72.ru', 'Admin', 'tmn-as72@yandex.ru', 'Заявка расчета стоимости курсов вождения с сайта as72.ru', $_POST['message2']);
        echo 'send';
		exit;
       
    }
	
    if(isset($_POST['message']))
    
    {
        
        $mail = $_POST['mail'];
        $body ='<b>Заказ звонка:</b><br>';
        foreach ($mail as $fild_name =>$fild)
        {
            if($fild!='') $body .= "$fild_value[$fild_name]: $fild<br>";
        }
        
    
       
        send_mime_mail('robot', 'robot@as72.ru', 'Admin', 'tmn-as72@yandex.ru', 'Заявка с сайта as72.ru', $_POST['message']);
        echo 'send';
		exit;
       
    }
    
    
    
function send_mime_mail($name_from, // имя отправителя
                        $email_from, // email отправителя
                        $name_to, // имя получателя
                        $email_to, // email получателя                       
                        $subject, // тема письма
                        $body, // текст письма
						$type ='html',
                         $data_charset = 'UTF-8', // кодировка переданных данных
                        $send_charset = 'KOI8-R' // кодировка письма
                        ) {
  $to = mime_header_encode($name_to, $data_charset, $send_charset)
                 . ' <' . $email_to . '>';
  $subject = mime_header_encode($subject, $data_charset, $send_charset);
  $from =  mime_header_encode($name_from, $data_charset, $send_charset)
                     .' <' . $email_from . '>';
  if($data_charset != $send_charset) {
    $body = iconv($data_charset, $send_charset, $body);
  }
  $headers = "From: $from\r\n";
  $headers .= "Content-type: text/$type; charset=$send_charset\r\n";

  return mail($to, $subject, $body, $headers);
}

function mime_header_encode($str, $data_charset, $send_charset) {
  if($data_charset != $send_charset) {
    $str = iconv($data_charset, $send_charset, $str);
  }
  return '=?' . $send_charset . '?B?' . base64_encode($str) . '?=';
}

