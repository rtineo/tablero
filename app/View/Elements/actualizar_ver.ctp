<?php	
if($this->Session->check('actualizarPadre')){			
			echo $this->Html->script('general/actualizarVista.js');
			CakeSession::delete('actualizarPadre');
		}	
?>