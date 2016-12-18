<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
App::uses('CakeEmail', 'Network/Email');
class AppController extends Controller {
	public $components = array('Auth','Acl','Buscador','Menu','Session', 'Calendario', 'Datos');
	public $helpers = array('Html','Form','Js','Session', 'Xhtml');
	public $uses = array('Secperson','Secassign','Secorganization','Secprogram');//supuestamente removido en cake 2.x
    public $datosLogeo,$treePanel;
	
	function beforeFilter()
	{
		$this->set('title_for_layout', 'Sistema de Apoyo DERCO');
		//define('IMAGENES_PATH','..'.DS.'..'.DS.'Imagenes'.DS);//constante ya definida

		set_time_limit(600);
        ini_set('memory_limit', '510M');

		if(isset($this->request->data['Secperson']) && isset($this->request->data['Secassign']))
		{
			$this->request->data['Secassign']['secperson_id'] = $this->Secperson->field('id',array('username' => $this->request->data['Secperson']['username'],
																'password' => $this->Auth->password(strtolower($this->request->data['Secperson']['password']))));
			$this->request->data['Secassign']['fixticio'] = 'c€s@r1.';
		}
        
		if(isset($this->request->data['Secassign']['secperson_id']) && isset($this->request->data['Secassign']['secrole_id']) && isset($this->request->data['Secassign']['secproject_id']) )
						{$this->Auth->authenticate = array('Form' => array(
							                                        'userModel'=>'Secassign',
							                                        'fields' => array('username' => 'secperson_id','password' => 'fixticio'),
							                                        'scope'=>array('Secassign.secperson_id' => $this->request->data['Secassign']['secperson_id'],
											                                        'Secassign.secrole_id' => $this->request->data['Secassign']['secrole_id'],
											                                        'Secassign.secproject_id' => $this->request->data['Secassign']['secproject_id'],
											                                        'Secassign.status' => 'AC')
                                         ));                                                        
                        }
       
        $this->Auth->authorize = array(
                'Actions' => array('actionPath' => 'controllers','userModel'=>'Secassign')
            );
           pr('aca');
        $this->Auth->loginAction = array('controller' => 'secassigns', 'action' => 'login');
        $this->Auth->logoutRedirect = array('controller' => 'secassigns', 'action' => 'login');
        $this->Auth->loginRedirect = array('controller' => 'pages', 'action' => 'home');

		$this->Auth->loginError = __('logioFallido');
		$this->Auth->authError = __('noAutoriazado');

		$this->Auth->allow(
							//Pagina de incio
							'home',		
							'display',						
							//Para password
							'login',
							'logout',
							'asignacion',
							'listprojects',
							'listroles'
		);
			
	//$this->Auth->allow(); 	//control de acl en cakephp 2.X
		
        $this->Session->write('Auth.redirect',null);            
        $secassign_id = $this->Auth->User('id');
		if(!empty($secassign_id))
		{
			$this->Secassign->recursive = 0;
			$this->datosLogeo = $this->Secassign->find('all',array(
																'fields' => array(
																				   'Secperson.id',
																				   'Secperson.appaterno',
																				   'Secperson.apmaterno',
																				   'Secperson.firstname',
																				   'Secperson.username',
																				   'Secperson.email',
																				   'Secproject.id',
																				   'Secproject.name',
																				   'Secproject.secorganization_id',
																				   'Secrole.id',
																				   'Secrole.name',
																				   'Secrole.code'
																				   ),
																'conditions' => array('Secassign.id' => $secassign_id)
															)
												);
		
			$this->Secorganization->recursive = -1;
			$secorganization = $this->Secorganization->findById($this->datosLogeo['0']['Secproject']['secorganization_id'],array('id','name', 'photo1'));

			$this->datosLogeo['0']['Secorganization']['name'] = $secorganization['Secorganization']['name'];
			$this->datosLogeo['0']['Secorganization']['id'] = $secorganization['Secorganization']['id'];

			$this->set('datosLogeo',$this->datosLogeo);
			$secrole_id = $this->Auth->user('secrole_id');
			$this->set('permisorolid',$secrole_id);
			$menu = $this->Secprogram->menu($secrole_id);
			// Script para generar el Menu en JSON
			//pr($menu);
			$url="http://".$_SERVER['HTTP_HOST'].$this->Webroot;
			$menuJson = $this->Menu->menuJson($menu,'secprograms',$url);                
			foreach($menuJson as $id => $item)
			{
				$treePanel[$id] = $item['secprograms']['listaDesordenada'];
			}
			$treePanel = isset($treePanel)?implode('', $treePanel):array();
			$this->set('treePanel',$treePanel);
			foreach($menu as $key => $etiqueta){
				if(empty($menu[$key]['secprograms']['solicitado'])){
					$menu[$key]['secprograms']['etiqueta'] = '<span>'.__($etiqueta['secprograms']['etiqueta']).'</span>';
				}
			}
			$menus = $this->Menu->agregarTag($menu,'secprograms','etiqueta');
			$this->set('menu',$menus);

			//busqueda de la imagen de la organizacion
			$logoEmpresa = $secorganization['Secorganization']['photo1'];
			$this->set('logoEmpresa', $logoEmpresa);
		}
		
	}

	function _sendMail($to,$message,$attachments = array(),$from = 'DERCOPERU@DERCOPERU.COM',$fromName = 'ERP',$subject='DERCOPERU') {
//		  $correo_params = $this->_getParametrosCorreo();
//		  $this->SwiftMailer->smtpHost = $correo_params['smtphost'];
//        $this->SwiftMailer->smtpPort = $correo_params['smtpport'];
//        $this->SwiftMailer->smtpUsername = $correo_params['smtpusername'];
//        $this->SwiftMailer->smtpPassword = $correo_params['smtppassword'];

        $this->SwiftMailer->sendAs = 'html';
        $this->SwiftMailer->from = $from;
        $this->SwiftMailer->fromName = $fromName;

		$correo = $to;

		$this->SwiftMailer->to = $correo;

        $this->set('message', $message);

		if(count($attachments) > 0){
			$this->SwiftMailer->attachments = $attachments;
		}

        try {
            if(!$this->SwiftMailer->send('im_excited', $subject)) {
                $this->log("Error sending email");
				$envio = false;
            }else{
            	$envio = true;
            }$envio = true;
        }
        catch(Exception $e) {
              $this->log("Failed to send email: ".$e->getMessage());
			  $envio = false;
        }
		return $envio;
	}

	function datosAuditoria(){
		//campos para audotoria
		$datosLogeo = $this->datosLogeo;
		$params = $this->request->params;//$this->request->url;//actual en cake 2.x
		$data['audip'] = $_SERVER['REMOTE_ADDR'];
		$data['audperson_id'] = $datosLogeo[0]['Secperson']['id'];
		$data['audfechasistema'] = date('d/m/Y H:i:s');
		$data['audcontroller'] = $params['controller'];
		$data['audaction'] = $params['action'];

		return $data;
	}

	function _getParametrosCorreo(){
		$datosLogeo = $this->datosLogeo;
		$organization_id = $datosLogeo[0]['Secorganization']['id'];
		$secorganization_correo = $this->Secorganization->find('first',array('fields'=>array('Secorganization.smtphost','Secorganization.smtpport','Secorganization.smtpusername','Secorganization.smtppassword'),'conditions'=>array('Secorganization.id'=>$organization_id)));
		return $secorganization_correo['Secorganization'];
	}

	/**
	 * ##############################################################################
	 */

	/**
	 * FUNCION QUE NOS ARMA LA CONDICION DE BUSQUEDA
	 * @author VENTURA RUDA, JOSE ANTONIO
	 * @param object $fechaInicial [optional]
	 * @param object $fechaFinal [optional]
	 * @param object $field [optional]
	 * @return Array condiciones de busqueda
	 * @version 0.2 2012-02-29 13:12
	 */
	function _condicionFecha($fechaInicial = null, $fechaFinal = null, $field = null) {
		if(empty($fechaInicial) && empty($fechaFinal)) {
			return array();
		}

		if(!empty($fechaInicial)) {
			$fechaInicial = explode('/', $fechaInicial);
			$fechaInicial = mktime(0, 0, 0, $fechaInicial[1], $fechaInicial[0], $fechaInicial[2]);
			$fechaInicial = date('Y-m-d 00:00:00', $fechaInicial);
		}
		if(!empty($fechaFinal)) {
			$fechaFinal = explode('/', $fechaFinal);
			$fechaFinal = mktime(0, 0, 0, $fechaFinal[1], $fechaFinal[0], $fechaFinal[2]);
			$fechaFinal = date('Y-m-d 23:59:59', $fechaFinal);
		}

		// armamos la condicion por fecha
		if(!empty($fechaInicial) || !empty($fechaFinal)) {
			if(!empty($fechaInicial) && !empty($fechaFinal)) {
				$conditions = array("$field BETWEEN ? AND ?" => array("'$fechaInicial'", "'$fechaFinal'"));
			} else {
				$conditions = !empty($fechaInicial) ? array("$field >= '$fechaInicial'") : $conditions = array("$field <= '$fechaFinal'");
			}
		}
		return empty($conditions) ? array() : $conditions;
	}

	/**NOS ARMA LA BUSQUEDA POR UN NUMERO DE DOCUMENTO
	 * @autor: VENTURA RUEDA, JOSE ANTONIO
	 * @param object $valor NUMERO DEL DOCUMENTO A BUSCAR
	 * @param object $field CAMPO (Model.field) formato cakephp
	 * @return
	 */
	function _condicionDocumento($field, $valor){
		if(empty($valor)) return array();

		$vlr = explode('-', $valor);
		$cnt = count($vlr);
		if($cnt == 2){
			$serie = trim($vlr[0]);
			$nro = trim($vlr[1]);

			if(empty($serie)){
				return array("$field LIKE"=>"$nro");
			}else{
				return array('0'=>"(substring($field from 0 for position('-' in $field)) = upper('$serie')
											and substring($field from position('-' in $field)+1) like '%$nro%')");
			}
		}

		return array("$field LIKE"=>"$valor");
	}

	/**INICIALIZA LAS CONDICIONES EN SESSION PARA LA ACCION LLAMADA
	 * @AUTOR: VENTURA RUEDA, JOSE ANTONIO
	 * @FECHA: 2012-05-23
	 * @param object $view [optional] = VISTA DE LA CUAL SE GUARDA LAS CONDICIONES
	 * @return
	 */
	function setInitSessionConditions($view = null){
		$controller = ucfirst(strtolower($this->request->params['controller']));
		$view = empty($view)?ucfirst(strtolower($this->request->params['action'])):ucfirst(strtolower($view));
		$page = empty($this->request->params['named']['page'])?'0':$this->request->params['named']['page'];
		if(empty($page)){
			if($this->Session->check("conditions.$controller.$view"))
				$this->Session->delete("conditions.$controller.$view");
		}
	}

	/**ACTUALIZA LAS CONDICIONES EN LA SESSION
	 * @AUTOR: VENTURA RUEDA, JOSE ANTONIO
	 * @FECHA: 2012-05-23
	 * @param object $dt [array] = CONDICIONES A ALMACENAR EN SESSION
	 * @param object $view [optional] = VISTA DE LA CUAL SE GUARDA LAS CONDICIONES
	 * @return
	 */
	function setSessionConditions($dt, $view = null){
		$controller = ucfirst(strtolower($this->request->params['controller']));
		$view = empty($view)?ucfirst(strtolower($this->request->params['action'])):ucfirst(strtolower($view));
		$this->Session->write("conditions.$controller.$view",$dt);
	}

	/**RECUPERAMOS LAS CONDICIONES GUARDADAS EN SESSION DE LA VISTA
	 * @AUTOR: VENTURA RUEDA, JOSE ANTONIO
	 * @FECHA: 2012-05-23
	 * @param object $view [optional] = VISTA DE LA CUAL SE RECUPERAN LAS CONDICIONES
	 * @return
	 */
	function getSessionConditions($view = null){
		$controller = ucfirst(strtolower($this->request->params['controller']));
		$view = empty($view)?ucfirst(strtolower($this->request->params['action'])):ucfirst(strtolower($view));
		if($this->Session->check("conditions.$controller.$view")) return $this->Session->read("conditions.$controller.$view");
		else return array();
	}
	
	/**RETORNA LOS DATOS DE LOGEO
	 * @AUTOR: VENTURA RUEDA, JOSE ANTONIO
	 * @FECHA: 2012-05-23
	 * @return 
	 */
	function _getDtLg(){
		$dtLog = $this->datosLogeo[0];
		$dtLog['userName'] = sprintf("%s %s, %s", $dtLog['Secperson']['appaterno'], $dtLog['Secperson']['apmaterno'], $dtLog['Secperson']['firstname']);
		$dtLog['role'] = empty($dtLog['Secrole']['name'])?"":$dtLog['Secrole']['name'];
		//RECUPERAMOS LOS DATOS DEL ALMACEN PERTENECIENTE A LA SUCURSAL
//		$this->Worwarehouse->recursive = -1;
//		$warehouse = $this->Worwarehouse->find('first',array(
//			'conditions'=>array('Worwarehouse.secproject_id'=>$dtLog['Secproject']['id'], 'Worwarehouse.basicstatu_id'=>'1')
//		));
//		
//		$dtLog['Worwarehouse'] = empty($warehouse)?array():$warehouse['Worwarehouse'];  // ya que el almacen es por defecto 
		return $dtLog;
	}
	
	/**
	 * 
	 * @param object $mail_to
	 * @param object $nombre [optional]
	 * @param object $dni [optional]
	 * @param object $password [optional]
	 * @return 
	 */
	public function sendMailClient($mail_to = "dinho.rhts@gmail.com", $nombre = "<su nombre>", $dni = "<DNI>", $password = "password"){
		/* Email Detials */
		$from_mail = "dercocitas@dercoperu.net";
		$from_name = "Derco Center";
		$reply_to = ""; // "<reply-to address>";
		$subject = "DERCO CENTER - DATOS USUARIO";
		
		$nombre = strtoupper($nombre);
		
		$message = "<em>Estimado(a) cliente <strong> $nombre </strong></em>Gracias por registrarse en nuestro sistema de agendamiento en l&iacute;nea.  "
				."Ahora puede agendar y mantenerse en contacto con nuestro departamento de servicio técnico."
				."<div>&nbsp;</div>"
				."<table><tbody><tr>"
					."<td><strong>Usuario</strong></td><td><strong>:</strong></td><td>$dni</td>"
				."</tr><tr>"
					."<td><strong>Password</strong></td><td><strong>:</strong></td><td>$password</td>"
				."</tr></tbody></table>".PHP_EOL;
		
		
		/* Attachment File */
		// Attachment location
		//  $file_name = "<attachment file name>";
		//  $path = "<relative path/absolute path which contains the attachment>";
		
		// Read the file content
//		$file = $path.$file_name;
//		$file_size = filesize($file);
//		$handle = fopen($file, "r");
//		$content = fread($handle, $file_size);
//		fclose($handle);
//		$content = chunk_split(base64_encode($content));
		
		/* Set the email header */
		// Generate a boundary
		$boundary = md5(uniqid(time()));
		
		// Email header
		$header = "From: ".$from_name." <".$from_mail.">".PHP_EOL;
		$header .= "Reply-To: ".$reply_to.PHP_EOL;
		$header .= "MIME-Version: 1.0".PHP_EOL;
		
		// Multipart wraps the Email Content and Attachment
		$header .= "Content-Type: multipart/mixed; boundary=\"".$boundary."\"".PHP_EOL;
		$header .= "This is a multi-part message in MIME format.".PHP_EOL;
		$header .= "--".$boundary.PHP_EOL;
		
		// Email content
		// Content-type can be text/plain or text/html
		//  $header .= "Content-type:text/plain; charset=iso-8859-1".PHP_EOL;
		$header .= "Content-type:text/html; charset=iso-8859-1".PHP_EOL;
		$header .= "Content-Transfer-Encoding: 7bit".PHP_EOL.PHP_EOL;
		$header .= "$message".PHP_EOL;
		$header .= "--".$boundary.PHP_EOL;
		
		// Attachment
		// Edit content type for different file extensions
		//  $header .= "Content-Type: application/xml; name=\"".$file_name."\"".PHP_EOL;
		//  $header .= "Content-Transfer-Encoding: base64".PHP_EOL;
		//  $header .= "Content-Disposition: attachment; filename=\"".$file_name."\"".PHP_EOL.PHP_EOL;
		//  $header .= $content.PHP_EOL;
		//  $header .= "--".$boundary."--";
		
		// Send email
		/*if (mail($mail_to, $subject, "", $header)) {
			return true;
		} else {
			return false;
		}*/
		return true;
	}
	
	/**
	 * 
	 * @param object $mail_to
	 * @param object $nombre [optional]
	 * @param object $dni [optional]
	 * @param object $password [optional]
	 * @return 
	 */
	public function sendMailClientUpdate($mail_to = "dinho.rhts@gmail.com", $nombre = "<su nombre>"){
		/* Email Detials */
		$from_mail = "dercocitas@dercoperu.net";
		$from_name = "Derco Center";
		$reply_to = ""; // "<reply-to address>";
		$subject = "DERCO CENTER - DATOS USUARIO";
		
		$nombre = strtoupper($nombre);
		
		$message = "<em>Estimado(a) cliente <strong> $nombre </strong></em>Gracias por actualizar sus datos en el sistema en l&iacute;nea.  "
				."Ahora puede agendar y mantenerse en contacto con nuestro departamento de servicio técnico."
				."<div><hr/></div>".PHP_EOL;
		
		
		/* Attachment File */
		// Attachment location
		//  $file_name = "<attachment file name>";
		//  $path = "<relative path/absolute path which contains the attachment>";
		
		// Read the file content
//		$file = $path.$file_name;
//		$file_size = filesize($file);
//		$handle = fopen($file, "r");
//		$content = fread($handle, $file_size);
//		fclose($handle);
//		$content = chunk_split(base64_encode($content));
		
		/* Set the email header */
		// Generate a boundary
		$boundary = md5(uniqid(time()));
		
		// Email header
		$header = "From: ".$from_name." <".$from_mail.">".PHP_EOL;
		$header .= "Reply-To: ".$reply_to.PHP_EOL;
		$header .= "MIME-Version: 1.0".PHP_EOL;
		
		// Multipart wraps the Email Content and Attachment
		$header .= "Content-Type: multipart/mixed; boundary=\"".$boundary."\"".PHP_EOL;
		$header .= "This is a multi-part message in MIME format.".PHP_EOL;
		$header .= "--".$boundary.PHP_EOL;
		
		// Email content
		// Content-type can be text/plain or text/html
		//  $header .= "Content-type:text/plain; charset=iso-8859-1".PHP_EOL;
		$header .= "Content-type:text/html; charset=iso-8859-1".PHP_EOL;
		$header .= "Content-Transfer-Encoding: 7bit".PHP_EOL.PHP_EOL;
		$header .= "$message".PHP_EOL;
		$header .= "--".$boundary.PHP_EOL;
		
		// Attachment
		// Edit content type for different file extensions
		//  $header .= "Content-Type: application/xml; name=\"".$file_name."\"".PHP_EOL;
		//  $header .= "Content-Transfer-Encoding: base64".PHP_EOL;
		//  $header .= "Content-Disposition: attachment; filename=\"".$file_name."\"".PHP_EOL.PHP_EOL;
		//  $header .= $content.PHP_EOL;
		//  $header .= "--".$boundary."--";
		
		// Send email
		/*if (mail($mail_to, $subject, "", $header)) {
			return true;
		} else {
			return false;
		}*/
		return true;
	}
	
	/**
	 * 
	 * @param object $mail_to
	 * @param object $nombre [optional]
	 * @param object $dni [optional]
	 * @param object $password [optional]
	 * @return 
	 */
	public function sendMailClientForgotPassword($mail_to='dinho.rhts@gmail.com', $nombre = "su nombre", $dni = "DNI", $url = "#"){
		/* Email Detials */
		$from_mail = "dercocitas@dercoperu.net";
		$from_name = "Derco Center";
		$reply_to = ""; // "<reply-to address>";
		$subject = "DERCOCENTER CITAS- GENERACION DE NUEVA CONTRASEÑA";
		
		$nombre = strtoupper($nombre);
		
		$message = "<em>Estimado(a) cliente <strong> $nombre </strong></em>Gracias por usar nuestro sistema de agendamiento en línea.  "
				."<div>&nbsp;</div><hr/>"
				."<table><tr>"
					."<td><strong>Para poder terminar con su solicitud de cambio de contrase&ntilde;a Ud. deber&aacute; dar click en el siguiente enlace.</strong></td>"
				."</tr><tr>"
					."<td><a target=\"_blank\" href=\"$url\">$url</a></td>"
				."</tr><tr>"
					."<td><strong>En caso que que el enlace no funcione, copie el mismo en una nueva ventana de su navegador</strong></td>"
				."</tr><tr>"
					."<td><hr/></td>"
				."</tr><tr style='color:red'>"
					."<td><strong>SI UD. NO SOLICITÓ; EL CAMBIO DE CONTRASEÑA, POR FAVOR OMITA ESTA MENSAJE</strong></td>"
				."</tr></tbody></table>".PHP_EOL;
		
		
		/* Attachment File */
		// Attachment location
		//  $file_name = "<attachment file name>";
		//  $path = "<relative path/absolute path which contains the attachment>";
		
		// Read the file content
//		$file = $path.$file_name;
//		$file_size = filesize($file);
//		$handle = fopen($file, "r");
//		$content = fread($handle, $file_size);
//		fclose($handle);
//		$content = chunk_split(base64_encode($content));
		
		/* Set the email header */
		// Generate a boundary
		$boundary = md5(uniqid(time()));
		
		// Email header
		$header = "From: ".$from_name." <".$from_mail.">".PHP_EOL;
		$header .= "Reply-To: ".$reply_to.PHP_EOL;
		$header .= "MIME-Version: 1.0".PHP_EOL;
		
		// Multipart wraps the Email Content and Attachment
		$header .= "Content-Type: multipart/mixed; boundary=\"".$boundary."\"".PHP_EOL;
		$header .= "This is a multi-part message in MIME format.".PHP_EOL;
		$header .= "--".$boundary.PHP_EOL;
		
		// Email content
		// Content-type can be text/plain or text/html
		//  $header .= "Content-type:text/plain; charset=iso-8859-1".PHP_EOL;
		$header .= "Content-type:text/html; charset=iso-8859-1".PHP_EOL;
		$header .= "Content-Transfer-Encoding: 7bit".PHP_EOL.PHP_EOL;
		$header .= "$message".PHP_EOL;
		$header .= "--".$boundary.PHP_EOL;
		
		// Attachment
		// Edit content type for different file extensions
		//  $header .= "Content-Type: application/xml; name=\"".$file_name."\"".PHP_EOL;
		//  $header .= "Content-Transfer-Encoding: base64".PHP_EOL;
		//  $header .= "Content-Disposition: attachment; filename=\"".$file_name."\"".PHP_EOL.PHP_EOL;
		//  $header .= $content.PHP_EOL;
		//  $header .= "--".$boundary."--";
		
		// Send email
		/*if (mail($mail_to, $subject, "", $header)) {
			return true;
		} else {
			return false;
		}*/
		return true;
	}
	
	/**
	 * 
	 * @param object $mail_to
	 * @param object $params array('motivo', 'numero_cita', 'nombres_apellidos', 'dni', 'fecha_reserva', 'ot', ') 
	 * @return 
	 */
	public function sendMailClientMakeCita($agedetallecitaId){
		$ageDC = $this->Agedetallecita->findById($agedetallecitaId);
		
		/* Email Detials */
		// descomentar al final
		$mail_to = empty($ageDC['Cliente']['email'])?"citasderco@dercoperu.net":$ageDC['Cliente']['email'];
		//$mail_to = "dinho.rhts@gmail.com";
		$from_mail = "citasderco@dercoperu.net";
		$from_name = "Derco Center";
		$reply_to = "citasderco@dercoperu.net"; // "<reply-to address>";
		$subject = sprintf("RESERVA PARA %s-%s", $ageDC['Agetiposervicio']['description'], $ageDC['Agemotivoservicio']['description']);
		
		$direccion = $ageDC['Secproject']['address'];
		$local = $ageDC['Secproject']['name'];
		if($ageDC['Agedetallecita']['secproject_id'] == 1){
			$direccion = "Av. Los Castillos 538, Ate";
		}
		if($ageDC['Agedetallecita']['agecitacalendario_id'] == 24){
			$direccion = "De tratarse de un Servicio Delivery, nuestra unidad de Taller móvil se acercará a la dirección brindada al momento de generar su cita";
			$local = "";
		}

		$message = sprintf("<em>RESERVA PARA  <strong>%s-%s</strong> N° <strong>%s</strong></em>", $ageDC['Agetiposervicio']['description'], $ageDC['Agemotivoservicio']['description']).PHP_EOL
				."<br/>"
				.sprintf("Estimado(a) Sr(a). %s", $ageDC['Cliente']['nombres']).PHP_EOL
				."<br/>"
				.sprintf("RUT/DNI : %s", $ageDC['Cliente']['documento_numero']).PHP_EOL
				."<div>&nbsp;</div>"
				.sprintf("Confirmamos su reserva de servicio técnico").PHP_EOL
				."<br/>"
				.sprintf("La reserva ha sido realizada para el %s", substr($ageDC['Agedetallecita']['fechadecita'], 0, 10)).PHP_EOL
				."<div>&nbsp;</div>"
				."<table><tbody><tr>"
					.sprintf("<td><strong>Nro de reserva</strong></td><td><strong>:</strong></td><td>%s</td>", $ageDC['Agedetallecita']['otsap'])
				."</tr><tr>"
					.sprintf("<td><strong>Hora</strong></td><td><strong>:</strong></td><td>%s horas</td>", substr($ageDC['Agedetallecita']['fechadecita'], 10, 6))
				."</tr><tr>"
					.sprintf("<td><strong>Servicio</strong></td><td><strong>:</strong></td><td>%s</td>", $ageDC['Agemotivoservicio']['description'])
				."</tr><tr>"
					.sprintf("<td><strong>Marca</strong></td><td><strong>:</strong></td><td>%s</td>", $ageDC['Agedetallecita']['marca'])
				."</tr><tr>"
					.sprintf("<td><strong>Modelo</strong></td><td><strong>:</strong></td><td>%s</td>", $ageDC['Agedetallecita']['modelo'])
				."</tr><tr>"
					.sprintf("<td><strong>Año</strong></td><td><strong>:</strong></td><td>%s</td>", "---")
				."</tr><tr>"
					.sprintf("<td><strong>Placa</strong></td><td><strong>:</strong></td><td>%s</td>", $ageDC['Agedetallecita']['placa'])
				."</tr><tr>"
					.sprintf("<td><strong>Taller de servicio</strong></td><td><strong>:</strong></td><td>%s</td>", $local)
				."</tr><tr>"
					.sprintf("<td><strong>Dirección</strong></td><td><strong>:</strong></td><td>%s</td>", $direccion)
				."</tr><tr>"
					.sprintf("<td><strong>Teléfono</strong></td><td><strong>:</strong></td><td>%s</td>", $ageDC['Secproject']['phono'])
				."</tr></tbody></table>".PHP_EOL;

		/*
		$boundary = md5(uniqid(time()));
		
		// Email header
		$header = "From: ".$from_name." <".$from_mail.">".PHP_EOL;
		$header .= "Reply-To: ".$reply_to.PHP_EOL;
		$header .= "MIME-Version: 1.0".PHP_EOL;
		
		// Multipart wraps the Email Content and Attachment
		$header .= "Content-Type: multipart/mixed; boundary=\"".$boundary."\"".PHP_EOL;
		$header .= "This is a multi-part message in MIME format.".PHP_EOL;
		$header .= "--".$boundary.PHP_EOL;
		
		// Email content
		// Content-type can be text/plain or text/html
		//  $header .= "Content-type:text/plain; charset=iso-8859-1".PHP_EOL;
		$header .= "Content-type:text/html; charset=iso-8859-1".PHP_EOL;
		$header .= "Content-Transfer-Encoding: 7bit".PHP_EOL.PHP_EOL;
		$header .= "$message".PHP_EOL;
		$header .= "--".$boundary.PHP_EOL;*/
		
		
		// Send email
		if ($this->mail_($mail_to, $subject, "", $message)) {
		return true;
		} else {
		return false;
		}
	}
	
	/**
	 * 
	 * @param object $mail_to
	 * @param object $params array('motivo', 'numero_cita', 'nombres_apellidos', 'dni', 'fecha_reserva', 'ot', ') 
	 * @return 
	 */
	public function sendMailTest(){
		$ageDC = $this->Agedetallecita->findById(117);
		
		/* Email Detials */
		$mail_to = "jose.antonio.ventura.rueda@gmail.com";
		$from_mail = "dercocitas@dercoperu.net";
		$from_name = "Derco Center";
		$reply_to = ""; // "<reply-to address>";
		$subject = sprintf("RESERVA PARA %s-%s", $ageDC['Agetiposervicio']['description'], $ageDC['Agemotivoservicio']['description']);
		
		$message = sprintf("<em>RESERVA PARA  <strong>%s-%s</strong> N° <strong>%s</strong></em>", $ageDC['Agetiposervicio']['description'], $ageDC['Agemotivoservicio']['description']).PHP_EOL
				."<br/>"
				.sprintf("Estimado(a) Sr(a). %s", $ageDC['Cliente']['nombres']).PHP_EOL
				."<br/>"
				.sprintf("RUT/DNI : %s", $ageDC['Cliente']['documento_numero']).PHP_EOL
				."<div>&nbsp;</div>"
				.sprintf("Confirmamos su reserva de servicio técnico").PHP_EOL
				."<br/>"
				.sprintf("La reserva ha sido realizada para el %s", substr($ageDC['Agedetallecita']['fechadecita'], 0, 10)).PHP_EOL
				."<div>&nbsp;</div>"
				."<table><tbody><tr>"
					.sprintf("<td><strong>Nro de reserva</strong></td><td><strong>:</strong></td><td>%s</td>", $ageDC['Agedetallecita']['otsap'])
				."</tr><tr>"
					.sprintf("<td><strong>Hora</strong></td><td><strong>:</strong></td><td>%s horas</td>", substr($ageDC['Agedetallecita']['fechadecita'], 10, 6))
				."</tr><tr>"
					.sprintf("<td><strong>Servicio</strong></td><td><strong>:</strong></td><td>%s</td>", $ageDC['Agemotivoservicio']['description'])
				."</tr><tr>"
					.sprintf("<td><strong>Marca</strong></td><td><strong>:</strong></td><td>%s</td>", $ageDC['Agedetallecita']['marca'])
				."</tr><tr>"
					.sprintf("<td><strong>Modelo</strong></td><td><strong>:</strong></td><td>%s</td>", $ageDC['Agedetallecita']['modelo'])
				."</tr><tr>"
					.sprintf("<td><strong>Año</strong></td><td><strong>:</strong></td><td>%s</td>", "---")
				."</tr><tr>"
					.sprintf("<td><strong>Placa</strong></td><td><strong>:</strong></td><td>%s</td>", $ageDC['Agedetallecita']['placa'])
				."</tr><tr>"
					.sprintf("<td><strong>Taller de servicio</strong></td><td><strong>:</strong></td><td>%s</td>", $ageDC['Secproject']['name'])
				."</tr><tr>"
					.sprintf("<td><strong>Dirección</strong></td><td><strong>:</strong></td><td>%s</td>", $ageDC['Secproject']['address'])
				."</tr><tr>"
					.sprintf("<td><strong>Teléfono</strong></td><td><strong>:</strong></td><td>%s</td>", $ageDC['Secproject']['phono'])
				."</tr></tbody></table>".PHP_EOL;

		/* Attachment File */
		// Attachment location
		//  $file_name = "<attachment file name>";
		//  $path = "<relative path/absolute path which contains the attachment>";
		
		// Read the file content
//		$file = $path.$file_name;
//		$file_size = filesize($file);
//		$handle = fopen($file, "r");
//		$content = fread($handle, $file_size);
//		fclose($handle);
//		$content = chunk_split(base64_encode($content));
		
		/* Set the email header */
		// Generate a boundary
		$boundary = md5(uniqid(time()));
		
		// Email header
		$header = "From: ".$from_name." <".$from_mail.">".PHP_EOL;
		$header .= "Reply-To: ".$reply_to.PHP_EOL;
		$header .= "MIME-Version: 1.0".PHP_EOL;
		
		// Multipart wraps the Email Content and Attachment
		$header .= "Content-Type: multipart/mixed; boundary=\"".$boundary."\"".PHP_EOL;
		$header .= "This is a multi-part message in MIME format.".PHP_EOL;
		$header .= "--".$boundary.PHP_EOL;
		
		// Email content
		// Content-type can be text/plain or text/html
		//  $header .= "Content-type:text/plain; charset=iso-8859-1".PHP_EOL;
		$header .= "Content-type:text/html; charset=iso-8859-1".PHP_EOL;
		$header .= "Content-Transfer-Encoding: 7bit".PHP_EOL.PHP_EOL;
		$header .= "$message".PHP_EOL;
		$header .= "--".$boundary.PHP_EOL;
		
		// Attachment
		// Edit content type for different file extensions
		//  $header .= "Content-Type: application/xml; name=\"".$file_name."\"".PHP_EOL;
		//  $header .= "Content-Transfer-Encoding: base64".PHP_EOL;
		//  $header .= "Content-Disposition: attachment; filename=\"".$file_name."\"".PHP_EOL.PHP_EOL;
		//  $header .= $content.PHP_EOL;
		//  $header .= "--".$boundary."--";
		
		// Send email
		$response = mail($mail_to, $subject, "", $header);
//		debug($response);
//		die;
		if (mail($mail_to, $subject, "", $header)) {
			return true;
		} else {
			return false;
		}
	}
	
	//smtp to mail.dercoperu.net
	function mail_($mail_to,$subject,$header, $message){
		$Email = new CakeEmail('smtpderco');
		$Email->from(array('citasderco@dercoperu.net' => 'Derco Center'));
		$Email->to($mail_to);
		//$Email->to('citasderco@dercoperu.net');
		$Email->subject($subject);
		$Email->emailFormat('html');
		$Email->send($message);
		return true;
	}
}
