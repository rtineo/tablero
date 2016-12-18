$(function(){
	var validator=$('#SecpersonModificarpasswordusuarioForm').validate({
	rules:{
		'data[Secperson][nuevacontrasenia]':{
			required:true,
		},
		'data[Secperson][confirmarcontrasenia]':{
			required:true,
		},
		'data[Secperson][expirationdate]':{
			required:true,
			date:true
		}
	},
	errorPlacement: function(label, element)
	{  label.insertAfter(element);}    
	});
});