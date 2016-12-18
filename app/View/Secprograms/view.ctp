<div class="secprograms view">
<h2><?php echo __('Secprograms');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $secprogram['Secprogram']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Aro Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $secprogram['Secprogram']['aro_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Aco Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $secprogram['Secprogram']['aco_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Parent Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $secprogram['Secprogram']['parent_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Lft'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $secprogram['Secprogram']['lft']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rgth'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $secprogram['Secprogram']['rgth']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Etiqueta'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $secprogram['Secprogram']['etiqueta']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Edit Secprogram', true), array('action'=>'edit', $secprogram['Secprogram']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Secprogram', true), array('action'=>'delete', $secprogram['Secprogram']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $secprogram['Secprogram']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Secprograms', true), array('action'=>'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Secprogram', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
