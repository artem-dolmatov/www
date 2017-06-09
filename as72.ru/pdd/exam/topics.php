<?php
    include_once '../../as_core.php';
	
	echo '<br clear="both"/><div style="margin-left:15px;">';
	echo '<div id="menu1" class="zagol active">Билеты</div> <div id="menu2" class="zagol">Вопросы по темам</div> <!--<div id="menu3" class="zagol">Экзамен</div>--><br clear="both"/>';
	echo '<div id="var1" style="overflow:hidden"><div style="float:left; width:380px;">';
	for ($i=1;$i<=40;$i++)
	{
		echo '<div onClick="return ajaxBilet('.$i.');" class="bilet">' . $i . '</div>';
		if ($i%8==0) 
			echo '<br clear="both"/>';
	}
    echo '</div><div style="float:left; width:310px; right:150px; font-size:12px;">';
    echo '<script src="http://ajax.googleapis.com/ajax/libs/swfobject/2.1/swfobject.js"></script>';
    echo '</div><br clear="both"/><br/>';
    ?>
    <?php
	echo '</div> <!-- /var1 -->';
	echo '<div id="var2" style="display:none">';
    $query = $db->query("SELECT * FROM `pdd_topics` ORDER BY num") or die('Ошибка вывода тем');
    
	echo '<form onSubmit="return ajaxTopics(this);">';
	
	while ( $row = $query->fetch(PDO::FETCH_ASSOC) )
	{
		echo '<label class="topics"><input type="checkbox" onClick="topicsColor(this);" name="topics" value="'.$row['id'].'" /> ' . $row['num'] . '. ' . $row['name'] . '</label><br/>';
	}
	echo '<div style="margin-top:10px;"><input type="submit" class="next" name="submit" value="Поехали!" style="float:left"/></div> <div style="float:left; margin-top:5px;" id="checklink">отметить все</div><br clear="both"/>';
	echo '</form>';
	echo '</div> <!-- /var2 -->';
	echo '</div>';
	echo '<br clear="both"/>';