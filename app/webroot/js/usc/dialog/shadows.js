var classShadow = 'av-shadow-base';
var htmShadow = '<!-- ui-dialog -->'
				+'<div class="av-html-shadow-div">'
					+'<div class="ui-overlay">'
							+'<div class="ui-widget-overlay"></div>'
							+'<div class="ui-widget-shadow ui-corner-all" style="width: 122px; height: 72px; position: absolute; left: 50px; top: 30px;"></div>'
					+'</div>'
					+'<div style="position: absolute; width: 100px; height: 50px; left: 50px; top: 30px; padding: 10px;" class="ui-widget ui-widget-content ui-corner-all">'
						+'<div class="ui-dialog-content ui-widget-content" style="background: none; border: 0;">'
							+'<ul class="av-shadow-ul usc-search-icon">'
								+'<li class=""><span>Activar &nbsp;</span></li>'
							+'</ul>'
						+'</div>'
					+'</div>'
				+'</div>';

function setShadow(id){
	var li = $($('#'+id).find('li').get(2)).clone();
	li.removeClass('hide');
	$('#'+id).append(htmShadow);
	$('#'+id).find('ul.av-shadow-ul').append(li);
	
	$('#'+id).addClass(classShadow);
}

function getShadow(id){
	return $('#'+id).hasClass(classShadow);
}

function delShadow(id){
	$('#'+id).removeClass(classShadow);
	$('#'+id).find('.av-html-shadow-div').remove();
}

function setShadowUsecase(){
	id = 'dtCasoUso';
	
	var li = '<li title="Activar caso de uso" class="ui-state-default ui-corner-all">'
				+'<span class="ui-icon ui-icon-power" onclick="delShadowUsecase()"></span>'
			+'</li>';
	
	$('#'+id).parent().append(htmShadow);
	$('#'+id).parent().find('ul.av-shadow-ul:last').append(li);
	$('#'+id).parent().addClass(classShadow);
}

function delShadowUsecase(){
	id = 'dtCasoUso';
	$('#UscusecaseStatus').attr('value','AC');
	$('#'+id).parent().removeClass(classShadow);
	$('#'+id).parent().find('.av-html-shadow-div:last').remove();
}