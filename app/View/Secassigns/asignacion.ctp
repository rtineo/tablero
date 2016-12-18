<style>	td {border: 0;}</style>
<?php echo $this->Html->script('jquery'); ?>
<?php echo $this->Form->create('Secassign', array('url' => array('controller' => 'secassigns', 'action' =>'login'),'id' => 'SecassignSecassign')); ?>
<?php echo $this->Form->hidden('Secperson.username'); ?>
<?php echo $this->Form->hidden('Secperson.password'); ?>

	<?php echo $this->Session->flash();?>
	<br/>
<table style="width: 400px; margin: auto; border: 1px solid #009eba">
	<thead>
		<tr>
			<th colspan=4><?php echo (__('Login'));?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td></td>
			<td><?php echo $this->Form->label(__('Organization')); ?></td>
			<td><?php echo $this->Form->select('Secorganization.id',array($secorganizations),array('style' => 'width: 200px','label'=>false,'escape'=>false,'empty'=>false,'onchange'=>'cargarSecproject()'));
				?></td>	
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td><?php echo $this->Form->label(__('Proyecto')); ?></td>
			<td><?php echo $this->Form->select('secproject_id',array($secprojects),array('style' => 'width: 200px','label'=>false,'escape'=>false,'empty'=>false,'onchange'=>'cargarSecroles(this.value)')); 
				?></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td><?php echo $this->Form->label(__('Rol')); ?></td>
			<td><?php echo $this->Form->select('secrole_id',array($secroles),array('style' => 'width: 200px','label'=>false,'escape'=>false,'empty'=>false));?></td>
			<td></td>
		</tr>
		<tr>
			<td style="text-align: center" colspan=4><?php echo $this->Form->submit(__('Aceptar'),array('div' => false,'style' => 'width: 100px')); ?></td>
			
		</tr> 
	</tbody>
</table>
<?php echo $this->Form->end(); ?>
<?php //echo $this->element('sql_dump'); //exit();?>
<script type="text/javascript">
	var url;
	var secprojectId;
	var userName;
	var password;		
	
	url="<?php echo $this->base;?>";

	function cargarSecproject(){
			userName=document.getElementById('SecpersonUsername').value;
			password=document.getElementById('SecpersonPassword').value;
			var organizacion = new Ajax.Updater(
			'SecassignSecprojectId', 
			url+"/Secassigns/listprojects/"+userName+'/'+password, 
			{
				method: 'post', 
				asynchronous:true, 
				evalScripts:true, 
				parameters:Form.Element.serialize('SecorganizationId'), 
				requestHeaders:['X-Update', 'SecassignSecprojectId'],
				onComplete: function() {
					var idServicio = $F('SecassignSecprojectId');
					cargarSecroles(idServicio);
				}
			}
			);
	}
	function cargarSecroles(project){
			userName=document.getElementById('SecpersonUsername').value;
			password=document.getElementById('SecpersonPassword').value;
			var organizacion = new Ajax.Updater(
			'SecassignSecroleId', 
			url+"/Secassigns/listroles/"+userName+'/'+password+'/'+project, 
			{
				method: 'post', 
				asynchronous:true, 
				evalScripts:true, 
				parameters:Form.Element.serialize('SecassignSecprojectId'), 
				requestHeaders:['X-Update', 'SecassignSecroleId']
			}
			);
	}
	function unSoloRol(organizacion,sucursal,rol)
	{		
		if(organizacion == 1 && sucursal == 1 && rol == 1)
		document.getElementById("SecassignSecassign").submit();
	}
	
	var organizacion = <?php echo COUNT($secorganizations) ?>;
	var sucursal = <?php echo COUNT($secprojects) ?>;
	var rol = <?php echo COUNT($secroles) ?>;
	unSoloRol(organizacion,sucursal,rol);
	
</script>
<?php echo $this->Js->writeBuffer(); ?>