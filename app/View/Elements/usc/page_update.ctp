<?php echo $html->script('usc/page_update.js'); ?>
<?php 
	$update = empty($update)?false:true;
	$close_current = empty($close_current)?false:true;
	$page = empty($page)?'parent':$page;
?>
<div id="page_update" update="<?php echo $update ?>" page="<?php echo $page ?>"></div>