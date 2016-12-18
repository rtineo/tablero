//METODOS PARA LA VALIDACION

jQuery.validator.addMethod('cantidadPedidaGuia', function(val, el) {
 	name = el.name;
 	cantDisponible = $('input[name="'+name+'"]').prev().val();
 	val = parseFloat(val,'10');
 	cantDisponible = parseFloat(cantDisponible,'10');
 		if(val > cantDisponible)
 		return false;
 	else
 		return true;
});

jQuery.validator.addMethod("alphanumeric", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9]+$/.test(value);
}); 

jQuery.validator.addMethod('onlyPlaque', function(val, el) {
	console.info(el);
 	if(val.indexOf("-") >= 0 || val.indexOf(".") >= 0){
		return false;
	}else{
		$(el).attr('value', val.toUpperCase())
		return true;	
	}
}, 'Los caracteres "-" y "." no son validos');

jQuery.validator.addMethod('cantidadMenorQue', function(val, el){
 	name = el.name;
	menorQue = $('input[name="'+name+'"]').attr('menorque');
	cantidadMaxima = $('input[name="'+menorQue+'"]').val();
 	value = parseFloat(val,'10');
 	cantidadMaxima = parseFloat(cantidadMaxima,'10');
 		if(value > cantidadMaxima)
 		return false;
 	else
 		return true;
}, 'Cant. excede el valor maximo');

jQuery.validator.addMethod('cantidadMayorQue', function(val, el){
 	name = el.name;
	mayorQue = $('input[name="'+name+'"]').attr('mayorque');
	cantidadMinima = $('input[name="'+mayorQue+'"]').val();
 	value = parseFloat(val,'10');
 	cantidadMinima = parseFloat(cantidadMinima,'10');
 		if(value <= cantidadMinima)
 		return false;
 	else
 		return true;
}, 'Cant. <= valor minimo');

jQuery.validator.addMethod('cantidadMayorIgualQue', function(val, el){
 	name = el.name;
	mayorIgualQue = $('input[name="'+name+'"]').attr('mayorigualque');
	cantidadMinima = $('input[name="'+mayorIgualQue+'"]').val();
 	value = parseFloat(val,'10');
 	cantidadMinima = parseFloat(cantidadMinima,'10');
 		if(value < cantidadMinima)
 		return false;
 	else
 		return true;
}, 'Cant. menor al valor minimo');

jQuery.validator.addMethod('mayorQueCero', function(val, el){
 	var value = parseFloat(val);
 	if(value < 1)
 		return false;
 	else
 		return true;
}, 'Cant. mayor que cero');

jQuery.validator.addMethod('maximoporcentaje', function(val, el){
 	value = parseFloat(val,'10');
	if(value > 100)
 		return false;
 	else
 		return true;
}, 'Valor maximo 100%');

jQuery.validator.addMethod('tarjetascyngenta', function(val, el){
	if(val == '') return true;
	
 	var value = parseFloat(val);
	var minimo = parseFloat($(el).attr('minimo'));
	var maximo = parseFloat($(el).attr('maximo'));
	var excluyente = isNaN(parseFloat($(el).attr('excluyente')));
	
	if(!excluyente){
		if((minimo==value) || (value==maximo)) return true;
	 	else return false;
	}else{
		if((minimo<=value) && (value<=maximo)) return true;
	 	else return false;
	}
	
}, 'Error');

//FUNCIONES NECESARIAS
/**
 * verifica entre los radio button que almenos uno sea seleccionado
 * @param {Object} id_temp = imput(hide) que almacena 1 si se selecciono el detalle
 * <?php echo $form->radio('Tqcdevoluciondetalle.'.$key.'.aprobado',array('1'=>'A', '0'=>'R'), array('div'=>false, 'legend'=>false, 'separator'=> '&nbsp;&nbsp;','onchange' =>"aprobarRadiobutton('Tqcdevoluciondetalle".$key."Aprobadotem')")); 
		  echo $form->hidden('Tqcdevoluciondetalle.'.$key.'.aprobadotem', array('validate'=>'required:true','div'=>false,'label'=>false));
	?>
 */
function aprobarRadiobutton(id_temp){
	$('#'+id_temp).attr('value','1');
	$('label[for="'+id_temp+'"]').html('');
}

/**
 * Agrega slashes para formar el json.parse
 * @param {Object} str
 */
function addslashes( str ) {
    return (str+'').replace(/([\\"'])/g, "\\$1").replace(/\0/g, "\\0");
}

/*
function addslashes(str) {
	str=str.replace(/\\/g,'\\\\');
	str=str.replace(/\'/g,'\\\'');
	str=str.replace(/\"/g,'\\"');
	str=str.replace(/\0/g,'\\0');
	return str;
}

function stripslashes(str) {
	str=str.replace(/\\'/g,'\'');
	str=str.replace(/\\"/g,'"');
	str=str.replace(/\\0/g,'\0');
	str=str.replace(/\\\\/g,'\\');
	return str;
}
*/

/* Made by Mathias Bynens <http://mathiasbynens.be/> */
function number_format(a, b, c, d) {
 a = Math.round(a * Math.pow(10, b)) / Math.pow(10, b);
 e = a + '';
 f = e.split('.');
 if (!f[0]) {
  f[0] = '0';
 }
 if (!f[1]) {
  f[1] = '';
 }
 if (f[1].length < b) {
  g = f[1];
  for (i=f[1].length + 1; i <= b; i++) {
   g += '0';
  }
  f[1] = g;
 }
 if(d != '' && f[0].length > 3) {
  h = f[0];
  f[0] = '';
  for(j = 3; j < h.length; j+=3) {
   i = h.slice(h.length - j, h.length - j + 3);
   f[0] = d + i +  f[0] + '';
  }
  j = h.substr(0, (h.length % 3 == 0) ? 3 : (h.length % 3));
  f[0] = j + f[0];
 }
 c = (b <= 0) ? '' : c;
 return f[0] + c + f[1];
}