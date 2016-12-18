<div class="span-9" >
<?php 
	  echo $this->Html->script('general/tqc.js');
	  echo $this->Html->script('secpeople/add.js'); 
	  
	  echo $this->Html->script('js-fecha/jquery-ui-1.7.2.custom.min.js');
	  echo $this->Html->script('js-fecha/ui/i18n/ui.datepicker-es.js');
		  
		 $css = array('theme/redmond/jquery-ui-1.7.2.custom', 'theme/demo');
		 echo $this->Html->css($css, 'stylesheet', array('media'=>array('', '')));
?>
<?php echo $this->Html->script('jquery-uploadify/swfobject.js'); ?>
<?php echo $this->Html->script('jquery-uploadify/jquery.uploadify.v2.1.0.min.js'); ?>
<?php
	$css = array('/js/jquery-uploadify/uploadify');
	echo $this->Html->css($css, 'stylesheet', array('media'=>array('', '')));
?>
<?php echo $this->Session->flash();?>

<script type="text/javascript">
	//uploadify jquery
$(document).ready(function() {
		
	$("#uploadify").uploadify({
		'uploader'       : $.url('/app/webroot/js/jquery-uploadify/uploadify.swf'),
		'script'         : $.url('/app/webroot/js/jquery-uploadify/uploadify.php'),
		'buttonText'	 : 'Adjuntar Firma',
		'cancelImg'      : $.url('/app/webroot/js/jquery-uploadify/cancel.png'),
		'folder'         : '/<?php echo $directorio ?>',
		'queueID'        : 'fileQueue',
		'auto'           : true,		
		'sizeLimit'		 : '524288',
		'onComplete'	 : addFileName
	});
	
	
	
});

var addFileName = function(event, queueID, fileObj, response, data){
		
	$("#uploadedpics").empty();
	$("#uploadedpics").append("<input type='hidden' name='data[Secperson][archivofisico]' value='" + response + "' />");
	$("#uploadedpics").append("<input type='hidden' name='data[Secperson][archivo]' value='" + fileObj.name + "' />");
			
	var firma = fileObj.name;
	$('#firma').val(firma);
}

</script>

	<br/>
	<div id="titulo" class="span-9" >
		<h3><?php echo __('personaAgregar') ?></h3>
	</div><div class="clear"></div>
	<br/>
	<hr/>
	
	<?php echo $this->Form->create('Secperson');?>
		<div class="span-9" >
			<div class="span-4" >
				<label><?php echo __('nombre') ?></label><span class="error"><?php echo " *";?>	</span>
			</div>
			<div class="span-5 last" >
				<?php echo $this->Form->input('firstname', array('label' => '', 'class'=>'span-5','error'=>false));
					  echo $this->Form->error('firstname', array(															
													   	'notEmpty' =>  __('personaNombreNoVacio', true),
														'maxLength' =>  __('personaNombreLongitud', true),											      
														), array('class' => 'input text required error'));
				?>	
			</div>
		</div>
		
		<div class="span-9" >
			<div class="span-4" >
				<label><?php echo __('apellidoPaterno') ?><span class="error"><?php echo " *";?>	</span>
				</label> 
			</div>
			<div class="span-5 last" >
				<?php echo $this->Form->input('appaterno', array('label'=>'', 'class'=>'span-5','error'=>false)); 
				 	  echo $this->Form->error('appaterno', array(															
													   	'notEmpty' =>  __('personaAppaternoNoVacio', true),
														'maxLength' =>  __('personaAppaternoLongitud', true),											      
														), array('class' => 'input text required error'));
				?>
			</div>
		</div>
		
		<div class="span-9" >
			<div class="span-4" >
				<label><?php echo __('apellidoMaterno',true) ?><span class="error"><?php echo " *";?>	</span>
				</label> 
			</div>
			<div class="span-5 last" >
				<?php echo $this->Form->input('apmaterno', array('label'=>'', 'class'=>'span-5','error'=>false)); 
					  echo $this->Form->error('apmaterno', array(															
													   	'notEmpty' =>  __('personaApmaternoNoVacio', true),
														'maxLength' =>  __('personaApmaternoLongitud', true),											      
														), array('class' => 'input text required error'));
				?>
			</div>
		</div>
		
		<div class="span-9" >
			<div class="span-4" >
				<label><?php echo __('lenguaje') ?><span class="error"><?php echo " *";?>	</span>
				</label> 
			</div>
			<div class="span-5 last" >
				<?php $language=array('spa'=>__('castellano',true));
					echo $this->Form->select('language',array($language),array('class' => 'span-5'),false);  ?>
			</div>
		</div>
		
		<div class="span-9" >
			<div class="span-4" >
				<label><?php echo __('privilegio') ?><span class="error"><?php echo " *";?>	</span>
				</label> 
			</div>
			<div class="span-5 last" >
				<?php $privelege=array('0'=>__('usuario'),'1'=>__('superUsuario'));
					echo $this->Form->select('privelege',array($privelege),array('class' => 'span-5'),false); ?>
			</div>
		</div>
		
		<div class="span-9">
			<div class="span-4" >
				<label><?php echo __('usuarioNombre') ?><span class="error"><?php echo " *";?>	</span>
				</label> 
			</div>
			<div class="span-5 last" >
				<?php echo $this->Form->input('username', array('label'=>'', 'class'=>'span-5','error'=>false)); 
					  echo $this->Form->error('username', array(															
													    'isUnique' =>  __('personaNombreusuarioUnico', true),
														'notEmpty' =>  __('personaNombreusuarioNoVacio', true),
														'maxLength' =>  __('personaNombreusuarioLongitud', true),											      
														), array('class' => 'input text required error'));
				
				?>
			</div>
		</div>
		
		<div class="span-9" >
			<div class="span-4" >
				<label><?php echo __('contrasenia') ?><span class="error"><?php echo " *";?>	</span>
				</label> 
			</div>
			<div class="span-5 last" >
				<?php echo $this->Form->input('password', array('label'=>'', 'class'=>'span-5','error'=>false)); 
					  echo $this->Form->error('password', array(															
													   	'notEmpty' =>  __('personaContraseniaNoVacio', true),									      
														), array('class' => 'input text required error'));
				?>
			</div>
		</div>
		
		<div class="span-9" >
			<div class="span-4" >
				<label><?php echo __('email',true) ?></label>
			</div>
			<div class="span-5 last" >
				<?php echo $this->Form->input('email', array('label' => '', 'class'=>'span-5','error'=>false));?>	
			</div>
		</div>	
		
		<div class="span-9" >
			<div class="span-4" >
				<label><?php echo __('fechaCreacion') ?><span class="error"><?php echo " *";?>	</span>
				</label> 
			</div>
		<div class="span-5 last" >
				<?php echo $this->Form->text('creationdate', array('class'=>'fecha','label'=>false,'id'=>'fechaIni','readonly'=>'readonly','error'=>false, 'size'=>26)); 
				      echo $this->Form->error('creationdate', null, array('class' => 'input text required error'));
				?>
				<label class="error" for="SecpersonCreationdate" generated="true"></label>
			</div>
		</div>
		
		<div class="span-9" >
			<div class="span-4" >
				<label><?php echo __('fechaCierre') ?><span class="error"><?php echo " *";?>	</span>
				</label> 
			</div>
			<div class="span-5 last" >
				<?php echo $this->Form->text('expirationdate', array('class'=>'fecha','label'=>false,'id'=>'fechaFin','readonly'=>'readonly','error'=>false, 'size'=>26)); 
					  echo $this->Form->error('expirationdate', null, array('class' => 'input text required error'));
				?>
				<label class="error" for="SecpersonExpirationdate" generated="true"></label>				
			</div>
		</div>
		
		<div id="rowLast" class="span-9" >
			<div id="fileQueue"></div>
		</div>

		<hr/>
		
		<div class=" span-9 botones" >
			<?php echo $this->Form->submit(__('guardar',true), array('div'=>false,'id'=>'guardar'));	?>
			<?php echo $this->Form->button(__('reiniciar',true), array('type'=>'reset')); ?>				
			<?php  echo $this->Form->button(__('cerrar',true), array('type'=>'button','onClick' => 'javascript:window.close()')); ?>
		</div>
	
	<?php echo $this->Form->end(); ?>

<?php echo $this->element('actualizar'); ?>
</div>