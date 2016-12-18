var urlBase = $('#dtBasic');

$().ready(function(){
	 $( "input[type=submit]" ).button();
});

function isArray(myArray) {
    return myArray.constructor.toString().indexOf("Array") > -1;
}

function cmbAni(padreId, hijoArrayId, miUrl){
	$('#'+padreId).change(function(){
		val = $('#'+padreId+' option:selected').val();
		
		$.ajax({
			url: getUrl(miUrl),
			data:{id:val},
			dataType:'json',
			beforeSend: function(){
				if(isArray(hijoArrayId)){
					hijoId = hijoArrayId[0];
					for	(index = 1; index < hijoArrayId.length; index++) {
					    OtroHijoId = $('#'+hijoArrayId[index]);
						OtroHijoId.find('option').remove();
						OtroHijoId.append('<option value="">-- Todo --</option>');
					}	
				}else{
					hijoId = hijoArrayId;
				}
				img = $('#'+hijoId).next();
				img.removeClass('hide');
				hijo = $('#'+hijoId);
				hijo.find('option').remove();
				hijo.append('<option value="">-- Todo --</option>');
				
				if(val == null || val == '' || val == undefined){
					img.addClass('hide');
					return false;
				}
			},
			success:function(response){
				if(!response._empty){
					$.each(response.rows,function(key, value){
					    hijo.append('<option value=' + value.key + '>' + value.value + '</option>');
					});
				}	
				img.addClass('hide');
			},
			error:function(){
				img.addClass('hide');
				return false;
			}
		});	
	});
} 

function cmbAni_02(padreId, hijoArrayId, miUrl){
	$('#'+padreId).change(function(){
		val = $('#'+padreId+' option:selected').val();
		
		$.ajax({
			url: getUrl(miUrl),
			data:{id:val},
			dataType:'json',
			beforeSend: function(){
				if(isArray(hijoArrayId)){
					hijoId = hijoArrayId[0];
					for	(index = 1; index < hijoArrayId.length; index++) {
					    OtroHijoId = $('#'+hijoArrayId[index]);
						OtroHijoId.find('option').remove();
					}	
				}else{
					hijoId = hijoArrayId;
				}
				img = $('#'+hijoId).next();
				img.removeClass('hide');
				hijo = $('#'+hijoId);
				hijo.find('option').remove();
				
				if(val == null || val == '' || val == undefined){
					img.addClass('hide');
					return false;
				}
			},
			success:function(response){
				if(!response._empty){
					$.each(response.rows,function(key, value){
					    hijo.append('<option value=' + value.key + '>' + value.value + '</option>');
					});
				}	
				img.addClass('hide');
			},
			error:function(){
				img.addClass('hide');
				return false;
			}
		});	
	});
} 

function getUrl(urlCake){
	return urlBase.attr('href')+urlCake;
}

function reload_parent(){
	window.opener.location.reload(true);
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