<?php				
		if($this->Session->check('actualizarPadre'))
		{			
			echo $this->Html->script('general/soloActualizarPadre.js');			
			CakeSession::delete('actualizarPadre');
		}	
?>