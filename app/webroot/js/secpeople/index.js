function modificarpasswordusuario(url)
{	
	var w = window.open(url, 'editar', 
	        'scrollbars=no,resizable=yes,width=450,height=450,top=100,left=450,status=no,location=no,toolbar=no');
}

function add(url)
{	
	var w = window.open(url, 'agregar', 
	        'scrollbars=no,resizable=yes,width=400,height=520,top=100,left=450,status=no,location=no,toolbar=no,menubar=no');
}

function editar(url)
{	
	var w = window.open(url, 'editar', 
	        'scrollbars=no,resizable=yes,width=400,height=520,top=100,left=450,status=no,location=no,toolbar=no');
}

function mostrar(url)
{	
	var w = window.open(url, 'editar', 
	        'scrollbars=no,resizable=yes,width=400,height=400,top=100,left=200,status=no,location=no,toolbar=no');
}

$('document').ready(function(){
	paginador = $('#paginador').val();
	if(paginador){
		$('.failure').remove();
	}	
})