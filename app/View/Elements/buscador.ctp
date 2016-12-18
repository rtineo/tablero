<?php
	echo $this->Form->create('Buscar',array('url' =>$url));
	echo $this->Form->label(__('desactivo'));
	echo $this->Form->checkbox('desactivo');
	echo '&nbsp;';
	echo $this->Form->select('buscador',$elementos,array('class'=>'buscador','empty'=>FALSE)); 
	echo '&nbsp;'; 
	echo $this->Form->text('valor', array('class'=>'span-5 buscador-text' ));
	echo '&nbsp;'; 
	echo $this->Form->submit(__('Search'),array('div'=>false));
	echo $this->Form->end();
?>