<?php echo $this->Session->flash(); ?>
<h3 id="tituloTable"><?php echo __('sucursales'); ?></h3>

<?php echo $this->Form->create('Secproject', array('action' => 'asignar/'.$secprojectId));?>
	
<div class="box">
	<table>
		<tbody>
			<tr>
				<td><?php echo __('organizacion', true); ?></td>
				<td><?php echo $secproject['Secorganization']['name']; ?></td>
			</tr>
			<tr>
				<td><?php echo __('codigoTaller', true); ?></td>
				<td><?php echo $secproject['Secproject']['code']; ?></td>
			</tr>
			<tr>
				<td><?php echo __('nombreTaller', true); ?></td>
				<td><?php echo $secproject['Secproject']['name']; ?></td>
			</tr>
		</tbody>
	</table>
</div>

<div>
	<table>
		<thead>
			<tr>
				<th style="width:50%;"><?php echo __('descripcion', true); ?></th>
				<th><?php echo __('asignar', true); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($marcas as $key => $detail): ?>
			<?php $valueChecked = "value=\"$key\"";
				if(empty($this->data)){
					if(!empty($marcasSecproject_db[$key])) $valueChecked .= " checked=\"checked\"";
				}else{
					$valueChecked = empty($this->data['MarcasSecprojects'][$key])?"value=\"$key\"":"value=\"$key\" checked=\"checked\"";
				}
			?>
			<tr>
				<td><?php echo $detail; ?></td>
				<td style="text-align:center;"><input type="checkbox" <?php echo $valueChecked ?> name="data[MarcasSecprojects][<?php echo $key ?>][MarcasSecproject][marca_id]"></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

<div class="botones" >
	<?php echo $this->Form->submit(__('asignar'), array('div'=>false));	?>		
	<?php echo $this->Form->button(__('cerrar'), array('type'=>'button','onClick' => 'javascript:window.close()')); ?>
</div>

<?php echo $this->Form->end(); ?>
<?php echo $this->element('actualizar'); ?>
