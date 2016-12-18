<div class='span-8'>
	<?php echo $this->Html->script('tqcclases/edit.js',false); ?>
	<?php $this->Session->flash();?>
	<br/>
	<div id="titulo" class="span-8" >
		<br/>
		<h3><?php echo __('variableProduccionEdit', TRUE);?></h3>
	</div>
	<hr/>
	
	<?php echo $this->Form->create('Secorganization', array('action'=>'logisticaedit'));?>
		<?php echo $this->Form->input('id', array('type'=>'hidden')); ?>
		<div class="span-8" >
			<div class="span-3" >
				<label><?php echo __('periodoEspera', TRUE) ?></label><span class="error"><?php echo " *";?>	</span>
			</div>
			<div class="span-5 last" >
				<?php echo $this->Form->input('vplperiodoespera', array('label'=>false, 'class'=>'span-5','error'=>false)); ?>	
			</div>
		</div>
		
		<div class="span-8" >
			<div class="span-3" >
				<label><?php echo __('nielServicio', TRUE) ?>
				</label> <span class="error"><?php echo "*";?>	</span>
			</div>
			<div class="span-5 last" >
				<?php echo $this->Form->input('vplnielservicio', array('label'=>false, 'class'=>'span-5','error'=>false)); ?>
				
			</div>
		</div>	
		
		<div id="rowLast" class="span-8" >
			<div class="span-3" >
				<label><?php echo __('tamanioLote', TRUE) ?>
				</label> <span class="error"><?php echo "*";?>	</span>
			</div>
			<div class="span-5 last" >
				<?php echo $this->Form->input('vpltamaniolote', array('label'=>false, 'class'=>'span-5','error'=>false)); ?>
				
			</div>
		</div>	
		<hr/>
		
		<div class=" span-8 botones" >
			<?php echo $this->Form->submit(__('Submit',true), array('div'=>false));	?>
			<?php echo $this->Form->button(__('Reset',true), array('type'=>'reset')); ?>				
			<?php echo $this->Form->button(__('Close',true), array('type'=>'button','onClick' => 'javascript:window.close()')); ?>
		</div>
	
	<?php echo $this->Form->end();?>

<?php echo $this->element('actualizar'); ?>
</div>