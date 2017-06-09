<?php
    include 'as_core.php';
    
    $leftrow = false;
    
    $alias = $_GET['alias'];
    
    $infoq = $db->query(pref("SELECT * FROM `pref_info` WHERE alias = '{$alias}' LIMIT 1"));
    $count = $infoq->rowCount();
        
    if ( empty($alias) or $count == 0 ) {
        header('HTTP/1.1 404 Not Found');
        header('Status: 404 Not Found');
        header('Location: /404.php');
        exit;
        addTitle('Информационные страницы');
        addDescription('');
        addKeywords('');
    } else {
        $info = $infoq->fetch(PDO::FETCH_ASSOC); 
        addTitle($info['title']);
        addDescription($info['keywords']);
        addKeywords($info['description']);
    }
    
    include 'templates/header.php';

    if ( !empty($alias) and $count == 1 ) {
        echo $info['text'];
    } else {
        if ($count == 0) echo 'Страница не найдена';
        echo '<ul>';
        $infoq = $db->query(pref("SELECT * FROM `pref_info` ORDER BY id"));
        while ( $info = $infoq->fetch(PDO::FETCH_ASSOC) ) {
            echo "<li><a href='/info/{$info['alias']}'>{$info['title']}</a>";
        }
        echo '</li>';
    }

    include 'templates/footer.php';
?>