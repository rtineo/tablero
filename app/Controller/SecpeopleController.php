<?php
class SecpeopleController extends AppController {

	public $name = 'Secpeople';
	public $helpers = array('Html', 'Form');
	public $uses = array('Secperson','Secconfiguration');
	
    public function beforeFilter() {
        parent::beforeFilter();
        //$this->Auth->allow();
    }
	
	function modificarpasswordusuario($id = null) {
		
		$this->layout = 'contenido';
		if(!empty($this->request->data))
		{
			$configuration = $this->Secconfiguration->find('first',array('fields' => array('minpasswordlength')));
			$this->Secperson->validate = array(					
					'nuevacontrasenia' => array('notempty'),
					'confirmarcontrasenia' => array('notempty'),					
				);
				
			$this->Secperson->set($this->request->data);
			
			if (!$this->Secperson->validates()) {					
			$this->Session->setFlash(__('completeDatos', true),'flash_failure');
			}
			else if($this->request->data['Secperson']['nuevacontrasenia'] != $this->request->data['Secperson']['confirmarcontrasenia'])
			{
				$this->Session->setFlash(__('passwordDiferentes', true),'flash_failure');
				
			}else if (strlen($this->request->data['Secperson']['nuevacontrasenia']) < $configuration['Secconfiguration']['minpasswordlength']) {
										
					$this->Session->setFlash(__('passwordCaracteresMinimo', true).' '.$configuration['Secconfiguration']['minpasswordlength']);
			}
			else
			{				
				$person = $this->Secperson->find('first' ,array('fields' => array('Secperson.password'),
																'conditions' => array('Secperson.id' => $this->request->data['Secperson']['id'])));
																
				$password['Secpassword']['secperson_id'] =$this->request->data['Secperson']['id'];
				$password['Secpassword']['password'] = $person['Secperson']['password'];				
				$password['Secpassword']['creationdatetime'] = date('Y-m-d');
				$password['Secpassword']['status'] = 'DE';				
				
				$this->request->data['Secperson']['password'] = $this->Auth->password(strtolower($this->request->data['Secperson']['nuevacontrasenia']));
				//$this->request->data['Secperson']['expirationdate'] = date('Y-m-d');
				
				$this->Secperson->begin();
						
				$this->Secperson->Secpassword->create();
				if($this->Secperson->save($this->request->data) && $this->Secperson->Secpassword->save($password))
				{				
					$this->Secperson->commit();
					$this->Session->write('actualizarPadre', true);	
					$this->Session->setFlash(__('personaGravoModificacionContrasenia', true),'flash_success');
				}
				else
				{				
					$this->Secperson->rollback();
					$this->Session->setFlash(__('personaNoGravoModificacionContrasenia', true),'flash_failure');
				}
			}
		}
		$id = isset($id)?$id:$this->request->data['Secperson']['id'];
		$this->request->data = $this->Secperson->find('first' ,array('conditions' => array('Secperson.id' => $id)));;
		$usuario =  $this->request->data['Secperson']['appaterno'].' '.$this->request->data['Secperson']['apmaterno'].', '.$this->request->data['Secperson']['firstname'];
		$this->set('usuario' , $usuario);														
		unset($this->request->data['Secperson']['nuevacontrasenia']);
		unset($this->request->data['Secperson']['confirmarcontrasenia']);
	}	
	
	function modificarpassword() {
		$this->layout = 'contenido';
		
		$this->Secperson->validate = array(
					'username' => array('notempty'),
					'password' => array('notempty'),
					'nuevacontrasenia' => array('notempty'),
					'confirmarcontrasenia' => array('notempty'),					
				);
				
		$this->Secperson->set($this->request->data);
		
		if (!$this->Secperson->validates()) {					
			$this->Session->setFlash(__('completeDatos', true),'flash_failure');
		}
		
		$this->Secperson->recursive = -1;
		$secperson = $this->Secperson->find('first',array('conditions' => array('Secperson.username' => $this->request->data['Secperson']['username'],
											'Secperson.password' => $this->Auth->password($this->request->data['Secperson']['password']))));
		
		if(!empty($secperson) && !empty($this->request->data['Secperson']['nuevacontrasenia']) && !empty($this->request->data['Secperson']['confirmarcontrasenia'])
			&& ($this->request->data['Secperson']['nuevacontrasenia'] == $this->request->data['Secperson']['confirmarcontrasenia']))
		{			
			$password['Secpassword']['secperson_id'] = $secperson['Secperson']['id'];
			$password['Secpassword']['password'] = $this->Auth->password($this->request->data['Secperson']['password']);
			$password['Secpassword']['creationdatetime'] = date('Y-m-d');
			$password['Secpassword']['status'] = 'DE';
			
			$this->request->data['Secperson']['id'] = $secperson['Secperson']['id'];
			$this->request->data['Secperson']['password'] = $this->Auth->password($this->request->data['Secperson']['nuevacontrasenia']);
			$this->request->data['Secperson']['expirationdate'] = date('Y-m-d');

			$this->Secperson->begin();
						
			$this->Secperson->Secpassword->create();
			if($this->Secperson->save($this->request->data) && $this->Secperson->Secpassword->save($password))
			{				
				$this->Secperson->commit();
				$this->Session->setFlash(__('personaGravoModificacionContrasenia', true),'flash_success');
			}
			else
			{				
				$this->Secperson->rollback();
				$this->Session->setFlash(__('personaNoGravoModificacionContrasenia', true),'flash_failure');
			}
		}else if($this->request->data['Secperson']['nuevacontrasenia'] != $this->request->data['Secperson']['confirmarcontrasenia'])
		{
			$this->Session->setFlash(__('passwordDiferentes', true),'flash_failure');
		}
		
		unset($this->request->data['Secperson']['password']);
		unset($this->request->data['Secperson']['nuevacontrasenia']);
		unset($this->request->data['Secperson']['confirmarcontrasenia']);
		
	}
	
	function index($paginador=null) {
		$this->set('paginador',$paginador);		

		$this->layout = false;
		$this->Secperson->recursive = -1;
		$elementos = array('Secperson.username'=>__('usuario', TRUE),
						   'Secperson.appaterno'=>__('apellidoPaterno', TRUE),
						   'Secperson.apmaterno'=>__('apellidoMaterno', TRUE)
						   );
		$this->set('elementos',$elementos);	
		
		if(!empty($this->params['named']['valor']) || !empty($this->params['named']['desactivo']))
		{
			$this->request->data['Buscar']['buscador'] = $this->params['named']['buscador'];
			$this->request->data['Buscar']['valor'] = $this->params['named']['valor'];
			$this->request->data['Buscar']['desactivo'] = $this->params['named']['desactivo'];
		}
		
		$valorDeBusqueda = isset($this->request->data['Buscar']['valor'])?trim($this->request->data['Buscar']['valor']):null;
		$conditions = !empty($valorDeBusqueda)?
						array($this->request->data['Buscar']['buscador'].' LIKE'=>'%'.trim($this->request->data['Buscar']['valor']).'%'):
						array();		
		
		$conditionsActivos = (!empty($this->request->data['Buscar']['desactivo']) == 1) ?
								array('Secperson.status'=>'DE') :
								array('Secperson.status'=>'AC');
		
		$conditions = $conditions + $conditionsActivos;
					
		$this->paginate = array('limit' => 10,
								'page' => 1,
								'order' => array ('Secperson.appaterno' => 'asc'),
								'conditions' => $conditions
								);

		$secpeople=$this->paginate('Secperson');
		$this->set('secpeople',$secpeople);
		//pr($secpeople);
	}

	function view($id = null) {
		$this->layout = 'contenido';
		if (!$id) {
			$this->Session->setFlash(__('personaNoValida', true),'flash_failure');
			$this->redirect(array('action'=>'index'));
		}
		
		//busqueda de los nombres de los roles, sucursales asociados a la persona
		//Nos da los id de las organizaciones
		$personId = $this->Secperson->Secassign->find('all', 
						array(	'conditions' => array('Secassign.secperson_id'=> $id, 'Secassign.status'=>'AC'), 
								'recursive' => 0,
								'fields' => array('Secproject.secorganization_id',
												  'Secproject.name',
												  'Secrole.name'),
							));

		//conseguimos el nombre organizacion
		foreach($personId as $Key => $Value){
			
			$personEmpresa =
			$this->Secperson->Secassign->Secproject->Secorganization->find('all', 
						array(	'conditions' => array('Secorganization.id'=>$Value['Secproject']['secorganization_id']), 
								'recursive' => 0,
								'fields' => array('Secorganization.name'))
								); 
								
			$personId[$Key]['Secorganization']['name'] = $personEmpresa[0]['Secorganization']['name'];
		}
		
		$this->set('personDetalle',$personId);
		$this->Secperson->recursive = -1;
		$this->set('secperson', $this->Secperson->read(null, $id));
	}

	function add() {
		$this->layout = 'contenido';
		if (!empty($this->request->data)) {			
			//Seteamos los datos para poder utilizar la funcion validates
			$this->Secperson->set($this->request->data);
			
			//Validamos que todo los datos este correcto
			$creacion = $this->request->data['Secperson']['creationdate'];
			$expiracion= $this->request->data['Secperson']['expirationdate'];
			$this->request->data['Secperson']['creationdate'] = $this->Secperson->configurarFechaYMD($creacion);
			$this->request->data['Secperson']['expirationdate'] = $this->Secperson->configurarFechaYMD($expiracion);
			
			if (!$this->Secperson->validates()) {					
				$errors = $this->Secperson->validationErrors;
				debug($this->request->data['Secperson']);
				debug($errors);
				$this->request->data['Secperson']['creationdate'] = $creacion;
				$this->request->data['Secperson']['expirationdate'] = $expiracion;
				$this->Session->setFlash(__('personaNoGuardada', true),'flash_failure');
			}
			else
			{
				$configuration = $this->Secconfiguration->find('first',array('fields' => array('minpasswordlength')));
				// validamos que el password sea mayor o igual que la cantidad de caractreres configurados en configuratiosn
				if (strlen($this->request->data['Secperson']['password']) < $configuration['Secconfiguration']['minpasswordlength']) {
					$this->request->data['Secperson']['creationdate'] = $creacion;
					$this->request->data['Secperson']['expirationdate'] = $expiracion;					
					$this->Session->setFlash(__('passwordCaracteresMinimo', true).' '.$configuration['Secconfiguration']['minpasswordlength']);
				}
				else
				{					
					
					$this->Secperson->create();
					$this->request->data['Secperson']['password'] = $this->Auth->password(strtolower($this->request->data['Secperson']['password']));
					$creacion = $this->request->data['Secperson']['creationdate'];
					$expiracion= $this->request->data['Secperson']['expirationdate'];
					if($creacion >= $expiracion){
						$this->request->data['Secperson']['creationdate'] = $creacion;
						$this->request->data['Secperson']['expirationdate'] = $expiracion;
						$this->Session->setFlash(__('personaControlFecha'),'flash_failure');				
					}	
					else{
						if ($this->Secperson->save($this->request->data)) {
							$this->Session->setFlash(__('personaGuardada'),'flash_success');
							$this->Session->write('actualizarPadre', true);	
						} else {
							$this->request->data['Secperson']['creationdate'] = $creacion;
							$this->request->data['Secperson']['expirationdate'] = $expiracion;
							$this->Session->setFlash(__('personaNoGuardada'),'flash_failure');
						}
					}
				}
			}			
		}
		$this->request->data['Secperson']['password']='';
		
		//Incrementamos un dia a la fecha de expiracion
		$expirationdate = date("d-m-Y",strtotime(date("d-m-Y")) + (86400));		
		$this->request->data['Secperson']['expirationdate']['day'] = date('d',strtotime($expirationdate));
		$this->request->data['Secperson']['expirationdate']['month'] = date('m',strtotime($expirationdate));
		$this->request->data['Secperson']['expirationdate']['year'] = date('Y',strtotime($expirationdate));
	}

	function edit($id = null) {
		$this->layout = 'contenido';
				
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('personaNoValida', true),'flash_failure');
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->request->data)) {
						
				$dependientes = $this->Secperson->Secassign->find('count', 
							array('conditions' => array('Secassign.secperson_id' => $id, 'Secassign.status'=>'AC')));
							
				if(!$dependientes || ($this->request->data['Secperson']['status']=='AC')||($this->request->data['Secperson']['status']=='LI')){
					$creacion = $this->request->data['Secperson']['creationdate'];
					$expiracion= $this->request->data['Secperson']['expirationdate'];
					if($creacion >= $expiracion){
						$this->Session->setFlash(__('personaControlFecha', true),'flash_failure');				
					}
					else{
						$this->loadModel('Aro');
						$this->loadModel('Secassign');
						$this->Secperson->begin();
						
						$asignacciones = $this->Secassign->find('all',array('fields' => array('id'),
																			'conditions' => array('secperson_id' => $id,'status' => 'AC'),
																			'recursive' => -1
																			));
						foreach($asignacciones as $asignacion){ 						
							$aro = $this->Aro->find('first',array('fields' => array('id'),'conditions' => array('foreign_key' => $asignacion['Secassign']['id'],'model' => 'Secassign')));
							$this->Aro->id = $aro['Aro']['id'];
							if (!$this->Aro->saveField('alias',$this->request->data['Secperson']['username'])) {
								$this->Secperson->rollback();							
								$this->Session->setFlash(__('personaNoGuardada', true),'flash_failure');
							}
						}
						$this->request->data['Secperson']['creationdate'] = $this->Secperson->configurarFechaYMD($creacion);
						$this->request->data['Secperson']['expirationdate'] = $this->Secperson->configurarFechaYMD($expiracion);
						if ($this->Secperson->save($this->request->data)) {
							$this->Secperson->commit();
							$this->Session->setFlash(__('personaGuardada', true),'flash_success');
							$this->Session->write('actualizarPadre', true);	
						} else {
							$this->Secperson->rollback();
							$this->Session->setFlash(__('personaNoGuardada', true),'flash_failure');
						}
						
					}
				}else{
					$this->Session->setFlash(__('personaAsociada', true),'flash_failure');
				}	
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Secperson->read(null, $id);
			$this->request->data['Secperson']['creationdate'] = $this->Secperson->getFechaDMY($this->request->data['Secperson']['creationdate']);
			$this->request->data['Secperson']['expirationdate'] = $this->Secperson->getFechaDMY($this->request->data['Secperson']['expirationdate']);
		}	
		
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setflash(__('personaNoValida', true),'flash_failure');
			
		}else{
			$dependientes = $this->Secperson->Secassign->find('count', 
						array('conditions' => array('Secassign.secperson_id' => $id, 'Secassign.status'=>'AC')));
			
			if(!$dependientes){			
				$this->request->data['Secperson']['id'] = $id;
				$this->request->data['Secperson']['status']= 'DE';
				if($this->Secperson->save($this->request->data)){			
					$this->Session->setFlash(__('personaDesactivada', true),'flash_success');	
					$this->redirect(array('controller'=>'Secorganizations', 'action'=>'menuseguridad'));			
				}
				else{
					$this->Session->setFlash(__('personaNoDesactivada', true),'flash_failure');
					$this->redirect(array('controller'=>'Secorganizations', 'action'=>'menuseguridad'));
				}
			}else{
				$this->Session->setFlash(__('personaAsociada', true),'flash_failure');
				$this->redirect(array('controller'=>'Secorganizations', 'action'=>'menuseguridad'));
			}
			
		}
	}

	function getUserListaJson() {
		Configure::write('debug',0);
		$this->layout = 'ajax';
		$userLista = $this->Secperson->getUserListaJson($this->params['url']['term']);
		
		echo $userLista;
		$this->autoRender = false;
	}

}
?>