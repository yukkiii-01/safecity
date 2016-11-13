<?php
	
	require_once 'model.php';
	
	class auxilio extends model
	{
		protected $conexion;
		protected $tabla = "auxilio";
		protected $columns = "latitud,longitud,direccion,fecha,hora,codigo,USUARIO_idusuario";
		function __construct()
		{
			require_once 'conexion.php';
    		$this->conexion = conexion::conectar();
		}

		public function leer($fecha){

			$sql = "SELECT auxilio.idauxilio,nombre,direccion,dni,fecha,hora,telefono,codigo FROM (usuario JOIN auxilio ON usuario.idusuario = auxilio.USUARIO_idusuario) WHERE fecha ='".$fecha."'";
			$consulta = $this->conexion->prepare($sql);  
	        $consulta->execute();
	        while($filas=$consulta->fetch(PDO::FETCH_ASSOC)){
	            $array[]=$filas;
	        }
	        return $array;
		}
		public function editar($dni_auxiliar,$id){
			$validar=0;
			$sql = "UPDATE $this->tabla SET codigo='".$dni_auxiliar."' WHERE idauxilio=".$id;			
			$consulta = $this->conexion->prepare($sql);  
	         if($consulta->execute()){
            	$validar=1;
        	}
        	return $validar;

		}
	}

?>
