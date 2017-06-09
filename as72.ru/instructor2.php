<?php
	include 'as_core.php';
    addDescription('');
    addKeywords('');
    addCurrent('instructor');
    addTitle('Инструкторы по вождению');	
    	    
    $leftrow = true;

    $mobile = strpos($_SERVER['HTTP_USER_AGENT'],"Mobile");
    
    if ($mobile == true) {

	}
    
    include 'templates/header2.php';
    
    

 ?>
 <!DOCTYPE html>
<html lang="ru" http-equiv="content-type" content="text/html;charset=utf-8">
<head>
<link href="/templates/style.css" rel="stylesheet" type="text/css" />

<style>
body {
 margin:0;
 width:100%;
  height:100%;
}
#Wrapp,#Wrapp2, #Wrapp3, #Wrapp4 {
 top:0;
  left:0;
 position:fixed;
 background-color:#000;
 opacity: 0.88;
 width:100%;
 height:100%;
 z-index:10000;
}
#tt,#tt2 {
  position:relative;
  background-color:#ffffff;
  width:350px;
  padding:12px;
  height:350px;
  margin:20% auto auto auto;
  border:black solid 1px;

}
#tt3,#tt4, #tt5, #tt6, #tt7 {
  position:relative;
  background-color:#ffffff;
  width:600px;
  padding:12px;
  height:500px;
  margin:20% auto auto auto;
  border:black solid 1px;

}
div.close {
  cursor:pointer;
  position:absolute;
  font-weight:900;
  font-size: 25px;
  text-shadow:#000 1px 1px 0;
  color:black;
  right:7px;
  top:2px;
}
</style>

<script type="text/javascript">
  function openbox(id,tt) {
    var div = document.getElementById(id);
    var tt_div = document.getElementById(tt);
    if(div.style.display == 'block') {
        div.style.display = 'none';
    }
    else {
        div.style.display = 'block';
    }
  }
</script>
<script>
 function collapsElement(id) {
 if ( document.getElementById(id).style.display != "none" ) {
 document.getElementById(id).style.display = 'none';
 }
 else {
 document.getElementById(id).style.display = '';
 }
 }
 </script>
</head>
<body>
    <div class="ins_cont" style="width:100%; height:100%">
    	<div class="ins_inp" style="background: #f3f3f3; width:100%; height:250px;">
    		<div class="ins_photo" style="width:30%; height:100%; float: left; margin-left:1%;  ">
    			<img src="/templates/ins_photos/1.jpg" alt="Автошколы Тюмени"  style="align:left; width:100%; height:90%; margin-top:4%;  border: 3px solid #5c7fa7; "/>
    		</div>
    	<div class="ins_info" style="width:43%; height:65%; float: left; margin-left:2%;">
        	<div style=" width:100%; margin-top:2%; margin-left:2%;color: #474747;">
        		<h1><strong>Сбитнев Дмитрий</strong></h1>
                <strong><br>
                Возраст: 43 года
                <br>
                КПП: Механика/Автомат/Ваш
                <br>
                 автомобиль
                <br>
                Автомобиль: Volvo C30
                <br>
                Стаж инструктора: 14 лет
                <br>
                Водительский стаж : 25 лет
                <br>
   	<div id="Wrapp" style="display:none">
<div id='tt3'><div class="close" onclick="openbox('Wrapp')">x</div>
 	<!-- Put this div tag to the place, where the Comments block will be -->
    <div style="width:100%; margin-top:4%;">
    <div id="vk_comments"></div>
    <script type="text/javascript">
    VK.Widgets.Comments("vk_comments", {limit: 10, attach: "*"});
    </script>
    </div>

  </div></div>
<h2><a href="#" onclick="openbox('Wrapp');return false;" >Отзывы</a></h2>
                  </strong>
    		</div>
    	</div>
    	<div class="ins_rait" style="width:22%; height:30%;  float: left; text-align:center;">
    	<div style="margin-top:5%;  text-align:center; width:40%; margin-left:60%; height:90%;">
    	<img src="/templates/ins_photos/9_8.png" alt="Автошколы Тюмени" style="width:100%; height:100%;">
    	 </div>
    	</div>
    	<div class="ins_calling" style="width:22%; height:30%; float: left; text-align:center;">
        <div id="Wrapp2" style="display:none">
<div id='tt'><div class="close" onclick="openbox('Wrapp2')">x</div>

     <dib class="form_container" style="width:100%;text-align:center;">
        <div class="form" style="align:center;  margin-top:4%;">
            <form class="form-container" action="https://formspree.io/exd.nehrome@gmail.com"
      method="POST">
<div class="form-title"><h2 style="color: #474747;">Оставьте заявку</h2></div>
<div class="form-title">Имя</div>
<input class="form-field" type="text" name="firstname" /><br />
<div class="form-title">Телефон</div>
<p style="font-size: 20px;padding-right:15px;">+7
<input class="tel_number2" id="tel_ins" type="text" name="email" /><br />
<div class="submit-container">
<input class="submit-button" type="submit" value="Отправить" />
</div>
</form>
        </div>
    </dib>

  </div></div>
<h2><a href="#" class="calc_button" onclick="openbox('Wrapp2');  return false;" ><img src="/templates/images/call4.png" alt="Автошколы Тюмени" style="width:100%; height:100%;"></a></h2>
<strong>
8-904-492-02-92
</strong>
        </div>
    	</div>
    	
        <br>

            <div class="ins_inp" style="background: #f3f3f3; width:100%; height:250px;">
            <div class="ins_photo" style="width:30%; height:100%; float: left; margin-left:1%;  ">
                <img src="/templates/ins_photos/2.jpg" alt="Автошколы Тюмени"  style="align:left; width:100%; height:90%; margin-top:4%;  border: 3px solid #5c7fa7; "/>
            </div>
        <div class="ins_info" style="width:43%; height:65%; float: left; margin-left:2%;">
            <div style=" width:100%; margin-top:2%; margin-left:2%;color: #474747;">
                <h1><strong>Огнев Олег</strong></h1>
                <strong><br>
                Возраст: 34 года
                <br>
                КПП: Механика/Автомат/Ваш<br>
                 автомобиль
                <br>
                Автомобиль: Toyota Corolla
                <br>
                Стаж инструктора: 13 лет
                <br>
                Водительский стаж : 15 лет
                <br>
 			<div id="Wrapp" style="display:none">
<div id='tt3'><div class="close" onclick="openbox('Wrapp')">x</div>
 

  </div></div>
<h2><a href="#" onclick="openbox('Wrapp');return false;" >Отзывы</a></h2>
                  </strong>
            </div>
        </div>
        <div class="ins_rait" style="width:22%; height:30%;  float: left; text-align:center;">
    	<div style="margin-top:5%;  text-align:center; width:40%; margin-left:60%; height:90%;">
        <img src="/templates/ins_photos/9_5.png" alt="Автошколы Тюмени" style="width:100%; height:100%;">
         </div>
        </div>
        <div class="ins_calling" style="width:22%; height:30%; float: left; text-align:center;">
        <div id="Wrapp4" style="display:none">
<div id='tt'><div class="close" onclick="openbox('Wrapp4')">x</div>

     <dib class="form_container" style="width:100%;text-align:center;">
        <div class="form" style="align:center;  margin-top:4%;">
            <form class="form-container" action="https://formspree.io/exd.nehrome@gmail.com"
      method="POST">
<div class="form-title"><h2 style="color: #474747;">Оставьте заявку</h2></div>
<div class="form-title">Имя</div>
<input class="form-field" type="text" name="firstname" /><br />
<div class="form-title">Телефон</div>
<p style="font-size: 20px;padding-right:15px;">+7
<input class="tel_number2" id="tel_ins" type="text" name="email" /><br />
<div class="submit-container">
<input class="submit-button" type="submit" value="Отправить" />
</div>
</form>
        </div>
    </dib>

  </div></div>
<h2><a href="#" class="calc_button" onclick="openbox('Wrapp2');  return false;" ><img src="/templates/images/call4.png" alt="Автошколы Тюмени" style="width:100%; height:100%;"></a></h2>
<strong>
8-904-492-02-92
</strong>

        </div>
        </div>

        <br>

             <div class="ins_inp" style="background: #f3f3f3; width:100%; height:250px;">
            <div class="ins_photo" style="width:30%; height:100%; float: left; margin-left:1%;  ">
                <img src="/templates/ins_photos/3.jpg" alt="Автошколы Тюмени"  style="align:left; width:100%; height:90%; margin-top:4%;  border: 3px solid #5c7fa7; "/>
            </div>
        <div class="ins_info" style="width:43%; height:65%; float: left; margin-left:2%;">
            <div style=" width:100%; margin-top:2%; margin-left:2%;color: #474747;">
                <h1><strong>Щерба Юрий</strong></h1>
                <strong><br>
                Возраст: 53 года
                <br>
                КПП: Механика
                <br>
                Автомобиль: Ford Fiesta
                <br>
                Стаж инструктора: 12 лет
                <br>
                Водительский стаж : 25 лет
                <br>
              <div id="Wrapp" style="display:none">
<div id='tt3'><div class="close" onclick="openbox('Wrapp')">x</div>
 

  </div></div>
<h2><a href="#" onclick="openbox('Wrapp');return false;" >Отзывы</a></h2>
                  </strong>
            </div>
        </div>
        <div class="ins_rait" style="width:22%; height:30%;  float: left; text-align:center;">
    	<div style="margin-top:5%;  text-align:center; width:40%; margin-left:60%; height:90%;">
        <img src="/templates/ins_photos/9_0.png" alt="Автошколы Тюмени" style="width:100%; height:100%;">
         </div>
        </div>
        <div class="ins_calling" style="width:22%; height:30%; float: left; text-align:center;">
        <div id="Wrapp" style="display:none">
<div id='tt'><div class="close" onclick="openbox('Wrapp')">x</div>

     <dib class="form_container" style="width:100%;text-align:center;">
        <div class="form" style="align:center;  margin-top:4%;">
            <form class="form-container" action="https://formspree.io/exd.nehrome@gmail.com"
      method="POST">
<div class="form-title"><h2 style="color: #474747;">Оставьте заявку</h2></div>
<div class="form-title">Имя</div>
<input class="form-field" type="text" name="firstname" /><br />
<div class="form-title">Телефон</div>
<p style="font-size: 20px;padding-right:15px;">+7
<input class="tel_number2" id="tel_ins" type="text" name="email" /><br />
<div class="submit-container">
<input class="submit-button" type="submit" value="Отправить" />
</div>
</form>
        </div>
    </dib>

  </div></div>
<h2><a href="#" class="calc_button" onclick="openbox('Wrapp2');  return false;" ><img src="/templates/images/call4.png" alt="Автошколы Тюмени" style="width:100%; height:100%;"></a></h2>
<strong>
8-904-492-02-92
</strong>

        </div>
        </div>     
        <br>

             <div class="ins_inp" style="background: #f3f3f3; width:100%; height:250px;">
            <div class="ins_photo" style="width:30%; height:100%; float: left; margin-left:1%;  ">
                <img src="/templates/ins_photos/4.png" alt="Автошколы Тюмени"  style="align:left; width:100%; height:90%; margin-top:4%;  border: 3px solid #5c7fa7; "/>
            </div>
        <div class="ins_info" style="width:43%; height:65%; float: left; margin-left:2%;">
            <div style=" width:100%; margin-top:2%; margin-left:2%;color: #474747;">
                <h1><strong>Максим Харибутов</strong></h1>
                <strong><br>
                Возраст: 36 лет
                <br>
                КПП: Механика
                <br>
                Автомобиль: ВАЗ 21124
                <br>
                Стаж инструктора: 8 лет
                <br>
                Водительский стаж : 18 лет
                <br>
             <div id="Wrapp" style="display:none">
<div id='tt3'><div class="close" onclick="openbox('Wrapp')">x</div>
 

  </div></div>
<h2><a href="#" onclick="openbox('Wrapp');return false;" >Отзывы</a></h2>
                  </strong>
            </div>
        </div>
        <div class="ins_rait" style="width:22%; height:30%;  float: left; text-align:center;">
    	<div style="margin-top:5%;  text-align:center; width:40%; margin-left:60%; height:90%;">
        <img src="/templates/ins_photos/8_9.png" alt="Автошколы Тюмени" style="width:100%; height:100%;">
         </div>
        </div>
        <div class="ins_calling" style="width:22%; height:30%; float: left; text-align:center;">
        <div id="Wrapp" style="display:none">
<div id='tt'><div class="close" onclick="openbox('Wrapp')">x</div>

     <dib class="form_container" style="width:100%;text-align:center;">
        <div class="form" style="align:center;  margin-top:4%;">
            <form class="form-container" action="https://formspree.io/exd.nehrome@gmail.com"
      method="POST">
<div class="form-title"><h2 style="color: #474747;">Оставьте заявку</h2></div>
<div class="form-title">Имя</div>
<input class="form-field" type="text" name="firstname" /><br />
<div class="form-title">Телефон</div>
<p style="font-size: 20px;padding-right:15px;">+7
<input class="tel_number2" id="tel_ins" type="text" name="email" /><br />
<div class="submit-container">
<input class="submit-button" type="submit" value="Отправить" />
</div>
</form>
        </div>
    </dib>

  </div></div>
<h2><a href="#" class="calc_button" onclick="openbox('Wrapp2');  return false;" ><img src="/templates/images/call4.png" alt="Автошколы Тюмени" style="width:100%; height:100%;"></a></h2>
<strong>
8-904-492-02-92
</strong>

        </div>
        </div>  
        <br>

             <div class="ins_inp" style="background: #f3f3f3; width:100%; height:250px;">
            <div class="ins_photo" style="width:30%; height:100%; float: left; margin-left:1%;  ">
                <img src="/templates/ins_photos/5.png" alt="Автошколы Тюмени"  style="align:left; width:100%; height:90%; margin-top:4%;  border: 3px solid #5c7fa7; "/>
            </div>
        <div class="ins_info" style="width:43%; height:65%; float: left; margin-left:2%;">
            <div style=" width:100%; margin-top:2%; margin-left:2%;color: #474747;">
                <h1><strong>Баранов Дмитрий</strong></h1>
                <strong><br>
                Возраст: 21 год
                <br>
                КПП: Механика
                <br>
                Автомобиль: Daewoo Nexia
                <br>
                Стаж инструктора: 3 года
                <br>
                Водительский стаж : 3 года
                <br>
                <div id="Wrapp" style="display:none">
<div id='tt3'><div class="close" onclick="openbox('Wrapp')">x</div>
 

  </div></div>
<h2><a href="#" onclick="openbox('Wrapp');return false;" >Отзывы</a></h2>
                  </strong>
            </div>
        </div>
       <div class="ins_rait" style="width:22%; height:30%;  float: left; text-align:center;">
    	<div style="margin-top:5%;  text-align:center; width:40%; margin-left:60%; height:90%;">
        <img src="/templates/ins_photos/8_7.png" alt="Автошколы Тюмени" style="width:100%; height:100%;">
         </div>
        </div>
        <div class="ins_calling" style="width:22%; height:30%; float: left; text-align:center;">
        <div id="Wrapp" style="display:none">
<div id='tt'><div class="close" onclick="openbox('Wrapp')">x</div>

     <dib class="form_container" style="width:100%;text-align:center;">
        <div class="form" style="align:center;  margin-top:4%;">
            <form class="form-container" action="https://formspree.io/exd.nehrome@gmail.com"
      method="POST">
<div class="form-title"><h2 style="color: #474747;">Оставьте заявку</h2></div>
<div class="form-title">Имя</div>
<input class="form-field" type="text" name="firstname" /><br />
<div class="form-title">Телефон</div>
<p style="font-size: 20px;padding-right:15px;">+7
<input class="tel_number2" id="tel_ins" type="text" name="email" /><br />
<div class="submit-container">
<input class="submit-button" type="submit" value="Отправить" />
</div>
</form>
        </div>
    </dib>

  </div></div>
<h2><a href="#" class="calc_button" onclick="openbox('Wrapp2');  return false;" ><img src="/templates/images/call4.png" alt="Автошколы Тюмени" style="width:100%; height:100%;"></a></h2>
<strong>
8-904-492-02-92
</strong>

        </div>
        </div>                   
        
    	<br>
        <div class="ins_reg" style="width:100%;">

        <a href="/ins_files/pages/ins_reg.php/" target="_blank"><strong>Оставить заявку на добавление в список</strong></a>
        </div>
      
   </div>

 <? 	
    include 'templates/footer2.php';	
    include 'templates/metric.php'; 

?>
   <script async src="//track.soctracker.ru/?id=ZWQzMjEyOWVhY2M4NDJkYjFkZmIwYjhhODdhN2E2OTJ8MjAyOA=="></script>
 </body>