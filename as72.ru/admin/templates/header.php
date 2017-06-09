<html>
<head>
    <title>Панель управления</title>
    <style>
        * {margin:0; padding:0}
        body {font-family:arial; font-size:12px; color:#333;}
        a {color:#333}
        a:hover {color:#333}
        #box {width:1000px; margin:0 auto; margin-bottom:40px;}
        #cp {padding:15px 0; overflow:hidden}
        #menu {background-color:#000; overflow:hidden; margin-bottom:15px;}
        #menu a {display:block; float:left; color:#fff; padding:10px;}
        #menu a:hover {background-color:#555}
        .fleft {float:left}
        .fright {float:right}
        table {padding:0; border-spacing:0;}
        table td {padding:10px; border-bottom:1px solid #ccc}
        
        .submenu {overflow:hidden; margin-bottom:10px;}
        .submenu a {padding:5px 15px; background-color:#ccc; display:block; float:right;}
        .submenu a:hover {background-color:#999}
        
        input[type="text"] {padding:4px 10px}
    </style>
</head>
<body>
<div id="box">
    <div id="cp">
        <div style="float:left">
            <a href="./">Админка</a> &nbsp; 
            <a href="/">Просмотр сайта</a>
        </div>
        <div style="float:right"><a href="/logout.php">Выход</a></div>
    </div><!-- /cp -->
    
    <div id="menu">
        <a href="./">Главная</a>
        <a href="./info.php">Страницы</a>
        <a href="./users.php">Пользователи</a>
    </div>