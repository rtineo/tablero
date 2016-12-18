<?php
class CalendarioComponent extends Component {
	public $controller;
	
	/**
	 * Enlaza el componente al controlador.
	 *
	 * @param controller $controlador controlador
	 */

    	function initialize(Controller $controller) {
        $this->controller=&$controller;
    	}  
	
	/**
	 * Devuelve un arreglo de semanas y días correspondiente al año y mes indicados.
	 * El arreglo tiene la siguiente estructura:
	 calendario = array (
	 	'dias' = array (
			'0' => array (
				'nombre' => 'Domingo',
				'tipo' => 'feriado'
			),
			'1' => array (
				'nombre' => 'Lunes',
				'tipo' => 'normal'
			),
			//...
			'6' => array (
				'nombre' => 'Sabado',
				'tipo' => 'normal'
			)
		),
		'semanas' = array (
			'0' => array (
				'0' => array (
					'tipo' => 'vacio'
				),
				'1' => array (
					'tipo' => 'vacio'
				),
				'2' => array (
					'fecha' => array (
						'anio' => '2008',
						'mes' => '1',
						'dia' => '1'
					),
					'etiqueta' => '1',
					'tipo' => 'feriado'
				),
				'3' => array (
					'fecha' => array (
						'anio' => '2008',
						'mes' => '1',
						'dia' => '2'
					),
					'etiqueta' => '2',
					'tipo' => 'normal'
				),
				//...
			),
			'1' => array (
				'0' => array (
					'fecha' => array (
						'anio' => '2008',
						'mes' => '1',
						'dia' => '6'
					),
					'etiqueta' => '1',
					'tipo' => 'feriado'
				),
				'1' => array (
					'fecha' => array (
						'anio' => '2008',
						'mes' => '1',
						'dia' => '7'
					),
					'etiqueta' => '2',
					'tipo' => 'actual'
				),
				//...
			),
			//...
		)
	 )
	 * El tipo de la fecha puede ser:
	 * 'vacio': celda vacia
	 * 'normal': para los días de semana
	 * 'inactivo': no se genera enlace para esta fecha
	 * 'feriado': para días festivos, por default los domingos
	 * 'actual': para la fecha actual
	 * La semana comienza en Domingo y termina en Sábado.
	 *
	 * @param int $anio año
	 * @param int $mes mes
	 * @return array arreglo de semanas y días
	 */
	function obtenerCalendarioMes($anio=null, $mes=null) {
		$anio = $anio?$anio:date('Y'); // por default el año actual
		$mes = $mes?$mes:date('m'); // por default el mes actual
		
        $dia = 1;
        App::import('Vendor', 'datos');
		$datos=new Datos;
        $listaDias = $datos->getdatos('diasAbreviados');
        $listaMeses = $datos->getdatos('meses');

		$esteDia = getDate();
        $primerDia = getDate(mktime(0, 0, 0, $mes, 1, $anio));
        $ultimoDia = getDate(mktime(0, 0, 0, $mes+1, 0, $anio));
        
        $numPrimerDia = 1;
        $posicionPrimerDia = $primerDia['wday'];
        $numUltimoDia = $ultimoDia['mday'];
        $posicionUltimoDia = $ultimoDia['wday'];
        
        $numDiasSemana = sizeof($listaDias);
        $numSemanas = ceil(($posicionPrimerDia + $numUltimoDia)/$numDiasSemana);
        
		$tituloMes = $listaMeses[$mes-1].' '.$anio;
		
        $calendario['titulo'] = $tituloMes;
		$dias = array();
		foreach ($listaDias as $numeroDia=>$dia) {
			$dias[$numeroDia]['nombre'] = $dia;
			$dias[$numeroDia]['tipo'] = ($numeroDia==0)?'feriado':'normal';
		}
        $calendario['dias'] = $dias;
		
        $semanas = array();
        $contadorDia = 1;
        for ($semana=1; $semana<=$numSemanas; $semana++) {
            for ($diaSemana=0; $diaSemana<$numDiasSemana; $diaSemana++) {
                if (($semana==1 && $diaSemana<$posicionPrimerDia) ||
                    ($semana==$numSemanas && $diaSemana>$posicionUltimoDia)                
                ) {
                    $semanas[$semana][$diaSemana]['tipo'] = 'vacio';
                } else {
					$semanas[$semana][$diaSemana] = array(
						'fecha'=>array(
							'anio'=>$anio,
							'mes'=>$mes,
							'dia'=>$contadorDia,
						),
						'etiqueta'=>$contadorDia,
						'tipo'=>'normal'
					);
					if ($diaSemana==0) {
						$semanas[$semana][$diaSemana]['tipo'] = 'feriado';
					}
					if ($anio==$esteDia['year'] 
						&& $mes==$esteDia['mon'] 
						&& $contadorDia==$esteDia['mday']) {
						$semanas[$semana][$diaSemana]['tipo'] = 'actual';
					}
					$contadorDia++;
				}
            }
        }
		$calendario['semanas'] = $semanas;
		
		return $calendario;

	}
}
?>