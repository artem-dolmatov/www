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
$to = "TMN <tmn-as72@yandex.ru>, ";
$to .= "Telegram <227436094@etlgr.com>";
$from = 'AS@72.ru';
$subject = "Заявка на вождение/пересдачу";
$message = 'Телефон: '.$_POST['phone'].'; <br /> 
Адрес страницы: '.$_SERVER['HTTP_REFERER'].';';
$headers = "Content-type: text/html; charset=UTF-8 \r\n";
$headers .= "From: <AS@72.ru>\r\n";
$result = mail($to, $subject, $message, $headers);

    if ($result){ 
        echo "Ваше заявка будет рассмотрена в ближайшее время<br/>
после чего с Вами свяжется наш специалист";
 
sleep(5);
header("Location: /medical.shtml");
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
