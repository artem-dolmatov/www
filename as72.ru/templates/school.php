<div class='listschool<?php if($school['tariff']==2) echo ' gold';?>'>
    <div class="number"><?php echo $i++;?></div>
    <div class='nameschool'>
        <a href='/school/<?php echo $school['alias'];?>'><?php echo $school['name'];?></a>
    </div>
    <div class='advanced_button'>

<?php if ($_SESSION['admin']): ?>
        <div style='float:left; width:32px;'><?php echo $school['views'].'/'.$school['gosite'];?></div>
    
    <div style='float:left; width:28px;'>&nbsp;
        <?php if(!empty($school['logo'])):?>
        <img src='/templates/images/logoss.png' width="16" height="16" alt='Есть лого' title='Есть лого'/>
        <?php endif;?>
    </div>
<?php endif;?>
            
    <div style='float:left; width:28px;'>&nbsp;
        <?php if(!empty($school['girl'])):?>
        <img src='/templates/images/girl.png' width="16" height="16" alt='Есть женщины инструкторы' title='Есть женщины инструкторы'/>
        <?php endif;?>
    </div>
            
    <div style='float:left; width:28px;'>&nbsp;
        <?php if(!empty($school['akpp'])):?>
        <img src='/templates/images/akpp.png' width="16" height="16" alt='Есть автомобили с АКПП' title='Есть автомобили с АКПП'/>
        <?php endif;?>
    </div>
            
    <div style='float:left; width:28px;'>&nbsp;
        <?php if(!empty($school['credit'])):?>
        <img src='/templates/images/credit.png' width="16" height="16" alt='Есть рассрочка платежа' title='Есть рассрочка платежа'/>
        <?php endif;?>
    </div>
            
    <div style='float:left; width:23px;'>&nbsp;
        <?php if(!empty($school['cost'])):?>
        <img src='/templates/images/cash.png' width="16" height="16" alt='Заполнена стоимость' title='Заполнена стоимость'/>
        <?php endif;?>
            </div>
            
    <div style='float:left; width:23px;'>&nbsp;
        <?php if(!empty($school['text'])):?>
        <img src='/templates/images/aboutinfo.png' width="16" height="16" alt='Заполнен раздел о компании' title='Заполнен раздел о компании'/>
        <?php endif;?>
    </div>            
            
    <div style='float:left; width:23px;'>&nbsp;
        <?php if(!empty($school['email'])):?>
        <img src='/templates/images/mail44.png' width="16" height="16" alt='Указан email' title='Указан email'/>
        <?php endif;?>
    </div>
            
    <div style='float:left; width:23px;'>&nbsp;
        <?php if(!empty($school['icq'])):?>
        <img src='/templates/images/icq.png' width="16" height="16" alt='Указан icq' title='Указан icq'/>
        <?php endif;?>
    </div>
            
    <div style='float:left; width:23px;'>&nbsp;
        <?php if(!empty($school['tariff'])):?>
        <a href="/school/<?php echo $school['alias'];?>" rel="nofollow">
        <img src='/templates/images/partner.png' width="16" height="16" alt='Наши партнеры' title='Наши партнеры'/></a>
        <?php endif;?>
    </div>
            
    <div style='float:left; width:28px;'>&nbsp;
        <?php if(!empty($school['vk'])):?>
        <a href="<?php echo $school['vk'];?>" target="_blank" rel="nofollow">
        <img src='/templates/images/vkb.jpg' width="16" height="16" alt='Есть группа ВКонтакте' title='Есть группа ВКонтакте'/></a>
                <?php endif;?>
    </div>
    
    <div style='float:left; width:28px; text-align:left;'>
        <?php if(!empty($school['site'])):?>
        <a href="<?php echo $school['site'];?>" target="_blank" rel="nofollow">
        <img src='/templates/images/web_site.png' width="16" height="16" alt='Есть свой сайт' title='Есть свой сайт'/></a>
        <?php endif;?>&nbsp;
    </div>
    
    <div style='width:65px; float:left;'><?php echo $school['category'];?></div> &nbsp; 
    <a href='/school/<?php echo $school['alias'];?>' class='adva'>подробнее</a> &darr;
</div>
</div>

<div class='advanced'>
    <?php echo $school['address'].'<br/>'.$school[''];?>
    <br/><a href='/school/<?php echo $school['alias'];?>' class='perehod'>перейти на страницу автошколы &rarr;</a>
</div>