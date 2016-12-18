<?php //echo $this->Html->script('layouts/mijquery.js'); ?>
<?php echo $this->Html->script('layouts/mijquery.js'); ?>
<?php echo $this->Html->script('secprojects/index.js'); ?>
		<?php echo $this->Session->flash();  ?>
		<br/>
			<h3 id="tituloTable"><?php echo __('Asignar Marcas a Sucursales');?></h3>
		
		<div class="box">
			
			<div id="buscador" class="">
				<?php echo $this->element('buscador', array('elementos'=>$elementos,'url' => 'asignarmarcas')); ?>
			</div>
		</div>		
		<table cellpadding="0" cellspacing="0" class="table" >
			<thead>
			<tr>
         
				<th><?php echo $this->Paginator->sort('Secorganization.name',__('empresa',true));?></th>
				<th><?php echo $this->Paginator->sort('Secproject.code',__('codigo'));?></th>        
				<th><?php echo $this->Paginator->sort('Secproject.name',__('nombre',true));?></th>    
				<th><?php echo $this->Paginator->sort('Marca');?></th>    
				<th><?php echo $this->Paginator->sort('Secproject.status',__('estado',true));?></th>
				<th class="actionsfijo"><?php  echo __('Actions');?></th>
			
			</tr>			
			</thead>
			
			<tbody>
				<?php  foreach ($secprojects as  $secproject):?>
				<tr>
				<td>
					<?php echo $secproject['Secorganization']['name']; ?>
				</td>
				<td>
					<?php echo $secproject['Secproject']['code']; ?>
				</td>
				<td>
					<?php 		
							$url = $this->Html->url(array('action'=>'view', $secproject['Secproject']['id']));
							echo $this->Html->link($secproject['Secproject']['name'], 'javascript:;',array('onclick' => "mostrar('".$url."')",'escape'=>false), null);	
					?>		
				</td>
				<td class="textc">
					<?php 						
						if(!empty($secproject['MarcasSecproject']['id']))
							echo $this->Html->image('correcto.gif', array('alt' => 'Agregar'));
						else
							echo '';
					?>
				</td>
				<td class="textc">
					<?php echo $secproject['Secproject']['status'] == 'AC' ? 
									__('Enable',true)
								:
									($secproject['Secproject']['status'] == 'DE'?
										__('Disable',true)
									:
										__('Limited',true))
								; ?>
				</td>
		
				<td class="actionsfijo">						
					<?php 		
							$url = $this->Html->url(array('controller'=>'Secprojects','action'=>'asignar', $secproject['Secproject']['id']));							
								echo $this->Html->link($this->Html->image('agregar.png', array('alt' => 'Agregar')),
							 	'javascript:;',
							 	array('onclick' => "asignar('".$url."')",'escape'=>false),
							 	null); 	
					?>	
				</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>

<div id ="paging" class="span-18">
    <?php echo $this->element('paginador'); ?>
</div>
<div class="clear"></div>