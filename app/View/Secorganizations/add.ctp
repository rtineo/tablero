<div class="span-8" >
	
	<?php echo $this->Html->script('secorganizations/add.js',false); ?>
	<?php echo $this->Session->flash();?>
	<br/>
	<div id="titulo" class="span-8" >
		<h3><?php echo (__('empresaAgregar',true));?></h3>
	</div>
	<hr/>
	
	<?php echo $this->Form->create('Secorganization');?>

		<div class="span-8" >
			<div class="span-3" >
				<label><?php echo (__('codigo',true)) ?></label><span class="error"><?php echo " *";?>	</span>
			</div>
			<div class="span-5 last" >
				<?php echo $this->Form->input('code', array('label'=>false, 'class'=>'span-5','error'=>false));  
				 	  echo $this->Form->error('code', array(															
													   'isUnique' =>  __('empresaCodigoUnico', true),
														'notEmpty' =>  __('empresaCodigoNoVacio', true),
														'maxLength' =>  __('empresaCodigoLongitud', true),
														'alphaNumeric' =>  __('empresaCodigoEspacios', true)													      
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
				<?php echo $this->Form->input('name', array('label'=>false, 'class'=>'span-5','error'=>false));   
					  echo $this->Form->error('name', array(															
													    'isUnique' =>  __('empresaNombreUnico', true),
														'notEmpty' =>  __('empresaNombreNoVacio', true),
														'maxLength' =>  __('empresaNombreLongitud', true),											      
														), array('class' => 'input text required error'));
				
				?>
			</div>
		</div>
		
		<div class="span-8" >
			<div class="span-3" >
				<label><?php echo (__('empresaType',true)) ?><span class="error"><?php echo " *";?>	</span>
				</label> 
			</div>
			<div class="span-5 last" >
				<?php $tipo = array(__('propia', TRUE), __('cliente', TRUE), __('proveedor', TRUE)); ?>
				<?php //echo $this->Form->select('type', $tipo, null,array('label'=>'','class'=>'span-5','error'=>false), FALSE); 
					echo $this->Form->input('type', array(
							'type'    => 'select',
							'options' => $tipo,
							'label'=>false,
							'class'=>'span-5',
							'error'=>false,
							'empty'=>FALSE
						));
					  echo $this->Form->error('type', array(															
													    'numeric' =>  __('empresaTypeNumero', true),
														'notEmpty' =>  __('empresaTypeNoVacio', true),																							      
														), array('class' => 'input text required error'));
				?> 
			</div>
		</div>
		
		<div class="span-8" >
			<div class="span-3" >
				<label><?php echo (__('empresaThema',true)) ?><span class="error"><?php echo " *";?>	</span>
				</label> 
			</div>
			<div class="span-5 last" >
				<?php echo $this->Form->input('thema', array('label'=>'','class'=>'span-5','error'=>false)); 
				 echo $this->Form->error('thema', array(															
													    'notEmpty' =>  __('empresaThemaNoVacio', true),	
														'maxLength' =>  __('empresaThemaLongitud', true),																						      
														), array('class' => 'input text required error'));
				?>
			</div>
		</div>
		
		<div class="span-8" >
			<div class="span-3" >
				<label><?php echo (__('empresaEncabezado',true)) ?>
				</label> 
			</div>
			<div class="span-5 last" >
				<?php echo $this->Form->input('photo1', array('label'=>'','class'=>'span-5')); ?>
			</div>
		</div>
		
		<div class="span-8" >
			<div class="span-3" >
				<label><?php echo (__('empresaPhoto2',true)) ?>
				</label> 
			</div>
			<div class="span-5 last" >
				<?php echo $this->Form->input('photo2', array('label'=>'','class'=>'span-5')); ?>
			</div>
		</div>

		<div class="span-8" >
			<div class="span-3" >
				<label><?php echo(__('empresaText1',true)) ?>
				</label> 
			</div>
			<div class="span-5 last" >
				<?php echo $this->Form->input('text1', array('label'=>'','class'=>'span-5')); ?>
			</div>
		</div>
		
		<div class="span-8" >
			<div class="span-3" >
				<label><?php echo (__('empresaText2',true)) ?>
				</label> 
			</div>
			<div class="span-5 last" >
				<?php echo $this->Form->input('text1', array('label'=>'','class'=>'span-5')); ?>
			</div>
		</div>
		
		<div class="span-8" >
			<div class="span-3" >
				<label><?php echo (__('empresaAdress',true)) ?>
				</label> 
			</div>
			<div class="span-5 last">
				<?php echo $this->Form->input('address', array('label'=>'','class'=>'span-5','error'=>false));
				 	  echo $this->Form->error('address', array(															
													  	'maxLength' =>  __('empresaDireccionLongitud', true),											      
														), array('class' => 'input text required error'));
				?>
			</div>
		</div>
		
		<div id="rowLast" class="span-8" >
			<div class="span-3" >
				<label><?php echo(__('empresaPhone',true)) ?>
				</label> 
			</div>
			<div class="span-5 last" >
				<?php echo $this->Form->input('phono', array('label'=>'','class'=>'span-5','error'=>false)); 
					  echo $this->Form->error('phono', array(															
													   	'maxLength' =>  __('empresaTelefonoLongitud', true),											      
														), array('class' => 'input text required error'));				
				?>
			</div>
		</div>		
		<br/>
		<hr/>
		
		<div class=" span-8 botones" >
			<?php echo $this->Form->submit(__('Submit',true), array('div'=>false));	?>
			<?php echo $this->Form->button(__('Reset',true), array('type'=>'reset')); ?>				
			<?php  echo $this->Form->button(__('cerrar',true), array('type'=>'button','onClick' => 'javascript:window.close()')); ?>
		</div>
	
	<?php echo $this->Form->end();?>

<?php echo $this->element('actualizar');?>
</div>