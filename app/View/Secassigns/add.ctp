<div class="span-8" >
	<?php echo $this->Html->script('secassigns/add.js'); ?>
	<?php echo $this->Session->flash();?>
	<div id="titulo" class="span-8" >	
		<h3><?php echo __('asignacionAgregar');?></h3>
	</div><div class="clear"></div>
	<br/>
	
	<?php echo $this->Form->create('Secassign');?>
		<div class="span-8" ><hr/>
			<div class="span-3" >
				<label><?php echo __('persona') ?></label><span class="error"><?php echo " *";?>	</span>
			</div>
			<div class="span-5 last" >
				<?php echo $this->Form->input('secperson_id', array('label' => '', 'class'=>'span-5')); ?>	
			</div>
		</div>
		
		<div class="span-8" >
			<div class="span-3" >
				<label><?php echo $this->Form->label(__('Organization')); ?><span class="error"><?php echo " *";?>	</span>
				</label> 
			</div>
			<div class="span-5 last" >				
				<?php echo $this->Form->select('Secorganization.id',array($secorganizations),array('class'=>'span-5','empty'=>'seleccione'),false);				
				?>
				
				<?php /*echo $this->Js->get('#SecorganizationId')->event('change',$this->Js->request(
				array('url' => array( 'action' => 'listprojects'),'update' => 'SecassignSecprojectId' )								
				,array( 
				'update' => '#SecassignSecprojectId', 
				'async' => true, 
				'dataExpression' => true, 
				'method' => 'post', 
				'data' => $js->serializeForm(array('isForm' => false, 'inline' => true))
				))*/;?>
				
				<?php echo $this->Js->get('#SecorganizationId')->event('change',$this->Js->request(
				array('url' => array( 'action' => 'listroles'),'update' => 'SecassignSecroleId' )));?>
				
			</div>
		</div>
		
		<div class="span-8" >
			<div class="span-3" >
				<label><?php echo __('sucursal') ?><span class="error"><?php echo " *";?>	</span>
				</label> 
			</div>
			<div class="span-5 last" >
				<?php echo $this->Form->input('secproject_id', array('label'=>'','class'=>'span-5')); ?>
			</div>
		</div>
		
		<div id="rowLast" class="span-8" >
			<div class="span-3" >
				<label><?php echo __('rol') ?><span class="error"><?php echo " *";?>	</span>
				</label> 
			</div>
			<div class="span-5 last" >
				<?php echo $this->Form->input('secrole_id', array('label'=>'','class'=>'span-5')); ?>
			</div>
		</div>		
		
		
		<div class=" span-8 botones" >
			<hr/>
			<?php echo $this->Form->submit(__('asignar'), array('div'=>false));	?>
			<?php echo $this->Form->button(__('reiniciar'), array('type'=>'reset')); ?>				
			<?php echo $this->Form->button(__('cerrar'), array('type'=>'button','onClick' => 'javascript:window.close()')); ?>
		</div>
	
	<?php echo $this->Form->end(); ?>

<?php echo $this->element('actualizar'); ?>
</div>