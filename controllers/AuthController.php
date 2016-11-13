<?php 

class AuthController {
	function __construct(&$accion)
	{
		if(!session_id()) {
            session_start();
        }
		call_user_func(array("AuthController",$accion));
	}
	
	protected function logueofc(){
		if($_REQUEST['d']==="login" || $_REQUEST['d']==="register"){
			require_once '/config/facebook.php';
			$helper = $fb->getRedirectLoginHelper();
			//validacion del token de facebook
				try { 
				  $accessToken = $helper->getAccessToken(); 
				}catch(Facebook\Exceptions\FacebookResponseException $e) { 
				  session_destroy();
				  $mensaje='Graph returned an error: ' . $e->getMessage();
				  $mensaje=base64_encode($mensaje); 
				  header('Location:views/visitor/home.php?sms='.$mensaje); 
				}catch(Facebook\Exceptions\FacebookSDKException $e) { 
				  session_destroy(); 
				  $mensaje='Facebook SDK returned an error: '. $e->getMessage();
				  $mensaje=base64_encode($mensaje);
				  header('Location:views/visitor/home.php?sms='.$mensaje); 
				}
			//si existe el access token
				if(isset($accessToken)){				
					$oAuth2Client = $fb->getOAuth2Client(); 
					// Cambiando un token de acceso de corta duración por uno de larga vida
					if (! $accessToken->isLongLived()) { 	
						try { 
						    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken); 
						}catch (Facebook\Exceptions\FacebookSDKException $e) { 
						   	$mensaje="Error getting long-lived access token: " . $e->getMessage(); 
						  	$mensaje=base64_encode($mensaje);
				  			header('Location:views/visitor/home.php?sms='.$mensaje); 
						}
					}

					$fb->setDefaultAccessToken($accessToken);
					$response = $fb->get('/me?fields=name,email');
					$userNode = $response->getGraphUser();

					$name=$userNode['name'];
					$email=$userNode['email'];
			
					//######################¿el usuario ya esta registrado?########################
					require_once 'models/conexion.php';
					$array=array();
					$sql = "SELECT * FROM usuario WHERE usuario.email='".$email."'";
					$conexion = conexion::conectar();
					$consulta=$conexion->prepare($sql);
				    $consulta->execute();
				    while($filas=$consulta->fetch(PDO::FETCH_ASSOC)){
				        $array[]=$filas;
				    }
			    
			    
					//################### vista de login ########################################
					if($_REQUEST['d']==="login"){
						if(sizeof($array) == 1){
							$_SESSION['name']=$name;
							$_SESSION['facebook_access_token'] = (string) $accessToken;
							$_SESSION['id_auth']=$array[0]['idusuario'];
							$conexion=null;
							header('Location: views/user/home.php');					
						}
						else{
							session_destroy();
							header('Location: index.php?c=home&a=view_register');	
						}
					}
					//################### vista de registro ####################################
					if($_REQUEST['d']==="register"){
						session_destroy();
						if(sizeof($array) == 1){
							$conexion=null;
							header('Location: index.php?c=home&a=view_login');
						}else{
							$value= "'none','$name','none','$email','none','ciudadano'";
							
							$sql="INSERT INTO usuario (dni,nombre,email,clave,tipo)VALUES($value)";
							$consulta=$conexion->prepare($sql);
						        
							if($consulta->execute()){

								$conexion=null;
								unset($conexion,$consulta,$name,$email);
								header('Location: index.php?c=home&a=view_login');
									
							}else{
								$conexion=null;
								unset($conexion,$consulta,$name,$email);
								header('Location: index.php');
							}	
						}					
					}				
			}else{
				header('Location: index.php');
			}	 
		}else{
			header('Location: index.php');
		}
	}

	protected function user_ya_logueado(){
		
		require_once '/config/facebook.php';

		if(isset($_SESSION['facebook_access_token'])){
			// Establece el token de acceso de fallback predeterminado para que no tengamos que pasarlo a cada solicitud
			$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
			try {
				$response = $fb->get('/me');
				$userNode = $response->getGraphUser();
			} catch(Facebook\Exceptions\FacebookResponseException $e) {
				//Cuando Graph devuelve un error
				$mensaje='Graph returned an error: ' . $e->getMessage();
				$mensaje=base64_encode($mensaje);
				header('Location:views/visitor/home.php?sms='.$mensaje); 
			} catch(Facebook\Exceptions\FacebookSDKException $e) {
				// Cuando la validación falla o otros problemas locales
				$mensaje='Facebook SDK returned an error: ' . $e->getMessage();
				$mensaje=base64_encode($mensaje);
				header('Location:views/visitor/home.php?sms='.$mensaje); 
			}

			$out='Logueado como: '.$userNode->getName().'</br><a href="index.php?c=auth&a=logout">Logout</a>';
			
		}else{
			if(isset($_SESSION['user_access_token'])){
				header('Location: views/user/home.php');
			}else{
				$this->logout();
			}
		}
		header('Location: views/user/home.php');
	}

	protected function logout(){
		session_unset();
		session_destroy();
        header("Location: views/visitor/home.php");
	}
}