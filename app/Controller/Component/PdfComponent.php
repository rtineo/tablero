<?php
 
class PdfComponent extends Object {
	function initialize(){}
	function startup(){}
	function beforeRender(){}
	function shutdown(){}
	function beforeRedirect(){
		
	}
    function subirPdf($data, $directorio="pdf/"){
        $isPdf = substr($data['type'], -3);
		if(!in_array(strtoupper($isPdf), array('PDF'))){
			return "";
		}
        
        $archivo = md5(uniqid(rand(), true));
        $nom_pdf = substr($archivo, 2, 15);
        $nombre =$nom_pdf.".pdf";
		var_dump($nombre);
        if (move_uploaded_file($data['tmp_name'], $directorio.$nombre)){
            return $nombre;
        }else{
            return "";
        }
    }
}