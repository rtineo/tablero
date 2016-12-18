<?php
$widthTable="width: 780px;"; 
if(isset($webcliente)){
	$widthTable = "width: 735px;";
}?>
<br>
<table id="formularioEdicion" width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tbody>
		<tr>
			<?php if(empty($this->data['Cliente']['razonSocial'])){ ?>
            <td class="etiqueta" width="150px"><?php echo __('TALLER_ETIQUETA_APELLIDOS_Y_NOMBRES');?></td>
            <td class="valor"><?php echo $this->Xhtml->thisData('Cliente.nombres');?></td>
        	<?php } else { ?>
            <td class="etiqueta" width="150px"><?php echo __('TALLER_ETIQUETA_RAZON_SOCIAL');?></td>
            <td class="valor"><?php echo $this->Xhtml->thisData('Cliente.razonSocial');?></td>
        	<?php } ?>
			<td class="etiqueta"><?php echo __('TALLER_ETIQUETA_DIRECCION');?></td>
            <td class="valor"><?php echo $this->Xhtml->thisData('Cliente.direccion');?></td>
		</tr>
		<tr>
		    <td class="etiqueta"><?php echo __('TALLER_ETIQUETA_TIPO_DOCUMENTO');?></td>
		    <td class="valor"><?php echo $this->Xhtml->thisData('Cliente.documento_tipo')?></td>
			<td class="etiqueta"><?php echo __('TALLER_ETIQUETA_DISTRITO');?></td>
            <td class="valor"><?php echo $this->Xhtml->thisData('Cliente.distrito')?></td>
		</tr>
		<tr>
		    <td class="etiqueta"><?php echo __('TALLER_ETIQUETA_NUMERO_DOCUMENTO');?></td>
		    <td class="valor"><?php echo $this->Xhtml->thisData('Cliente.documento_numero')?></td>
			<td class="etiqueta"><?php echo __('AGE_CLIENTES_CIUDAD');?></td>
		    <td class="valor"><?php echo $this->Xhtml->thisData('Cliente.ciudad')?></td>
		</tr>
        <tr>
            <td class="etiqueta"><?php echo __('TIPO_DE_CLIENTE');?></td>
			<?php if($this->data['Cliente']['str_cliente_tipo'] == 'Corporativo'){?>
		    	<td class="valor" style="background-color: yellow;"><?php echo $this->Xhtml->thisData('Cliente.str_cliente_tipo')?></td>
			<?php }else{?>
				<td class="valor"><?php echo $this->Xhtml->thisData('Cliente.str_cliente_tipo')?></td>
			<?php }?>
        </tr>
        <tr>
            <td class="etiqueta"><?php echo __('TALLER_ETIQUETA_TELEFONO');?></td>
		    <td class="valor"><?php echo $this->Xhtml->thisData('Cliente.telefono')?></td>
        </tr>
		<tr>
			<td class="etiqueta"><?php echo __('TALLER_ETIQUETA_CELULAR');?></td>
		    <td class="valor"><?php echo $this->Xhtml->thisData('Cliente.celular')?></td>
		</tr>
		<tr>
			<td class="etiqueta" width="170px"><?php echo __('TALLER_ETIQUETA_CORREO');?></td>
		    <td class="valor"><?php echo $this->Xhtml->thisData('Cliente.email')?></td>
		</tr>	
		<tr>
			<td></br></td>
		</tr>
		<tr>
			<td class="etiqueta"><?php echo __('AGE_MOTIVOSERVICIO_DESCRIPCION');?></td>
			<td class="valor" colspan="5"><?php echo $this->Xhtml->thisData('Agemotivoservicio.description');?></td>
		</tr>
		<tr>
			<td class="etiqueta"><?php echo __('AGE_TIPOSERVICIO_DESCRIPCION');?></td>
			<td class="valor" colspan="5"><?php echo $this->Xhtml->thisData('Agetiposervicio.description');?></td>
		</tr>
		<tr>
			<td class="etiqueta"><?php echo __('ORDEN_ESTANDAR_TITULO_AGREGAR_TIPO_MANTENIMIENTO');?></td>
			<td class="valor" colspan="5"><?php echo $this->Xhtml->thisData('Agedetallecita.tipoMantenimiento');?></td>
		</tr>
		<tr>
			<td class="etiqueta"><?php echo __('TALLER_ETIQUETA_OTROS_SERVICIOS');?></td>
			<td class="valor" colspan="5"><?php echo $this->Xhtml->thisData('Agedetallecita.otrosServicios');?></td>
		</tr>
		
		<?php if(!empty($this->data['Agedetallecita']['reschedulecomment'])): ?>
		<tr>
			<td class="etiqueta"><?php echo __('comentarioReprogramar');?></td>
			<td><textarea class="required" style="height: 50px;padding: 5px;width: 320px;" disabled="disabled"><?php echo trim($this->data['Agedetallecita']['reschedulecomment']); ?></textarea></td>
		</tr>
		<?php endif ?>
		
		<?php if(!empty($this->data['Agedetallecita']['deletecomment'])): ?>
		<tr>
			<td class="etiqueta"><?php echo __('comentarioEliminar');?></td>
			<td><textarea class="required" style="height: 50px;padding: 5px;width: 320px;" disabled="disabled"><?php echo trim($this->data['Agedetallecita']['deletecomment']); ?></textarea></td>
		</tr>	
		<?php endif ?>
				
	</tbody>
</table>
<br>
<div class="borde_detalle">
	<table id="formularioEdicion" class="listaPrincipal" border="0" cellspacing="0" cellpadding="0" style="<?php echo $widthTable ?>">
        <caption style="font-weight: bold;"><?php echo __('TALLER_ETIQUETA_DETALLE_CITA_TALLER');?></caption>
        <thead>
	        <tr>
	        	<th style="width: 200px;"><?php echo __('TALLER_ETIQUETA_ORGANIZACION');?></th>
	        	<th><?php echo __('TALLER_ETIQUETA_PROJECT');?></th>
	        	<th style="width: 120px;"><?php echo __('TALLER_ETIQUETA_FECHA');?></th>
				<th style="width: 120px;"><?php echo __('AGE_DETALLE_CITA_REFERENCIA');?></th>
	        </tr>
        </thead>
        <tbody>
	        <tr class="impar">
	            <td class="texto"><?php echo $organizationName;?></td>
	            <td class="texto"><?php echo $this->Xhtml->thisData('Secproject.name');?></td>
	            <td class="centrado"><?php echo date('d-m-Y H:i', strtotime($this->request->data['Agecitacalendariodia']['initDateTime']));?></td>
	       		<td class="centrado"><?php echo $this->Xhtml->thisData('Agedetallecita.otsap');?></td>
		    </tr>
        </tbody>
	</table>
</div>
<br>
<div class="borde_detalle">
	<table id="formularioEdicion" class="listaPrincipal" border="0" cellspacing="0" cellpadding="0" style="<?php echo $widthTable ?>">
        <caption style="font-weight: bold;"><?php echo __('TALLER_ETIQUETA_DETALLE_VEHICULO');?></caption>
        <thead>
	        <tr>
	        	<th style="width: 200px;"><?php echo __('TALLER_ETIQUETA_MARCA');?></th>
	        	<th><?php echo __('TALLER_ETIQUETA_MODELO');?></th>
	        	<th style="width: 120px;"><?php echo __('TALLER_ETIQUETA_PLACA');?></th>
	        </tr>
        </thead>
        <tbody>
	        <tr class="impar">
	            <td class="texto"><?php echo $this->Xhtml->thisData('Agedetallecita.marca');?></td>
	            <td class="texto"><?php echo $this->Xhtml->thisData('Agedetallecita.modelo');?></td>
	            <td class="centrado"><?php echo $this->Xhtml->thisData('Agedetallecita.placa');?></td>
	        </tr>
        </tbody>
	</table>
</div>
<br>
<?php if ($servicios) { ?>
<div class="borde_detalle">
	<table id="formularioEdicion" class="listaPrincipal" border="0" cellspacing="0" cellpadding="0" style="<?php echo $widthTable ?>">
		<caption style="font-weight: bold;">
			<?php echo __('TALLER_ETIQUETA_DETALLE_SERVICIOS');?>
		</caption>
		<thead>
			<tr>
				<th width="30%"><?php echo __('TALLER_SERVICIO_CAMPO_CODIGO');?></th>
				<th width="50%"><?php echo __('TALLER_SERVICIO_CAMPO_DESCRIPCION');?></th>
				<th width="10%"><?php echo __('TALLER_SERVICIO_CAMPO_DURACION');?></th>
				<th width="10%"><?php echo __('TALLER_SERVICIO_CAMPO_UNIDAD');?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($servicios as $key=>$servicio): ?>
			<?php $class = ($key%2 == 0) ? "par" : "impar"; ?>
            <tr class="<?php echo $class; ?>">
				<td class="texto"><?php echo $servicio['Talservicio']['codigo'];?></td>
				<td class="texto"><?php echo $servicio['Talservicio']['descripcion'];?></td>
				<td class="centrado"><?php echo $servicio['Talservicio']['duracion'];?></td>
				<td class="centrado"><?php echo $servicio['Talservicio']['unidad'];?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<?php } ?>