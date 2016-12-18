<?php echo $this->Html->script('layouts/mijquery.js'); ?>
<div class="span-14" >
	<?php echo $this->Session->flash();?>
	<br/>
	<h3 id="tituloTable"><?php echo (__('Roles',true)).' '. $secorganization['Secorganization']['name'];?></h3>
	<hr/>
<table cellpadding="0" cellspacing="0" class="table" >
	<thead>
		<tr>
			<th><?php echo (__('codigo',true));?></th>
			<th><?php echo (__('nombre',true));?></th>
			<th><?php echo (__('estado',true));?></th>
		</tr>
	</thead>

	<tbody>
		<?php  foreach ($secroles as $secrole):?>
		<tr>
			<td>
				<?php echo $secrole['Secrole']['code']; ?>
			</td>
			<td>
				<?php echo $secrole['Secrole']['name']; ?>
			</td>
			<td>
				<?php
				echo $secrole['Secrole']['status'] == 'AC' ?
							__('Enable',true)
						:
							($secrole['Secrole']['status'] == 'DE'?
								__('Disable',true)
							:
								__('Limited',true))
						; ?>
			</td>

		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
<br/>
<hr/>
		<div class=" span-8 botones" >
			<?php  echo $this->Form->button(__('cerrar',true), array('type'=>'button','onClick' => 'javascript:window.close()')); ?>
			<?php echo $this->Form->end();?>
		</div>
</div>