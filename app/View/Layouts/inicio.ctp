<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	
	<!-- Framework CSS -->
	<?php
		echo $this->Html->script('prototype.js');
		echo $this->Html->script('jquery.js');
		echo $this->Html->script('jquery-validate/jquery.validate.js');
		echo $this->Html->meta('icon');
		echo $this->fetch('meta');
		$css = array('screen', 'ie', 'layouts/tqc', 'style');
		/*
		*
		*<link rel="stylesheet" type="text/css" href="/css/screen.css" />
		*<link rel="stylesheet" type="text/css" href="/css/ie.css" />
		*<link rel="stylesheet" type="text/css" href="/css/layouts/tqc.css" />
		*
		*/
		echo $this->Html->css('print', 'stylesheet', array('media'=>'print'));
		echo $this->Html->css($css, 'stylesheet', array('media'=>array("screen, projection")));	

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');	
	?>
		
	<?php echo $scripts_for_layout; ?>	
	
</head>

<body>
<div id="contenedor" class="container">
	
	<div id="contenedorCuerpoLogin" class="span-24 equalHeight">
		<noscript>
			<div class="failure"><?php __('estaPaginaRequiereTenerJavascriptActivado') ?></div>
		</noscript>
		<?php echo $this->Session->flash();
					echo $this->Session->flash('auth');	?>
			<?php echo $content_for_layout; ?>
	
	</div> <!-- contenedorCuerpo -->
</div> <!-- container -->


	<?php echo $scripts_for_layout; ?>
	<?php //echo $this->element('sql_dump'); ?>
	<?php echo $this->Js->writeBuffer(); // Write cached scripts ?>
	
</body>
</html>