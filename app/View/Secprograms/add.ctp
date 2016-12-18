<div class="programas form">
<?php echo $this->Form->create('Secprogram', array('action' => 'add'));?>
<?php echo $this->Form->hidden('aro_id'); ?>
<?php echo $this->Form->hidden('parent_id'); ?>
	<?php $this->Session->flash();?>
	<br/>
	<fieldset>
 		<legend><?php echo 'Item de Programa';?></legend>
		<?php echo $this->Form->label('etiqueta');?>		
		<?php echo $this->Form->text('etiqueta',array('style' => 'width: 50%'));?>
		<?php if($this->Form->isFieldError('etiqueta')) e($this->Form->error('etiqueta')); ?> <br/>
		<?php echo $this->Form->label('Programa');?>
		<?php echo $this->Form->select('aco_id',$acosParaMenu,array('style' => 'font-size: 12px'));
		?>
	</fieldset>
	
<?php echo $this->Form->end('Guardar');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link('Lista De Programas', array('action'=>'listprograms',$this->data['Secprogram']['aro_id']));?></li>
	</ul>
</div>
