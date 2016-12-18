<?php
class SecconfigurationsController extends AppController {
	public $name = 'Secconfigurations';
	public $helpers = array('Html', 'Form','Js');
	
	function configuration()
	{
		$this->layout = 'ajax';
		if(!isset($this->request->data['Secconfiguration']['id']))
			$this->request->data = $this->Secconfiguration->find();
		else
		{	if(empty($this->request->data['Secconfiguration']['id'])){
				$this->request->data['Secconfiguration']['id']=1;
			}
			$this->Secconfiguration->create();		
			if($this->Secconfiguration->save($this->request->data))
			{
				$this->Session->setFlash(__('configuracionGuardado'),'flash_success');				
			}
			else
			{
				$this->Session->setFlash(__('configuracionNoGuardado'),'flash_failure');				
			}		
			$this->redirect('/Secorganizations/menuseguridad');		
		}
	}
}
?>