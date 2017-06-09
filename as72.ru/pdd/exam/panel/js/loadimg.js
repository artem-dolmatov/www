$(function(){		
		var btnUpload=$('#upload');
		var status=$('#status');
		
		new AjaxUpload(btnUpload, {
			action: 'upload.php',
			name: 'uploadfile',
			onSubmit: function(file, ext){
				status.html('Загружаю ...');
			},
			onComplete: function(file, response){
				//On completion clear the status
				
				//Add uploaded file to list
				if(response.length=="11"){
                    status.text('Загружено');
					status.html('<img src="../img/'+response+'" alt=""/>');
					 $("#upload").css('display','none');
					$('#imgname').val(response);
				} else{
                    status.html('<b>Ошибка:</b> ' + response);
					//$('<li></li>').appendTo('#files').text(file).addClass('error');
				}
			}
		});
	});