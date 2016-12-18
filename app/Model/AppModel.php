<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Model', 'Model');
App::uses('CakeEmail', 'Network/Email');
/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
	var $stdBasic = array('AC'=>'Activo', 'DE'=>'desactivo', 'EL'=>'Eliminado');
	var $dateFormatDbPostgres = 'Y-m-d H:i:s';
	var $dateFormatView = 'd/m/Y';
	var $userWebSecpersonId = '162';
	
	/**
	 * AUTOR: VENTURA RUEDA, JOSE ANTONIO
	 * @param object $date
	 * @param object $formatSend [optional]
	 * @param object $separator [optional]
	 * @return 
	 */
	function getDateFormatDB($date, $formatSend='dmY', $separator='/', $now=0){
		if(!empty($now)) return date($this->dateFormatDbPostgres);
		if(empty($date)) return null;
		
		$hour = substr($date, 10);
		$date = substr($date, 0,10);
		
		switch($formatSend){
			case 'Ymd': list($year, $mon, $day) = explode("$separator", $date);		break;
			case 'mdY': list($mon, $day, $year) = explode("$separator", $date);		break;
			case 'dmY': list($day, $mon, $year) = explode("$separator", $date);		break;		
		}	
		
		$date = mktime(0, 0, 0, $mon, $day, $year);
				return sprintf("%s $hour", date(substr($this->dateFormatDbPostgres,0,5), $date));
	}
	
	/**
	 * AUTOR: VENTURA RUEDA, JOSE ANTONIO
	 * @param object $date
	 * @param object $formatSend [optional]
	 * @param object $separator [optional]
	 * @return 
	 */
	function getDateFormatView($date, $formatSend='Ymd', $separator='-'){
		if(empty($date) || $date == null) return "";
		$date = substr($date, 0,10);
		
		switch($formatSend){
			case 'Ymd': list($year, $mon, $day) = explode("$separator", $date);		break;
			case 'mdY': list($mon, $day, $year) = explode("$separator", $date);		break;
			case 'dmY': list($day, $mon, $year) = explode("$separator", $date);		break;		
		}	
		
		$date = mktime(0, 0, 0, $mon, $day, $year);
		return date(substr($this->dateFormatView,0,5), $date);
	}
	
	/**
	 * AUTOR: VENTURA RUEDA, JOSE ANTONIO
	 * @param object $date
	 * @param object $formatSend [optional]
	 * @param object $separator [optional]
	 * @return 
	 */
	function getDateFormatViewHours($date, $formatSend='Ymd', $separator='-'){
		if(empty($date) || $date == null) return "";
		$hour = substr($date, 10);
		$date = substr($date, 0,10);
		switch($formatSend){
			case 'Ymd': list($year, $mon, $day) = explode("$separator", $date);		break;
			case 'mdY': list($mon, $day, $year) = explode("$separator", $date);		break;
			case 'dmY': list($day, $mon, $year) = explode("$separator", $date);		break;		
		}	
		
		$date = mktime(0, 0, 0, $mon, $day, $year);
				return sprintf("%s $hour", date(substr($this->dateFormatView,0,5), $date));
	}
	
	function fecha_Mysql_Php($date){
		return $this->getDateFormatView($date);	
	}
	
	function fechaMayorQue($dFecIni, $dFecFin){
		$dFecIni = date('d-m-Y',strtotime($dFecIni));
		$dFecFin = date('d-m-Y',strtotime($dFecFin));
		
		$dFecIni = strtotime($dFecIni);
		$dFecFin = strtotime($dFecFin);
		
		if($dFecIni>=$dFecFin) return true;
		else return false;
	}
	
	/**
	 * FUNCION QUE NOS ARMA LA CONDICION DE BUSQUEDA
	 * @author VENTURA RUDA, JOSE ANTONIO
	 * @param object $fechaInicial [optional]
	 * @param object $fechaFinal [optional]
	 * @param object $field [optional]
	 * @return Array condiciones de busqueda
	 * @version 0.2 2012-02-29 13:12
	 */
	function _condicionFecha($fechaInicial = null, $fechaFinal = null, $field = null, $key='100') {
		if(empty($fechaInicial) && empty($fechaFinal)) return array();
		
		if(!empty($fechaInicial)) $fechaInicial = $this->getDateFormatDB($fechaInicial).' 00:00:00';
		if(!empty($fechaFinal)) $fechaFinal = $this->getDateFormatDB($fechaFinal).' 23:59:59';
		
		// armamos la condicion por fecha
		if(!empty($fechaInicial) || !empty($fechaFinal)) {
			if(!empty($fechaInicial) && !empty($fechaFinal)) $conditions = array($key=>"$field BETWEEN '$fechaInicial' AND '$fechaFinal'");
			else $conditions = !empty($fechaInicial) ? array($key=>"$field >= '$fechaInicial'") : array($key=>"$field <= '$fechaFinal'");
		}
		return empty($conditions) ? array() : $conditions;
	}
	
	/**AUTOR: VENTURA RUEDA, JOSE ANTONIO
	 * 
	 * @param object $date_a	fecha a comparar
	 * @param object $date_b	fecha a comparar
	 * @param object $changeDate [optional]  {true,false}  si se pone a formato de DB
	 * @return 
	 */
	function compareDate($date_a, $date_b, $compare= "=", $changeDate = true){
		if($changeDate){
			$date_a = $this->getDateFormatDB($date_a).substr($date_a, 11);
			$date_b = $this->getDateFormatDB($date_b).substr($date_b, 11);
		}
		$compare = $this->query("SELECT '$date_a' $compare '$date_b'  as compare");

		return $compare[0][0]['compare'];
	}
	
	/**
	 * retorna el numero de dia de la semana de una determinada fecha
	 * @param object $fecha
	 * @return int semana
	 * autor: Ronald Tineo
	 */
	function getNumOfDayOfWeek($fecha){
		$sql = "select extract(dow from to_timestamp('$fecha', 'YYYY-MM-DD')) as dow";
		$week = $this->query($sql);
		return $week[0][0]['dow'];
	}	
	/**
	 * retorna la semana de una determinada fecha
	 * @param object $fecha
	 * @return int semana
	 * autor: Ronald Tineo
	 */
	function getNumOfWeek($fecha){
		$sql = "select extract(week from to_timestamp('$fecha', 'YYYY-MM-DD')) as week";
		$week = $this->query($sql);
		return $week[0][0]['week'];
	}
	/**
	 * devuelve la suma de 2 inervalos de tiempo postgres
	 * @param object $inteval1
	 * @param object $interval2
	 * @return interval
	 * @autor Ronald Tineo
	 */
	function getSumIntervalTwoIntervals($inteval1,$interval2){
		$sql = "select (interval '$inteval1' + interval '$interval2') as interval";
		$interval = $this->query($sql);
		return $interval['0']['0']['interval'];
		
	}
	/**
	 * devuelve la diferencia de 2 inervalos de tiempo postgres
	 * @param object $inteval1
	 * @param object $interval2
	 * @return interval
	 * @autor Ronald Tineo
	 */
	function getDifIntervalTwoIntervals($inteval1,$interval2){
		$sql = "select (interval '$inteval1' - interval '$interval2') as interval";
		$interval = $this->query($sql);
		return $interval['0']['0']['interval'];
		
	}	
	/**
	 * Devuelve la cantidad de sabados y domingos entre dos fechas
	 * @param object $date1 [optional]
	 * @param object $date2 [optional]
	 * @param object $delimiter [optional]
	 * @return int cantidad de sabados y domingos
	 * @author Jorge G. Trujillo V.
	 * @version 0.1 2012-04-27 12:00
	 */
	function getCantSabDomBetweenTwoDates($date1 = null, $date2 = null, $delimiter = '/') {
		if(!$date1 || !$date2) {
			return false;
		}
		$cant_sab = 0;
		$cant_dom = 0;
		$date1 = str_replace($delimiter, '-', $date1);
		$date2 = str_replace($delimiter, '-', $date2);
		
		do {
			// se obtiene el dia de la semana
			$dow = $this->getDayOfWeekFromDate($date1);
			switch($dow) {
				case 6: // sabado
						$cant_sab++;
						break;
				case 0: // domingo
						$cant_dom++;
						break;
			}
			
			// se incrementa un dia a la fecha inicial
			$date1 = $this->addIntervalToTimestamp("1 day", $date1, 'DD-MM-YYYY');
		} while($date1 != $date2);
		
		return ($cant_sab + $cant_dom);
	}
	
	/**
	 * Devuelve el indice del dia de la semana
	 * @example array(
	 * 	0 => 'Domingo', 
	 * 	1 => 'Lunes', 
	 * 	2 => 'Martes', 
	 * 	3 => 'Miercoles', 
	 * 	4 => 'Jueves', 
	 * 	5 => 'Viernes', 
	 * 	6 => 'Sabado'
	 * )
	 * @param object $date [optional]
	 * @param object $delimiter [optional]
	 * @return 
	 */
	function getDayOfWeekFromDate($date = null, $delimiter = '/') {
		if(!$date) {
			return -1;
		}
		$date = str_replace($delimiter, '-', $date);
		
		$sql = "select extract(dow from '$date'::date) as dow";
		$dow = $this->query($sql);
		return $dow['0']['0']['dow'];
	}
	
	/**
	 * Devuelve el intervalo de tiempo entre dos fechas
	 * @param object $date1 [optional]
	 * @param object $date2 [optional]
	 * @param object $delimiter [optional]
	 * @return string intervalo diferencial
	 * @author Jorge G. Trujillo V.
	 * @version 0.1 2012-04-24 11:13
	 */
	function getIntervalBetweenTwoDates($date1 = null, $date2 = null, $delimiter = '/') {
		if(!$date1 || !$date2) {
			return false;
		}
		$date1 = str_replace($delimiter, '-', $date1);
		$date2 = str_replace($delimiter, '-', $date2);
		
		$sql = "select (to_timestamp('$date2', 'DD-MM-YYYY') - to_timestamp('$date1', 'DD-MM-YYYY')) as interval";
		$interval = $this->query($sql);
		return $interval['0']['0']['interval'];
	}
	
	/**
	 * Devuelve el resultado de agregar un intervalo de tiempo a una fecha y hora
	 * @param object $interval [optional]
	 * @param object $timestamp [optional]
	 * @return string nueva fecha y hora
	 * @author Jorge G. Trujillo V.
	 * @version 0.1 2012-04-23 17:59
	 */
	function addIntervalToTimestamp($interval = null, $timestamp = null, $timestamp_format = "YYYY-MM-DD HH24:MI:SS") {
		if(!$interval || !$timestamp) {
			return false;
		}
		
		$sql = "select to_char((TIMESTAMP '$timestamp' + INTERVAL '$interval'), '$timestamp_format') as new_timestamp";
		$new_timestamp = $this->query($sql);
		$new_timestamp = str_replace("/", "-", $new_timestamp['0']['0']['new_timestamp']);
		return $new_timestamp;
	}
	/**
	 * Devuelve el resultado de agregar un intervalo de tiempo a una fecha y hora
	 * @param object $interval [optional]
	 * @param object $timestamp [optional]
	 * @return string nueva fecha y hora
	 * @author Jorge G. Trujillo V.
	 * @version 0.1 2012-04-23 17:59
	 */
	
	function addIntervalToTimestampWithHour($interval = null, $timestamp = null,$timestamphour = null, $timestamp_format = "YYYY-MM-DD HH24:MI:SS") {
		if(!$interval || !$timestamp || !$timestamphour) {
			return false;
		}
		$timestampunico = date('Y-m-d',strtotime($timestamp)).' '.date('H:i:s',strtotime($timestamphour));
		
		$sql = "select to_char((TIMESTAMP '$timestampunico' + INTERVAL '$interval'), '$timestamp_format') as new_timestamp";
		$new_timestamp = $this->query($sql);
		$new_timestamp = str_replace("/", "-", $new_timestamp['0']['0']['new_timestamp']);
		return $new_timestamp;
	}	
	/***
	 * autor: abel
	 * descripcion: obtiene la fecha actual de la BD
	 * @param 
	 * @return 
	 */
	function fechaHoraActual($solaDate=false){
		$sql=	$solaDate?"SELECT CURDATE() as fecha":"SELECT now() as fecha";
		$fechaHoraActual = $this->query($sql);
		$fechaHoraActual = str_replace("/", "-", $fechaHoraActual['0']['0']['fecha']);
		return $fechaHoraActual;
	}

	/***
	 * autor:abel
	 * descripcion: convierte a numeros una cadena
	 * @param object $str cadena
	 * @return 
	 */	
	function convertirEnNumero($str){
	  $legalChars = "%[^0-9\-\. ]%";	
	  $str=preg_replace($legalChars,"",$str);
	  return $str;
	}
	
	function constantesUtilizar(){
		return array('Tqctipodocumento'=>array(	'tqcordenformulacion_id'=>26,
												'tqcordenenvasado_id'=>27,
												'tqcnotaingreso_id'=>19,
												'tqcvalesalida_id'=>2,
												'tqcguiaremision_id'=>24,
												'tqcguiaremisioncontrointerno_id'=>3,
												'tqcnotacredito_id'=>4,
												'tqcnotadebito_id'=>5,
												'tqcdevolucion_id' =>6,  //Solicitud nota credito
												'tqcfactura_id'=>13,
												'tqcconsignacion_id'=>1),
					'Tqctipo'=>array('tqcproductoterminado_id'=>1, 

									'tqctipogranel_id'=>9, 
									'tqctipoinsumo_id'=>2),
					'Tqctipoprocesamiento'=>array('tqcprocesamientoenvasado_id'=>2),
					'Tqctipodevolucion'=>array('tqcdocumentacion_id'=>1,
												'tqcdevolucion_id'=>2,
												'tqcsindespacho_id'=>3,
												'tqctransferencia_id'=>4,
												'tqcrefacturacion_id'=>5),
					'Tqcproveedor'=>array('tqc_codigo'=>'99999'),
					'Tqcmotivo'=>array('tqcguiatrasladoalmacen_id'=>24,		
									 	'tqcordenformulacion_id'=>12,
										'tqcordenenvasado_id'=>11,
										'tqcvalesalida_id'=>26,
										'tqcdevolucion_id'=>10,
										'tqcordencompra_id'=>1),
					'Tqcordenenvasado'=>array('tipo_reenvasado'=>'R', 'tipo_formulacion'=>'F', 'tipo_insumo'=>'I',
												'estado_emitido'=>0, 'estado_entregandose'=>1, 'estado_enProceso'=>6, 'estado_paraEnvasar'=>2, 
												'estado_parcialmenteEntregado'=>3, 'estado_totalEntregado'=>7, 'estado_liquidado'=>4, 'estado_desactivado'=>5),
					'Tqcordenformulacion'=>array('estado_aprobado'=>3),
					'Tqcguiaremision'=>array('estado_confirmado'=>6),
					'Tqcdevolucionmotivo'=>array('liquidaciondirecta_id'=>42),
					'Secrole'=>array('rolAuxAlm_code'=>"AALM")		// rol auxiliar almacenero AUXAL
					);
	}
	
	/**
	 * Devuelve el numero que se ingresa anteponiendo los ceros necesarios
	 * para completar su longitud
	 * @return varchar = numeroinicial + uno
	 * @param $numero Object = numeroinicial
	 * @param $logitudNumero Object = longitud del numero requerido
	 */
	function completarLongitud($numero = 0, $logitudNumero = 4){
		$numero = (int)$numero;
		$longitudNro = (int)strlen($numero);
		while(($logitudNumero-$longitudNro) > 0){
			$numero = '0'.$numero;
			++$longitudNro;
		}
		return $numero;	
	}
	
	/** Genera la visualizacion del error en las tablas basicas **/
	function visualizarError($error){
		if(empty($error)){	
			return 	array('respuesta'=>true, 'mensaje'=>"El registro a sido actualizado");}	
			foreach($error as $value){ 
				return array('respuesta'=>false, 'mensaje'=>$value);
			}
	}	
	
	/**
	 * Devuelve el id del aro al que pertenece el rol
	 * @return integer = id del aro
	 * @param $integer Object = rol del id
	 */
	function getAroId($rol_id){
		$sql = "SELECT *FROM aros WHERE model = 'Secrole' AND foreign_key = $rol_id ";
		$rs = $this->query($sql);
		$aro_id = !empty($rs)?$rs['0']['0']['id']:'';
		return $aro_id;
	}

	function getFechaDMY($fecha) {
		if($fecha == '0000-00-00' || $fecha == '1970-01-01' || $fecha == '0000-00-00 00:00:00' || $fecha == '1970-01-01 00:00:00'){
			return null;
		}
		$fecha = str_replace("/","-",$fecha);
		$fechaPhp = date('d-m-Y H:i:s', strtotime($fecha));
		$anio = date('Y',strtotime($fecha));
		$mes = date('m',strtotime($fecha));
		$dia = date('d',strtotime($fecha));
		return date('d/m/Y', mktime(0, 0, 0, $mes, $dia, $anio));
	}
	
	function configurarFechaDMY($fecha) {
		$fecha = str_replace("/","-",$fecha);
		$fechaPhp = date('d-m-Y H:i:s', strtotime($fecha));
		$anio = date('Y',strtotime($fecha));
		$mes = date('m',strtotime($fecha));
		$dia = date('d',strtotime($fecha));
		return date('d-m-Y', mktime(0, 0, 0, $mes, $dia, $anio));
	}
	
	function configurarFechaYMD($fecha) {
		$fecha = str_replace("/","-",$fecha);
		$anio = date('Y',strtotime($fecha));
		$mes = date('m',strtotime($fecha));
		$dia = date('d',strtotime($fecha));
		return date('Y-m-d', mktime(0, 0, 0, $mes, $dia, $anio));
	}
		
	function getFechaOneMoreDay($fecha) {
		$fecha = str_replace("/","-",$fecha);
		$anio = date('Y',strtotime($fecha));
		$mes = date('m',strtotime($fecha));
		$dia = date('d',strtotime($fecha));
		return date('Y-m-d', mktime(0, 0, 0, $mes, $dia+1, $anio));
	}
		
	function convertirHorasMinutosEnDecimal($fechaHora) {
		$fechaHora = str_replace("/","-",$fechaHora);
//		$horaMinutoDecimal = substr($fechaHora,11,2) + (substr($fechaHora,14,2)/60);
		$horaMinutoDecimal = date('H',strtotime($fechaHora)) + (date('i',strtotime($fechaHora))/60);
		return $horaMinutoDecimal;
	}
	

	function convertirMinutosEnDecimal($fechaHora) {
		$fechaHora = str_replace("/","-",$fechaHora);
		$minutoDecimal = date('i',strtotime($fechaHora))/60;
		return $minutoDecimal;
	}
	
	function convertirHorasEnDecimal($fechaHora) {
		$fechaHora = str_replace("/","-",$fechaHora);
		$horaDecimal = date('H',strtotime($fechaHora));
		return $horaDecimal;
	}
	
	function convertirDecimalEnHorasMinutos($decimal) {
		$hh = intval($decimal);
		$mm = round(($decimal - $hh) * 60);
		return date('H:i', mktime($hh, $mm));
	}
	
	function convertirHorasMinutosEnFormatoFecha($horaMinuto, $formato, $mes, $dia, $anio) {
		$horaMinutoDecimal = $this->convertirHorasMinutosEnDecimal($horaMinuto);
		$hh = intval($horaMinutoDecimal);
		$mm = ($horaMinutoDecimal - $hh) * 60;
		return date($formato, mktime($hh, $mm, 0, $mes, $dia, $anio));
	}
	
	function convertirDecimalEnFormatoFecha($decimal, $formato, $mes, $dia, $anio) {
		$hh = intval($decimal);
		$mm = ($decimal - $hh) * 60;
		return date($formato, mktime($hh, $mm, 0, $mes, $dia, $anio));
	}

	function sumarMinutosFecha($fecha,$minutos) {
		$fecha = str_replace("/","-",$fecha);
		$anio = date('Y',strtotime($fecha));
		$mes = date('m',strtotime($fecha));
		$dia = date('d',strtotime($fecha));
		$hora = date('H',strtotime($fecha));
		$minuto = date('i',strtotime($fecha));
		
		return mktime($hora, $minuto+$minutos, 0, $mes, $dia, $anio);
	}
	
	function configurarHoraHM($fecha) {
		$fecha = str_replace("/","-",$fecha);
		$hora = date('H',strtotime($fecha));
		$minuto = date('i',strtotime($fecha));
		return date('H:i', mktime($hora, $minuto));
	}
	
	function numeroHorasDeformatohms($hms){
		if (!empty($hms)){
			$hmstemp=$hms;
			$longitudtotal=strlen($hmstemp);
			$distanciasiguiente=stripos($hmstemp,':');
			$hora=substr($hmstemp,0,$distanciasiguiente);
			
			$hmstemp=substr($hmstemp,$distanciasiguiente+1,$longitudtotal);
			$distanciasiguiente=stripos($hmstemp,':');
			$minuto=substr($hmstemp,0,$distanciasiguiente);
			
			$longitudtotal=strlen($hmstemp);
			$segundo=substr($hmstemp,$distanciasiguiente+1,$longitudtotal);
	
			return ($hora+($minuto/60)+($segundo/3600));
		}else return 0;
	}
	
	function alphaNumeric($check) {
		$val='';
		if (is_array($check)) {
			$val=implode('',$check);
		}
		$check = $val;
		if (empty($check) && $check != '0') {
			return '';
		}
		$regex = '/^[a-z0-9]*$/i';
		
		if (preg_match($regex, $check)) {
			return true;
		} else {
			return 'Ingrese solo letras o números';
		}
	}
	
	/**
	 * #### USC - FUNCTION #############################################################
	 * @AUTOR: VENTURA RUEDA, JOSE ANTONIO
	 */
	
	/**NOS ARMA LA BUSQUEDA POR UN NUMERO DE DOCUMENTO
	 * @autor: VENTURA RUEDA, JOSE ANTONIO
	 * @param object $valor NUMERO DEL DOCUMENTO A BUSCAR
	 * @param object $field CAMPO (Model.field) formato cakephp
	 * @return 
	 */
	function _condicionDocumento($field, $valor){
		if(empty($valor)) return array();
		
		$vlr = explode('-', $valor);
		$cnt = count($vlr);
		if($cnt == 2){
			$serie = trim($vlr[0]);
			$nro = trim($vlr[1]);
			
			if(empty($serie)){
				return array('100'=>"$field ILIKE '%$nro%'");
			}else{
				return array('100'=>"(substring($field from 0 for position('-' in $field)) ilike '%$serie%' 
											and substring($field from position('-' in $field)+1) ilike '%$nro%')");
			}
		}
		
		return array('100'=>"$field ILIKE '%$valor%'");
	}
	
	/**GUARDA CUALQUIER DOCUMENTO EN LA CARPETA ESPECIFICADA
	 * @AUTOR: VENTURA RUEDA, JOSE ANTONIO
	 * @param object $dtFile = array([name] => [type] =>  [tmp_name] => [error] => 4 [size] => 0)
	 * @param object $dtLog = array()
	 * @param object $folderFile [optional] =  "FOLDER EN EL CUAL SE GUARDARA LA IMAGEN"
	 * @param object $tpFile [optional]
	 * @param object $dtAud [optional]
	 * @return 
	 */
	function setFileInFolder($dtFile,$dtLog, $folderFile = 'uscusecase', $tpFile=null, $dtAud = null){
		if(empty($tpFile)) $tpFile = array('jpeg','png','pdf','doc','msword','application/zip','text/plain');
		
		//VERIFICAMOS EL ENVIO DEL ID PADRE AL CUAL PERTENECE EL ARCHIVO
		if(empty($dtFile['id'])) return array(false, 'EL ARCHIVO NO TIENE ID PADRE');
		
		//VERIFICAMOS LA EXISTENCIA DE LA CARPETA
		if(!file_exists(WWW_ROOT.$folderFile)) return array(false, sprintf('EL DIRECTORIO "%s" PARA EL ARCHIVO NO EXISTE',$folderFile));
		
		//VERIFICAMOS QUE EL ARCHIVO ENVIADO NO TENGA ERRORES
		if(!empty($dtFile['error'])) return array(true, sprintf('EL ARCHIVO %s TIENE ERRORES',$dtFile['name']));
		//return array(false, sprintf('EL ARCHIVO %s TIENE ERRORES',$dtFile['name']));
		
		//VERICAMOS EL TIPO DE ARCHIVO ENVIADO
		$tpFileAccept = false;
		foreach($tpFile as $tpF){
			if(strpos($dtFile['type'], $tpF) || $dtFile['type'] == $tpF){
				$tpFileAccept = $tpF;
				break;
			}
		}
		if(empty($tpFileAccept)) return array(false, sprintf('ARCHIVO "%s", TIPO "%s" NO SOPORTADO', $dtFile['name'], $dtFile['type']));
		
		$extend = explode('.', $dtFile['name']);
		$extend_length = count($extend);
		
		$nameFileStore = sprintf($folderFile."_%s.%s",$dtFile['id'],$extend[$extend_length-1]);
		
		//GUARDAMOS EL ARCHIVO EN LA CARPETA DEL SERVIDOR
		if(!move_uploaded_file($dtFile['tmp_name'], WWW_ROOT.$folderFile.DS.$nameFileStore))
		return array(false, 'EL ARCHIVO NO PUDO SER GUARDADO EN EL SERVIDOR');
			
		return array(true, 'EL ARCHIVO FUE GUARDADO EN EL SERVIDOR', 'namefilestore'=>$nameFileStore);
	}
	
	function setFile($directorio, $file){
		if(!file_exists(DS.'var'.DS.'www'.DS.'html'.DS.$directorio)) return false;
		
		if(!move_uploaded_file($file['tmp_name'], DS.'var'.DS.'www'.DS.'html'.DS.$directorio.DS.$file['name']))  return false;
				
		return true;
	}
	
	function copyFile($directorio="solicitud", $old_file, $new_file){
		if(!file_exists(DS.'var'.DS.'www'.DS.'html'.DS.$directorio.DS.$old_file)) return true;  // si no existe el archivo no se realiza ninguna action
		
		if(!copy(DS.'var'.DS.'www'.DS.'html'.DS.$directorio.DS.$old_file, DS.'var'.DS.'www'.DS.'html'.DS.$directorio.DS.$new_file))  return false;
				
		return true;
	}
	
	/**COPIA UN ARCHIVO DE EN EL MISMO DIRECTORIO, CON DISTINTO NOMBRE
	 * @AUTOR: VENTURA RUEDA, JOSE ANTONIO
	 * @param object $dtFile array('name'=>{NOMBRE DEL ARCHIVO A COPIAR}, 'id'=>'ID CON EL CUAL SE FORMARA EL NUEVO NOMBRE'
	 * @param object $folderFile [optional]
	 * @return 
	 */
	function setCopyFile($dtFile, $folderFile = 'uscsteps'){
		$nameFileBase = $dtFile['name'];
		
		//VERIFICAMOS LA EXISTENCIA DE LA CARPETA
		if(!file_exists(WWW_ROOT.$folderFile)) return array(false, sprintf('EL DIRECTORIO "%s" PARA EL ARCHIVO NO EXISTE',$folderFile));
		
		$extend = explode('.', $dtFile['name']);
		$extend_length = count($extend);
		
		$nameFileStore = sprintf($folderFile."_%s.%s",$dtFile['id'],$extend[$extend_length-1]);
		
		//VERIFICAMOS LA EXISTENCIA DEL ARCHIVO BASE)
		if (!file_exists(WWW_ROOT.$folderFile.DS.$nameFileBase)) return array(false, sprintf('EL ARCHIVO "%s", NO EXISTE',$nameFileBase));
			
		//COPIAMOS EL ARCHIVO EN LA CARPETA DEL SERVIDOR
		if(!copy(WWW_ROOT.$folderFile.DS.$nameFileBase, WWW_ROOT.$folderFile.DS.$nameFileStore))
		return array(false, 'EL ARCHIVO NO SE PUDO COPIAR');
		
		return array(true, 'EL ARCHIVO FUE GUARDADO EN EL SERVIDOR', 'namefilestore'=>$nameFileStore);
	}
	
	/**
	 * Retorna la cantidad de dias entre 2 fechas
	 * @param object $fechamayo
	 * @param object $fechamenos
	 * @return int cantidad de dias
	 * @autor Ronald Tineo S.
	 */
	function getCantDayTwoDates($fechamayor,$fechamenor){
		$fechamayor = date('Y-m-d',strtotime($fechamayor));
		$fechamenor = date('Y-m-d',strtotime($fechamenor));
		$sql ="select extract(day from (to_timestamp('$fechamayor', 'YYYY-MM-DD') - to_timestamp('$fechamenor', 'YYYY-MM-DD'))) as day;";
		$result = $this->query($sql);
		return (!empty($result) && isset($result))?$result[0][0]['day']:false;
	}
	
	/** CORRER UNA CONSULTA
	 * @AUTOR: VENTURA RUEDA, JOSE ANTONIO
	 * @param object $consulta
	 * @return 
	 */
	function setScript($consulta){
		@$this->query("$consulta");
		$error = pg_last_error();
		return empty($error)?true:false;
	}
	
	/**TRANSFORMA UN OBJETO A UN ARRAY
	 * @AUTOR: VENTURA RUEDA, JOSE ANTONIO
	 * @param object $object
	 * @return 
	 */
	function TransfObjectToArray($object){	
		if(is_array($object) || is_object($object)){
			$result = array(); 
			foreach ($object as $key => $value){ 
				$result[$key] = $this->TransfObjectToArray($value); 
			}
			return $result;
		}
		return $object;
	}

/**
 * FUNCIONES PROPIAS DE WEBSERVICES
 * */
 	//format YYYYMMDD in un string
	function validateDateWebService($fecha){ 
		$year = substr($fecha, 0,4);
		$mes = substr($fecha, 4,2);
		$day = substr($fecha, 6,2);
		//return $anio.'-'.$mes.'-'.$dia;
		return checkdate((int)$mes,(int)$day,(int)$year);
	}
	
	//format HHMMSS in un String
	function validateTimeWebService($time){ 
		return preg_match('/^(2[0-3]|[0-1]?[0-9]):([0-5]?[0-9]):([0-5]?[0-9])$/', $time);
		//return $anio.'-'.$mes.'-'.$dia;

	}
	
	function isNotEmpty($string){
		if(!empty($string) && isset($string))return true;
		else return false; 
	}
	
	function getDateFromStringWebservice($string){
		/*$year = substr($string, 0,4);
		$month = substr($string, 4,2);
		$day = substr($string, 6,2);*/
		return $this->configurarFechaYMDWebservice($string.' 00:00:00');
	}

	function getTimeFromStringWebservice($string){
		/*$hora = substr($string, 0,2);
		$minuto = substr($string, 2,2);
		$segundo = substr($string, 4,2);*/
		return $this->configurarHoraHMSWebService($string);
	}
	
	function configurarFechaYMDWebservice($fecha) {
		$anio = date('Y',strtotime($fecha));
		$mes = date('m',strtotime($fecha));
		$dia = date('d',strtotime($fecha));
		return date('Y-m-d', mktime(0, 0, 0, $mes, $dia, $anio));
	}
	
	function configurarHoraHMSWebService($fecha) {
		$hora = date('H',strtotime($fecha));
		$minuto = date('i',strtotime($fecha));
		$segundo = date('s',strtotime($fecha));
		return date('H:i:s', mktime($hora, $minuto,$segundo));
	}
	
	/**
     * Returns true si envia el email o false n caso contrario
     * 
     * @param [mixed] $string direccion email destino
     * @param [mixed] $string asunto del email
     * @param [mixed] $string mensaje / contenido del email
     */
	function enviarEmail($correo, $asunto, $mensaje) {
		return true;
		$from = 'SoporteWeb@dercoperu.net';
		//$from = 'Derco';
		$headers = 'From: '.$from."\n".
					'Reply-To: '.$from."\n".
					'X-Mailer: PHP/'.phpversion()."\n".
					'Message-Id: '."\n".
					'Date:'.'\n'; 
		$headers .= 'MIME-Version: 1.0'."\n";
		$headers .= 'Content-type: text/html; charset=utf-8'."\r\n";
            
		$headersfrom = '-f'.$from;					
		//return 1 ? true : false;
	    return mail($correo, $asunto, $mensaje, $headers,$headersfrom) ? true : false;
	}
	
	function fecha_Php_Mysql($fecha){
		if(empty($fecha)) return null;
		$fecha = date('Y-m-d',strtotime($fecha));
		// if($fecha == '1969-12-31') return '0000-00-00';
		return $fecha;
	}
	
	/**
	 * 
	 * @param object $string
	 * @param object $prefix to search
	 * @return 
	 */
	function starts_with($s, $prefix){
		// returns a bool
		return strpos($s, $prefix) === 0;
	}

	/**MIGRADO POR: VENTURA RUEDA, JOSE ANTONIO
	 * FECHA: 2013-05-21
	 * @param object $fechaInicial
	 * @param object $fechaFin
	 * @return 
	 */
	function getDiferenciaDeFechasEnMinutos($fechaInicial,$fechaFin){
		$meses = array(1=>31,2);
		$fechaInicial = strtotime(str_replace('/','-',$fechaInicial));
		$fechaFin = strtotime(str_replace('/','-',$fechaFin));
		if($fechaFin < $fechaInicial) return false;
		$diferencia = $fechaFin - $fechaInicial;
		$horas = intval($diferencia/3600);
		$minutos = intval((intval($diferencia)%3600)/60);
		$return='-';
		if($diferencia>0){
			$dias = ($horas >= 24)?intval($horas/24):0;
			if($dias > 0){
				if($dias>1) $dias=$dias.' días';
				else $dias = $dias.' día';
			}else $dias = '';
			
			$horas = $horas - $dias*24;

			$horas = sprintf("%02d",$horas);
			$minutos = sprintf("%02d",$minutos);
			$return = $dias.' '.$horas.':'.$minutos;
			 
		}elseif($diferencia==0){
			$return = '00:00';
		}

		return $return;
	}
	
	
	/**
     * Devuelve true si la longitud de la cadena es mayor a cero 
     */
	function hasText($text){
		if(strlen(trim($text))>0) return true;
		return false;
	}
	
	/**
	 * 
	 * @param object $date fecha de la que se quiere calcular su ultimo dia
	 * @return Entero con ultimo dia del mes
	 */
	function getLastDateOfMonth($date){
		$month = date('m',strtotime($date));
		$year = date('Y',strtotime($date));
		return date("d-m-Y",(mktime(0,0,0,$month+1,1,$year)-1));
	}
	
	/**Import a new model
	 * 
	 * @param object $modelName
	 * @return 
	 */
	function ImportModel($modelName){
		app::import('Model', "$modelName"); 		$this->{$modelName} = new $modelName;
	}
	
	/**
	 * 
	 * @param object $to: email from client
	 * @param object $data: data from citas and client
	 * @return only send email 
	 */
	function enviarCorreoCitas($to,$agedetallecitas){
		$Email = new CakeEmail();
		$Email->template('email_citas','default');
    	$Email->emailFormat('html');
		$Email->from(array('soporteweb@dercoperu.net' => 'Citas Derco'));
		$Email->to($to);
		$Email->subject('Cita Confirmada para: '.$agedetallecitas['Agedetallecita']['fechadecita']);
		$Email->viewVars(array('numero' => $agedetallecitas['Agedetallecita']['otsap'],
								'nombres' => $agedetallecitas['Cliente']['nombres'],
								'local'=>$agedetallecitas['Secproject']['name'],
								'fechaRegistro'=>$agedetallecitas['Agedetallecita']['fechadecita'],
								'marca'=>$agedetallecitas['Agedetallecita']['marca'],
								'placa'=>$agedetallecitas['Agedetallecita']['placa']));
		$Email->send();
	}
}
