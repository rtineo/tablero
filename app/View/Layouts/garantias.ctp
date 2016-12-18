<?php
// Para prevenir bug de cache en FF (https://bugzilla.mozilla.org/show_bug.cgi?id=327790)
// HTTP/1.1 
header("Cache-Control: no-store, no-cache, must-revalidate"); 
// Date in the past
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
// HTTP/1.0 
header("Pragma: no-cache"); 
// always modified 
header("Last-Modified: " . gmdate( "D, j M Y H:i:s", time() ) . " GMT" );
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<!-- Url base para ajax -->
	<base id="dtBase" href="<?php echo Router::url('/'); ?>" permisorol="<?php echo $datosLogeo['0']['Secrole']['name']; ?>" />
	
	<title><?php echo $title_for_layout; ?></title>
	<link rel="icon" href="<?php echo $this->webroot . 'favicon.ico'; ?>" type="image/x-icon" />
	<link rel="shortcut icon" href="<?php echo $this->webroot . 'favicon.ico'; ?>" type="image/x-icon" />
<?php	
	echo $this->xhtml->css('derco/defecto/themes/redmond/jquery-ui-1.7.1.custom');
	
	echo $this->xhtml->css('derco/defecto/general.css');
	echo $this->xhtml->css('derco/defecto/blueprint/grid.css'); 
	echo $this->xhtml->css('derco/defecto/derco.css'); 
	
	echo $this->xhtml->css('derco/defecto/garantia.css');  
	
	// jQuery Framework
	
		echo($this->Html->script('jquery/jquery-1.4.2.min.js'));
		echo ($this->Html->script('jquery/ui/jquery-ui-1.8.4.custom.js'));
		echo ($this->Html->script('jquery/jquery.layout.js'));
		echo ($this->Html->script('jquery/i18n/grid.locale-sp.js'));
		echo ($this->Html->script('jquery/jquery.jqGrid.min.js'));
		
		// Archivos para - jQuery UI 
		echo ($this->Html->script('jquery/ui/jquery.ui.core.js'));
		echo ($this->Html->script('jquery/ui/jquery.ui.draggable.js'));
		echo ($this->Html->script('jquery/ui/jquery.ui.resizable.js'));
		echo ($this->Html->script('jquery/ui/jquery.ui.dialog.js'));
		echo ($this->Html->script('jquery/ui/jquery.ui.datepicker.js'));
		echo ($this->Html->script('jquery/ui/jquery.ui.widget.js'));
		echo ($this->Html->script('jquery/ui/jquery.ui.position.js'));
		echo ($this->Html->script('jquery/ui/jquery.ui.autocomplete.js'));
		echo ($this->Html->script('jquery/ui/jquery.ui.accordion.js'));
		echo ($this->Html->script('jquery/ui/jquery.ui.datepicker-es.js'));
		
		//validacion de datos
		echo ($this->Html->script('jquery/validate/lib/jquery.metadata.js'));
		echo ($this->Html->script('jquery/validate/jquery.validate.min.js'));
		echo ($this->Html->script('jquery/validate/messages_es.js'));
		echo ($this->Html->script('jquery/jquery.alerts.js'));
		echo ($this->Html->script('garantias/exportar.js'));
		echo ($this->Html->script('jquery/jsbase_aventura.js'));
		echo $this->xhtml->css('jquery/jquery.alerts');

		
	?>
	
	<base href="<?php echo $this->Html->url('/') ?>"/>
	<style type="text/css"> 
		.agregar {background:url('<?php echo $this->webroot ?>img/derco/defecto/agregargarantia.png') no-repeat; width:96px; height:25px; border:none; color:white; padding-bottom:2px;font-weight:bold; text-align:center !important}
		.rechazar {background:url('<?php echo $this->webroot ?>img/derco/defecto/rechazar.png') no-repeat; width:96px; height:25px; border:none; color:white;padding-bottom:2px; font-weight:bold; text-align:center !important}
		.cerrar {background:url('<?php echo $this->webroot ?>img/derco/defecto/cerrar.png') no-repeat; width:96px; height:25px; border:none; color:white;padding-bottom:2px; font-weight:bold; text-align:center !important}
		.cancelar {background:url('<?php echo $this->webroot ?>img/derco/defecto/cancelar.png') no-repeat; width:96px; height:25px; border:none; color:white;padding-bottom:2px; font-weight:bold; text-align:center !important}
		.observar {background:url('<?php echo $this->webroot ?>img/derco/defecto/observar.png') no-repeat; width:96px; height:25px; border:none; color:white;padding-bottom:2px; font-weight:bold; text-align:center !important}
		.buscar {background:url('<?php echo $this->webroot ?>img/derco/defecto/buscargarantia.png') no-repeat; width:96px; height:25px; border:none; color:white;padding-bottom:2px; font-weight:bold; text-align:center !important}
		.generar {background:url('<?php echo $this->webroot ?>img/derco/defecto/generarcorrelativo.png') no-repeat;width:147px; height:20px; border:none; color:white; font-weight:bold;padding-bottom:5px; vertical-align:text-top; text-align:center !important}
		.cargando{background:url('<?php echo $this->webroot ?>img/loader.gif') no-repeat right center;}
	</style> 	
</head>

<body>
	<div id="container">
		<div id="header">
		</div>
		<div id="content">
			<?php 
					echo $content_for_layout;
			?>
		</div>
	</div>
</body>
</html>