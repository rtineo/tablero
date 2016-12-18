<style>
	a {
		text-decoration: none;
	}
	ul, li {
		margin:0pt 12px;
		margin-right: 0px;
	}
</style>
<br/>
	<h3 id="tituloTable"><?php echo __('Objetos de control solicitado');?></h3>

<!--	
<fieldset>
	<legend></legend>
-->	

<?php
		?><div id="menu-acos"><?php	
		foreach($acos as $key => $aco)		
		{				
			if(!empty($aco['Aco']['alias']))
			{
				echo $aco['Aco']['listaDesordenada'];echo $aco['Aco']['alias'];	
				if($aco['Aco']['parent_id'] == 1 || empty($aco['Aco']['parent_id']))
					//echo '&nbsp;'.$this->Html->link('+',array('action'=>'agregar',$aco['Aco']['id']));
					echo '&nbsp;'.$this->Html->link($this->Html->image('agregar.png',array('alt' => 'agregar','title' => 'Agregar')),
										  array('action'=>'agregar',$aco['Aco']['id']),
										  array('escape'=>false),
										  null);
				//echo '&nbsp;'.$this->Html->link('e',array('action'=>'editar',$aco['Aco']['id']));
				if($key != 0)// Para que no visualiza el eliminar del controlador padre
				echo '&nbsp;'.$this->Html->link($this->Html->image('editar.png',array('alt' => 'editar','title' => 'Editar')),
										  array('action'=>'editar',$aco['Aco']['id']),
										  array('escape'=>false),
										  null);
				$mensaje = " 'Estas siguro que deseas eliminar el ACO ".$aco['Aco']['alias']." ?";			
				//echo '&nbsp;'.$this->Html->link('-',array('action'=>'eliminar',$aco['Aco']['id']), null,$mensaje);
				if($key != 0)// Para que no visualiza el eliminar del controlador padre
				echo '&nbsp;'.$this->Html->link($this->Html->image('eliminar.png',array('alt' => 'eliminar','title' => 'Eliminar')),
										  array('action'=>'eliminar',$aco['Aco']['id']),
										  array('escape'=>false),
										  $mensaje);										  
			}
			else
				echo $aco['Aco']['listaDesordenada'];
		}
	?></div> <!-- fin menu-acos --><?php 
?>
<!--
</fieldset>	-->
<br/>
<?php //echo $this->Html->link('Nueva Raiz de menu', array('action'=>'nuevaItemDeMenu')); ?>