<div class="span-10">
<?php echo $this->Form->create('Secperson',array('action' => 'modificarpasswordusuario'));
	  echo $this->Html->script('general/tqc.js',array('inline'=>false));
 	  echo $this->Html->script('js-fecha/fecha_inicializacion.js');
	  echo $this->Html->script('js-fecha/jquery-ui-1.7.2.custom.min.js');
	  echo $this->Html->script('js-fecha/ui/i18n/ui.datepicker-es.js');
	  echo $this->Html->script('secpeople/modificarpasswordusuario.js',array('inline'=>false));  
	  $css = array('theme/redmond/jquery-ui-1.7.2.custom', 'theme/demo');
	  echo $this->Html->css($css, 'stylesheet', array('media'=>array('', '')));
	  echo $this->Form->hidden('id');
?>

<?php echo $this->Session->flash();?>
	
	<div id="titulo" class="span-10" >
	<h3><?php echo __('modificarContrasenia',true);?></h3>
	</div><div class="clear"></div> 
	<br/>
	<hr/>	
	
	<div class="span-10" >
			<div class="span-4" >
				<label><?php echo __('persona') ?>
				</label> 
			</div>
			<div class="span-6 last" >
				<?php echo $usuario;
				?>
			</div>
	</div>
	
	<div class="span-10" >
			<div class="span-4" >
				<label><?php echo __('nuevaContrasenia') ?><span class="error"><?php echo " *";?></span>
				</label> 
			</div>
			<div class="span-6 last" >
				<?php echo $this->Form->password('nuevacontrasenia', array('label'=>'','class'=>'span-6')); 
					  echo $this->Form->error('nuevacontrasenia', null, array('class' => 'input text required error'));
				?>
			</div>
	</div>
	
	<div id="rowLast" class="span-10" >
			<div class="span-4" >
				<label><?php echo __('confirmarContrasenia') ?><span class="error"><?php echo " *";?>	</span>
				</label> 
			</div>
			<div class="span-6 last" >
				<?php echo $this->Form->password('confirmarcontrasenia', array('label'=>'','class'=>'span-6')); 
					  echo $this->Form->error('confirmarcontrasenia', null, array('class' => 'input text required error'));
				?>
			</div>
	</div>
	
	<div id="rowLast" class="span-10" >
			<div class="span-4" >
				<label><?php echo __('fechaCierre') ?><span class="error"><?php echo " *";?>	</span>
				</label> 
			</div>
			<div class="span-6 last" >
				<?php 
					  echo $this->Form->text('Secperson.expirationdate', array('class'=>'fecha','label'=>false,'error'=>false,'size'=>33)); 
					  echo $this->Form->error('Secperson.expirationdate', null, array('class' => 'input text required error'));
				?>	
				<?php //echo $this->Form->text('expirationdate', array('class'=>'fecha span-3','label'=>'')); ?>			
			 	<label class="error" for="SecpersonExpirationdate" generated="true"></label>
			</div>
	</div>
	
	<hr/>
	<div class=" span-10 botones" >
			<?php echo $this->Form->submit(__('Guardar',true), array('div'=>false));	?>						
			<?php echo $this->Form->button(__('Cerrar',true), array('type'=>'button','onClick' => 'javascript:window.close()')); ?>
	</div>
	
<?php echo $this->Form->end();?>
<?php echo $this->element('soloactualizar'); ?>
</div>