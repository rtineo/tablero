<style>
	a {
		text-decoration: none;
	}
</style>
<fieldset>
	<legend>Programas</legend>
	
	<div id="programas-list">
<?php	foreach($programas as $key => $programa)		
		{
			if(!empty($programa['secprograms']['etiqueta']))
			{
				echo $programa['secprograms']['listaDesordenada'];echo $programa['secprograms']['etiqueta'];
				if(empty($programa['secprograms']['aco_id']))
					//echo '&nbsp;'.$this->Html->link('+',array('action'=>'nuevaItemDeMenu',$aro_id,$programa['Programa']['id']));
					echo '&nbsp;'.$this->Html->link($this->Html->image('agregar.png',array('alt' => 'agregar','title' => 'Agregar')),
										  array('action'=>'add',$aro_id,$programa['secprograms']['id']),
										  array('escape'=>false),
										  null);	
				echo '&nbsp;'.$this->Html->link($this->Html->image('editar.png',array('alt' => 'editar','title' => 'Editar')),
										  array('action'=>'edit',$programa['secprograms']['id']),
										  array('escape'=>false),
										  null);
										  
				$mensaje = " 'Estas seguro que deseas eliminar el item ".$programa['secprograms']['etiqueta']." ?";			
				//echo '&nbsp;'.$this->Html->link('-',array('action'=>'eliminarItemDeMenu',$aro_id,$programa['Programa']['id']), null,$mensaje);
				echo '&nbsp;'.$this->Html->link($this->Html->image('eliminar.png',array('alt' => 'eliminar','title' => 'Eliminar')),
										  array('action'=>'delete',$aro_id,$programa['secprograms']['id']),
										  array('escape'=>false),
										  $mensaje);
				if($programa['0']['arriba'] == 1)					  
				echo '&nbsp;'.$this->Html->link($this->Html->image('flechaArriba.png',array('alt' => 'flechaArriba','title' => 'Subir Item')),
										  array('action'=>'up',$programa['secprograms']['id']),
										  array('escape'=>false),
										  null);
				if($programa['0']['abajo'] == 1)
				echo '&nbsp;'.$this->Html->link($this->Html->image('flechaAbajo.png',array('alt' => 'flechaAbajo','title' => 'Bajar Item')),
										  array('action'=>'down',$programa['secprograms']['id']),
										  array('escape'=>false),
										  null);
				
			}
			else
				echo $programa['secprograms']['listaDesordenada'];
		}		
?>
	</div>	

</fieldset>	
<br/>
<?php echo $this->Html->link('Nueva Raiz de menu', array('action'=>'add',$aro_id)); ?>