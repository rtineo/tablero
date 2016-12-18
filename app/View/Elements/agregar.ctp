<?php 	
		$url = isset($url)?$url:'add';
		$url = $this->Html->url(array("action"=>$url));  
		echo $this->Html->link($this->Html->image('agregar.png', array('alt' => 'Agregar')),
						 'javascript:;',
						 array('onclick' => "add('".$url."')",'escape'=>false),
						 null); 
?>
	&nbsp;
<?php 
	echo $this->Html->link(__('Add', true), 'javascript:;',array('onclick' => "add('".$url."')")); 
?>
