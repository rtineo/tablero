<?php 
	if(empty($name)) $name=$id;

	$url = $this->Html->url(array('action'=>'edit', $id));
	$image = $this->Html->image('derco/defecto/modificar.png', array('title'=>__('modificar',true), "alt" =>__('modificar',true)));
	echo $this->Html->link($image, 'javascript:;',array('onclick' => "editar('".$url."')",'escape'=>false), null);

	if(!empty($estado)){
		if(in_array($estado, array('AC','DE','LI')))
			echo $this->Html->link(
				$this->Html->image('derco/defecto/eliminar.png', array('title'=>__('eliminar',true), "alt" =>__('eliminar',true))), 
				array('action'=>'delete', $id), 
				array('escape'=>false), 
				sprintf(__('estaSeguroEliminar %s?'), $name)
			); 
	}
?>		