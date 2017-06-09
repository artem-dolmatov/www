
  function AjaxFormRequest(result_id,formMain,url) {
                   jQuery.ajax({
                    url:     url,
                    type:     "POST",
                    dataType: "html",
                    data: jQuery("#"+formMain).serialize(), 
                    success: function(response) {
                    document.getElementById(result_id).innerHTML = "<p>Спасибо, теперь Вы будете в курсе самых лучших предложений<p>";
                },
                error: function(response) {
                document.getElementById(result_id).innerHTML = "<p>Возникла ошибка при отправке формы. Попробуйте еще раз</p>";
                }
             });

             jQuery(':input','#formMain')
        .not(':button, :submit, :reset, :hidden')
        .val('')
        .removeAttr('checked')
        .removeAttr('selected');
    }

   jQuery(function(jQuery){
   jQuery("#phone").mask("+7(999)999-99-99");
});

