var tableIdAct = false;
$(document).ready(function(){
	inicializarDialogo();
	autors.init();
});

function buscarActor(tableId){
	tableIdAct = tableId;
	abrirDialog('dialog_actor');
}

function abrirDialog(id_div){
	$("#"+id_div).dialog('open');
}

function inicializarDialogo(){
	$("#dialog_actor").dialog({
		bgiframe: true,
		resizable: false,
		height: 240,
		width: 400,
		modal: true,
		autoOpen: false,
		overlay: {
			backgroundColor: '#000',
			opacity: 0.5
		}
	});
}

var autors = {
	init:function(){
		jQuery("#actors").jqGrid({ 
			url:getUrl('uscactors/getActors?dgm='+$('#UscdiagramId').val()), 
			datatype: "json", 
			colNames:['id','Actor', 'status'], 
			colModel:[ 
				{name:'id',index:'id',hidden:true}, 
				{name:'name',index:'name',width: 360,editable:true,editoptions:{readonly:false,size:40}}, 
				{name:'status',index:'status',hidden:true},
			], 
			rowNum:10, 
			rowList:[10,20,30], 
			pager: '#actors-pager', 
			sortname: 'Uscactor.name', 
			viewrecords: true, 
			sortorder: "desc", 
			caption:false,
			height:'125',
			ondblClickRow: function(id) {
				if (!(id == null)) {
					var gr = jQuery("#actors").jqGrid('getRowData',id);
					if( gr != null ){
						//console.log(gr.id+'-'+gr.name+'-'+gr.status);
						
						if(!getExisteActor(gr.id,gr.name,gr.status)){
							//agregamos un registro en actor
							agregarRegistroActores(true);
							
							//llenamos los datos en el registro
							actualizarUltimoActor(gr.id,gr.name,gr.status);	
						}
					}
				}
			},
			editurl:getUrl('uscactors/setActors?dgm='+$('#UscdiagramId').val()), 
		}); 
		
		jQuery("#actors").jqGrid('navGrid','#actors-pager',
			{edit:true,add:true,del:false,search:false},
			{width:420, clearAfterEdit:false,reloadAfterSubmit:true, closeOnEscape:true,afterSubmit:autors.afterSubmit},
			{width:420, clearAfterAdd:true,reloadAfterSubmit:true, closeOnEscape:true, afterSubmit:autors.afterSubmit},
			{reloadAfterSubmit:true, closeOnEscape:true}	
		);
		 
		$("#actors").jqGrid('filterToolbar',{stringResult: true,searchOnEnter : true});
		
		
	},
	afterSubmit: function(response, postdata) {
		var success = true;
    	var message = ""
    	var json = eval('(' + response.responseText + ')');
    	if(json.errors) {
    		success = false;
    		for(i=0; i < json.errors.length; i++) {
    			message += json.errors[i] + '<br/>';
    		}
    	}
    	var new_id = "1";
		
		if(!(postdata.id == '_empty') && success){
			getExisteActor(postdata.id,postdata.name,'AC');
		}
		
    	return [success,message,new_id];
    }
}