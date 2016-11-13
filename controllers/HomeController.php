<?php 

//*******El HOMECONTROLLER, nos sirve para manejar todas las peticiones sin utilizar sessiones**************

class HomeController {
	function __construct(&$accion)
	{
		call_user_func(array("HomeController",$accion));
	}

	protected function view_login(){
		if(!session_id()) {
        	session_start();
    	}
		require_once '/config/facebook.php';

		$helper = $fb->getRedirectLoginHelper();
		$permissions = ['email']; 
		$loginUrl = $helper->getLoginUrl('http://safecity.esy.es/index.php?c=auth&a=logueofc&d=login', $permissions);
		$out=$loginUrl;
		
		require_once '/views/visitor/login.php';
	}

	protected function view_register(){
		if(!session_id()) {
        	session_start();
    	}
		require_once '/config/facebook.php';

		$helper = $fb->getRedirectLoginHelper();
		$permissions = ['email']; 
		$loginUrl = $helper->getLoginUrl('http://safecity.esy.es/index.php?c=auth&a=logueofc&d=register', $permissions);
		$out=$loginUrl;

		require_once '/views/visitor/register.php';
	}

	protected function view_home(){
		header('Location: views/visitor/home.php');
	}
	
	protected function ingresar(){
		$dni   = $_POST['dni'];
		$clave =  $_POST['clave'];

		$array=array();
		$sql = "SELECT * FROM usuario WHERE usuario.dni='".$dni."' AND usuario.clave='".$clave."'";
		require_once 'models/conexion.php';
		$conexion = conexion::conectar();
		$consulta=$conexion->prepare($sql);
        $consulta->execute();
        while($filas=$consulta->fetch(PDO::FETCH_ASSOC)){
            $array[]=$filas;
        }
        $conexion= null;

		if(sizeof($array) == 1){
			session_start();
			$_SESSION['user_access_token']=$array[0]['idusuario'];
			$_SESSION['id_auth']=$array[0]['idusuario'];
			$_SESSION['name']=$array[0]['nombre'];
			if($array[0]['tipo']==="admin"){
				header('Location: views/admin/home.php');
			}else{
				if($array[0]['tipo']==="ciudadano"){
					header('Location: views/user/home.php');
				}else{
					if($array[0]['tipo']==="operario"){
						header('Location: views/operario/home.php');
					}else{
						session_destroy();
						header('Location: views/visitor/home.php');
					}
				}
			}	
		}else{
			$mensaje="Usuario no registrado.";
			$mensaje=base64_encode($mensaje);
			header('Location: views/visitor/home.php?m='.$mensaje);
		}
	}

	protected function register_usuario(){
		//Obtenemos datos del formulario
		$name      = $_POST['nombre']." ".$_POST['apellido'];
		$dni	   = $_POST['dni'];
		$telefono  = $_POST['telefono'];
		$clave     = $_POST['clave'];
		$tipo	   = "ciudadano";
		$email	   = "none";

		$value= "'$dni','$name','$telefono','$email','$clave','$tipo'";
		$sql="INSERT INTO usuario (dni,nombre,telefono,email,clave,tipo)VALUES($value)";
		require_once 'models/conexion.php';
		$conexion = conexion::conectar();
		$consulta=$conexion->prepare($sql);
        
		if($consulta->execute()){
			$mensaje="Bienvenido. Usted ya es parte de safecity.";
			$mensaje=base64_encode($mensaje);
			header('Location: views/visitor/home.php?m='.$mensaje);
		}else{
			$mensaje="Error: No se logró registrar sus datos. Posiblemente ya este registrado.";
			$mensaje=base64_encode($mensaje);
			header('Location: views/visitor/home.php?m='.$mensaje);
		}
	}

}