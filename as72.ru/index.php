<?php
	include 'as_core.php';
    addTitle('Автошколы Тюмени');
    addDescription('');
    addKeywords('');
    addCurrent('index');
    //$page_info['h1'] = 'Все автошколы Тюмени на одном сайте!'; 	
    	    
    $leftrow = true;

    $mobile = strpos($_SERVER['HTTP_USER_AGENT'],"Mobile");
    
    if ($mobile == true) {

	}
    
    include 'templates/header.php';
    
    getPageText('index');
   
    $query = $db->query("SELECT as_news.*, DATE_FORMAT(as_news.date, '%d.%m.%Y') as datt, as_school.name, as_school.alias
    			FROM as_news LEFT JOIN as_school ON as_news.school_id = as_school.id_school 
    			ORDER BY id DESC
    			LIMIT 5");

  	
    	
    
    include 'templates/footer.php';	
    include 'templates/metric.php';
?>