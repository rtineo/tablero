function pulsarEnter(){
	var x;
	x = $("#TqcarticuloCodigo");
	x.keypress(function(e){
		if(e.keyCode==13){
			 
			obtenetDatosArticulo();			
	    }
	});
}
function obtenetDatosArticulo(){
	 		var url = $("#TqcarticuloCodigo").attr('url');
			var s = $("#TqcarticuloCodigo").val();	
			//alert(url+s);
			$.getJSON(url+s,{}, function(dato){
				$('#TqcarticuloDescripcion').attr('value', dato[0].descripcion);
				$('#TqcarticuloId').attr('value',dato[0].id);
			});
}

function listarArticulos(url){	
	var w = window.open(url,'','scrollbars=yes,resizable=yes,width=480,height=400,top=100,left=200,status=no,location=no,toolbar=no');	
}

function buscaArticulos(){
	$("#FilterTextBox").keyup(function(){
		var s = $(this).val().toLowerCase().split(" "); 
		window.open(url,'','scrollbars=No,resizable=yes,width=480,height=400,top=100,left=200,status=no,location=no,toolbar=no');
	});//key up.
}

function cargarTablaPrincipal(){
	$("#buscar").bind("click", function(){
		//var params = {id:$('#almacen').val(),articulo_id:$('#TqcarticuloId').val()};
	
		$.get($.url("/Tqcreportes/listatablaprincipal") , function(data){
			
			$("#listatablaprinc").html(data);
		});
	});
}

$(document).ready(function() {
	pulsarEnter();
	buscaArticulos();
	cargarTablaPrincipal();
});
