<?php    
    $id  = intval($_GET['id']);
    $go  = $_GET['go'];
    
    header('Location: '.$go);
    
    include 'as_core.php';
    
    if (!isset($_SESSION['go'.$id])) {
        $_SESSION['go'.$id] = true;
        $db->query("UPDATE `as_school` SET `gosite` = `gosite` + 1 WHERE `id_school` = {$id}"); 
        
        $statq = $db->query("SELECT * FROM as_statistics
                             WHERE date = '".date('Y-m-d')."' and id_project = {$id} and type = 0
                             LIMIT 1");
        if ($statq->rowCount()==1) {
            $db->query("UPDATE as_statistics SET transitions = transitions + 1
                        WHERE date = '".date('Y-m-d')."' and id_project = {$id} and type = 0
                        LIMIT 1");
        } else {
            $db->query("INSERT INTO as_statistics 
                        SET date = NOW(),
                            id_project = {$id},
                            type = 0,
                            transitions = 1");
        }
    }