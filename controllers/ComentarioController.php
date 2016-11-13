<?php 
require 'Models/comentario.php';
class ComentarioController {
	function __construct(&$accion)
	{
		if(!session_id()) {
            session_start();
        }
        $this->model=new comentario;
		call_user_func(array("ComentarioController",$accion));
	}
	protected function register_comentario(){
		$comentario=$_POST['comentario'];
		$idacontecimiento=$_POST['id'];
		$autor=$_SESSION['name'];
		date_default_timezone_set('America/Lima');
        $fecha=date("Y-m-d G-i-s", time());
		$value="'$comentario','$autor','$fecha','$idacontecimiento'";

		if($this->model->create($value)==1){
			echo "<p style='padding:5px;background:#ECE9E9'><b style='color:green'>".$autor.":</b> ".$comentario."</p>";
		}else{
			echo "no";
		}
	}
	protected function mascomentarios(){
		$sql="WHERE ACONTECIMIENTO_idacontecimiento=".$_POST['id'];
		$comentarios=$this->model->leer_full($sql);
		foreach ($comentarios as $com) {
			echo "<p style='padding:5px;background:#ECE9E9'><b style='color:green'>".$com['autor'].":</b> ".$com['descripcion']."</p>";
		}
	}
}