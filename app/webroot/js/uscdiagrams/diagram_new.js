var delActor = false;

function pruebas(){
	var re = new RegExp("\\w+");
	console.debug(re);
	var re = /\w+/;
	console.debug(re);
	
	var Paso = 'step1';
	var re = new RegExp("^"+Paso+".");
	console.debug(re);
	var re = /^Step1./;
	console.debug(re);
}

$(function(){
	//pruebas();
	
	// Accordion
	$("#accordion").accordion({ 
		header: "h3",
		autoHeight: false,
		navigation: true 
	});
	
	
	// CREAMOS EL TEXTO ENRIQUECIDO
	panelInstance();
	
	actualizarBotonEliminarActores();
	dialogImage();
	
	// VALIDAMOS EL FORMULARIO
	$('#formUsecase').validate({});
});

function panelInstance(){
	$('.panelInstance').each(function(i,e){
		new nicEditor({buttonList : ['fontSize','fontFamily','bold','italic','underline','strikeThrough','subscript','superscript','html','forecolor']}).panelInstance($(e).attr('id'));
	});	
}

// RETORNA EL NUMERO DE ESCENARIO
function getNroScenario(){
	var nroSc = $('#dtScenarios').attr('nroScenario');
	return parseInt(nroSc);
}

// FUNCIONES UTILIZADAS PARA EL SCENARIO ###########################################
function newScenario(){
	var nvoNroSceneario = getNroScenario() + 1;
	$.ajax({
		url: getUrl('uscscenarios/newScenario?sc='+nvoNroSceneario),
		success: function(data) {
			$('#dtScenarios').append(data);
			$('#dtScenarios').attr('nroScenario',nvoNroSceneario);
			actualizarBotonEliminarSteps('Step'+nvoNroSceneario);
			new nicEditor({buttonList : ['fontSize','fontFamily','bold','italic','underline','strikeThrough','subscript','superscript','html','forecolor']})
				.panelInstance('Description_'+nvoNroSceneario);
		}
	});	
}

function activarScenario(nrScenario, miThis){
	//miThis.parent().next().removeClass('hide');
	//miThis.parent().addClass('hide');
	$('#Status_'+nrScenario).attr('value','AC');
	
	delShadow('Scenario_'+nrScenario);
}

function desactivarScenario(nrScenario, miThis){
	//miThis.parent().prev().removeClass('hide');
	//miThis.parent().addClass('hide');
	$('#Status_'+nrScenario).attr('value','DE');
	
	setShadow('Scenario_'+nrScenario);
}

function eliminarScenario(nrScenario, miThis){
	var nroSc = $('#dtScenarios').find('fieldset').length;
	if(nroSc == 1){
		alert('Debe tener almenos un escenario creado');
		return false;
	}else{
		$('#Scenario_'+nrScenario).parent().remove();	
	}
}



//PERMITE AGREGAR UN NUEVO REGISTRO A LA TABLA DE DETALLES  ###############################################################
function agregarRegistroActores(vrfc){
	var tbody = $('table#actores tbody');
	var numero_registros = tbody.find('tr').length;
	var primer_registro = tbody.find("tr:first").clone();
	var firt_inputId = $(primer_registro.find("input").get(0)).val();
	
	if((tbody.find('tr').length == 1) && (firt_inputId == '') && vrfc){
		return false;
	} 
	
	primer_registro.find("input").each(function(i,e){
		$(e).attr("name",$(e).attr("name").replace("data[Actores][0","data[Actores]["+numero_registros));
		$(e).attr("id",$(e).attr("id").replace("Actores0","Actores"+numero_registros));
		$(e).attr("value","");
	});
	
	tbody.append(primer_registro);
	actualizarBotonEliminarActores();
}

function getExisteActor(id,name,status){
	var tbody = $('table#actores tbody');
	var rpt = false;
	tbody.find('tr').each(function(i,e){
		if($($(e).find('input').get(0)).val() == id){
			$($(e).find('input').get(2)).attr('value',name);
			rpt = true;
		} 
	});
	
	return rpt;
}
function actualizarUltimoActor(id,name,status){
	var tbody = $('table#actores tbody');
	var ultimo_registro = tbody.find("tr:last");
	$(ultimo_registro.find("input").get(0)).attr('value',id);
	$(ultimo_registro.find("input").get(1)).attr('value',status);
	$(ultimo_registro.find("input").get(2)).attr('value',name);
}
//PERMITE VISUALIZAR EL BOTON ELIMINAR
function actualizarBotonEliminarActores(){
	var tbody = $('table#actores tbody');
	var numero_registros = tbody.find('tr').length;
	if(numero_registros == 1){ tbody.find('tr:first .eliminarRegistro').addClass('hide'); }
	else{ tbody.find('tr .eliminarRegistro').removeClass('hide'); }
}

//REINICIA LA NUMERACION DE LOS DETALLES
function actualizarNumeracionRegistroActores(){
	var tbody = $('table#actores tbody');
	tbody.find('tr').each(function(i,tr){
		$(tr).find('input, select').each(function(j,e){
			$(e).attr('id', $(e).attr('id').replace(/^Actores./, 'Actores'+i));
			$(e).attr('name', $(e).attr('name').replace(/^data\[Actores\]\[./, 'data[Actores]['+i));
		});		
	});
}

//ELIMINA UN REGISTRO
function eliminarRegistroActores(miThis){
	var tr = $(miThis).parent().parent().parent().parent();
	var nroTr = tr.parent().find('tr').length;
	
	if(nroTr == 1){
		alert('Debe ser ingresado un actor como minimo');
		return false;
	}else{
		tr.remove();
		actualizarNumeracionRegistroActores();
		actualizarBotonEliminarActores();
	}
}

//PERMITE AGREGAR UN NUEVO REGISTRO A LA TABLA DE DETALLES  ###############################################################
function agregarRegistroSteps(tableId){
	var tbody = $('table#'+tableId+' tbody');
	var numero_registros = tbody.find('tr').length;
	var primer_registro = tbody.find("tr:first").clone();
	
	primer_registro.find("input").each(function(i,e){
		$(e).attr("name",$(e).attr("name").replace("data["+tableId+"][0","data["+tableId+"]["+numero_registros));
		$(e).attr("id",$(e).attr("id").replace(tableId+"0",tableId+numero_registros));
		$(e).attr("value","");
	});
	
	tbody.append(primer_registro);
	actualizarBotonEliminarSteps(tableId);
	
	$('table#'+tableId).attr('steps',numero_registros);
}

//PERMITE VISUALIZAR EL BOTON ELIMINAR
function actualizarBotonEliminarSteps(tableId){
	var tbody = $('table#'+tableId+' tbody');
	var numero_registros = tbody.find('tr').length;
	if(numero_registros == 1){ $('table#'+tableId).attr('steps',1); }
	else{ tbody.find('tr .eliminarRegistro').removeClass('hide'); }
}

//REINICIA LA NUMERACION DE LOS DETALLES
function actualizarNumeracionRegistroSteps(tableId){
	var tbody = $('table#' + tableId + ' tbody');
	
	var ExpId = new RegExp("^"+tableId+".");
	var ExpData = new RegExp("^data\\["+tableId+"\\]\\[.");
	
	tbody.find('tr').each(function(i,tr){
		$(tr).find('input, select').each(function(j,e){
			$(e).attr('id', $(e).attr('id').replace(ExpId, tableId+i));
			$(e).attr('name', $(e).attr('name').replace(ExpData, 'data['+tableId+']['+i));
		});		
	});
}

//ELIMINA UN REGISTRO
function eliminarRegistroSteps(tableId, miThis){
	var delStep = $('table#'+tableId).attr('steps');
	if(delStep < 2){
		alert('Ingresar minimo un paso');
		return false;
	}
	$(miThis).parent().parent().parent().parent().remove();
	actualizarNumeracionRegistroSteps(tableId);
	actualizarBotonEliminarSteps(tableId);
	
	$('table#'+tableId).attr('steps', delStep-1);
}

function upSteps(tableId, miThis){
	var delStep = $('table#'+tableId).attr('steps');
	if(delStep < 2){
		return false;
	}
	console.debug(delStep);
	//guardamos el valor del registro a mover
	var tr = $(miThis).parent().parent().parent().parent();
	var trClone = tr.clone();
	
	//marcamos el registro a subir
	tr.attr('id','up');
	
	var tbody = $('table#'+tableId+' tbody');
	var thisTrAnt = '';
	
	//recorremos cada uno de los registros
	tbody.find('tr').each(function(i,e){
		if ($(this).is("#up")){
			if(i == 0){
				tr.attr('id','');
				return false;
			} 
			
			thisTrAnt.before(trClone);
			tr.remove();
          	return false;
        }
		thisTrAnt = $(this);
	});
	
	actualizarNumeracionRegistroSteps(tableId);
	actualizarBotonEliminarSteps(tableId);
}

function downSteps(tableId, miThis){
	var delStep = $('table#'+tableId).attr('steps');
	if(delStep < 2){
		return false;
	}
	
	//guardamos el valor del registro a mover
	var tr = $(miThis).parent().parent().parent().parent();
	var trClone = tr.clone();
	
	//marcamos el registro a subir
	tr.attr('id','down');
	
	var tbody = $('table#'+tableId+' tbody');
	var encontrado = false;
	//recorremos cada uno de los registros
	tbody.find('tr').each(function(i,e){
		if(encontrado){
			$(this).after(trClone);
			tr.remove();
			return false;
		}
		if ($(this).is("#down")){
			tr.attr('id','');
			encontrado = true;
        }
	});
	
	actualizarNumeracionRegistroSteps(tableId);
	actualizarBotonEliminarSteps(tableId);
}

function formCancel(formId){
	window.close();
	return false;
}
