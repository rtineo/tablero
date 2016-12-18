<?php echo $this->Html->script('layouts/mijquery.js'); ?>
<?php echo $this->Html->script('Servicios/index.js'); ?>
		<?php echo $this->Session->flash();  ?>
		<br/>
			<h3 id="tituloTable"><?php echo __('Conoce nuestros Servicios');?></h3>
		
		<div class="box">
			<div id="agregar" class="span-5" >
			<?php 	
					$url = $this->Html->url(array("action"=>'add'));  
					echo $this->Html->link($this->Html->image('agregar.png', array('alt' => 'Agregar')),
									 'javascript:;',
									 array('onclick' => "add('".$url."')",'escape'=>false),
									 null); 
			?>
				&nbsp;
			<?php 
				echo $this->Html->link(__('Add', true), 'javascript:;',array('onclick' => "add('".$url."')")); 
			?>					
			</div>
			<div id="buscador" class="">&nbsp;
			</div>	
		</div>		
		<table cellpadding="0" cellspacing="0" class="table" >
			<thead>
			<tr>
                 <th><?php echo __('Imagen',true);?></th> 
				<th><?php echo $this->Paginator->sort('Servicio.img',__('Archivo',true));?></th>  
				<th><?php echo $this->Paginator->sort('Servicio.titulo',__('Titulo',true));?></th>    
				<th><?php echo $this->Paginator->sort('Servicio.description',__('Descripcion',true));?></th>        
				<th><?php echo $this->Paginator->sort('Servicio.status',__('Estado',true));?></th>        
				<th class="actionsfijo"><?php  echo __('Actions');?></th>
			</tr>			
			</thead>
			
			<tbody>
				<?php  foreach ($servicios as $servicio):?>
				<tr>
					<td><?php echo  $this->Html->image("/img/Servicios/".$servicio['Servicio']['fileName'], array('WIDTH'=>$servicio['Servicio']['anchura'], 'HEIGHT'=>80, "alt" => "mostrar", 'width'=>'19')); ?></td>
					<td><?php 	echo $servicio['Servicio']['fileName']; ?></td>
					<td><?php 	echo $servicio['Servicio']['titulo']; ?></td>
					<td><?php 	echo $servicio['Servicio']['description']; ?></td>
					<td class="textc">
						<?php echo $servicio['Servicio']['status'] == 'AC' ?__('Activo',true):__('Desactivo',true); ?>
					</td>
			
					<td class="actionsfijo">						
					<?php 
						if(in_array($servicio['Servicio']['status'], array('AC','DE','LI'))){
							echo $this->Html->link(
								$this->Html->image('derco/defecto/eliminar.png', array('title'=>__('eliminar',true), "alt" =>__('eliminar',true))), 
								array('action'=>'delete', $servicio['Servicio']['id']), 
								array('escape'=>false), 
								sprintf(__('estaSeguroEliminar %s?'), $servicio['Servicio']['description'])
							);
						}
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