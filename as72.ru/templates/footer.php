</div>
<div class="float-left" style="width:240px; float:left;">

<!--<center><div id="vk_groups"></div>
<script type="text/javascript">
<!-- VK.Widgets.Group("vk_groups", {mode: 0, width: "220", height: "400", color1: 'FFFFFF', color2: '2B587A', color3: '5B7FA6'}, 88536659); 
</script></center> -->
<br>
<a href=""></a>

</div>
</div><!-- /content -->
</div><!-- /wrap -->
<div class="wrap" style="background:url('/templates/images/bgfooter.png') repeat-x top; padding:40px 0 10px 0;">
    <div id="footer" style="">
    <div style="float:left; width:190px;">
        <b>Разделы</b>
        <ul>
        <li><a href="/">Главная</a></li>
        <li><a href="/school/">Автошколы Тюмени</a></li>
        <li><a href="/pdd/exam/">Экзамен ПДД онлайн 2016</a></li>   
        </ul>
    </div>   
    
    <div style="float:right; width:240px;">
        <div style="background:url('/templates/images/bglogin.jpg') #111; margin-bottom:10px; margin-top:-10px; padding:10px; text-align:center">
<?php
    if ( empty($_SESSION['user_id']) ) {
?>
            <b>Вход для автошкол</b>
            <form method="post" action="/login.php">
                <div style="width:180px; margin:0 auto; overflow:hidden">
                <input type="text" name="login" style="margin-bottom:2px; background:#e0dbce; border:1px solid #bab199; padding:4px 10px; width:180px;"><br/>
                <input type="password" name="password" style="margin-bottom:5px; background:#e0dbce; border:1px solid #bab199; padding:4px 10px; width:180px"/><br/>
                <div class="float-left"><a href="/info/add-school">Получить доступ</a></div>
                <div class="float-right"><input type="submit" name="submit" value="Войти"/></div>
                </div>
                <input type="hidden" name="ref" value="<?php echo $_SERVER['REQUEST_URI'];?>"/>
            </form>
            
<?php
    } else {
        echo '<a href="/logout.php">Выход</a>';
        if ($_SESSION['admin']) echo '<br/><br/><a href="/admin/">Панель управления</a>';
    }
?>
        </div>
    </div>
    <br clear="both"/><br/>
   <span style="font-size:12px;">2012-<?php echo date('Y');?> &copy; <a href="http://as72.ru">Автошколы Тюмени</a>.
        <a href="http://promo360.ru" target="_blank">Создание сайта - <strong>Promo360</strong></a></span>
        <br>
</div><!-- /wrap -->
</div>
  <script type="text/javascript">
  jQuery(document).ready(function(){
    $(".contactinfo, .cp, .photos, .zagolok, .files a, .news-adva-text, ul.menuschool li").corner();
    $(".around").corner('4px');
    $('.newstitle').corner('top');
    $("a.adva").click(function () {
        $(this).closest('.listschool').next('.advanced').slideToggle();
        return false;
    });
    
    $("a.search_adva").click(function() {
        $(".search_adva_box").slideToggle();
        $("a.search_adva").hide();
        return false;
    });
    
    /*$(".news-adva").click(function () {
      $(this).closest('.podnews').next('.news-adva-text').slideToggle();
      return false;
    });*/
    $(".news-adva").click(function () {
      $(this).next('.news-adva-text').slideToggle();
      return false;
    });
    
    /*$(".newsbox").click(function () {
      $(this).children('.news-adva-text').slideToggle();
      return false;
    });*/
    
    /*$( 'textarea.newstext').each( function() {
        CKEDITOR.replace( $(this).attr('id') );
    });*/
    
    $(".photos a.img, a.sertif").colorbox({rel:'photos', title:'Автошкола <?php echo $school['name'];?>'});
    
    var tabContainers = $('div.tabs > div'); // получаем массив контейнеров
    tabContainers.hide().filter('#contacts').show(); // прячем все, кроме первого
    // далее обрабатывается клик по вкладке
    $('div.tabs ul.menuschool li a').click(function () {
        tabContainers.hide(); // прячем все табы
        tabContainers.filter(this.hash).show(); // показываем содержимое текущего
        $('div.tabs ul.menuschool li').removeClass('current'); // у всех убираем класс 'selected'
        $(this).parent().addClass('current'); // текушей вкладке добавляем класс 'selected'
        return false;
    }).filter('#contacts').click();
  });

        function SearchSchool(f){
            var akpp2 = f.akpp.checked;
            var site2 = f.site.checked;
            var kat_a = f.kat_a.checked;
            var kat_b = f.kat_b.checked;
            var kat_c = f.kat_c.checked;
            var kat_d = f.kat_d.checked;
            var kat_e = f.kat_e.checked;
            
            var girl2 = f.girl.checked;
            var credit2 = f.credit.checked;
            var dayoff2 = f.dayoff.checked;
            var night2 = f.night.checked;
            var recovery2 = f.recovery.checked;
            
            var vk2 = f.vk.checked;
            var email2 = f.email.checked;
            var icq2 = f.icq.checked;
            
            $.ajax({
                type: "POST",
                data: {akpp:akpp2,site:site2,kata:kat_a,katb:kat_b,
                       katc:kat_c,katd:kat_d,kate:kat_e,girl:girl2,credit:credit2,dayoff:dayoff2,night:night2,recovery:recovery2,vk:vk2,email:email2,icq:icq2},
                url: "/school_search_ajax.php",
                beforeSend: function(data){
                    $("#school_box").animate({opacity: "0.3"}, "1");
                },
                success: function(data) {
                    $("#school_box").html(data).animate({opacity: "1"}, "1");
                }
            });
            return false;
        }

  </script>


</body>
</html>