<?php echo $this->Html->script('Servicios/add.js'); ?>

<?php echo $this->Session->flash();?>
<table id="tituloVentana" border="0" cellspacing="0" cellpadding="0" align="center">
    <thead>
        <tr>
            <th colspan="2" class="titulo">
                <?php echo __('SERVICIOS') ?>
            </th>
        </tr>
    </thead>
</table>
<br/>
<div id="listaCaja">
	<fieldset style="height: 220px;">
		<?php echo $this->Form->create('Servicio', array('enctype'=>'multipart/form-data'));?>
			<table id="formularioEdicion" width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
		        <tbody>
		        	<tr>
			            <td class="etiqueta"><?php echo __('Titulo');?></td>
			            <td class="valor" colspan="3"><?php echo $this->Form->input('titulo',array('class'=>'required', 'label' => false, 'div' => false, 'style'=>'width:85%;', 'maxlength'=>'100')); ?></td>
			        </tr>
					<tr>
			            <td class="etiqueta"><?php echo __('Descripcion');?></td>
			            <td class="valor" colspan="3"><?php echo $this->Form->textarea('description', array('cols'=>'40', 'rows'=>'6', 'class'=>'required'));?></td>
			        </tr>
		       		<tr>
			            <td class="etiqueta"><?php echo __('Imagen (jpg)');?></td>
			            <td class="valor" colspan="3"><?php echo $this->Form->input('img', array('class'=>'required','type'=>'file', 'label'=>false));?></td>
			        </tr>
			    </tbody>
			</table>
			<div align="center" style="padding: 10px;">
		        <?php echo $this->Form->button(__('Submit',true), array('div'=>false, 'type'=>'submit'));	?>				
				<?php echo $this->Form->button(__('cerrar',true), array('type'=>'button','onClick' => 'javascript:window.close()')); ?>
			</div>
		<?php echo $this->Form->end(); ?>
	</fieldset>
</div> 

<?php echo $this->element('actualizar'); ?>