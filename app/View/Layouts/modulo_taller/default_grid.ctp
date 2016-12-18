<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	
<head>
	<title><?php echo $title_for_layout; ?></title>
	<?php echo $this->Html->charset('UTF-8'); ?>
	
	<!-- Url base para ajax -->
	<base id="dtBase" href="<?php echo Router::url('/'); ?>" permisorol="<?php //echo $datosLogeo['0']['Secrole']['name']; ?>" />
	<?php
		//echo $this->Html->css('print.css', 'media="print"');
		//echo $this->Html->css('screen.css');
		//echo $this->Html->css('ie.css');
	?>
	
	<?php 
		//CSS NECESARIOS #######################################################
//		echo $this->Html->css('modulo_taller/themes/redmond/jquery-ui-1.8.2.custom.css');
		echo $this->Html->css('modulo_taller/themes/blitzer/jquery.ui.all.css');
		echo $this->Html->css('modulo_taller/themes/ui.jqgrid.css');
		//echo $this->Html->css('modulo_taller/basic.css');
		echo $this->Html->css('modulo_taller/derco/derco.css');
		echo $this->Html->css('modulo_taller/derco/derco_ventana.css');
	
		//JS NECESARIOS #######################################################
		echo $this->Html->script('modulo_taller/jqgrid/jquery.min.js');
		echo $this->Html->script('modulo_taller/jqgrid/jquery-ui-1.8.2.custom.min.js');
		echo $this->Html->script('modulo_taller/jqgrid/i18n/grid.locale-sp.js');
		echo $this->Html->script('modulo_taller/jqgrid/jquery.jqGrid.min.js');
		echo $this->Html->script('modulo_taller/popup.js');
		echo $this->Html->script('modulo_taller/basic.js');
		
		//echo $this->Html->script('modulo_taller/modulo_taller.js');
		echo $this->Html->script('jquery-validate/jquery.validate.js');
		echo $this->Html->script('jquery-validate/lib/jquery.form.js');
		
		echo $this->Html->script('jquery-validate/mis.metodos.js');
		if(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2)=='es'){
			echo $this->Html->script('jquery-validate/localization/messages_es.js');
		};

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');	
	?>
	
	<?php echo $this->Html->script('contenido_total.js'); ?>
	<?php echo $this->Html->script('modulo_taller/taller.js'); ?>
	<?php echo $scripts_for_layout; ?>
</head>

<body>
	<div><?php echo $this->Session->flash();?></dv>
		<?php echo $content_for_layout; ?>
		<?php //echo $this->element('sql_dump'); ?>	
	</div> <!-- container -->
</body>
</html>