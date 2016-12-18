$(function(){
	
	inicializarFecha();	
	verifica_fechas();
	
	var validator=$('#SecpersonAddForm').validate({
	rules:{
		'data[Secperson][firstname]':{
			required:true,
		},
		'data[Secperson][appaterno]':{
			required:true,
		},
		'data[Secperson][apmaterno]':{
			required:true,
		},
		'data[Secperson][username]':{
			required:true,
		},
		'data[Secperson][password]':{
			required:true,
		},
		'data[Secperson][creationdate]':{
			required:true,
			date:true
		},
		'data[Secperson][expirationdate]':{
			required:true,
			date:true
		},
		'data[Secperson][email]':{
			email:true,
		}
	},
	errorPlacement: function(label, element)
	{  label.insertAfter(element);}    
	});
});

function inicializarFecha() {
	var arr;
	$(".fecha").datepicker({
		showOn: 'button', 
		buttonImage: $.url('/app/webroot/img/calendar.gif'), 
		buttonImageOnly: true,
		onSelect: function(dateText, inst) { //console.debug(inst);
			
			if(inst.id == 'fechaIni'){
				arr = dateText.split("/");
				$('#fechaFin').datepicker( 'enable' );
				$('#fechaFin').attr('value','');				
			}
			if (inst.id == 'fechaFin') {
				activa_botones();
			}
			
		},
		beforeShow: function(input) { 			
			
			if(input.id == 'fechaFin'){	
				if($('#fechaIni').attr('value') != ""){
					arr = $('#fechaIni').attr('value').split("/");				
				}
							
				$(this).datepicker('option', 'minDate', new Date(arr[2], arr[1] - 1, arr[0]));
			}
		}

		},$.datepicker.regional['es']);
		if($('#fechaIni').attr('value') == "")
		$('#fechaFin').datepicker( 'disable' );
}

function desactiva_botones(){
	$('#guardar').attr('disabled','disabled');
}
function activa_botones(){
	$('#guardar').attr('disabled','');
}
function verifica_fechas(){
	if($('#fechaFin').attr('value') == "")
		desactiva_botones();
	else
		activa_botones();
}