<?php
class SecaccessesController extends AppController
{
	public $name = 'Secaccesses';
	public $uses = array('Secaccess','Aro','Secrole');
	
	public function permiso(){
		$this->layout = 'ajax';		
		foreach($this->data['acl'] as $key => $value){
			//Buscamos el nombre del controlador tal y como esta en los acos porque puede en la vista estar en minuscula
			$sql = "select alias from acos where alias LIKE '%".$value['controlador']."%' limit 1";
			$rw = $this->Secaccess->query($sql);			
			$respuesta = $this->Acl->check($value['rol'],$rw[0][0]['alias'].'/'.$value['accion']);			
			$this->data['acl'][$key]['permiso'] = ($respuesta == true)?1:0;
		}

		$this->set('data',$this->data);
	}
	
	public function listaccess()
	{					
		$aros = $this->Secrole->ordenadoPorRol();
		//$aros = $this->Secaccess->listaaros();
		foreach($aros as $id => $modelo)
		{			
			if(isset($modelo['Aro']['model']))
			if($modelo['Aro']['model'] == 'Secrole')
			{				
				$desactivo = $this->Secrole->find('count', array('conditions' => array('Secrole.id' => $modelo['Aro']['foreign_key'],
																		 			   'Secrole.status' => 'DE')));
				//Puede ser que haciendo pruebas se haya eliminado el rol de Secrole
				$exite = $this->Secrole->find('count', array('conditions' => array('Secrole.id' => $modelo['Aro']['foreign_key'])));			
				if($desactivo == 1 || $exite == 0)
					unset($aros[$id]);
			}
			elseif($modelo['Aro']['model'] == 'Secassign')
			{
				$asignacion_desactiva = $this->Secassign->find('count', 
																		array('conditions' => 
																				array('Secassign.id' => $modelo['Aro']['foreign_key'],
																		 			   'Secassign.status' => 'DE')));
																					   
				$rolDesactivo = $this->Secrole->rolDesactivo($modelo['Aro']['foreign_key']);
				if($asignacion_desactiva || $rolDesactivo)
					unset($aros[$id]);
			}			
		}
		
		//Ordena el indice por los espacios dejados por elimacion de la vista 
		$id=0;
		foreach($aros as $item)
		{		
			$listaAros[$id] = $item;
			$id++;
		}
		//pr($listaAros);
		$aros = $this->Menu->agregarTag($listaAros,'Aro','etiqueta');
		//pr($aros);
		$this->set('aros',$aros);
	}
	
	public function listapermisos($aros_id) {
	
		$this->Aro->recursive = -1;
		$datosDeSolitantes = $this->Aro->find('first',
										array('fields' => array('Aro.id','Aro.alias','Aro.parent_id','Aro.lft','Aro.rght'),
											  'conditions' => array('Aro.id' => $aros_id),
											  'order' => 'Aro.lft')
											);		
														
		$this->set('grupo_usuario',$datosDeSolitantes['Aro']['alias']);		
		$this->set('aros_id',$aros_id);
		$listaDePermisosPrincipal = $this->Secaccess->listapermisos($aros_id);		
		$this->set('listaDePermisosPrincipal',$listaDePermisosPrincipal);
		
		if($datosDeSolitantes['Aro']['parent_id']){
			$listaDePermisosHeredado = $this->Secaccess->listapermisos($datosDeSolitantes['Aro']['parent_id']);
			$this->set('listaDePermisosHeredado',$listaDePermisosHeredado);
		}
		else
			$this->set('listaDePermisosHeredado',false);
	}

	public function accederpermiso($aros_id) {
		$this->Aro->recursive = -1;
		$datosDeSolitantes = $this->Aro->find('first',
										array('fields' => array('Aro.id','Aro.alias','Aro.parent_id','Aro.lft','Aro.rght'),
											  'conditions' => array('Aro.id' => $aros_id),
											  'order' => 'Aro.lft')
											);
																
		$this->set('grupo_usuario',$datosDeSolitantes['Aro']['alias']);		
		$this->set('aros_id',$aros_id);			
		$listaDeAccesos = $this->Secaccess->listaDeAccesos($aros_id);
		//pr($listaDeAccesos);
		$listaDeAccesos = (!empty($listaDeAccesos))?$this->Menu->agregarTag($listaDeAccesos,'listaDeAccesos','etiqueta'):array();		
		
		
		foreach($listaDeAccesos as $key => $value){
			if(!empty($listaDeAccesos[$key]['listaDeAccesos']['controladores'])){
				$listaDeAccesos[$key]['listaDeAccesos']['controladores'] = '<span>'.$value['listaDeAccesos']['controladores'].'</span>';
			}elseif(!empty($listaDeAccesos[$key]['listaDeAccesos']['acciones'])){
				$listaDeAccesos[$key]['listaDeAccesos']['acciones'] = '<span>'.$value['listaDeAccesos']['acciones'].'</span>';
			}
		}
		
		$this->set('listaDeAccesos',$listaDeAccesos);
	}
	
	public function permitir($listaDePermisos,$aros_id,$acos_id){
		$this->Aro->recursive = -1;
		$Solitante = $this->Aro->find('first',
										array('fields' => array('Aro.id','Aro.alias','Aro.parent_id','Aro.lft','Aro.rght'),
											  'conditions' => array('Aro.id' => $aros_id),
											  'order' => 'Aro.lft')
											);
		$Solicitado = $this->Secaccess->datosDeSolicitado($acos_id);

		if($this->Acl->allow($Solitante['Aro']['alias'] , $Solicitado['datosDeSolicitado']['Solicitado']))
			$this->Session->setFlash(__('permisoCorrecto',true),'flash_success');
		else
			$this->Session->setFlash(__('permisoNoCorrecto',true),'flash_failure');
		
		if($listaDePermisos)
			$this->redirect(array('action' => 'listapermisos',$aros_id));
		else
			$this->redirect(array('action' => 'accederpermiso',$aros_id));
	}
	
	public function denegarpermiso($listaDePermisos,$aros_id,$acos_id) {
		$this->Aro->recursive = -1;
		$Solitante = $this->Aro->find('all',
										array('fields' => array('Aro.id','Aro.alias','Aro.parent_id','Aro.lft','Aro.rght'),
											  'conditions' => array('Aro.id' => $aros_id),
											  'order' => 'Aro.lft')
											);
		
		$Solicitado = $this->Secaccess->datosDeSolicitado($acos_id);
		
		if($this->Acl->deny($Solitante[0]['Aro']['alias'] , $Solicitado['datosDeSolicitado']['Solicitado']))
			$this->Session->setFlash(__('negoPermiso',true),'flash_success');
		else
			$this->Session->setFlash(__('noseNegoPermiso',true),'flash_failure');
			
		if($listaDePermisos)
			$this->redirect(array('action' => 'listapermisos',$aros_id));
		else
			$this->redirect(array('action' => 'accederpermiso',$aros_id));
	}

	public function cancelar($aros_id,$acos_id){		
		$this->Aro->recursive = -1;
		$Solitante = $this->Aro->find('all',
										array('fields' => array('Aro.id','Aro.alias','Aro.parent_id','Aro.lft','Aro.rght'),
											  'conditions' => array('Aro.id' => $aros_id),
											  'order' => 'Aro.lft')
											);
		
		$Solicitado = $this->Secaccess->datosDeSolicitado($acos_id);
		
		
		if($this->Acl->inherit($Solitante[0]['Aro']['alias'] , $Solicitado['datosDeSolicitado']['Solicitado']))
			$this->Session->setFlash(__('canceloPermiso',true),'flash_success');
		else
			$this->Session->setFlash(__('noCancelopermiso',true),'flash_failure');
			
		$this->redirect(array('action' => 'listapermisos',$aros_id));
	}
	
}
?>