<?php
	include 'as_core.php';
    addDescription('');
    addKeywords('');
    addCurrent('kurs'); 
	addTitle('Дополнительные курсы');
   
    	    
    $leftrow = true;

    $mobile = strpos($_SERVER['HTTP_USER_AGENT'],"Mobile");
    
    if ($mobile == true) {

	}
    
    include 'templates/header2.php';
    
    

?>
 
   <!DOCTYPE html>
<html lang="ru" http-equiv="content-type" content="text/html;charset=utf-8">
<head>
	<link rel="stylesheet" type="text/css" href="templates/css/bootstrap.min.css">
	<link href="/templates/style.css" rel="stylesheet" type="text/css" />	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
</head>

<body>
	<div class="wrap">
	    <div class="head_driving">
	    	<h1 style="padding:2%">Выберите услугу подходящую именно Вам</h1>
	    </div>
		<div class="row">
			<div class="box33">
			    <img class="logo_box" src="/templates/img/driving_your.jpeg">
				<h2>Дополнительные<br> вождения</h2><br>
				<p style="text-indent: 0">Вы закончили другую автошколу, но не сдали экзамен по вождению? Наши инструктора подготовят вас к экзамену по вождению на автодроме и на экзаменационных маршрутах.<br>
					После прохождения занятий Вы сможете сдать экзамен по вождению в нашей автошколе.
				</p>
                <button class="btn btn-primary" data-toggle="modal" data-target=".modal-dop_driving">Узнать стоимость</button>
			</div>
			<div class="box33">
				<img class="logo_box" src="/templates/img/driving.jpeg">
				<h2>Вождение на вашем<br> автомобиле</h2><br>
				<p style="text-indent: 0">Обучение вождению на вашем авто поможет избавиться от неуверенности и страха самостоятельной езды на собственной машине.
				   Перед началом вождения на вашем автомобиле устанавливается дублирующее устройство на педали тормоза<br><br>
				    Установка занимает не более 2-х минут.
				</p>
                <button class="btn btn-primary" data-toggle="modal" data-target=".modal-dop_driving">Узнать стоимость</button>
			</div>
			<div class="box33">
				<img class="logo_box" src="/templates/img/retake.jpg">
				<h2>Пересдача<br> экзамена</h2><br>
				<p style="text-indent: 0">
                	Пересдать экзамен вы можете каждую неделю.
                	<br><br>
                	Для того чтобы узнать подробности или записаться на пересдачу оставьте заявку<br> или позвоните нам по телефону<br><br> <a href="+7(3452)58-99-60" style="text-decoration: none"><b>8(3452)58-99-60</b></a>
				</p>
                <button class="btn btn-primary" data-toggle="modal" data-target=".modal-driving">Записаться</button>
			</div>
		</div>
	</div>	

	 <!--Модальная форма-->
<div class="modal fade bs-example-modal-sm modal-dop_driving" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content" style="padding: 10px">
      <form method="post" action="" role="form" id="form_dop">
        <legend style="text-align: center">
          <strong style="color: black; font-weight: 500">Расчет стоимости</strong>          
          <p style="font-size:14px; margin-top: 0px; color: grey; text-indent: 0">Для расчета стоимости введите номер телефона</p>

        </legend>                       
            <div class="form-group">
              <label for="inputPhone1" style="color: black; font-weight: 500">Номер Телефона</label>
              <input type="text" class="form-control" style="border: 1px solid #d4dbe0; border-radius: 4px" name="phone" id="phone" placeholder="Введите Номер..." required="">
            </div>
            <button style="margin:auto; display:flex" type="submit" class="btn btn-primary" onclick="AjaxFormRequest('messegeResult', 'form_dop', 'mailer.php')"><span>Рассчитать</span></button>
          </form>
    </div>
  </div>
</div>

<script>
  function AjaxFormRequest(result_id,form_dop,url) {
   jQuery.ajax({
      url:     url,
      type:     "POST",
      dataType: "html",
      data: jQuery("#"+form_dop).serialize(),
      success: function(response) {
         document.getElementById(result_id).innerHTML = response;
      },
      error: function(response) {
         document.getElementById(result_id).innerHTML = "Возникла ошибка при отправке формы. Попробуйте еще раз";
      }
   });
}
</script>

<div class="modal fade bs-example-modal-sm modal-driving" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content" style="padding: 10px">
      <form method="post" action="" role="form" id="formRetake">
        <legend style="text-align: center">
          <strong style="color: black; font-weight: 500">Запись на пересдачу</strong>          
          <p style="font-size:14px; margin-top: 0px; color: grey; text-indent: 0">Для записи на пересдачу введите номер телефона</p>

        </legend>                       
            <div class="form-group">
              <label for="inputPhone1" style="color: black; font-weight: 500">Номер Телефона</label>
              <input type="text" class="form-control" style="border: 1px solid #d4dbe0; border-radius: 4px" name="phone" id="phone1" placeholder="Введите Номер..." required="">
            </div>
            <button style="margin:auto; display:flex" type="submit" class="btn btn-primary" onclick="AjaxFormRequest('messegeResult', 'formRetake', 'mailer.php')"><span>Записаться</span></button>
          </form>
    </div>
  </div>
</div>

<script>
  function AjaxFormRequest(result_id,formRetake,url) {
   jQuery.ajax({
      url:     url,
      type:     "POST",
      dataType: "html",
      data: jQuery("#"+formRetake).serialize(),
      success: function(response) {
         document.getElementById(result_id).innerHTML = response;
      },
      error: function(response) {
         document.getElementById(result_id).innerHTML = "Возникла ошибка при отправке формы. Попробуйте еще раз";
      }
   });
}
</script>
<body>

<style>
	.box33 {
	    display: inline-block;
	    width: 32%;
	    text-align: center;
	    border: 1px solid #d3e0e9;           
	}

	.row {
		padding: 2%;
		text-align: center;
	}
	.logo_box {
		width: 70%;
		border-radius: 50%;
		padding-top: 3%;
	}
	.head_driving {
		margin-left: 1%;
		margin-right: 1%;
        border-bottom: 1px solid #7c96b3;
        text-align: center;
	}
	.btn {
		margin-bottom: 3%;
	}
	
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="templates/js/bootstrap.js"></script>
<script src="templates/js/jquery.maskedinput.js"></script>
  <script>
      // execute/clear BS loaders for docs
      $(function(){
        if (window.BS&&window.BS.loader&&window.BS.loader.length) {
          while(BS.loader.length){(BS.loader.pop())()}
      }
    })
     
     $(function() {
        $.mask.definitions['~'] = "[+-]";        
        $("#phone").mask("+7 (999) 999-9999");
        $("#phone1").mask("+7 (999) 999-9999");

        $("input").blur(function() {
            $("#info").html("Unmasked value: " + $(this).mask());
        }).dblclick(function() {
            $(this).unmask();
        });
    });
  </script>
<? 	
    include 'templates/footer1.php';	
    include 'templates/metric.php';
?>
  
 </body>
