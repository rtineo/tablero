<?php echo $this->Html->script('secpeople/mijquery.js', false);  
?>

<div class="span-9 botones" > 
	<?php $this->Session->flash();?>
	<br/>
	<table cellpadding="0" cellspacing="0" class="table">
		<thead>
			<tr>
				<th colspan="2" scope="col">
					<?php  echo __('asignacion');?>
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
		 		<td class="span-3" ><label><?php echo __('organizacion') ?></label></td>
		 		<td class="span-4 last"><?php echo $secassign['Secorganization']['name']; ?></td>
			</tr>
			
			<tr>
		 		<td><label><?php echo __('sucursal') ?></label></td>
		 		<td><?php echo $secassign['Secproject']['name']; ?>	
			</tr>

			<tr>
		 		<td><label><?php echo __('rol') ?></label></td>
		 		<td><?php echo $secassign['Secrole']['name']; ?></td>
		 	</tr>
			<tr>
		 		<td><label><?php echo __('apellidoNombre') ?></label></td>
		 		<td><?php echo $secassign['Secperson']['appaterno'].
													' '.$secassign['Secperson']['apmaterno'].
													', '.$secassign['Secperson']['firstname']; ?>	
			</tr>
			<tr>
		 		<td><label><?php echo __('usuario') ?></label></td>
		 		<td><?php echo $secassign['Secperson']['username']; ?></td>
		 	</tr>
			<tr>
		 		<td><label><?php echo __('estado'); ?></label> </td>
		 		<td>
		 			<?php echo $secassign['Secassign']['status'] == 'AC' ? 
							__('Enable',true)
						:
							($secassign['Secassign']['status'] == 'DE'?
								__('Disable',true)
							:
								__('Limited',true))
						; ?>
		 		</td>
		 	</tr>
		</tbody>
	</table>
<br/>
	<?php  echo $this->Form->button(__('cerrar',true), array('type'=>'button','onClick' => 'javascript:window.close()')); ?>
<?php echo $this->Form->end();?>

