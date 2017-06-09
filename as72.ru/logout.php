<?php
    session_start();
    
    $ref = empty($_SERVER['HTTP_REFERER']) ? '/' : $_SERVER['HTTP_REFERER'];
    
    unset( $_SESSION['user_id'] );
    unset( $_SESSION['admin'] );
    unset( $_SESSION['as'] );
    session_destroy();
    
    header('Location: ' . $ref);