<?php
class Secarreglo extends AppModel{
	public $name = 'Secarreglo';
	
	function ubicacionLados(){
		$ladoUbicacion = array('I' => __('izquierda',true),'D' => __('derecha',true));
		return $ladoUbicacion;
	}
	
	function getLetrasColumnas(){
		$columnas = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
		return $columnas;
	}
	
	/** autor: aventura
	 * duenio: aventura
	 * descripcion: descripcion de cada uno de los estads de la orden de formulacion
	 * @return 
	 */
	function estadoOrdenFormulacion(){
		$estados = array(__('emitido', TRUE), __('entregandose', TRUE), __('enProceso', TRUE), __('aprobado', TRUE), __('liquidadoAlmacen', TRUE), __('desactivado', true));
		return $estados;
	}
	
	/** autor: aventura
	 * duenio: aventura
	 * descripcion: descripcion de cada uno de los estads de la orden de envasado
	 * @return 
	 */
	function estadoOrdenEnvasado(){
		//no modificar los estados
		$estados =  array(__('emitido', TRUE), __('entregandose', TRUE), __('paraEmvasar', TRUE), __('parcialmenteEntregado', TRUE), __('liquidadoAlmacen', TRUE), __('desactivado', true), __('enProceso', TRUE), __('totalmenteEntregado', TRUE));
		return $estados;
	}
	
	function tipoOrdenEnvasado(){
		$tipos = array('F'=>__('formulado', TRUE), 'R'=>__('reenvasado', TRUE), 'I'=>__('envasado', TRUE));
		return $tipos;
	}
	
	function estadoOrdenCompra(){
		$estados = array('0'=>__('colocado', TRUE), '1'=>__('parcialmenteEntregado', TRUE), '2'=>__('entregado', TRUE), '10'=>__('emitido', TRUE), '11'=>__('aprobado', TRUE), '12'=>__('anulado', TRUE));
		return $estados;
	}
	
	function meses(){
		$mes = array('1'=>__('enero', true), __('febrero', true), __('marzo', true), __('abril', true), __('mayo', true), __('junio', true), __('julio', true), 
						__('agosto', true), __('septiembre', true), __('octubre', true), __('noviembre', true), __('diciembre', true));
		return $mes;
	}
	
	function prioridades(){
		$prioridades = array('1'=>__('normal', true), __('alta', true), __('maxima', true));
		return $prioridades;
	}
} 
?>