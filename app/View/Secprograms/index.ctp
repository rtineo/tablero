	<?php echo $this->Html->script('layouts/mijquery.js', false); ?>
	<?php echo $this->Html->script('tqclineas/index.js', false); ?>

	<br/>
	<?php $this->Session->flash(); ?>
	<h3 id="tituloTable"><?php echo __('Secprograms');?></h3>

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
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('aro_id');?></th>
			<th><?php echo $this->Paginator->sort('aco_id');?></th>
			<th><?php echo $this->Paginator->sort('parent_id');?></th>
			<th><?php echo $this->Paginator->sort('lft');?></th>
			<th><?php echo $this->Paginator->sort('rght');?></th>
			<th><?php echo $this->Paginator->sort('etiqueta');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
		</tr>			
	</thead>
	
	<tbody>
		<?php  foreach ($secprograms as $secprogram):?>	
		<td>
			<?php echo $secprogram['Secprogram']['id']; ?>
		</td>
		<td>
			<?php echo $secprogram['Secprogram']['aro_id']; ?>
		</td>
		<td>
			<?php echo $secprogram['Secprogram']['aco_id']; ?>
		</td>
		<td>
			<?php echo $secprogram['Secprogram']['parent_id']; ?>
		</td>
		<td>
			<?php echo $secprogram['Secprogram']['lft']; ?>
		</td>
		<td>
			<?php echo $secprogram['Secprogram']['rght']; ?>
		</td>
		<td>
			<?php echo $secprogram['Secprogram']['etiqueta']; ?>
		</td>
			<td class="actions">
				<?php echo $this->Element('action', array('id'=>$secprogram['Secprogram']['id'])); ?>
			</td>
	</tr>
	<?php endforeach; ?>
	</tbody>
</table>

<div id ="paging" class="span-18">
		<?php echo $this->Element('paginador'); ?>
</div>
<div class="clear"></div>