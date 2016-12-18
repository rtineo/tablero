<?php
class SecorganizationsController extends AppController {

	public $name = 'Secorganizations';//llama a la vista
	public $helpers = array('Html','Form','Js');//llama los helpers que va utilizar
	
    public function beforeFilter() {
        parent::beforeFilter();
        //$this->Auth->allow();
    }

	function index() {
		$this->layout = false;
		$this->Secorganization->recursive = 0;
		$elementos = array('Secorganization.code'=>__('codigo',TRUE),'Secorganization.name'=>__('nombre',TRUE));
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
								array('Secorganization.status'=>'DE') :
								array('Secorganization.status'=>'AC');
		
		$conditions = $conditions + $conditionsActivos;
			
		$this->paginate = array('limit' => 10,
								'page' => 1,
								'order' => array ('Secorganization.name' => 'asc'),
								'conditions' => $conditions
								);

		$secorganizations=$this->paginate('Secorganization');
		$this->set('secorganizations', $secorganizations);
	}

	function logisticaindex(){
		$idEmpresa = $this->datosLogeo['0']['Secorganization']['id'];
		$this->set('logistica', $this->Secorganization->find('first', array('conditions'=>array('id'=>$idEmpresa))));
	}
	
	function logisticaedit($id = null){
		$this->layout = 'contenido';
		if(!$id){
			$this->Session->setFlash(__('idNoValido', TRUE),'flash_failure');
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->request->data)) {
				if ($this->Secorganization->save($this->request->data)) {
					$this->Session->setFlash(__('empresaNoValido',true),'flash_failure');
					$this->Session->write('actualizarPadre', true);
				}else{
					$this->Session->setFlash(__('empresaNoValido',true),'flash_failure');
				}
		}
		if (empty($this->data)) {
			$this->request->data = $this->Secorganization->find('first', array('conditions'=>array('id'=>$id)));
		}
		
	}
	
	function view($id = null) {
		$this->layout = 'contenido';
		if (!$id) {
			$this->Session->setFlash(__('empresaNoValido',true),'flash_failure');
			$this->redirect(array('action'=>'index'));
		}
		$this->set('secorganization', $this->Secorganization->read(null, $id));
		$tieneroles = $this->Secorganization->Secrole->find('first', array('conditions' => array('Secrole.secorganization_id' => $id)));
		$this->set('tieneroles',$tieneroles);
		$tienesucursales = $this->Secorganization->Secproject->find('first', array('conditions' => array('Secproject.secorganization_id' => $id)));
		$this->set('tienesucursales',$tienesucursales);
	}

	function add() {
		$this->layout = 'contenido';
		if (!empty($this->data)) {
			$this->Secorganization->create();
			if ($this->Secorganization->save($this->data)) {
				$this->Session->setFlash(__('empresaGuardado', true),'flash_success');
				$this->Session->write('actualizarPadre', true);	
			} else {
				$this->Session->setFlash(__('empresaNoGuardado', true),'flash_failure');
			}
		}
	}

	function edit($id = null) {
		$this->layout = 'contenido';
		if (!$id && empty($this->request->data)) {
			$this->Session->setflash(__('rolNoValido', true),'flash_failure');
			$this->redirect(array('action'=>'index'));
		}
		
		if (!empty($this->request->data)) {
			
			$existSecrole = $this->Secorganization->Secrole->find('count', array('conditions' => array('Secrole.status' => 'AC', 'Secrole.secorganization_id'=>$id)));
			$existSecproject = 	$this->Secorganization->Secproject->find('count', array('conditions' => array('Secproject.status' => 'AC', 'Secproject.secorganization_id'=>$id)));

			if (($existSecrole || $existSecproject) && $this->request->data['Secorganization']['status']=='DE')
			{			
				$this->Session->setFlash(__('empresaAsociada',true),'flash_failure');
			}
			else
			{ 
				if ($this->Secorganization->save($this->request->data)) 
				{
					$this->Session->setFlash(__('empresaGuardado',true),'flash_success');
					$this->Session->write('actualizarPadre', true);
				}
				else 
				{
					$this->Session->setFlash(__('empresaNoGuardado',true),'flash_failure');		
				}						
			}			
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Secorganization->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('empresaNoValido', true),'flash_failure');
		}
		else{			
			//$this->Secorganization->Secrole->secorganization_id = $this->data['Secorganization']['id'];
			$existSecrole = 	$this->Secorganization->Secrole->find('count', array('conditions' => array('Secrole.status' => 'AC', 'Secrole.secorganization_id'=>$id)));		
			$existSecproject = 	$this->Secorganization->Secproject->find('count', array('conditions' => array('Secproject.status' => 'AC', 'Secproject.secorganization_id'=>$id)));
			//pr($secrole);exit;				
			if($existSecrole || $existSecproject)
				{
				$this->Session->setFlash(__('empresaAsociada',true),'flash_failure');				
				}
			else{
					$this->request->data['Secorganization']['id']=$id;
					$this->request->data['Secorganization']['status']='EL';
					if ($this->Secorganization->save($this->request->data)) 
						{
						$this->Session->setFlash(__('empresaDesactivado', true),'flash_success');	
						}
					else 
						{
						$this->Session->setFlash(__('empresaNoDesactivado',true),'flash_failure');		
						}		
				}
		}
		$this->redirect(array('action'=>'menuseguridad'));
	}

	function mostrarroles($id=null) {
		$this->layout = 'contenido';
		if (!$id) {
			$this->Session->setFlash(__('empresaNoValido', true),'flash_failure');
			$this->redirect(array('action'=>'view'));
		}	
		else{			
			$secroles=$this->Secorganization->Secrole->find('all', array('conditions' => array('Secrole.secorganization_id' => $id)));
			$this->set('secroles',$secroles);
			$this->set('secorganization', $this->Secorganization->read(null, $id));		
			}
	}

	function mostrarsucursales($id=null) {
		$this->layout = 'contenido';
		if (!$id) {
			$this->Session->setFlash(__('empresaNoValido', true),'flash_failure');
			$this->redirect(array('action'=>'view'));
		}	
		else{			
			$secprojects=$this->Secorganization->Secproject->find('all', array('conditions' => array('Secproject.secorganization_id' => $id)));
			$this->set('secprojects',$secprojects);
			$this->set('secorganization', $this->Secorganization->read(null, $id));		
			
		}
	}
	
	function menuseguridad(){		
	}
}
?>