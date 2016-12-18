<div class="menuItems">
	<table id="menuItems" border="0"cellpadding="0" cellspacing="0" class="menuItems">
		<tbody>
			<tr>
				<td class="titulo">Taller de Servicios</td>
				<td class="titulo" width="18px">&nbsp;</td>
			</tr>
			<tr>
				<td class="menuItem"> 
					<?php 
							echo $this->Html->link(__('Solicitar Cita',true),array('controller' => 'clientes', 'action' => 'tallerIndex', 'full_base' => false));
					?>	
				</td>
				<td class="marcador">
					<?php
					if(isset($tallerIndex)) echo $this->Html->image('webClientes/guion.jpg', array('alt' => 'Logo de la empresa'));
					?>
				</td>
			</tr>
			<tr>
				<td class="menuItem">
					<?php 
						echo $this->Html->link(__('Historial de Citas ',true),array('controller' => 'clientes', 'action' => 'historialCitas', 'full_base' => false));
					?>
				</td>
				<td class="marcador">
					<?php
					if(isset($historialCitas)) echo $this->Html->image('webClientes/guion.jpg', array('alt' => 'Logo de la empresa'));
					?>
				</td>
			</tr>
			<tr>
				<td class="menuItem">
					<?php 
						echo $this->Html->link(__('Reprogramar y/o eliminar Citas ',true),array('controller' => 'clientes', 'action' => 'bandejaReprogramar', 'full_base' => false));
					?>
					
				</td>
				<td class="marcador">
					<?php
					if(isset($bandejaReprogramar)) echo $this->Html->image('webClientes/guion.jpg', array('alt' => 'Logo de la empresa'));
					?>
				</td>
			</tr>
			<tr>
				<td class="menuItem" colspan="2"><br/></td>
			</tr>
			<tr>
				<td class="titulo">Configuraci&oacute;n</td>
				<td class="titulo" width="18px">&nbsp;</td>								
			</tr>
			<tr>
				<td class="menuItem">
					<?php 
						echo $this->Html->link(__('Ver Datos Personales ',true),array('controller' => 'clientes', 'action' => 'mostrarCliente', 'full_base' => false));
					?>
				</td>
				<td class="marcador">
					<?php
					if(isset($mostrarCliente)) echo $this->Html->image('webClientes/guion.jpg', array('alt' => 'Logo de la empresa'));
					?>
				</td>
			</tr>
			<tr>
				<td class="menuItem" colspan="2"><br/></td>
			</tr>
			<tr>
				<td class="titulo">Conoce nuestros Servicios</td>
				<td class="titulo" width="18px">&nbsp;</td>								
			</tr>						
			<tr>
				<td class="menuItem">
					<?php 
						echo $this->Html->link(__('Servicios',true), array('controller' => 'servicios', 'action' => 'view', 'full_base' => false));
					?>
					
				</td>
				<td class="marcador">
				</td>
			</tr>
			<tr>
				<td class="menuItem" colspan="2"><br/></td>
			</tr>
			<tr>
				<td class="titulo">Promociones/Campañas</td>
				<td class="titulo" width="18px">&nbsp;</td>								
			</tr>						
			<tr>
				<td class="menuItem">
					<?php 
						echo $this->Html->link(__('Promociones/Campañas',true), array('controller' => 'campanias', 'action' => 'view', 'full_base' => false));
					?>
					
				</td>
				<td class="marcador">
				</td>
			</tr>
			<tr>
				<td class="menuItem" colspan="2"><br/></td>
			</tr>
			<tr>
				<td class="titulo">Ayuda</td>
				<td class="titulo" width="18px">&nbsp;</td>								
			</tr>
			
			<?php if(!empty($ayudas_menu)): 
				foreach($ayudas_menu as $ayuda_menu):
			?>
				<tr>
					<td class="menuItem">
						<?php 
							echo $this->Html->link($ayuda_menu['Ayuda']['titulo'], array('controller' => 'ayudas', 'action' => 'view', $ayuda_menu['Ayuda']['id']));	
						?>
					</td>
					<td class="marcador">
						<?php
							$url = $this->Html->url(array('controller' => 'ayudas', 'action' => 'view', $ayuda_menu['Ayuda']['id']));
							if(strpos($url, $this->request->url)){ 
								echo $this->Html->image('webClientes/guion.jpg', array('alt' => 'Logo de la empresa'));
							}
						?>
					</td>
				</tr>
			<?php  endforeach;
				endif; ?>
		</tbody>
	</table>
</div>
<!--
<script type="text/javascript">
	function enConstruccion() {
		alert('En Construccion...');
	}
	function registroCliente() {
		var url = "<?php echo $this->Html->url('/files/InstructivoRegistroWeb.pdf'); ?>";
   		var w = window.open(url, 'registrarcliente','scrollbars=no,resizable=yes,top=200,left=250,status=yes,location=no,toolbar=no,menubar=no');
	}
	function citasTaller() {
		var url = "<?php echo $this->Html->url('/files/InstructivoGeneracionCitasWeb.pdf'); ?>";
   		var w = window.open(url, 'registrarcliente','scrollbars=no,resizable=yes,top=200,left=250,status=yes,location=no,toolbar=no,menubar=no');
	}		
</script>
-->