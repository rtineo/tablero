<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title><?php echo $title_for_layout; ?></title>
	<?php echo $html->charset('UTF-8'); ?>
	
	<!-- Url base para ajax -->
	<base id="dtBase" href="<?php echo Router::url('/'); ?>" permisorol="<?php echo $datosLogeo['0']['Secrole']['name']; ?>" />
	<?php
		$css = array('screen', 'ie', 'style');
		echo $html->css('print', 'stylesheet', 'media="print"');
		echo $html->css($css, 'stylesheet', 'media="screen, projection"');
	?>
	
	<?php 
		//CSS NECESARIOS #######################################################
//		echo $html->css('modulo_taller/themes/redmond/jquery-ui-1.8.2.custom.css');
		echo $this->Html->css('modulo_taller/themes/blitzer/jquery.ui.all.css');
		echo $html->css('modulo_taller/themes/ui.jqgrid.css');
		echo $html->css('modulo_taller/basic.css');
	
		//JS NECESARIOS #######################################################
		echo $javascript->link('modulo_taller/jqgrid/jquery.min.js');
		echo $javascript->link('modulo_taller/jqgrid/jquery-ui-1.8.2.custom.min.js');
		echo $javascript->link('modulo_taller/jqgrid/i18n/grid.locale-sp.js');
		echo $javascript->link('modulo_taller/jqgrid/jquery.jqGrid.min.js');
		
		//echo $javascript->link('modulo_taller/modulo_taller.js');
		echo $javascript->link('jquery-validate/jquery.validate.js');
		if(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2)=='es'){
			echo $javascript->link('jquery-validate/localization/messages_es.js');
		};
	?>
	
	<?php echo $javascript->link('contenido_total.js'); ?>
	<?php echo $javascript->link('modulo_taller/taller.js'); ?>
	<?php echo $scripts_for_layout; ?>
</head>

<body class="av_fondo_general">

<div id="contenedorAcciones" class="" >
	<div id="contenedorCuerpoAcciones" class="">
		<div id="contenido" class="">
			<div class="" > <!-- <div class="span-10 prepend-2 appen-8 ingresarDatos" > -->			
				<?php if($session->flash()){$session->flash() ?> <br/> <?php }; ?>
				<?php $session->flash('auth'); ?>
				<?php echo $content_for_layout; ?>
			</div> <!-- ingresarDatos -->
		</div> <!-- contenido -->
	</div> <!-- contenedorCuerpo -->
</div> <!-- container -->

</body>
</html>