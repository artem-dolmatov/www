<?php
    include 'as_core.php';
    
    $where = '';
    
    if ($_POST['akpp']=='true') $where .= " and akpp = 1";
    if ($_POST['site']=='true') $where .= " and site != ''";
    if ($_POST['kata']=='true') $where .= " and category like 'A%'";
    if ($_POST['katb']=='true') $where .= " and category like '%B%'";
    if ($_POST['katc']=='true') $where .= " and category like '%C%'";
    if ($_POST['katd']=='true') $where .= " and category like '%D%'";
    if ($_POST['kate']=='true') $where .= " and category like '%E'";
    
    if ($_POST['girl']=='true')   $where .= " and girl = 1";
    if ($_POST['credit']=='true') $where .= " and credit = 1";
    if ($_POST['dayoff']=='true') $where .= " and dayoff = 1";
    if ($_POST['night']=='true')  $where .= " and night = 1";
    if ($_POST['recovery']=='true') $where .= " and recovery = 1";
    
    if ($_POST['vk']=='true') $where .= " and vk != ''";
	if ($_POST['email']=='true') $where .= " and email != ''";
	if ($_POST['icq']=='true') $where .= " and icq != ''";
    
    $schoolq = $db->query("SELECT * 
                        FROM `as_school`
                        WHERE name <> '' ".$where."
                        ORDER BY tariff DESC, name");
    
    $i = 1;
    echo '<div id="school_box">';
    while ($school = $schoolq->fetch(PDO::FETCH_ASSOC) ) {
        include 'templates/school.php';
    }
    echo '</div>';
?>