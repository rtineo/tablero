$(function(){
	var validator=$('#SecprojectAddForm').validate({
	rules:{
		'data[Secproject][secorganization_id]':{
			required:true,
		},
		'data[Secproject][code]':{
			required:true,
		},
		'data[Secproject][name]':{
			required:true,
		},
		'data[Secproject][address]':{
			required:true,
		}
	},
	errorPlacement: function(label, element)
	{  label.insertAfter(element);}    
	});
});