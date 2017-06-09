$(document).ready(function(){
    $("#checklink").click(function(){
		
		if ( $(this).text() == 'отметить все' )
		{
			$(":checkbox[name=topics]").attr("checked","checked");
			$(":checkbox[name=topics]").parent().css("color","#0364c9");
			$(this).text('снять все');
		}
		else
		{
			$(this).text('отметить все');
			$(":checkbox[name=topics]").removeAttr("checked");
			$(":checkbox[name=topics]").parent().css("color","");
		}
    });
	
	$("#menu2").click(function(){
		$("#menu1").removeClass('active');
		$("#menu2").addClass('active');
		$("#var1").css('display','none');
		$("#var2").css('display','block');
	});
	$("#menu1").click(function(){
		$("#menu2").removeClass('active');
		$("#menu1").addClass('active');
		$("#var2").css('display','none');
		$("#var1").css('display','block');
	});
});

function ajaxTopics(form)
{	
	$ind=0;
	$array = [];
	$(":checkbox[name=topics]").filter(":checked").each(function()
	{
		$array[$ind] = $(this).val();
		$ind++;
	});
	
	if ( $ind > 0 )
	{
	$("#load").css('display','inline');
	$.post("./ticket.php", {topic:$array}, function(data){ 
		$("#box").html(data);
	});
	$("#load").css('display','none');
	}
	else
		alert('Выберите хотя бы одну тему');
	return false;
}

function ajaxBilet(bilet2)
{      
	$("#load").css('display','inline');
	$.post("/pdd/exam/ticket.php", {bilet:bilet2}, function(data){ 
		$("#box").html(data);
	});
	$("#load").css('display','none');
     
    
	return false;
}

function ajaxAnswer(quest)
{
	otvet = $('#otvet'+quest).val(); // id правильного ответа
	radio_answer = $("input[name=answer" + quest + "]:radio").filter(":checked");
	answer       = radio_answer.val(); // правильный или неправильный ответ (0 или 1)
	answer_error = Number($("#answer_error").val()); // количество ошибок
	
	$("input[name=answer" + quest + "]:radio").attr('disabled',true);
	$("input[name=submit" + quest + "]:submit").attr('disabled',false);
	if (answer == 0)
	{
		radio_answer.parent().css({'background': 'red', 'color':'white'});
		$("#an"+otvet).css('color','green');
		$("#quest"+quest).css('background','red');
		answer_error++;
		$("#answer_error").attr('value', answer_error);
	}
	else
	{
		radio_answer.parent().css({'background': 'green', 'color':'white'});
		$("#quest"+quest).css('background','green');
	}
	
	return false;
}

function ajaxAnswerNext(formid)
{
	$('#questbox'+formid).css('display','none');
	$('#questbox'+formid).next().css('display','block');
	
	count_quest  = Number($("#count_quest").text()); // сколько осталось вопросов
	count_quest--;
	$("#count_quest").text(count_quest);
	
	if (count_quest == 1)
		$(":submit").attr('value','Закончить');
	if (count_quest == 0)
	{
		answer_error = Number($("#answer_error").val());
		if (answer_error < 3)
			alert('Ошибок: ' + answer_error + '. Вы СДАЛИ!!!');
		else 
		{
			alert('Ошибок: ' + answer_error + '. Вы не сдали :( попробуйте еще раз');
		}
	}
	return false;
}

function comment_show(commid)
{
	comment = $('#comm_box'+commid);
	
	if ( comment.css('display') == 'none' )
		comment.css('display','block');
	else
		comment.css('display','none');
	return false;
}

function topicsColor(topic)
{
	if ( $(topic).parent().css('color') == 'rgb(3, 100, 201)' ) {
		$(topic).parent().css("color","");
	 } else{
		$(topic).parent().css("color","#0364c9");
    }
	return false;
}