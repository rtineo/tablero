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

<body>
	<center>
		<div id="container" >			
			<div id="header">
				<table border="0" cellpadding="0" class="web">
					<tboody>
						<tr>
							<td id="menuSuperiorImagen"  class="menuSuperiorImagen" width="1024" style="height: 103px;">
								<?php								 
										echo $this->Html->image('webClientes/cabeceraWeb.jpg', array('alt' => 'Logo de la empresa'));								 	
								 ?>
								 <div id="datosLoginCliente" style="float: right; margin-top: 2px;">
									 <span id="botonSarlirWeb">
										<?php 
												echo $this->Html->link(__(' Salir',true),array('controller'=> 'Secassigns', 'action'=>'logout'));
										?>	
										<?php 	echo $this->Html->image('salir.png',array( 'alt' => 'salir')); 	?>							 	
									 </span>
								 </div>  																								
							</td>							
						</tr>					
					</tboody>					
				</table>	
					    
			</div>
			
			<div id="content" style="width :983px ;background-color: #FFFFFF;" >									
				<?php echo $this->Session->flash();
				echo $this->Session->flash('auth');	?>
				<?php echo $content_for_layout; ?>														
			</div>				
		</div> 
		<div id="footer" style="width: 983px;">
			<div class="pie" style="vertical-align: middle;">
				<span class="pie_izq">DERCO S.A.(Web)</span>
				<span class="pie_mid">Estimado Cliente: Para acceder a nuestro servicio web deberá hacerlo desde el Navegador Internet Explorer v. 8.0 o superior,<a href="http://www.mozilla.org/es-ES/firefox/new/" target="_blank">Mozilla</a> o <a href="http://www.google.com/chrome?hl=es" target="_blank">Chrome</a></span>
				<span class="pie_der">© 2013 SAV :: Powered By CHIU S.A.C.</span>
			</div>
		</div>
	</center>
</body>
</html>