<?php echo $this->Form->create('Agedetallecita', array('url'=>$action, 'id'=>'modificarForm'));?>
<?php echo $this->Form->hidden('isPost', array('value'=>empty($isPost)?'0':'1'))?>
<?php echo $this->Form->hidden('Base.citarepogramar_id', array('value'=>$citarepogramarId))?>

	<table id="formularioEdicion" width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tbody>
            <tr>
                <td class="etiqueta"><?php echo __('TALLER_ETIQUETA_APELLIDOS_Y_NOMBRES');?></td>
                <td class="valor">
                	<?php echo $this->Form->hidden('cliente_id') ?>
                	<?php echo $this->Form->input('Cliente.apellidoPaterno', array('class'=>'required msg_error_2 soloLectura','readonly'=>true, 'readonly'=>'readonly','div'=>false, 'label'=>false, 'style'=>'width:70%;')); ?>	
					<?php if(empty($citarepogramarId)){ if(!isset($citaweb))echo $this->Html->image('search_icon.gif', array('style' => 'cursor: pointer;', 'onclick' => "vehicle.open();"));} ?>
					<?php //echo $this->Html->image('search_icon.gif', array('style' => 'cursor: pointer;', 'onclick' => "abrirDialog('dialog_cliente')")); ?>
					<span class="error">*</span>
                </td>
				<td class="etiqueta"><?php echo __('TALLER_ETIQUETA_PLACA');?></td>
                <td class="valor">
                	<?php echo $this->Form->hidden('codigo_unidad') ?>
                	<?php echo $this->Form->hidden('Agedetallecita.ageclientesVehiculo_id') ?>
                	<?php echo $this->Form->input('placa', array('type'=>'text','label'=>false, 'div'=>false,'class'=>'required  soloLectura','readonly'=>true,'error'=>false, 'style'=>'width:170px;')); ?>
				</td>
			</tr>
            <tr>
				<td class="etiqueta"><?php echo __('AGE_TIPO_DOCUMENTO');?></td>
                <td class="valor"><?php echo $this->Form->input('Cliente.documento_tipo', array('label'=>false,'class'=>'soloLectura','readonly'=>true,'error'=>false, 'style'=>'width:50%;')); ?></td>
				<td class="etiqueta"><?php echo __('TALLER_ETIQUETA_MARCA');?></td>
                <td class="valor" >
                	<?php echo $this->Form->hidden('Marca.id');?>
                	<?php echo $this->Form->input('marca', array('type'=>'text','label'=>'','class'=>'soloLectura','readonly'=>true,'error'=>false, 'style'=>'width:170px;')); ?>
				</td>
			</tr>
            <tr>
            	<td class="etiqueta"><?php echo __('AGE_NUMERO_DOCUMENTO');?></td>
                <td class="valor"><?php echo $this->Form->input('Cliente.documento_numero', array('label'=>'','class'=>'soloLectura','readonly'=>true,'error'=>false, 'style'=>'width:50%;')); ?></td>
				<td class="etiqueta"><?php echo __('TALLER_ETIQUETA_MODELO');?></td>
                <td class="valor" ><?php echo $this->Form->input('modelo', array('label'=>'','class'=>'soloLectura','readonly'=>true,'error'=>false, 'style'=>'width:170px;')); ?></td>
			</tr>
            <tr>
            	<td class="etiqueta"><?php echo __('TIPO_DE_CLIENTE');?></td>
                <td class="valor">
                	<?php echo $this->Form->hidden('Cliente.cliente_tipo') ?>
                	<?php echo $this->Form->input('Cliente.str_cliente_tipo', array('label'=>'','class'=>'soloLectura','readonly'=>true,'error'=>false, 'style'=>'width:50%;')); ?>
				</td>
 				<td class="etiqueta"><?php echo __('servicioMenor');?></td>
				<td class="valor"><?php echo $this->Form->input('serviciomenor', array('label'=>'','class'=>'soloLectura','readonly'=>true,'error'=>false, 'style'=>'width:170px;')); ?></td
			</tr>
            <tr>
            	<td class="etiqueta"><?php echo __('distrito');?></td>
                <td class="valor"><?php echo $this->Form->input('Cliente.distrito', array('label'=>'','class'=>'soloLectura','readonly'=>true,'error'=>false, 'style'=>'width:50%;')); ?></td>
				<td class="etiqueta"><?php echo __('servicioMayor');?></td>
				<td class="valor"><?php echo $this->Form->input('serviciomayor', array('label'=>'','class'=>'soloLectura','readonly'=>true,'error'=>false, 'style'=>'width:170px;')); ?></td>
			</tr>
            <tr> 
				<td class="etiqueta"><?php echo __('TALLER_ETIQUETA_TELEFONO');?></td>
                <td class="valor"><?php echo $this->Form->input('Cliente.telefono', array('label'=>'','class'=>'soloLectura','readonly'=>true,'error'=>false, 'style'=>'width:50%;')); ?></td>
				<td class="etiqueta" rowspan="3"><?php echo __('mensajeMotivoServicio');?></td>
				<td class="valor" rowspan="3"><?php echo $this->Form->input('mensajeMotivoServicio', array('label'=>'','type'=>'textarea','class'=>'soloLectura','readonly'=>true,'error'=>false, 'style'=>'height: 66px;background-color:#FCFFAD')); ?></td>
            </tr>
            <tr>
            	<td class="etiqueta"><?php echo __('TALLER_ETIQUETA_CELULAR');?></td>
                <td class="valor"><?php echo $this->Form->input('Cliente.celular', array('label'=>'','class'=>'soloLectura','readonly'=>true,'error'=>false, 'style'=>'width:50%;')); ?></td>
			</tr>
            <tr>
            	<td class="etiqueta"><?php echo __('TALLER_ETIQUETA_CORREO');?></td>
                <td class="valor"><?php echo $this->Form->input('Cliente.email', array('label'=>'','class'=>'soloLectura','readonly'=>true,'error'=>false, 'style'=>'width:50%;')); ?></td>
            </tr>
			
			<!-- SG -->
            <tr>
            	<td class="etiqueta"><?php echo __('TALLER_ETIQUETA_TALLER_SUCURSAL');?></td>
		        <td class="valor">
		        	<?php echo $this->Form->select('Secproject.id', $secprojects, array('class'=>'required msg_error_2', 'style'=>'width: 250px','empty'=>__('Seleccionar'),'onchange'=>'getMotivoServicio(this)', 'style'=>'width:65%;'))?>
					<?php echo $this->Html->image('derco/defecto/grid-loading.gif', array('class'=>"hide")); ?>
					<span class="error">*</span>
				</td>
				<td class="etiqueta"><?php echo __('AGE_MOTIVOSERVICIO_DESCRIPCION');?></td>
		        <td class="valor">
		        	<select name="data[Agemotivoservicio][id]" onchange="getTipoMantenimiento(this);" class="required msg_error_2 valid" style="width:170px;" id="AgemotivoservicioId">
						<option value="">Seleccionar</option>
						<?php foreach($motivoservicios as $value){
							$selected=($value['Agemotivoservicio']['id'] == $this->data['Agemotivoservicio']['id'])?"selected = selected":"";
							echo '<option '.$selected.' value="'.$value['Agemotivoservicio']['id'].'" agecitacalendario_id="'.$value['Agecitacalendario']['id'].'">'.$value['Agemotivoservicio']['description'].'</option>';
						} ?>
					</select>
					<?php echo $this->Html->image('derco/defecto/grid-loading.gif', array('class'=>"hide")); ?>
					<span class="error">*</span>
				</td>
			</tr>
            <tr>
            	<td class="etiqueta"><?php echo __('ORDEN_ESTANDAR_ETIQUETA_TIPO_SERVICIO');?></td>
		        <td class="valor">
		        	<select id="AgedetallecitaAgetiposervicioId" style="width:65%;" class="required msg_error_2" onchange="verTipomantenimiento(this);" name="data[Agedetallecita][agetiposervicio_id]">
						<option value=""><?php echo __('Seleccionar', true) ?></option>
						<?php foreach($tiposervicios as $value){
							$selected=($value['Agetiposervicio']['id'] == $this->data['Agedetallecita']['agetiposervicio_id'])?" selected=selected ":"";
							echo "<option $selected mantenimiento=\"".$value['Agetiposervicio']['mostrar_mantenimiento']."\" value=\"".$value['Agetiposervicio']['id']."\">".utf8_encode($value['Agetiposervicio']['description'])."</option>";
						} ?>
					</select>
					<?php echo $this->Html->image('derco/defecto/grid-loading.gif', array('class'=>"hide")); ?>
					<span class="error">*</span>
		        </td>
				<td class="etiqueta">
					<div id="divTipomantenimientoEtiqueta" class="hide">
						<?php echo __('TALLER_ETIQUETA_TALLER_TIPO_MANTENIMIENTO');?></td>
					</div>	
		        <td class="valor" colspan="3">
		        	<div id="divTipomantenimiento" class="hide">
		        		<?php echo $this->Form->select('Agetipomantenimiento.id', $tipomantenimientos, array('empty'=>__('Seleccionar'), 'class'=>'', 'style'=>'width:70%;'))?>
						<?php echo $this->Html->image('derco/defecto/grid-loading.gif', array('class'=>"hide")); ?>	
		        	</div>	
		        </td>
			</tr>
			<tr>
	            <td class="etiqueta"><?php echo __('TALLER_ETIQUETA_OTROS_SERVICIOS');?></td>
	            <td class="valor" colspan="3"><?php echo $this->Form->textarea('Agedetallecita.otrosServicios', array('cols'=>'40', 'rows'=>'2'));?></td>
	        </tr>
			<?php if(!empty($citarepogramarId)): ?>
			<tr>
				<td class="etiqueta"><?php echo __('comentarioReprogramar',true); ?></td>	
				<td class="valor">
					<textarea name="data[Agedetallecita][reschedulecomment]" class="required msg_error_1" style="height: 45px;padding: 2px;" cols="40"><?php echo empty($this->data)?"":trim($this->data['Agedetallecita']['reschedulecomment']); ?></textarea>
					<span class="error">*</span>
				</td>				
			</tr>
			<?php endif; ?>
			<tr>
	            <td class="etiqueta"><?php echo __('AGE_FECHA_CITA');?></td>
	            <td class="valor">
	            	<?php echo $this->Form->input('fecha', array('readonly'=>true,'class'=>'required msg_error_2 soloLectura', 'label'=>false, 'div'=>false,'style'=>'width:120px;'))?>
					<span class="error">*</span>&nbsp;&nbsp;&nbsp;&nbsp;
					<?php echo $this->Form->button(__('horarios'), array('type'=>'button','class'=>'buscar', 'div'=>false, 'onclick'=>'getHorariosCliente(); return false;'));?>
				</td>
	        </tr>
	    </tbody>
	</table>
	
	<fieldset style="height: 160px;">
		<legend><?php echo __('VENDEDOR_ETIQUETA_HORARIOS_POR_TALLER_SERVICIOS')?></legend>
		<div id="listaPrincipal"></div>
	</fieldset>
	
	<div align="center" style="padding-left: 20px;">
        <?php echo $this->Form->submit(__('GENERAL_CONFIRMAR'), array('class'=>'guardar hide', 'id'=>'buttonSubmit'));?>
    </div>
<?php echo $this->Form->end(); ?>