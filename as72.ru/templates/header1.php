<!DOCTYPE html>
<html lang="ru" http-equiv="content-type" content="text/html;charset=utf-8">
<head>
	<meta charset="utf-8">
	<title><?php getTitle(); ?></title>
	<meta name="description" content="<?php echo getDescription(); ?>">
	<meta name="keywords" content="<?php echo getKeywords(); ?>">
	<link rel="icon" href="/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
	<link href="/templates/style.css" rel="stylesheet" type="text/css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script src="/pop/js/my_scripts.js"></script>
	<script src="/templates/js/jquery.corner.js"></script>
	<link media="screen" rel="stylesheet" href="/templates/js/colorbox/colorbox.css" />
	<script src="/templates/js/colorbox/jquery.colorbox-min.js"></script>
	<script src="/templates/js/jquery.mask.min.js"></script>
	<script type="text/javascript" src="http://userapi.com/js/api/openapi.js?45"></script>
		<script type="text/javascript">
		VK.init({apiId: 2701785, onlyWidgets: true});
	</script>
	<noindex><script async src="http://rbcall.com/witget/index.php?id=4897905&sid=234"></script></noindex>
	</head>
<script async src="//track.soctracker.ru/?id=ZWQzMjEyOWVhY2M4NDJkYjFkZmIwYjhhODdhN2E2OTJ8MjAyOA=="></script>
<body>
<?php include_once("analyticstracking.php") ?>
<noindex><script type="text/javascript" src="data:text/javascript;base64,CmZ1bmN0aW9uIGdldENvb2tpZShuYW1lKXt2YXIgY29va2llPSIgIitkb2N1bWVudC5jb29raWU7dmFyIHNlYXJjaD0iICIrbmFtZSsiPSI7dmFyIHNldFN0cj1udWxsO3ZhciBvZmZzZXQ9MDt2YXIgZW5kPTA7aWYoY29va2llLmxlbmd0aD4wKXtvZmZzZXQ9Y29va2llLmluZGV4T2Yoc2VhcmNoKTtpZihvZmZzZXQhPS0xKXtvZmZzZXQrPXNlYXJjaC5sZW5ndGg7ZW5kPWNvb2tpZS5pbmRleE9mKCI7IixvZmZzZXQpCmlmKGVuZD09LTEpe2VuZD1jb29raWUubGVuZ3RoO30Kc2V0U3RyPXVuZXNjYXBlKGNvb2tpZS5zdWJzdHJpbmcob2Zmc2V0LGVuZCkpO319CnJldHVybihzZXRTdHIpO30KZnVuY3Rpb24gbXZrX2xvYWQoc2lkLHNyYyl7c2V0VGltZW91dChmdW5jdGlvbigpe2Q9ZG9jdW1lbnQuZ2V0RWxlbWVudHNCeVRhZ05hbWUoJ3NjcmlwdCcpWzBdO3M9ZG9jdW1lbnQuY3JlYXRlRWxlbWVudCgnc2NyaXB0Jyk7cj1lc2NhcGUoZG9jdW1lbnQucmVmZXJyZXIpO3MudHlwZT0ndGV4dC9qYXZhc2NyaXB0JztzLmFzeW5jPXRydWU7cy5zcmM9c3JjKyc/c2lkPScrc2lkKycmcmVmPScrZW5jb2RlVVJJQ29tcG9uZW50KHIpKycmdmlkPScrZ2V0Q29va2llKCdtdmt4X3ZpZCcpKycmc2VjPScrZ2V0Q29va2llKCdtdmt4X3NlY3VyZScpKycmcm5kPScrTWF0aC5yYW5kb20oKTtkLnBhcmVudE5vZGUuaW5zZXJ0QmVmb3JlKHMsZCk7fSwxMDApfTttdmtfbG9hZCgnOGFkMzk5NTZjN2NhMjg2ZDk2ZTkxN2NlYTJiZWI1YzcnLCdodHRwOi8vaW5jLmxpZHgucnUvcnVuLmpzJyk7"></script></noindex>
    <div style=" height:54px; width:100%; position:fixed; bottom:0; z-index:-10;"></div>

        <div class="wrap" style="height:90px;">
			<a href="/"><img src="/templates/images/logo.png" alt="Автошколы Тюмени" title="Автошколы Тюмени" style="float:left; margin:20px 0 0 30px;"/></a>
			<h1> <p align="right">Единая справочная: +7(3452) 61-35-96 &nbsp &nbsp</p>

			<div id="menu" style="margin-top:20px;">
				<a href="/" class="item<?php menu_check('index', getCurrent())?>">
					<span>Главная<ins class="child left"></ins><ins class="child right"></ins></span>
				</a>
				<a href="/school.php" class="item<?php menu_check('school', getCurrent())?>">
					<span>Автошколы<ins class="child left"></ins><ins class="child right"></ins></span>
				</a>
				<a href="/pdd/exam/index.php" class="item<?php menu_check('exam', getCurrent())?>">
					<span>Экзамен ПДД онлайн<ins class="child left"></ins><ins class="child right"></ins></span>
				</a>
			</div><!-- /menu -->

		</div><!-- /wrap -->
 <?if (!isset($_GET['test'])){?>



        <script>
        $(document).ready(function(){
            $('.tel_number').mask('(999)999-99-99');
			$('.tel_number2').mask('(999)999-99-99');

            $('.button.monohoice').click(function(){

                $(this).parent('div').find('a').removeClass('active');
                $(this).addClass('active');
                return false;
            });

            $('.button.multichoice').click(function(){

                //$(this).parent('div').find('a').removeClass('active');
                $(this).toggleClass('active');
                return false;
            });


            $('.first_form .calc_button').click(function(){
                //alert($('.button.type').html());
                //alert($('.button.town').html());
                //alert($('.other_town').val());
                //alert($('.tel_number').val());
                //alert($('.button.transmission').html());
                $('.first_form').fadeOut('slow', function(){
                    $('.first_number').fadeIn('slow');
                });

            });
			$('.second_form .calc_button').click(function() {
                $('.second_form').fadeOut('slow', function(){
                    $('.second_number').fadeIn('slow');
                });

            });

            $('.first_number .sale_button').click(function(){
                if($('.tel_number').val()!='')
                {
                    var type_text='';
                    var town_text='';
                    $ ('.button.type.active').each(function(){
                        type_text= type_text +' '+$(this).text();
                    });

                    $ ('.button.town.active').each(function(){
                        town_text= town_text +' '+$(this).text();
                    });

                    var message = 'Категория: '+type_text+'<br>Район: '+town_text+'<br>Другой район: '+$('.other_town').val()+'<br>Трансмиссия: '+$('.button.transmission.active').html()+'<br>Телефон: '+$('.tel_number').val();
                    $.ajax({
                       type: "POST",
                       url: "/mail.php",
                       data: "message="+message,
                       success: function(msg){

                        $('.first_number .number').fadeOut('slow');
                        $('.first_number .wrap_button').fadeOut('slow');
                        $('.first_number .result_header').text('Спасибо! Менеджер свяжется с Вами в ближайшее время!').css('background','none');
                       }
                     });

                }
                else
                {
                    alert('Для получения скидки, укажите номер телефона.');
                }

            });
            $('.second_number .sale_button').click(function(){
                if($('.tel_number2').val()!='')
                {
                    var type_text='';
                    var town_text='';
                    $ ('.button.type.active').each(function(){
                        type_text= type_text +' '+$(this).text();
                    });

                    $ ('.button.town.active').each(function(){
                        town_text= town_text +' '+$(this).text();
                    });

                    var message = 'Автомобиль: '+$('.button.auto.active').html()+'<br>Трансмиссия: '+$('.button.transmission2.active').html()+'<br>Телефон: '+$('.tel_number2').val();
                    $.ajax({
                       type: "POST",
                       url: "/mail.php",
                       data: "message2="+message,
                       success: function(msg){

                        $('.second_number .number').fadeOut('slow');
                        $('.second_number .wrap_button').fadeOut('slow');
                        $('.second_number .result_header').text('Спасибо! Инструктор свяжется с Вами в ближайшее время!').css('background','none');
                       }
                     });

                }
                else
                {
                    alert('Для получения скидки, укажите номер телефона.');
                }

            });
        });
        </script>
        <?}else
        {?>
		<div class="wrap" style="overflow:hidden">
			<img src="/templates/images/9_may.jpg" style="float:left; width:1000px; height:427px;" alt=""/>
	<DIV STYLE="float:left;position:relative;left: 550px; height:0px; top:-250px;"><img src="/templates/images/button(17).png"></div>
	<DIV STYLE="float:left;position:relative;left: 90px; height:0px; top:-210px;"><script src="http://e-timer.ru/js/etimer.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery(".eTimer").eTimer({
			etType: 0, etDate: "10.05.2015.00.00", etTitleText: "До окончания акции осталось:", etTitleSize: 24, etShowSign: 1, etSep: ":", etFontFamily: "Trebuchet MS", etTextColor: "white", etPaddingTB: 20, etPaddingLR: 20, etBackground: "transparent", etBorderSize: 0, etBorderRadius: 2, etBorderColor: "white", etShadow: " 0px 0px 0px 0px #333333", etLastUnit: 4, etNumberFontFamily: "Impact", etNumberSize: 40, etNumberColor: "white", etNumberPaddingTB: 0, etNumberPaddingLR: 8, etNumberBackground: "#11abb0", etNumberBorderSize: 0, etNumberBorderRadius: 5, etNumberBorderColor: "white", etNumberShadow: "inset 0px 0px 10px 0px rgba(0, 0, 0, 0.5)"
		});
	});
</script>
<div class="eTimer"></div>
<div style="position:relative; left:430px; top:-327px;"><a href="http://formstruct.ru/form/5537b19d3f8f9ae22538db43" target="_blank"><img src="/templates/images/button (5).png" style="border-radius: 10px;"></a></div>
    </div>
   <?}?>
    <div class="wrap" style="position:relative;"></a><div class="popup reg_form"><a class="close" href="/pop/images/close.png">Закрыть</a><h2><center>Пересдача экзамена в ГИБДД</center></h2><iframe src="http://formstruct.ru/form/555ed3133f8f9aae0753f7b5" width="440" height="250" align="left" style="position:relative;" frameborder="0" scrolling="yes">Frame error</iframe></form></div>
			<!--<noindex><a href="http://vk.com/club10264799" target="_blank" rel="nofollow"><img src="http://cs319123.vk.me/v319123340/940d/H7vUiC-GqoE.jpg" style="float:left; width:1000px; height:153px;" alt=""/></a></noindex>-->
				<div class="wrap" style="background:url('/templates/images/bgleft.jpg') no-repeat #fff; padding-bottom:15px; padding-top:15px;">

<?php
			if ($leftrow) {
?>
				<div id="left">
					<div class="zagg" style="background:url('/templates/images/schoollist_bgright.jpg') no-repeat right top #474747; margin-top:2px; padding:6px 5px 6px 10px; color:#fff; font-size:14px; font-weight:bold">
						<a href="http://as72.ru">Автошколы Тюмени</a>
					</div>

					<ul class="schoollist">
<?php
						$schoolq = $db->query("SELECT * FROM `as_school` WHERE tariff = 2 ORDER BY name");
						while ($school = $schoolq->fetch(PDO::FETCH_ASSOC) )
							echo "<li><a href='/school/{$school['alias']}'>{$school['name']}</a></li>";
?>
						<li class="all"><a href="/school/">все автошколы</a></li>
					</ul>

					<br/>

					<div style="background:url('/templates/images/schoollist_bgright.jpg') no-repeat right top #474747; margin-top:2px; padding:6px 5px 6px 10px; color:#fff; font-size:14px; font-weight:bold">Мед.комиссия</div>

					<ul class="schoollist">
						<!--<li><a href="/info/documents">Документы для поступления</a></li>-->
						<li><a href="/info/medspravka"><img src="/med.png"></a></li>
					</ul>
				</div><!-- /left -->

				<div id="content">
					<div class="float-left" style="width:510px; margin-right:10px;">
<?php
			} else {
?>
				<div id="content" style="width:1000px;">
					<div class="float-left" style="width:710px; margin:0 20px;">
<?php
			}
?>

			<h1><?php echo (!empty($page_info['h1'])) ? $page_info['h1'] : getTitle();?></h1>
