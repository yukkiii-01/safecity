<?php
		
	require_once "models/auxilio.php";
	
	class AuxilioController
	{
		private $model;
		function __construct(&$accion)
		{
			if(!session_id()) {
	            session_start();
	        }
	        $this->model = new auxilio;
			call_user_func(array("AuxilioController",$accion));
		}

		protected function cantidadauxilio(){
			date_default_timezone_set('America/Lima');
        	$fecha=date("Y-m-d", time());
			$sql="SELECT COUNT(*) FROM safecity.auxilio WHERE fecha='".$fecha."' limit 0,20";
			$cantidad=$this->model->sentencia_sql_retorno($sql);
			echo "<b>".$cantidad[0]['COUNT(*)']."</b>";
		}

		protected function registro(){
			
			date_default_timezone_set('America/Lima');
			$fecha = date("Y-m-d",time());
			$hora = date("H:i:s",time());

			$id_usuario=$_REQUEST['id'];
			$direccion = $_REQUEST['coor'];
			$lat = $_REQUEST['lat'];
			$lon = $_REQUEST['lon'];
			$dni_auxiliar = "";
			$values= "'$lat','$lon','$direccion','$fecha','$hora','$dni_auxiliar','$id_usuario'";
			if($this->model->create($values)==1){
	       		//$lista_auxilio = $this->model->leer_full("null");
				//$_SESSION['lista de auxilio'] = $lista_auxilio;
				$_SESSION['msm']= "<strong>MENSAJE: Su llamada de auxilio</strong> ya fue atendida, la ayuda va en camino.";

	       	}else{
	       		$_SESSION['msm']="<strong style='color:#DA344D'> AVISO: Hubo un problema</strong> ...revise su conexion.";
	       	}
			
			$this->model->cerrar_conexion();
			unset($this->model);
			header('Location: views/user/home.php');
			
			
		}

		protected function ver(){
			date_default_timezone_set('America/Lima');
			if (!empty($_POST['fecha'])) {
				$fecha = $_POST['fecha'];				
			}else{
				$fecha = date("Y-m-d",time());
			}			
			$listar = $this->model->leer($fecha);
			$_SESSION['lista_auxilio'] = $listar;
			if (empty($listar)) {
				header('Location: views/operario/auxilios_ahora.php');
			}else{				
				header('Location: views/operario/auxilios_ahora.php');
			}
		}
		protected function asignar(){
			$id = $_REQUEST['id'];
			$sql = "where idauxilio=".$id;
			$obtener = $this->model->leer_full($sql);
			$_SESSION['dato_auxilio']= $obtener;
			header('Location: views/operario/config_auxiliar.php');
		}
		protected function config_asignar(){
			$id = $_REQUEST['id'];			
			$fecha = $_POST['fecha'];
			$hora = $_POST['hora'];
			$dni_auxiliar = $_POST['id_pol'];
			$consulta = $this->model->editar($dni_auxiliar,$id);
			$lista = $this->model->leer($fecha);
			$_SESSION['lista_auxilio']=$lista;
			header('Location: views/operario/auxilios_ahora.php');			

		}
		protected function verallalertas(){
			date_default_timezone_set('America/Lima');
			$fecha = date("Y-m-d",time());		
			$sql= "WHERE fecha='".$fecha."' order by hora desc limit 0,4";
			$listar = $this->model->leer_full($sql);
			foreach ($listar as $value) {

	         	echo "<div class='alert alert-danger' role='alert'><b>".$value['hora'].":</b> Esta sucediendo un acontecimiento Delictivo en <b>".$value['direccion']."</b><button type='button' class='close' data-dismiss='alert' aria-label='Close'>
  <span aria-hidden='true'>&times;</span>
</button></div>";		
			}
		}
	}

?>