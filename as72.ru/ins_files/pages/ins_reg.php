<?php
	include '../../as_core.php';
    addDescription('');
    addKeywords('');
    addCurrent('ins_more1');
    addTitle('Заявка для инструкторов');	
    	    
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
    <div class="ins_cont" style="width:100%; height:100% ">
    	<div class="ins_inp" style=" width:100%; height:500px;">
    		
        <dib class="form_container" style="width:100%;text-align:center;">
        <div class="form" style="align:center; margin-left:15%; margin-top:4%;">
            <form class="form-container" action="https://formspree.io/Tmn-as72@yandex.ru"
      method="POST">
<div class="form-title"><h2 style="color: #474747;">Оставьте заявку</h2></div>
<div class="form-title">Имя</div>
<input class="form-field" type="text" name="firstname" /><br />
<div class="form-title">Телефон</div>
<input class="form-field" type="text" name="email" /><br />
<div class="form-title">Стаж вождения</div>
<input class="form-field" type="text" name="text" /><br />
<div class="form-title">Стаж инструктора</div>
<input class="form-field" type="text" name="text" /><br />
<div class="submit-container">
<input class="submit-button" type="submit" value="Отправить" />
</div>
</form>
        </div>
    </dib>
    </div>
    	<!-- Put this div tag to the place, where the Comments block will be -->
    <div style="width:100%; margin-top:4%;">
    </div>
    <div id="vk_comments"></div>
    <script type="text/javascript">
    VK.Widgets.Comments("vk_comments", {limit: 10, attach: "*"});
    </script>
    
 	</div>
 </body>
 <? 	
    include '../../templates/footer.php';	
?>