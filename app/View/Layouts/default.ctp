<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout;?>
	</title>
	<noscript>
		<META http-equiv="REFRESH" content="0;URL=<?php echo $this->base ?>">
	</noscript>
	<!-- Framework CSS -->
	<!-- Url base para ajax -->
	<base id="dtBase" href="<?php echo Router::url('/'); ?>" permisorol="<?php //echo $datosLogeo['0']['Secrole']['name']; ?>" />

	<?php
		echo $this->Html->script('jquery');
		echo $this->Html->script('jquery-1.3.2.min.js');
		echo $this->Html->script('jquery-validate/jquery.validate.js');
		echo $this->Html->script('jquery-treeview/jquery.cookie.js');
		echo $this->Html->script('jquery-treeview/jquery.treeview.js');
		echo $this->Html->script('jquery-treeview/demo.js');
		echo $this->Html->script('general/tqc.js');		
		echo $this->Html->script('layouts/mijquery.js');
		if(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2)=='es'){
			echo $this->Html->script('jquery-validate/localization/messages_es.js');
		};
		echo $this->Html->script('general/forselenium.js');
		echo $this->Html->script('general/jquery.metadata.js');
		echo $this->Html->meta('icon');
		$css = array('screen', 'ie', 'layouts/tqc', 'layouts/jquery.treeview');
		echo $this->Html->css('print', 'stylesheet', array('media'=>"print"));
		echo $this->Html->css($css, 'stylesheet', array('media'=>array("","")));

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
		//echo $html->script('general/accionpermisoacl.js');
	?>
	<?php echo $this->Html->script('modulo_taller/taller.js'); ?>
	
	<?php echo ($this->Html->script('comun.js')); ?>
	<?php echo ($this->Html->css('comun')); ?>
	<?php echo ($this->Html->css('modulo_taller/derco/derco.css')); ?>
	
	
	<?php echo $scripts_for_layout; ?>	
	
	<!-- Url base para ajax -->
	<base href="<?php echo Router::url('/',true); ?>" permisorol="<?php echo empty($datosLogeo)?array():$datosLogeo['0']['Secrole']['name']; ?>" />
	
</head>

<body id="general">
	
<div id="contenedor" class="container">	
	<div id="cabeza" class="span-24">
		<h1> 
			 <?php
			 	if(!empty($logoEmpresa)){
					echo $this->Html->image( $logoEmpresa ,array('alt' => 'Logo de la empresa','width' =>'100%'));
			 	}
			 ?>    

		</h1>
	</div><!-- cabeza -->
	
	<div id="datosUsuario" class="span-24">
		<div id="logout" class="span-24" >
			<?php if(!empty($datosLogeo)): ?>
			
			<span class="organizacion">
				<?php						
					echo $this->Html->image('house.png', array('alt' => 'Organizacion', 'class'=>'top'));
					  echo $datosLogeo['0']['Secorganization']['name'];
				?>
			</span>&nbsp;
			<span class="proyecto">
				<?php echo $this->Html->image('proyecto.png', array('alt' => 'Proyecto', 'class'=>'top'));
					  echo $datosLogeo['0']['Secproject']['name']; ?>					
			</span>&nbsp;
			<span class="rol">
				<?php echo $this->Html->image('rol.gif', array('alt' => 'Funcion', 'class'=>'top'));
					  echo $datosLogeo['0']['Secrole']['name'];					
				?>					
			</span>&nbsp;
			<span class="usuario">
				<?php echo $this->Html->image('usuario.gif', array('alt' => 'Usuario', 'class'=>'top'));
					  echo $datosLogeo['0']['Secperson']['appaterno'].' '.$datosLogeo['0']['Secperson']['apmaterno'].', '.$datosLogeo['0']['Secperson']['firstname'];
				?>	
			</span>&nbsp;&nbsp;&nbsp;
			<?php endif; ?>
		
			<span class="login">			
				<?php 
						echo $this->Html->link($this->Html->image('salir.png',array('title'=>__('Out',true), "alt" => "salir")).__(' Logout',true),
						array('controller'=> 'Secassigns', 'action'=>'logout'), array('style' => 'text-decoration: none','escape'=>false),null); 
				?>	
			</span>&nbsp;
		</div>
	</div><!-- datosUsuario -->
	
	

	<div id="contenedorCuerpo" class="span-24 equalHeight">
		<div id="menu" class="span-5-1">
			<br/>
			<h3 class="tituloTable"><?php echo __('Menú');?></h3>
			<div id="menu-acos1" class="span-5-" >
				<?php if(!empty($menu)):?>				
					<?php foreach($menu as $item):?>
						<?php if(!empty($item['secprograms']['etiqueta'])): ?>
							<?php if(empty($item['secprograms']['solicitado'])): ?>
								<?php echo html_entity_decode($item['secprograms']['listaDesordenada']); echo html_entity_decode($item['secprograms']['etiqueta']); 
										//echo html_entity_decode($item['secprograms']['listaDesordenada']);?>
							<?php else: ?>	
								<?php echo html_entity_decode($item['secprograms']['listaDesordenada']); //echo $item['programas']['etiqueta'];
										//echo htmlentities($item['programas']['listaDesordenada']);
									  echo $this->Html->link(__($item['secprograms']['etiqueta'], true), '/'.$item['secprograms']['solicitado'] ); ?>
							<?php endif; ?>
						<?php else: ?>
							<?php echo html_entity_decode($item['secprograms']['listaDesordenada']); ?>
						<?php endif; ?>
					<?php endforeach; ?>			
				<?php endif; ?>
			</div><!-- fin de menuPrincipal -->	
		</div><!--== menu -->	
		
		<div id="contenido" class="span-19 last equalHeight">
			<?php echo $this->Session->flash();
					echo $this->Session->flash('auth');?>
			<?php echo $content_for_layout; ?>
		</div> <!-- contenido -->
	
	</div> <!-- contenedorCuerpo -->
	
	<!-- <div id="pie"  class="span-24">
		<p>
			<?php echo "copyright &copy; TQC Tecnolog&iacute;a Qu&iacute;mica y Comercio"; ?>
			<hr>
		</p>
	</div> 
	-->
	
</div> <!-- container -->
<?php //debug($_SESSION); ?>
	<?php //echo $cakeDebug; ?>
	<?php //echo $this->element('sql_dump'); ?>
	<?php echo $this->Js->writeBuffer(); // Write cached scripts ?>

</body>
</html>