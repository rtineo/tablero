<?php
	echo $this->Form->create('bsc',array('url' =>$url, 'target'=>'_self'));
	echo $this->Form->label(__('Fecha de la cita del'));
	echo '&nbsp;';
	echo $this->Form->input('f_ini', array('id'=>'f_ini','div'=>false, 'label'=>false, 'readonly'=>true));
	echo $this->Html->image('derco/defecto/calendar_disabled.gif', array('onclick'=>"$('#f_ini').val(''); return false; ",'div'=>false, 'label'=>false));
	echo '&nbsp;'; 
	echo '&nbsp;'; 
	echo $this->Form->label(__('Al'));
	echo '&nbsp;';
	echo $this->Form->input('f_fin', array('id'=>'f_fin', 'div'=>false, 'label'=>false, 'readonly'=>true));
	echo $this->Html->image('derco/defecto/calendar_disabled.gif', array('onclick'=>"$('#f_fin').val(''); return false; ",'div'=>false, 'label'=>false));
	echo '&nbsp';
	echo $this->Form->label(__('Cliente'));
	echo '&nbsp;';
	echo $this->Form->text('vlr', array('class'=>'span-5 buscador-text' ));
	echo '&nbsp;'; 
	echo $this->Form->submit(__('Search', array('class'=>'buscar')),array('div'=>false));
	echo $this->Form->end();