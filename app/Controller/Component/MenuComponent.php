<?php
class MenuComponent extends Component
{
	public function menuJson($arrego, $modelo,$url)
	{		
		$programas = $arrego;
		$menu = '';
		$tagCierre = '';
		foreach($programas as $key=>$programa)		
		{			
			if($key == 0)
			{
				$niveles[0] = array('lft' => $programa[$modelo]['lft'],'rght' => $programa[$modelo]['rght']);	
				$tagInicio = '[{';						
									
			}
			else
			{
				$item = 1; 				
				krsort($niveles);				
				$tagCierre = '';			
				foreach($niveles as $key1=>$nivel)
				{					
					if($programa[$modelo]['lft'] > $nivel['lft'] && $programa[$modelo]['lft'] < $nivel['rght'])
					{						
						$niveles[count($niveles)] = array('lft' => $programa[$modelo]['lft'],'rght' => $programa[$modelo]['rght']);						
						 krsort ($niveles);	break;
					}
					else
					{						
						unset($niveles[$key1]); 
						if($item == 1)	
							$tagCierre = '}';
							//$tagCierre = '</li>';
						else
							{
								if($item == 2) 	
									$tagCierre .= ']';
									//$tagCierre .= '</ul>';
								else 
									$tagCierre .= '}]';
									//$tagCierre .= '</li></ul>';
							}
						$item++;
					}								
				}				
				if(empty($niveles))
					$niveles[0] = array('lft' => $programa[$modelo]['lft'],'rght' => $programa[$modelo]['rght']);
					
				if($programa[$modelo]['lft'] > $programas[$key-1][$modelo]['lft'] && 
					$programa[$modelo]['lft'] < $programas[$key-1][$modelo]['rght'])				
					$tagInicio = ', children: [{';
					//$tagInicio = '<ul><li>';
				//else if(count($niveles) == 1)					
					//$tagInicio = ',{';
				else					
					//$tagInicio = ',{';
					$tagInicio = '{';
					//$tagInicio = '<li>';
			}
			//$programas[$key][$modelo]['listaDesordenada'] = $tagCierre.(($tagCierre == '}' && $tagInicio == '{')?',':'').$tagInicio.
			//$programas[$key][$modelo]['listaDesordenada'] = $tagCierre.(($tagCierre != '')?'},':'').$tagInicio.
			$programas[$key][$modelo]['listaDesordenada'] = $tagCierre.(($tagCierre != '')?($tagCierre == '}'?',':'},'):'').$tagInicio.
															"text: '".$programa[$modelo]['etiqueta']."', ".
                                                            //"text: 'Lista de Acciones', ".
															"leaf: ".(empty($programa[$modelo]['solicitado'])?'false':'true').															
															(!empty($programa[$modelo]['solicitado'])?
																", url: '".$url.$programa['secprograms']['solicitado']."'".
																", phpController: '".$programa['secprograms']['controlador']."'".
																", phpAction: '".$programa['secprograms']['accion']."'":'');					
			//$programas[$key][$modelo]['listaDesordenada'] = $tagCierre.$tagInicio;					
			//$programas[$key][$modelo]['listaDesordenada'] = htmlentities($tagCierre.$tagInicio.$programa[$modelo][$etiqueta]);					
		}
		//pr($programas); exit;
		if(isset($niveles))
		for($i=0; $i<count($niveles); $i++)
			//$menu .= '&lt;/li&gt;<br/>&lt;/ul&gt;';
			//$menu .= '</li></ul>';
			//$programas[$key][$modelo]['listaDesordenada'] .= htmlentities('</li></ul>');
			//$programas[$key+1][$modelo]['listaDesordenada'] .= '</li></ul>';
			$programas[$key+1][$modelo]['listaDesordenada'] = '}]}]';
		//pr($programas);	
		return isset($programas)?$programas:array();	
	}
	
	public function agregarTag($arrego, $modelo, $etiqueta)
	{
		$programas = $arrego;
		$menu = '';
		$tagCierre = '';
        
		foreach($programas as $key=>$programa)		
		{			
			if($key == 0)
			{
				$niveles[0] = array('lft' => $programa[$modelo]['lft'],'rght' => $programa[$modelo]['rght']);	
				$tagInicio = '<ul id="navigation"><li>';						
			}
			else
			{
				$item = 1; 				
				krsort($niveles);				
				$tagCierre = '';			
				foreach($niveles as $key1=>$nivel)
				{					
					if($programa[$modelo]['lft'] > $nivel['lft'] && $programa[$modelo]['lft'] < $nivel['rght'])
					{						
						$niveles[count($niveles)] = array('lft' => $programa[$modelo]['lft'],'rght' => $programa[$modelo]['rght']);						
						 krsort ($niveles);	break;
					}
					else
					{						
						unset($niveles[$key1]); 
						if($item == 1)	
							//$tagCierre = '&lt;/li&gt;</br>';
							$tagCierre = '</li>';
						else
							{
								if($item == 2) 	
									//$tagCierre .= '&lt;/ul&gt;';
									$tagCierre .= '</ul>';
								else 
									//$tagCierre .= '&lt;/li&gt;<br/>&lt;/ul&gt;';
									$tagCierre .= '</li></ul>';
							}
						$item++;
					}								
				}				
				if(empty($niveles))
					$niveles[0] = array('lft' => $programa[$modelo]['lft'],'rght' => $programa[$modelo]['rght']);
					
				if($programa[$modelo]['lft'] > $programas[$key-1][$modelo]['lft'] && 
					$programa[$modelo]['lft'] < $programas[$key-1][$modelo]['rght'])				
					//$tagInicio = '<br/>&lt;ul&gt;<br/>&lt;li&gt;';
					$tagInicio = '<ul><li>';
				else					
					//$tagInicio = '<br/>&lt;li&gt;';
					$tagInicio = '<li>';
			}
			//$programas[$key][$modelo]['listaDesordenada'] = $tagCierre.$tagInicio.$programa[$modelo]['etiqueta'];					
			$programas[$key][$modelo]['listaDesordenada'] = $tagCierre.$tagInicio;					
			//$programas[$key][$modelo]['listaDesordenada'] = htmlentities($tagCierre.$tagInicio.$programa[$modelo][$etiqueta]);					
		}
		//pr($programas); exit;
		if(isset($niveles))
		for($i=0; $i<count($niveles); $i++)
			//$menu .= '&lt;/li&gt;<br/>&lt;/ul&gt;';
			//$menu .= '</li></ul>';
			//$programas[$key][$modelo]['listaDesordenada'] .= htmlentities('</li></ul>');
			//$programas[$key+1][$modelo]['listaDesordenada'] .= '</li></ul>';
			$programas[$key+1][$modelo]['listaDesordenada'] = '</li></ul>';
		//pr($programas);	
		return isset($programas)?$programas:array();	
	}
}
?>
