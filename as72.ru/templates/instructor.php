<?php
	include 'as_core.php';
    addDescription('');
    addKeywords('');
    addCurrent('instructor');
    addTitle('Инструктора по вождению');	
    	    
    $leftrow = true;

    $mobile = strpos($_SERVER['HTTP_USER_AGENT'],"Mobile");
    
    if ($mobile == true) {

	}
    
    include 'templates/header1.php';
    
    
  	echo '<div class="h2style">Последние <a href="/news/">новости и акции автошкол</a></div><br/>';
    
    	
    include 'templates/footer.php';	
?>