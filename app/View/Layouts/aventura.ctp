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
	echo $this->xhtml->css('derco/defecto/themes/redmond/jquery-ui-1.7.1.custom.css');
	//echo $this->xhtml->css('theme/redmond/jquery.ui.autocomplete.css');
	
	echo $this->xhtml->css('derco/defecto/themes/ui.jqgrid.css');
	echo $this->xhtml->css('derco/defecto/themes/ui.multiselect.css');
	echo $this->xhtml->css('derco/defecto/general.css');
	echo $this->xhtml->css('derco/defecto/blueprint/grid.css'); 
	echo $this->xhtml->css('derco/defecto/derco.css'); 
	
	// jQuery Framework
		echo($this->Html->script('jquery/jquery-1.4.2.min.js'));
		echo ($this->Html->script('jquery/ui/jquery-ui-1.8.4.custom.js'));
		//echo ($this->Html->script('jquery/jquery-ui-1.7.2.custom.js'));
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
		
		echo ($this->Html->script('jquery/ui/jquery.ui.datepicker-es.js'));
		echo  $this->Html->script('usc/usc.js');
		
		//validacion de datos
		echo ($this->Html->script('jquery/validate/lib/jquery.metadata.js'));
		echo ($this->Html->script('jquery/validate/jquery.validate.min.js'));
		echo ($this->Html->script('jquery/validate/messages_es.js'));
		
		echo ($this->Html->script('jquery/jsbase_aventura.js'));
		// echo ($this->Html->script('comun.js'));
		
		
	?>
	
	<base href="<?php echo $this->Html->url('/') ?>"/>
</head>

<body>
	<div id="container">
		<div id="header">
		</div>
		<div id="content">
			<?php echo $this->Session->flash(); ?>
			<?php 	//if ($session->check('Message.flash'))  $session->flash();
					echo $content_for_layout;
			?>
		</div>
		<div id="footer" style="width: 983px;">
			<!--
			<div class="pie" style="vertical-align: middle;">
				<span class="pie_izq">DERCO S.A.(Web Cliente)</span>
				<span class="pie_der">© 2010 SAV :: Powered By CHIU S.A.C.</span>
			</div>
			-->
		</div>
	</div>
</body>
</html>