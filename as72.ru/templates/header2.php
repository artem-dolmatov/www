<!DOCTYPE html>
<html lang="ru" http-equiv="content-type" content="text/html;charset=utf-8">
<head>
<link href="/templates/style.css" rel="stylesheet" type="text/css" />

<body>

    <div class="wrap" style="height:90px;">
            <a href="/"><img src="/templates/images/logo.png" alt="Автошколы Тюмени" title="Автошколы Тюмени" style="float:left; margin:20px 0 0 30px;"/></a>
            <h1> <p align="right">Единая справочная: +7(3452)617-412 &nbsp &nbsp</p> </h1>

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
              </div>

</div>
