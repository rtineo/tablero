<div class="span-8">
<?php echo $this->Html->script('secroles/add.js',false); ?>
	<?php echo $this->Session->flash();?>
	<br/>
	<div id="titulo" class="span-8" >
		<h3><?php echo __('rolAgregar');?></h3>
	</div>
	<hr/>
	
	<?php echo $this->Form->create('Secrole');?>
		<div class="span-8" >
			<div class="span-3" >
				<label><?php echo (__('organizacion')) ?></label><span class="error"><?php echo " *";?>	</span>
			</div>
			<div class="span-5 last" >
				<?php echo $this->Form->select('secorganization_id',$secorganizations,array('style' => 'width: 190px','label'=>false, 'class'=>'span-5','error'=>false,'empty'=>__('seleccionar')));
					  echo $this->Form->error('secorganization_id', array(															
													       		'notEmpty' =>  __('rolOrganizacionNoVacio', true),
																'numeric' =>  __('rolOrganizacionNumero', true)													      
																), array('class' => 'input text required error'));
				?>	
			</div>
		</div>
				
		<div class="span-8" >
			<div class="span-3" >
				<label><?php echo (__('codigo')) ?><span class="error"><?php echo " *";?>	</span>
				</label> 
			</div>
			<div class="span-5 last" >
				<?php echo $this->Form->input('code', array('label'=>'','class'=>'span-5','error'=>false)); 
				 	  echo $this->Form->error('code', array(															
													    'codeexist' =>  __('rolCodigoUnico'),
														'notEmpty' =>  __('rolCodigoNoVacio'),
														'maxLength' =>  __('rolCodigoLongitud'),
														'alphaNumeric' =>  __('rolCodigoEspacios')													      
														), array('class' => 'input text required error'));		
				?>
			</div>
		</div>
		
		<div id="rowLast" class="span-8" >
			<div class="span-3" >
				<label><?php echo(__('nombre',true)) ?><span class="error"><?php echo " *";?>	</span>
				</label> 
			</div>
			<div class="span-5 last" >
				<?php echo $this->Form->input('name', array('label'=>'','class'=>'span-5','error'=>false)); 
					  echo $this->Form->error('name', array(															
													   	'notEmpty' =>  __('rolNombreNoVacio'),
														'maxLength' =>  __('rolNombreLongitud'),											      
														), array('class' => 'input text required error'));
				?>
			</div>
		</div>

		<br/>
		<hr/>
		
		<div class=" span-8 botones" >
			<?php echo $this->Form->submit(__('Submit'), array('div'=>false));	?>
			<?php echo $this->Form->button(__('Reset'), array('type'=>'reset')); ?>				
			<?php  echo $this->Form->button(__('cerrar'), array('type'=>'button','onClick' => 'javascript:window.close()')); ?>
		</div>
	
	<?php echo $this->Form->end(); ?>

<?php echo $this->element('actualizar'); ?>
</div>