<?php
class DatosComponent extends Component{
	
	function _getDato($dt){
		return $this->lista[$dt];
	}
	
	var $lista = array (
			'combustibles' => array(
				'G' => 'Gasolina'
			),
		    'distritos' => array(
		        'ancon' => 'Ancon',
		        'ate' => 'Ate',
		        'barranco' => 'Barranco',
		        'bellavista' => 'Bellavista',
		        'brenia' => 'BreÃ±a',
		        'carabayllo' => 'Carabayllo',
		        'cercado_callao' => 'Cercado Callao',
		        'cercado_de_lima' => 'Cercado de Lima',
		        'carmen_de_la_legua' => 'Carmen de la Legua',
		        'chorrillos' => 'Chorrillos',
		        'cieneguilla' => 'Cieneguilla',
		        'comas' => 'Comas',
		        'el_agustino' => 'El Agustino',
		        'independencia' => 'Independencia',
		        'jesus_maria' => 'Jesus MarÃ­a',
		        'la_molina' => 'La Molina',
		        'la_perla' => 'La Perla',
		        'la_punta' => 'La Punta',
		        'la_victoria' => 'La Victoria',
		        'lince' => 'Lince',
		        'los_olivos' => 'Los Olivos',
		        'lurigancho' => 'Lurigancho',
		        'lurin' => 'Lurin',
		        'magdalena_del_mar' => 'Magdalena del Mar',
		        'miraflores' => 'Miraflores',
		        'pachacamac' => 'Pachacamac',
		        'pucusana' => 'Pucusana',
		        'pueblo_libre' => 'Pueblo Libre',
		        'puente_piedra' => 'Puente Piedra',
		        'punta_hermosa' => 'Punta Hermosa',
		        'punta_negra' => 'Punta Negra',
		        'rimac' => 'Rimac',
		        'san_bartolo' => 'San Bartolo',
		        'san_borja' => 'San Borja',
		        'san_isidro' => 'San Isidro',
		        'san_juan_de_lurigancho' => 'San Juan de Lurigancho',
		        'san_juan_de_miraflores' => 'San Juan de Miraflores',
		        'san_luis' => 'San Luis',
		        'san_martin_de_porres' => 'San Martin de Porres',
		        'san_miguel' => 'San Miguel',
		        'santa_anita' => 'Santa Anita',
		        'santa_maria_del_mar' => 'Santa Maria del Mar',
		        'santa_rosa' => 'Santa Rosa',
		        'santiago_de_surco' => 'Santiago de Surco',
		        'surquillo' => 'Surquillo',
		        'ventanilla' => 'Ventanilla',
		        'villa_el_savador' => 'Villa El Salvador',
		        'villa_maria_del_triunfo' => 'Villa Maria del Triunfo'
		    ),
			'colores' => array (
				'azul' => 'Azul',
				'rojo' => 'Rojo',
				'verde' => 'Verde'    
		    ),
			'meses' => array (
				'0'=>'Enero', 
				'1'=>'Febrero', 
				'2'=>'Marzo', 
				'3'=>'Abril',
				'4'=>'Mayo', 
				'5'=>'Junio', 
				'6'=>'Julio', 
				'7'=>'Agosto',
				'8'=>'Septiembre', 
				'9'=>'Octubre', 
				'10'=>'Noviembre', 
				'11'=>'Diciembre'
			),
			'mesesConcesionario' => array (
				'01'=>'Enero', 
				'02'=>'Febrero', 
				'03'=>'Marzo', 
				'04'=>'Abril',
				'05'=>'Mayo', 
				'06'=>'Junio', 
				'07'=>'Julio', 
				'08'=>'Agosto',
				'09'=>'Septiembre', 
				'10'=>'Octubre', 
				'11'=>'Noviembre', 
				'12'=>'Diciembre'
			),
			'mesesAbreviados' => array (
				'0'=>'ENE', 
				'1'=>'FEB', 
				'2'=>'MAR', 
				'3'=>'ABR',
				'4'=>'MAY', 
				'5'=>'JUN', 
				'6'=>'JUL', 
				'7'=>'AGO',
				'8'=>'SEP', 
				'9'=>'OCT', 
				'10'=>'NOV', 
				'11'=>'DIC'
			),
			'mesesNumericos' => array (
				1=>'Enero', 
				2=>'Febrero', 
				3=>'Marzo', 
				4=>'Abril', 
				5=>'Mayo', 
				6=>'Junio',  
				7=>'Julio',  
				8=>'Agosto',
				9=>'Septiembre', 
				10=>'Octubre', 
				11=>'Noviembre', 
				12=>'Diciembre'
			),	
			'dias' => array (
				'0'=>'Domingo', 
				'1'=>'Lunes', 
				'2'=>'Martes', 
				'3'=>'Miercoles',
				'4'=>'Jueves', 
				'5'=>'Viernes', 
				'6'=>'Sabado'
			),
			'diasAbreviados' => array (
				'0'=>'DOM', 
				'1'=>'LUN', 
				'2'=>'MAR', 
				'3'=>'MIE',
				'4'=>'JUE', 
				'5'=>'VIE', 
				'6'=>'SAB'
			),
			'anios' => array (
				'2010'=>'2010', 
				'2011'=>'2011', 
				'2012'=>'2012', 
				'2013'=>'2013', 
				'2014'=>'2014', 
				'2015'=>'2015', 
				'2016'=>'2016', 
				'2017'=>'2017', 
				'2018'=>'2018', 
				'2019'=>'2019', 
				'2020'=>'2020', 
				'2021'=>'2021', 
				'2022'=>'2022', 
				'2023'=>'2023', 
				'2024'=>'2024', 
				'2025'=>'2025', 
				'2026'=>'2026', 
				'2027'=>'2027', 
				'2028'=>'2028', 
				'2029'=>'2029', 
				'2030'=>'2030' 
			),
			'dias30' => array(
				'0'=>'00', '1'=>'01',	'2'=>'02',
				'3'=>'03',	'4'=>'04',	'5'=>'05',
				'6'=>'06',	'7'=>'07',	'8'=>'08',
				'9'=>'09',	'10'=>'10',	'11'=>'11',
				'12'=>'12',	'13'=>'13',	'14'=>'14',
				'15'=>'15',	'16'=>'16',	'17'=>'17',
				'18'=>'18',	'19'=>'19',	'20'=>'20',
				'21'=>'21',	'22'=>'22',	'23'=>'23',
				'24'=>'24',	'25'=>'25',	'26'=>'26',
				'27'=>'27',	'28'=>'28',	'29'=>'29',
				'30'=>'30'
			),
			'dias31' => array(
				'01'=>'01',	'02'=>'02',
				'03'=>'03',	'04'=>'04',	'05'=>'05',
				'06'=>'06',	'07'=>'07',	'08'=>'08',
				'09'=>'09',	'10'=>'10',	'11'=>'11',
				'12'=>'12',	'13'=>'13',	'14'=>'14',
				'15'=>'15',	'16'=>'16',	'17'=>'17',
				'18'=>'18',	'19'=>'19',	'20'=>'20',
				'21'=>'21',	'22'=>'22',	'23'=>'23',
				'24'=>'24',	'25'=>'25',	'26'=>'26',
				'27'=>'27',	'28'=>'28',	'29'=>'29',
				'30'=>'30', '31'=>'31'
			),
			'horas' => array(
				'0'=>'00', '1'=>'01',	'2'=>'02',
				'3'=>'03',	'4'=>'04',	'5'=>'05',
				'6'=>'06',	'7'=>'07',	'8'=>'08',
				'9'=>'09',	'10'=>'10',	'11'=>'11',
				'12'=>'12',	'13'=>'13',	'14'=>'14',
				'15'=>'15',	'16'=>'16',	'17'=>'17',
				'18'=>'18',	'19'=>'19',	'20'=>'20',
				'21'=>'21',	'22'=>'22',	'23'=>'23'
			),
			'minutos' => array(
				'0'=>'00', '1'=>'01',	'2'=>'02',
				'3'=>'03',	'4'=>'04',	'5'=>'05',
				'6'=>'06',	'7'=>'07',	'8'=>'08',
				'9'=>'09',	'10'=>'10',	'11'=>'11',
				'12'=>'12',	'13'=>'13',	'14'=>'14',
				'15'=>'15',	'16'=>'16',	'17'=>'17',
				'18'=>'18',	'19'=>'19',	'20'=>'20',
				'21'=>'21',	'22'=>'22',	'23'=>'23',
				'24'=>'24', '25'=>'25',	'26'=>'26',
				'27'=>'27',	'28'=>'28',	'29'=>'29',
				'30'=>'30',	'31'=>'31',	'32'=>'32',
				'33'=>'33',	'34'=>'34',	'35'=>'35',
				'36'=>'36',	'37'=>'37',	'38'=>'38',
				'39'=>'39',	'40'=>'40',	'41'=>'41',
				'42'=>'42',	'43'=>'43',	'44'=>'44',
				'45'=>'45',	'46'=>'46',	'47'=>'47',
				'48'=>'48', '49'=>'49',	'50'=>'50',
				'51'=>'51',	'52'=>'52',	'53'=>'53',
				'54'=>'54',	'55'=>'55',	'56'=>'56',
				'57'=>'57',	'58'=>'58',	'59'=>'59'
			),
			'minutos10' => array(
				'0'=>'00', '10'=>'10', 
				'20'=>'20', '30'=>'30',	
				'40'=>'40', '50'=>'50'
			),
			'minutos5' => array(
				'0'=>'00', '5'=>'05', '10'=>'10', 
				'15'=>'15', '20'=>'20', '25'=>'25', 
				'30'=>'30',	'35'=>'35', '40'=>'40', 
				'45'=>'45', '50'=>'50', '55'=>'55'
			),
		    'unidades' => array (
		        0 => 'DÃ­a',
		        1 => 'Hora',
		        2 => 'Minuto'
		    ),
			'unidadestiempo' => array (
		        1 => 'DÃ­a',
		        2 => 'Hora',
		        3 => 'Minuto'
		    ),
		   'unidadesMaquinariasGuardar' => array (
		        'Dia' => 1,
		        'Hora' => 2,
		        'Minuto' => 3
		    ),
			'unidadesIngles' => array(
		        0 => 'DAY',
		        1 => 'HOUR',
		        2 => 'MINUTE'
			),
		    'estadosDefault' => array(
		        'AC' => 'Activado',
		        'DE' => 'Desactivado'
		    ),
		    'estados' => array(
		        'AC' => 'Activado',
		        'DE' => 'Desactivado',
		        'PR' => 'En Proceso'
		    ),
		    'estadosFlujo' => array(
		        'AC' => 'Proceso',
		        'AB' => 'Abandonado'
		    ),
		    'estadosEncuesta' => array(
		        'AC' => 'Activo',
		        'DE' => 'Desactivo'
		    ),
		    'estadosPantalla' => array(
		    	'AC' => 'Activo',
		    	'DE' => 'Desactivo'
		    ),
		    'tipoPantalla' => array(
		    	'PR' => 'Principal',
		    	'EN' => 'Encuesta'
		    ),
		    'estadosWebSolicitud' => array(// NO USAR - PARA ELIMINAR
		        'PE' => 'Pendiente',
		        'AT' => 'Atendido',
		        'AS' => 'Asignado',
		        'CA' => 'Cancelado'
		    ),
		    'estadosProspecto' => array(// NO USAR - PARA ELIMINAR
		        'PE' => 'Pendiente',
		        'AS' => 'Asignado',
		        'CA' => 'Cancelado'
		    ),
		    'estadosImpresion' => array(// NO USAR - PARA ELIMINAR
		        'PE' => 'Pendiente',
		        'TE' => 'Terminado',
		        'CA' => 'Cancelado'
		    ),
		    'estadosCotizacion' => array(// NO USAR - PARA ELIMINAR
		        'AC' => 'Aceptado',
		        'PE' => 'Pendiente',
		        'AN' => 'Invalido'
		    ),
		    'estadosEncargo' => array(// NO USAR - PARA ELIMINAR
		        'CR' => 'Creado',
		        'ST' => 'Empezado',
		        'PR' => 'En Proceso',
		        'AB' => 'Abandonado',
		        'SU' => 'Suspendido',
		        'TE' => 'Terminado'
		    ),
		    'estadosActividad' => array(
		        'CR' => 'Creado',
		        'ST' => 'Iniciado',
		        'PR' => 'En Proceso',
		        'AB' => 'Abandonado',
		        'SU' => 'Suspendido'
		    ),
		    'monedas' => array(
		        'dolares' => 'Dolares Americanos',
		        'soles' => 'Nuevos Soles',
		    ),
		    'monedasSimbolo' => array(
		        'dolares' => 'US$',
		        'soles' => 'S/',
		    ),
		    'simbolosMoneda' => array(
		        'Dolar' => 'US$',
		        'Nuevo Sol' => 'S/',
		    ),
		    'tiposSolicitud' => array(
		        'MA' => 'Cita de Manejo',
		        'CO' => 'Cotizacion'
		    ),
			'tiposDocumento' => array(
				'DNI' => 'DNI',
		        'CE' => 'Carnet de Extranjeria',
				'PAS' => 'Pasaporte'
		    ),
			'tiposDocumentoCliente' => array(
				'DNI' => 'DNI',
		        'CE' => 'Carnet de Extranjeria',
				'PAS' => 'Pasaporte',
				'RUC'=> 'RUC'
		    ),    
			'tiposPersona' => array(
				'N' => 'Persona Natural',
				'J' => 'Persona Juridica'
			),
			'tiposPersonaMayuscula' => array(
				'N' => 'PERSONA NATURAL',
				'J' => 'PERSONA JURIDICA'
			),
		    'tipoCliente' => array(
		    	'PR' => 'Prospecto',
		    	'CL' => 'Cliente'
		    ),
		    'tiposEncuesta' => array(
		    	'UN' => 'Unico',
		    	'MU' => 'Multiple'
		    ),
			'tiposTrabajo' => array (
		        0 => 'Interno',
		        1 => 'Externo'
		    ),
		    'procendeciasImpresion' => array(
		    	'CO' => 'CC',
		    	'MA' => 'Cita de Manejo',
				'TI' => 'TK',
				'CE' => 'Celular'
		    ),
		    'igv' => '0.19',
		    'estadoCivil' => array(
					'A DEFINIR' 	=> 'A DEFINIR',
					'SOLTERO' 		=> 'SOLTERO',
					'CASADO' 		=> 'CASADO',
					'DIVORCIADO' 	=> 'DIVORCIADO',
					'VIUDO' 		=> 'VIUDO'),
			'estado' => array(
					'PR' => 'Tramite',
					'EN' => 'Entregado',
					'SU' => 'Observado',
			),
			'estadoPlaca' => array(
					'ST' => 'Solicitado',
					'PR' => 'Tramite',
					'EN' => 'Entregado',
					'SU' => 'Observado',
			),
			'tipoCallCenter' => array(
					'CO' => 'CotizaciÃ³n',
					'MA' => 'Cita de Manejo',
			),
			'defaultDatos' => array(
				'apellido_paterno' => 'A completar',
				'apellido_materno' => 'A completar',
				'nombres' => 'A completar'
			),
			'motivosSuspension' => array(
				'1' => 'AprobaciÃ³n del cliente',
				'2' => 'Entrega de repuestos',
				'3' => 'Servicio de terceros',
				'4' => 'Interno - Taller',
				'5' => 'Casos Especiales'
			),
			'si_no' => array (
		        0 => 'No',
		        1 => 'Si'
		    ),
		    'turnos' => array(
		        'D' => 'Diurno',
		        'N' => 'Nocturno'
		    ),
			'asesorColores' => array(
				'#F4FA58' => 'AMARRILLO',
				'#0000FF' => 'AZUL',
				'#FFFFFF' => 'BLANCO',
				'#FAAC58' => 'NARANJA',
				'#000000' => 'NEGRO',
				'#A4A4A4' => 'PLOMO',
				'#FF0000' => 'ROJO',
				'#00FF00' => 'VERDE',
				'#F781F3' => 'VIOLETA',
			),
			'tiposMecanico' => array(
				'AA' => 'Aire Acondicionado', 
				'ME' => 'MecÃ¡nico', 
				'TE' => 'Tercero Externo', 
				'TI' => 'Tercero Interno'
			),
			'agendaVendedor' => array(
				'T' => 'Todos los estados', 
				'P' => 'Pendientes', 
				'F' => 'Finalizado'
			),
			'agendaVendedorJv' => array(
				'T' => 'Todos los estados', 
				'P' => 'Pendientes', 
				'F' => 'Finalizado',
				'N' => 'Ninguno'
			),
			'PlaworkorderStatus' => array(
				'T' => 'Todos los estados', 
				'AC' => 'AC', 
				'AB' => 'AB'
			),
			'trabajoObservado' => array(
				'T' => 'TODOS', 
				'SI' => 'SI', 
				'NO' => 'NO'
			),
			'liberacion' => array(
				'T' => 'TODOS', 
				'SI' => 'SI', 
				'NO' => 'NO'
			),
			'tipoMoneda'=> array(
				'Dolares'=>'Dolares',
				'Soles'=>'Soles',
				'Euros'=>'Euros',
				'Yenes'=>'Yenes'
			),
			'tiposRol' => array(
				'AS' => 'Asesor',
				'IN' => 'InspecciÃ³n',
				'LA' => 'Lavado',
				'AC' => 'MecÃ¡nico'
				//'EN'  => 'Entrega'
			),
			'tiposAsignacionesJV' => array(
				'LA' => 'Lista de Sucursales y Marcas Asignadas',		
				'TD' => 'Lista General',
			)	,
			'tipoPersona' => array(
				'N' => 'Natural',		
				'J' => 'Juridica-Empresa',
			),	
			'tipoPersonaJN' => array(
				'N' => 'Natural',		
				'J' => 'Juridica-Empresa',
				//'M' => 'Juridico-Persona(natural con ruc)'
			),
			'tipo' => array(
		        'AD' => 'Administrativo',
		        'RE' => 'Reporte',
		    ),
		    'estadosUbicaciones' => array(
		        'AC' => 'Activa',
		        'DE' => 'Desactiva'
		    ),
		    'estadosCelda' => array(
		    	'DE' => 'Desactiva',
		    	'LI' => 'Libre',
		    	'OC' => 'Ocupada'
		    ),
			'tiposAlmacen' => array(
		        'AL' => 'Almacen',
		        'LS' => 'Local de Salida'
		    ), 
		    'tipoMovimientosUbicacion' => array(
		    	'B' => 'Borrado',
		    	'C' => 'Carga', 
		    	'D' => 'Desplazamiento', 
		    	'I' => 'Ingreso', 
		    	'S' => 'Salida'
		    ), 
		    'tiposVenta' => array(
		    	'S' => 'Interno', 
		    	'N' => 'PÃºblico', 
		    	'IP' => 'Interno / PÃºblico'
		    ),
		    'urgencias' => array(
				'N' => 'Normal',
				'U' => 'Indecopi',
		    	'P' => 'AmpliaciÃ³n',		 
		    	'D' => 'Interno / Taller'   	
		    ), 
			'estadoRepuestos' => array(
				'OR' => 'Atendido',
				'PE' => 'No atendido'	
		    ),
		    'urgenciasPedidosSAV' => array(
		    	'Ampliacion' => 'AmpliaciÃ³n', 
		    	'Interno / Taller' => 'Interno / Taller', 
		    	'Normal' => 'Normal', 
		    	'Urgente' => 'Urgente'
		    ), 
		    'alternativasSiNo' => array(
		    	'SN' => 'Si/No', 
		    	'S' => 'Si', 
		    	'N' => 'No'
		    ),
		    'estadosSolicitudRecojo' => array(
		    	'PE' => 'Pendiente', 
		    	'SO' => 'Solicitado para Recojo'
		    ),
		    'estadosSolicitudTraslado' => array(
		    	'PE' => 'Pendiente', 
		    	'SO' => 'Solicitado para Traslado'
		    ),
		    'estadosPlanificacion' => array(
		    	'CP' => 'Con PlanificaciÃ³n',
		    	'SP' => 'Sin PlanificaciÃ³n'
		    ),
		    'estadosOtUbicaciones' => array(
		    	'CO' => 'Con Ot',
		    	'SO' => 'Sin Ot'
		    ),
		    'sentidosMovimiento' => array(
		    	'de' => 'Del DepÃ³sito',
		    	'a' => 'Al DepÃ³sito'
		    ),
		    'estadosPlanificacionPreentrega' => array(
		    	'SP' => 'Sin PlanificaciÃ³n', 
		    	'PP' => 'Con PlanificaciÃ³n Parcial', 
		    	'PT' => 'Con PlanificaciÃ³n Total'
		    ),
		    'estadosOtImportaciones' => array(
		    	'A' => 'Abierto', 
		    	'1' => 'Cerrado'
		    ), 
		    'estadosUnidadCars' => array(
		    	'NA' => 'Espera Proceso', 
		    	'1' => 'Proceso', 
		    	'2' => 'Imp. Taller', 
		    	'3' => 'Imp. Circulando', 
		    	'4' => 'PÃ©rdida Total', 
		    	'5' => 'Unidad Lista',
		    	'EN' => 'Entregado'
		    ),
			'estadoPendiente' => array(
				'T' => 'TODOS', 
				'PENDIENTE' => 'PENDIENTE', 
				'ADICIONAL' => 'ADICIONAL'
			),
			'estadoTarea' => array(
				'T' => 'TODOS', 
				'TERMINADO' => 'TERMINADO', 
				'NO TERMINADO' => 'NO TERMINADO'
			),
			'estadoPreentrega' => array(
				'T' => 'TODOS', 
				'TERMINADO' => 'TERMINADO', 
				'NO TERMINADO' => 'NO TERMINADO'
			),
			'estadoProblema' => array(
				'T' => 'Todos', 
				'Solucionadao' => 'Solucionado', 
				'No Solucionado' => 'No Solucionado'
			),
			'estadoLiberacion' => array(
				'T' => 'Todos', 
				'Antes' => 'Antes', 
				'Despues' => 'Despues'
			),
			'estadoEjecucion' => array(
				'T' => 'Todos', 
				'SP' => 'Sin Planificar', 
				'NI' => 'No Iniciado',
				'EP' => 'En Proceso',
			),
			'estadoPlanificacion' => array(
				'T' => 'Todos', 
				'SP' => 'Sin Planificar', 
				'PP' => 'Parcial',
				'PT' => 'Total',
			),
			'tipoTarea' => array(
				'T' => 'Todos', 
				'Interno' => 'Interno', 
				'Externo' => 'Externo',
			),
			'estadosOtPlanificada' => array(
				'AC' => 'Activo', 
				'RE' => 'Reprogramado'
			),
//			'estadosOtCars' => array(
//				'0' => 'Abierta', 
//				'1' => 'Cerrada', 
//				'2' => 'Liquidada'
//			),
			'estadosOtCars' => array(
				'0000' => 'Creada', 
				'0060' => 'Confirmada', 
				'0070' => 'Liberada', 
				'0090' => 'Cerrada Tecnicamente', 
				'0095' => 'Facturada Parcialmente',
				'0103' => 'Cerrada (Servicio)', 
				'0999' => 'Rechazada'
			),
			'estadosOtCarsCcp' => array(
				'0000' => 'Creada', 
				'0060' => 'Confirmada', 
				'0070' => 'Liberada', 
				'0090' => 'Cerrada Tecnicamente', 
				'0095' => 'Facturada Parcialmente'
			),
//			'estadosOtCarsCcp' => array(
//				'0' => 'Abierta', 
//				'2' => 'Liquidada'
//			),	
			'estadosOtMaquinaria' => array(
				'0' => 'Abierta', 
				'1' => 'Cerrada', 
				'2' => 'Liquidada', 
				'3' => 'No definido'
			),
			'estadosTipoContenido' => array(
				'AC' => 'ACTIVO', 
				'AN' => 'ANULADO'
			),
			'estadosArchivosPublicados' => array(
				'PU' => 'PUBLICADO', 
				'AN' => 'ANULADO'
			),
			'nivelesDescarga' => array(
				'GE' => 'GENERAL', 
				'PR' => 'PROPIETARIO'
			),
			'nivelesCarga' => array(
				'PR' => 'PROPIETARIO', 
				'AD' => 'ADMINISTRADOR'
			),
			'estadosTipoContenidos' => array(
				'AC' => 'ACTIVO', 
				'AN' => 'ANULADO'
			),
			'solicitud' => array(
				'RE' => 'Reserva', 
				'CA' => 'Cancelacion', 
				'PC' => 'Pago a Cuenta'
			),
			'estadosOperaciones' => array(
				'1' => 'Pendiente', 
				'2' => 'Solicitado', 
				'3' => 'Validado', 
				'4' => 'Desaprobado', 
				'5' => 'Anulado'	
			),
			'columnasControlCalidad' => array(
				'P' => 'Probador',
				'L' => 'Lavado',
				'A' => 'Asesor',
				'E' => 'Entrega'
			),
			'estadosOtPlaneadosMaquinarias' => array(
				'Activo' => '1',
				'Anulado' => '2',
				'Ejecucion' => '3',
				'Suspendido' => '4',
				'AnuladoSuspension' => '5',
				'Terminado' => '6'
			),
			'estadosTareaEjecutadosMaquinarias' => array(
				'Iniciado' => '1',
				'Suspendido' => '2',
				'Terminado' => '3',
				'Reiniciado'=>'4',
				'SuspendidoOt' =>'5'
			),
			'estadosTareaMaquinarias' => array(
				'Activo' => '1',
				'Anulado' => '2',
				'Ejecucion' => '3',
				'AnuladoSuspension' => '4',
				'Terminado' => '5'
			),
			'estadosTareaMaquinariasVisualizar' => array(
				'1'=>'Activo',
				'2'=>'Anulado',
				'3'=>'Ejecucion',
				'4'=>'Cerrado'
			),
			'estadosControlOtMaquinarias' => array(
				'Planificado' => '1',
				'Inspeccion' => '2',
				'Lavado' => '3',
				'Coordinador' => '4',
				'Entregar' => '5',
				'Anulado' => '6',
				'Suspendido' => '7',
				'Ejecucion' => '8',
				'InspeccionIniciado' => '9',
				'LavadoIniciado' => '10',
				'CoordinadorIniciado' => '11',
				'ReprogramadoInspector' => '12',
				'ReprogramadoCoordinador' => '13',
				'Adicional' => '14'		
			),	
			'maquinariasSolicitudTipoTrabajo' => array(
				'1' => 'Campo',
				'2' => 'Taller'
			),
			'estadosTareaEjecutadosCcp' => array(
				'Iniciado' => '1',
				'Suspendido' => '2',
				'Terminado' => '3',
				'Reiniciado'=>'4',
				'SuspendidoOt' =>'5'
			),
			'estadosTareaCcp' => array(
				'Activo' => '1',
				'Anulado' => '2',
				'Ejecucion' => '3',
				'AnuladoSuspension' => '4',
				'Terminado' => '5'
			),
			'estadosTareaCcpVisualizar' => array(
				'1'=>'Activo',
				'2'=>'Anulado',
				'3'=>'Ejecucion',
				'4'=>'Cerrado'
			),
			'estadosControlOtCcp' => array(
				'PendientePlanificacion'=>'1',
				'Planificado' => '2',
				'Ejecucion' => '3',
				'Tablero' => '4',
				'Lavado' => '5',
				'Inspeccion' => '6',
				'Coordinador' => '7',  // es lo mismo que Asesor (el coordinador se inicia automaticamente)
				'Entregar' => '8',
				'LavadoIniciado' => '9',
				'InspeccionIniciado' => '10',
				'ReprogramadoInspector' => '11',
				'ReprogramadoCoordinador' => '12',
				'Adicional' => '13',
				'Anulado' => '14',
				'Suspendido' => '15',
				'Direccionado' => '16'
			),
			'estadosOtPlaneadosCcp' => array(
				'Activo' => '1',
				'Anulado' => '2',
				'Ejecucion' => '3',
				'Suspendido' => '4',
				'AnuladoSuspension' => '5',
				'Terminado' => '6'
			),
			'estadosTareaEjecutadosCcp' => array(
				'Iniciado' => '1',
				'Suspendido' => '2',
				'Terminado' => '3',
				'Reiniciado'=>'4',
				'SuspendidoOt' =>'5'
			),
			'estadosTareaCcp' => array(
				'Activo' => '1',
				'Anulado' => '2',
				'Ejecucion' => '3',
				'AnuladoSuspension' => '4',
				'Terminado' => '5'
			),
			'estadosTareaCcpVisualizar' => array(
				'1'=>'Activo',
				'2'=>'Anulado',
				'3'=>'Ejecucion',
				'4'=>'Cerrado'
			), 
			'ccpTableros' => array(
				'Planchado' => '1',
				'Pintura' => '1',
				'Mecanico' => '1',		
			),
			'maqTipoOrden'=>array('PUBLICO','INTERNAS','GARANTIA','PREENTREGA'),
			'maqIntervaloTiempo'=>array('0 - 24 horas','24 - 72 horas','72 a mas horas'),
			'statusDercotizacion' => array(
				'CO'=>'Cotizado',
				'SE'=>'Seguimiento',
				'CI'=>'Cierre',
				'FA'=>'Facturado',
				'PE'=>'Perdido',
				'DB'=>'Dercobienes'
			),
			'semanasMes' => array(
				'1'=>'1',
				'2'=>'2',
				'3'=>'3',
				'4'=>'4'
			),
			'aseguradoras'=>array(
				'Mafre'=>'Mafre'
			)	
		);
}