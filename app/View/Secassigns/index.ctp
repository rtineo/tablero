<?php echo $this->Html->script('secassigns/index.js');?>
<br/>
<h3 id="tituloTable"><?php echo __('asignacionListar', true); ?></h3>
<div class="box">
	<div id="agregar" class="span-5" >
		<?php echo $this->element('agregar'); ?>
	</div>
	<div id="buscador" class="">
		<?php echo $this->element('buscador', array('elementos' => $elementos, 'url' => 'index')); ?>
	</div>
</div>
<?php if(isset($secassigns) && !empty($secassigns)): ?>
<table cellpadding="0" cellspacing="0" class="table" >
	<thead>
		<tr>
			<th><?php echo __('organizacion', true); ?></th>
			<th><?php echo $this->Paginator->sort(__('sucursal', true)); ?></th>
			<th><?php echo $this->Paginator->sort(__('rol', true)); ?></th>
			<th><?php echo $this->Paginator->sort(__('persona', true)); ?></th>
			<th><?php echo __('usuario', true); ?></th>
			<th><?php echo $this->Paginator->sort(__('estado', true)); ?></th>
			<th class="actions"><?php echo __('Actions', true); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($secassigns as $secassign):
			$status = $secassign['Secassign']['status']; ?>
		<tr>
			<td><?php echo $secassign['Secorganization']['name']; ?></td>
			<td><?php echo $secassign['Secproject']['name']; ?></td>
			<td><?php echo $secassign['Secrole']['name']; ?></td>
			<td>
				<?php echo $secassign['Secperson']['appaterno'].' '.$secassign['Secperson']['apmaterno'].', '.$secassign['Secperson']['firstname']; ?>
			</td>
			<td><?php echo $secassign['Secperson']['username']; ?></td>
			<td>
				<?php echo $status == 'AC' ? __('Enable', true) : ($status == 'DE' ? __('Disable', true) : __('Limited', true)); ?>
			</td>
			<td class="actions">				
						<?php 		
								$url = $this->Html->url(array('action'=>'view', $secassign['Secassign']['id']));
								$image = $this->Html->image('mostrar.png', array('title'=>__('ver',true), "alt" => "mostrar"));
								echo $this->Html->link($image, 'javascript:;',array('onclick' => "mostrar('".$url."')",'escape'=>false), null);	
						?>		
						<?php if($secassign['Secassign']['id']!='1'){
								$url = $this->Html->url(array('action'=>'edit', $secassign['Secassign']['id']));
								$image = $this->Html->image('editar.png', array('title'=>__('editar',true), "alt" => "Editar"));
								echo $this->Html->link($image, 'javascript:;',array('onclick' => "editar('".$url."')",'escape'=>false), null);
								}
						?>	
						<?php   if($secassign['Secassign']['id']!='1'){
								if(empty($secassign['Secassign']['status']) ||$secassign['Secassign']['status'] == 'AC' || $secassign['Secassign']['status'] == 'LI'){
									echo $this->Html->link($this->Html->image('eliminar.png', array('title'=>__('desactivar',true), "alt" => "Eliminar")), 
											array('action'=>'delete', $secassign['Secassign']['id']), array('escape'=>false), sprintf(__('estaSeguroEliminar %s?'), 
											$secassign['Secperson']['appaterno'].' '.$secassign['Secperson']['apmaterno'].','.$secassign['Secperson']['firstname'])); 
								}}
						?>	
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<div id ="paging" class="span-18">
	<?php echo $this->Paginator->options(array('url' => 'buscador:'.isset($this->request->data['Buscar']['buscador']).'/valor:'.isset($this->request->data['Buscar']['valor'])).'/desactivo:'.isset($this->request->data['Buscar']['desactivo'])); ?>
	<?php echo $this->element('paginador'); ?>
</div>
<?php endif; ?>
<div class="clear"></div>