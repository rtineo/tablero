<?php
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
<?php echo $content_for_layout; ?>
<style type="text/css">

</style> 