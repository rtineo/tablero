<?php echo $this->Session->flash();?>
	<br/>
	<h3 id="tituloTable"><?php echo __('configuracionDePassword');?></h3>
<?php echo $this->Form->create('Secconfiguration',array('action' => 'configuration')); ?>
<?php echo $this->Form->hidden('id') ?>
<table cellpadding="0" cellspacing="0" class="table" style= "width: 50%">
	<thead>
			<tr>
				<th colspan="2" scope="col">
					<?php echo __('configuracion');?>
				</th>
			</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<?php echo __('longitud');?>
			</td>
			<td>
				<?php echo $this->Form->text('minpasswordlength'); 
					  echo $this->Form->error('minpasswordlength', array(															
															        'numeric' =>  __('tipoNumerico'),
															        'minLength' =>  __('campoObligatorio')
																), array('class' => 'input text required error'));
				?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo __('tiempoValidades');?>
			</td>
			<td>
				<?php echo $this->Form->text('passwordtimelife'); 
					  echo $this->Form->error('passwordtimelife', array(															
															        'numeric' =>  __('tipoNumerico'),
															        'minLength' =>  __('campoObligatorio')
																), array('class' => 'input text required error'));
				?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo __('numeroDeRepeticiones');?>
			</td>
			<td>
				<?php echo $this->Form->text('previouspasswordlimit');
					  echo $this->Form->error('previouspasswordlimit', array(															
															        'numeric' =>  __('tipoNumerico'),
															        'minLength' =>  __('campoObligatorio')
																), array('class' => 'input text required error'));
				 ?>
			</td>
		</tr>
		<tr>
			<td colspan=2 style="text-align: center">
				<?php echo $this->Form->submit(__('guardar')) ?>
			</td>
		</tr>
	</tbody>
</table>
<?php echo $this->Form->end(); ?>