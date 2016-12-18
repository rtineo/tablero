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
		
		/*
		*
		*<link rel="stylesheet" type="text/css" href="/css/screen.css" />
		*<link rel="stylesheet" type="text/css" href="/css/ie.css" />
		*<link rel="stylesheet" type="text/css" href="/css/layouts/tqc.css" />
		*
		*/
		echo $this->Html->css('login.css');
		echo $this->Html->css('print', 'stylesheet', array('media'=>'print'));
		echo $this->Html->css( 'stylesheet', array('media'=>array("screen, projection")));	

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');	
	?>
		
	<?php echo $scripts_for_layout; ?>	
	
</head>
<style type="text/css"> 
	a:link {text-decoration:underline;color:#FFFFFF;}
	 a:visited {text-decoration:none;color:#ffcc33;}
	 a:active {text-decoration:none;color:#ff0000;}
	 a:hover {text-decoration:underline;color:#999999;}
</style>
<body>
	<center>
		<div id="container" >			
			<div id="header">
				<table border="0" cellpadding="0" class="web">
					<tbody>
						<tr>
							<td id="menuSuperiorImagen"  class="menuSuperiorImagen" width="1024">
								<?php								 
										echo $this->Html->image('webClientes/login_clientes2.png', array('alt' => 'Logo de la empresa'));								 	
								 ?>  																
							</td>							
						</tr>					
					</tbody>					
				</table>	
					    
			</div>
			
			<div id="content" style="width :983px ;background-color: #FFFFFF;" >
				<table border="0" cellpadding="0" cellspacing="0" class="web">
					<tbody>
						<tr>
							<td class="menuBar" style="height: 320px; width: 190px; ">
										<noscript>
											<div><?php __('estaPaginaRequiereTenerJavascriptActivado') ?></div>
										</noscript>
										<?php echo $this->Session->flash();
										echo $this->Session->flash('auth');	?>
										<?php echo $content_for_layout; ?>															
							</td>
							<td id="fotoModelo" class="cuerpoImagen"   style="width: 780px; height: 320px;">							
								<?php								 
										echo $this->Html->image('webClientes/cuerpo_imagen.jpg', array('alt' => 'Logo de la empresa'));
								 ?>  		
							</td>
						</tr>
					</tbody>
				</table>										
			</div>	
			
			<div id="footer" style="width: 983px;">
				<div class="pie" style="vertical-align: middle;">
					<span class="pie_izq">DERCO S.A.(Web)</span>
					<span class="pie_mid">Estimado Cliente: Para acceder a nuestro servicio web deberá hacerlo desde el Navegador Internet Explorer v. 8.0 o superior,<a href="http://www.mozilla.org/es-ES/firefox/new/" target="_blank">Mozilla</a> o <a href="http://www.google.com/chrome?hl=es" target="_blank">Chrome</a>
					</span>
					<span class="pie_der">© <?php echo date('Y') ?> SAV :: Powered By CHIU S.A.C.</span>
				</div>
			</div>
		</div> 
	</center>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>