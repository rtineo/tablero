<?php
	echo $this->Form->create('Buscar',array('url' =>$url));
	echo $this->Form->label(__('Cliente'));
	echo '&nbsp;';
	echo $this->Form->text('nombres', array('class'=>'span-5 buscador-text' ));	
	echo '&nbsp;'; 
	echo '&nbsp;'; 
	echo $this->Form->label(__('Placa N°'));
	echo '&nbsp;';
	echo '&nbsp;';
	echo '&nbsp;';
	echo '&nbsp;';
	echo '&nbsp;';
	echo '&nbsp;';
	echo '&nbsp;';	
	echo $this->Form->text('placa', array('class'=>'span-5 buscador-text' ));	
	echo '&nbsp';
	echo $this->Form->label(__('Estado'));
	echo '&nbsp;';
	echo $this->Form->select('crt',$elementos ,array('class'=>'buscador','empty'=>'Seleccione'),false);
	echo '&nbsp;'; 
	echo $this->Form->submit(__('Search'),array('div'=>false));
	echo $this->Form->end();
?>