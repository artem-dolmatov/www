<?php
    $admin = true;
    include '../as_core.php';
    
    include 'templates/header.php';

    $id = intval($_GET['id']);
    $action = $_GET['action'];
    
    if ($action == 'add') {
        if ( !empty($_POST['title']) and !empty($_POST['alias']) ) {
            $db->query(pref("INSERT INTO `pref_info`
                             SET `title`       = '{$_POST['title']}',
                                 `keywords`    = '{$_POST['keywords']}',
                                 `description` = '{$_POST['description']}',
                                 `text`        = '{$_POST['text']}',
                                 `alias`       = '{$_POST['alias']}'"));
            redirect('./info.php');
        }
        echo '<form method="post">';
        echo "<table><tr><td width='100'>Заголовок</td>";
        echo "<td><input type='text' name='title' style='padding:5px 1px; width:550px; font-size:18px; margin-bottom:10px;'/></td></tr>";
        echo "<tr><td>Keywords:</td><td><input type='text' name='keywords' style='width:550px; margin-bottom:10px;'/></td></tr>";
        echo "<tr><td>Description:</td><td><input type='text' name='description' style='width:550px; margin-bottom:10px;'/></td><tr/>";
        echo "<tr><td>Alias*:</td><td><input type='text' name='alias' style='width:550px; margin-bottom:10px;'/></td></tr></table>";
        echo "<br/><textarea name='text' id='text'></textarea>";
        echo '<input type="submit" name="submit" value="Добавить страницу" style="padding:10px;float:left;margin-top:10px;"/><br clear="both"/>';
        echo '</form>';
    } elseif ($action == 'edit' and !empty($id)) {
        $infoq = $db->query(pref("SELECT * FROM `pref_info` WHERE id = '{$id}' LIMIT 1"));
        $info  = $infoq->fetch(PDO::FETCH_ASSOC);
        if ( !empty($_POST['title']) and !empty($_POST['alias']) ) {
            $db->query("UPDATE `as_info`
                        SET `title`       = '{$_POST['title']}',
                            `keywords`    = '{$_POST['keywords']}',
                            `description` = '{$_POST['description']}',
                            `text`        = '{$_POST['text']}',
                            `alias`       = '{$_POST['alias']}'
                        WHERE id = {$id}");
            redirect('./info.php');
        }
        echo '<form method="post">';
        echo "<table><tr><td width='100'>Заголовок</td>";
        echo "<td><input type='text' name='title' value='{$info['title']}' style='padding:5px 1px; width:550px; font-size:18px; margin-bottom:10px;'/></td></tr>";
        echo "<tr><td>Keywords:</td><td><input type='text' name='keywords' value='{$info['keywords']}' style='width:550px; margin-bottom:10px;'/></td></tr>";
        echo "<tr><td>Description:</td><td><input type='text' name='description' value='{$info['description']}' style='width:550px; margin-bottom:10px;'/></td><tr/>";
        echo "<tr><td>Alias*:</td><td><input type='text' name='alias' value='{$info['alias']}' style='width:550px; margin-bottom:10px;'/></td></tr></table>";
        echo "<br/><textarea name='text' id='text'>{$info['text']}</textarea>";
        echo '<input type="submit" name="submit" value="Готово" style="padding:10px;float:left;margin-top:10px;"/><br clear="both"/>';
        echo '</form>';
    } elseif ($action == 'delete' and !empty($id)) {
        $db->query(pref("DELETE FROM `pref_info` WHERE id = {$id} LIMIT 1"));
        redirect('./info.php');
    } else {
        echo '<div class="submenu"><a href="info.php?action=add">Добавить страницу</a></div>';
    
        echo '<table width="100%">';
        $infoq = $db->query(pref("SELECT * FROM `pref_info` ORDER BY id"));
        while ( $info = $infoq->fetch(PDO::FETCH_ASSOC) ) {
            echo '<tr>';
            echo "<td><a href='/info/{$info['alias']}'>{$info['title']}</a></td>";
            echo "<td width='100'><a href='info.php?action=edit&id={$info['id']}'>Редактировать</a>";
            echo "<td width='100' align='right'><a href='info.php?action=delete&id={$info['id']}' onclick=\"if (!confirm('Вы уверены что хотите это сделать ?')) return false;\">Удалить</a></td>";
            echo '</tr>';
        }
        echo '</table>';
    }
?>
    <script type="text/javascript" src="/templates/js/ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
    var editor = CKEDITOR.replace( 'text', {
        skin : 'v2',
        forcePasteAsPlainText : true,
        language : 'ru',
        entities : true,
        uiColor : '#FFFFFF',
        height: '250px'
    });
    </script>
<?php
    include 'templates/footer.php';