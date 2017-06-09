/* Будьте внимательны. Мы здесь указали адрес нашего сайта
и адрес скрипта, обрабатывающего форму.
Не забудьте изменить их на Ваши.
 */
var Site={serverName: 'as72.ru'} /* адрес сайта */
function sendform(){
	var msg=$('#myform').serialize();
        /* блокируем кнопку отправить */
	document.myform.button.disabled=true;
        /* меняем надпись на кнопке */
	document.myform.button.value="Подождите..."; 
	$.ajax({
		type:'POST',
                /* адрес php файла, обрабатывающего форму */
		url:"http://"+Site.serverName+"/sale/mail/subscription.php",
		data:msg+"&action=sendform",
		cache:false,
		success:function(data){
			$("#error").html(data);
			document.myform.button.disabled=false;
			document.myform.button.value="Отправить";
		}
	});
}


var b = document.getElementById('b');
b.onclick = function(e) {
  b.className = "button load";   
  b.innerHTML = ""; 
    
  setTimeout(function() {
      b.className = "button success";
      b.innerHTML = "<b>Отправлено</b>";
  }, 4000);
}

jQuery(function($){
   $("#phone").mask("+7 (999) 999-9999");
});