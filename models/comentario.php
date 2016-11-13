<?php

require_once 'model.php';

class comentario extends model{

  	protected $conexion;
    protected $tabla="comentario";
    protected $columns ="descripcion,autor,fecha,ACONTECIMIENTO_idacontecimiento";
	
	public function __construct()
  {
  		require_once 'conexion.php';
    	$this->conexion = conexion::conectar();
  } 
 }