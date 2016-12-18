<?php
class AvhtmlHelper extends Helper {
    /**
	 * autor: VENTURA RUEDA, JOSE ANTONIO
	 * @param object $date
	 * @return 
	 */
	function date_dmY($date, $formatSend='Ymd', $separator='-'){
		if(empty($date)) return '';
		$lastDate = substr($date, 10);
		$date = substr($date, 0,10);
		
		switch($formatSend){
			case 'Ymd': list($year, $mon, $day) = explode("$separator", $date);		break;
			case 'mdY': list($mon, $day, $year) = explode("$separator", $date);		break;
			case 'dmY': list($day, $mon, $year) = explode("$separator", $date);		break;		
		}	
		
		$date = mktime(0, 0, 0, $mon, $day, $year);
		return date('d/m/Y', $date)."$lastDate";
	}
	
	/**
	 * autor: VENTURA RUEDA, JOSE ANTONIO
	 * @param object $date
	 * @return 
	 */
	function addSeleccionar($options, $msg = 'seleccionar'){
		return empty($options)?array(''=>__($msg,true))
			:array(''=>__($msg,true)) + $options;
	}
	
}