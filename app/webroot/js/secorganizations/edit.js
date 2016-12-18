$(function(){
	var validator=$('#SecorganizationEditForm').validate({
	rules:{
		'data[Secorganization][code]':{
			required:true,
		},
		'data[Secorganization][name]':{
			required:true,
		},
		'data[Secorganization][type]':{
			required:true,
		},
		'data[Secorganization][thema]':{
			required:true,
		},
		'data[Secorganization][porcentajecreditoexceso]':{
				digits:true
			},
	},
	errorPlacement: function(label, element)
	{  label.insertAfter(element);}    
	});
});