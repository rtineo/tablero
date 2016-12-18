<?php
class XhtmlHelper extends AppHelper {
    var $helpers = array('Html', 'Pagination','Javascript');

	/**
     * Devuelve la cadena html de la imagen especificada como enlace y además el texto.
     */
    function imageTextLink($nombreImagen, $titulo, $url, $atributos=null, $confirmacion=null, $atributosImgExtra=null) {
		$atributosImgBase = array('border'=>'0', 'title'=>$titulo);
		$atributosImgExtra = $atributosImgExtra?$atributosImgExtra:array();
		$atributosImg = array_merge($atributosImgBase, $atributosImgExtra);
        
		$image = $this->Html->image($nombreImagen, $atributosImg);
		 echo $this->Html->link($image.$titulo, $url, $atributos, $confirmacion, false);
    }
	
	function textImageLink($nombreImagen, $titulo, $url, $atributos=null, $confirmacion=null, $atributosImgExtra=null) {
		$atributosImgBase = array('border'=>'0', 'title'=>$titulo);
		$atributosImgExtra = $atributosImgExtra?$atributosImgExtra:array();
		$atributosImg = array_merge($atributosImgBase, $atributosImgExtra);
        
		$image = $this->Html->image($nombreImagen, $atributosImg);
		 echo $this->Html->link($titulo.$image, $url, $atributos, $confirmacion, false);
    }
	
	 /**
     * Devuelve la cadena html de la imagen y el texto
     */
    function textImage($nombreImagen, $titulo, $atributosExtra=null) {
		$atributosBase = array('border'=>'0', 'title'=>$titulo);
		$atributosExtra = $atributosExtra?$atributosExtra:array();
		$atributos = array_merge($atributosBase, $atributosExtra);
        $icono = $this->Html->image($nombreImagen, $atributos);
        $enlace = $titulo.'&nbsp;'.$icono;
        return $enlace;
    }
	
	/**
     * Devuelve la cadena html de la imagen especificada como enlace.
     */
    function imageLink($nombreImagen, $titulo, $url, $atributos=null, $confirmacion=null, $atributosImgExtra=null) {
		$atributosImgBase = array('border'=>'0', 'title'=>$titulo);
		$atributosImgExtra = $atributosImgExtra?$atributosImgExtra:array();
		$atributosImg = array_merge($atributosImgBase, $atributosImgExtra);
        $icono = $this->Html->image($nombreImagen, $atributosImg);
        $enlace = $this->Html->link($icono, $url, array_merge($atributos, array('escape'=>false)), $confirmacion, false);
        return $enlace;
    }
	
	function thisData($modelField){
		list($model, $field) = explode('.', $modelField);
		return $this->data[$model][$field];
	}
	
	/**
     * Devuelve el url de la imagen requerida considerando el tema y el subsistema establecido.
     * El url es de la forma requerida por cake.
     * 
     * @param string $nombreImagen nombre de archivo de imagen
     * @return string url requerida
     */
    function imgUrl($nombreImagen, $subsistema=null) {
        if ($subsistema==null) {
            $subsistema = $this->view->controller->subsistema;
        }
        $temaDefecto = 'defecto';
        $tema = $this->view->controller->tema;
        $archivo = WWW_ROOT.'img/'.$subsistema.DS.$tema.DS.$nombreImagen;
        if (!file_exists($archivo)) {
            $tema = $temaDefecto;
        }
        $url = $subsistema.'/'.$tema.'/'.$nombreImagen;
        return $url;
    }
	
	/**
     * Devuelve la cadena html de la imagen especificada.
     */
    function image($rutaImg, $atributos=null) {
        $imagen = $this->Html->image($rutaImg, $atributos);
        return $imagen;
    }
	
	function getStatus($stdKey){
		$status = array(
			'AC'=>__('Programado'),
			'DE'=>__('Desactivo'),
			'EL'=>__('Eliminado'),
			'RE'=>__('Reprogramado'),
			'PR'=>__('Programado')
		);
		return $status[$stdKey];
	}
	
	/**
	 * autor: VENTURA RUEDA, JOSE ANTONIO
	 * @param object $date
	 * @return 
	 */
	function date_dmY($date, $formatSend='Ymd', $separator='-', $withTime = false){
		$hora = substr($date, 10);
		$date = substr($date, 0,10);
		
		switch($formatSend){
			case 'Ymd': list($year, $mon, $day) = explode("$separator", $date);		break;
			case 'mdY': list($mon, $day, $year) = explode("$separator", $date);		break;
			case 'dmY': list($day, $mon, $year) = explode("$separator", $date);		break;		
		}	
		
		$date = mktime(0, 0, 0, $mon, $day, $year);
		$hora = empty($withTime)?"":$hora;
		return date('d/m/Y', $date).$hora;
	}
	
	/**
     * Devuelve la cadena html que enlaza a la hoja de estilos especificada.
     *
     * @param string $nombreCss nombre del css, pero sin incluir la extensión
     * @param string $subsistema nombre del subsistema
     * @return string cadena html que enlaza a la hoja de estilos especificada
     */
    function css($nombreCss, $subsistema=null) {
        $css = $this->Html->css($nombreCss);
        return $css;
    }
}