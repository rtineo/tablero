$(function(){
	cargar_check();
});

function cargar_check(){
	$('.conformidad').hide();		
	var empty = $.url('/js/jcheckbox/empty.png');
	
	var wrapper = $('<span class="jquery-safari-checkbox"><span class="mark"><img src="' + empty + '" /></span></span>');
	$('.conformidad').after(wrapper);
	$('.jquery-safari-checkbox').bind('mouseenter',span_enter);
	$('.jquery-safari-checkbox').bind('mouseleave',span_leave);
	$('.jquery-safari-checkbox').bind('click', span_click);
	$('.conformidad').bind('change',ch_change);
	//$('.conformidad').trigger('change');
	desactivar_chk();
}

var span_enter = function(){
	$($(this).find('.mark')[0]).addClass('jquery-safari-checkbox-hover');
}

var span_leave = function(){
	$($(this).find('.mark')[0]).removeClass('jquery-safari-checkbox-hover');
}

var span_click = function(e){	

	var check = $(this).prev();
	var check_val = check.val(); 
	if (check_val == '2') {
		$(this).addClass('jquery-checkbox-checked').addClass('jquery-safari-checkbox-checked');
		check.val('1');
	}else if(check_val == '1'){
		$(this).addClass('jquery-checkbox-checked').removeClass('jquery-safari-checkbox-checked').addClass(('jquery-safari-checkbox-unchecked'));
		check.val('3');
	}else if(check_val == '3'){
		$(this).addClass('jquery-checkbox-checked').removeClass('jquery-safari-checkbox-unchecked');
		check.val('2');
	}
	//check.trigger('click');
}

var ch_change = function(e){	

	var check = $(this);
	var check_val = check.val();
		 
	if (check_val == '2') {
		$(this).next().addClass('jquery-checkbox-checked').removeClass('jquery-safari-checkbox-unchecked').removeClass('jquery-safari-checkbox-checked');		
	}else if(check_val == '1'){
		$(this).next().addClass('jquery-checkbox-checked').addClass('jquery-safari-checkbox-checked').removeClass('jquery-safari-checkbox-unchecked');
	}else if(check_val == '3'){
		$(this).next().addClass('jquery-checkbox-checked').removeClass('jquery-safari-checkbox-checked').addClass('jquery-safari-checkbox-unchecked');
				
	}	
}

function desactivar_chk(){
	$('.conformidad').each(function(){
		if($(this).is(':disabled')){
		
		$($(this).next().find('.mark')[0]).addClass('jquery-safari-checkbox-disabled');
		$(this).next().unbind('click');
		$(this).attr('disabled','')
	}else{
		$(this).trigger('change');
	}
	});	
}
