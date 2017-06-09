<?php
    $admin = true;
    include '../as_core.php';
    
    include 'templates/header.php';

    $id = intval($_GET['id']);
    $action = $_GET['action'];
    
    if ($action == 'add') {
        if ( !empty($_POST['login']) and !empty($_POST['password']) ) {
            $password = criptPassword($_POST['password']);
            $db->query(pref("INSERT INTO `pref_user`
                             SET `login`       = '{$_POST['login']}',
                                 `password`    = '{$password}',
                                 `email` = '{$_POST['email']}',
                                 `datereg`        = NOW(),
                                 `usergroup`       = '{$_POST['usergroup']}'"));
            redirect('./users.php');
        }
        echo '<form method="post"><table>';
        echo '<tr><td width="200">Логин</td><td><input type="text" name="login"/></td></tr>';
        echo '<tr><td>Пароль</td><td><input type="text" name="password"/></td></tr>';
        echo '<tr><td>email</td><td><input type="text" name="email"/></td></tr>';
        echo '<tr><td><select name="usergroup"><option value="2">Пользователь</option><option value="3">Администратор</option><option value="4">Автошкола</option></select>';
        echo '<td><input type="submit" name="submit" value="Добавить"/></td></tr></table>';
        echo '</form>';
    } elseif ($action == 'edit' and !empty($id)) {
        $query = $db->query(pref("SELECT pref_user.*,pref_usergroup.name as namegroup
                                  FROM `pref_user` 
                                  LEFT JOIN pref_usergroup ON pref_user.usergroup = pref_usergroup.id
                                  WHERE pref_user.id = '{$id}' LIMIT 1"));
        $user  = $query->fetch(PDO::FETCH_ASSOC);
        if ( !empty($_POST['login']) ) {
            $db->query("UPDATE `as_user`
                        SET `login`     = '{$_POST['login']}',
                            `email`     = '{$_POST['email']}',
                            `usergroup` = '{$_POST['usergroup']}'
                        WHERE id = {$id}");
            redirect('./users.php');
        }
        if ( !empty($_POST['password'])) {
            $password = criptPassword($_POST['password']);
            $db->query("UPDATE `as_user`
                        SET `password`       = '{$password}'
                        WHERE id = {$id}");
            redirect('./users.php');
        }
        echo '<form method="post"><table>';
        echo '<tr><td width="200">Логин</td><td><input type="text" value="'.$user['login'].'" name="login"/></td></tr>';
        echo '<tr><td>email</td><td><input type="text" name="email" value="'.$user['email'].'"/></td></tr>';
        echo '<tr><td><select name="usergroup">';?>
            <option value="2" <?php if ($user['usergroup'] == 2) echo 'selected="selected"';?>>Пользователь</option>
            <option value="3" <?php if ($user['usergroup'] == 3) echo 'selected="selected"';?>>Администратор</option>
            <option value="4" <?php if ($user['usergroup'] == 4) echo 'selected="selected"';?>>Автошкола</option>
        <?php
        echo '</select>';
        echo '<td><input type="submit" name="submit" value="Сохранить"/></td></tr></table>';
        echo '</form>';
        echo '<br/><h1>Смена пароля</h1><form method="post">Введите новый пароль <input type="text" name="password"/> <input type="submit" name="passSubmit" value="Установить новый пароль"/>';
    } elseif ($action == 'delete' and !empty($id)) {
        $db->query(pref("DELETE FROM `pref_user` WHERE id = {$id} LIMIT 1"));
        redirect('./users.php');
    } else {
        echo '<div class="submenu"><a href="users.php?action=add">Добавить пользователя</a></div>';
    
        echo '<table width="100%">';
        $query = $db->query(pref("SELECT pref_user.*,pref_usergroup.name as namegroup
                                  FROM `pref_user` 
                                  LEFT JOIN pref_usergroup ON pref_user.usergroup = pref_usergroup.id
                                  ORDER BY id"));
        while ( $user = $query->fetch(PDO::FETCH_ASSOC) ) {
            echo '<tr>';
            echo "<td width='20'>{$user['id']}</td>";
            echo "<td>{$user['login']}</td>";
            echo "<td>{$user['email']}</td>";
            echo "<td>{$user['namegroup']}</td>";
            echo "<td width='100'><a href='users.php?action=edit&id={$user['id']}'>Редактировать</a>";
            echo "<td width='100' align='right'><a href='users.php?action=delete&id={$user['id']}' onclick=\"if (!confirm('Вы уверены что хотите это сделать ?')) return false;\">Удалить</a></td>";
            echo '</tr>';
        }
        echo '</table>';
    }

    include 'templates/footer.php';