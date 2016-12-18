<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<noscript>
		<META http-equiv="REFRESH" content="0;URL=<?php echo $this->base ?>">
	</noscript>
	<!-- Framework CSS -->
	<?php
		echo $this->Html->script('prototype.js');
		echo $this->Html->meta('icon');
		$css = array('screen', 'ie', 'layouts/tqc', 'style');
		echo $this->Html->css('print', 'stylesheet', array('media'=>"print"));
		echo $this->Html->css($css, 'stylesheet', array('media'=>array("", "")));	

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');	
	?>
		
	<?php echo $scripts_for_layout; ?>	
	
</head>

<body>
<div id="contenedor" class="container">

	<div id="contenedorCuerpoAsignacion" class="span-24 equalHeight">
		<?php $this->Session->flash();
					$this->Session->flash('auth');	?>
			<?php echo $content_for_layout; ?>
	
	</div> <!-- contenedorCuerpo -->
</div> <!-- container -->
<?php //debug($_SESSION); ?>
	<?php //echo $cakeDebug; ?>
	<?php // echo $this->element('sql_dump'); exit();?>
    
    <?php echo $this->Js->writeBuffer(); // Write cached scripts ?>

</body>
</html>