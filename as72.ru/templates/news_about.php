<?php if (empty($news)) exit('пусто');?>
<div class="newsbox" style="background:#eee;">
    <div class="newstitle news-adva" style="padding:10px 15px 2px 15px; margin:1px 0 0 0; cursor:pointer">
        <span style="color:#006699; border-bottom:1px solid #006699"><?php echo $news['title'];?></span>
        <?php
        if ($news['datt'] == date('d.m.Y')) {
            //echo 'сегодня';
            $display_adva = 'block';
        } elseif ($news['datt'] == date('d.m.Y',time()-60*60*24)) {
            //echo 'вчера';
            $display_adva = 'block';
        } else {
            //echo $news['datt'];
            $display_adva = 'none';
        }
        ?>
    </div>
    
    <div style="border-top:1px solid #ccc; border-bottom:1px solid #c6d5de; font-size:12px; display:<?php echo$display_adva;?>; background:#fff; margin:5px 10px; padding:20px 20px 10px 20px" class="news-adva-text">
    <noindex>
        <?php echo parse_bb_code($news['news']);?>
        <div style="border-top:1px dotted #ccc; margin-top:10px; padding-top:10px; overflow:hidden">
            <div class="float-left">
            <a href="/news/<?php echo $news['id'];?>">Ссылка на новость</a>
            <?php if ($moder):?>
                | <a href="?act=news&go=edit&id=<?php echo $news['id'];?>">Редактировать</a> |
                <a href="?act=news&go=delete&id=<?php echo $news['id'];?>" onclick="if (!confirm('Вы уверены что хотите это сделать?')) return false;">Удалить</a>
            <?php endif;?>
            </div>
            <div class="float-right">
                опубликовано: <?php echo $news['datt'];?>
            </div>
        </div>
    </noindex>
    </div>
</div>