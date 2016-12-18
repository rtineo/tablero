<?php echo $this->Form->create('Secperson',array('action' => 'modificarpassword'));?>
	<?php echo $this->Session->flash();?>
	<br/>
	<div id="titulo" class="span-9" >
		<h3><?php echo __('modificarContrasenia',true);?></h3>
	</div>
	<hr/>
	
	<div class="span-9" >
			<div class="span-4" >
				<label><?php echo __('nombreUsuario') ?><span class="error"><?php echo " *";?>	</span>
				</label> 
			</div>
			<div class="span-5 last" >
				<?php echo $this->Form->input('username', array('label'=>'')); ?>
			</div>
	</div>
	
	<div class="span-9" >
			<div class="span-4" >
				<label><?php echo __('contraseniaActual') ?><span class="error"><?php echo " *";?>	</span>
				</label> 
			</div>
			<div class="span-5 last" >
				<?php echo $this->Form->password('password', array('label'=>'')); 
					echo $this->Form->error('password', null, array('class' => 'input text required error'));
				?>
			</div>
	</div>
	
	<div class="span-9" >
			<div class="span-4" >
				<label><?php echo __('nuevaContrasenia') ?><span class="error"><?php echo " *";?>	</span>
				</label> 
			</div>
			<div class="span-5 last" >
				<?php echo $this->Form->password('nuevacontrasenia', array('label'=>'')); 
					echo $this->Form->error('nuevacontrasenia', null, array('class' => 'input text required error'));
				?>
			</div>
	</div>
	
	<div id="rowLast" class="span-9" >
			<div class="span-4" >
				<label><?php echo__('confirmarContrasenia') ?><span class="error"><?php echo " *";?>	</span>
				</label> 
			</div>
			<div class="span-5 last" >
				<?php echo $this->Form->password('confirmarcontrasenia', array('label'=>'')); 
					echo $this->Form->error('confirmarcontrasenia', null, array('class' => 'input text required error'));
				?>
			</div>
	</div>
	<br/>
	<hr/>	
	<div class=" span-9 botones" >
			<?php echo $this->Form->submit(__('Guardar',true), array('div'=>false));	?>						
			<?php echo $this->Form->button(__('Cerrar',true), array('type'=>'button','onClick' => 'javascript:window.close()')); ?>
	</div>
<?php echo $this->Form->end();?>