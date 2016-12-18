// VISULIZAR LAS IMAGENES ALMACENADAS
function dialogImage(){
	// Dialog
	$('.usc_dialog').dialog({
		autoOpen: false,
		title: false,
		width: 600,
		buttons: {
			"Ok": function() {
				$(this).dialog("close");
			}
		}
	});
}	

function seeImage(dialogId){
	$('#'+dialogId).dialog('open');
	return false;
}	