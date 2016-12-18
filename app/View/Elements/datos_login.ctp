<?php 
if($this->Session->check('loginCliente')){ 
	$cliente = $this->Session->read('loginCliente');
?>
<div id="datosLoginCliente" style="float: right; margin-top: 60px;">
    <span id="botonSalirWeb" style="color: black;">
        <?php echo $this->Html->link(__('WEBSOLICITUD_ETIQUETA_SALIR'), 
			'/clientes/logoutCliente', array('escape'=>false), __('GENERAL_CONFIRMAR_SALIR')); ?>
        <?php echo $this->Xhtml->image('derco/defecto/salir.png', array('alt'=>'salir', 'width'=>'16')) ?>
    </span>
    <span id="botonSalirWeb" style="color: black;">
		<?php echo $cliente['Cliente']['nombres'];?>
        <?php echo $this->Xhtml->image('derco/defecto/usuario.png', array('alt'=>'usuario', 'width'=>'16')) ?>
    </span>
</div>
<?php } ?>