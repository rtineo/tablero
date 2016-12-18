<h2><?php echo $grupo_usuario; ?></h2>

<?php if($listaDePermisosPrincipal):  ?>
		<table cellpadding="0" cellspacing="0" style='width: 80%;'>
		<thead>
		<tr>
			<th><?php echo 'Controlador';?></th>
			<th><?php echo 'Acciones';?></th>
			<th><?php echo 'Acceso';?></th>
			<th><?php echo 'Acciones';?></th>
		</tr>
		</thead>
		<tbody>
	<?php foreach($listaDePermisosPrincipal as $PermisoPrincipal): ?>
		<tr>
			<td>
				<?php echo $PermisoPrincipal['listaDePermisos']['controlador']; ?>
			</td>
			<td>
				<?php echo $PermisoPrincipal['listaDePermisos']['acciones']; ?>
			</td>
			<td>
				<?php if($PermisoPrincipal['listaDePermisos']['aros_acos_acceso'] == 1) 
							echo 'Permitido'; 
					  else 	
					  		echo 'Denegado';
				?>
			</td>
			<td>
				<?php 
				IF($PermisoPrincipal['listaDePermisos']['aros_acos_acceso'] == 1) 
					echo $this->Html->link('Denegar',array('controller'=>'Secaccesses','action'=>'denegarpermiso',1,
						$PermisoPrincipal['listaDePermisos']['aros_id'],
						$PermisoPrincipal['listaDePermisos']['acos_id'])); 
				ELSE 	
					echo $this->Html->link('Permitir',array('controller'=>'Secaccesses','action'=>'permitir',1,
						$PermisoPrincipal['listaDePermisos']['aros_id'],
						$PermisoPrincipal['listaDePermisos']['acos_id'])); ?>
				
				<?php echo $this->Html->link('Cancelar', array('action'=>'cancelar',
						$PermisoPrincipal['listaDePermisos']['aros_id'],
						$PermisoPrincipal['listaDePermisos']['acos_id']),
						null, 'Esta seguro que desea cancelar este registro?'); ?>
			</td>
		</tr>
	<?php endforeach; ?>
		</tbody>
		</table>
<?php endif; ?>

<?php echo $this->Html->link('Agregar Permisos',array('controller'=>'Secaccesses','action'=>'accederpermiso',$aros_id)); ?>
		

<?php if($listaDePermisosHeredado): { ?>
<?php foreach($listaDePermisosHeredado as $PermisosHeredado): ?>
<h2>Permisos Heredados por su Grupo: <?php echo $PermisosHeredado['listaDePermisos']['aros_alias']; ?></h2>
<?php endforeach; }?>
<table cellpadding="0" cellspacing="0" style='width: 50%;'>
<tr>
	<th><?php echo 'Controlador';?></th>
	<th><?php echo 'Acciones';?></th>
	<th><?php echo 'Acceso';?></th>
</tr>

<?php foreach($listaDePermisosHeredado as $PermisoHeredado): ?>
<tr>
	<td>
		<?php echo $PermisoHeredado['listaDePermisos']['controlador']; ?>
	</td>
	<td>
		<?php echo $PermisoHeredado['listaDePermisos']['acciones']; ?>
	</td>
	<td>
		<?php IF($PermisoHeredado['listaDePermisos']['aros_acos_acceso'] == 1) 
					echo 'Permitido'; 
			  ELSE echo 'Denegado';?>
	</td>	
</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>
<br/>
<?php echo $this->Html->link('Lista de Accesos',array('controller'=>'Secaccesses','action'=>'listaccess')); ?>