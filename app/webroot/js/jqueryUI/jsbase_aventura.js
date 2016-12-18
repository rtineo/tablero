/**
 * funcion para obtener urls relativas a partir del atributo
 * href de una etiqueta 'base' que esta en default.ctp
 *  
 * @param String url direccion de tipo  /Tqcreportes/kardexreport
 */
$.url = function(url) {
	return $('base').attr('href')+url.substr(1);
}
//number_format(producto, 2, '.', '')
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

function trim(str, chars) {
	return ltrim(rtrim(str, chars), chars);
}
 
function ltrim(str, chars) {
	chars = chars || "\\s";
	return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
}
 
function rtrim(str, chars) {
	chars = chars || "\\s";
	return str.replace(new RegExp("[" + chars + "]+$", "g"), "");
}

function valida_fecha(fecha){
	var fecha_arr = fecha.split('/');
	var dia = parseFloat(fecha_arr[0]);
	var mes = parseFloat(fecha_arr[1]);
	var anio = parseFloat(fecha_arr[2]);
		
	return  fecha_arr[2].length == 4
}

function listarArticulos(url){
	var w = window.open(url,'','scrollbars=yes,resizable=yes,width=480,height=400,top=100,left=200,status=no,location=no,toolbar=no');
}

function numeroDiasHabiles(fechaini,fechafin){
	//Obtiene los datos del formulario
	CadenaFecha1 = fechafin;
	CadenaFecha2 = fechaini;
	
	//Obtiene dia, mes y año
	var fecha1 = new fecha(CadenaFecha1);
	var fecha2 = new fecha(CadenaFecha2);
	
	//Obtiene objetos Date
	var miFecha1 = new Date(fecha1.anio, fecha1.mes-1, fecha1.dia);
	var miFecha2 = new Date(fecha2.anio, fecha2.mes-1, fecha2.dia);
	
	//Resta fechas y redondea
	var diferencia = miFecha1.getTime() - miFecha2.getTime();
	var dias = Math.floor(diferencia / (1000 * 60 * 60 * 24));
	var x;
	var habil=dias;
	for(x=1;x<=dias; x++){
		dfecha = new Date( miFecha2.getFullYear(), miFecha2.getMonth(),(miFecha2.getDate()+x));
		if(dfecha.getDay()==0||dfecha.getDay()==6){
			habil--;
		}
	}
	dias=habil;
	return dias;
}

function numeroDias(fechaini,fechafin){
	//Obtiene los datos del formulario
	CadenaFecha1 = fechafin;
	CadenaFecha2 = fechaini;
	
	//Obtiene dia, mes y año
	var fecha1 = new fecha(CadenaFecha1);
	var fecha2 = new fecha(CadenaFecha2);
	
	//Obtiene objetos Date
	var miFecha1 = new Date(fecha1.anio, fecha1.mes-1, fecha1.dia);
	var miFecha2 = new Date(fecha2.anio, fecha2.mes-1, fecha2.dia);
	
	//Resta fechas y redondea
	var diferencia = miFecha1.getTime() - miFecha2.getTime();
	var dias = Math.floor(diferencia / (1000 * 60 * 60 * 24));
	return dias;
}

///////////////////////////////////////////////////////////
function fecha(cadena) {
	//Separador para la introduccion de las fechas
	var separador = "/";
	
	//Separa por dia, mes y año
	if ( cadena.indexOf( separador ) != -1 ) {
		var posi1 = 0;
		var posi2 = cadena.indexOf( separador, posi1 + 1 );
		var posi3 = cadena.indexOf( separador, posi2 + 1 );
		this.dia = cadena.substring( posi1, posi2 );
		this.mes = cadena.substring( posi2 + 1, posi3 );
		this.anio = cadena.substring( posi3 + 1, cadena.length );
	}else{
		this.dia = 0;
		this.mes = 0;
		this.anio = 0;
	}
} 


/** funciones propias **/
function in_array(what, where ){
	var a=false;
	for(var i=0;i<where.length;i++){
		if(what == where[i]){
			a=true;
			break;
		}
	}
	return a;
} 

//COLOREA LA TABLA
function colorearTabla(id) {
    var table = $('#'+id);
	if(!table) return false;
	
    var trs = table.find('tbody tr');
    
	trs.each(function(i,el){
		if(i%2 == 0) {
			$(el).addClass('par');
			el.onmouseout = function() {
				this.className = 'par';
			}
		} else {
			$(el).addClass('impar');
			el.onmouseout = function() {
				this.className = 'impar';
			}
		}
	});
}