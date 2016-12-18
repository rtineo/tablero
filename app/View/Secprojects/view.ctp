<div class="span-9 botones" > 
	<?php $this->Session->flash();?>
	<br/>
	<table cellpadding="0" cellspacing="0" class="table">
		<thead>
			<tr>
				<th colspan="2" scope="col">
					<?php echo __('ProjectVer');?>
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
		 		<td class="span-3" ><label><?php echo __('organizacion') ?></label></td>
		 		<td class="span-4 last"><?php echo $secproject['Secorganization']['name']; ?></td>
		 	</tr>

			<tr>
		 		<td><label><?php echo __('codigo') ?></label> </td>
		 		<td><?php echo $secproject['Secproject']['code']; ?></td>
		 	</tr>
			<tr>
		 		<td><label><?php echo __('nombre') ?></label> </td>
		 		<td><?php echo $secproject['Secproject']['name']; ?></td>
		 	</tr>			
			<tr>
		 		<td><label><?php echo __('ProjectPhoto1') ?></label> </td>
		 		<td><?php echo $secproject['Secproject']['photo1']; ?></td>
		 	</tr>			
			<tr>
		 		<td><label><?php echo __('ProjectPhoto2') ?></label> </td>
		 		<td><?php echo $secproject['Secproject']['photo1']; ?></td>
		 	</tr>			
			<tr>
		 		<td><label><?php echo __('ProjectText1') ?></label> </td>
		 		<td><?php echo $secproject['Secproject']['text1']; ?></td>
		 	</tr>			
			<tr>
		 		<td><label><?php echo __('ProjectText2') ?></label> </td>
		 		<td><?php echo  $secproject['Secproject']['text2']; ?></td>
		 	</tr>			
			<tr>
		 		<td><label><?php echo __('direccion') ?></label> </td>
		 		<td><?php echo $secproject['Secproject']['address']; ?></td>
		 	</tr>			
			<tr>
		 		<td><label><?php echo __('telefono') ?></label> </td>
		 		<td><?php echo  $secproject['Secproject']['phono']; ?></td>
		 	</tr>			


			<tr>
		 		<td><label><?php echo __('estado'); ?></label> </td>
		 		<td><?php echo $secproject['Secproject']['status'] == 'AC' ? 
							__('Enable',true)
						:
							($secproject['Secproject']['status'] == 'DE'?
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