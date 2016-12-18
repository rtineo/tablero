function inicializarFechaPasada() {
	$(".fechapasada").datepicker({showOn: 'button', buttonImage: $.url('/app/webroot/img/calendar.gif'), buttonImageOnly: true, buttonText: 'Calendario'},$.datepicker.regional['es']);
}
	
$(document).ready(function() {
	inicializarFechaPasada();
});
