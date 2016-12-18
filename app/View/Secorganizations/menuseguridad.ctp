<?php echo $this->Html->script('jquery-treeview/jquery.cookie.js'); ?>
<?php echo $this->Html->script('secorganizations/menuseguridad.js'); ?>
<?php echo $this->Html->script('general/tqc.js'); ?>
<?php
	echo $this->Html->script('ui/ui.core.js');
	echo $this->Html->script('ui/ui.tabs.js'); 
	
	echo $this->Html->meta('icon');
	$css = array('theme/ui.all');
	echo $this->Html->css($css, 'stylesheet', array('media'=>array('', '')));

	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
?>

<script type="text/javascript">
	$(function() {
		var tab_cookie_index = parseInt($.cookie("the_tab_cookie")) || 0;
		var tab_list = $('#tabs').get(0);
		var tab_actual = tab_list.getElementsByTagName('a')[tab_cookie_index];
		$(tab_actual).css('padding-top','2px');
		
		$("#tabs").tabs({ 
		    selected: tab_cookie_index, 
		    show:     function(event,ui) {
				var tab_id = ui.panel.id;
				var tab_link = $('#tabs a[href="#'+tab_id+'"]');
				tab_link.css('padding-top','5px');
				
			  	$(tab_actual).css('padding-top','5px');
		    	 var index = ui.index; 		       
		     	$.cookie("the_tab_cookie", index); 
		    },
			select: function(event, ui) {
				var tab_id = ui.panel.id;
				var tab_link = $('#tabs a[href="#'+tab_id+'"]');
				tab_link.css('padding-top','2px');										
		
			},			
			spinner: '<div style="float:left;padding-top:3px">Cargando</div><div style="float:left"><img src="'+$.url('/app/webroot/img/xloader.gif')+'" /></div>' 
		  });
		paginarSeguridad();
	});
</script>

<br/>
<div class="demo">	
<div id="tabs">
	<ul style="font-size:11px">
				 		 		 		 
		<li><a href="<?php echo $this->base ?>/Secorganizations/index"><span><?php echo __('empresas');?></span></a></li>
		<li><a href="<?php echo $this->base ?>/Secprojects/index"><span><?php echo __('sucursales');?></span></a></li>
		<li><a href="<?php echo $this->base ?>/Secroles/index"><span><?php echo __('roles');?></span></a></li>
		<li><a href="<?php echo $this->base ?>/Secpeople/index"><span><?php echo __('usuarios');?></span></a></li>		
		<li><a href="<?php echo $this->base ?>/Secassigns/index"><span><?php echo __('asignarRolesUsuarios');?></span></a></li>	
		<li><a href="<?php echo $this->base ?>/Secconfigurations/configuration"><span><?php echo __('configuracion');?></span></a></li>
	</ul>
</div><!-- End demo -->