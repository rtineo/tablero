<?php echo $this->Html->script('secorganizations/view.js'); ?>
<?php //echo $this->Html->script('secpeople/index.js');  // id="titulo" 
?>
	<?php echo $this->Session->flash();?>
	<br/>
<div class="span-9 botones" > 
	<table cellpadding="0" cellspacing="0" class="table">
		<thead>
			<tr>
				<th colspan="2" scope="col" font-size ="12px">
					<?php echo __('organizacion');?>
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
		 		<td class="span-3" ><label><?php echo  __('codigo') ?></label></td>
		 		<td class="span-4 last"><?php echo $secorganization['Secorganization']['code']; ?></td>
		 	</tr>

			<tr>
		 		<td><label><?php echo __('nombre') ?></label> </td>
		 		<td><?php echo $secorganization['Secorganization']['name']; ?></td>
		 	</tr>
			<tr>
		 		<td><label><?php echo __('nombre') ?></label> </td>
		 		<td><?php echo $secorganization['Secorganization']['name']; ?></td>
		 	</tr>
			
			<tr>
			<tr>
		 		<td><label><?php echo  __('empresaType') ?></label></td>
		 		<td>
						<?php echo 
							$secorganization['Secorganization']['type'] == 0? __('propia', true): 
								 $secorganization['Secorganization']['type']== 1? __('cliente', TRUE): __('proveedor',TRUE);
						?>
				</td>
		 	</tr>				
				
		 		<td><label><?php echo __('empresaThema') ?></label> </td>
		 		<td><?php echo $secorganization['Secorganization']['thema']; ?></td>
		 	</tr>						
			<tr>
		 		<td><label><?php echo __('empresaEncabezado') ?></label> </td>
		 		<td><?php echo $secorganization['Secorganization']['photo1']; ?></td>
		 	</tr>
			<tr>
		 		<td><label><?php echo __('empresaPhoto1') ?></label> </td>
		 		<td><?php echo $secorganization['Secorganization']['photo1']; ?></td>
		 	</tr>						
			<tr>
		 		<td><label><?php echo __('empresaPhoto2') ?></label> </td>
		 		<td><?php echo $secorganization['Secorganization']['photo2']; ?></td>
		 	</tr>						
			<tr>
		 		<td><label><?php echo __('empresaText1') ?></label> </td>
		 		<td><?php echo $secorganization['Secorganization']['text1']; ?></td>
		 	</tr>				
			<tr>
		 		<td><label><?php echo __('empresaText2') ?></label> </td>
		 		<td><?php echo $secorganization['Secorganization']['text2']; ?></td>
		 	</tr>				
			<tr>
		 		<td><label><?php echo __('empresaAdress') ?></label> </td>
		 		<td><?php echo $secorganization['Secorganization']['address']; ?></td>
		 	</tr>				
			<tr>
		 		<td><label><?php echo __('empresaPhone') ?></label> </td>
		 		<td><?php echo $secorganization['Secorganization']['phono']; ?></td>
		 	</tr>				
			<tr>
		 		<td><label><?php echo __('estado'); ?></label> </td>
		 		<td><?php echo $secorganization['Secorganization']['status'] == 'AC' ? 
							__('Enable',true)
						:
							($secorganization['Secorganization']['status'] == 'DE'?
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
<br/><br/>
	<?php 		
		if($tieneroles){
		$url = $this->Html->url(array('action'=>'mostrarroles', $secorganization['Secorganization']['id']));
		echo $this->Html->link(__('Ver roles de esta Empresa',true), 'javascript:;',array('onclick' => "mostrarroles('".$url."')"), null, false);
		}
		else echo (__('empresaSinRoles',true));
?>		&nbsp;
		<br/>
<?php 		
		if($tieneroles){
		$url = $this->Html->url(array('action'=>'mostrarsucursales', $secorganization['Secorganization']['id']));
		echo $this->Html->link(__('empresaSucursales',true), 'javascript:;',array('onclick' => "mostrarsucursales('".$url."')"), null, false);
		}
		else echo (__('empresaSinSucursales'));
?>		&nbsp;
</div>