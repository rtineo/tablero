<?php
class SecprojectsController extends AppController {

	public $name = 'Secprojects';
	public $helpers = array('Html', 'Form');
	
    public function beforeFilter() {
        parent::beforeFilter();
        //$this->Auth->allow();
    }

	function index() {
		$this->layout = false;
		$this->Secproject->recursive = 0;
		$elementos = array('Secproject.code'=>__('codigo',true),'Secproject.name'=>__('ProjectVer',true),'Secorganization.name'=>__('organizacion',true));
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
								array('Secproject.status'=>'DE') :
								array('Secproject.status'=>'AC');
		
		$conditions = $conditions + $conditionsActivos;
		
		$fields=array('Secproject.id','Secproject.code','Secproject.name','Secproject.photo1','Secproject.photo2','Secproject.text1','Secproject.text2',
					  'Secproject.status','Secproject.address','Secproject.phono','Secorganization.name');
			
		$this->paginate = array('limit' => 10,
								'page' => 1,
								'order' => array ('Secproject.name' => 'asc'),
								'conditions' => $conditions,
								'fields' => $fields
								);
			
		$secprojects = $this->paginate('Secproject');
		$this->set('secprojects', $secprojects);
	}

	function view($id = null) {
		$this->layout = 'contenido';
		if (!$id) {
			$this->Session->setFlash(__('ProjectNoValido', true),'flash_failure');
			$this->redirect(array('action'=>'index'));
		}
		$this->set('secproject', $this->Secproject->read(null, $id));
	}

	function add() {
		$this->layout = 'contenido';
		if (!empty($this->request->data)) {
			$this->Secproject->create();
			if ($this->Secproject->save($this->request->data)) {
				$this->Session->setFlash(__('ProjectGuardado', true),'flash_success');
				$this->Session->write('actualizarPadre', true);	
			} else {
				$this->Session->setFlash(__('ProjectNoGuardado', true),'flash_failure');
			}
		}
		$secorganizations = $this->Secproject->Secorganization->find('list',array('conditions'=>array('Secorganization.status'=>'AC')));
		$this->set('secorganizations',$secorganizations);
	}

	function edit($id = null) {
		$this->layout = 'contenido';
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('ProjectNoValido', true),'flash_failure');
			$this->redirect(array('action'=>'index'));
		}	
		if (!empty($this->request->data)) {
			$existSecassign = $this->Secproject->Secassign->find('count', array('conditions' => array('Secassign.status' => 'AC', 'Secassign.secproject_id'=>$id)));
			if($existSecassign and $this->request->data['Secproject']['status']=='DE')
			{
				$this->Session->setFlash(__('projectAsociado',true),'flash_failure');				
			}			
			else 
			{
				$statusempresa = $this->Secproject->Secorganization->find('first',
																		array('conditions'=>array('Secorganization.id'=>$this->request->data['Secproject']['secorganization_id']),
																			  'fields'=>array('Secorganization.status')));
				if(($statusempresa =='DE') && (($this->request->data['Secproject']['status']!== 'AC') || ($this->request->data['Secproject']['status']!=='LI'))){

					$this->Session->setFlash(__('sucursalEmpDesactivada',true),'flash_success');	
					//$this->request->data['Secrole']['status']= 'DE';	
				}
				else{
					if ($this->Secproject->save($this->request->data)) {
						$this->Session->setFlash(__('ProjectGuardado', true),'flash_success');
						$this->Session->write('actualizarPadre', true);
					} else {
						$this->Session->setFlash(__('ProjectNoGuardado', true),'flash_failure');
					}
					
				}

			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Secproject->read(null, $id);
		}
		$secorganizations = $this->Secproject->Secorganization->find('list');
		$this->set('secorganizations',$secorganizations);
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('ProjectNoValido', true),'flash_failure');
		}
		else{
			$existSecassign = $this->Secproject->Secassign->find('count', array('conditions' => array('Secassign.status' => 'AC', 'Secassign.secproject_id'=>$id)));
			if($existSecassign)
				{
				$this->Session->setFlash(__('projectAsociado',true),'flash_failure');				
				}
			else{	$this->request->data['Secproject']['id']=$id;
					$this->request->data['Secproject']['status']='DE';
					if ($this->Secproject->save($this->request->data)) 
						{
						$this->Session->setFlash(__('ProjectDesactivado', true),'flash_success');	
						}
					else 
						{
						$this->Session->setFlash(__('ProjectNoDesactivado',true),'flash_failure');	
						}		
				}
		}
		$this->redirect(array('controller'=>'Secorganizations', 'action'=>'menuseguridad'));
	}
	
	
	function asignarmarcas() {
		$this->Secproject->recursive = 0;
		$elementos = array('Secproject.code'=>__('codigo',true),'Secproject.name'=>__('ProjectVer',true),'Secorganization.name'=>__('organizacion',true));
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
								array('Secproject.status'=>'DE') :
								array('Secproject.status'=>'AC');
		
		$conditions = $conditions + $conditionsActivos;
		
		$fields=array('Secproject.id','Secproject.code','Secproject.name','Secproject.status','Secproject.secorganization_id','Secorganization.name','Secorganization.name');
			
		$this->paginate = array('limit' => 10,
								'page' => 1,
								'order' => array ('Secproject.name' => 'asc'),
								'conditions' => $conditions,
								'fields' => $fields
								);
			
		$secprojects = $this->paginate('Secproject');
		
		// se obtiene la organizacion de los registros obtenidos
		foreach($secprojects as $key => $row) {	
			$marca = $this->Secproject->MarcasSecproject->find('first', array(
				'conditions' => array('MarcasSecproject.secproject_id' => $row['Secproject']['id'])
			));
			if(!empty($marca))
				$secprojects[$key]['MarcasSecproject'] = $marca['MarcasSecproject'];
		}
		//pr($secprojects);
		$this->set('secprojects',$secprojects);
	}

	function asignar($secprojectId) {
        $this->set('secprojectId', $secprojectId);
        
        $this->layout = 'contenidocmb';
        if (!$secprojectId && empty($this->request->data)) {
            $this->Session->setFlash(__('ProjectNoValido', true),'flash_failure');
            $this->redirect(array('action'=>'index'));
        }
        
        //MODELOS UTILIZADOS
        $this->loadModel('MarcasSecproject');
        
        if (!empty($this->request->data)) {
            $this->MarcasSecproject->begin();
            $rpt = $this->MarcasSecproject->setMarcas($secprojectId, $this->request->data);
            
            if ($rpt[0]){
                $this->MarcasSecproject->commit();
                $this->Session->setFlash(__('ProjectGuardado'),'flash_success');
                $this->Session->write('actualizarPadre', true);
            } else {
                $this->MarcasSecproject->rollback();
                $this->Session->setFlash(__('ProjectNoGuardado'),'flash_failure');
            }
        }    
        
        if (empty($this->request->data)) {
            $marcasSecproject_db= $this->MarcasSecproject->find('list',array(
                'fields'=>array('MarcasSecproject.marca_id', 'MarcasSecproject.marca_id'),
                'conditions'=>array('MarcasSecproject.secproject_id'=>$secprojectId, 'MarcasSecproject.status'=>'AC'),
                'recursive'=>-1
            ));
            $this->set('marcasSecproject_db',$marcasSecproject_db);
        }
        
        $secproject = $this->Secproject->find('first',array(
            'conditions' => array(
                'Secproject.status' => 'AC',
                'Secproject.id' => $secprojectId)
        ));
        
        $marcas = $this->Secproject->Marca->find('list',array(
            'fields'=>array('id','description'),
            'conditions' => array('Marca.status' => 'AC')
        ));
        
        $this->set(compact('secproject','marcas'));
    }

	public function getSecprojecsMarcaJson($marcaId = 0, $marca = 0){
		configure::write('debug',0);
		$this->layout = 'ajax';
		$retorno = $this->Secproject->getSecprojecsMarca($marcaId, $marca);
		debug($retorno);
		$responce->susses = empty($retorno)? false:true;
		$responce->errors = array('msg'=>__('NO_EXISTEN_SUCURSALES_ASIGNADAS_A_LA_MARCA'));
		
		foreach($retorno as $key => $value){
			$responce->data[$value['Secproject']['id']] = array(
				'id'=>$value['Secproject']['id'],
				'name'=>$value['Secproject']['name']
			);
		}
		
		echo json_encode($responce);
		$this->autoRender = false;
	}
	
}
?>