<?php

require_once 'model.php';

class acontecimiento extends model{

  	protected $conexion;
    protected $tabla="acontecimiento";
    protected $columns ="descripcion,tipo,latitud,longitud,referencia,hora,fecha,USUARIO_idusuario";
	
	public function __construct()
  	{
  		require_once 'conexion.php';
    	$this->conexion = conexion::conectar();
  	}
  	public function calles_inseguras(&$box,&$latitud,&$longitud,&$distance){
  		$array=array();
		$sql="SELECT descripcion,tipo,latitud,longitud,hora,fecha, (6371 * ACOS( 
		                                             SIN(RADIANS(latitud)) 
		                                            * SIN(RADIANS(" . $latitud . ")) 
		                                            + COS(RADIANS(longitud - " . $longitud . ")) 
		                                            * COS(RADIANS(latitud)) 
		                                            * COS(RADIANS(" . $latitud . "))
		                                            )
		                               			) AS distance
		                     FROM acontecimiento
		                     WHERE (latitud BETWEEN " . $box['min_lat']. " AND " . $box['max_lat'] . ")
		                     AND (longitud BETWEEN " . $box['min_lng']. " AND " . $box['max_lng']. ")
		                     HAVING distance  < ".$distance."                                      
		                     ORDER BY distance ASC ";
		                    
	
		$consulta = $this->conexion->prepare($sql);  
        $consulta->execute();
        while($filas=$consulta->fetch(PDO::FETCH_ASSOC)){
            $array[]=$filas;
        }
        $this->conexion= null;
        return $array;
	} 
 }