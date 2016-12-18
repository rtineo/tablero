<?php
App::uses('AppModel', 'Model');
class Secrole extends AppModel {

	public $name = 'Secrole';
	
    public $actsAs = array('Acl' => array('type' => 'requester'));
	
	public $validate = array(
		'secorganization_id' => array(
							 'notEmpty' => array(
					            'rule' => 'notEmpty',  
					            'last' => true
					         ),
							 
							 'numeric' => array(
					            'rule' => 'numeric',  
					            'last' => true
					         ),							 
		),
       
	    'code' => array(
						'notEmpty' =>array(
								'rule'=>'notEmpty',
								'last' => true
								),
								
						'maxLength' => array(
						        'rule' => array('maxLength', '5'),				        
								'last' => true
				   				), 
								
				        'codeexist'=> array(
            					'rule' => 'codeexist',
								'last' => true
            					),
								
						'alphaNumeric'=> array(
            						'rule' =>'alphaNumeric',
            						'last' => true
									),
		),		
		
		'name' => array(
						'notEmpty' =>array(
								'rule'=>'notEmpty',
								'last' => true
								),
									
						'maxLength' => array(
						        'rule' => array('maxLength', '60'),				        
								'last' => true
				   				),  
		),
	   
		'status' => array('notEmpty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $belongsTo = array(
		'Secorganization' => array(
			'className' => 'Secorganization',
			'foreignKey' => 'secorganization_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public $hasMany = array(
		'Secassign' => array(
			'className' => 'Secassign',
			'foreignKey' => 'secrole_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	function ordenadoPorRol(){
		$sql = "SELECT *FROM(SELECT Aro.id AS id, Aro.alias AS alias, Aro.model AS model, Aro.foreign_key AS foreign_key,
				 Aro.parent_id AS parent_id, 
				CASE WHEN Aro.parent_id IS NULL THEN Aro.alias ELSE (SELECT alias FROM aros WHERE id = Aro.parent_id ) END AS rolgrupo,
				 Aro.lft AS lft, Aro.rght AS rght 
				FROM aros AS Aro WHERE 1 = 1 ORDER BY rolgrupo,lft ASC) AS Aro";
		$rw = $this->query($sql);
		return !empty($rw)?$rw:array(); 
	}
	
	function parentNode() {
		return null;
	}
	
	function afterSave($created) {
		$data = $this->data; // Se obtendra el array del dato ingresado
		$node = current($this->node()); // Se obtendra el nodo del grupo
		$aro = $node;
		//Se modificara el valro del alias para grupo en la tabla aro por el valor del name de la tabla grupo
		$aro['Aro']['alias'] = $data['Secrole']['name']; 
		$this->Aro->save($aro);		
    }
    
     function codeexist(){
		$data=$this->data;
		if(empty($data['Secrole']['id'])){
  			$existemp = $this->find('count', array('conditions' => array('Secrole.secorganization_id' => $data['Secrole']['secorganization_id'],
	   											  						'upper(Secrole.code)' => strtoupper($data['Secrole']['code'])
																		),
												  'recursive'=>-1					
												 )
   								  ); 		
		}else{

  			$existemp = $this->find('count', array('conditions' => array('Secrole.secorganization_id' => $data['Secrole']['secorganization_id'],
	   											  						'upper(Secrole.code)' => strtoupper($data['Secrole']['code']),
																		'Secrole.id != ' => $data['Secrole']['id']
																		),
												  'recursive'=>-1					
												 )
   								  ); 			
		}
							  
	   return $existemp < 1;
    }
	
	function rolDesactivo($foreign_key)
	{
		$sql = "SELECT secroles.status FROM secroles
				WHERE secroles.id =
				(
					SELECT secrole.foreign_key FROM aros secassign JOIN  
					aros secrole ON secassign.parent_id = secrole.id WHERE secassign.foreign_key = ".$foreign_key."
				)";
		$rs = $this->query($sql);
		return $rs['0']['secroles']['status'] == 'DE' ? true : false;
	}
}
?>