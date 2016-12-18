<?php if ($this->controller->Session->check('msg_web')) { ?>
<div style="margin: 3px; color: blue; text-align: center; font-size: 8pt;" id="flashMessage">
	<?php echo $this->controller->Session->read('msg_web'); ?>
</div>
<?php
    // se borra la petición una vez que se muestra el mensaje web
    if ($this->controller->Session->check('msg_web')) {
        $this->controller->Session->del('msg_web');
    }
} ?>