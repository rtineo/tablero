<?php
class Secperson extends AppModel {

	public $name = 'Secperson';		
	public $displayField = 'username';
	public $virtualFields = array('nombreCompleto'=>"concat(appaterno, ' ', apmaterno, ', ', firstname)");
	public $validate = array(
		
		'firstname' => array(
						'notEmpty' =>array(
								'rule'=>'notEmpty',
								'last' => true
								),
														
						'maxLength' => array(
						        'rule' => array('maxLength', '60'),				        
								'last' => true
				   				),  
		),
		
		'appaterno' => array(
						'notEmpty' =>array(
								'rule'=>'notEmpty',
								'last' => true
								),
														
						'maxLength' => array(
						        'rule' => array('maxLength', '60'),				        
								'last' => true
				   				),  
		),
		
		'apmaterno' => array(
						'notEmpty' =>array(
								'rule'=>'notEmpty',
								'last' => true
								),
														
						'maxLength' => array(
						        'rule' => array('maxLength', '60'),				        
								'last' => true
				   				),  
		),
		
		'username' => array(
						'notEmpty' =>array(
								'rule'=>'notEmpty',
								'last' => true
								),
														
						'maxLength' => array(
						        'rule' => array('maxLength', '20'),				        
								'last' => true
				   				),  
						
						'isUnique' => array(
					        	'rule' => 'isUnique',  
								'last' => true					        	
								),
		),
			
		'language' => array(								       							
						'notEmpty' => array(
						        'rule' => 'notEmpty',				        
								'last' => true
				   				),  
		),
		
		'password' => array(								       							
						'notEmpty' => array(
						        'rule' => 'notEmpty',				        
								'last' => true
				   				),  
		),
		
		'privelege' => array(								       							
						'numeric' => array(
						        'rule' => 'numeric',	
								'allowEmpty' => true, 			        
								'last' => true
				   				),  
		),
		
//		'creationdate' => array(
//								'notEmpty' => array(
//					            	'rule' => 'notEmpty',  
//					            	'last' => true
//					         	),
//								
//								'date' => array(
//	            					'rule' => array('date', 'ymd'),
//									'last' => true			 	
//	    						)	
//		),
//		
//		'expirationdate' => array(
//								'notEmpty' => array(
//					            	'rule' => 'notEmpty',  
//					            	'last' => true
//					         	),
//								
//								'date' => array(
//	            					'rule' => array('date','ymd'),
//									'last' => true			 	
//	    						)	
//		),		
			
		'status' => array('notEmpty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $hasMany = array(
		'Secassign' => array(
			'className' => 'Secassign',
			'foreignKey' => 'secperson_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Secpassword' => array(
			'className' => 'Secpassword',
			'foreignKey' => 'secperson_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	function setListaPersonaApruebaCorreo(){
		$lista = $this->find('all',array('fields' => array('email','CONCAT("Secperson"."appaterno" , \' \' , "Secperson"."apmaterno" , \' \' , "Secperson"."firstname") AS "Secperson__usuario"'),
										 'conditions' => array('correoaprobacion'=> true,'status' => 'AC'),
										 'recursive' => -1));		
		$lista = !empty($lista)?array_combine(Set::extract($lista, '{n}.Secperson.email'), Set::extract($lista, '{n}.Secperson.usuario')):array();
		return $lista;
	}
	
	function obtenerUsername($id=null) {
		if(!empty($id)) {
			$this->recursive = -1;
			$campos = array('username');
			$person = $this->findById($id, $campos);
			$username = $person['Secperson']['username'];
		}
		return isset($username) && !empty($username) ? $username : null;
	}
	
	function getDirectorio($datosLogeo){		
		App::import('Model', 'Secorganization');				$this->Secorganization = new Secorganization();
		$idEmpresa = $datosLogeo[0]['Secorganization']['id'];
		$directorio = $this->Secorganization->find('first',array('fields'=>array('directoriofirma'),'conditions'=>array('Secorganization.id'=>$idEmpresa),'recursive'=>-1));
		return $directorio['Secorganization']['directoriofirma'];		
	}
	
	function getUserListaJson($user){
		$userLista = $this->find('all',array('recursive'=>-1,
								'fields'=>array('Secperson.id','CONCAT("Secperson"."username" , \' \' , "Secperson"."appaterno" , \' \' ,"Secperson"."firstname") AS "Secperson__label"',
												'CONCAT("Secperson"."appaterno" , \' \' ,"Secperson"."firstname") AS "Secperson__value"'),
								'conditions'=>array('CONCAT("Secperson"."username" , \'-\' ,"Secperson"."appaterno" , \' \' ,"Secperson"."firstname") LIKE \'%'.trim($user).'%\''),
								'order'=>array('Secperson.appaterno'=>'asc')
								));
		//configure::write('debug',1);
		//debug($userLista);
		//die;
		$tmp_1 = array('Secperson'=>array(array('label'=>'No hay datos', 'value'=>'Seleccionar', 'id'=>'')));			
		foreach($userLista as $key=>$user){
			$tmp['Secperson'][$key]['label'] = trim($user['Secperson']['label']);
			$tmp['Secperson'][$key]['value'] = trim($user['Secperson']['value']);
			$tmp['Secperson'][$key]['id'] = trim($user['Secperson']['id']);
		}
		return empty($tmp)?json_encode($tmp_1['Secperson']):json_encode($tmp['Secperson']);
	}
	
	/**
	 * Recupera la lista de todas las personas aprobadas a enviar correo
	 * @param object $conditions [optional]
	 * @return 
	 */
	function getListaCorreos($conditions = null){
		$condicionBase = array('Secperson.correoaprobacion'=>true,'Secperson.status'=>'AC');
		if(!empty($conditions)){
			$condicionBase = array_merge($condicionBase, $conditions);
		}
		$lista = $this->find('all',array('fields'=>array('Secperson.id', 'CONCAT("Secperson"."appaterno" , \' \' , "Secperson"."apmaterno" , \' \' , "Secperson"."firstname") AS "Secperson__usuario"'),
											'conditions'=>$condicionBase));
											
		$lista = !empty($lista)?array_combine(Set::extract($lista, '{n}.Secperson.id'), Set::extract($lista, '{n}.Secperson.usuario')):array();
		return $lista;
	}
	
	/**
	 * Recupera el correo de una persona espec'ifica
	 * @param object $idperson
	 * @return 
	 */
	function getEmail($idperson){
		$person = $this->find('first',array('conditions'=>array('Secperson.id'=>$idperson),'fields'=>('Secperson.email'),'recursive'=>-1));
		return $person['Secperson']['email'];
	}
	
	function obtenerNombreTrabajadorCompleto($worker_id) {
		$campos = array('Secperson.firstname', 'Secperson.appaterno', 'Secperson.apmaterno');
		$trabajador = $this->findById($worker_id, $campos);
		return $trabajador['Secperson']['appaterno'].' '.$trabajador['Secperson']['apmaterno'].', '.$trabajador['Secperson']['firstname'];
	}
	
	function obtenerListaResponsablesTableroSucursal($project_id) {
		$mecanicos = $this->obtenerResponsablesTableroSucursal($project_id);
		if(!empty($mecanicos)) {
			foreach($mecanicos as $key=>$item) {
				$indice = $item['Secperson']['id'];
				$valor = $item['Secperson']['username'];
				$lista[$indice] = $valor;
			}
		}
		return isset($lista) && !empty($lista) ? $lista : array();
	}
	function obtenerUserNameDesdeSecperson($personId){
		$desde = date('Y-m-d 00:00:00', strtotime($this->fechaHoraActual()));
		$hasta = date('Y-m-d 23:59:59', strtotime($this->fechaHoraActual()));
		$sql = "SELECT Secperson.id as \"Secperson__id\",
				Secperson.username as \"Secperson__username\"
				FROM secpeople Secperson WHERE  Secperson.id=".$personId."
				AND Secperson.status = 'AC' 
				AND Secperson.planificar = 1 
				AND Secperson.id IN ( 
					SELECT Apppersonalcalendar.secperson_id 
					FROM apppersonalcalendars Apppersonalcalendar 
					WHERE Apppersonalcalendar.initdatetime >= '".$desde."' 
					AND Apppersonalcalendar.enddatetime <= '".$hasta."' 
				) 
				ORDER BY Secperson.username ASC";
		$rs = $this->query($sql);
		//return !empty($rs) ? $rs : array();
		if(!empty($rs)) {
			foreach($rs as $key=>$item) {
				$indice = $item['Secperson']['id'];
				$valor = $item['Secperson']['username'];
				$lista[$indice] = $valor;
			}
		}else{
			$lista[0]='No Encontrado';
		}
		return isset($lista) && !empty($lista) ? $lista : array();
	}
	
	
	function obtenerResponsablesTableroSucursal($project_id) {
		$desde = date('Y-m-d 00:00:00', strtotime($this->fechaHoraActual()));
		$hasta = date('Y-m-d 23:59:59', strtotime($this->fechaHoraActual()));
		$sql = "SELECT Secperson.id as \"Secperson__id\",
				Secperson.username as \"Secperson__username\"
				FROM secpeople Secperson INNER JOIN secassigns Secassigns
				ON Secassigns.secperson_id = Secperson.id 
				WHERE Secassigns.secproject_id = ".$project_id." 
				AND Secperson.status = 'AC' 
				AND Secperson.planificar = 1 
				AND Secperson.id IN ( 
					SELECT Apppersonalcalendar.secperson_id 
					FROM apppersonalcalendars Apppersonalcalendar 
					WHERE Apppersonalcalendar.initdatetime >= '".$desde."' 
					AND Apppersonalcalendar.enddatetime <= '".$hasta."' 
					AND Apppersonalcalendar.state='AC'
				) 
				ORDER BY Secperson.username ASC";
		$rs = $this->query($sql);
		return !empty($rs) ? $rs : array();
	}
	
	function obtenerCantidadMecanicosPorSucursal($project, $dia=null, $mes=null, $anio=null) {
		$estadoActivo = 'AC';
		$turno = 'D';
		
		$sql = "SELECT 
				Secperson.id
				FROM secpeople Secperson
				INNER JOIN secassigns Asignacion on(Asignacion.secperson_id=Secperson.id)
				INNER JOIN secprojects Secproject on (Secproject.id=Asignacion.secproject_id)
				WHERE Secproject.id = ".$project['Secproject']['id']." 
				AND Secperson.status = '".$estadoActivo."' 
				AND Asignacion.status = 'AC'
				AND Secperson.planificar = 1 
				AND Secperson.id IN (
					SELECT DISTINCT Apppersonalcalendar.secperson_id 
					FROM apppersonalcalendars Apppersonalcalendar
					WHERE DATE(Apppersonalcalendar.initDateTime) = '".$anio."-".$mes."-".$dia."' AND Apppersonalcalendar.state='AC'
				)";
		//pr($sql);
		$rs = $this->query($sql);
		return !empty($rs) ? count($rs) : 0;
	}
	/*Nuevo Tablero*/
	function buscarPorSucursal($project, $dia=null, $mes=null, $anio=null, $limit=null, $mecanicos=null, $excepcion=null) {
		$activo = 'AC';
		$estadoCreado = 1;
		$estadoPlanificado = 2;
		$estadoEjecutado = 3;
		$estadoTerminado = 4;		
		$turno = 'D';
		App::import('Model', 'Tabplannedtask');
		App::import('Model', 'Tabexecutedtask');
		$this->Tabplannedtask=new Tabplannedtask;
		$this->Tabexecutedtask=new Tabexecutedtask;
		
		$sql = "SELECT Secperson.id as \"Secperson__id\", 
				Secperson.appaterno as \"Secperson__appaterno\",
				Secperson.apmaterno as \"Secperson__apmaterno\"
				FROM secpeople Secperson INNER JOIN secassigns Secassign ON (Secassign.secperson_id=Secperson.id)
				WHERE Secassign.secproject_id = ".$project['Secproject']['id']." 
				AND Secperson.status = '".$activo."' 
				AND Secperson.planificar = 1
				AND Secassign.status='AC'
				AND Secperson.id IN (
					SELECT DISTINCT Apppersonalcalendar.secperson_id 
					FROM apppersonalcalendars Apppersonalcalendar 
					WHERE Apppersonalcalendar.state='AC' AND DATE(Apppersonalcalendar.initdatetime) = '".$anio."-".$mes."-".$dia."'
				) ORDER BY Secperson.appaterno ASC";
		//pr($sql);
		$rs = $this->query($sql);//pr($sql);pr($rs);
		$responsables = array();
		//pr($rs);
		if(!empty($rs)) {
			foreach($rs as $key=>$value) {
				$responsables[$key] = $value;
				
				// obteniendo las ordenes de taller planificadas
				$condicion = "Tabplannedtask.secperson_id = ".$value['Secperson']['id']." AND Tabplannedtask.state='AC'
							AND Tabplannedtask.plannedtaskstate IN (".$estadoCreado.",".$estadoPlanificado.",".$estadoEjecutado.",".$estadoTerminado.")
							AND DATE(Tabplannedtask.initdatetime) = '".$anio."-".$mes."-".$dia."'";

				//$planeados = $this->Talcalendariomecanicoplaneado->findAll($condicion);
				$planeados = $this->Tabplannedtask->obtenerTareasPlaneadasResponsable($condicion);
				//pr($planeados);
				if(!empty($planeados)) {
					foreach($planeados as $item) {
						$responsables[$key]['Tabplannedtask'][] = $item['Tabplannedtask'];
						$responsables[$key]['Tabtask'][] = $item['Tabtask'];
						$responsables[$key]['Tabot'][] = $item['Tabot'];						
					}
				}
				
				// obteniendo las ordenes de taller en ejecucion
				$condicion = "Tabexecutedtask.secperson_id = ".$value['Secperson']['id']." AND Tabexecutedtask.state='AC'
							AND DATE(Tabexecutedtask.initdatetime) = '".$anio."-".$mes."-".$dia."'";
				$this->Tabexecutedtask->unbindModel(array('belongsTo'=>array('Secperson')));
				$this->Tabexecutedtask->recursive=2;
				$ejecutados = $this->Tabexecutedtask->find('all',array('conditions'=>$condicion));
				//pr($ejecutados);
				if(!empty($ejecutados)) {
					foreach($ejecutados as $item) {
						$responsables[$key]['Tabexecutedtask'][] = $item['Tabexecutedtask'];
						$responsables[$key]['Tabtask'][] = $item['Tabtask'];
						$responsables[$key]['Tabot'][] = $item['Tabtask']['Tabot'];
					}
				}
			}
		}
		//pr($responsables);
		return !empty($responsables) ? $responsables : array();
	}
	
	function generarListaComboPorSucursal($project, $dia=null, $mes=null, $anio=null) {
		App::import('Model', 'Apppersonalcalendar');
		$this->Apppersonalcalendar=new Apppersonalcalendar;
		$responsables = $this->buscarResponsablesPorSucursal($project, $dia, $mes, $anio);
		$fechaHoraActual = $this->fechaHoraActual();
		foreach ($responsables as $responsable) {
			$condicion = "Apppersonalcalendar.secperson_id= ".$responsable['Secperson']['id']. 
						"AND Apppersonalcalendar.state='AC' AND (Apppersonalcalendar.initdatetime >= '".$anio."-".$mes."-".$dia." 00:00:00' 
						AND Apppersonalcalendar.enddatetime < '".$anio."-".$mes."-".$dia." 23:59:59')";
			$horarios = $this->Apppersonalcalendar->find('all',array('conditions'=>$condicion));
			$fin = $horarios[sizeof($horarios) - 1]['Apppersonalcalendar']['enddatetime'];
			if($fechaHoraActual < $fin) {
				$lista[$responsable['Secperson']['id']] = $responsable['Secperson']['nombreCompleto'];
			}
		}
		$lista = isset($lista)?$lista:array();
		return $lista;
	}
	
	function buscarResponsablesPorSucursal($project, $dia=null, $mes=null, $anio=null, $limit=null, $mecanicos=null, $excepcion=null) {
		if(!$project) return array();
		$estadoActivo = 'AC';
		$turno = 'D';
		$sql = "SELECT Secperson.id as \"Secperson__id\", 
						Secperson.appaterno as \"Secperson__appaterno\",
						Secperson.apmaterno as \"Secperson__apmaterno\",
						Secperson.firstName as \"Secperson__firstName\"
						FROM secpeople Secperson INNER JOIN secassigns Secassign ON (Secassign.secperson_id=Secperson.id)
						WHERE Secassign.secproject_id = ".$project['Secproject']['id']." 
						AND Secperson.status = '".$estadoActivo."' 
						AND Secperson.planificar = 1
						AND Secassign.status='AC'
						AND Secperson.id IN (
							SELECT DISTINCT Apppersonalcalendar.secperson_id 
							FROM apppersonalcalendars Apppersonalcalendar 
							WHERE Apppersonalcalendar.state='AC' AND DATE(Apppersonalcalendar.initdatetime) = '".$anio."-".$mes."-".$dia."'
						) ORDER BY Secperson.appaterno ASC";
		$rs = $this->query($sql);
		//pr($rs);
		$mecanicos = array();
		if(!empty($rs)) {
			foreach($rs as $key=>$value) {
				$mecanicos[$key] = $value;
				$mecanicos[$key]['Secperson']['nombreCompleto'] = $value['Secperson']['appaterno']." ".$value['Secperson']['apmaterno'].", ".$value['Secperson']['firstName'];
			}
		}	
		return !empty($mecanicos)?$mecanicos:array();
	}		
	
	function getResponsables(){
		$sql = "SELECT DISTINCT 
						Secperson.id as \"Secperson__id\", 
						Secperson.appaterno as \"Secperson__appaterno\",
						Secperson.apmaterno as \"Secperson__apmaterno\",
						Secperson.firstName as \"Secperson__firstName\"
						FROM secpeople Secperson";
		$responsables = $this->query($sql);
		$lista = array();
		if(!empty($responsables)) {
			foreach($responsables as $key=>$item) {
				$indice = $item['Secperson']['id'];
				$valor = $item['Secperson']['appaterno'].' '.$item['Secperson']['apmaterno'].' '.$item['Secperson']['firstName'];
				$lista[$indice] = $valor;
			}
		}
		return isset($lista) && !empty($lista) ? $lista : array();
	}
	
//	function obtenerNombreCompletoCarscodMecanico($mecanico_id) {
//		app::import('Model', 'Dermecanico'); 		$this->Dermecanico = new Dermecanico;
//		$this->Dermecanico->unbindModel(array('hasMany'=>array('Talcalendariopersonal', 'Talcalendariomecanicoplaneado', 'Talcalendariomecanicoejecutado')));
//		$campos = array('Secperson.carscod');
//		$mecanico = $this->Dermecanico->findById($mecanico_id, $campos);
//		$nombreCompleto = $this->obtenerNombreMecanicoCompleto($mecanico_id);
//		return $nombreCompleto.' '.$mecanico['Secperson']['carscod'];
//	}
//	
//	function obtenerNombreMecanicoCompleto($mecanico_id) {
//		app::import('Model', 'Dermecanico'); 		$this->Dermecanico = new Dermecanico;
//		$this->Dermecanico->unbindModel(array('hasMany'=>array('Talcalendariopersonal', 'Talcalendariomecanicoplaneado', 'Talcalendariomecanicoejecutado')));
//		$campos = array('Secperson.firstName, Secperson.lastName');
//		$mecanico = $this->Dermecanico->findById($mecanico_id, $campos);
//		return $mecanico['Secperson']['nombreCompleto'];
//	}
	
/**check if user and password are real
	 * 
	 * @param object $userId
	 * @param object $password     it has than it was change with Auth
	 * @return 
	 */
	function checkUser($userId, $sendPassword){
		$password = $this->find('first',array(
			'conditions'=>array('1'=>sprintf("Secperson.status = 'AC' AND Secperson.id = %s", $userId)),
			'recursive'=>-1
		));
		
		if(!($password['Secperson']['password'] == $sendPassword)) return array(false,'VERIFIQUE SU CONTRASENIA');
		
		return array(true, 'user real');
	}
	
}