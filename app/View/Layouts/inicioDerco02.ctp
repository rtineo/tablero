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

		echo $this->Html->css('yoo_capture_wp/css/bootstrap.min.css');
		echo $this->Html->css('yoo_capture_wp/css/theme.css');
		
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
	a:link {text-decoration:none;color:#000;}
	a.red:link {text-decoration:none;color:red;}
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
										echo $this->Html->image('webClientes/loginClientes02.png', array('alt' => 'Logo de la empresa'));								 	
								 ?>  																
							</td>							
						</tr>
						<tr>
							<td>
								<?php echo $this->Session->flash(); ?>
								<?php echo $this->Session->flash('auth');	?>
							</td>
						</tr>			
						<tr>
							
							<td class="menuBar02" style="100%; width: 983px; ">
								<noscript>
									<div><?php __('estaPaginaRequiereTenerJavascriptActivado') ?></div>
								</noscript>
								
								<?php echo $content_for_layout; ?>													
							</td>
						</tr>	
					</tbody>					
				</table>	
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
<div class="copyrigth_2">
	"Estimado Cliente: Para acceder a nuestro servicio web deberá hacerlo desde el Navegador Internet Explorer v. 8.0 o superior,Mozilla  o Chrome"                           	
</div>

	            </div>
	        </div>
				</div>    
			</div>
		</div> 
	</center>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>