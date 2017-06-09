<?php
    include 'as_core.php';
    
    addTitle('Изменения на сайте');
    addDescription('');
    addKeywords('');
    addCurrent('index');
    
    $leftrow = false;
    
    include 'templates/header.php';
    $query = $db->query("SELECT as_school.name, as_school.alias, as_change.*, 
                  DATE_FORMAT(date, '%d.%m.%Y') as ddd, as_user.login
                  FROM as_change 
                  LEFT JOIN as_school ON as_change.school_id = as_school.id_school
                  LEFT JOIN as_user ON as_change.user_id = as_user.id
                  ORDER BY id DESC LIMIT 50");
?>
	<table width="100%" style="font-size:12px;" cellpadding="0" cellspacing="1">
		<?php while ($change = $query->fetch(PDO::FETCH_ASSOC)):?>
    	<tr <?php if($change['ddd']==date('d.m.Y')) echo 'style="background:#eee"';?>>
        	<td width="40"><?php echo $change['id'];?></td>
        	<td width="130"><?php echo $change['date'];?></td>
        	<td width="130"><a href="/school/<?php echo $change['alias'];?>"><?php echo $change['name'];?></a></td>
        	<td><?php echo $change['text'];?></td>
        
        	<?php if ($_SESSION['admin']):?>
        		<td><?php echo $change['login'];?></td>
        	<?php endif;?>
    	</tr>
<?php endwhile;?>
	</table>

<?php
	include 'templates/footer.php';
?>