<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $title_for_layout; ?></title>
<?php echo $this->Html->charset('UTF-8'); ?>
<!--
<link rel="icon" href="<?php echo $this->webroot . 'favicon.ico'; ?>" type="image/x-icon" />
<link rel="shortcut icon" href="<?php echo $this->webroot . 'favicon.ico'; ?>" type="image/x-icon" />
-->
<!-- Url base para ajax -->
	<base id="dtBase" href="<?php echo Router::url('/'); ?>" permisorol="<?php //echo $datosLogeo['0']['Secrole']['name']; ?>" />
<?php
		
		// echo $this->Html->css('yoo_capture_wp/css/bootstrap.min.css');
		echo $this->Html->css('yoo_capture_wp/css/theme.css');
		
		//CSS NECESARIOS #######################################################
//		echo $this->Html->css('modulo_taller/themes/redmond/jquery-ui-1.8.2.custom.css');
		echo $this->Html->css('modulo_taller/themes/blitzer/jquery.ui.all.css');
		echo $this->Html->css('modulo_taller/themes/ui.jqgrid.css');
		
		echo $this->Html->css('modulo_taller/derco/web.css');
		echo $this->Html->css('modulo_taller/derco/derco.css');
		echo $this->Html->css('login.css');
		
		//JS NECESARIOS #######################################################
		echo $this->Html->script('modulo_taller/jqgrid/jquery.min.js');
		echo $this->Html->script('modulo_taller/jqgrid/jquery-ui-1.8.2.custom.min.js');
		echo $this->Html->script('modulo_taller/jqgrid/i18n/grid.locale-sp.js');
		echo $this->Html->script('modulo_taller/jqgrid/jquery.jqGrid.min.js');
		echo $this->Html->script('modulo_taller/popup.js');
?>
<?php echo $this->Html->script('modulo_taller/taller.js'); ?>
	
</head>
<style type="text/css"> 
	a:link {text-decoration:underline;color:#FFFFFF;}
	 a:visited {text-decoration:none;color:#ffcc33;}
	 a:active {text-decoration:none;color:#ff0000;}
	 a:hover {text-decoration:underline;color:#999999;}

	#formularioEdicion .texto, .formularioEdicion .texto {
		color:black;
	}
</style> 
<body>
	<center>
		<div id="container">
			<div id="header">
				<?php echo $this->element('cabecera_web') ?>
			</div>
			<div id="content" style="width: 983px; background-color: #FFFFFF;">
				<?php
//	                if ($session->check('Message.flash'))	{
//						$session->flash();
//					}
				?>
				<?php echo $content_for_layout; ?>
			</div>
			<div id="footer" style="width: 983px;">
				<div class="tm-block">
	        	<div class="uk-container uk-container-center">
	            	<div class="copyrigth">
						                    <div class="content_copyright">
	<div class="text_dir_copy_left">
	&copy; DERCO 2014, todos los derechos reservados<br>
	Política de Privacidad  |  <a href="mailto:info@derco.com">info@derco.com</a>
	</div>
	<div class="text_dir_copy_right">
	CASA MATRIZ: Av. Nicolás Aylón 2648 Ate
	</div>
	</div>
	<div class="icon_social_pie">
		<div class="icon_facebook_pie">
			<a target="_blank" href="https://www.facebook.com/DercoPeru">
				<?php echo $this->Html->image('yoo_capture_wp/facebook.png', array('alt'=>"Síguenos en Facebook", 'title'=>"Síguenos en Facebook")); ?>
			</a>
		</div>
		<div class="icon_twitter_pie">
			<a target="_blank" href="https://twitter.com/Derco_Peru">
				<?php echo $this->Html->image('yoo_capture_wp/twitter.png', array('alt'=>"Síguenos en Twitter", 'title'=>"Síguenos en Twitter")); ?>
			</a>
		</div>
		<div class="icon_youtube_pie">
			<a target="_blank" href="https://www.youtube.com/user/DercoPeruOficial">
				<?php echo $this->Html->image('yoo_capture_wp/youtube.png', array('alt'=>"Síguenos en Youtube", 'title'=>"Síguenos en Youtube")); ?>
			</a>
		</div>
	</div>                                 	
	</div>
	</div>
	        </div>
				</div>  
			</div>
		</div>
	</center>
</body>
</html>