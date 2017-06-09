<?php
    exit('Закрыто администратором');
	ob_start();
	include '../config.php';
	
	include 'tpl_header.php';
	
	if (empty($_GET['topic_id']))
	{
		echo '<h2>Выберите раздел</h2>';
		$topic_sql = mysql_query("SELECT * FROM `pdd_topics` ORDER BY id") or die('error 1');
		while ($topic = mysql_fetch_assoc($topic_sql))
			echo '<a href="?topic_id='.$topic['id'].'">' . $topic['name'] . '</a><br/>';
		exit();
	}
	$topic_id = intval($_GET['topic_id']);
	if (empty($topic_id)) exit('error 2');
	
	if (!empty($_POST['name']))
	{		
		$name     = mysql_real_escape_string($_POST['name']);
		$message  = mysql_real_escape_string($_POST['message']);
		$num      = mysql_real_escape_string($_POST['num']);
		$filename = mysql_real_escape_string($_POST['filename']);
		$bilet    = intval($_POST['bilet']);
		$vopros   = intval($_POST['vopros']);
		
		mysql_query("INSERT INTO `pdd_question`
					 SET `topic_id` = '{$topic_id}',
						 `name`     = '{$name}',
						 `message`  = '{$message}',
						 `num`      = '{$num}',
						 `img`      = '{$filename}',
						 `bilet`    = '{$bilet}',
						 `vopros`   = '{$vopros}'") or die('error 7');
		
		$quest_id = mysql_insert_id();
		
		if ( count($_POST['answer_new']) > 0 )
		{
			foreach ($_POST['answer_new'] as $ans2 => $val2)
			{
				if ($val2 != '')
				{
					$answ2 = mysql_real_escape_string($val2);
					
					$ok = 0;
					if ($_POST['ok'][$ans2] == 'on')
						$ok = 1;
						
					mysql_query("INSERT INTO `pdd_answers` SET `name` = '{$answ2}', quest_id = '{$quest_id}', ok = '{$ok}'") or die('error 9');
				}
			}
		}
		
		echo 'вопрос добавлен<br/><br/>';
		echo '<br/><a href="./index.php">На главную</a><br/>';
		echo '<a href="./quest_add.php?topic_id='.$topic_id.'">Добавить еще в этот раздел</a><br/>';
		echo '<a href="./quest_add.php">Добавить еще</a>';
		exit();
	}
?>
	<a href="./index.php">Главная</a> &nbsp; <a href="./quest_add.php">К выбору тем</a><br/><br/>
	<form method="post">
	<?php
		$sql_t = mysql_query("SELECT name FROM `pdd_topics` WHERE id = '{$topic_id}' LIMIT 1") or die('error');
		$row_t = mysql_fetch_assoc($sql_t);
		echo 'Тема: ' . $row_t['name'] . '<br/>';
		
		$sql_countt = mysql_query("SELECT count(*) as count FROM `pdd_question` WHERE topic_id = '{$topic_id}'") or die('error');
		$row_countt = mysql_fetch_assoc($sql_countt);
		$count = $row_countt['count'] + 1;
	?>
		<input type="text" size="68" name="name" />
		<input type="text" size="10" name="num" value="<?php echo $count;?>" />
		<br/><br/>
		<textarea cols="80" rows="5" name="message"></textarea><br/><br/>
		№ билета <input type="text" name="bilet" value="" size="4"/> &nbsp; № вопроса <input type="text" name="vopros" value="" size="4"/>
		<hr width="100%"/>
		<?php
			for($i=1; $i<=5; $i++)
				echo '<input type="text" name="answer_new['.$i.']" size="40"/> <input type="radio" name="ok['.$i.']"/><br/>';
		?>
		<br/>
		<div id="upload"><img src="upload.png" alt=""/></div>
            <span id="status" ></span>
            <div id="files"></div>
		<input type="hidden" name="filename" id="imgname" value=""/>
		<br/><input type="submit" value="Готово"/>
	</form>
<?php include 'tpl_footer.php';?>