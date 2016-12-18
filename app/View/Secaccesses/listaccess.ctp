<style>
	a {
		text-decoration: none;
	}
	ul, li {
		margin:0pt 12px;
		margin-right: 0px;
	}
</style>

<br/>
	<h3 id="tituloTable"><?php echo __('Entidades que solicitan control', TRUE);?></h3>
<!--
<fieldset>
	<legend></legend>
-->
	<div id="menu-aros">
<?php	foreach($aros as $key => $aro)		
			{				
				if(!empty($aro['Aro']['alias']))
				{
					echo $aro['Aro']['listaDesordenada'];echo $aro['Aro']['alias'];
					
					echo '&nbsp;'.$this->Html->link($this->Html->image('permiso.png',array('alt' => 'Permiso','title' => 'Permiso')),
												  array('controller'=>'secaccesses','action'=>'listapermisos',$aro['Aro']['id']),
												  array('escape'=>false),
												  null);
												  
					if(empty($aro['Aro']['parent_id']))
						echo '&nbsp;'.$this->Html->link($this->Html->image('menu.png',array('alt' => 'Menu','title' => 'Menu')),
												  array('controller'=>'secprograms','action'=>'listprograms',$aro['Aro']['id']),
												  array('escape'=>false),
												  null);
				}
				else
					echo $aro['Aro']['listaDesordenada'];
			}
?>	</div> <!-- fin de menu aros -->
<!--
</fieldset>	
-->