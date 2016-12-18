<?php
class AcosController extends AppController
{
	public $name = 'Acos';	
	
	public $uses = array('Aco','Secprogram');	//supuestamente removido de cakephp 2.x
	
    public function beforeFilter() {
        parent::beforeFilter();
        //$this->Auth->allow();
    }
        
    public function constructor() {
        set_time_limit(600);
        ini_set('memory_limit', '512M');
		
        $log = array(); 
        $aco =& $this->Acl->Aco;
        $root = $aco->node('controllers');
        if (!$root) {
            $aco->create(array('parent_id' => null, 'model' => null, 'alias' => 'controllers'));
            $root = $aco->save();
            $root['Aco']['id'] = $aco->id; 
            $log[] = 'Creado el nodo Aco para los controladores';
        } else {
            $root = $root[0];
        }   
 
        App::import('Core', 'File');
        $Controllers = Configure::listObjects('controller');
        $appIndex = array_search('App', $Controllers);
        if ($appIndex !== false ) {
            unset($Controllers[$appIndex]);
        }
        $baseMethods = get_class_methods('Controller');
        $baseMethods[] = 'buildAcl';
 
        // miramos en cada controlador en app/controllers
        foreach ($Controllers as $ctrlName) {
            App::import('Controller', $ctrlName);
            $ctrlclass = $ctrlName . 'Controller';
            $methods = get_class_methods($ctrlclass);
 
            //buscar / crear nodo de controlador
            $controllerNode = $aco->node('controllers/'.$ctrlName);
            if (!$controllerNode) {
                $aco->create(array('parent_id' => $root['Aco']['id'], 'model' => null, 'alias' => $ctrlName));
                $controllerNode = $aco->save();
                $controllerNode['Aco']['id'] = $aco->id;
                $log[] = 'Creado el nodo Aco del controlador '.$ctrlName;
            } else {
                $controllerNode = $controllerNode[0];
            }
 
            //Limpieza de los metodos, para eliminar aquellos en el controlador 
            //y en las acciones privadas
            if(!empty($methods))
            foreach ($methods as $k => $method) {
                if (strpos($method, '_', 0) === 0) {
                    unset($methods[$k]);
                    continue;
                }
                if (in_array($method, $baseMethods)) {
                    unset($methods[$k]);
                    continue;
                }
                $methodNode = $aco->node('controllers/'.$ctrlName.'/'.$method);
                if (!$methodNode) {
                    $aco->create(array('parent_id' => $controllerNode['Aco']['id'], 'model' => null, 'alias' => $method));
                    $methodNode = $aco->save();
                    $log[] = 'Creado el nodo Aco para '. $method;
                }
            }
        }
        //debug($log);
    }
    
    
	function index()
	{		
		$this->Aco->recursive = -1;
		$acos = $this->Aco->find('all',array('fields' => array('id','alias','parent_id','lft','rght'),'order' => 'lft ASC'));				
		if(empty($acos))
			$this->Session->setFlash(__('noConfiguradoAco',true),'flash_failure');
		$acos = !empty($acos) ? $this->Menu->agregarTag($acos,'Aco','alias') : array();			
		$this->set('acos',$acos);
	}
	
	function editar($id=null)
	{
		if(empty($this->request->data))
		{
			$this->Aco->unbindModel(array('hasAndBelongsToMany' => array('Aro')));
			$this->request->data = $this->Aco->find('first',array('conditions'=>array('id' => $id)));
		}
		else
		{			
			if($this->Aco->save($this->request->data) && !empty($this->request->data['Aco']['alias']))		
			{		
				$this->Session->setFlash(__('editoAco',true),'flash_success');
				$this->redirect(array('action' => 'index'));
			}				
			else
			{			
				$this->Session->setFlash(__('noguardoAco',true),'flash_failure');
			}			
		}
	}
    
	function agregar($parent_id = null)
	{
		if(empty($this->request->data))
		{				
			$this->request->data['Aco']['parent_id'] = $parent_id;
		}
		else
		{				
			
			$this->Aco->recursive = -1;
			$unicoAlias = $this->Aco->find('count',array('conditions' => array('Aco.alias' => $this->request->data['Aco']['alias'],
																 'Aco.parent_id'=> $this->request->data['Aco']['parent_id'])));
			
			if($unicoAlias > 0){
				$this->Session->setFlash(__('aliasIngresado'),'flash_success');
			}
			else if($this->Aco->save($this->request->data) && !empty($this->request->data['Aco']['alias']))		
			{		
				$this->Session->setFlash(__('acosSeAgrego'),'flash_success');
				$this->redirect(array('action' => 'index'));
			}				
			else
			{			
				$this->Session->setFlash(__('noagregoAco'),'flash_failure');
			}			
		}
	}
    
	function eliminar($id)
	{
		$existeEnMenu = $this->Secprogram->find('count' , array('conditions' => array('Secprogram.aco_id' => $id)));
				
		if($existeEnMenu > 0)
		{
			$this->Session->setFlash(__('noElimandoExisteMenu',true),'flash_failure');
		}
		else
		{
			$this->Aco->id = $id;
			if($this->Aco->delete())
					$this->Session->setFlash(__('acosSeElimino',true),'flash_success');
			else
					$this->Session->setFlash(__('noEliminoACO',true),'flash_failure');
		}
		
			
		$this->redirect(array('action' => 'index'));
	}
}
?>