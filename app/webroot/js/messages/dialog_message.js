var messaje = function(){
	
}

messaje.prototype = {
	init:function(){
		$("#dialog_message").dialog({
			bgiframe: true,
			resizable: false,
			height: 200,
			width: 350,
			modal: true,
			autoOpen: false,
			overlay: {
				backgroundColor: '#000',
				opacity: 0.5
			},
			buttons: {
				"Ok": function() {
					$(this).dialog("close");
				}
			}
		});
		
		$('#messages-pager').html('<div>NO EXISTEN MENSAJES PARA MOSTRAR</div>');
	},
	setMsg: function(msg){
		$('#messages-pager').html('<div>'+msg+'</div>');
	},
	open: function(){
		$("#dialog_message").dialog('open');
	}
};
