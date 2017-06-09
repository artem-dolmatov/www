<?php
    //ini_set('display_errors',1);
    //error_reporting(E_ALL);

    session_start();
    
    define('REGION', 72);
    
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'asru_as72.ru');
    define('DB_USER', 'asru_wp104');
    define('DB_PASS', 'ArtemD13');
    define('DB_PREF', 'as_');
    
    define('DB_TRUE', true); // включает и выключает работу бд
    
    $is_admin = $_SESSION['admin'];
    if ($admin and !$is_admin) exit('Вы не администратор <a href="/">Перейти на сайт</a>');
    
    $page_info = array();
    
    function connect_db() {
        global $db;
        
        if (DB_TRUE) {
            try {
                $db = new PDO ('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
            } catch ( PDOException $e ) {
                echo $e->getMessage();
            }
            $db->query ( 'SET NAMES utf8' );
        }
    }
    
    function pref($sql) {
        return str_replace('pref_', DB_PREF, $sql);
    }
    
    connect_db();
    
    function menu_check($item, $uri) {
        echo $item == $uri ? ' current' : '';
    }
    
    function addTitle($str) {
        global $page_info;
        $page_info['title'] = $str;
    }
    
    function addKeywords($str) {
        global $page_info;
        $page_info['keywords'] = $str;
    }
    
    function addDescription($str) {
        global $page_info;
        $page_info['description'] = $str;
    }
    
    function addCurrent($str) {
        global $page_info;
        $page_info['current'] = $str;
    }
    
    function getTitle() {
        global $page_info;
        echo isset($page_info['title']) ? $page_info['title'] : '';
    }
    
    function getKeywords() {
        global $page_info;
        echo isset($page_info['keywords']) ? $page_info['keywords'] : '';
    }
    
    function getDescription() {
        global $page_info;
        echo isset($page_info['description']) ? $page_info['description'] : '';
    }
    
    function getCurrent() {
        global $page_info;
        return isset($page_info['current']) ? $page_info['current'] : '';
    }
    
    function redirect($uri) {
        echo '<script type="text/javascript">location.replace("'.$uri.'");</script>';
        exit();
    }
    
    function criptPassword($password) {
        return md5( md5($password) . 'fdse');
    }
    
    function getPageText($alias) {
        global $db;
        
        $query = $db->query(pref("SELECT text FROM `pref_info`
                             WHERE alias = '{$alias}'
                             LIMIT 1"));
        $info = $query->fetch(PDO::FETCH_ASSOC);
        echo $info['text'];
    }
    
    function parse_bb_code($text) {
        $text = htmlspecialchars($text);
        
        $text=preg_replace("#(?<=\s|^|>)(http\:\/\/[^ \n\r]+)#i",'<noindex><a href="\\1" target="_blank" rel="nofollow">\\1</a></noindex>', $text);
        
        $text = nl2br($text);
        $text = preg_replace('/\[(\/?)(b|i|u|s)\s*\]/', "<$1$2>", $text);
    
        //$text = preg_replace('/\[code\]/', '<pre><code>', $text);
        //$text = preg_replace('/\[\/code\]/', '</code></pre>', $text);

        //$text = preg_replace('/\[(\/?)quote\]/', "<$1blockquote>", $text);
        //$text = preg_replace('/\[(\/?)quote(\s*=\s*([\'"]?)([^\'"]+)\3\s*)?\]/', "<$1blockquote>Цитата $4:<br>", $text);

        $text = preg_replace('/\[url\](?:http:\/\/)?([a-z0-9-.]+\.\w{2,4})\[\/url\]/', "<noindex><a href=\"http://$1\" target='_blank' rel='nofollow'>$1</a></noindex>", $text);
        
        //$text = preg_replace('/\[url\s?=\s?([\'"]?)(?:http:\/\/)?([a-z0-9-.]+\.\w{2,4})\1\](.*?)\[\/url\]/', "<noindex><a href=\"http://$2\" target=\"_blank\" rel=\"nofollow\">$3</a></noindex>", $text);

$search[0] = "#\[url\](.*?)\[/url\]#si";
$replace[0] = '<noindex><a href="\1" target="_blank" rel="nofollow">\1</a></noindex>';
$search[1] = "#\[url=([a-z]+?://){1}(.*?)\](.*?)\[/url\]#si";
$replace[1] = '<noindex><a href="http://\2" target="_blank" rel="nofollow">\3</a></noindex>';
$text = preg_replace($search, $replace, $text);



        $text = preg_replace('/\[img\s*\]([^\]\[]+)\[\/img\]/', "<img src='$1' alt=''/>", $text);
        $text = preg_replace('/\[img\s*=\s*([\'"]?)([^\'"\]]+)\1\]/', "<img src='$2' alt=''/>", $text);

$text = preg_replace_callback('#\[list\](.*)\[/list\]#Usi', 
 create_function('$matches', '
 $html = "<ul>\n";
 $list = explode("[*]", $matches[1]);
 array_shift($list);
 foreach ($list as $li) {
 $html .= "<li>" . trim($li) . "</li>\n";
 }
 return $html . "</ul>";
 ')
, $text);
        return $text;
    }
    
function human_plural_form($number, $titles=array('комментарий','комментария','комментариев')){
    $cases = array (2, 0, 1, 1, 1, 2);
    return $number." ".$titles[ ($number%100 >4 && $number%100< 20)? 2 : $cases[min($number%10, 5)] ];
}