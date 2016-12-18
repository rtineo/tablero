
function addRegister(tableId,keyArray){
	var tbody = $('table#'+tableId+' tbody');
	var numero_registros = tbody.find('tr').length;
	var primer_registro = tbody.find("tr:first").clone();
	
	primer_registro.find('input, select').each(function(i,e){
		$(e).attr("name",$(e).attr("name").replace("data["+keyArray+"][0","data["+keyArray+"]["+numero_registros));
		$(e).attr("id",$(e).attr("id").replace(keyArray+"0",keyArray+numero_registros));
		$(e).attr("value","");
	});
	primer_registro.find('textarea').each(function(i,e){
		console.log(e);
		$(e).attr("name",$(e).attr("name").replace("data["+keyArray+"][0","data["+keyArray+"]["+numero_registros));
		$(e).attr("id",$(e).attr("id").replace(keyArray+"0",keyArray+numero_registros));
		$(e).attr("value","");
	});
	
	tbody.append(primer_registro);
}

function delRegister(tableId, keyArray, miThis, msg){
	var tbody = $('table#'+tableId+' tbody');
	var numberRegister = tbody.find('tr').length;
	
	if(numberRegister < 2){
		if(msg == undefined) msg='Minimo un registro';
		alert(msg);
		return false;
	}
	
	$(miThis).parent().parent().parent().parent().remove();
	actNumberRegister(tableId,keyArray);
}

function actNumberRegister(tableId,keyArray){
	var tbody = $('table#' + tableId + ' tbody');
	
	var ExpId = new RegExp("^"+keyArray+".");
	var ExpData = new RegExp("^data\\["+keyArray+"\\]\\[.");
	
	tbody.find('tr').each(function(i,tr){
		$(tr).find('input, select, textarea').each(function(j,e){
			$(e).attr('id', $(e).attr('id').replace(ExpId, keyArray+i));
			$(e).attr('name', $(e).attr('name').replace(ExpData, 'data['+keyArray+']['+i));
		});		
	});
}