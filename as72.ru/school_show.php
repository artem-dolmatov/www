<?php
	include 'as_core.php';

	$leftrow = false; // левая колонка отключена
	$alias   = $_GET['alias']; // идентификатор автошколы
	$act  = $_GET['act']; // управляющая переменная

/**
* Загрузка данных об автошколе
*/
	$schoolq = $db->query(pref("SELECT pref_school.*, pref_user.login FROM `pref_school`
								LEFT JOIN pref_user ON pref_school.director_id = pref_user.id
								WHERE alias = '{$alias}' LIMIT 1"));

	$count = $schoolq->rowCount();

	if ( empty($alias) or $count == 0 ) redirect('/school/');

	$school = $schoolq->fetch(PDO::FETCH_ASSOC);

	statistics();

/**
* Мета-теги, title, h1
*/
	addTitle('Автошкола "' . $school['name'] . '" Тюмень');
	addDescription("Автошкола {$school['name']} Тюмень, адреса и телефоны автошколы {$school['name']}, отзывы, стоимость обучения");
	addKeywords("Автошкола {$school['name']} Тюмень, Автошкола {$school['name']} отзывы, Автошкола {$school['name']} цены, Автошкола 			{$school['name']} стоимость");
	addCurrent('school');

	if (empty($act)) {
		$page_info['h1'] = '<a href="/school/">Автошколы Тюмени</a> &rarr; Автошкола '.$school['name'];
	} else {
		$page_info['h1'] = '<a href="/school/'.$school['alias'].'">Автошкола '.$school['name'].'</a>';
	}

/**
 * Модератор? Админ или директор автошколы - модератор
 */
    $moder = ($is_admin or (($school['director_id'] == $_SESSION['user_id'])
                            and !empty($school['director_id']))) ? true : false;


    if ($moder) {
        /**
         * Обработка редактирования до вывода шаблона на экран
         */
        if (isset($_POST['name'])) {
            $name     = $_POST['name'];   $address  = $_POST['address'];
            $phone    = $_POST['phone'];  $category = $_POST['category'];
            $site     = $_POST['site'];   $avto     = $_POST['avto'];
            $akpp     = $_POST['akpp'];   $girl     = $_POST['girl'];
            $text     = $_POST['text'];   $map      = $_POST['map'];
            $vk       = $_POST['vk'];     $icq      = $_POST['icq'];
            $skype    = $_POST['skype'];  $email    = $_POST['email'];
            $credit   = $_POST['credit']; $cost     = $_POST['cost'];
            $dayoff   = $_POST['dayoff']; $night    = $_POST['night'];
            $recovery = $_POST['recovery'];

            $oplata   = serialize($_POST['oplata']);
            $alias    = empty($_POST['alias']) ? $school['alias'] : $_POST['alias'];
            $tariff   = empty($_POST['tariff']) ? $school['tariff'] : $_POST['tariff'];
            if ($tariff == 100) $tariff = 0;

            if (empty($name))     exit('Введите название автошколы');
            if (empty($address))  exit('Введите адрес');
            if (empty($phone))    exit('Введите телефон');
            if (empty($category)) exit('Укажите категории');
            if (empty($alias))    exit('Введите алиас');

            $result = $db->prepare("UPDATE as_school
                                    SET name=?, alias=?, address=?, phone=?, site=?,
                                        category=?, avto=?, akpp=?, text=?, map=?,
                                        vk=?, tariff=?, girl=?, icq=?, skype=?,
                                        email=?, credit=?, cost=?, oplata=?, dayoff=?, night=?, recovery=?
                                    WHERE id_school={$school['id_school']}");

            $result->execute(array($name, $alias, $address, $phone, $site,
                                   $category, $avto, $akpp, $text, $map,
                                   $vk, $tariff, $girl, $icq, $skype,
                                   $email, $credit, $cost, $oplata, $dayoff, $night, $recovery));

            if ($name     != $school['name'])     changeSchool('Изменено название');
            if ($address  != $school['address'])  changeSchool('Изменен адрес');
            if ($phone    != $school['phone'])    changeSchool('Изменен телефон');
            if ($category != $school['category']) changeSchool('Изменена категория');
            if ($site     != $school['site'])     changeSchool('Изменен сайт');
            if ($vk       != $school['vk'])       changeSchool('Изменена группа ВКонтакте');
            if ($icq      != $school['icq'])      changeSchool('Изменен номер ICQ');
            if ($skype    != $school['skype'])    changeSchool('Изменен skype');
            if ($email    != $school['email'])    changeSchool('Изменен email');
            if ($avto     != $school['avto'])     changeSchool('Изменен автопарк');
            if ($text     != $school['text'])     changeSchool('Изменена информация о компании');
            if ($map      != $school['map'])      changeSchool('Изменена карта');
            if ($alias    != $school['alias'])    changeSchool('Изменен алиас');
            if ($tariff   != $school['tariff'])    changeSchool('Изменен тариф');
            if ($cost     != $school['cost'])     changeSchool('Обновлены цены');
            if (intval($akpp)  != $school['akpp'])    changeSchool('Появились автомобили с АКПП');
            if (intval($girl)  != $school['girl'])    changeSchool('Появились женщины инструкторы');
            if (intval($credit)!= $school['credit'])  changeSchool('Рассрочка платежа');
            if (intval($dayoff)   != $school['dayoff'])    changeSchool('Группы выходного дня');
            if (intval($recovery) != $school['recovery'])  changeSchool('Восстановление навыков вождения');
            if (intval($night)    != $school['night'])     changeSchool('Вечерние группы');

            exit('<b>Сохранено</b>');
        } elseif (!empty($_POST['title']) and isset($_POST['EditSchool'])){
            $db->query("UPDATE as_news
                        SET title    = '{$_POST['title']}',
                            news     = '{$_POST['newstext']}'
                        WHERE id = {$_POST['id']}") or die('Ошибка');
            exit('<b>Сохранено</b>');
        }
    }

    include 'templates/header.php';

    if ($moder) {
?>
    <script src="http://yandex.st/jquery/form/2.83/jquery.form.min.js"></script>
    <script type="text/javascript" src="/templates/js/bbeditor/ed.js"></script>
    <script type="text/javascript">
  jQuery(document).ready(function(){
  var options = {
        beforeSend: function() {
            $("#otvet").html("<img src='/templates/images/load.gif' alt=''/>");
        },
        success: function(msg) {
            $("#otvet").html(msg);
        }
    };
    $("#EditSchoolForm").ajaxForm(options);
    });
</script>
    <div class="cp">
        <a href="?act=edit">редактирвать</a> /
        <a href="?act=addphoto">фотографии</a> /
        <a href="?act=files">файлы</a> /
        <a href="?act=news">добавить новость</a> /
        <?php if ($_SESSION['admin']):?>
            <a href="?act=access">админ</a>
        <?php endif;?>
    </div>
<?php

    if ($act == 'edit') {
        /**
         * Редактирование основной информации
         */
        echo '<form method="post" id="EditSchoolForm">';
        echo 'Название автошколы<br/><input type="text" class="edit" name="name" value="'.htmlspecialchars($school['name']).'"/><br/>';

        if ($is_admin) {

            echo 'Алиас<br/><input type="text" class="edit" name="alias" value="'.$school['alias'].'"/><br/>';
            echo 'Тариф<br/><select name="tariff" class="edit">';
            echo '<option value="100">Никакой</option>';
            if ($school['tariff']==1) {
                echo '<option value="1" selected="selected">Бесплатный</option>';
            } else {
                echo '<option value="1">Бесплатный</option>';
            }
            if ($school['tariff']==2) {
                echo '<option value="2" selected="selected">Платный</option>';
            } else {
                echo '<option value="2">Платный</option>';
            }
            echo '</select><br/>';
        }

        echo 'Адрес<br/><input type="text" class="edit" name="address" value="'.htmlspecialchars($school['address']).'"/><br/>';
        echo 'Ссылка на карту <a target="_blank" href="http://maps.2gis.ru/tyumen/#center/65.572065,57.125994/zoom/7/query/search/criteria/firm/name/автошкола%20'.$school['name'].'/where/Тюмень/">получить ссылку</a><br/>';
        echo '<input type="text" class="edit" name="map" value="'.htmlspecialchars($school['map']).'"/><br/>';
        echo 'Телефоны<br/><input type="text" class="edit" name="phone" value="'.htmlspecialchars($school['phone']).'"/><br/>';
        echo 'Веб-сайт<br/><input type="text" class="edit" name="site" value="'.htmlspecialchars($school['site']).'"/><br/>';
        echo 'Группа <a href="http://vk.com">ВКонтакте</a><br/><input type="text" class="edit" name="vk" value="'.htmlspecialchars($school['vk']).'"/><br/>';
        echo 'ICQ<br/><input type="text" class="edit" name="icq" value="'.htmlspecialchars($school['icq']).'"/><br/>';
        echo 'Skype<br/><input type="text" class="edit" name="skype" value="'.htmlspecialchars($school['skype']).'"/><br/>';
        echo 'e-mail<br/><input type="text" class="edit" name="email" value="'.htmlspecialchars($school['email']).'"/><br/>';
        echo 'Категории<br/><input type="text" class="edit" name="category" value="'.htmlspecialchars($school['category']).'"/><br/>';
        echo 'Автопарк<br/><input type="text" class="edit" name="avto" value="'.htmlspecialchars($school['avto']).'"/><br/>';
        ?>
        <label><input type="checkbox" name="akpp" value="1" <?php if ($school['akpp']==1) echo 'checked="checked"';?>/> <img src="/templates/images/akpp.png" alt="" width="16" height="16" align="middle"/> Имеются автомобили с АКПП</label><br/>
        <label><input type="checkbox" name="girl" value="1" <?php if ($school['girl']==1) echo 'checked="checked"';?>/> <img src="/templates/images/girl.png" alt="" width="16" height="16" align="middle"/> Есть женщины инструкторы</label><br/>
        <label><input type="checkbox" name="credit" value="1" <?php if ($school['credit']==1) echo 'checked="checked"';?>/> <img src="/templates/images/credit.png" alt="" width="16" height="16" align="middle"/> Есть рассрочка платежа</label><br/>
        <label><input type="checkbox" name="dayoff" value="1" <?php if ($school['dayoff']==1) echo 'checked="checked"';?>/> <img src="/templates/images/dayoff.png" alt="" width="16" height="16" align="middle"/> Есть группы выходного дня</label><br/>
        <label><input type="checkbox" name="night" value="1" <?php if ($school['night']==1) echo 'checked="checked"';?>/> <img src="/templates/images/night.png" alt="" width="16" height="16" align="middle"/> Есть вечерние группы</label><br/>
        <label><input type="checkbox" name="recovery" value="1" <?php if ($school['recovery']==1) echo 'checked="checked"';?>/> <img src="/templates/images/recovery.png" alt="" width="16" height="16" align="middle"/> Восстановление навыков вождения</label><br/>
        <br/>
        <b>Варианты оплаты:</b><br/>
        <?php
            $opl = array();
            if (!empty($school['oplata'])) $opl = unserialize($school['oplata']);
        ?>
        <label><input type="checkbox" name="oplata[]" value="nal" <?php echo 'checked="checked"';?>/> <img src="/templates/images/cash.png" alt="" width="16" height="16" align="middle"/> Наличный расчет</label>
        <br/>
        <label><input type="checkbox" name="oplata[]" value="beznal" <?php if (in_array('beznal', $opl)) echo 'checked="checked"';?>/> <img src="/templates/images/beznal.png" alt="" width="16" height="16" align="middle"/> Безналичный расчет</label>
        <br/>
        <label><input type="checkbox" name="oplata[]" value="mcard" <?php if (in_array('mcard', $opl)) echo 'checked="checked"';?>/> <img src="/templates/images/mcard.gif" alt="" width="16" height="16" align="middle"/> MasterCard</label>
        <br/>
        <label><input type="checkbox" name="oplata[]" value="visa" <?php if (in_array('visa', $opl)) echo 'checked="checked"';?>/> <img src="/templates/images/visa.jpeg" alt="" width="16" height="16" align="middle"/> Visa</label>
        <br/>

        <br/>
        <?php
        echo "О компании<br/><script>edToolbar('text'); </script>";
        echo '<textarea class="edit" rows="7" id="text" name="text">'.htmlspecialchars($school['text']).'</textarea><br/>';
        echo "Цены и скидки<br/><script>edToolbar('cost'); </script>";
        echo '<textarea class="edit ed" id="cost" name="cost">'.htmlspecialchars($school['cost']).'</textarea><br/>';
        echo '<input type="submit" name="EditSchool" value="Сохранить" class="edit"/> <span id="otvet"></span>';
        echo '</form>';
    } elseif ($act == 'delete' and $is_admin) {
        $db->query("DELETE FROM as_school WHERE id_school = {$school['id_school']}");
        redirect('/school/');
    } elseif ($act == 'filial' and $is_admin) {
        if (!empty($_POST['address_filial'])) {
            $db->query("INSERT INTO as_filial
                        SET school_id     = '{$school['id_school']}',
                            address       = '{$_POST['address_filial']}'");
            $lastinsert = $db->lastinsertid();
            redirect('?act=filial&editID='.$lastinsert);
        }
?>

        <h1>Адреса и филиалы автошколы</h1>

<?php
        $query = $db->query("SELECT * FROM as_filial WHERE school_id = ".$school['id_school']);
        echo '<table width="100%">';
        while ($f = $query->fetch(PDO::FETCH_ASSOC)){
            echo '<tr><td>'.$f['address'].'</td>';
            echo '<td width="150"><a href="">Редактировать</a></td>';
            echo '<td width="100"><a href="">Удалить</a></td></tr>';
        }
        echo '</table>';
?>
        <br/>
        <form method="post">
            <b>Введите адрес филиала</b> <input type="text" name="address_filial"/>
            <input type="submit" name="submit_filial" value="Добавить"/>
        </form>
<?php
    } elseif ($act == 'deleteimg' and intval($_GET['id']) and $_GET['name']) {
        $id = intval($_GET['id']);
        $db->query("DELETE FROM as_photos WHERE id = {$id}") or die('Ошибка');
        unlink('photo/original/'.$_GET['name']);
        unlink('photo/big/'.$_GET['name']);
        unlink('photo/small/'.$_GET['name']);
        redirect('/school/'.$school['alias']);
    } elseif ($act == 'access' and $is_admin) {
        if ( !empty($_POST['login']) and !empty($_POST['password']) ) {
            $password = criptPassword($_POST['password']);
            $db->query(pref("INSERT INTO `pref_user`
                             SET `login`     = '{$_POST['login']}',
                                 `password`  = '{$password}',
                                 `email`     = '{$_POST['email']}',
                                 `datereg`   = NOW(),
                                 `usergroup` = 4"));
            $lastid = $db->lastinsertid();
            $db->query("UPDATE as_school
                        SET director_id = '{$lastid}'
                        WHERE id_school = ".$school['id_school']);
            redirect('/school/'.$school['alias']);
        } elseif (!empty($_POST['usersdir'])) {
            $db->query("UPDATE as_school
                        SET director_id = '{$_POST['usersdir']}'
                        WHERE id_school = ".$school['id_school']);
            redirect('/school/'.$school['alias']);
        } elseif (!empty($_GET['bust'])) {
            $db->query("UPDATE as_school
                        SET director_id = 0
                        WHERE id_school = ".$school['id_school']);
            redirect('/school/'.$school['alias'].'?act=access');
        }

        if (empty($school['login'])) {
            $query = $db->query("SELECT * FROM as_user WHERE usergroup = 4");
            echo '<h1>Добавить модератора автошколы</h1>';
            echo '<form method="post"><table>';
            echo '<tr><td width="200">Логин</td><td><input type="text" name="login"/></td></tr>';
            echo '<tr><td>Пароль</td><td><input type="text" name="password"/></td></tr>';
            echo '<tr><td>email</td><td><input type="text" name="email"/></td></tr>';
            echo '<td><input type="submit" name="submit" value="Добавить"/></td></tr></table>';
            echo '</form><br/>';

            if ($query->rowCount() > 0) {
                echo '<h1>Выбрать модератора</h1>';

                echo '<form method="post"><select name="usersdir" style="width:200px">';
                while ($dirarray = $query->fetch(PDO::FETCH_ASSOC)){
                    echo "<option value='{$dirarray['id']}'>{$dirarray['login']}</option>";
                }
                echo '</select> &nbsp; <input type="submit" name="submit" value="Добавить"/>';
                echo '</form>';
            }
        } else {
            echo 'Управляет этой автошколой: '.$school['login'];
            echo ' <a href="?act=access&bust=1" onclick="if (!confirm(\'Вы уверены что хотите это сделать ?\')) return false;">Разжаловать</a>';
        }

        echo '<br/><a href="?act=delete" onclick="if (!confirm(\'Вы уверены что хотите это сделать ?\')) return false;"><b>Удалить автошколу</b></a>';
    } elseif($act == 'news') {
        if (!empty($_POST['title']) and !empty($_POST['newstext2'])) {
            $db->query("INSERT INTO as_news
                        SET title     = '{$_POST['title']}',
                            news      = '{$_POST['newstext2']}',
                            school_id = '{$school['id_school']}',
                            date = NOW()");
            $lastinsert = $db->lastinsertid();
            redirect('/news/'.$lastinsert);
        }
        if ($_GET['go'] == 'edit' and !empty($_GET['id'])) {
            //редактирование
            $query = $db->query("SELECT * FROM as_news WHERE id = {$_GET['id']} LIMIT 1");
            $news = $query->fetch(PDO::FETCH_ASSOC);
            echo '<h1>Редактирование новости</h1>';
            echo '<form method="post" id="EditSchoolForm">';
            echo 'Заголовок (максимум 55 символов)<br/><input type="text" maxlength="55" name="title" class="edit" value="'.htmlspecialchars($news['title']).'"/><br/>';
            ?><script>edToolbar('newstext'); </script>
            <?php
            echo '<textarea class="edit" rows="7" name="newstext" id="newstext">'.htmlspecialchars($news['news']).'</textarea>';
            echo '<input type="hidden" name="id" value="'.$news['id'].'"/>';
            echo '<input type="submit" name="EditSchool" value="Сохранить" class="edit"/> <span id="otvet"></span>';
            echo '</form>';
        } elseif ($_GET['go'] == 'delete' and !empty($_GET['id'])) {
            $db->query("DELETE FROM as_news WHERE id = {$_GET['id']}");
            redirect('/school/'.$school['alias']);
        } else {
            echo '<h1>Добавление новости или акции</h1>';
            echo '<form method="post">';
            echo 'Заголовок (максимум 55 символов)<br/><input type="text" maxlength="55" name="title" class="edit" value="'.$_POST['title'].'"/><br/>';
            ?><script>edToolbar('newstext2'); </script>
            <?php
            echo '<textarea class="edit" rows="10" name="newstext2" id="newstext2">'.$_POST['newtext2'].'</textarea><br/>';
            echo '<input type="submit" value="Добавить" class="edit"/>';
            echo '</form>';
        }
    } elseif($act == 'files') {
        if (isset($_GET['del'])) {
            deleteFile($_GET['del']);
        }
        uploadFile('sertif');
        uploadFile('logo');
        echo '<form method="post" enctype="multipart/form-data">';
        echo '<br/><b>Лицензия:</b> <input type="file" name="sertif"/> <input type="submit" value="Добавить"/>';
        fileDelLink('sertif');
        echo '</form>';
        if ($is_admin) {
            echo '<form method="post" enctype="multipart/form-data">';
            echo '<br/><b>Логотип:</b> <input type="file" name="logo"/> <input type="submit" value="Загрузить"/>';
            fileDelLink('logo');
        }
        echo '</form>';
    } elseif ($act == 'addphoto') {
        echo 'На Вашем тарифе можно загрузить только 6 фотографий<br/>';

        $query = $db->query("SELECT * FROM as_photos WHERE school_id = {$school['id_school']}");
        $countimg = 6-$query->rowCount();
        echo 'Вы можете загрузить еще '.$countimg.' фото<br/><br/>';

        if ( !empty($_FILES['photo']['name']) ) {
            include 'image_resize.php';

            $uploaddir       = 'photo/original/';
            $uploaddir_big   = 'photo/big/';
            $uploaddir_small = 'photo/small/';

            if ( !file_exists($uploaddir) ) @mkdir($uploaddir, 0777);
            if ( !file_exists($uploaddir_big) ) @mkdir($uploaddir, 0777);
            if ( !file_exists($uploaddir_small) ) @mkdir($uploaddir_small, 0777);

            $ext        = substr(strrchr($_FILES['photo']['name'],'.'), 0); // расширение
            $namefile   = gen_name() . $ext;
            $file       = $uploaddir . $namefile;
            $file_big   = $uploaddir_big . $namefile;
            $file_small = $uploaddir_small . $namefile;

            if (move_uploaded_file($_FILES['photo']['tmp_name'], $file)) {
                img_resize($file, $file_small, 100, 100, 0); // маленькая картинка

                list($width, $height, $type, $attr) = getimagesize($file);
                $max = 1000;

                if ($width > $height) {
                    $dif    = $width / $max;
                    $width  = $max;
                    $height = $height / $dif;
                } else {
                    $dif    = $height / $max;
                    $height = $max;
                    $width  = $width / $dif;
                }

                img_resize($file, $file_big, $width, $height, 1);

                $db->query("INSERT INTO as_photos
                                SET name      = '{$namefile}',
                                    school_id = '{$school['id_school']}'");

                redirect('/school/'.$school['alias']);
            } else {
                echo 'Не могу загрузить фото. Обратитесь к администратору<br/>';
            }
        }

        if ($countimg > 0) {
            echo '<form method="post" enctype="multipart/form-data">';
            echo 'Фото: <input type="file" name="photo"/> <input type="submit" name="addphoto" value="Добавить"/>';
            echo '</form>';
        } else {
            echo 'Ваш лимит фотографий исчерпан, чтобы загрузить новые фотографии Вы можете удалить старые фото или поменять тариф';
        }
    }
    }

    if (empty($act)) {
        echo '<div class="zagolok">';
        echo '<div class="bigh1">Автошкола '.$school['name'].'</div>';
        echo '<div class="contactinfo">';
?>
<div class="tabs">
        <ul class="menuschool">
            <li class="current"><a href="#contacts">Главная</a></li>
            <li><a href="#about">О компании</a></li>
            <li><!--<a href="#price">Цены</a></li>
        <?php
        $querynew = $db->query("SELECT *, DATE_FORMAT(as_news.date, '%d.%m.%Y') as datt, DATE_FORMAT(date, '%d.%m.%Y') as date FROM as_news WHERE school_id = {$school['id_school']} ORDER BY id DESC");
        $countnew = $querynew->rowCount();
        if ($countnew > 0 ) {
        ?>
            <li><a href="#news">Новости (<?php echo $countnew;?>)</a></li>
        <?php } ?>
            <!--<li><a href="#collective">Коллектив</a></li>-->
        </ul>

        <div id="contacts">
            <table width="100%" cellspacing="0" cellpadding="0">
            <tr><td width="220" align="left" valign="top">

<?php


            if (!empty($school['logo'])) {
                $filename = 'files/logo/'.$school['logo'];
                if (file_exists($filename)) {
                    echo '<img src="/'.$filename.'" width="200" style="border:3px solid #d7d7d7;" class="around" alt=""/>';
                } else echo '<img src="/templates/images/logoschool.jpg" style="border:3px solid #d7d7d7;" width="200" alt=""/>';
            } else echo '<img src="/templates/images/logoschool.jpg" style="border:3px solid #d7d7d7;" width="200" alt=""/>';





        $statq = $db->query("SELECT sum(views) as sum_views, sum(transitions) as sum_gosite
                             FROM as_statistics
                             WHERE date > '".date('Y-m-d',time()-60*60*24*7)."' and
                                   id_project = {$school['id_school']} and type = 0");

        $stat = $statq->fetch(PDO::FETCH_ASSOC);
        echo '<div style="overflow:hidden; border:1px solid #fff; background:#f7f7f7; padding:5px; margin-right:14px;" class="around">Статистика за 7 дней:<br clear="both"/>';
        echo '<div style="float:left; padding:5px 10px; margin-right:3px; background:#f27917; font-size:11px; color:#fff;" class="around">'.human_plural_form($stat['sum_views'],array('просмотр','просмотра','просмотров')).'</div>';
        if (!empty($school['site'])) {
            echo '<div style="float:left; padding:5px 10px; background:#a3b4c3; font-size:11px; color:#fff;" class="around" title="Переходов на сайт автошколы">'.human_plural_form($stat['sum_gosite'],array('переход','перехода','переходов')).'</div>';
        }
        echo '</div>';
    if ($is_admin) {
            }

    ?>
            </td><td valign="top">
<?php
        echo '<b>Адреса и телефоны</b> ';
        if (!empty($school['map'])) echo ' (<a href="'.$school['map'].'" target="_blank" class="map">посмотреть на карте</a>)';
        echo '<br/>';
        echo '<br/>';
        echo '<div style="font-family:TimesNewRoman; font-size:22px; text-align:center; font-weight:bold;">Единая справочная 8(3452) 61-35-96</div>';
        echo '<br/>';

									$address = $school['address'];
									$ThisStrLen = strlen($address);
									$fcount = 1;

									for ($i=0; $i<$ThisStrLen; $i++)
										if ($address[$i] == ";") $fcount++;

									$faddressfirst = array();
									$faddresslast = array();
									$faddress = array();

									for ($i=0; $i<$ThisStrLen - 3; $i++) {
										$j = $i + 5;
										if ($address[$i] == " " and $address[$j] == ".") $faddressfirst[] = $i;
									}

									for ($i=1; $i<$ThisStrLen; $i++)
										if ($address[$i] == ";") $faddresslast[] = $i;
									$faddresslast[] = $ThisStrLen;

									for ($i=0; $i<$fcount; $i++) {
										$s = "";
										for ($j=$faddressfirst[$i]; $j<$faddresslast[$i]; $j++) $s = $s.$address[$j];
										$faddress[] = $s;
									}


									$phone = $school['___'];
									$ThisStrLen = strlen($phone);

									$fphonefirst = array();
									$fphonelast = array();
									$fphone = array();
									$pcount = array();

									$fpcount = 0;

									for ($i=0; $i<$ThisStrLen; $i++)
										if ($phone[$i] == ";" or $phone[$i] == ",") $fpcount++;

									for ($i=0; $i<$ThisStrLen; $i++) {
										if ($phone[$i] == ")" or $phone[$i] == ";") $fphonefirst[] = $i;
									}

									for ($i=1; $i<$ThisStrLen; $i++)
										if ($phone[$i] == ";") $fphonelast[] = $i;
									$fphonelast[] = $ThisStrLen;

									for ($i=0; $i<$fcount; $i++) {
										$ppcount = 1;
										for ($j=$fphonefirst[$i]; $j<$fphonelast[$i]; $j++)
											if ($phone[$j] == ",") $ppcount++;
										$pcount[$i] = $ppcount;
									}

									Unset($fphonefirst);
									for ($i=0; $i<$ThisStrLen - 3; $i++) {
										$j = $i + 3;
										$k = $i + 2;
										if (($phone[$i] == " " and $phone[$j] == "-") or ($phone[$i] == " " and $phone[$k] == " ")) $fphonefirst[] = $i;
									}

									Unset($fphonelast);
									for ($i=1; $i<$ThisStrLen; $i++)
										if ($phone[$i] == ";" or $phone[$i] == ",") $fphonelast[] = $i;
									$fphonelast[] = $ThisStrLen;

									$k = 0;
									for ($i=0; $i<$fcount; $i++) {
										for ($j=0; $j<$pcount[$i]; $j++) {
											$s = "";
											for ($p=$fphonefirst[$k]; $p<$fphonelast[$k]; $p++) $s=$s.$phone[$p];
											$k++;
											$fphone[] = $s;
										}
									}
		$k = 0;
		for ($i=0; $i<$fcount; $i++) {
			echo '<b>г. Тюмень, '.$faddress[$i].'</b><br/>';
			if ($fpcount > 0) {
				for ($j=0; $j<$pcount[$i]; $j++) {
					echo '<strong><img alt="" src="http://cs302209.userapi.com/v302209340/2b3e/YE5Pppaq7ys.jpg" style="width: 16px; height: 16px; padding-top: 3px; margin-left: 20px;" />&nbsp;&nbsp;</strong>';
					if (strlen($fphone[$k]) == 9) {
 						echo '8 (3452)'.$fphone[$k];
 					} else {
	 					echo $fphone[$k];
	 				}
	 				$k++;
	 				echo '<br/>';
				}
			} else {
				echo '<!--<strong><img alt="" src="http://cs302209.userapi.com/v302209340/2b3e/YE5Pppaq7ys.jpg" style="width: 16px; height: 16px; padding-top: 3px; margin-left: 20px;" />&nbsp;&nbsp;</strong>--!>';
				if (strlen($fphone[0]) == 9) {
 					echo '8 (3452)'.$fphone[0];
 				} else {
 					echo $fphone[0];
 				}
 				echo '<br/>';
			}
		}
        if (!empty($school['']) or !empty($school['vk'])) echo '<!--<strong><img alt="" src="http://cs302210.userapi.com/v302210340/27cd/lRpFgNJ64XA.jpg" style="width: 16px; height: 16px; padding-top: 3px;" />--!>&nbsp;&nbsp;</strong><noindex>';
        if (!empty($school[''])) echo '<a href="/out.php?id='.$school['id_school'].'&go='.$school['site'].'" target="_blank" rel="nofollow">' . $school['site'] . '</a>';
        if (!empty($school['']) and !empty($school['vk'])) echo ', ';
        if (!empty($school[''])) echo '<a href="'.$school['vk'].'" target="_blank" rel="nofollow">группа ВКонтакте</a>';
        echo '</noindex>';
        if (!empty($school[''])) echo '<br/>icq: '.$school['icq'];
        if (!empty($school[''])) echo '<br/>skype: <a href="skype:'.$school['skype'].'" rel="nofollow">'.$school['skype'].'</a>';
        if (!empty($school[''])) echo '<br/><strong><img alt="" src="http://cs302209.userapi.com/v302209340/2b53/nJo_ZI3X8Io.jpg" style="width: 16px; height: 12px;" />&nbsp;&nbsp;</strong><a href="mailto:'.$school['email'].'" rel="nofollow">'.$school['email'].'</a>';
        ?>
            </td></tr></table>
        </div><!--/contacts -->
        <div id="about">
            <?php
            if (!empty($school['text'])) echo parse_bb_code($school['text']).'<br/><br/>';

            if (!empty($school['category'])) echo 'В автошколе '.$school['name']. ' учат на <strong>категории: ' . $school['category'] . '</strong><br/>';
        if (!empty($school['avto'])) echo '<strong>Автопарк</strong>: '.$school['avto'] . '<br/>';
        if ($school['akpp']==1) echo '<br/><img src="/templates/images/akpp.png" width="16" height="16" align="middle" alt="" /> <strong>Есть автомобили с АКПП</strong> &nbsp; &nbsp; &nbsp;';
        if ($school['girl']==1) echo '<img src="/templates/images/girl.png" width="16" height="16" align="middle" alt="" /> <strong>Есть женщины инструкторы!</strong><br/>';
        if ($school['dayoff']==1) echo '<img src="/templates/images/dayoff.png" width="16" height="16" align="middle" alt="" /> <strong>Есть группы выходного дня</strong><br/>';
        if ($school['night']==1) echo '<img src="/templates/images/night.png" width="16" height="16" align="middle" alt="" /> <strong>Есть вечерние группы</strong><br/>';
        if ($school['recovery']==1) echo '<img src="/templates/images/recovery.png" width="16" height="16" align="middle" alt="" /> <strong>Восстановление навыков вождения (для тех, у кого уже есть права)</strong><br/>';
            ?>
        </div><!-- /price -->
        <div id="price">
            <?php echo '<div>'.parse_bb_code($school['cost']).'</div>';
            if ($school['credit']==1) echo '<br/><div><img src="/templates/images/credit.png" width="16" height="16" align="middle" alt="" /> <strong>Рассрочка платежа</strong></div>';


            ?>

        <br/><b>Варианты оплаты:</b><br/>
        <?php
        $opl = array();
        if (!empty($school['oplata'])) $opl = unserialize($school['oplata']);

        echo '<img src="/templates/images/cash.png" alt="" width="16" height="16" align="middle"/> Наличный расчет<br/>';

        if (in_array('beznal', $opl))
            echo '<img src="/templates/images/beznal.png" alt="" width="16" height="16" align="middle"/> Безналичный расчет
        <br/>';

        if (in_array('mcard', $opl))
            echo '<img src="/templates/images/mcard.png" alt="" width="16" height="16" align="middle"/> MasterCard
        <br/>';

        if (in_array('visa', $opl))
            echo '<img src="/templates/images/visa.png" alt="" width="16" height="16" align="middle"/> Visa';
        ?>
        </div><!-- /price -->
        <div id="news">
            <?php
        if ($countnew > 0) {
            while ($news = $querynew->fetch(PDO::FETCH_ASSOC)) {
                include 'templates/news_about.php';
            }
        }
        ?>
        </div><!-- /news -->
        <?php
        echo '</div><!-- /tabs -->';
        echo '</div><!-- /contactinfo -->';
        echo '</div><!-- /zagolok -->';
        if (!empty($school['price']) or !empty($school['schedule']) or !empty($school['sertif'])) {
            echo '<div class="files">';
            if (!empty($school['sertif'])) {
                $filename = 'files/sertif/'.$school['sertif'];
                if (file_exists($filename)) {
                    echo '<a href="/'.$filename.'" class="sertif">Лицензия<span>'.date ("d.m.Y", filemtime($filename)).'</span></a>';
                }
            }
            echo '</div>';
        }

        $query = $db->query('SELECT id,name FROM as_photos WHERE school_id = '.$school['id_school']);

        $i=0;
        if ($query->rowCount() > 0) {
            echo '<div class="photos">';
            while ($photos = $query->fetch(PDO::FETCH_ASSOC)) {
                $i++;
                echo '<div>';
                echo '<a href="/photo/big/'.$photos['name'].'" class="img"><img src="/photo/small/'.$photos['name'].'" title="Автошкола '.$school['name'].'" alt="Автошкола '.$school['name'].'"/></a>';
                if ($moder) {
                    echo '<a href="?act=deleteimg&id='.$photos['id'].'&name='.$photos['name'].'" onclick="if (!confirm(\'Вы уверены что хотите это сделать ?\')) return false;">Удалить</a>';
                }
                echo '</div>';
            }
            if (($i < 6) and $moder) {
                echo '<div><a href="?act=addphoto"><img src="/photo/add.jpg"/></a></div>';
            }
            echo '</div><br/>';
        }


        echo '<div style="font-size:12px; text-align:center; margin-top:10px;">';
        if ($school['tariff'] != 0) {
            echo 'Этой страницей управляет автошкола! <br/>А это значит, что вы владеете самой актуальной и достоверной информацией из первых рук!';
        } else {
            echo 'Вы владелец автошколы '.$school['name'].'? Чтобы управлять этой страницей, просто <a href="/info/contact">свяжитесь с нами</a><br/>';
            echo '<a href="/info/tariff">узнать подробнее</a>';
        }
        echo '<br/><strong>Пожалуйста, сообщите автошколе '.$school['name'].', что нашли ее на нашем сайте. Спасибо ;)</strong>';
        echo '</div>';

    }

    include 'templates/footer-school.php';

    function changeSchool($str) {
        global $db, $school;

        $db->query("INSERT INTO as_change
                    SET school_id = {$school['id_school']},
                        date = NOW(),
                        text = '{$str}',
                        user_id = {$_SESSION['user_id']}");
    }

    function uploadFile($typename) {
        global $db, $school;

        if ( !empty($_FILES[$typename]['name']) ) {
            $uploaddir = 'files/'.$typename.'/';
            if ( !file_exists($uploaddir) ) @mkdir($uploaddir, 0777);
            $ext        = substr(strrchr($_FILES[$typename]['name'],'.'), 0); // расширение
            $namef = $school['alias'] . $ext;
            $namefile   = $uploaddir . $namef;
            if (move_uploaded_file($_FILES[$typename]['tmp_name'], $namefile)) {
                $db->query("UPDATE as_school SET {$typename} = '{$namef}' WHERE id_school = {$school['id_school']}");
                changeSchool('Добавлен новый файл');
                redirect('/school/'.$school['alias']);
            } else {
                echo 'Ошибка загрузки файла. Обратитесь к администратору';
            }
        }
    }

    function fileDelLink($typename) {
        global $school;

        if (!empty($school[$typename]))
            echo '&nbsp; &nbsp; <a href="/school/'.$school['alias'].'?act=files&del='.$typename.'">Удалить</a>';
    }

    function deleteFile($typename) {
        global $db,$school;

        if ($typename == 'price' or $typename == 'sertif' or $typename == 'schedule') {
            unlink('files/'.$typename.'/'.$school[$typename]);
            $db->query("UPDATE as_school SET {$typename} = '' WHERE id_school = {$school['id_school']}");
            redirect('/school/'.$school['alias'].'?act=files');
        }
    }

/**
 * Статистика просмотров
 */
function statistics() {
    global $db,$school;

    if (!isset($_SESSION['views'.$school['id_school']])) {
        $_SESSION['views'.$school['id_school']] = true;

        // обновляем общее число просмотров
        $db->query(pref("UPDATE `pref_school` SET `views` = `views` + 1 WHERE `id_school` = {$school['id_school']}"));

        // есть ли уже просмотры за сегодняшний день?
        $statq = $db->query(pref("SELECT * FROM pref_statistics
                             WHERE date = '".date('Y-m-d')."' and id_project = {$school['id_school']} and type = 0
                             LIMIT 1"));
        if ($statq->rowCount()==1) {
            $db->query(pref("UPDATE pref_statistics SET views = views + 1
                        WHERE date = '".date('Y-m-d')."' and id_project = {$school['id_school']} and type = 0
                        LIMIT 1"));
        } else {
            $db->query(pref("INSERT INTO pref_statistics
                        SET date = NOW(), id_project = {$school['id_school']},
                            type = 0, views = 1"));
        }
    }
}
    include 'templates/metric.php';
