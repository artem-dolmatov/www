<?php
    include 'as_core.php';
    
    addTitle('Все автошколы Тюмени на одном сайте');
    addDescription('');
    addKeywords('');
    addCurrent('school');
    
    $leftrow = false;
   
    include 'templates/header.php';

    if ($_GET['action'] == 'add' and $_SESSION['admin']) {
        if (!empty($_POST['name']) and !empty($_POST['alias'])) {
            $db->query("INSERT INTO as_school SET name = '{$_POST['name']}', alias = '{$_POST['alias']}'");
            redirect('/school/'.$_POST['alias'].'?action=edit');
        }
       	echo '<b>Добавление автошколы</b>';
        echo '<form method="post">';
        echo 'Название автошколы<br/><input type="text" name="name" class="edit"/><br/>';
        echo 'Алиас<br/><input type="text" name="alias" class="edit"/><br/>';
        echo '<input type="submit" value="Добавить" class="edit"/>';
        echo '</form>';
    } else {
        if ($_SESSION['admin']) {
            echo "<a href='/school/?action=add'>Добавить автошколу</a><br clear='both'/><br/>";
        }
        
		echo '<form method="post" onSubmit="return SearchSchool(this);">';
        echo '<div class="" style="margin-bottom:15px; font-size:12px; color:#777">';
        echo '<div style="background:#eeeeee; border-radius:5px; padding:5px 10px; overflow:hidden; text-shadow: 1px 1px 1px #fff;">';
        echo '<div style="float:left">';
        echo '<b>Быстрый поиск:</b>';
        echo '</div>';
        echo '<div style="float:right">';
        echo '<label><input type="checkbox" name="akpp" onChange="submit.click();" /> Автомобили с АКПП</label> &nbsp;';
        echo '<label><input type="checkbox" name="site" onChange="submit.click();"/> Есть свой сайт</label> &nbsp;';
        echo '<label><input type="checkbox" name="kat_a" onChange="submit.click();"/> A</label> &nbsp;';
        echo '<label><input type="checkbox" name="kat_b" onChange="submit.click();"/> B</label> &nbsp;';
        echo '<label><input type="checkbox" name="kat_c" onChange="submit.click();"/> C</label> &nbsp;';
        echo '<label><input type="checkbox" name="kat_d" onChange="submit.click();"/> D</label> &nbsp;';
        echo '<label><input type="checkbox" name="kat_e" onChange="submit.click();"/> E</label> &nbsp;';
        echo '</div>';
        echo '<div style="clear:both; display:none" class="search_adva_box">';
        echo '<label><input type="checkbox" name="girl" onChange="submit.click();"/> Есть девушки инструкторы</label><br/>';
        echo '<label><input type="checkbox" name="credit" onChange="submit.click();"/> Рассрочка платежа</label><br/>';
        echo '<label><input type="checkbox" name="dayoff" onChange="submit.click();"/> Группа выходного дня</label><br/>';
        echo '<label><input type="checkbox" name="night" onChange="submit.click();"/> Вечерние группы</label><br/>';
        echo '<label><input type="checkbox" name="recovery" onChange="submit.click();"/> Восстановление навыков вождения (для тех, у кого уже есть права)</label><br/><hr/>';
        
        echo '<label><input type="checkbox" name="vk" onChange="submit.click();"/>Группа ВКонтакте</label><br/>';
		echo '<label><input type="checkbox" name="email" onChange="submit.click();"/>e-mail</label><br/>';
		echo '<label><input type="checkbox" name="icq" onChange="submit.click();"/>ICQ</label><br/>';
        
        
        echo '</div>';
        echo '<div style="display:none;"><input type="submit" name="submit"/></div>';
        echo '</div>';
        echo '</form>';
        echo '<div style="text-align:right; font-size:11px;"><a href="#" style="color:#888" class="search_adva">больше параметров ↓</a></div>';
        echo '</div>';
        
    	$schoolq = $db->query("SELECT * 
                      	FROM `as_school`
                      	ORDER BY tariff DESC, name");
    	$i = 1;
    	echo '<div id="school_box">';
    	while ($school = $schoolq->fetch(PDO::FETCH_ASSOC) ) {
        	include 'templates/school.php';
		}
		echo '</div>';
	}
	include 'templates/footer.php';
     include 'templates/metric.php';
?>