/******Estilo para el Desactivo del Elemento buscador*******/
$('document').ready(function(){
	$('label[for="BuscarDesactivo"]').css({'color':'#000099','font-weight':'normal'});
})

function equalHeight(group) {
    tallest = 500;
    group.each(function() {
        thisHeight = $(this).height();
        if(thisHeight > tallest) {
            tallest = thisHeight;
        }
    });
    group.height(tallest);
}

function rowTables(){
	$('#contenido tbody tr').hover(
		function(e) {
			$(this).addClass('over');
		},
		function(e) {
			$(this).removeClass('over');
		}
	);
}


function selectRowTables(){
	$('#contenido tbody tr').bind('click', function() {
			$('#contenido tbody tr').removeClass();
			$(this).addClass('selectRowTables');
	});
}

function loadPage(){
	$('#menu-acos1 ul li a').click(cargar);
}

function cargar(){
	var espa = $('#contenido');
	var url = $(this).attr('href');
	alert(url);
}

$(document).ready(function() {
    equalHeight($(".equalHeight"));
	rowTables();
	selectRowTables();
});