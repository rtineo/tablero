<!--
	C:\wamp\www\tablerousecase\app\webroot\js\usc\dialog_image.js
	<?php echo $html->script('usc/dialog_image.js'); ?>
	
	EN EL JS PROPIO INCLUIR ESTA LINEA
	dialogImage();
-->
<?php if(!empty($nameFileStore)): 
		$dialogImageId = explode('.', $nameFileStore);
		$dialogImageId = $dialogImageId['0'];
		
		$forder = explode('_', $nameFileStore);
?>
	<ul class="usc-search-icon">
		<li title="Ver imagen" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-image" onclick="seeImage('<?php echo $dialogImageId ?>')"></span></li>
	</ul>
		
	<!-- ui-dialog -->
	<div class="usc_dialog" id="<?php echo $dialogImageId ?>" title="Imagen">
		<img src="<?php echo $this->webroot.$forder['0'].'/'.$nameFileStore; ?>"> 
	</div>	
<?php endif; ?>