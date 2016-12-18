function paginarSeguridad(){
	$('#tabs').ajaxStop(function(){
		$('thead a').unbind('click');
		$('thead a').bind('click',function(){
			$.get($(this).attr('href'),function(data){
				$('#tabs div:visible').html(data);
			});
			return false;			
		});
		
		$('#paging a').unbind('click');
		$('#paging a').bind('click',function(){
			$.get($(this).attr('href'),function(data){
				
				$('#tabs div:visible').html(data);
			});
			return false;			
		});
		
		$('div:visible .box form').unbind('submit');
		$('div:visible .box form').bind('submit',function(){
			$($(this).children('input[type="text"]')[0]).addClass("loader");
			//$('div:visible #BuscarValor').addClass("loader");
			
			$.ajax({
	            type: 'POST',
	            url: $(this).attr('action'),
	            data: $(this).serialize(),
	            // Mostramos un mensaje con la respuesta de PHP
	            success: function(data) {
					//$('div:visible #BuscarValor').removeClass("loader");
					$($(this).children('input[type="text"]')[0]).removeClass("loader");
	                $('#tabs div:visible').html(data);
	            }
	        });
			return false;
		});
		
	});
}