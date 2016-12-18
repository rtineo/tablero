<div class="ui-widget">
	<div style="margin-top: 0px; padding: 0 .7em;" class="ui-state-error ui-corner-all">
		<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-alert"></span>
		<?php echo "{$content_for_layout}"; ?>
		<?php
			if($session->check("errors")){
				$errors = $session->read("errors");
				foreach($errors as $error){
					echo "<br/>$error";
				}
				$session->del("errors");
			}
		?>
		</p>
			
	</div>
</div>