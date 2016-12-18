$(function(){
	var validator=$('#SecroleAddForm').validate({
	rules:{
		'data[Secrole][secorganization_id]':{
			required:true,
		},
		'data[Secrole][code]':{
			required:true,
		},
		'data[Secrole][name]':{
			required:true,
		}
	},
	errorPlacement: function(label, element)
	{  label.insertAfter(element);}    
	});
});