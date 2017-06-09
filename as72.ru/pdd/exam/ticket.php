<?php
	include_once '../../as_core.php';
	
	$topic = $_POST['topic'];
	$bilet = intval($_POST['bilet']);
	$quest = array();

	$iphone  = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
    	if ($iphone == true){
    		$browser = 'iphone';
  		}
	
	if (!empty($topic))
	{
		if ( count($topic) == 1)
		{
			$topic = $topic[0];

            $query = $db->query("SELECT name, num FROM `pdd_topics` 
								  WHERE `id` = {$topic} 
								  LIMIT 1") or die('Ошибка вывода тем');
			$topic_name = $query->fetch(PDO::FETCH_ASSOC);
			echo '<h3>' . $topic_name['num'] . '. ' . $topic_name['name'] . '</h3>';
	
			$query = $db->query("SELECT * FROM `pdd_question` 
								  WHERE `topic_id` = {$topic} 
								  ORDER BY id") or die('Ошибка вывода вопросов');
		}
		else
		{
			$sql1 = '';
			$sql2 = '';
			$i = 0;
			foreach ($topic as $t) 
			{
				if ($i == 0)
				{
					$sql1 .= '`id` = ' . $t;
					$sql2 .= '`topic_id` = ' . $t;
				}
				else
				{
					$sql1 .= ' or `id` = ' . $t;
					$sql2 .= ' or `topic_id` = ' . $t;
				}
				$i++;
			}
			
			$query = $db->query("SELECT name, num FROM `pdd_topics`
								  WHERE {$sql1}") or die('Ошибка вывода тем');
            $topic_name_h3 = '';
            $i = 0;
            while ( $topic_name = $query->fetch(PDO::FETCH_ASSOC) ) {
                $i++;
                if ($i < 4) $topic_name_h3 .= $topic_name['num'] . '. ' . $topic_name['name'] . '; ';
                if ($i > 3) { $topic_name_h3 .= '...'; break; }
            }
                
			echo '<h3>'.$topic_name_h3.'</h3>';
			
			$query = $db->query("SELECT * FROM `pdd_question`
								  WHERE {$sql2} ORDER BY RAND() LIMIT 20") or die('Ошибка вывода вопросов');
		}
	}
	elseif (!empty($bilet)) 
	{
		if($browser == 'iphone'){echo '<div id="nav"><ul><li><a href="/pdd/exam/"><span>Экзамен ПДД онлайн 2016</span></a></li></ul></div>';};
		echo '<h3 id="bilet">Билет №'.$bilet.'</h3>';
		$query = $db->query("SELECT * FROM `pdd_question`
							  WHERE `bilet` = {$bilet}
							  ORDER BY vopros") or die('Ошибка вывода вопросов');		
	}
	else 
		exit();
		
	while( $row = $query->fetch(PDO::FETCH_ASSOC) )
		$quest[] = $row;
		
	//print_r($quest);
	$count = count($quest);
	echo 'Количество вопросов: <span id="count_quest">' . $count . '</span><input type="hidden" name="answer_error" id="answer_error" value="0"/><br/>';
	//echo '<input type="text" name="text" value="'.$quest[0]['id'].'"/><br/>';
	echo '<table border="0" width="100%" cellspacing="1" cellpadding="0" style="font-size:0px; height:7px; margin-bottom:10px"><tr>';
	foreach ( $quest as $q )
		echo '<td id="quest'.$q['id'].'" style="background:#ccc">&nbsp;</td>';
	echo '</table></tr>';
	
	$i = 0;
	foreach ( $quest as $q )
	{		
		if ($i == 0)
			echo '<div style="display:block; margin:0 15px;" id="questbox'.$q['id'].'">';
		else
			echo '<div style="display:none; margin:0 15px;" id="questbox'.$q['id'].'">';
		$i = 1;
		
		$img = 'img/' . $q['img'];
		echo '<div style="text-align:center; margin-bottom:15px;">';
		if($browser == 'iphone') {
			if ( file_exists($img) and !empty($q['img']) )
				echo '<img src="'.$img.'" width="300" />';
			else
				echo '<img src="imgbig/none.jpg" width="300"/>';
			echo '</div>';
		} else { 
			if ( file_exists($img) and !empty($q['img']) )
				echo '<img src="'.$img.'" width="480" />';
			else
				echo '<img src="imgbig/none.jpg" width="480"/>';
			echo '</div>';
		}
		
		echo '<div style="font-size:14px; font-weight:bold; margin-bottom:10px;">' . stripslashes($q['name']) . '</div>';
		$sql = $db->query("SELECT * FROM `pdd_answers`
							WHERE `quest_id` = {$q['id']}") or die('Ошибка');
		echo '<form onSubmit="return ajaxAnswerNext('.$q['id'].')">';

		if($browser == 'iphone') echo '<div id="nav"><ul>';
		
		while ($answ = $sql->fetch(PDO::FETCH_ASSOC))
		{	
			if($browser == 'iphone') {
				echo '<li><div class="text">';		
				echo '<label id="an'.$answ['id'].'" class="variant">';
				if ( $answ['ok'] == 1 ) {
					echo '<input type="hidden" name="otvet" id="otvet'.$q['id'].'" value="'.$answ['id'].'"/>';
					}
				echo '<input type="radio" onChange="return ajaxAnswer('.$q['id'].');" name="answer'.$q['id'].'" value="'.$answ['ok'].'" /> '.stripslashes($answ['name']).'</label>';		
				echo '</div></li>';				
			} else {	
				if ( $answ['ok'] == 1 )
					echo '<input type="hidden" name="otvet" id="otvet'.$q['id'].'" value="'.$answ['id'].'"/>';
				
				echo '<label id="an'.$answ['id'].'" class="variant"><input type="radio" onChange="return ajaxAnswer('.$q['id'].');" name="answer'.$q['id'].'" value="'.$answ['ok'].'" /> ' . stripslashes($answ['name']) . '</label>';
			}	
		}
		if($browser == 'iphone') echo '</ul></div>';
		echo '<br/>';
		echo '<input type="submit" class="next" name="submit'.$q['id'].'" value="Следующий" disabled/> <span class="comment" onClick="javascript: comment_show('.$q['id'].');">комментарий</span>';
		if ($browser == 'iphone') echo '<div id="comm_box'.$q['id'].'" style="display:none;"><ul><li><div class="text">'.stripslashes($q['message']).'</div></li></ul></div>'; else
		echo '<div id="comm_box'.$q['id'].'" style="display:none; font-size:12px; margin-top:5px; padding:10px; border:1px solid #a8c694; background:#d9e7cf">'.stripslashes($q['message']).'</div>';
		echo '</form>';
		echo '</div>';
	}
	echo '<div style="background:#fff; padding:5px; margin:3px 0; display:none;" id="questbox9999">';
	echo '<a href="/pdd/exam/">Выбрать тему</a>';
	echo '</div>';