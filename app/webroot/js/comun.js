/**
 * Devuelve una cadena que lista los nombres de los miembros del objeto.
 *
 * @param objeto
 * @return string
 */
function listarMiembros(objeto) {
    var result = '';
    for (miembro in objeto) {
        result += ' ' + miembro;
    }
    return result;
}

/**
 * Forma abreviada de listarMiembros().
 *
 * @param objeto
 * @return string
 */
function pr(objeto) {
    alert(listarMiembros(objeto));
}

/**
 * Cambia la ubicación de la ventana actual al url especificado.
 *
 * @param url
 */
function irHacia(url) {
    window.location.href = url;
}

/**
 * Aplica los estilos 'par' e 'impar' a las filas de la tabla cuyo id se especifica.
 * La tabla tiene que tener definido un tbody, para asegurar la compatibilidad.
 *
 * @param id id de la tabla
 */
function colorearTablaGarantia(id) {
    var table = $(id);
	if(!table) {
		return false;
	}
    var bodys = table.getElementsByTagName('tbody');
    var body = bodys[0];
    var rows = table.getElementsByTagName('tr');
	var row;
	var classAnterior;
    for(var i=0; row=rows[i]; i++) {
			row.onmouseout = function() {
				this.className = classAnterior;
			}
			row.onmouseover = function() {
				classAnterior=this.className;
				this.className = 'filaResaltadaGarantia';
			}			
    }
}
function colorearTabla(id) {
	$('#'+id).find('tbody tr').each(function(i,e){
		 if(i%2 == 0) $(e).addClass('par');
			else $(e).addClass('impar');		
	});
}
function colorearTablaDercoBienes(id) {
    var table = $(id);
	if(!table) {
		return false;
	}
    var bodys = table.getElementsByTagName('tbody');
    var body = bodys[0];
    var rows = table.getElementsByTagName('tr');
	var row;
//    for(var i=0; row=rows[i]; i++) {
//		if(!row.className || row.className == 'par' || row.className == 'impar') {
//	        if(i%2 == 0) {
//				row.className = 'par';
//				row.onmouseout = function() {
//					//this.className = (this.className != 'filaSeleccionada') ? 'par' : 'filaSeleccionada';
//					this.className = 'par';
//				}
//			} else {
//				row.className = 'impar';
//				row.onmouseout = function() {
//					//this.className = (this.className != 'filaSeleccionada') ? 'impar' : 'filaSeleccionada';
//					this.className = 'impar';
//				}
//			}
//		}
//    }
}

function ventana(opcionesExtra){
    var opcionesBase = {
        className: 'mac_os_x',
        destroyOnClose: true,
        recenterAuto: false,
        showEffect: Element.show,
        hideEffect: Element.hide,
        overlayShowEffectOptions: {duration:0.1},
        overlayHideEffectOptions: {duration:0.1}
    };
    
    var opcionesVentana = $H(opcionesBase).merge(opcionesExtra);
    opcionesVentana = opcionesVentana.toObject();

    //var ventana = new Window(opcionesVentana.id, opcionesVentana);
    var ventana = new Window(opcionesVentana);
    ventana.showCenter(opcionesVentana.modal);

}

function confirmacion(opcionesExtra) {
    var opcionesBase = {
        className: 'alphacube',
        title: 'titulo',
        width: 300,
        height: 100,
        okLabel: 'Aceptar',
        cancelLabel: 'Cancelar',
        buttonClass: 'dialogoBoton',
        onOk: function(win) {
            return true;
        },
        onCancel: function(win) {
            return false;
        },
        showEffect: Element.show,
        hideEffect: Element.hide
    }
    var opcionesVentana = $H(opcionesBase).merge(opcionesExtra);
    opcionesVentana = opcionesVentana.toObject();
    
    Dialog.confirm(opcionesVentana.message, opcionesVentana);
}

function cerrarCaja(id) {
    $(id).update('');
}

/**
 * Cierra la ventana actual
 *
 */
function cerrarVentana() {
    window.close();
}

/**
 * Escribe en la barra de estado el mensaje especificado.
 *
 * @param string mensaje
 */
function cambiarStatusMsg(msg) {
	window.status = msg;
	return true;
}

/**
 * Devuelve una lista con la cadena agregada.
 * El separador por default es el espacio en blanco.
 *
 * @param string cadena cadena a agregar
 * @param string lista lista de cadenas
 * @param string separador de lista
 */
function agregarCadena(cadena, lista, separador) {
	var resultado = lista;
	if (!separador) {
		separador = ' ';
	}
	var patron = new RegExp(cadena);
	if (!patron.test(lista)) {
		resultado = lista + separador + cadena;
	}
	return resultado;
}

/**
 * Devuelve una lista de cadenas con todas las ocurrencias de la cadena eliminadas.
 *
 * @param string cadena cadena a agregar
 * @param string lista lista de cadenas
 */
function quitarCadena(cadena, lista) {
	var resultado = lista;
	var patron = new RegExp(cadena, 'g');
	if (patron.test(lista)) {
		resultado = lista.replace(patron, '');
	}
	return resultado;
}

/**
 * Valida en el documento si son enteros todas las entradas de texto cuya clase sea 'validarObligatorio',
 * devolviendo true si es así o false en caso contrario.
 * También agrega a cada campo la clase 'form_error'.
 *
 * @return boolean
 */ 
function validarObligatorios() {
	var resultado = true;
	var campos = $$('*.validarObligatorio');// * para soportar input, select...
	var campo;
	for (i=0; campo=campos[i]; i++) {
		var valor = $F(campo.id);
		var prueba = (valor!='');
		if (!prueba) {
			resultado = false;
			//campo.className = agregarCadena('form_error', campo.className);
			campo.addClassName('form_error');
			var mensajes = $$('span.'+campo.id);
			var mensaje;
			for (j=0; mensaje=mensajes[j]; j++) {
				mensaje.style.display = 'inline';
			}
		} else {
			//campo.className = quitarCadena('form_error', campo.className);
			campo.removeClassName('form_error');
			var mensajes = $$('span.'+campo.id);
			var mensaje;
			for (j=0; mensaje=mensajes[j]; j++) {
				mensaje.style.display = 'none';
			}
		}
	}
	return resultado;
}

/**
 * Valida en el documento si son enteros todas las entradas de texto cuya clase sea 'validarEnteroObligatorio',
 * devolviendo true si es así o false en caso contrario.
 * También agrega a cada campo la clase 'form_error'.
 *
 * @return boolean
 */ 
function validarFlotantesObligatorios() {
	var resultado = true;
	var campos = $$('input.validarFlotanteObligatorio');
	var campo;
	for (i=0; campo=campos[i]; i++) {
		var valor = campo.value;
		var prueba = parseFloat(valor);
		if (prueba!=valor) {
			resultado = false;
			//campo.className = agregarCadena('form_error', campo.className);
			campo.addClassName('form_error');
			var mensajes = $$('span.'+campo.id);
			var mensaje;
			for (j=0; mensaje=mensajes[j]; j++) {
				mensaje.style.display = 'inline';
			}
		} else {
			//campo.className = quitarCadena('form_error', campo.className);
			campo.removeClassName('form_error');
			var mensajes = $$('span.'+campo.id);
			var mensaje;
			for (j=0; mensaje=mensajes[j]; j++) {
				mensaje.style.display = 'none';
			}
		}
	}
	return resultado;
}

/**
 * Valida en el documento si son enteros todas las entradas de texto cuya clase sea 'validarFlotanteOpcional',
 * devolviendo true si es así o false en caso contrario.
 * También agrega a cada campo la clase 'form_error'.
 *
 * @return boolean
 */ 
function validarFlotantesOpcionales() {
	var resultado = true;
	var campos = $$('input.validarFlotanteOpcional');
	var campo;
	for (i=0; campo=campos[i]; i++) {
		var valor = campo.value;
		var prueba = parseFloat(valor);
		if (valor && prueba!=valor) {
			resultado = false;
			//campo.className = agregarCadena('form_error', campo.className);
			campo.addClassName('form_error');
			var mensajes = $$('span.'+campo.id);
			var mensaje;
			for (j=0; mensaje=mensajes[j]; j++) {
				mensaje.style.display = 'inline';
			}
		} else {
			//campo.className = quitarCadena('form_error', campo.className);
			campo.removeClassName('form_error');
			var mensajes = $$('span.'+campo.id);
			var mensaje;
			for (j=0; mensaje=mensajes[j]; j++) {
				mensaje.style.display = 'none';
			}
		}
	}
	return resultado;
}

/**
 * Valida en el documento si son enteros todas las entradas de texto cuya clase sea 'validarEnteroObligatorio',
 * devolviendo true si es así o false en caso contrario.
 * También agrega a cada campo la clase 'form_error'.
 *
 * @return boolean
 */ 
function validarEnterosObligatorios() {
	var resultado = true;
	var campos = $$('input.validarEnteroObligatorio');
	var campo;
	for (i=0; campo=campos[i]; i++) {
		var valor = campo.value;
		var prueba = parseInt(valor);
		if (prueba!=valor) {
			resultado = false;
			//campo.className = agregarCadena('form_error', campo.className);
			campo.addClassName('form_error');
			var mensajes = $$('span.'+campo.id);
			var mensaje;
			for (j=0; mensaje=mensajes[j]; j++) {
				mensaje.style.display = 'inline';
			}
		} else {
			//campo.className = quitarCadena('form_error', campo.className);
			campo.removeClassName('form_error');
			var mensajes = $$('span.'+campo.id);
			var mensaje;
			for (j=0; mensaje=mensajes[j]; j++) {
				mensaje.style.display = 'none';
			}
		}
	}
	return resultado;
}

/**
 * Valida en el documento si son enteros todas las entradas de texto cuya clase sea 'validarEnteroOpcional',
 * devolviendo true si es así o false en caso contrario.
 * También agrega a cada campo la clase 'form_error'.
 *
 * @return boolean
 */ 
function validarEnterosOpcionales() {
	var resultado = true;
	var campos = $$('input.validarEnteroOpcional');
	var campo;
	for (i=0; campo=campos[i]; i++) {
		var valor = campo.value;
		var prueba = parseInt(valor);
		if (valor && prueba!=valor) {
			resultado = false;
			//campo.className = agregarCadena('form_error', campo.className);
			campo.addClassName('form_error');
			var mensajes = $$('span.'+campo.id);
			var mensaje;
			for (j=0; mensaje=mensajes[j]; j++) {
				mensaje.style.display = 'inline';
			}
		} else {
			//campo.className = quitarCadena('form_error', campo.className);
			campo.removeClassName('form_error');
			var mensajes = $$('span.'+campo.id);
			var mensaje;
			for (j=0; mensaje=mensajes[j]; j++) {
				mensaje.style.display = 'none';
			}
		}
	}
	return resultado;
}

/**
 * Valida en el documento si son enteros todas las entradas de texto cuya clase sea 'validarPatron',
 * devolviendo true si es así o false en caso contrario.
 * También agrega a cada campo la clase 'form_error'.
 *
 * @patron string patron expresión regular del patrón válido
 * @nombreValidacion string nombre de clase usado como indicador de validación
 * @return boolean
 */ 
function validarPatron(patron, nombreValidacion) {
	var resultado = true;
	var re = new RegExp(patron);
	var campos = $$('input.'+nombreValidacion);
	var campo;
	for (i=0; campo=campos[i]; i++) {
		var valor = campo.value;
		var prueba = re.test(valor);
		if (!prueba) {
			resultado = false;
			//campo.className = agregarCadena('form_error', campo.className);
			campo.addClassName('form_error');
			var mensajes = $$('span.'+campo.id);
			var mensaje;
			for (j=0; mensaje=mensajes[j]; j++) {
				mensaje.style.display = 'inline';
			}
		} else {
			//campo.className = quitarCadena('form_error', campo.className);
			campo.removeClassName('form_error');
			var mensajes = $$('span.'+campo.id);
			var mensaje;
			for (j=0; mensaje=mensajes[j]; j++) {
				mensaje.style.display = 'none';
			}
		}
	}
	return resultado;
}

/**
 * Valida en el documento si emails validos todas las entradas de texto cuya clase sea 'validarEmail',
 * devolviendo true si es así o false en caso contrario.
 * También agrega a cada campo la clase 'form_error'.
 *
 * @return boolean
 */ 
function validarEmail() {
	var patron = '^([a-zA-Z0-9][a-zA-Z0-9_\\-\\.\\+]*)@([a-z0-9][a-z0-9\\.\\-]{0,63}\\.(com|org|net|biz|info|name|net|pro|aero|coop|museum|[a-z]{2,4}))$';
	return validarPatron(patron, 'validarEmail');
}

/**
 * Valida en el documento si emails validos todas las entradas de texto cuya clase sea 'validarEmailOpcional',
 * devolviendo true si es así o false en caso contrario.
 * También agrega a cada campo la clase 'form_error'.
 *
 * @return boolean
 */ 
function validarEmailOpcional() {
	var patron = '^(([a-zA-Z0-9][a-zA-Z0-9_\\-\\.\\+]*)@([a-z0-9][a-z0-9\\.\\-]{0,63}\\.(com|org|net|biz|info|name|net|pro|aero|coop|museum|[a-z]{2,4})))?$';
	return validarPatron(patron, 'validarEmailOpcional');
}

function trim(s)  {
	return s.replace(/^\s+|\s+$/g,"");
}

function ltrim(s) {
	return s.replace(/^\s+/,"");
}

function rtrim(s) {
	return s.replace(/\s+$/,"");
}

/**
 * Aplica el efecto Pulsate a todos los elementos con class=blink
 * 
 */
function blink(pulsos, duracion) {
	$$('*.blink').each(function(item, indice) {
		Effect.Pulsate(item, {pulses:pulsos, duration:duracion});
	});
}

/**
 * Valida el ingreso de 6 caracteres a mas de un chasis,

 *
 * @return boolean
 */ 
function validarChasis() {
	var patron = '^([a-zA-Z0-9]{6,})$';
	return validarPatron(patron, 'validarChasis');
}

/**
 * Funciones ara los check lists
 */	
function seleccionarItem(id) {
	var elemento = $(id);
	elemento.checked = (elemento.checked) ? false : true;
}

function seleccionarTodos(elemento) {
	var checks = $$('input.validarCheck');
	for(var i=0; i<checks.length; i++) {
		checks[i].checked = elemento.checked;
	}
}