<div class="span-9 botones" > 
	<?php $this->Session->flash();?>
	<br/>
	<table cellpadding="0" cellspacing="0" class="table">
		<thead>
			<tr>
				<th colspan="2" scope="col">
					<?php echo __('rolVer');?>
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
		 		<td class="span-3" ><label><?php __('organizacion') ?></label></td>
		 		<td class="span-4 last"><?php echo  $secrole['Secorganization']['name']; ?></td>
		 	</tr>

			<tr>
		 		<td><label><?php echo __('codigo') ?></label> </td>
		 		<td><?php echo $secrole['Secrole']['code']; ?></td>
		 	</tr>
			<tr>
		 		<td><label><?php echo __('nombre') ?></label> </td>
		 		<td><?php echo $secrole['Secrole']['name']; ?></td>
		 	</tr>
			<tr>
		 		<td><label><?php echo __('estado'); ?></label> </td>
		 		<td><?php echo $secrole['Secrole']['status'] == 'AC' ? 
							__('Enable',true)
						:
							($secrole['Secrole']['status'] == 'DE'?
								__('Disable',true)
							:
								__('Limited',true))
						; ?></td>
		 	</tr>

		</tbody>
	</table>
	<br/>
	<?php  echo $this->Form->button(__('cerrar',true), array('type'=>'button','onClick' => 'javascript:window.close()')); ?>
	<?php echo $this->Form->end();?>
</div>