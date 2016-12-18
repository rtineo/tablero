<div class="span-8">
<?php echo $this->Html->script('secroles/edit.js',false); ?>
<?php echo $this->Session->flash();?>
	<br/>
	<div id="titulo" class="span-8" >
		<h3><?php echo __('rolEditar');?></h3>
	</div>
	<hr/>
	
	<?php echo $this->Form->create('Secrole');?>
		<?php echo $this->Form->input('id', array('type'=>'hidden')); ?>
		<div class="span-8" >
			<div class="span-3" >
				<label><?php echo (__('organizacion',true)) ?></label><span class="error"><?php echo " *";?>	</span>
			</div>
			<div class="span-5 last" >
				<?php //echo $this->Form->select('secorganization_id',$secorganizations,$this->data['Secrole']['secorganization_id'],array('style' => 'width: 190px','label'=>false, 'class'=>'span-5','error'=>false,'empty'=>__('seleccionar',true))); 
					  echo $this->Form->input('secorganization_id', array(
						'type'    => 'select',
						'options' => $secorganizations,
						'legend'=>$this->data['Secrole']['secorganization_id'],
						'style' => 'width: 190px',
						'label'=>false,
						'class'=>'span-5',
						'error'=>false,
						'empty'=>__('seleccionar',true)
					));
					  echo $this->Form->error('secorganization_id', array(															
													       		'notEmpty' =>  __('rolOrganizacionNoVacio', true),
																'numeric' =>  __('rolOrganizacionNumero', true)													      
																), array('class' => 'input text required error'));
				?>	
			</div>
		</div>
				
		<div class="span-8" >
			<div class="span-3" >
				<label><?php echo (__('codigo',true)) ?><span class="error"><?php echo " *";?>	</span>
				</label> 
			</div>
			<div class="span-5 last" >
				<?php echo $this->Form->input('code', array('label'=>'','class'=>'span-5','error'=>false)); 
				 	  echo $this->Form->error('code', array(															
													    'codeexist' =>  __('rolCodigoUnico', true),
														'notEmpty' =>  __('rolCodigoNoVacio', true),
														'maxLength' =>  __('rolCodigoLongitud', true),
														'alphaNumeric' =>  __('rolCodigoEspacios', true)													      
														), array('class' => 'input text required error'));		
				?>
			</div>
		</div>
		
		<div class="span-8" >
			<div class="span-3" >
				<label><?php echo(__('nombre',true)) ?><span class="error"><?php echo " *";?>	</span>
				</label> 
			</div>
			<div class="span-5 last" >
				<?php echo $this->Form->input('name', array('label'=>'','class'=>'span-5','error'=>false)); 
					  echo $this->Form->error('name', array(															
													   	'notEmpty' =>  __('rolNombreNoVacio', true),
														'maxLength' =>  __('rolNombreLongitud', true),											      
														), array('class' => 'input text required error'));
				?>
			</div>
		</div>

		<div id="rowLast" class="span-8" >
			<div class="span-2" ><label><?php echo (__('estado',true)) ?>
			</label></div>
			<div class="span-6 last" >
				<?php 
					$options=array('AC'=>__('Enable',true),'DE'=>__('Disable',true));		
					echo $this->Form->radio('status',$options,array('legend'=>'','default'=>'AC'));
				?>
			</div>
		</div>			

		<br/>
		<hr/>
		
		<div class=" span-8 botones" >
			<?php echo $this->Form->submit(__('Submit',true), array('div'=>false));	?>
			<?php echo $this->Form->button(__('Reset',true), array('type'=>'reset')); ?>				
			<?php echo $this->Form->button(__('cerrar',true), array('type'=>'button','onClick' => 'javascript:window.close()'));?>
		</div>
	
	<?php echo $this->Form->end(); ?>
<?php echo $this->element('actualizar'); ?>
</div>