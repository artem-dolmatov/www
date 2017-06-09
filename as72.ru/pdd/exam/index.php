<?php
    include_once '../../as_core.php';
    addTitle('Экзамен ПДД онлайн 2016');
    addDescription('');
    addKeywords('');
    addCurrent('exam');    
    $page_info['h1'] = '<a href="/pdd/exam/">Экзамен ПДД онлайн 2016</a>';
    $path = '../../';
    
    include '../../templates/header1.php';
    echo '<script src="/pdd/exam/js/my_form.js" type="text/javascript" charset="utf-8"></script>';
    echo '<script type="text/javascript">
  jQuery(document).ready(function(){ document.all.content.scrollIntoView(true); });</script>';
    echo '<link rel="stylesheet" type="text/css" href="style.css">';
    
    echo '<div id="box">';
    include 'topics.php';
    echo '</div> <!-- /box -->';

    include '../../templates/footer.php';
    include '../../templates/metric.php';
?>