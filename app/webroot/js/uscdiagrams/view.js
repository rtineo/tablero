var delStep = false;
var delActor = false;

$(function(){
	// Accordion
	$("#accordion").accordion({ 
		header: "h3",
		autoHeight: false,
		navigation: true 
	});
	
	
	nicEditors.allTextAreas({
		buttonList:[]
	});
	
	$('.nicEdit-main').attr('contenteditable',false);
	$('input').attr('readonly',true);
	dialogImage();
});

function viewClose(){
	window.close();
}
