$(function(){
	var validator=$('#SecprojectEditForm').validate({
	rules:{
		'data[Secproject][secorganization_id]':{
			required:true,
		},
		'data[Secproject][code]':{
			required:true,
		},
		'data[Secproject][name]':{
			required:true,
		}
	},
	errorPlacement: function(label, element)
	{  label.insertAfter(element);}    
	});
});