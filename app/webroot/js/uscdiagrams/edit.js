function desactivarUsecase(vlr){
	$('#UscusecaseStatus').attr('value',(vlr == 1)?'AC':'DE');
	setShadowUsecase();
}

function versionarUsecase(vlr){
	$('#UscusecaseVersionar').attr('value',vlr);
	var uc_li = $('#usecaseVersionActive').find('li');
	
	if(vlr == 1){
		$(uc_li[2]).addClass('hide');
		$(uc_li[3]).removeClass('hide');
	}else{
		$(uc_li[2]).removeClass('hide');
		$(uc_li[3]).addClass('hide');
	}
}

function versionarDiagrama(vlr){
	$('#UscdiagramVersionar').attr('value',vlr);
	var uc_li = $('#diagramVersionActive').find('li');
	
	if(vlr == 1){
		$(uc_li[0]).addClass('hide');
		$(uc_li[1]).removeClass('hide');
	}else{
		$(uc_li[0]).removeClass('hide');
		$(uc_li[1]).addClass('hide');
	}
}