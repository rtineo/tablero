<?php
App::uses('AppModel', 'Model');
class Secassign extends AppModel {

	public $name = 'Secassign';
    
    public $actsAs = array('Acl' => array('type' => 'requester'));
	
	public $validate = array(
		'secperson_id' => array('rule' => array('numeric')),
		'secproject_id' => array('rule' => array('numeric')),
		'secrole_id' => array('rule' => array('numeric')),
		'status' => array('rule' => array('notempty'))
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $belongsTo = array(
		'Secperson' => array(
			'className' => 'Secperson',
			'foreignKey' => 'secperson_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Secproject' => array(
			'className' => 'Secproject',
			'foreignKey' => 'secproject_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Secrole' => array(
			'className' => 'Secrole',
			'foreignKey' => 'secrole_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
    
	function parentNode() {
		if (!$this->id && empty($this->data)) {
			return null;
		}
		$data = $this->data;
		if (empty($this->data)) {
			$data = $this->read();
		}
		if (!$data['Secassign']['secrole_id']) {
			return null;
		} else {
			return array('Secrole' => array('id' => $data['Secassign']['secrole_id']));
		}
	}
	
	public function afterSave($created) {
        if (!$created) {//habria que revisar cuando entra aqui        	
            $parent = $this->parentNode(); //Me capturas el group_id del que deseo cambiar
            $parent = ($this->node($parent)); //Me da el aro del grupo del group_id que se quiere modificar
            $node = ($this->node()); //tu me armas el arbol del aro del usuario con su aro de su grupo teniendo todavia en su arbol al grupo anterio  pr($node); exit;
			$aro = $node['0']; //me da el array del aro del usuario
            //$aro = $node; //no devuelve un array 0
            $aro['Aro']['parent_id'] = $parent[0]['Aro']['id']; //Cambia el $aro['Aro']['parent_id'] del usuario por el  $parent[0]['Aro']['id'] del grupo a cambiar
            $this->Aro->save($aro);
        }
		$data =& $this->data; // Se obtendra el array del dato ingresado		
		$node = ($this->node()); // Se obtendra el nodo del usuario
		$aro = $node;
		//Se modificara el valor del alias para el usuario en la tabla aro por el valor del username de la tabla User
		$aro['Aro']['alias'] =  $this->Secperson->field('username',array('Secperson.id' => $data['Secassign']['secperson_id']));
		$this->Aro->save($aro);
    }
	
	public function getpubliciablesPaginadorAprobacionCorreo($data=null,$params=null,$datosLogeo=null){
		
		$this->data = $data;
		$this->params = $params;
		$this->datosLogeo = $datosLogeo;		
		
		$this->data['Buscar']['buscador'] = !empty($this->params['named']['buscador'])?$this->params['named']['buscador']:(!empty($this->data['Buscar']['buscador'])?$this->data['Buscar']['buscador']:null);	
		$this->data['Buscar']['valor'] = !empty($this->params['named']['valor'])?$this->params['named']['valor']:(!empty($this->data['Buscar']['valor'])?$this->data['Buscar']['valor']:null);		
		$this->data['Buscar']['page'] = !empty($this->params['named']['page'])?$this->params['named']['page']:null;						
		$conditionsBuscador = !empty($this->data['Buscar']['valor'])?array($this->data['Buscar']['buscador'].' ILIKE'=>'%'.trim($this->data['Buscar']['valor']).'%'):array();
				
		$fields = array('Secperson.id',
						'Secperson.email',
						'Secperson.appaterno',
						'Secperson.firstname',
						'Secperson.apmaterno',
						'Secperson.username',
						'Secperson.correoaprobacion',
						'CASE WHEN "Secperson"."correoaprobacion" = TRUE THEN \''.__('devolucionAprueba',true).'\' ELSE \''.__('devolucionNoAprueba',true).'\' END AS "Secperson__aprobacioncorreo"'
						);
		
		$conditions =  array('Secperson.status' => 'AC') + $conditionsBuscador;
		$publiciablesPaginador = array('limit' => 5,
									'page' => 1,
									'fields' => $fields,
									'conditions' => $conditions,
									'order' => array ('Secperson.appaterno' => 'ASC'),									
									'recursive' => 0
									);
		$rpta['publiciablesPaginador'] = $publiciablesPaginador;
		$rpta['data'] = $this->data;						
		return $rpta;
	}
	
	function setGuardarAprobacionCorreo($secpersonId){
		$this->begin();
			$this->id = $secpersonId;
			App::Import('Model','Secperson');
			$this->Secperson = new Secperson;
			$person = $this->Secperson->find('first',array('fields' => array('correoaprobacion'),'conditions' => array('id' => $secpersonId),'recursive' => -1));
			$correoaprobacion = ($person['Secperson']['correoaprobacion'] == true)?false:true;
			$this->Secperson->id = $secpersonId;			
			if(!$this->Secperson->savefield('correoaprobacion',$correoaprobacion)){
				$this->rollback();
				$rpta['rpta'] = false;			
				$rpta['msj'] = __('errorAlGuardar',true);
				return $rpta;
			}		
		$this->commit();
		$rpta['rpta'] = true;
		$rpta['msj'] = __('sinErrorAlGuardar',true);
		return $rpta;
	}
	
	function unicAssign($data){
		if(!empty($data['Secassign']['id']) && isset($data['Secassign']['id'])){
			$condition = array('Secassign.id !='=>$data['Secassign']['id'],'Secassign.status'=>'AC','Secassign.secperson_id'=>$data['Secassign']['secperson_id'],
								'Secassign.secproject_id'=>$data['Secassign']['secproject_id'],'Secassign.secrole_id'=>$data['Secassign']['secrole_id']);
			$secassign = $this->find('first',array('conditions'=>$condition));
			if(!empty($secassign) && isset($secassign)) return false;
		}else{
			$condition = array('Secassign.status'=>'AC','Secassign.secperson_id'=>$data['Secassign']['secperson_id'],
								'Secassign.secproject_id'=>$data['Secassign']['secproject_id'],'Secassign.secrole_id'=>$data['Secassign']['secrole_id']);
			$secassign = $this->find('first',array('conditions'=>$condition));
			if(!empty($secassign) && isset($secassign)) return false;
		}
		return true;
	}
}
?>
