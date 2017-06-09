<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Document</title>
</head>
<body>


<?php
if(!empty($_POST['telephone'] ))
{
$to = "tmn-as72@yandex.ru";
$from = 'tmn-as72@yandex.ru';
$subject = "Заявка из формы";
$message = 'Имя: '.$_POST['page_url'].'; Телефон: '.$_POST['telephone'].';';
$headers = "Content-type: text/plain; charset=UTF-8 \r\n";
$headers .= "From: <tmn-as72@yandex.ru>\r\n";
$result = mail($to, $subject, $message, $headers);

    if ($result){ 
        echo "<p>Заявка успешно отправлена. Менеджер свяжеться с вами в ближайшее время</p>";
    }
    else{
        echo "<p>Cообщение не отправленно. Пожалуйста, попробуйте еще раз</p>";
    }
}
else {
echo "<p>Обязательные поля не заполнены. Введите номер телефона</p>";
}
?>

</body>
</html>