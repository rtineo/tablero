<?php echo $this->Html->script('secassigns/modificarpassword.js'); ?>
<?php echo $this->Session->flash();?>

<style>
	body {text-align:center; background:#A41818 url('<?php echo $this->webroot ?>img/derco-back.jpg')}
 	td {border: 0;}
</style>

<?php echo $this->Form->create('Secperson', array('url' => array('controller' => 'Secassigns', 'action' =>'asignacion'),'id' => 'SecpersonLoginForm' )); ?>
<br/>

<div class = "span-17" style="text-align: center; font-size: 14px; font-weight: bold; color:"><?php echo __('ingresarSistemaWeb');?></div>
<table style="width: 80%; margin-left: 30%; margin-right: auto;">
	<tbody>
	
		<tr>
			<td style="text-align: right" ><?php echo $this->Form->label(__('usuarioNombre',true)); ?></td>
			<td><?php echo $this->Form->text('username',array('style' => 'width: 150px')); ?></td>		
		</tr>
		
		<tr>
			<td style="text-align: right"><?php echo $this->Form->label(__('contrasenia',true)); ?></td>
			<td><?php echo $this->Form->text('password',array('type'=>'password','style' => 'width: 150px',
											'id'=>'Password', 'readonly'=>'readonly', 'value'=>'' )); ?></td>	
		</tr>	
		
		<tr>
			<td style="text-align: center" colspan="2">
				<!-- Aqui la logica del codigo -->
				<div id = "codigo">
					<div id = "codNum">
					</div>
					<?php echo $this->element('codLetras'); ?>
				
					<div id="reset">
						<input id="btnReset" class="button_off" type="button" value="Borrar Todo" style="width: 199px; font-size: 11px;"/>
					</div>
				</div>
			</td>
		</tr>
		
		<tr>	
			<td colspan="10" style="text-align: center" >
					<?php echo $this->Form->submit(__('Ingresar',true),array('div' => false,'style' => 'width: 100px', 'id'=>'enviar')); ?>		
			</td>
		</tr>
	</tbody>
</table>
<?php echo $this->Form->end(); ?>