<div class="span-9">
<?php 
	  echo $this->Html->script('general/tqc.js');
	  echo $this->Html->script('secpeople/edit.js'); 
 	  //echo $javascript->link('js-fecha/fecha_inicializacion.js');
	  echo $this->Html->script('js-fecha/jquery-ui-1.7.2.custom.min.js');
	  echo $this->Html->script('js-fecha/ui/i18n/ui.datepicker-es.js');
		  
	  $css = array('theme/redmond/jquery-ui-1.7.2.custom', 'theme/demo');
	  echo $this->Html->css($css, 'stylesheet', array('media'=>array('','')));
?>

<?php echo $this->Session->flash();?>

<script type="text/javascript">
	
var addFileName = function(fileObj, response){
		
	$("#uploadedpics").empty();
	$("#uploadedpics").append("<input type='hidden' name='data[Secperson][archivofisico]' value='" + response + "' />");
	$("#uploadedpics").append("<input type='hidden' name='data[Secperson][archivo]' value='" + fileObj.name + "' />");
			
	var firma = fileObj.name;
	$('#firma').val(firma);	
}


$(document).ready(function() {	
	limpiafile('');
});
	
var filename;
	function limpiafile(newfilename){		
		$('#div_uploadify').empty();
		$('#div_uploadify').append('<input type="file" name="uploadify" id="uploadify" class="hide" />');
		$("#uploadify").css({
			position:'absolute',
			top:$('#container_uploadify').offset().top,
			left:$('#container_uploadify').offset().left
			});
		if(newfilename != '')
		addFileName({name:filename},newfilename);
		$("#uploadify").change(function(){
			filename = $(this).val();
			$($(this).parents('form')[0]).submit();
		});
	}
</script>

	<div id="titulo" class="span-9" >
	<h3><?php echo __('personaEditar') ?></h3>
	</div><div class="clear"></div>
	<br/>
	<hr/>
	
	<?php echo $this->Form->create('Secperson');?>
		<?php echo $this->Form->input('id', array('type'=>'hidden')); ?>
		
		<div class="span-9" >
			<div class="span-4" >
				<label><?php echo __('nombre',true) ?></label><span class="error"><?php echo " *";?>	</span>
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
				<label><?php echo __('apellidoPaterno',true) ?><span class="error"><?php echo " *";?>	</span>
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
				<label><?php echo __('lenguaje',true) ?><span class="error"><?php echo " *";?>	</span>
				</label> 
			</div>
			<div class="span-5 last" >
				<?php $language=array('spa'=>__('castellano',true));
					echo $this->Form->select('language',array($language),array('class' => 'span-5'),false);  ?>
			</div>
		</div>
		
		<div class="span-9" >
			<div class="span-4" >
				<label><?php echo __('privilegio',true) ?><span class="error"><?php echo " *";?>	</span>
				</label> 
			</div>
			<div class="span-5 last" >
				<?php $privelege=array('0'=>__('usuario',true),'1'=>__('superUsuario',true));
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
				<?php echo $this->Form->text('Secperson.creationdate', array('class'=>'fecha','label'=>false,'id'=>'fechaIni','readonly'=>'readonly','error'=>false, 'size'=>26)); 
				      echo $this->Form->error('Secperson.creationdate', null, array('class' => 'input text required error'));
				?>
				<label class="error" for="SecpersonCreationdate" generated="true"></label>
			</div>
		</div>
		
		<div class="span-9" >
			<div class="span-4" >
				<label><?php echo __('fechaCierre') ?><span class="error"><?php echo " *";?></span>
				</label> 
			</div>
			<div class="span-5 last" >
				<?php echo $this->Form->text('Secperson.expirationdate', array('class'=>'fecha','label'=>false,'id'=>'fechaFin','readonly'=>'readonly','error'=>false, 'size'=>26)); 
					  echo $this->Form->error('Secperson.expirationdate', null, array('class' => 'input text required error'));
				?>
				<label class="error" for="SecpersonExpirationdate" generated="true"></label>				
			</div>
		</div>
		
		<div id="rowLast" class="span-9" >
			<div class="span-4" ><label><?php echo (__('Estado',true)) ?>
			</label></div>
			<div class="span-5 last" >
				<?php 
					$options=array('AC'=>__('Enable',true),'DE'=>__('Disable',true));		
					echo $this->Form->radio('status',$options,array('legend'=>'','default'=>'AC'));
				?>
			</div>
		</div>	
		
		<br/>
		<hr/>
		
		<div class=" span-9 botones" >
			<?php echo $this->Form->submit(__('guardar',true), array('div'=>false));	?>
			<?php echo $this->Form->button(__('reiniciar',true), array('type'=>'reset')); ?>				
			<?php echo $this->Form->button(__('cerrar',true), array('type'=>'button','onClick' => 'javascript:window.close()')); ?>
		</div>
	
	<?php echo $this->Form->end(); ?>
	
<?php //echo $this->element('myupload'); ?>

<?php echo $this->element('actualizar'); ?>
</div>