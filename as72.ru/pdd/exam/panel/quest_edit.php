<?php
	ob_start();
	include_once '../../../as_core.php';
	
    if ($_SESSION['admin'] != true) exit('Только для администраторов');
    
	include 'tpl_header.php';
	
	if (empty($_GET['topic_id']))
	{
		echo '<h2>Выберите раздел</h2>';
		$topic_sql = $db->query("SELECT * FROM `pdd_topics` ORDER BY id") or die('error 1');
		while ($topic = $topic_sql->fetch(PDO::FETCH_ASSOC))
			echo '<a href="?topic_id='.$topic['id'].'">' . $topic['name'] . '</a><br/>';
		exit();
	}
	$topic_id = intval($_GET['topic_id']);
	if (empty($topic_id)) exit('error 2');
		
	if (empty($_GET['quest_id']))
	{
		echo '<h2>Выберите вопрос</h2>';
		$quest_sql = $db->query("SELECT * FROM `pdd_question` WHERE `topic_id` = {$topic_id} ORDER BY id") or die('error 3');
		while ($quest = $quest_sql->fetch(PDO::FETCH_ASSOC))
			echo '<a href="?topic_id='.$topic_id.'&quest_id='.$quest['id'].'">' . stripslashes($quest['num']) . ' ' . stripslashes($quest['name']) . '</a><br/>';
		exit();
	}
	$quest_id = intval($_GET['quest_id']);
	if (empty($quest_id)) exit('error 4');
	
	if((!empty($_GET['act'])) and ($_GET['act']=='del') and (!empty($_GET['id_answer'])))
	{
		$id_answer = intval($_GET['id_answer']);
		if (empty($id_answer)) exit('error 5');
		
		$db->query("DELETE FROM `pdd_answers` WHERE id = '{$id_answer}'") or die('error 6');
		
		header("Location: ./quest_edit.php?topic_id={$topic_id}&quest_id={$quest_id}");
		exit();
	}
	
	if((!empty($_GET['act'])) and ($_GET['act']=='delimg') and (!empty($_GET['pic'])))
	{
		$img = '../img/' . $_GET['pic'];
		
		if ( file_exists($img) )
			unlink($img);
		
		header("Location: ./quest_edit.php?topic_id={$topic_id}&quest_id={$quest_id}");
	}
	
	if (!empty($_POST['name']))
	{		
		$name     = $_POST['name'];
		$message  = $_POST['message'];
		$num      = $_POST['num'];
		$filename = $_POST['filename'];
		$bilet    = intval($_POST['bilet']);
		$vopros   = intval($_POST['vopros']);
		
		$db->query("UPDATE `pdd_question`
					 SET `name`     = '{$name}',
						 `message`  = '{$message}',
						 `num`      = '{$num}',
						 `img`      = '{$filename}',
						 `bilet`    = '{$bilet}',
						 `vopros`   = '{$vopros}'
					 WHERE `id` = {$quest_id} LIMIT 1") or die('error 7');
		
		if ( count($_POST['answer']) > 0 )
		{
			foreach ($_POST['answer'] as $ans => $val)
			{
				if ($val != '')
				{
					$answ   = $val;
					$ans_id = $ans;
			
					$ok     = 0;
					if ($ans_id == $_POST['ok'])
						$ok = 1;
						
					$db->query("UPDATE `pdd_answers` SET `name` = '{$answ}', `ok` = '{$ok}' WHERE `id` = '{$ans_id}'") or die('error 8');
				}
			}
		}
		
		if ( count($_POST['answer_new']) > 0 )
		{
			foreach ($_POST['answer_new'] as $ans2 => $val2)
			{
				if ($val2 != '')
				{
					$answ2 = $val2;
					
					$ok = 0;
					if ($_POST['ok'][$ans2] == 'on')
						$ok = 1;
						
					$db->query("INSERT INTO `pdd_answers` SET `name` = '{$answ2}', quest_id = '{$quest_id}', ok = '{$ok}'") or die('error 9');
				}
			}
		}
		
		echo 'вопрос отредактирован<br/><br/>';
		echo '<br/><a href="./index.php">На главную</a><br/>';
		echo '<a href="./quest_edit.php?topic_id='.$topic_id.'">Редактировать еще с этого раздела</a><br/>';
		echo '<a href="./quest_edit.php">Редактировать еще</a>';
		exit();
	}
	
	$query = $db->query("SELECT * FROM `pdd_question` WHERE `id` = {$quest_id} LIMIT 1") or die('error 10');
	$row   = $query->fetch(PDO::FETCH_ASSOC);
?>
	<a href="./index.php">Главная</a> &nbsp; <a href="./quest_edit.php">К выбору тем</a> &nbsp; <a href="./quest_edit.php?topic_id=<?php echo $topic_id;?>">К выбору вопросов</a><br/><br/>
	<form method="post">
		<input type="text" size="68" name="name" value="<?php echo htmlspecialchars(stripslashes($row['name']));?>" />
		<input type="text" size="10" name="num" value="<?php echo htmlspecialchars(stripslashes($row['num']));?>" />
		<br/><br/>
		<textarea cols="80" rows="5" name="message"><?php echo htmlspecialchars(stripslashes($row['message']));?></textarea><br/><br/>
		№ билета <input type="text" name="bilet" value="<?php echo intval($row['bilet']);?>" size="4"/> &nbsp; № вопроса <input type="text" name="vopros" value="<?php echo intval($row['vopros']);?>" size="4"/>
		<hr width="100%"/>
		<?php
			$j = 0;
			$answer_sql = $db->query("SELECT * FROM `pdd_answers` WHERE `quest_id` = {$quest_id}") or die('error 11');
			while ($answer = $answer_sql->fetch(PDO::FETCH_ASSOC))
			{
				$j++;
				echo '<input type="text" name="answer['.$answer['id'].']" size="40" value="'.htmlspecialchars(stripslashes($answer['name'])).'"/>';
				if ($answer['ok'] == 1)
					echo ' <input type="radio" name="ok" value="'.$answer['id'].'" checked="checked"/><br/>';
				else
					echo ' <input type="radio" name="ok" value="'.$answer['id'].'" /> <a href="?topic_id='.$topic_id.'&quest_id='.$quest_id.'&act=del&id_answer='.$answer['id'].'">удалить</a><br/>';
			}
			
			if ($j < 5)
				for($i=$j; $i<5; $i++)
					echo '<input type="text" name="answer_new['.$i.']" size="40"/> <input type="radio" name="ok['.$i.']"/><br/>';
		echo '<br/>';
		
		$img = '../img/' . $row['img'];
		if ( !empty($row['img']) and file_exists($img) )
		{
			echo '<img src="'.$img.'" align="middle" /> &nbsp; <a href="?topic_id='.$topic_id.'&quest_id='.$quest_id.'&act=delimg&pic='.$row['img'].'">Удалить</a><br/>';
		}
		else
		{
		?>
		<div id="upload"><img src="upload.png" alt=""/></div>
            <span id="status" ></span>
            <div id="files"></div>
		<?php } ?>
		<input type="hidden" name="filename" id="imgname" value="<?php echo $row['img'];?>"/>
		<br/><input type="submit" value="Готово"/>
	</form>
<?php include 'tpl_footer.php';?>