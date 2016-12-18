$(document).ready(function(){

	$('#menu-acos1 > ul').addClass('red');
	$('#menu-acos > ul').addClass('red');
	$('#menu-aros > ul').addClass('red');
	$('#programas-list > ul').addClass('red');
	$('#listaDeAccesos > ul').addClass('red');

	// third example
	$(".red").treeview({
		animated: "fast",
		collapsed: true,
		unique: true,
		persist: "location",
		toggle: function() {
			//window.console && console.log("%o was toggled", this);
		}
	});
/*
	$('#menu a').bind('click',function(){
		//return false;
		$('#menu a').unbind('click');
		$('#menu a').bind('click',function(){return false;});
	});
*/
});