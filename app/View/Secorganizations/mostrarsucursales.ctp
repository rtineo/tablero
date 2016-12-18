	<?php echo $this->Html->script('layouts/mijquery.js', false); ?>
<div class="span-18">
	<?php echo $this->Session->flash();?>
	<br/>
	<h3 id="tituloTable"><?php echo(__('ProjectListar',true)).' de '. $secorganization['Secorganization']['name'];?></h3>
	<hr/>
<table cellpadding="0" cellspacing="0" class="table" >
	<thead>
		<tr>
			<th><?php echo (__('codigo'));?></th>
			<th><?php echo (__('nombre'));?></th>
			<th><?php echo (__('ProjectPhoto1'));?></th>
			<th><?php echo (__('ProjectPhoto2'));?></th>
			<th><?php echo (__('ProjectText1'));?></th>
			<th><?php echo (__('ProjectText2'));?></th>
			<th><?php echo (__('estado'));?></th>			
		</tr>			
	</thead>
	
	<tbody>
			<?php foreach ($secprojects as $secproject): ?>
	<tr>
		<td><?php echo $secproject['Secproject']['code']; ?>
		</td>
		<td><?php echo $secproject['Secproject']['name']; ?>
		</td>
		<td><?php echo $secproject['Secproject']['photo1']; ?>
		</td>
		<td><?php echo $secproject['Secproject']['photo2']; ?>
		</td>
		<td><?php echo $secproject['Secproject']['text1']; ?>
		</td>
		<td><?php echo $secproject['Secproject']['text2']; ?>
		</td>		
		<td>
		
		<?php echo $secproject['Secproject']['status'] == 'AC' ? 
							__('Enable',true)
						:
							($secproject['Secproject']['status'] == 'DE'?
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