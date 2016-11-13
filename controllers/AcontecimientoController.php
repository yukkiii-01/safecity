<?php 
require 'Models/acontecimiento.php';
class AcontecimientoController {
	function __construct(&$accion)
	{
		if(!session_id()) {
            session_start();
        }
        $this->model=new acontecimiento;
		call_user_func(array("AcontecimientoController",$accion));
	}
	
	protected function view_registrar(){
		header('Location: views/user/registrar_alerta.php');
	}
	protected function registrar(){
		$descripcion = $_POST['descripcion'];
		$tipo = $_POST['tipo'];
		$fecha = $_POST['fecha'];
		$hora = $_POST['hora'];
		$latitud = $_POST['latitud'];
		$longitud =$_POST['longitud'];
		$id= $_SESSION['id_auth'];
		$referencia=$_POST['referencia'];
		$values="'$descripcion','$tipo','$latitud','$longitud','$referencia','$hora','$fecha','$id'";
		
       	if($this->model->create($values) == 1){
       		$_SESSION['msm']="Acontecimiento registrado con éxito";
       		header('Location: views/user/home.php');
       	}else{
       		$_SESSION['msm']="Error: no se logró registrar su acontecimiento";
       		header('Location: views/user/home.php');
       	}
	}
	protected function all(){
		
		$sql="SELECT safecity.acontecimiento.* , cantidad.c FROM safecity.acontecimiento LEFT JOIN  (SELECT ACONTECIMIENTO_idacontecimiento,COUNT(*) as c FROM safecity.like group by safecity.like.ACONTECIMIENTO_idacontecimiento) as cantidad  ON safecity.acontecimiento.idacontecimiento=cantidad.ACONTECIMIENTO_idacontecimiento order by fecha desc limit 0,30 " ;
		$acontecimientos=$this->model->sentencia_sql_retorno($sql);
		$_SESSION['all_acontecimientos']=$acontecimientos;
		header('Location: views/user/muro.php');
	}
	protected function like(){
		$idacontecimiento=$_POST['id'];
		$id=$_SESSION['id_auth'];
		$sql="SELECT count(*) as c FROM safecity.like where ACONTECIMIENTO_idacontecimiento=".$idacontecimiento." AND idusuario=".$id;
				
		$cantidad=$this->model->sentencia_sql_retorno($sql);

		if($cantidad[0]['c']==1){
			$sql="DELETE FROM safecity.like Where idusuario='".$id."'";
			$this->model->sentencia_sql($sql);

		}else{
			$name=$_SESSION['name'];
			$values="'$id','$name','$idacontecimiento'";
			$sql="INSERT INTO safecity.like (idusuario,nameusuario,ACONTECIMIENTO_idacontecimiento)VALUES($values)";
			$this->model->sentencia_sql($sql);
			
		}
		$sql="SELECT count(*) as c FROM safecity.like where ACONTECIMIENTO_idacontecimiento=".$idacontecimiento;
		$nlike=$this->model->sentencia_sql_retorno($sql);
		echo $nlike[0]['c'];

	}
	protected function like1(){
		$idacontecimiento=$_POST['id'];
		
		$sql="SELECT count(*) as c FROM safecity.like where ACONTECIMIENTO_idacontecimiento=".$idacontecimiento;
		$nlike=$this->model->sentencia_sql_retorno($sql);
		echo $nlike[0]['c'];

	}

	protected function misacontecimientos(){
		//mostrar unicamente los 10 ultimos acontecimientos
		$id= $_SESSION['id_auth'];
		
		$sql="SELECT tabla.* , cantidad.c  FROM (SELECT * FROM safecity.acontecimiento WHERE safecity.acontecimiento.USUARIO_idusuario=".$id." limit 0,10) 
				as tabla
				LEFT JOIN  
				(SELECT ACONTECIMIENTO_idacontecimiento,count(*) as c FROM safecity.like group by safecity.like.ACONTECIMIENTO_idacontecimiento) 
				as cantidad 
				ON safecity.cantidad.ACONTECIMIENTO_idacontecimiento=safecity.tabla.idacontecimiento order by fecha desc";
		$acontecimientos=$this->model->sentencia_sql_retorno($sql);
		$_SESSION['misalertas']=$acontecimientos;
		
		header('Location: views/user/misalertas.php');
		
	}

	protected function getBoundaries($latitud, $longitud, $distance, $earthRadius = 6371)
	{
	    $return = array();
	     
	    // Los angulos para cada dirección
	    $cardinalCoords = array('north' => '0',
	                            'south' => '180',
	                            'east' => '90',
	                            'west' => '270');
	    $rLat = deg2rad($latitud);
	    $rLng = deg2rad($longitud);
	    $rAngDist = $distance/$earthRadius;
	    foreach ($cardinalCoords as $name => $angle)
	    {
	        $rAngle = deg2rad($angle);
	        $rLatB = asin(sin($rLat) * cos($rAngDist) + cos($rLat) * sin($rAngDist) * cos($rAngle));
	        $rLonB = $rLng + atan2(sin($rAngle) * sin($rAngDist) * cos($rLat), cos($rAngDist) - sin($rLat) * sin($rLatB));
	        $return[$name] = array('lat' => (float) rad2deg($rLatB), 
	                                'lng' => (float) rad2deg($rLonB));
	    }
	    return array('min_lat'  => $return['south']['lat'],
	                 'max_lat' => $return['north']['lat'],
	                 'min_lng' => $return['west']['lng'],
	                 'max_lng' => $return['east']['lng']);
	}

	protected function radiodeterminado(){

		$latitud  =  $_GET['latitud'];
		$longitud =  $_GET['longitud'];
		$distance= "15";
		$box = $this->getBoundaries($latitud, $longitud, $distance);
		$calles_inseguras=$this->model->calles_inseguras($box,$latitud,$longitud,$distance);
		$_SESSION['calles_inseguras']=$calles_inseguras;
		header("Location: views/user/mizona.php?la=".$latitud."&lo=".$longitud);

	}
}
