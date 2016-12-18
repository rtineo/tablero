<table border="0" cellpadding="0" cellspacing="0" class="web">
	<tr>
		<td class="menuBar" style="height: 467px;">
			<?php echo $this->element('menu_web_taller') ?>
		</td>
		<td>
			<div style="overflow-y: auto ;max-height: 480px; text-align:center;">
				<?php  foreach ($servicios as $servicio):?>
				<table style="width:100%">
					<thead>
						<tr>
							<td style="text-align:center">
								 <font size=5><b> <?php echo $servicio['Servicio']['titulo']; ?> </b></font>
							</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td  style="text-align:center">
								<?php echo  $this->Html->image("/img/Servicios/".$servicio['Servicio']['fileName'], array("alt" => "Servivios DERCO",  "width"=>'80%', 'height'=>'45%')); ?>	
							</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td style="text-align:center">
								<?php 	echo $servicio['Servicio']['description']; ?>
							</td>
						</tr>
					</tfoot>
				</table>
				<hr/>
				<?php endforeach; ?>
			</div>
 		</td>
	</tr>
</table>