<?php
class SecprogramsController extends AppController {

	public $name = 'Secprograms';
	public $helpers = array('Html', 'Form');
	
    public function beforeFilter() {
        parent::beforeFilter();
        //$this->Auth->allow();
    }

	function add($aro_id=null,$parent_id = null)
	{	
		
		if(empty($this->request->data))
		{			
			$this->request->data['Secprogram']['aro_id'] = $aro_id;			
			$this->request->data['Secprogram']['parent_id'] = $parent_id;					
		}		
		else		
		{			
			//$this->request->data['Secprogram']['id'] = "nextval('aros_id_seq'::regclass)";
			if(empty($this->request->data['Secprogram']['parent_id']))			
				unset($this->request->data['Secprogram']['parent_id']);
				//$this->request->data['Secprogram']['parent_id'] = null;
			if(empty($this->request->data['Secprogram']['aco_id']))			
				unset($this->request->data['Secprogram']['aco_id']);
				
			//pr($this->request->data); $this->Secprogram->save($this->request->data); exit;
			$this->Secprogram->create();
			if($this->Secprogram->save($this->request->data))
			{
				$this->Session->setFlash(__('agregoItemMenu',true),'flash_success');
				$this->redirect(array('action' => 'listprograms',$this->request->data['Secprogram']['aro_id']));
			}
			else
				$this->Session->setFlash(__('noAgregoItemMenu',true),'flash_failure');
			exit;
		}
		
		$acosParaMenu = $this->Secprogram->acosParaMenu();
		$this->set('acosParaMenu',$acosParaMenu);		
	}
	
	function listprograms($aro_id = null)
	{	
		$this->set('aro_id',$aro_id);		
		$programas = $this->Secprogram->listprograms($aro_id);
		
		if(empty($programas))
			$this->Session->setFlash(__('menuNoConfigurado',true),'flash_failure');
		//$programas = !empty($programas) ? $this->Menu->agregarTag($programas,'Programa','etiqueta') : array();		
		$programas = !empty($programas) ? $this->Menu->agregarTag($programas,'secprograms','etiqueta') : array();
		
		//En el mensaje de desactipublic me sale con todo el span
		/*
		foreach($programas as $key => $value){
			if(!empty($programas[$key]['Programa']['etiqueta'])){
				$programas[$key]['Programa']['etiqueta'] = '<span>'.$value['Programa']['etiqueta'].'</span>';
			}
		}*/
		
		//pr($programas);
		
		$this->set('programas',$programas);		
	}
	
	function index() {
		$this->Secprogram->recursive = 0;
		$elementos = array('Secprogram.etiqueta'=>'Etiqueta');
		$this->set('elementos',$elementos);			
		$conditions = !empty($this->request->data)?array($this->request->data['Buscar']['buscador'].' LIKE'=>'%'.$this->request->data['Buscar']['valor'].'%'):array();		
		$this->paginate = array('limit' => 10,
					'page' => 1,
					'order' => array ('Secprogram.id' => 'desc'),
					'conditions' => $conditions
					);		
		$this->set('secprograms', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Secprogram', true),'flash_failure');
			$this->redirect(array('action'=>'index'));
		}
		$this->set('secprogram', $this->Secprogram->read(null, $id));
	}

	
	function edit($id = null) {
		if(empty($this->request->data))
		{
			$this->request->data['Secprogram']['id'] = $id;		
		}
		else
		{			
			$this->Secprogram->begin();
			$this->Secprogram->id = $this->request->data['Secprogram']['id'];
				
			if(empty($this->request->data['Secprogram']['parent_id']))	
				unset($this->request->data['Secprogram']['parent_id']);
			if(empty($this->request->data['Secprogram']['aco_id']))			
				unset($this->request->data['Secprogram']['aco_id']);			
				
			//pr($this->request->data); $this->Secprogram->save($this->request->data); exit;			
			if($this->Secprogram->save($this->request->data))			
			{
				$this->Secprogram->commit();					
				$this->Session->setFlash(__('actualizoCorrectamenteLaEtiquetaDeLaAplicacion',true),'flash_success');
				$this->redirect(array('action' => 'listprograms',$this->request->data['Secprogram']['aro_id']));
			}				
			else
			{
				$this->Secprogram->rollback();
				$this->Session->setFlash(__('noActualizoCorrectamenteLaEtiquetaDeLaAplicacion',true),'flash_failure');
			}		
		}
		
		$this->request->data = $this->Secprogram->find('first',array('conditions'=>array('id' => $this->request->data['Secprogram']['id'])));	
		$acosParaMenu = $this->Secprogram->acosParaMenu();
		$this->set('acosParaMenu',$acosParaMenu);
		$parent = $this->Secprogram->find('list',array('fields'=>array('id','etiqueta'),
													'conditions' => array('aco_id IS NULL',
																		  'id <>'=>$this->request->data['Secprogram']['id'],
																		  'aro_id'=>$this->request->data['Secprogram']['aro_id'],
																		  'OR' => array(
																							'lft <' => $this->request->data['Secprogram']['lft'],
																							'rght >' => $this->request->data['Secprogram']['rght']
																						)
																		  )
													)
										);
		$this->set('parent',$parent);
	}

	function delete($aro_id,$id) {
		$this->Secprogram->id = $id;
		if($this->Secprogram->delete())
				$this->Session->setFlash(__('eliminoItemMenu',true),'flash_success');
		else
				$this->Session->setFlash(__('errorAgregarItemMenu',true),'flash_failure');
			
		$this->redirect(array('action' => 'listprograms',$aro_id));
	}
	
	function down($programa_id)
	{		
		$this->request->data = $this->Secprogram->findById(array('id' => $programa_id));		
		$this->Secprogram->moveDown($this->request->data['Secprogram']['id'], abs(1));
		$this->Session->setFlash(__('movioItemMenuAbajo', true),'flash_success');
		$this->redirect(array('action' => 'listprograms',$this->request->data['Secprogram']['aro_id']));
	}
	
	function up($programa_id)
	{		
		$this->request->data = $this->Secprogram->findById(array('id' => $programa_id));	
		
		if($this->Secprogram->moveUp($this->request->data['Secprogram']['id'], abs(1)))
		{
			$this->Session->setFlash(__('movioItemMenuArriba',true),'flash_success');
		}		
			$this->redirect(array('action' => 'listprograms',$this->request->data['Secprogram']['aro_id']));
	}

}
?>