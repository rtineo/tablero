<div class='span-12'>
	<?php $this->Session->flash();?>
	<br/>
	<div id="titulo" class="span-12" >
		<h3><?php echo __('acosAgregar');?></h3>
	</div>
	<hr/>
	<?php echo $this->Form->create('Aco', array('action' => 'agregar'));?>
	<?php echo $this->Form->hidden('parent_id'); ?>
	<div class="span-12" >
			<div class="span-3" >
				<label><?php echo __('acosAlias') ?></label><span class="error">*</span>
			</div>
			<div class="span-9 last" >
					<?php echo $this->Form->text('alias',array('style'=>'width: 300px'));?>
					<?php if($this->Form->isFieldError('alias')) e($this->Form->error('alias')); ?> 	
			</div>
	</div>
	<div class="span-12" >
			<div class="span-3" >
				<label><?php echo __('acosDescripcion') ?></label>
			</div>
			<div class="span-9 last" >
					<?php echo $this->Form->text('descripcion',array('style'=>'width: 300px'));?>	
			</div>
	</div>
	<div id="rowLast" class="span-12" style="margin-bottom: 10px;">
			<div class="span-3" >
				<label><?php echo __('acosParaMenu') ?></label>
			</div>
			<div class="span-9 last" >
					<?php echo $this->Form->checkbox('paramenu');?>	
			</div>
	</div>
	
	<hr/>
	<div class=" span-12 botones" >
			<?php echo $this->Form->submit(__('Submit'), array('div'=>false));	?>			
	</div>
	
	<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('acosListaObjetos'), array('action'=>'index'));?></li>
	</ul>
	</div>
	
	<?php echo $this->Form->end();?>
</div>

