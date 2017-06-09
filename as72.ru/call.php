<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Заявка на комплект литературы со скидкой</title>
</head>
<body>
<?php
/*Создаём функцию для отправки письма*/
function send_email($name_from, // имя отправителя
                        $email_from, // email отправителя
                        $name_to, // имя получателя
                        $email_to, // email получателя
                        $data_charset, // кодировка переданных данных
                        $send_charset, // кодировка письма
                        $subject, // тема письма
                        $body, // текст письма
                        $html = FALSE, // письмо в виде html или обычного текста
                        $reply_to = FALSE
                        ) {
  $to = mime_header_encode($name_to, $data_charset, $send_charset)
                 . ' <' . $email_to . '>';
  $subject = mime_header_encode($subject, $data_charset, $send_charset);
  $from =  mime_header_encode($name_from, $data_charset, $send_charset)
                     .' <' . $email_from . '>';
  if($data_charset != $send_charset) {
    $body = iconv($data_charset, $send_charset, $body);
  }
  $headers = "From: $from
";
  $type = ($html) ? 'html' : 'plain';
  $headers .= "Content-type: text/$type; charset=$send_charset
";
  $headers .= "Mime-Version: 1.0
";
  if ($reply_to) {
      $headers .= "Reply-To: $reply_to";
  }
  return mail($to, $subject, $body, $headers);
}
function mime_header_encode($str, $data_charset, $send_charset) {
  if($data_charset != $send_charset) {
    $str = iconv($data_charset, $send_charset, $str);
  }
  return '=?' . $send_charset . '?B?' . base64_encode($str) . '?=';
}
/* Осуществляем проверку вводимых данных и их защиту от враждебных 
скриптов */
$name = htmlspecialchars($_POST["name"]);
$phone = htmlspecialchars($_POST["phone"]);
/*На какую почту отправить уведомление?*/
$myemail = "tmn-as72@ya.ru ";
/*Создаём сообщение для отправки*/
$message_to_myemail = "Заявка на комплект литературы 
Заказчик: $name, телефон: $phone";
/*Отправляем письмо с помощью функции*/
send_email('Посетитель сайта as72.ru',
               'sender@site.ru',
               'Получатель письма',
               $myemail,
               'utf-8',  // кодировка, в которой находятся передаваемые строки
               'utf-8', // кодировка, в которой будет отправлено письмо
               'Письмо-уведомление',
               $message_to_myemail);
echo "Ваша заявка принята. \n В ближайшее время, с Вами свяжеться наш специалист. \n Спасибо. \n Чтобы вернуться нажмите <a href='http://as72.ru'>Главная страница</a>"; 
?>
</body>
</html>