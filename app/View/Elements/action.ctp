<?php 		
		$url = $this->Html->url(array('action'=>'view', $id));
		$image = $this->Html->image('mostrar.png', array('title'=>__('ver',true), "alt" => "mostrar"));
		echo $this->Html->link($image, 'javascript:;',array('onclick' => "mostrar('".$url."')",'escape'=>false), null);	
?>		
<?php 
		$url = $this->Html->url(array('action'=>'edit', $id));
		$image = $this->Html->image('editar.png', array('title'=>__('editar',true), "alt" => "Editar"));
		echo $this->Html->link($image, 'javascript:;',array('onclick' => "editar('".$url."')",'escape'=>false), null);
?>	
<?php   //if(empty($name)){$name=$id;}
		if(empty($estado) || $estado == 'AC' || $estado == 'LI'){
			echo $this->Html->link($this->Html->image('eliminar.png', array('title'=>__('desactivar',true), "alt" => "Eliminar")), 
					array('action'=>'delete', $id), array('escape'=>false), sprintf(__('estaSeguroEliminar %s?'), $name)); 
		}
?>		