$().ready(function(){
	validateForm();
});


function validateForm(){
	$('#AyudaAddForm').validate({
		submitHandler:function(form){
			var $list = 'input[type=submit],input[type=button],input[type=reset],button';
			$(form).find($list).attr('disabled','disabled');
			form.submit();
			return false;
		},
		errorPlacement: function(label, element){	
			if(element.hasClass('msg_error_1'))
				label.insertAfter(element.next());
			else if (element.hasClass('msg_error_2'))
				label.insertAfter(element.next().next());
			else if (element.hasClass('msg_error_3'))
				label.insertAfter(element.next().next().next());
			else
				label.insertAfter(element);
		}   
	});
}