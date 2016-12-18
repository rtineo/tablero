	<?php echo $this->Html->script('layouts/mijquery.js'); ?>
	<?php echo $this->Html->script('secroles/index.js'); ?>

	<br/>
	<?php $this->Session->flash(); ?>
	<h3 id="tituloTable"><?php echo(__('Roles'));?></h3>

<div class="box">
	<div id="agregar" class="span-5" >
	<?php echo $this->Element('agregar'); ?>	
	</div>
	
	<div id="buscador" class="">
		<?php echo $this->Element('buscador', array('elementos'=>$elementos,'url' => 'index')); ?>
	</div>
</div>		

<table cellpadding="0" cellspacing="0" class="table" >
	<thead>
		<tr>
			<?php echo $this->Paginator->options(array('url' => 'buscador:'.isset($this->request->data['Buscar']['buscador']).'/valor:'.isset($this->request->data['Buscar']['valor'])).'/desactivo:'.isset($this->request->data['Buscar']['desactivo'])); ?>
			<th><?php echo $this->Paginator->sort('Secorganization.name',__('organizacion',true));?></th>
			<th><?php echo $this->Paginator->sort('Secrole.code',__('codigo',true));?></th>
			<th><?php echo $this->Paginator->sort('Secrole.name',__('rol',true));?></th>
			<th><?php echo $this->Paginator->sort('Secrole.status',__('estado',true));?></th>
			<th style="width:90px" class="actions"><?php echo __('Actions');?></th>
		</tr>			
	</thead>
	
	<tbody>
		<?php  foreach ($secroles as $secrole):?>
		<tr>
			<td>
				<?php echo $secrole['Secorganization']['name']; ?>
			</td>
			<td>
				<?php echo $secrole['Secrole']['code']; ?>
			</td>
			<td>
				<?php echo $secrole['Secrole']['name']; ?>
			</td>
			<td>
				<?php 				
				echo $secrole['Secrole']['status'] == 'AC' ? 
							__('Enable',true)
						:
							($secrole['Secrole']['status'] == 'DE'?
								__('Disable',true)
							:
								__('Limited',true))
						; ?>
			</td>
			
			<td class="actions">
				<?php echo $this->Element('action', 
								array('id'=> $secrole['Secrole']['id'], 
										'name'=> $secrole['Secrole']['name'],
										'estado'=> $secrole['Secrole']['status'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>

<div id ="paging" class="span-18">
		<?php echo $this->element('paginador'); ?>
</div>
<div class="clear"></div>