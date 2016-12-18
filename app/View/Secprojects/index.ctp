<?php echo $this->Html->script('secprojects/index.js'); ?>
<br/>
<?php echo $this->Session->flash(); ?>
<h3 id="tituloTable"><?php echo __('ProjectListar'); ?></h3>
<div class="box">
	<div id="agregar" class="span-5" >
		<?php echo $this->element('agregar'); ?>
	</div>
	<div id="buscador" class="">
		<?php echo $this->element('buscador', array('elementos' => $elementos, 'url' => 'index')); ?>
	</div>
</div>
<?php if(isset($secprojects) && !empty($secprojects)): ?>
<table cellpadding="0" cellspacing="0" class="table" >
	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('Secorganization.name',__('organizacion', true)); ?></th>
			<th><?php echo $this->Paginator->sort('Secproject.code',__('codigo', true)); ?></th>
			<th><?php echo $this->Paginator->sort('Secproject.name',__('ProjectVer', true)); ?></th>
			<th><?php echo $this->Paginator->sort('Secproject.photo1',__('ProjectPhoto1', true)); ?></th>
			<th><?php echo $this->Paginator->sort('Secproject.address',__('direccion', true)); ?></th>
			<th><?php echo $this->Paginator->sort('Secproject.text1',__('ProjectText1', true)); ?></th>		
			<th><?php echo $this->Paginator->sort('Secproject.status',__('estado', true)); ?></th>			
			<th class="actions"><?php echo __('Actions', true); ?></th>
		</tr>			
	</thead>
	<tbody>
		<?php foreach($secprojects as $secproject):
			$status = $secproject['Secproject']['status']; ?> 
		<tr>
			<td><?php echo $secproject['Secorganization']['name']; ?></td>
			<td><?php echo $secproject['Secproject']['code']; ?></td>
			<td><?php echo $secproject['Secproject']['name']; ?></td>
			<td><?php echo $secproject['Secproject']['photo1']; ?></td>
			<td><?php echo $secproject['Secproject']['address']; ?></td>
			<td><?php echo $secproject['Secproject']['text1']; ?></td>			
			<td>
				<?php echo $status == 'AC' ? __('Enable', true) : ($status == 'DE' ? __('Disable', true) : __('Limited', true)); ?>
			</td>
			<td class="actions">
				<?php echo $this->Element('action', array(
					'id' => $secproject['Secproject']['id'], 
					'name' => $secproject['Secproject']['name'], 
					'estado' => $secproject['Secproject']['status']
				)); ?>
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