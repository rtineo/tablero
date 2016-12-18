<?php	if($this->Session->check('actualizarPadre')){			
			echo $this->Html->script('general/actualizarPadre.js');
			CakeSession::delete('actualizarPadre');
		}	
?>