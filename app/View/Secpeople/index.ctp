	<?php echo $this->Html->script('secpeople/index.js'); ?>
	<input type="hidden" id="paginador" value="<?php echo $paginador; ?>" />
	<br/>
	<?php echo $this->Session->flash(); ?>
	<h3 id="tituloTable"><?php echo __('pesonaListar',true);?></h3>

<div class="box">
	<div id="agregar" class="span-5" >
	<?php echo $this->element('agregar'); ?>	
	</div>
	
	<div id="buscador" class="">
		<?php echo $this->element('buscador', array('elementos'=>$elementos,'url' => 'index')); ?>
	</div>
</div>	

<table cellpadding="0" cellspacing="0" class="table" >
	<thead>
		<tr>	
			<?php echo $this->Paginator->options(array('url' => 'buscador:'.isset($this->request->data['Buscar']['buscador']).'/valor:'.isset($this->request->data['Buscar']['valor'])).'/desactivo:'.isset($this->request->data['Buscar']['desactivo'])); ?>
			<th class="span-4" ><?php echo $this->Paginator->sort('Secperson.appaterno',__('apellidoNombre', true));?></th>
			<th><?php echo $this->Paginator->sort('Secperson.username',__('usuario', true));?></th>		
			<th><?php echo $this->Paginator->sort('Secperson.privelege',__('privilegio', true));?></th>
			<th><?php echo $this->Paginator->sort('Secperson.language',__('idioma', true));?></th>
			<th><?php echo $this->Paginator->sort('Secperson.email',__('email', true));?></th>
			<th><?php echo $this->Paginator->sort('Secperson.expirationdate',__('fechaCierre', true));?></th>
			<th><?php echo $this->Paginator->sort('Secperson.status',__('status', true));?></th>
			<th class="actions"><?php echo __('acciones',true);?></th>
		</tr>		
	</thead>
	
	<tbody>
		<?php //pr($secpeople[0]); 
				foreach ($secpeople as $secperson):?>
		<tr>		
		<td>
			<?php echo $secperson['Secperson']['appaterno'].' '.$secperson['Secperson']['apmaterno'].', ',$secperson['Secperson']['firstname']; ?>		
		</td>
		<td class="textc">
			<?php echo $secperson['Secperson']['username']; ?>
		</td>
		<td class="textc">
			<?php echo $secperson['Secperson']['privelege'] == 1 ? __('superUsuario', true):__('usuario', true); ?>
		</td>
		<td class="textc">
			<?php echo $secperson['Secperson']['language'] == 'spa' ?
							__('castellano', true)
						:
							$secperson['Secperson']['language'];
			; ?>
		</td>
		
		<td class="textc">
			<?php echo $secperson['Secperson']['email']; ?>
		</td>
		<td class="textc">
			<?php echo $secperson['Secperson']['expirationdate']; ?>
		</td>
		
		<td class="textc">
			<?php echo $secperson['Secperson']['status'] == 'AC' ? 
							__('Enable',true)
						:
							($secperson['Secperson']['status'] == 'DE'?
								__('Disable',true)
							:
								__('Limited',true))
						; ?>
		</td>
		
			<td class="actions" style="width: 100px">
				<?php echo $this->element('action', 
								array('id'=>$secperson['Secperson']['id'], 
										'name'=>$secperson['Secperson']['appaterno'],
										'estado'=>$secperson['Secperson']['status'])); 
					if($secperson['Secperson']['status'] == 'AC')
					{
						$url = $this->Html->url(array('action'=>'modificarpasswordusuario',$secperson['Secperson']['id']));
						$image = $this->Html->image('password.png', array('title'=>__('modificarContrasenia',true), "alt" => "Modifiacar Contraseña"));
						echo $this->Html->link($image, 'javascript:;',array('onclick' => "modificarpasswordusuario('".$url."')",'escape'=>false), null);
					}
					
				?>										
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
<div id ="paging" class="span-18">
		<?php echo $this->element('paginador'); ?>
</div>
<div class="clear"></div>