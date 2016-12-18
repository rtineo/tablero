<?php
class Secproject extends AppModel {

	public $name = 'Secproject';
	public $displayField = 'name';
	public $virtualFields = array('carscod'=>'Secproject.code');
	public $validate = array(
		'secorganization_id' => array(
		
							 'notEmpty' => array(
					            'rule' => 'notEmpty',  
					            'last' => true
					         ),
							 'numeric' => array(
					            'rule' => 'numeric',  
					            'last' => true
					         )

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
												
						'alphaNumeric'=> array(
            						'rule' =>'alphaNumeric',
            						'last' => true
									),
									
						'codeexist' => array(
					        	'rule' => 'codeexist',  
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
								
						'descripcionexist' => array(
					        	'rule' => 'descripcionexist',  
								'last' => true					        	
								),  
		),
		
		'address' => array(	
							'maxLength' => array(
						        'rule' => array('maxLength', '60'),				        
								'last' => true
				   				),  
							'notEmpty' =>array(
								'rule'=>'notEmpty',
								'last' => true
								),
		),
				
		'phono' => array(								       							
						'maxLength' => array(
						        'rule' => array('maxLength', '15'),				        
								'last' => true
				   				),  
		),
			
		'status' => array('notEmpty'),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $hasAndBelongsToMany = array('Marca');
	
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
			'foreignKey' => 'secproject_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'MarcasSecproject' => array(
			'className' => 'MarcasSecproject',
			'foreignKey' => 'secproject_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Agecitacalendario' => array(
			'className' => 'Agecitacalendario',
			'foreignKey' => 'secproject_id',
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
	
   function codeexist(){
		$data=$this->data;
		if(empty($data['Secproject']['id'])){
  			$existemp = $this->find('count', array('conditions' => array('Secproject.secorganization_id' => $data['Secproject']['secorganization_id'],
	   											  						'upper(Secproject.code)' => strtoupper($data['Secproject']['code'])
																		),
												  'recursive'=>-1					
												 )
   								  ); 		
		}else{

  			$existemp = $this->find('count', array('conditions' => array('Secproject.secorganization_id' => $data['Secproject']['secorganization_id'],
	   											  						'upper(Secproject.code)' =>  strtoupper($data['Secproject']['code']),
																		'Secproject.id != ' => $data['Secproject']['id']
																		),
												  'recursive'=>-1					
												 )
   								  ); 			
		}
							  
	   return $existemp < 1;
    }
	
	 function descripcionexist(){
		$data=$this->data;
		if(empty($data['Secproject']['id'])){
  			$existemp = $this->find('count', array('conditions' => array('Secproject.secorganization_id' => $data['Secproject']['secorganization_id'],
	   											  						'upper(Secproject.name)' => strtoupper($data['Secproject']['name'])
																		),
												  'recursive'=>-1					
												 )
   								  ); 		
		}else{

  			$existemp = $this->find('count', array('conditions' => array('Secproject.secorganization_id' => $data['Secproject']['secorganization_id'],
	   											  						'upper(Secproject.name)' =>  strtoupper($data['Secproject']['name']),
																		'Secproject.id != ' => $data['Secproject']['id']
																		),
												  'recursive'=>-1					
												 )
   								  ); 			
		}
							  
	   return $existemp < 1;
    }
	
	function getSucursalesLista($secorganization_id){
		$sucursalesLista = $this->find('list',array(
								'fields'=>array('Secproject.id','Secproject.name'),
								'conditions'=>array('Secproject.secorganization_id'=>$secorganization_id),
								'recursive'=>-1));
		return $sucursalesLista;
	}
	
	function obtenerName($id) {
		$this->unbindModel(array(
			'hasMany'=>array('Secassign'), 
			'belongsTo'=>array('Secorganization')
		));
		$campos = array('Secproject.name');
		$project = $this->findById($id, $campos);
		return $project?$project['Secproject']['name']:'';
	}
	
	
	/** ############################################################################
	 * ###################### ACCIONES MODIFICADAS #################################
	 * ########## AUTOR: VENTURA RUEDA, JOSE ANTONIO ###############################
	 * */
	function obtenerListaTalleres() {
		$projects = $this->find('all',array(
			'conditions'=>array('Secproject.status' => 'AC'),
			'fields'=>array('Secproject.id', 'Secproject.name', 'Secorganization.name')
		));
		
		if(empty($projects)) return array();
		
		foreach($projects as $project)
			$tmp[$project['Secproject']['id']] = sprintf("%s - %s",$project['Secorganization']['name'],$project['Secproject']['name']);
		
		return $tmp;
	}
	
	public function getSecprojecsMarca($marcaId = 0, $marca = 0){
		$cndMarcaId = empty($marcaId)?"1=1":"AgegruposMarca.marca_id = '$marcaId'";
		$cndMarca = empty($marca)?"1=1":"Marca.description = '$marca'";
		
		if(empty($marcaId) && empty($marca)) return array();
		
		$secprojects = $this->query(
			"select distinct Secproject.id, Secproject.name
			from
			    agegrupos_marcas AgegruposMarca 
			    JOIN agecitacalendarios Agecitacalendario ON Agecitacalendario.agegrupo_id = AgegruposMarca.agegrupo_id
			    JOIN secprojects Secproject ON Secproject.id = Agecitacalendario.secproject_id
				JOIN marcas Marca ON Marca.id = AgegruposMarca.marca_id
			WHERE $cndMarcaId AND $cndMarca"
		);
		return $secprojects;
	}
}
?>