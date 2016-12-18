<h2>Login</h2>
<?php
	echo $this->Form->create('Secassign', array('url' => array('controller' => 'Secpeople', 'action' =>'login')));
	echo $this->Form->input('username');
	echo $this->Form->input('password');
	echo $this->Form->end('Login');
?>