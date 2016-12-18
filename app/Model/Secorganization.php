<?php
class Secorganization extends AppModel {
	
	public $displayField = 'name';
	public $name = 'Secorganization';
	
	public $validate = array(
		'code' => array(
						'notEmpty' =>array(
								'rule'=>'notEmpty',
								'last' => true
								),
								
						'maxLength' => array(
						        'rule' => array('maxLength', '5'),				        
								'last' => true
				   				), 
								
				        'isUnique' => array(
					        	'rule' => 'isUnique',  
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
								
				        'isUnique' => array(
					        	'rule' => 'isUnique',  
					        	'last' => true
								),
								
						'maxLength' => array(
						        'rule' => array('maxLength', '60'),				        
								'last' => true
				   				),  
		),
		
		'address' => array(	
							'maxLength' => array(
						        'rule' => array('maxLength', '60'),				        
								'last' => true
				   				),  
		),
				
		'type' => array(
																								
						'notEmpty' => array(
						        'rule' => 'notEmpty',				        
								'last' => true
				   				),  
						
						'numeric' =>array(
								'rule'=>'numeric',
								'last' => true
								),

		),
				
		'thema' => array(
						'notEmpty' =>array(
								'rule'=>'notEmpty',
								'last' => true
								),
									       							
						'maxLength' => array(
						        'rule' => array('maxLength', '20'),				        
								'last' => true
				   				),  
		),
	
		'phono' => array(								       							
						'maxLength' => array(
						        'rule' => array('maxLength', '15'),				        
								'last' => true
				   				),  
		),
		'vplperiodoespera' => array(								       							
						'numeric' =>array(
								'rule'=>'numeric',
								'last' => true
								)
		),
		'vplnielservicio' => array(								       							
						'numeric' =>array(
								'rule'=>'numeric',
								'last' => true
								)
		),
		'vpltamaniolote' => array(								       							
						'numeric' =>array(
								'rule'=>'numeric',
								'last' => true
								)
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $hasMany = array(
		'Secproject' => array(
			'className' => 'Secproject',
			'foreignKey' => 'secorganization_id',
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
		'Secrole' => array(
			'className' => 'Secrole',
			'foreignKey' => 'secorganization_id',
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

	);

	function NumeroDocumento($tipoOrden = null, $idEmpresa){
		if($tipoOrden == null){
			return null;
		}else{
			if($tipoOrden==0){
				$numeroOrdenNacional = $this->find('first', array('conditions'=>array('id'=>$idEmpresa), 'fields'=>array('Secorganization.ordencompranacional')));
				//pr($numeroOrdenNacional);exit;
				
				$numeroOrdenNacional = $this->nroDocLong($numeroOrdenNacional['Secorganization']['ordencompranacional']);
				return $numeroOrdenNacional;
			
			}elseif($tipoOrden==1){
				$numeroOrdenImportado = $this->find('first', array('conditions'=>array('id'=>$idEmpresa), 'fields'=>'ordencompraimportado'));
				//pr($numeroOrdenImportado);exit;
				
				$numeroOrdenImportado = $this->nroDocLong($numeroOrdenImportado['Secorganization']['ordencompraimportado']);
				return $numeroOrdenImportado;
			}
		}
	}
	
	/* Ingresan los valores 
	 * $idEmpresa 		= Id de la organizacion actual
	 * $campoRequerido 	= Campo que mantiene la numeracion - tener mucho cuidado con el nombre del campo
	 * return 			= un numero formado por 6 digitos a partir de 000001
	 * 
	 * FUNCION UTILIZADA POR:
	 * CONTROLADOR:
	 * 				tqcordenformulaciones, tqcordenenvasado
	 */
	function numeracionDocumentos($idEmpresa, $campoRequerido){
		$numeroBuscado = $this->find('first', array('conditions'=>array('id'=>$idEmpresa), 'fields'=>array('Secorganization.'.$campoRequerido)));
		$numeroBuscado = $this->nroDocLong($numeroBuscado['Secorganization'][$campoRequerido]);
		return $numeroBuscado;
	}
	
	function codigoDocumentos($idEmpresa, $campoRequerido,$nrocifras){
		$numeroBuscado = $this->find('first', array('conditions'=>array('id'=>$idEmpresa), 'fields'=>array('Secorganization.'.$campoRequerido)));
		$numeroBuscado = $this->codDocLong($numeroBuscado['Secorganization'][$campoRequerido],$nrocifras);
		return $numeroBuscado;
	}
	
	// FUNCION QUE VERIFICA LA LONGITUD DEL NUMERO QUE BUSCAMOS
	function nroDocLong($numero){
		if(empty($numero))
			return '000001';
		else{
			$numero = (int)$numero + 1;
			$longitudNro = (int)strlen($numero);
			while((6-$longitudNro) > 0){
				$numero = '0'.$numero;
				++$longitudNro;
			}
		}
		return $numero;	
	}
	
	// FUNCION QUE VERIFICA LA LONGITUD DEL CODIGO TABLAS BASICAS
	function codDocLong($numero,$nrocifras){
		if(empty($numero)){
			$num = '1';
			while(($nrocifras--) > 1){
				$num = '0'.$num;
			} 
			return $num;
		}
			
		else{
			$numero = (int)$numero + 1;
			$longitudNro = (int)strlen($numero);
			while(($nrocifras-$longitudNro) > 0){
				$numero = '0'.$numero;
				++$longitudNro;
			}
		}
		
		return $numero;	
	}

	function nroLote($secorganization_id){
		$organization = $this->find('first',array('fields' => array('numerolote'), 
												  'conditions' => array('id' => $secorganization_id),'recursive'=>-1));
		
		if(empty($organization['Secorganization']['numerolote']))
			return '000100'; //Para que coinsidad con los registros ingresado por prueba
		else
		{
			$numerolote = (int)$organization['Secorganization']['numerolote'] + 1;
			$longitudNro = (int)strlen($numerolote);
			while((6-$longitudNro) > 0)
			{	
				$numerolote = '0'.$numerolote;
				++$longitudNro;
			}			
		}
		return $numerolote;			
	}
	
	function nroguiaremision($secorganization_id){
		$empresa = $this->find('first',array('fields' => array('numeroguiaremision'), 
												  'conditions' => array('id' => $secorganization_id),'recursive'=>-1));

		if(empty($empresa['Secorganization']['numeroguiaremision'])){
			return '000100'; //Para que coinsidad con los registros ingresado por prueba		
		}
		else
		{		
			$numeroguiaremision = (int)$empresa['Secorganization']['numeroguiaremision'] + 1;
			$longitudNro = (int)strlen($numeroguiaremision);
			
			while((6-$longitudNro) > 0)
			{
				$numeroguiaremision = '0'.$numeroguiaremision;
				++$longitudNro;
			}			
		}
		
		return $numeroguiaremision;
	}
	
	function nrohojatrabajo($secorganization_id){
		$empresa = $this->find('first',array('fields' => array('numerohojatrabajo'), 
												  'conditions' => array('id' => $secorganization_id),'recursive'=>-1));

		if(empty($empresa['Secorganization']['numerohojatrabajo'])){
			return '001000'; //Para que coinsidad con los registros ingresado por prueba		
		}
		else
		{		
			$numerohojatrabajo = (int)$empresa['Secorganization']['numerohojatrabajo'] + 1;
			$longitudNro = (int)strlen($numerohojatrabajo);
			
			while((6-$longitudNro) > 0)
			{
				$numerohojatrabajo = '0'.$numerohojatrabajo;
				++$longitudNro;
			}			
		}
		
		return $numerohojatrabajo;
	}
	
	function obtenerName($id) {
		$this->unbindModel(array(
			'hasMany'=>array('Secproject', 'Secrole')
		));
		$campos = array('Secorganization.name');
		$organization = $this->findById($id, $campos);
		return $organization?$organization['Secorganization']['name']:'';
	}
}
?>