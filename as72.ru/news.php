<?php
	include 'as_core.php';
    
	$id = intval($_GET['id']);
	addDescription('');
	addKeywords('Наборы, стоимость, ближайшие наборы в класс');
	addCurrent('news');
    
	$leftrow = true;
  		
	if (empty($id)) {
        addTitle('Наборы и акции автошкол');
        $query = $db->query("SELECT as_news.*, as_school.name, as_school.alias, DATE_FORMAT(as_news.date,'%d.%m.%Y') as date, DATE_FORMAT(as_news.date, '%d.%m.%Y') as datt
                            FROM as_news
                            LEFT JOIN as_school ON as_news.school_id = as_school.id_school
                            ORDER BY id DESC LIMIT 20");
                            
        include 'templates/header1.php';
        echo 'На этой странице размещено всего 20 последних новостей. Скорей всего остальные новости уже не акутальны. Но если вам интересно, то откройте страницу нужной автошколы и там будут показаны все ее новости.';
        while ($news = $query->fetch(PDO::FETCH_ASSOC)) {
            include 'templates/news.php';            
        	}
        include 'templates/footer2.php';
    } else {
        $query = $db->query("SELECT as_news.*, as_school.name, as_school.alias, as_school.logo, DATE_FORMAT(as_news.date,'%d.%m.%Y') as date
                            FROM as_news
                            LEFT JOIN as_school ON as_news.school_id = as_school.id_school
                            WHERE id = {$id} LIMIT 1");
        if ($query->rowCount() == 0){
            header('HTTP/1.1 404 Not Found');
            header('Status: 404 Not Found');
            header('Location: /404.php');
            exit();
        }        
        
        $news = $query->fetch(PDO::FETCH_ASSOC);
        addTitle($news['title'].' :: Автошкола '.$news['name']);
        $page_info['h1'] = $news['title'];
        
        include 'templates/header.php';
        echo '<a href="/news/">Новости</a> &rarr; <a href="/school/'.$news['alias'].'">Автошкола '.$news['name'].'</a> <br/><br/><div>'.parse_bb_code($news['news']).'</div><br/><div style="color:#555; font-size:12px;"> Опубликовано: '.$news['date'].'<br/>Пожалуйста, сообщите автошколе, что нашли акцию на нашем сайте.</div><br/>';
        if (!empty($news['logo'])) echo '<img src="/files/logo/'.$news['logo'].'" alt=""/>';
        include 'templates/footer2.php';
        
    }
    include 'templates/metric.php';
?>