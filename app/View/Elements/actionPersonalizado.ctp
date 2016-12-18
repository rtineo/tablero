<?php 	if(!empty($urlview)){	
			$url = $this->Html->url(array('action'=>'view', $urlview));
			$image = $this->Html->image('mostrar.png', array('title'=>__('ver',true), "alt" => "mostrar"));
			echo $this->Html->link($image, 'javascript:;',array('onclick' => "mostrar('".$url."')",'escape'=>false), null);
		}
?>		
<?php 	if(!empty($urledit)){	
			$url = $this->Html->url(array('action'=>'edit', $urledit));
			$image = $this->Html->image('editar.png', array('title'=>__('editar',true), "alt" => "Editar"));
			echo $this->Html->link($image, 'javascript:;',array('onclick' => "editar('".$url."')",'escape'=>false), null);
		}
?>	
<?php   if(empty($name)){$name=$id;}
		if(empty($estado) || $estado == 'AC' || $estado == 'LI'){
			echo $this->Html->link($this->Html->image('eliminar.png', array('title'=>__('desactivar',true), "alt" => "Eliminar")), 
					array('action'=>'delete', $urldelete), array('escape'=>false), sprintf(__('estaSeguroEliminar %s?', true), 
					$name)); 
		}
?>		