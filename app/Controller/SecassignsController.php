<?php
App::uses('AppController', 'Controller');

class SecassignsController extends AppController {
	public $name = 'Secassigns';
    //public $components = array('RequestHandler');
	public $helpers = array( 'Html','Form','Js');	

    public function beforeFilter() {
        parent::beforeFilter();
        //$this->Auth->allow('login','asignacion');
    }
    
    public function login() {
    	$this->layout = 'inicio';
		if($this->request->is('post')) {
            if($this->Auth->login()) {
				return $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Username o password es incorrecto'), 'default', array(), 'auth');
            }
        }
    }
	
	function permisoparaaprobar(){
		$elementos = array('Secperson.username'=>__('usuario', TRUE),
						   'Secperson.appaterno'=>__('apellidoPaterno', TRUE),
						   'Secperson.apmaterno'=>__('apellidoMaterno', TRUE)
						   );
		$this->set('elementos',$elementos);
										  
		$publiciablePaginador = $this->Secassign->getpubliciablesPaginadorAprobacionCorreo($this->request->data,$this->request->params,$this->datosLogeo);
		
		$this->paginate = $publiciablePaginador['publiciablesPaginador'];		
		$this->request->data = $publiciablePaginador['data'];		
		$secpeople = $this->paginate('Secperson');	
		$this->set('secpeople',$secpeople);
		
	}
	
	public function aprobarcorreo($secpersonId){
		if($secpersonId){
			$rpta = $this->Secassign->setGuardarAprobacionCorreo($secpersonId);			
			if($rpta['rpta'] == true){
				$this->Session->setFlash($rpta['msj'],'flash_success');						
			}else{
				$this->Session->setFlash($rpta['msj'],'flash_failure');
			}
		}
	
		$this->redirect(array('action' => 'permisoparaaprobar/buscador:'.$this->params['named']['buscador'].'/valor:'.$this->params['named']['valor'].'/page:'.$this->params['named']['page']));
	}
	
	public function asignacion() {
		
		$this->layout = 'asignacion';		
		$conditions = array('Secperson.username' => $this->request->data['Secperson']['username'],
							'Secperson.password' => $this->Auth->password(strtolower($this->request->data['Secperson']['password'])));
							//'Secperson.password' => AuthComponent::password(strtolower($this->request->request->data['Secperson']['password'])));							
//		debug($this->Auth->password(strtolower($this->request->data['Secperson']['password']))); die;
		//Obtenemos los id de las organizaciones en donde esta registrado				
		$organizations = $this->Secassign->find('all', array('fields' => array('Secrole.secorganization_id'),
														'conditions' => $conditions
														)
												);//aqui no entra
		//pr($organizations);exit();//para deguguear
		//pr(array('organization'=>$organizations));
		if(empty($organizations))//aqui te redirige al login
		{			
			$this->Session->setFlash(__('verifiqueDatos', true),'flash_failure');
			$this->redirect(array('action' => 'login'));
		}
				
		/*******Para obtener el id de las organizaciones*******************/	
		foreach($organizations as $organizacion)		
			$secorganizationIds[$organizacion['Secrole']['secorganization_id']] = $organizacion['Secrole']['secorganization_id'];	
		
		$secorganization_ids = implode(",", $secorganizationIds);		
				
		$secorganizations = $this->Secassign->Secproject->Secorganization->find('list',array('conditions' => array('id IN ('.$secorganization_ids.')'),
																							 'order' => 'name'));
		/************************************************************/
					
		foreach($secorganizations as $key => $value) break;		
		//$key = 4;		
		/*******Para obtener el id de las asignaciones*******************/	
		$secassigns = $this->Secassign->find('all', array( 'fields' => array('Secassign.id'),
														'conditions' => $conditions
														)
												);
		//pr($secassigns);
		foreach($secassigns as $secassign)		
			$secassignIds[$secassign['Secassign']['id']] = $secassign['Secassign']['id'];	
		
		$secassign_ids = implode(",", $secassignIds);
		/************************************************************/
		
		
		$projects = $this->Secassign->find('all',array(	'fields' => array('Secproject.id','Secproject.name'),
															'conditions' => array( 'Secproject.secorganization_id' => $key,'Secproject.status'=>'AC',
																				   'Secassign.id IN ('.$secassign_ids.')')));
																				   
		
		foreach($projects as $value)
			$secprojects[$value['Secproject']['id']] = $value['Secproject']['name'];		
		
		//pr($secprojects);
		$roles = $this->Secassign->find('all',array('fields' => array('Secrole.id','Secrole.name'),
															'conditions' => array( 'Secproject.secorganization_id' => $key,'Secproject.id'=>$projects[0]['Secproject']['id'],
																				   'Secassign.id IN ('.$secassign_ids.')')));
		//pr($roles);		exit();																		   
		foreach($roles as $value)
			$secroles[$value['Secrole']['id']] = $value['Secrole']['name'];
					
		$this->set(compact('secorganizations','secprojects', 'secroles'));
		
	
	}
	
	function listprojects($username=null,$password=null)
	{
		$this->layout = "ajax";
		Configure::write('debug', '1');
		$secprojects = array();
		if(!empty($username) && !empty($password))
		{
			$conditions = array('Secperson.username' => $username,
							'Secperson.password' => $this->Auth->password(strtolower($password)));
							
			/*******Para obtener el id de las asignaciones*******************/	
			$secassigns = $this->Secassign->find('all', array( 'fields' => array('Secassign.secproject_id'),
															'conditions' => $conditions
															)
													);
			//pr($secassigns);
			foreach($secassigns as $secassign)		
				$secprojectIds[$secassign['Secassign']['secproject_id']] = $secassign['Secassign']['secproject_id'];	
			
			$secproject_ids = implode(",", $secprojectIds);
			/************************************************************/
			
			$projects = $this->Secassign->Secproject->find('all',array(	'fields' => array('Secproject.id','Secproject.name'),
																'conditions' => array( 'Secproject.secorganization_id' => $this->request->data['Secorganization']['id'],
																					    'Secproject.ids IN ('.$secproject_ids.')'
																						)));
		}else{
			if(!empty($this->request->data)){
				$projects = $this->Secassign->Secproject->find('all',array(	'fields' => array('Secproject.id','Secproject.name'),
															'conditions' => array( 'Secproject.secorganization_id' => $this->request->data['Secorganization']['id'])));
			}
		}		
		
		foreach($projects as $value)
			$secprojects[$value['Secproject']['id']] = $value['Secproject']['name'];
		//$secprojects =  $this->Secassign->Secproject->find('list',array('conditions' => array('Secproject.secorganization_id' => $this->request->data['Secorganization']['id'])));
		
		$this->set('secprojects',$secprojects);
	}
	
	function listroles($username=null,$password=null,$secprojectId=null)
	{
		$this->layout = "ajax";
		Configure::write('debug', '0');
		$roles = array();
		if(!empty($username) && !empty($password))//no entra vacio
		{
			$conditions = array('Secperson.username' => $username,
								'Secperson.password' => $this->Auth->password(strtolower($password)));
								
			/*******Para obtener el id de las asignaciones*******************/	
			$secassigns = $this->Secassign->find('all', array( 'fields' => array('Secassign.secrole_id'),
															'conditions' => $conditions
															)
													);
			//pr($secassigns);
			foreach($secassigns as $secassign)		
				$secroleIds[$secassign['Secassign']['secrole_id']] = $secassign['Secassign']['secrole_id'];	
			
			$secrole_ids = implode(",", $secroleIds);
			/************************************************************/
			if(isset($secprojectId)){
				$secperson= $this->Secassign->Secperson->find('first',array('conditions'=>$conditions));
				$roles = $this->Secassign->find('all',array('fields' => array('Secrole.id','Secrole.name'),
																'conditions' => array('Secassign.secproject_id' => $secprojectId,
																					'Secassign.status'=>'AC',
																					'Secperson.id'=>$secperson['Secperson']['id'])));
			}else{
				$roles = $this->Secassign->Secrole->find('all',array('fields' => array('Secrole.id','Secrole.name'),
																'conditions' => array( 'Secrole.secorganization_id' => $this->request->data['Secorganization']['id'],
																					    'Secrole.id IN ('.$secrole_ids.')')));
			}
		}else{
			if(!empty($this->request->data)){
				$roles = $this->Secassign->Secrole->find('all',array('fields' => array('Secrole.id','Secrole.name'),
																'conditions' => array( 'Secrole.secorganization_id' => $this->request->data['Secorganization']['id'])));
			}
		}

		foreach($roles as $value)
			$secroles[$value['Secrole']['id']] = $value['Secrole']['name'];

		//$secprojects =  $this->Secassign->Secproject->find('list',array('conditions' => array('Secproject.secorganization_id' => $this->request->data['Secorganization']['id'])));
		$this->set('secroles',$secroles);
	}
	 
	function logout() {
		$this->Session->delete('User');	   
		$this->redirect($this->Auth->logout());
	}
	
	/**
	 * Permite listar todas las asignaciones
	 * @modifiedBy Jorge G. Trujillo V.
	 * @version 0.2 2012-04-20 15:24
	 */
	function index() {
		$this->layout = false;
		
		// se obtienen los datos a ser cargados en los elementos HTML select
		$this->Secassign->recursive = -1;
		$elementos = array(
			'Secorganization.name' => __('organizacion', true),
			'Secproject.name' => __('sucursal', true),
			'Secrole.name' => __('rol', true),
			'Secperson.appaterno' => __('apellidoPaterno', true),
			'Secperson.username' => __('usuario', true)
		);
		$this->set('elementos', $elementos);
		
		// se obtienen los valores del buscador
		if(!empty($this->params['named']['valor']) || !empty($this->params['named']['desactivo'])) {
			$this->request->data['Buscar']['buscador'] = $this->params['named']['buscador'];
			$this->request->data['Buscar']['valor'] = $this->params['named']['valor'];
			$this->request->data['Buscar']['desactivo'] = $this->params['named']['desactivo'];
		}
		
		// se establecen las condiciones de busqueda
		$conditions = array();
		if(!empty($this->request->data['Buscar']['buscador']))
		{
					if($this->request->data['Buscar']['buscador'] == 'Secorganization.name') {
			$condicion = array(
				'status' => 'AC', 
				$this->request->data['Buscar']['buscador'].' LIKE' => '%'.$this->request->data['Buscar']['valor'].'%'
			);
			$organizaciones = $this->Secassign->Secproject->Secorganization->find('all', array(
				'conditions' => $condicion, 
				'fields' => 'Secorganization.id', 
				'order' => 'Secorganization.name'
			));
			foreach($organizaciones as $key => $item) {
				$ids_organizations[$key] = $item['Secorganization']['id'];
			}
			$ids_organizations = implode(',', $ids_organizations);
			$conditions += array('Secproject.secorganization_id IN ('.$ids_organizations.')');
		} else {
			$conditions += !empty($this->request->data['Buscar']['valor']) ? array($this->request->data['Buscar']['buscador'].' LIKE' => '%'.$this->request->data['Buscar']['valor'].'%') : array();
		}
		}

		$conditions += (!empty($this->request->data['Buscar']['desactivo']) == 1) ? array('Secassign.status' => 'DE') : array('Secassign.status' => 'AC');
		
		// se obtienen los registros
		$this->paginate = array(
			'conditions' => $conditions, 
			'fields' => array(
				'Secassign.id', 
				'Secassign.status', 
				'Secperson.id', 
				'Secperson.firstname', 
				'Secperson.appaterno', 
				'Secperson.apmaterno', 
				'Secperson.username', 
				'Secperson.email', 
				'Secproject.id', 
				'Secproject.secorganization_id', 
				'Secproject.code', 
				'Secproject.name', 
				'Secrole.id', 
				'Secrole.code', 
				'Secrole.name'
			), 
			'recursive' => 0, 
			'order' => array('Secassign.id' => 'desc'), 
			'limit' => 10, 
			'page' => 1
		);
		$secassigns = $this->paginate();
		
		// se obtiene la organizacion de los registros obtenidos
		foreach($secassigns as $key => $row) {
			$this->Secassign->Secproject->Secorganization->recursive = -1;			
			$secorganization = $this->Secassign->Secproject->Secorganization->find('first', array(
				'conditions' => array('Secorganization.id' => $row['Secproject']['secorganization_id']), 
				'fields' => array(
					'Secorganization.id', 
					'Secorganization.code', 
					'Secorganization.name'
				)
			));
			$secassigns[$key]['Secorganization'] = $secorganization['Secorganization'];
		}
		
		$this->set('secassigns', $secassigns);
	}

	function view($id = null) {
		$this->layout = 'contenido';
		if (!$id) {
			$this->Session->setFlash(__('asignacionNoValida', true),'flash_failure');
			$this->redirect(array('action'=>'index'));
		}
		$secassign = $this->Secassign->read(null, $id);
		
		$this->Secassign->Secproject->Secorganization->recursive = -1;			
		$secorganization = $this->Secassign->Secproject->Secorganization->find('first',
								array('conditions' => array('Secorganization.id' => $secassign['Secproject']['secorganization_id'])));
		
		$secassign['Secorganization'] = $secorganization['Secorganization'];		
		
		$this->set('secassign',$secassign);
	}

	public function add() {
		$this->layout = 'contenido';
		if (!empty($this->request->data)) {
			if(empty($this->request->data['Secassign']['secperson_id']) || empty($this->request->data['Secorganization']['id']) || empty($this->request->data['Secassign']['secproject_id']) || empty($this->request->data['Secassign']['secrole_id'])){
				$this->Session->setFlash(__('asignacionNoGuardada'),'flash_failure');
			}else{
				if($this->Secassign->unicAssign($this->request->data)){
					$this->Secassign->create();
					if ($this->Secassign->save($this->request->data)) {
						$this->Session->setFlash(__('asignacionGuardada'),'flash_success');
						$this->Session->write('actualizarPadre', true);	
					} else {
						$this->Session->setFlash(__('asignacionNoGuardada'),'flash_failure');
					}
				}else{
					$this->Session->setFlash(__('registroDuplicadoAsignacion'),'flash_failure');
				}
				
			}
		}
		
		// Lista las personas de estado AC
		$this->Secassign->Secperson->recursive = -1;
		$personas = $this->Secassign->Secperson->find('all', array('fields' => array('id','appaterno','apmaterno','firstname') ,
																  'conditions' => array('status' => 'AC'),
																  'order' => 'appaterno'));
		//Forma en un array a las $personas para el combo														  
		foreach($personas as $persona)
		{
			$secpeople[$persona['Secperson']['id']] = $persona['Secperson']['appaterno'].
											' '.$persona['Secperson']['apmaterno'].
											', '.$persona['Secperson']['firstname'];
		}
		
		//Lista las organizaciones que tengan estado AC
		$this->Secassign->Secproject->Secorganization->recursive = -1;	
		$secorganizations = $this->Secassign->Secproject->Secorganization->find('list',array('conditions' => array('status' => 'AC')));
		
		//Eliminar las organizaciones que carecen de sucursal o rol
		foreach($secorganizations as $id => $row)
		{
			$this->Secassign->Secproject->recursive = -1;
			$nroSucursale = $this->Secassign->Secproject->find('count', array('conditions' => array('Secproject.status' => 'AC','Secproject.secorganization_id' => $id)));
			$nroRoles = $this->Secassign->Secrole->find('count', array('conditions' => array('Secrole.status' => 'AC','Secrole.secorganization_id' => $id)));
			if($nroSucursale == 0 || $nroRoles == 0)
				unset($secorganizations[$id]);
		}		
			
		foreach($secorganizations as $key => $value) break;
		
		$this->Secassign->Secproject->recursive = -1;	
		$secprojects = $this->Secassign->Secproject->find('list',array('conditions' => array('Secproject.status' => 'AC',
																							 'Secproject.secorganization_id' => $key)));
		$this->Secassign->Secrole->recursive = -1;
		$secroles = $this->Secassign->Secrole->find('list',array('conditions' => array('Secrole.status' => 'AC',
																					   'Secrole.secorganization_id' => $key),
																 'order' => 'Secrole.name'));
		$this->set(compact('secorganizations','secpeople', 'secprojects', 'secroles'));
	}

	public function edit($id = null) {
		$this->layout = 'contenido';
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('asignacionNoValida', true),'flash_failure');
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->request->data)) {
			if($this->Secassign->unicAssign($this->request->data)){
				if ($this->Secassign->save($this->request->data)) {
					$this->Session->setFlash(__('asignacionGuardada', true),'flash_success');
					$this->Session->write('actualizarPadre', true);	
				} else {
					$this->Session->setFlash(__('asignacionNoGuardada', true),'flash_failure');
				}
			}else{
				$this->Session->setFlash(__('registroDuplicadoAsignacion'),'flash_failure');
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Secassign->read(null, $id);
			
			$secorganization = $this->Secassign->Secproject->Secorganization->find('first',
								array('conditions' => array('Secorganization.id' => $this->request->data['Secproject']['secorganization_id'])));
		
			$this->request->data['Secorganization'] = $secorganization['Secorganization'];			
		}
		
		// Lista las personas de estado AC
		$this->Secassign->Secperson->recursive = -1;
		$personas = $this->Secassign->Secperson->find('all', array('fields' => array('id','appaterno','apmaterno','firstname') ,
																  'conditions' => array('status' => 'AC'),
																  'order' => 'appaterno'));
		//Forma en un array a las $personas para el combo														  
		foreach($personas as $persona)
		{
			$secpeople[$persona['Secperson']['id']] = $persona['Secperson']['appaterno'].
											' '.$persona['Secperson']['apmaterno'].
											', '.$persona['Secperson']['firstname'];
		}
		
		//Lista las organizaciones que tengan estado AC
		$this->Secassign->Secproject->Secorganization->recursive = -1;	
		$secorganizations = $this->Secassign->Secproject->Secorganization->find('list',array('conditions' => array('status' => 'AC')));
		
		//Eliminar las organizaciones que carecen de sucursal o rol
		foreach($secorganizations as $id => $row)
		{
			$this->Secassign->Secproject->recursive = -1;
			$nroSucursale = $this->Secassign->Secproject->find('count', array('conditions' => array('Secproject.status' => 'AC','Secproject.secorganization_id' => $id)));
			$nroRoles = $this->Secassign->Secrole->find('count', array('conditions' => array('Secrole.status' => 'AC','Secrole.secorganization_id' => $id)));
			if($nroSucursale == 0 || $nroRoles == 0)
				unset($secorganizations[$id]);
		}		
		
		$this->Secassign->Secproject->recursive = -1;	
		$secprojects = $this->Secassign->Secproject->find('list',array('conditions' => array('Secproject.status' => 'AC',
																							 'Secproject.secorganization_id' => $this->request->data['Secorganization']['id'])));
		$this->Secassign->Secrole->recursive = -1;
		$secroles = $this->Secassign->Secrole->find('list',array('conditions' => array('Secrole.status' => 'AC',
																					   'Secrole.secorganization_id' => $this->request->data['Secorganization']['id']),
																 'order' => 'Secrole.name'));														   

		$this->set(compact('secorganizations','secpeople', 'secprojects', 'secroles'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('asignacionNoValida', true),'flash_failure');
			}
		else			
		{	$this->Secassign->recursive = -1;
			$this->request->data = $this->Secassign->find('first',array('conditions' => array('id' => $id)));
			$this->request->data['Secassign']['status']='DE';
		
			if ($this->Secassign->save($this->request->data)) {
				$this->Session->setFlash(__('asignacionDesactivado', true),'flash_success');	
			}
			else 
			{	$this->Session->setFlash(__('asignacionNoDesactivado',true),'flash_failure');		
			}
		}
		$this->redirect(array('controller'=>'Secorganizations', 'action'=>'menuseguridad'));
	}

}
?>
