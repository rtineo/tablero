<div class="calendarioBarraNavegacion">
    <?php
	if (!empty($anterior)) {
		echo $this->Xhtml->imageTextLink(
			'derco/defecto/anterior.png', 
			__('MONTH_ETIQUETA_ANTERIOR'),
			'javascript:;',
			array('onclick'=>"mostrarMes(".$anterior['anio'].", ".$anterior['mes'].")", 'escape'=>false),
			null, array('width'=>'16'));
	} else {
		echo '<span class="inactivo">';
		echo $this->Xhtml->imageText('anterior.png', __('MONTH_ETIQUETA_ANTERIOR'), array('width'=>'16'));
		echo '</span>';
	}
	?>
	-
    <?php
	if (!empty($siguiente)) {
		echo $this->Xhtml->textImageLink(
			'derco/defecto/siguiente.png', 
			__('MONTH_ETIQUETA_SIGUIENTE'),
			'javascript:;',
			array('onclick'=>"mostrarMes(".$siguiente['anio'].", ".$siguiente['mes'].")", 'escape'=>false),
			null,
			array('width'=>'16'));
	} else {
		echo '<span class="inactivo">';
		echo $this->Xhtml->textImage('siguiente.png', __('MONTH_ETIQUETA_SIGUIENTE'), array('width'=>'16'));
		echo '</span>';
	}
	?>
</div>