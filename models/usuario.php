<?php

require_once 'model.php';

class usuario extends model{

  	protected $conexion;
    protected $tabla="usuario";
    protected $columns ="dni,nombre,email,clave,tipo";
	
	public function __construct()
  {
  		require_once 'conexion.php';
    	$this->conexion = conexion::conectar();
  } 
}