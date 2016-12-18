<?php echo $this->Html->script('secpeople/mijquery.js');  
?>

<div class="span-9 botones" > 
	<?php echo $this->Session->flash();?>
	<br/>
	<table cellpadding="0" cellspacing="0" class="table">
		<thead>
			<tr>
				<th colspan="2" scope="col">
					<?php echo __('persona');?>
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
		 		<td class="span-3" ><label><?php echo __('apellidoNombre') ?></label></td>
		 		<td class="span-4 last"><?php $ApNom = $secperson['Secperson']['appaterno']." ".
												 $secperson['Secperson']['apmaterno'].", ".
												 $secperson['Secperson']['firstname']; 
												 echo $ApNom;?></td>
		 	</tr>

			<tr>
		 		<td><label><?php echo __('privilegio') ?></label> </td>
		 		<td><?php echo $secperson['Secperson']['privelege']; ?></td>
		 	</tr>
			<tr>
		 		<td><label><?php echo __('lenguaje') ?></label></td>
		 		<td><?php echo $secperson['Secperson']['language'] == 'spa' ?
							__('castellano', true)
						:
							$secperson['Secperson']['language'];
			; ?>
				</td>
		 	</tr>
			<tr>
		 		<td><label><?php echo __('estado'); ?></label> </td>
		 		<td><?php echo $secperson['Secperson']['status'] == 'AC' ? 
							__('Enable',true)
						:
							($secperson['Secperson']['status'] == 'DE'?
								__('Disable',true)
							:
								__('Limited',true))
						; ?></td>
		 	</tr>
			<tr>
		 		<td><label><?php echo __('fechaCreacion') ?></label> </td>
		 		<td><?php echo $secperson['Secperson']['creationdate']; ?></td>
		 	</tr>
			<tr>
		 		<td><label><?php echo __('fechaCierre') ?></label> </td>
		 		<td> <?php echo $secperson['Secperson']['expirationdate']; ?></td>
		 	</tr>
		</tbody>
	</table>
<br/>
	<div id="mostrarDatos" class="hide">
			
		<table class="table">
			<thead>
				<tr>
					<th colspan="3" scope="col" ><?php echo __('detalleEmpresaSucursalRol') ?></th>
				</tr>
				<tr>
					<th>Empresa</th> <th>Sucursal</th> <th>Rol</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($personDetalle as $key => $Value): ?>
					<tr>
						<td> <?php echo $Value['Secorganization']['name']; ?></td>
						<td> <?php echo $Value['Secproject']['name']; ?></td>
						<td> <?php echo $Value['Secrole']['name']; ?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table><br/>
	</div>
	
	<?php if(!empty($personDetalle)){ ?>	
		<span id="datosPersona">
			<?php  echo $this->Form->button(__('dondeTrabaja',true), array('type'=>'button')); ?>
		</span>
	<?php } ?>
	<?php  echo $this->Form->button(__('cerrar',true), array('type'=>'button','onClick' => 'javascript:window.close()')); ?>
	<?php echo $this->Form->end();?>

	
</div>