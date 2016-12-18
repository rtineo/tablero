<html>
<head>
	<!-- Url base para ajax -->
	<base id="dtBase" href="<?php echo Router::url('/'); ?>" permisorol="<?php echo $datosLogeo['0']['Secrole']['name']; ?>" />
	
	<?php
		echo $html->script('jquery-1.3.2.min.js');
		echo $html->script('jqueryUI/jquery-ui-1.8.custom.min.js');
//		echo $html->script('jqgrid/jquery.jqGrid.js');
		echo $html->script('usc/usc.js');
		
		echo $html->script('usc/jalert/jquery.alerts.js');
		echo $html->css('usc/jalert/jquery.alerts.css');
		
		echo $javascript->link('jquery-validate/jquery.validate.js');
		if(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2)=='es'){
			echo $javascript->link('jquery-validate/localization/messages_es.js');
		};
		
		// CSS NECESARIOS
		echo $html->css('theme/redmond/jquery-ui-1.7.2.custom.css');
		echo $html->css('usc/default.css');
	?>
	
	<?php echo $scripts_for_layout; ?>	
</head>

<body>
<?php 
	echo $session->flash();
	echo $session->flash('auth');
	echo $content_for_layout; 
?>
</body>
</html>