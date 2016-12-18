jQuery.noConflict();

jQuery(document).ready(inicializar);


function modificarpassword(url)
{
	var w = window.open(url, 'modificarpassword', 
	        'scrollbars=no,resizable=no,width=480,height=340,top=100,left=200,status=no,location=no,toolbar=no,menubar=no');
}

function inicializar() {
	var numeros = new Array();
	
	while(numeros.length<10){
		var randomnumber=Math.floor(Math.random()*10)
		if(!exist(randomnumber)){
			numeros[numeros.length]=randomnumber;
		}
	}
	
	var out = '';
	var j=0;
	
	for ( j=0; j < numeros.length; j++ ){
		out += '<input class=\"button_off\" type=\"button\"';
		out += 'value=\"' + numeros[j] + '\"';
		out += '/>';
	}

	var nCod = jQuery('#codNum');
	nCod.html(out);

	function exist( numero ) {
		var i=0;
		for ( i=0; i < numeros.length; i++ ){
			if(numeros[i]==numero){
				return true;
			}
		}
		return false;
	}

	var codigos = jQuery('#codNum input, .codAlf input');
	codigos.click(agrCod);
	jQuery('#btnReset').click(reiniciar);
}

function agrCod () {
	var valor = jQuery(this).attr('value');
	if(valor == "Borrar"){
		var miCod = jQuery('#Password').attr('value');
		miCod = miCod.substring(0, miCod.length-1);
		jQuery('#Password').attr('value', miCod);
	}else{
		if(jQuery('#Password').attr('value')!=undefined){
			var miCod = jQuery('#Password').attr('value');
			jQuery('#Password').attr('value', miCod+valor);
		}else{
			jQuery('#Password').attr('value', valor);
		}	
	}
}

function reiniciar () {
	jQuery('#Password').attr('value', '');
}
