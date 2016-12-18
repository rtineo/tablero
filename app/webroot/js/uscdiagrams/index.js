$(function() {
	$( "#f_ini" ).datepicker({
		showOn: "button",
		buttonImage: getUrl('app/webroot/img/usc/calendar.gif'), 
		buttonImageOnly: true,
		changeMonth: true,
		changeYear: true,
		dateFormat: 'dd/mm/yy',
		onSelect: function(selectedDate) {
			$( "#f_fin" ).datepicker( "option", "minDate", selectedDate );
		}
	});
	
	$( "#f_fin" ).datepicker({
		showOn: "button",
		buttonImage: getUrl('app/webroot/img/usc/calendar.gif'), 
		buttonImageOnly: true,
		changeMonth: true,
		dateFormat: 'dd/mm/yy',
		onSelect: function( selectedDate ) {
			$( "#f_ini" ).datepicker( "option", "maxDate", selectedDate );
		}
	});
});

function eliminarDiagrama(id, name){
	//jAlert(name,'NOMBRE ALERTA');
	jConfirm('Esta seguro de desactivar el diagrama:<br/>'+name, 'Confirmar', function(r) {
		if(r){
			$.ajax({
				url:getUrl('uscdiagrams/setDesactivar/'+id),
				dataType:'json',
				success:function(response){
					//$($('#'+id).find('td').get(6)).html('DE');
					//console.debug(history.go(0));
					jAlert('El diagrama fue desactivado<br/>'+name);
					location.reload();
				},
				error: function(){
					jAlert('El diagrama no se desactivo<br/>'+name);
				}
			});
		}
	});
	return false;
}
