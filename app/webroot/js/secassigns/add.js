var url;
$(document).ready(function(){
	url = $('base').attr('href');
	
    $("#SecassignAddForm").validate({
	rules: {
			"data[Secassign][secperson_id]": {
				required: true,
			},
			"data[Secorganization][id]":{
			    required:true,
		    },
			"data[Secassign][secproject_id]":{
			    required:true,
		    },
			"data[Secassign][secrole_id]":{
			    required:true,
		    }
		},
    });
	
	$('#SecorganizationId').bind('change',cargarSucursal);
	
	function cargarSucursal(){
		var secorganization = $('#SecorganizationId').val();
		$.ajax({
			url:url+"Secassigns/listprojects",
			data:"data[Secorganization][id]="+secorganization,
			type:"POST",
			success:function(data){
				$('#SecassignSecprojectId').html(data);
			},
			complete:function(){
				cargarRol();
			}
		});
	}
	
	function cargarRol(){
		var secproject = $('#SecorganizationId').val();
		$.ajax({
			url:url+"Secassigns/listroles",
			data:"data[Secorganization][id]="+secproject,
			type:"POST",
			success:function(data){
				$('#SecassignSecroleId').html(data);
			}
		});
	}
});