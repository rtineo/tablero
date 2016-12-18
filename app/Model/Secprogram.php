<?php
class Secprogram extends AppModel {

	public $name = 'Secprogram';	
	
	public $actsAs = array('Tree');
    	
	public $validate = array(
		'aro_id' => array('numeric'),
		'aco_id' => array('numeric'),
		'parent_id' => array('numeric'),
		'lft' => array('numeric'),
		'rght' => array('numeric')
	);
	
	public function acosParaMenu()
	{
		$sql = "SELECT * FROM (SELECT acos.id,
						  CASE WHEN acos.parent_id IS NULL
							THEN acos.alias
							ELSE
							  CASE WHEN acos.parent_id = 1
								THEN  CONCAT('controllers','/',acos.alias)
								ELSE  CONCAT('controllers','/',parent.alias,'/',acos.alias)
							  END
							END
						   solicitado
							FROM acos
						  LEFT JOIN acos parent ON parent.id = acos.parent_id
						WHERE acos.paraMenu = 1
						ORDER BY acos.lft) AS acosParaMenu ORDER BY solicitado";				
		$rs = $this->query($sql);
		
		foreach($rs as $item=>$row)
		{
			$cmbIndex[$row['acosParaMenu']['id']]= $row['acosParaMenu']['solicitado'];
		}
		
		return $cmbIndex;
	}
	
	public function listprograms($aro_id)
	{
		$sql = "
				SELECT  id AS \"id\",
						etiqueta AS \"etiqueta\",
						aco_id AS \"aco_id\",
						lft AS \"lft\",
						rght AS \"rght\",
				 (SELECT CASE WHEN izq.parent_id IS NULL 
							THEN 
								( SELECT CASE WHEN COUNT(*) > 0 THEN 1 ELSE 0 END
									FROM secprograms parentIzq WHERE aro_id = ".$aro_id." AND  parentIzq.lft<secprograms.lft AND parentIzq.parent_id IS NULL
								)
							ELSE 
								( SELECT CASE WHEN COUNT(*) > 0 THEN 1 ELSE 0 END
									FROM secprograms parentIzq WHERE aro_id = ".$aro_id." AND  parentIzq.lft<secprograms.lft AND parentIzq.parent_id = izq.parent_id
								)
					 END	 
					 FROM secprograms izq  WHERE izq.id = secprograms.id) AS \"arriba\",
				 (SELECT CASE WHEN der.parent_id IS NULL 
							THEN 
								( SELECT CASE WHEN COUNT(*) > 0 THEN 1 ELSE 0 END
									FROM secprograms parentDer WHERE aro_id = ".$aro_id." AND  parentDer.lft>secprograms.lft AND parentDer.parent_id IS NULL
								)
							ELSE 
								( SELECT CASE WHEN COUNT(*) > 0 THEN 1 ELSE 0 END
									FROM secprograms parentDer WHERE aro_id = ".$aro_id." AND  parentDer.lft>secprograms.lft AND parentDer.parent_id = der.parent_id
								)
					 END	 
					 FROM secprograms der WHERE der.id = secprograms.id) AS \"abajo\"
				FROM secprograms
				WHERE aro_id = ".$aro_id."
				ORDER BY lft ASC";			
				
		$programas = $this->query($sql);	
		//pr($programas);
		
		return !empty($programas)?$programas:array();
	}
	
	public function menu($secrole_id)
	{

		$sql = "SELECT * FROM 
				(
					SELECT parent.alias AS controlador,acos.alias AS accion, etiqueta ,
					CASE 
					WHEN acos.parent_id IS NULL THEN acos.alias
					ELSE CONCAT(parent.alias,'/',acos.alias) 
					END AS solicitado
					,
					secprograms.lft, secprograms.rght FROM secprograms
					LEFT JOIN acos ON secprograms.aco_id = acos.id
					LEFT JOIN acos parent ON parent.id = acos.parent_id
					WHERE secprograms.aro_id = (SELECT id FROM aros WHERE parent_id IS NULL AND foreign_key = ".$secrole_id.")
					ORDER BY secprograms.lft
				) AS secprogram";		
                		
		$rs = $this->query($sql);
		
		foreach($rs as $key => $row)
		{ 
			$menu[$key]['secprograms'] = $row['secprogram'];
        }
		
        return isset($menu)?$menu:array();
	}

}
?>