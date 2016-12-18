<!--
PARAMETROS DE INGRESO

array(
	'title'=>'', (string)
	'windowname'=>'', (string)
	'features'=>'', (string)
	'width'=>'', (integer)
	'heigth'=>'', (integer)
	'isCenter'=>'' (string) (required)
)
-->

<?php echo $html->script('usc/popup.js'); ?>
<div>
<?php
	if(empty($title)) $title =  'title';
	if(empty($windowname)) $windowname =  $title.'_basic';
	if(empty($features)) $features =  '';
	if(empty($width)) $width =  650;
	if(empty($heigth)) $heigth =  450;
	if(empty($isCenter)) $isCenter =  false;
	
	
	if(empty($url)) echo 'URL NO VALIDA';
	else{
		$url = $this->Html->url($url);
		echo $form->button(__($title,true), array('class'=>'uscButton', 'onclick'=>"OpenBrWindow('$url','$windowname','$features',$width,$heigth,$isCenter)"));
	}
?>
</div>