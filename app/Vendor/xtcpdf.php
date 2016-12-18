<?php 
// App::import('Vendor','tcpdf/tcpdf'); 
require_once(__DIR__.'/tcpdf/tcpdf.php');

if (!defined('PARAGRAPH_STRING')) define('PARAGRAPH_STRING', '~~~');

class XTCPDF extends TCPDF {
    var $title;
    private $parametros;
    private $subtitulo;
    private $rutaImagen;
    private $orientacionPapel;
    private $tituloEncabezadoIzquierdo;
    private $cantidadRegistro;
    private $sumaTotalFinal = array();
    private $cantidadTotalFinal;
    private $contador;
    private $etiquetaTotalFinal;
    
    const SALTO_LINEA = 3;
    const TAMANIO_LETRA = 8;
	
	//Una tabla más completa
	function ImprovedTable($header,$data)
	{
	    //Anchuras de las columnas
	    $w=array(40,35,40,45);
	    //Cabeceras
	    for($i=0;$i<count($header);$i++)
	        $this->Cell($w[$i],8,$header[$i],1,0,'C');
	    $this->Ln();
	    //Datos
	    foreach($data as $row)
	    {
	        $this->Cell($w[0],6,$row[0],'LR');
	        $this->Cell($w[1],6,$row[1],'LR');
	        $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R');
	        $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R');
	        $this->Ln();
	    }
	    //Línea de cierre
	    $this->Cell(array_sum($w),0,'','T');
	}
    
    function setparametrosTotalFinal($valor,$etiqueta)
    {
    	$this->cantidadTotalFinal = $valor;
    	//__TotalFinal = $etiqueta;
    }
    
    function setCantidadRegistro($valor)
    {
    	$this->cantidadRegistro = $valor;
    }
    
    function setParametro($valor)
    {
    	$this->parametros = $valor;	
    }
    
    function setSubTitulo($valor)
    {
    	$this->subtitulo = $valor;	
    }
    
    function setImagen($valor)
    {
    	$this->rutaImagen = $valor;
    }
    
    function settituloEncabezadoIzquierdo($valor)
    {
    	$this->tituloEncabezadoIzquierdo = $valor;
    }
    
    // funcion que define los parametros de configuracion del reporte
    function setup($orientation='P',$unit='mm',$format='A4') 
    {	
        //new TCPDF($orientation, $unit, $format);
		new TCPDF($orientation, $unit, $format, true, 'windows-1252');
		
        if($orientation == 'L') 
        	$this->orientacionPapel = 85;
    }
    
    // funcion que define los parametros de salida del reporte
    function fpdfOutput($name = 'page.pdf', $destination = 's') 
    {
        return $this->Output($name, $destination);
    }


    
    // Creado Por : Jorge Trujillo V.
    // funcion que establece un salto de linea
    function saltoDeLinea($aumento=0) {
		$this->Ln(self::SALTO_LINEA + $aumento);
    }
    
    // Creado Por : Jorge Trujillo V.
    // funcion que establece una linea horizontal del tamaño de la pagina
	function mostrarLinea() {
		$this->line($this->GetX(), $this->GetY() - 1, 205 + $this->orientacionPapel, $this->GetY() - 1);
	}
    
    // Creado Por : Jorge Trujillo V.
    // funcion que define la cabecera de la agrupacion
    function cabeceraAgrupada($cabeceraAgrupada) {
		// titulo del documento
    	$this->saltoDeLinea();
		$this->SetFont('Helvetica','BU',self::TAMANIO_LETRA + 3);
		$this->Cell(0,0,utf8_decode($this->title),0,0,'C');
		$this->saltoDeLinea(1);
		
		// criterios de busqueda de la agrupacion
		if(is_array($cabeceraAgrupada)) {
			foreach($cabeceraAgrupada as $id => $valor) {
				//sub titulo del documento
				$this->SetFont('Helvetica','B',self::TAMANIO_LETRA);
				$this->Cell(40,0,utf8_decode($valor['0']),0,0,'L');
				$this->SetFont('Helvetica','',self::TAMANIO_LETRA);
				$this->Cell($this->GetX(),0,utf8_decode($valor['1']),0,0,'L');
				$this->saltoDeLinea(1);
			}
		} else {
			$this->SetFont('Helvetica','',self::TAMANIO_LETRA);
			$this->Cell(0,0,utf8_decode($cabeceraAgrupada),0,0,'C');
			$this->saltoDeLinea();
		}
		$this->mostrarLinea();
		$this->saltoDeLinea();
    }
	
    // funcion que define el cuerpo del reporte
	function fancyTable($data,$muestraTotal,$cantidadRegistro = true,$mostraTitulo = true,$tituloAgrupado = Null,$tamanioLetra = null,$etiqueta = null,$etiqueta2 = null,$etiqueta3 = null, $subtituloEnNegrita = true) 
	{	
		$tamanio_celdas = 0;
		$cuentaRegistros = 0;	
		$sumaTotalFinal = array();	
		$this->Ln(self::SALTO_LINEA);
		if($mostraTitulo == true and $etiqueta == null)
		{
			$this->SetFont('Helvetica','BU',self::TAMANIO_LETRA + 3);
        	//titulo del documento
        	$this->Cell(0,0,utf8_decode($this->title),0,0,'C');
			$this->Ln(self::SALTO_LINEA+1);
		}
		
		if($this->subtitulo <> '')
		{
			if(is_array($this->subtitulo))
			{
				foreach($this->subtitulo as $id => $valor)
				{
					//sub titulo del documento
					$this->SetFont('Helvetica',($subtituloEnNegrita ? 'B' : ''),self::TAMANIO_LETRA);
        			$this->Cell(40,0,utf8_decode($valor['0']),0,0,'L');
					$this->SetFont('Helvetica','',self::TAMANIO_LETRA);
        			$this->Cell($this->GetX(),0,utf8_decode($valor['1']),0,0,'L');
        			$this->Ln(self::SALTO_LINEA + 1);
				}
			}else{
				//sub titulo del documento
				if($etiqueta == null)
				{
					$this->SetFont('Helvetica','',self::TAMANIO_LETRA);
	        		$this->Cell(0,0,utf8_decode($this->subtitulo),0,0,'C');
					$this->Ln(self::SALTO_LINEA);
				}			
				if($etiqueta2 <> '')
				{
					$this->SetFont('Helvetica','',self::TAMANIO_LETRA);
	        		$this->Cell(0,0,utf8_decode($etiqueta2),0,0,'L');
					$this->Ln(self::SALTO_LINEA);
				}
				if($etiqueta3 <> '')
				{
					$this->SetFont('Helvetica','',self::TAMANIO_LETRA);
					$this->Cell(0,0,utf8_decode($etiqueta3),0,0,'L');
					$this->Ln(self::SALTO_LINEA);	
				}
			}	
		}

		if($tituloAgrupado <> Null)
		{
			//titulo detalle agrupado del documento
			$this->SetFont('Helvetica','',self::TAMANIO_LETRA);
        	$this->Cell(0,3,utf8_decode($tituloAgrupado),0,0,'L');
			$this->Ln(self::SALTO_LINEA + 1);
		}
		
		$parametros 	= $this->parametros; 
		$arr_tamanio_celda 	= array();
		$arr_alineacion 	= array();
		$arr_campo			= array();
			// separa los elementos del arreglo parametro
			if (isset($parametros))
			{
				foreach ($parametros AS $id_arreglo => $id_valor)
				{
					$arr_campo[$id_valor[0]]			= $id_valor[0];	// arreglo del nombre de los campos			
					$arr_tamanio_celda[$id_valor[0]] 	= $id_valor[2]; // arreglo de tamanio
					$arr_alineacion[$id_valor[0]] 		= $id_valor[3];	// arreglo de alineacion
				}
			}
		//Configuraciones fijas para el encabezado del reporte
    	$this->SetFillColor(255,255,255); 	// define el color blanco para las tablas
    	$this->SetDrawColor(128,128,128);	// define el plomo para el borde de las tablas
    	$this->SetLineWidth(.3);			// define el ancho de la linea
    	$this->SetFont('Helvetica','B',self::TAMANIO_LETRA);		// define el formato de texto para le titulo    	
    	
    	foreach ($parametros as $valor)
    	{
    		$this->Cell($valor[2],6,utf8_decode($valor[1]),'BT',0,$valor[3],1); // establece el titulo de los campos
    		$tamanio_celdas = $tamanio_celdas + $valor[2];
    	};
    	
    	$this->Ln(self::SALTO_LINEA + 1);					// salto de linea
    	    	
    	if(isset($tamanioLetra))
    	$this->SetFont('Helvetica','',$tamanioLetra);	// defiene el formato del texto para el cuerpo del reporte
    	else
    	$this->SetFont('Helvetica','',self::TAMANIO_LETRA);	// defiene el formato del texto para el cuerpo del reporte
   				
		$totalPorCampo = array();	// almacena el total por campo
   		foreach($data as $indice)
		{
			foreach($indice as $registro)
			{	
				foreach($parametros as $valor)
				{																
					$this->Cell($valor[2],7,utf8_decode($registro[$valor[0]]),0,0,$valor[3],1);
					if(array_key_exists($valor[0], $totalPorCampo)){
						$totalPorCampo[$valor[0]] = $totalPorCampo[$valor[0]] + $registro[$valor[0]];						
					} else {
						$totalPorCampo[$valor[0]] = $registro[$valor[0]];
					}				
				}
			}
			$this->Ln(self::SALTO_LINEA + 1.5);
			$cuentaRegistros++;
		}
		$this->line($this->GetX(),$this->GetY()+2,$tamanio_celdas+5,$this->GetY()+2);	
		
		//-- si se elige mostrar los totales por campo
		if (is_array($muestraTotal))
		{
			$this->Ln(self::SALTO_LINEA - 2);		
			foreach($muestraTotal as $campo) 
			{	
				if(array_key_exists($campo, $arr_campo))
				{	
   					$this->SetFont('Helvetica','',self::TAMANIO_LETRA);	// defiene el formato del texto para el cuerpo del reporte		
					$this->Cell($arr_tamanio_celda[$campo],7,utf8_decode($totalPorCampo[$campo]),0,0,$arr_alineacion[$campo],0);

					// almacena en un arreglo por cada campo los valores para la suma total final del reporte
					if(array_key_exists($campo,$this->sumaTotalFinal))
					{
						$this->sumaTotalFinal[$campo] = $this->sumaTotalFinal[$campo] + $totalPorCampo[$campo];
						
					}else {
						$this->sumaTotalFinal[$campo] = $totalPorCampo[$campo]; 
					}
					
				}else {
					$capturaCampo = $this->convierteAarreglo(array_keys($muestraTotal,$campo)); // ubica el nombre del campo mediante el id
					if(eregi('NULL_',$campo)) // busca si la cadena 'NULL_' existe en el arreglo $campo
					{	// si existe asume que no se debe mostrar en el reporte
						$this->Cell($arr_tamanio_celda[$capturaCampo],7,Null,0,0,$arr_alineacion[$capturaCampo],0);
					}else {
						$this->SetFont('Helvetica','B',self::TAMANIO_LETRA);	// defiene el formato del texto para el cuerpo del reporte		
						$this->Cell($arr_tamanio_celda[$capturaCampo],7,utf8_decode($campo),0,0,$arr_alineacion[$capturaCampo],0);
					}
				}	
			}
			$this->Ln(self::SALTO_LINEA);
			}
			
			//-- si se elige mostrar total de registros		
			if($cantidadRegistro == true)
			{	$this->Ln(self::SALTO_LINEA + 2);	
    			$this->Cell(0,0,utf8_decode($this->cantidadRegistro .$cuentaRegistros),0,0,'L',0);
    			$this->Ln(self::SALTO_LINEA);
			}
			//--
			
			$this->contador = $this->contador + 1;			
			// muestra la suma total del reporte, cuando es mostrado por grupos
			if($this->cantidadTotalFinal == $this->contador)
			{	
				$this->line($this->GetX(),$this->GetY()+4,$tamanio_celdas+10,$this->GetY()+4);	
				//-- si se elige mostrar los totales por campo
				if (is_array($muestraTotal))
				{
					$this->Ln(self::SALTO_LINEA);		
					foreach($muestraTotal as $campo) 
					{	
						if(array_key_exists($campo, $arr_campo))
						{	
   							$this->SetFont('Helvetica','',self::TAMANIO_LETRA);	// defiene el formato del texto para el cuerpo del reporte		
							$this->Cell($arr_tamanio_celda[$campo],7,utf8_decode($this->sumaTotalFinal[$campo]),0,0,$arr_alineacion[$campo],0);
						}else {
							$capturaCampo = $this->convierteAarreglo(array_keys($muestraTotal,$campo)); // ubica el nombre del campo mediante el id
							if(eregi('NULL_',$campo)) // busca si la cadena 'NULL_' existe en el arreglo $campo
							{	// si existe asume que no se debe mostrar en el reporte
								$this->Cell($arr_tamanio_celda[$capturaCampo],7,Null,0,0,$arr_alineacion[$capturaCampo],0);
							}else {
								$this->SetFont('Helvetica','B',self::TAMANIO_LETRA);	// defiene el formato del texto para el cuerpo del reporte		
								$this->Cell($arr_tamanio_celda[$capturaCampo],7,utf8_decode(__TotalFinal),0,0,$arr_alineacion[$capturaCampo],0);
							}
						}	
					}
				}
			}			
	}
	
	/*-- funcion que retorna un arreglo lineal array('uno','dos'...) 
	 	a partir del arreglo compuesto lineal de php array('1'=>'uno', '2'=>'dos'....) --
	 	ejem : $registroBd = $this->convierteArreglo($fila); --*/
	public function convierteAarreglo($varArreglo) 
	{
    	if (is_array($varArreglo)) 		
    	{
        	$array = array(); // declara una variable para almacenar el nuevo arreglo
        	foreach ($varArreglo as $dato_varArreglo) 
        	{
            	$array[] = $this->convierteAarreglo($dato_varArreglo);	// almacena los datos del arreglo descartando los indices
        	}
        	return join(",", $array);	// une el arreglo con comas
    	}else {
        	return "" . addslashes(stripslashes($varArreglo)) . ""; //devuelve la cadena con barras invertidas
    	}
    	return false;	// retorna false si la variable varArreglo no es un arreglo
	}
}
?>