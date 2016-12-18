<?php 
		$url = $this->Html->url(array('controller'=>'Agecitacalendariodias','action'=>'mostrarmes',$url_unido));
		$image = $this->Html->image('permiso.png', array('title'=>__('modificarCalendario',true), "alt" => "Editar"));
		echo $this->Html->link($image, 'javascript:;',array('onclick' => "modificarCronograma('".$url."')",'escape'=>false), null);
?>