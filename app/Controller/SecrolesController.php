<?php
class SecrolesController extends AppController {

	public $name = 'Secroles';
	public $helpers = array('Html', 'Form');

    public function beforeFilter() {
        parent::beforeFilter();
        //$this->Auth->allow();
    }
	
	function index() {
		$this->layout = false;
		$this->Secrole->recursive = 0;
		$elementos = array('Secorganization.name'=>__('organizacion',TRUE),
							'Secrole.code'=>__('codigo',TRUE),
							'Secrole.name'=>__('rol',TRUE));
		$this->set('elementos',$elementos);		
		
		if(!empty($this->request->url['named']['valor']) || !empty($this->request->url['named']['desactivo']))
		{
			$this->request->data['Buscar']['buscador'] = $this->request->url['named']['buscador'];
			$this->request->data['Buscar']['valor'] =$this->request->url['named']['valor'];
			$this->request->data['Buscar']['desactivo'] = $this->request->url['named']['desactivo'];
		}
		
		$valorDeBusqueda = isset($this->request->data['Buscar']['valor'])?trim($this->request->data['Buscar']['valor']):null;
		$conditions = !empty($valorDeBusqueda)?
						array($this->request->data['Buscar']['buscador'].' LIKE'=>'%'.trim($this->request->data['Buscar']['valor']).'%'):
						array();		
		
		$conditionsActivos = (!empty($this->request->data['Buscar']['desactivo']) == 1) ?
								array('Secrole.status'=>'DE') :
								array('Secrole.status'=>'AC');
		
		$conditions = $conditions + $conditionsActivos;
		$fields=array('Secrole.id','Secrole.code','Secrole.name','Secrole.status','Secorganization.name');
			
		$this->paginate = array('limit' => 10,
								'page' => 1,
								'order' => array ('Secrole.name' => 'asc'),
								'conditions' => $conditions,
								'fields' => $fields
								);
			
		$secroles = $this->paginate('Secrole');
		$this->set('secroles', $secroles);
	}

	function view($id = null) {
		$this->layout = 'contenido';
		if (!$id) {
			$this->Session->setflash(__('rolNoValido', true),'flash_failure');
			$this->redirect(array('action'=>'index'));
		}
		$this->set('secrole', $this->Secrole->read(null, $id));
	}

	function add() {		
		$this->layout = 'contenido';		
		if (!empty($this->request->data)) {
			$this->Secrole->create();
			if ($this->Secrole->save($this->request->data)) {
				$this->Session->setflash(__('rolGuardado'),'flash_success');
				$this->Session->write('actualizarPadre', true);
			} else {
				$this->Session->setflash(__('rolNoGuardado'),'flash_failure');
			}
		}
		
		$secorganizations = $this->Secrole->Secorganization->find('list',array('conditions'=>array('Secorganization.status'=>'AC')));
		$this->set(compact('secorganizations'));
	
	}

	function edit($id = null) {
		$this->layout = 'contenido';
		if (!$id && empty($this->request->data)) {
			$this->Session->setflash(__('rolNoValido', true),'flash_failure');
			$this->redirect(array('action'=>'index'));
		}
		
		if (!empty($this->request->data)) {
			
			$existSecassign = $this->Secrole->Secassign->find('count', array('conditions' => array('Secassign.status' => 'AC', 'Secassign.secrole_id'=>$id)));
			//pr($this->request->data);exit;
			if ($existSecassign and $this->request->data['Secrole']['status']=='DE')
			//$this->request->data['Secperson']['estado']=='AC';
			{			
				$this->Session->setFlash(__('rolAsociado',true),'flash_failure');
			}
			else
			{ 	
				$statusempresa = $this->Secrole->Secorganization->find('first',
																		array('conditions'=>array('Secorganization.id'=>$this->request->data['Secrole']['secorganization_id']),
																			  'fields'=>array('Secorganization.status')));
				
				if(($statusempresa =='DE') && (($this->request->data['Secrole']['status']!== 'AC') || ($this->request->data['Secrole']['status']!=='LI'))){
					$this->Session->setFlash(__('rolEmpDesactivada',true),'flash_success');	
					//$this->request->data['Secrole']['status']= 'DE';	
				}
				else{
					if ($this->Secrole->save($this->request->data)) 
					{
						$this->Session->setFlash(__('rolGuardado', true),'flash_success');
						$this->Session->write('actualizarPadre', true);
					}
					else 
					{
						$this->Session->setFlash(__('rolNoGuardado',true),'flash_failure');		
					}
				}
			}			
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Secrole->read(null, $id);
		}
		$secorganizations = $this->Secrole->Secorganization->find('list');
		$this->set(compact('secorganizations'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('rolNoValido', true),'flash_failure');
		}
		else{
			$existSecrole = $this->Secrole->Secassign->find('count', array('conditions' => array('Secassign.status' => 'AC', 'Secassign.secrole_id'=>$id)));
			if($existSecrole)
				{
				$this->Session->setFlash(__('rolAsociado',true),'flash_failure');				
				}
			else{
					$this->Secrole->recursive = -1;
					$this->request->data = $this->Secrole->find('first',array('conditions' => array('id' => $id)));					
					$this->request->data['Secrole']['status']='DE';
					if ($this->Secrole->save($this->request->data)) 
						{
						$this->Session->setFlash(__('rolDesactivado', true),'flash_success');	
						}
					else 
						{
						$this->Session->setFlash(__('rolNoDesactivado',true),'flash_failure');		
						}		
				}
		}
		$this->redirect(array('controller'=>'Secorganizations', 'action'=>'menuseguridad'));
	}
}
?>