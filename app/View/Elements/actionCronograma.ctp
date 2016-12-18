<?php 	
     if(empty($estado) || $estado == 'AC' || $estado == 'LI')
         {	
	   $url = $this->Html->url(array('controller'=>'appcasttimes','action'=>'modificarCronograma', $id));
           $image = $this->Html->image('calendar.gif', array('title'=>__('modificarCronograma',true), "alt" => "mostrar"));
	   echo $this->Html->link($image, 'javascript:;',array('onclick' => "modificarCronograma('".$url."')",'escape'=>false), null, false);
	 }
?>
