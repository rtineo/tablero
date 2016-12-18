<style>
	a {
		text-decoration: none;
	}
	ul, li {
		margin:0pt 12px;
		margin-right: 0px;
	}
</style>

<fieldset>
	<legend><?php echo 'Lista de Acciones Para: '.$grupo_usuario; ?></legend>

	<div id="listaDeAccesos">
<?php	foreach($listaDeAccesos as $key => $item)		
		{				
			if(!empty($item['listaDeAccesos']['controlador']))
			{
				echo $item['listaDeAccesos']['listaDesordenada'];echo $item['listaDeAccesos']['controlador'];	
			}
			elseif(!empty($item['listaDeAccesos']['controladores']))
			{
				echo $item['listaDeAccesos']['listaDesordenada'];echo $item['listaDeAccesos']['controladores'];
			}
			elseif(!empty($item['listaDeAccesos']['acciones']))
			{
				echo $item['listaDeAccesos']['listaDesordenada'];echo $item['listaDeAccesos']['acciones'];
			}
			
			if(!empty($item['listaDeAccesos']['acos_id']))
			{
			echo '&nbsp;'.$this->Html->link($this->Html->image('permitir.png',array('alt' => 'Permitir','title' => 'Permitir')),
											  array('controller'=>'secaccesses','action'=>'permitir',0,$aros_id,$item['listaDeAccesos']['acos_id']),
											  array('escape'=>false),
											  null,
											  false);
											  
			echo '&nbsp;'.$this->Html->link($this->Html->image('denegar.png',array('alt' => 'Denegar','title' => 'Denegar')),
									  array('controller'=>'secaccesses','action'=>'denegarpermiso',0,$aros_id,$item['listaDeAccesos']['acos_id']),
									  array('escape'=>false),
									  null,
									  false);
			}
			if(empty($item['listaDeAccesos']['controlador']) && empty($item['listaDeAccesos']['controladores']) && empty($item['listaDeAccesos']['acciones']))
				echo $item['listaDeAccesos']['listaDesordenada'];
		}
?>
</div>
</fieldset>	