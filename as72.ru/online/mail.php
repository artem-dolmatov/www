<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Document</title>
</head>
<body>


<?php
if(!empty($_POST['phone'] ))
{
$to = "tmn-as72@yandex.ru";
$from = 'Онлайн"Автошкола.ru';
$subject = "Проверка почты";
$message = 'Имя: '.$_POST['name'].'; <br /> Телефон: '.$_POST['phone'].'; <br /> E-mail: '.$_POST['mail'].';';
$headers = "Content-type: text/html; charset=UTF-8 \r\n";
$headers .= "From: <Онлайн@Автошкола.ru>\r\n";
$result = mail($to, $subject, $message, $headers);

    if ($result){ 
        echo "<p>Cообщение успешно отправленно. Пожалуйста, оставайтесь на связи</p>";
    }
    else{
        echo "<p>Cообщение не отправленно. Пожалуйста, попрбуйте еще раз</p>";
    }
}
else {
echo "<p>Обязательные поля не заполнены. Введите номер телефона</p>";
}
?>

</body>
</html>