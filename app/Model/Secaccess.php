<?php
class Secaccess extends AppModel {
	public $name = 'Secaccess';
	public $useTable = false;
	
	function listaaros()
	{
		$sql = "SELECT id,parent_id,model,foreign_key,alias,lft,rght FROM 
				(
				SELECT aros.id,aros.parent_id,aros.model,aros.foreign_key,CONCAT(aros.alias,' - ',secorganizations.name) AS alias,aros.lft,aros.rght, 
				
				--SELECT alias FROM aros rol WHERE rol.id =  parent_id
				CASE WHEN aros.model ='Secrole'  THEN aros.alias
							    ELSE CONCAT(parent.alias,aros.alias)			
				END
				 AS paraOrdenar,
				 CASE WHEN aros.model ='Secrole' THEN (SELECT status FROM secroles WHERE secroles.id =  aros.foreign_key)
							    ELSE (SELECT status FROM secassigns WHERE secassigns.id =  aros.foreign_key)
				 END AS status
				FROM aros 
				LEFT JOIN aros parent ON parent.id = aros.parent_id
				LEFT JOIN secroles ON secroles.id = aros.foreign_key AND aros.model ='Secrole'
				LEFT JOIN secorganizations ON secorganizations.id = secroles.secorganization_id
				ORDER BY lft ) AS aros WHERE status = 'AC' AND status IS NOT NULL  ORDER BY paraOrdenar";
		
		$rs = $this->query($sql);
		pr();
		foreach($rs as $key => $row)
		{
			$aros[$key]['Aro'] = $row[0];
		}
		
		return $aros;		
	}
	
	function listapermisos($aros_id){
	
		//$aros_id = isset($aros_id) ? ' AND aro_id = '.$aros_id : '';		

		$sql = "	SELECT
							aros_acos.id AS aros_acos_id,  -- vista lista de permisos
							acos.id AS acos_id, -- vista lista de permisos
							aros.id AS aros_id,	-- vista lista de permisos
							aros.alias AS aros_alias, -- Utilizados como etiquetas si tiene Grupo							
							CASE 
								WHEN Parent_acos.alias IS NULL
								THEN 'Todos los Controladores'
								ELSE
									CASE 
										WHEN Parent_acos.alias = 'controllers' 
										THEN acos.alias
										ELSE Parent_acos.alias
									END
							END AS controlador,

							CASE
								WHEN (Parent_acos.alias IS NULL OR Parent_acos.alias = 'controllers')
								THEN 'Todas las Acciones'
								ELSE acos.alias
							END AS acciones,
							aros_acos._create AS aros_acos_acceso
							FROM aros_acos
							JOIN aros ON aros.id = aros_acos.aro_id
							LEFT JOIN aros Parent_aros ON Parent_aros.id = aros.parent_id
							JOIN acos ON acos.id = aros_acos.aco_id
							LEFT JOIN acos Parent_acos ON Parent_acos.id = acos.parent_id
							WHERE aros_acos._create IN (1,-1) AND aro_id = ".$aros_id."";
							
		$rs = $this->query($sql);
		
		foreach($rs as $key => $row)
		{
			$listapermisos[$key]['listaDePermisos']  = array_merge($row['0'], $row['aros_acos'],$row['acos'],$row['aros']);
		} 		

		return !empty($listapermisos)?$listapermisos:array();
	}
	
	function listaDeAccesos($aros_id){	
		$sql = "SELECT lft,rght FROM aros_acos
				JOIN acos ON acos.id = aros_acos.aco_id
				WHERE _create = 1 AND aro_id = ".$aros_id;
		$rs = $this->query($sql);
				
		if(!empty($rs))
		{
			$acos_left = array();
			foreach($rs as $item=>$row)
			{
				//for($i=$item['0']['lft']; $i<$item['0']['rght']; $i++)		
				for($i=$row['acos']['lft']; $i<$row['acos']['rght']; $i++)//un for de 1 a 120 no se entienmde muy bien			
					$lft[$i] = $i;							
				$acos_left = $acos_left+$lft;
			}
			$acos_left = "WHERE acos.lft NOT IN (".implode(",", $acos_left).")";			
		}
		else
			$acos_left = '';
		
		$sql = "SELECT
						acos.id AS acos_id,
						CASE
							WHEN acos.parent_id IS NULL
							THEN acos.alias
							ELSE NULL
						END AS controlador,
						CASE
							WHEN acos.parent_id = 1
							THEN acos.alias
							ELSE NULL
						END AS controladores,
						CASE
							WHEN (acos.parent_id IS NULL OR acos.parent_id = 1)
							THEN NULL
							ELSE acos.alias
						END AS acciones,
						acos.parent_id	,acos.lft, acos.rght	 
						FROM acos
						LEFT JOIN acos parent ON parent.id = acos.parent_id
						".$acos_left."
						ORDER BY acos.lft";
		$rs = $this->query($sql);	
		
		foreach($rs as $key => $row)
		{
			$listaDeAccesos[$key]['listaDeAccesos']  = array_merge($row['0'], $row['acos']);
		} 
		return !empty($listaDeAccesos)?$listaDeAccesos:array();			
		
	}
	
	public function datosDeSolicitado($acos_id){
	
		$sql = "SELECT
					  CASE WHEN acos.parent_id IS NULL 
						THEN acos.alias
						ELSE
							CASE WHEN acos.parent_id = 1
							THEN CONCAT('controllers','/',acos.alias)
							ELSE CONCAT('controllers','/',parent.alias,'/',acos.alias)
							END
					  END Solicitado
						FROM acos
					  LEFT JOIN acos parent ON parent.id = acos.parent_id
					WHERE acos.id =". $acos_id."";
		
		$rs = $this->query($sql);
		pr($rs);
		foreach($rs as $key => $row)
		{
			$datosDeSolicitado[$key]['datosDeSolicitado'] = $row['0'];
		} 
		return !empty($datosDeSolicitado)?$datosDeSolicitado['0']:array();
	}	
}
?>