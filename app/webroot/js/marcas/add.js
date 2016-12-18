/**
 * @author Lourdes
 * 
 */

$(function(){
	var validator=$('#MarcaAddForm').validate({
	rules:{
		'data[Marca][codigo]':{
			required:true,
		},
		'data[Marca][description]':{
			required:true,
		}
	},
	errorPlacement: function(label, element)
	{  label.insertAfter(element);}    
	});
});
