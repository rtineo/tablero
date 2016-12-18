function inicializarFecha() {
	$(".fecha").datepicker({minDate:0, showOn: 'button', buttonImage: $.url('/app/webroot/img/calendar.gif'), buttonImageOnly: true, buttonText: 'Calendario'},$.datepicker.regional['es']);
}
	
$(document).ready(function() {
	inicializarFecha();
});
