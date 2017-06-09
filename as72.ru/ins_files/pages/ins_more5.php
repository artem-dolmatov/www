<?php
	include '../../as_core.php';
    addDescription('');
    addKeywords('');
    addCurrent('ins_more1');
    addTitle('Баранов Дмитрий');	
    	    
    $leftrow = true;

    $mobile = strpos($_SERVER['HTTP_USER_AGENT'],"Mobile");
    
    if ($mobile == true) {

	}
    
    include '../../templates/header1.php';
    
    

 ?>
 <!DOCTYPE html>
<html lang="ru" http-equiv="content-type" content="text/html;charset=utf-8">
<head>
<link href="../../templates/style.css" rel="stylesheet" type="text/css" />
<!-- Put this script tag to the <head> of your page -->
<script type="text/javascript" src="//vk.com/js/api/openapi.js?121"></script>

<script type="text/javascript">
  VK.init({apiId: API_ID, onlyWidgets: true});
</script>
</head>
<body>
    <div class="ins_cont" style="width:100%;">
    	<div class="ins_inp" style="background: #b7c6d8; width:100%; height:200px;">
    		<div class="ins_photo" style="width:35%; height:200px; float: left; margin-left:1%;  ">
    			<img src="/ins_files/photos/5.png" alt="Автошколы Тюмени"  style="align:left; width:100%; height:90%; margin-top:4%;  border: 3px solid #5c7fa7; "/>
    		</div>
    	<div class="ins_info" style="width:40%; height:80%; float: left; margin-left:2%;">
        	<div style=" width:100%; margin-top:2%; margin-left:2%;color: #474747;">
        		Баранов Дмитрий
                <br>
                21 год
                <br>
                Механика
                <br>
                Автомобиль Daewoo Nexia
                <br>
                Стаж инструктора 3 года 
                <br>
                Тел. 92-02-92 
    		</div>
    	</div>
    	<div class="ins_rait" style="width:18%; height:20%; float: left; text-align:center; ">
    	<div style="margin-top:5%;  text-align:center;"  >
    	<img src="/ins_files/photos/8_7.png" alt="Автошколы Тюмени" style="width:100%; height:90%;">
    	 </div>
    	</div>
    	</div>
        <dib class="form_container" style="width:100%;text-align:center;">
        <div class="form" style="align:center; margin-left:15%; margin-top:4%;">
            <form class="form-container" action="https://formspree.io/ermaktmn@yandex.ru"
      method="POST">
<div class="form-title"><h2 style="color: #474747;">Оставьте заявку</h2></div>
<div class="form-title">Имя</div>
<input class="form-field" type="text" name="firstname" /><br />
<div class="form-title">Телефон</div>
<input class="form-field" type="text" name="email" /><br />
<div class="submit-container">
<input class="submit-button" type="submit" value="Отправить" />
</div>
</form>
        </div>
    </dib>
    	<!-- Put this div tag to the place, where the Comments block will be -->
    <div style="width:100%; margin-top:4%;">
    <div id="vk_comments"></div>
    <script type="text/javascript">
    VK.Widgets.Comments("vk_comments", {limit: 10, attach: "*"});
    </script>
    </div>
 	</div>
 </body>
 <? 	
    include '../../templates/footer.php';	
?>