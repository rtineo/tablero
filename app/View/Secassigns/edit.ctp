<div class="span-9" >	
	<?php echo $this->Html->script('secassigns/edit.js'); ?>
	<?php echo $this->Session->flash();?>
	
	<div id="titulo" class="span-9" >
	<?php $this->Session->flash('auth');?>
		<h3><?php echo __('asignacionModificar');?></h3>
	</div><div class="clear"></div>
	<br/>

	<?php echo $this->Form->create('Secassign');?>
	<?php echo $this->Form->input('id', array('type'=>'hidden')); ?>
		<div class="span-9" ><hr/>
			<div class="span-3" >
				<label><?php echo(__('persona')) ?></label><span class="error"><?php echo " *";?>	</span>
			</div>
			<div class="span-6 last" >
				<?php echo $this->Form->input('secperson_id', array('label' => '', 'class'=>'span-5')); ?>
			</div>
		</div>

		<div class="span-9" >
			<div class="span-3" >
				<label><?php echo $this->Form->label(__('Organization')); ?><span class="error"><?php echo " *";?>	</span>
				</label>
			</div>
			<div class="span-6 last" >
                <?php echo $this->Form->select('Secorganization.id',array($secorganizations),array('class'=>'span-5'),false); ?>
				
				<?php /*echo $this->Ajax->observeField('SecorganizationId',
				array('url' => array( 'action' => 'listprojects'),'update' => 'SecassignSecprojectId' ));?>

				<?php echo $this->Ajax->observeField('SecorganizationId',
				array('url' => array( 'action' => 'listroles'),'update' => 'SecassignSecroleId' ));*/?>

			</div>
		</div>

		<div class="span-9" >
			<div class="span-3" >
				<label><?php echo(__('sucursal')) ?><span class="error"><?php echo " *";?>	</span>
				</label>
			</div>
			<div class="span-6 last" >
				<?php echo $this->Form->input('secproject_id', array('label'=>'','class'=>'span-5')); ?>
			</div>
		</div>

		<div id="rowLast" class="span-9" >
			<div class="span-3" >
				<label><?php echo(__('rol')) ?><span class="error"><?php echo " *";?>	</span>
				</label>
			</div>
			<div class="span-6 last" >
				<?php echo $this->Form->input('secrole_id', array('label'=>'','class'=>'span-5')); ?>
			</div>
		</div>

		<div id="rowLast" class="span-9" >
			<div class="span-3" >
				<label><?php echo(__('estado')) ?><span class="error"><?php echo " *";?>	</span>
				</label>
			</div>
			<div class="span-6 last" >
				<?php
					$options=array('AC'=>__('activo'),'DE'=>__('desactivo'));
					echo $this->Form->radio('status',$options,array('legend'=>'','default'=>'AC'));
				?>
			</div>
		</div>

		<div class=" span-9 botones" >
			<hr/>
			<?php echo $this->Form->submit(__('asignar'), array('div'=>false));	?>
			<?php echo $this->Form->button(__('reiniciar'), array('type'=>'reset')); ?>
			<?php  echo $this->Form->button(__('cerrar'), array('type'=>'button','onClick' => 'javascript:window.close()')); ?>
		</div>

	<?php echo $this->Form->end(); ?>

<?php echo $this->Element('actualizar'); ?>
</div>