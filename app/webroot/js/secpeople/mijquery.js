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

function mostrarDatosPersona(){
	$('#datosPersona').click(function(){
		$('div#mostrarDatos').toggleClass('hide');
	});
}

$(document).ready(function() {
    equalHeight($(".equalHeight"));
	rowTables();
	selectRowTables();
	mostrarDatosPersona();
});