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
	<base id="dtBasic" href="<?php echo Router::url('/'); ?>" permisorol="<?php //echo $datosLogeo['0']['Secrole']['name']; ?>" />
	<?php
		echo $this->Html->script('jquery-1.3.2.min.js');
		echo $this->Html->script('jquery-validate/jquery.validate.js');
		if(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2)=='es'){
			echo $this->Html->script('jquery-validate/localization/messages_es.js');
		};
		echo $this->Html->script('general/forselenium.js');
		echo $this->Html->script('jquery-validate/mis.metodos.js');
		
		echo $this->Html->meta('icon');
		$css = array('screen', 'ie', 'layouts/tqc'); // , 'style'
		echo $this->Html->css('print', 'stylesheet', array('media'=>'print'));
		echo $this->Html->css($css, 'stylesheet');
		echo $this->Html->css('derco/defecto/themes/redmond/jquery-ui-1.7.1.custom.css');
		 
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
		echo $this->Html->css('derco/defecto/derco.css'); 
	?>
	
	<?php echo $scripts_for_layout; ?>
	<!-- Url base para ajax -->
	<base href="<?php echo Router::url('/'); ?>" />
</head>

<body>

<div id="contenedorAcciones" class="prepend-1 span-22 append-1" >
	<div id="contenedorCuerpoAcciones" class="span-22">
		<div id="contenido" class="span-22">
			<div class="span-22 ingresarDatos" > <!-- <div class="span-10 prepend-2 appen-8 ingresarDatos" > -->			
				<?php if($this->Session->flash()){$this->Session->flash() ?> <br/> <?php }; ?>
				<?php echo $this->Session->flash('auth'); ?>
				<?php echo $content_for_layout; ?>
			</div> <!-- ingresarDatos -->
		</div> <!-- contenido -->
	</div> <!-- contenedorCuerpo -->
</div> <!-- container -->

<?php //debug($_SESSION); ?>
<?php //echo $this->element('sql_dump'); ?>
</body>
</html>