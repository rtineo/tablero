$(document).ready(function(){
	//page_update();
	//refreshParent();
});

function page_update(){
	 var miDiv = $('#page_update');
	 var update = miDiv.attr('update');
	 var close_current = miDiv.attr('close_current');
	 
 	if(update){
	 	var page = miDiv.attr('page');
	 	switch(page){
			case 'parent': window.opener.location.reload(true);
				break;
			case 'current': window.reload(true);
				break; 
		}
	 }
	 
	 if(close_current){
	 	window.close();	
	 }
}

function refreshParent() {
  window.opener.location.href = window.opener.location.href;
	//getUrl('uscdiagrams/index');
	
  if (window.opener.progressWindow){
    window.opener.progressWindow.close()
  }
  //window.close();
}

//<body onunload="opener.location=('page.asp')">