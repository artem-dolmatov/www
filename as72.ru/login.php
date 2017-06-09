<?php
    include 'as_core.php';

    $ref = empty($_POST['ref']) ? '/' : $_POST['ref'];
    
    if ( !empty($_SESSION['user_id']) ) redirect($ref);

    if ( isset($_POST['submit']) ) {
        $err       = array();
        $login     = $_POST['login'];
        $password  = $_POST['password'];

        if ( empty($login) or empty($password) ) 
            $err[] = 'Введите логин и пароль';

        if ( count($err) == 0 ) {
            $password = criptPassword($password);

            $query = $db->query("SELECT id, usergroup FROM `as_user` 
                                 WHERE `login` = '{$login}' AND `password` = '{$password}' 
                                 LIMIT 1");
     
            if ( $query->rowCount() == 1 ) {
                $row = $query->fetch(PDO::FETCH_ASSOC);
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['admin']   = $row['usergroup'] == 3 ? true : false;                
                $_SESSION['as']      = $row['usergroup'] == 4 ? true : false;
                
                $db->query("UPDATE `as_user` SET `datelast` = NOW() WHERE id = {$row['id']} LIMIT 1");
            
                redirect($ref);
            } else {
                $err[] = 'Такой логин с паролем не найдены в базе данных';
            }
        }
    }

    addTitle('Вход для автошкол');
    
    $leftrow = true;

    include 'templates/header.php';
    ?>
    <form method="post">
    <?php 
        if ( count($err) > 0 )
            foreach ( $err as $error )
                echo '<b>'.$error.'</b><br/>';
    ?>
    <table>
        <tr>
            <td>Логин:</td>
            <td><input type="text" name="login" value="<?php echo $_POST['login'];?>" /></td>
        </tr>
        <tr>
            <td>Пароль:</td>
            <td><input type="password" name="password" /></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Войти" /></td>
        </tr>
    </table>
    <input type="hidden" name="ref" value="<?php echo $ref;?>"/>
</form>
<?php
    include 'templates/footer.php';