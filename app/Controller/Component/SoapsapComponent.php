<?php
/**
 * SOAP component
 *
 * @author      RosSoft
 * @version     0.1
 * @license		 MIT
 * @package components
 */
App::import('Vendor', 'nusoap/nusoap');
class SoapsapComponent extends Component {
	var $controller;
	var $soapclient;

	//var $components=array('cacheObject');

	/**
	 * Enables the use of cache for the server WSDL file
	 */
	var $wsdl_cache=false;

	function startup(&$controller) {
		$this->controller =& $controller;
	}
	
	/**
	 * Execute directly a remote method from an URL
	 * @param string $url The url
	 * @param string $func The name of the function
	 * @param array $param An associative array of parameters
	 */
	/**
	 *RTINEO: modificado para 	que funcione con servidor proxy 
	 *FECHA : 15/06/2012
	 */

	function client($url, $soapaction, $body) {
		/*
		Configure::write('debug', 0);
		$credentialUsuario = Configure::read('usuariosap');
		$credentialPassword = Configure::read('passwordsap');
		$proxy = $this->controller->getProxy();
		
		if(!empty($proxy) && isset($proxy)){
			$proxyhost = $proxy['host'];
			$proxyport = $proxy['port'];
		}else{
			$proxyhost = false;
			$proxyport = false;
		}

		$this->soapclient = new soap_client($url,false,$proxyhost,$proxyport);
		$this->soapclient->soap_defencoding = 'UTF-8';
		$this->soapclient->setCredentials($credentialUsuario,$credentialPassword);
		$msg = $this->soapclient->serializeEnvelopeWithouHeader($body,false,array(),'document','literal');
		$response = $this->soapclient->send($msg, $soapaction);
		*/
		/**/
		Configure::write('debug', 0);
		$credentialUsuario = Configure::read('usuariosap');
		$credentialPassword = Configure::read('passwordsap');
		$proxy = $this->controller->getProxy();
		
		if(!empty($proxy) && isset($proxy)){
			$proxyhost = $proxy['host'];
			$proxyport = $proxy['port'];
		}else{
			$proxyhost = false;
			$proxyport = false;
		}

		$this->soapclient = new soap_client($url,false,$proxyhost,$proxyport);
		$this->soapclient->soap_defencoding = 'UTF-8';
		$this->soapclient->setCredentials($credentialUsuario,$credentialPassword);
		
		$this->log("SoapsapComponent URL:".$url,'debug');
		$this->log("SoapsapComponent USUARIO:".$credentialUsuario,'debug');
		$this->log("SoapsapComponent PASSWORD:".$credentialPassword,'debug');
		
		
		$msg = $this->soapclient->serializeEnvelopeWithouHeader($body,false,array(),'document','literal');
		$this->soapclient->clearDebug();

		$response = $this->soapclient->send($msg, $soapaction);
		$this->log($this->soapclient->getDebug(),'debug');
		
		$this->log("SoapsapComponent RESPONSE:".$response,'debug');
		
		/**/
		
		
		if($this->soapclient->fault){
			//echo '<b>FAIL: <br>'.$response.'</b>';
			$response['faultcode'] = '<b>FAIL: <br>'.$response.'</b>';
			return $response;
		}else{
			$err = $this->soapclient->getError();
			if($err){
				//echo '<b> ERROR: <br>'.$err.'</b>';
				$response['faultcode'] = '<b> ERROR: <br>'.$err.'</b><br>'.$response;
				return $response;
				//echo $response;
			}else{
				return $response;
			}
		}
	}
	 
	 
	 /**
	  * cliente before
	  */
	 
	function clientOld($url, $func, $param = array()) {
		configure::write('debug', 0);
		
		$wsdl=$this->_get_wsdl($url);

		//you have to rename all the instances of soapclient to soap_client in the file nusoap.php (PHP5 compat)
		$this->soapclient = new soap_client($wsdl, true);
		$response = $this->soapclient->call($func, $param);
		return $response;
	}
	/**
	 * Ejecuta directamente un metodo remoto desde una URL y URI (como parametro)
	 * @param {Object} $url Direccion del servicio
	 * @param {Object} $func Nombre del metodo a invocar
	 * @param {Object} $param Arreglo de parametros asociados
	 */
	function clientUri($url, $func, $param = array(), $uri) {
		Configure::write('debug', 0);
		
		$this->soapclient = new soap_client($url);
		$response = $this->soapclient->call($func, $param, $uri);
		return $response;
	}
	
	/**
	 * Ejecuta directamente un metodo remoto desde una URL
	 * @param {Object} $url Direccion del servicio
	 * @param {Object} $func Nombre del metodo a invocar
	 * @param {Object} $param Arreglo de parametros asociados
	 */
	function clientFunc($url, $func, $param = array()) {
		Configure::write('debug', 0);
		
		$this->soapclient = new SoapClient($url);
		$response = $this->soapclient->{$func}($param);
		return $response;
	}

	/**
	 * Returns a proxy object for calling remote methods from an URL
	 * @param string $url The url
	 * @return object The proxy object
	 */

	function & client_proxy($url) {
		$wsdl = $this->_get_wsdl($url);
		$this->soapclient = new soap_client($wsdl, true);

		$proxy = $this->soapclient->getProxy();
		return $proxy;
	}

	/**
	 * Retrieves a wsdl object with the WSDL file parsed. It caches the result
	 * @param string $url Url of the WSDL file
	 * @return object Instance of wsdl class
	 */
	function & _get_wsdl($url,$proxyhost=false,$proxyport=false) {
		if ($this->wsdl_cache) {
			$cacheName='soapclient/'.md5($url).'.wsdl';

			$wsdl = $this->cacheObject->read($cacheName);
			if (!$wsdl) {
				$wsdl =& new wsdl($url, false, false, false, false, 0, 30);
				$this->cacheObject->write($cacheName, $wsdl, '+1 Day', 2);
			}
		} else {
			$wsdl =& new wsdl($url, $proxyhost, $proxyport, false, false, 0, 30);
		}
		return $wsdl;
	}

	/**
	 * Returns the last response from server
	 * @return array('http'=>httpdata, 'data'=>soap payload of http data)
	 */
	function response() {
		return array(
			'http'=>$this->soapclient->response,
			'data'=>$this->soapclient->responseData
		);
	}

	/*
	//obsolete
	function service($name = false) {
		global $api;
		global $controller;

		//clean the output
		ob_end_clean();
		$this->controller->autoRender = false;

		//include the service
		$controller = $this->controller;
		$name = $this->controller->action;
		$servicefile = Inflector::underscore($this->controller->name).DS.$name.'.php';
		require_once CONTROLLERS.'soap_services'.DS.$servicefile;

		//create a soap server
		vendor('webservices/nusoap');
		$server = new soap_server();
		//$server->wsdl->addComplexType(<br />

		$wsdl = "{$name}wsdl";
		$urn = "urn:$wsdl";
		$server->configureWSDL($wsdl, $urn);
		//Register the method to expose
		$server->register(	$name,$api['input'],$api['output'],
						  	$urn, "$urn#$name",
					    	'rpc',		// style
    						'encoded', // use
    						$api['doc']);	// documentation

		global $HTTP_RAW_POST_DATA;
		$data = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
		$server->service($data);
	}
	*/
}