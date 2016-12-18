<div class="span-8" >
<?php echo $this->Html->script('secprojects/edit.js'); ?>
	<?php $this->Session->flash();?>
	<br/>
	<div id="titulo" class="span-8" >
		<h3><?php echo __('ProjectEditar');?></h3>
	</div><div class = "clear"></div>
	<br/>
	<hr/>	
	<?php echo $this->Form->create('Secproject');?>
		<?php echo $this->Form->input('id', array('type'=>'hidden')); ?>
		<div class="span-8" >
			<div class="span-3" >
				<label><?php echo (__('organizacion',true)) ?></label><span class="error"><?php echo " *";?>	</span>
			</div>
			<div class="span-5 last" >
				<?php //echo $this->Form->select('secorganization_id',$secorganizations,$this->data['Secproject']['secorganization_id'],array('class'=>'span-5','label'=>false, 'class'=>'span-5','error'=>false,'empty'=>__('seleccionar',true))); 
						echo $this->Form->select('secorganization_id',$secorganizations,array('class'=>'span-5','label'=>false, 'class'=>'span-5','error'=>false,'empty'=>__('seleccionar'))); 
				 	  echo $this->Form->error('secorganization_id', array(															
													       		'notEmpty' =>  __('sucursalOrganizacionNoVacio', true),
																'numeric' =>  __('sucursalOrganizacionNumero', true)													      
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
													    'codeexist' =>  __('sucursalCodigoUnico', true),
														'notEmpty' =>  __('sucursalCodigoNoVacio', true),
														'maxLength' =>  __('sucursalCodigoLongitud', true),
														'alphaNumeric' =>  __('sucursalCodigoEspacios', true)													      
														), array('class' => 'input text required error'));	
				?>
			</div>
		</div>
		<div class="span-8" >
			<div class="span-3" >
				<label><?php echo (__('nombre',true)) ?></label><span class="error"><?php echo " *";?>	</span>
			</div>
			<div class="span-5 last" >
				<?php echo $this->Form->input('name', array('label' => '','class'=>'span-5','error'=>false)); 
				      echo $this->Form->error('name', array(															
													   	'notEmpty' =>  __('sucursalNombreNoVacio', true),
														'descripcionexist' =>  __('sucursalDescripcionUnico', true),
														'maxLength' =>  __('sucursalNombreLongitud', true),											      
														), array('class' => 'input text required error'));
				?>	
			</div>
		</div>
		<div class="span-8" >
			<div class="span-3" >
				<label><?php echo (__('ProjectPhoto1',true)) ?>
				</label> 
			</div>
			<div class="span-5 last" >
				<?php echo $this->Form->input('photo1', array('label'=>'','class'=>'span-5')); ?>
			</div>
		</div>
		<div class="span-8" >
			<div class="span-3" >
				<label><?php echo (__('ProjectPhoto2',true)) ?></label>
			</div>
			<div class="span-5 last" >
				<?php echo $this->Form->input('photo2', array('label' => '','class'=>'span-5')); ?>	
			</div>
		</div>
		
		<div class="span-8" >
			<div class="span-3" >
				<label><?php echo (__('ProjectText1',true)) ?>
				</label> 
			</div>
			<div class="span-5 last" >
				<?php echo $this->Form->input('text1', array('label'=>'','class'=>'span-5')); ?>
			</div>
		</div>
		<div class="span-8">
			<div class="span-3" >
				<label><?php echo (__('ProjectText2',true)) ?>
			</div>
			<div class="span-5 last" >
				<?php echo $this->Form->input('text2', array('label' => '','class'=> 'span-5')); ?>	
			</div>
		</div>
		<div class="span-8" >
			<div class="span-3" >
				<label><?php echo (__('direccion',true)) ?>
				</label> 
			</div>
			<div class="span-5 last" >
				<?php echo $this->Form->input('address', array('label'=>'','class'=>'span-5','error'=>false)); 
					  echo $this->Form->error('address', array(				
													   	'notEmpty' =>  __('sucursalNombreNoVacio', true),													
													  	'maxLength' =>  __('sucursalDireccionLongitud', true),											      
														), array('class' => 'input text required error'));
				?>
			</div>
		</div>
		
		<div class="span-8">
			<div class="span-3" >
				<label><?php echo (__('telefono',true)) ?>
			</div>
			<div class="span-5 last" >
				<?php echo $this->Form->input('telefono', array('label' => '','class'=> 'span-5','error'=>false)); 
					  echo $this->Form->error('telefono', array(															
													   	'maxLength' =>  __('sucursalTelefonoLongitud', true),											      
														), array('class' => 'input text required error'));
				?>	
			</div>		
		</div>
			
		<div id="rowLast" class="span-8" >
			<div class="span-3" ><label><?php echo (__('Estado',true)) ?>
			</label></div>
			<div class="span-4 last" >
				<?php 
					$options=array('AC'=>__('Enable',true),'DE'=>__('Disable',true));		
					echo $this->Form->radio('status',$options,array('legend'=>'','default'=>'AC'));
				?>
			</div>
		</div>	
		
		<br/><br/><br/>
		<hr/>
		
		<div class=" span-8 botones" >
			<?php echo $this->Form->submit(__('Submit',true), array('div'=>false));	?>
			<?php echo $this->Form->button(__('Reset',true), array('type'=>'reset')); ?>				
			<?php echo $this->Form->button(__('cerrar',true), array('type'=>'button','onClick' => 'javascript:window.close()')); ?>
		</div>
	
	<?php echo $this->Form->end(); ?>

<?php echo $this->element('actualizar'); ?>
</div>