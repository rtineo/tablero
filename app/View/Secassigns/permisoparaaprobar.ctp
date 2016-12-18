	<?php echo $this->Html->script('secassigns/permisoparaaprobar.js'); ?>

	<br/>
	<?php $this->Session->flash(); ?>
	<h3 id="tituloTable"><?php echo __('devolucionAprobarCorreo',true);?></h3>

<div class="box">
	
	<div id="buscador" class="">
		<?php echo $this->element('buscadorbase', array('elementos'=>$elementos,'url' => 'permisoparaaprobar')); ?>
	</div>
</div>	

<table cellpadding="0" cellspacing="0" class="table" >
	<thead>
		<tr>	
			<?php echo $this->Paginator->options(array('url'=> array('buscador:'.$this->data['Buscar']['buscador'].'/valor:'.$this->data['Buscar']['valor']))); ?>	
			<th><?php echo $this->Paginator->sort(__('apellidoNombre', true),'Secperson.appaterno');?></th>
			<th><?php echo $this->Paginator->sort(__('usuario', true),'Secperson.username');?></th>		
			<th><?php echo $this->Paginator->sort(__('email', true),'Secperson.email');?></th>			
			<th><?php echo $this->Paginator->sort(__('estado', true),'Secperson.status');?></th>
			<th class="actions"><?php echo __('acciones',true);?></th>
		</tr>		
	</thead>
	
	<tbody>
		<?php 
				foreach ($secpeople as $secperson):?>
		<tr>				
			<td>
				<?php echo $secperson['Secperson']['appaterno'].' '.$secperson['Secperson']['apmaterno'].', ',$secperson['Secperson']['firstname']; ?>		
			</td>
			<td>
				<?php echo $secperson['Secperson']['username']; ?>
			</td>
			<td>
				<?php echo $secperson['Secperson']['email']; ?>
			</td>	
			<td>
				<?php echo $secperson['Secperson']['aprobacioncorreo']; ?>
			</td>		
			<td class="actions" style="width: 100px">			
				<?php
					if($secperson['Secperson']['correoaprobacion'] == true){						
						$imagen = 'cancel.png';
						$title = __('devolucionDenegarPermiso',true);
					}else{						
						$imagen = 'validar.png';
						$title = __('devolucionAgregarPermiso',true);
					}
					if(!empty($secperson['Secperson']['email']))					
					echo $this->Html->link($this->Html->image($imagen,array('alt' => $title,'title' => $title)),
												  array('action' => '/aprobarcorreo/'.$secperson['Secperson']['id'].'/buscador:'.$this->data['Buscar']['buscador'].'/valor:'.$this->data['Buscar']['valor'].'/page:'.$this->data['Buscar']['page']),
												  null,
												  null,
												  false);			
				?>											
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
<div id ="paging" class="span-18">
		<?php echo $this->Element('paginador'); ?>
</div>
<div class="clear"></div>