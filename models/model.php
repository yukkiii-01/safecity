<?php
class model{
	public function create($values)
    {
        $validar=0;
        $sql="INSERT INTO $this->tabla($this->columns)VALUES($values)";
        $consulta=$this->conexion->prepare($sql);
        if($consulta->execute()){
            $validar=1;
        }
        return $validar;
    }
    public function update($values,$nameid,$id)
    {
    	$validar=0;

        $col=split(",",$this->columns);
        $val=split("00ss",$values);

        $sql="UPDATE $this->tabla SET ";
        for ($i=0; $i < count($col); $i++) { 
            $sql=$sql.$col[$i]."=".$val[$i].",";
            if($i===count($col)-1){
                $sql=$sql.$col[$i]."=".$val[$i]." where ".$nameid."=".$id;
            }
        }
        $consulta=$this->conexion->prepare($sql);
        if($consulta->execute()){
            $validar=1;
        }
        
        return $validar;

    }
    public function delete($nameid,$id)
    {
        $validar=0;
        $sql="DELETE FROM $this->tabla where ".$nameid."=$dni";
        $consulta=$this->conexion->prepare($sql);
        if($consulta->execute()){
            $validar=1;
        }
       
        return $validar;
    }
    public function leer_full($restriccion){
        $array=array();
        if($restriccion=="null"){
            $sql="SELECT * FROM $this->tabla";
        }else{
            $sql="SELECT * FROM $this->tabla $restriccion";
        }
        $consulta=$this->conexion->prepare($sql);
        $consulta->execute();
        while($filas=$consulta->fetch(PDO::FETCH_ASSOC)){
            $array[]=$filas;
        }
        return $array;
    }
    public function obtener($dato,$nameid,$id){
        $array=array();
        
        $sql="SELECT $dato FROM $this->tabla where ".$nameid."=$id";
        
        $consulta=$this->conexion->prepare($sql);
        $consulta->execute();
        while($filas=$consulta->fetch(PDO::FETCH_ASSOC)){
            $array=$filas;
        }
        return $array;
    }
    public function cerrar_conexion(){
        $this->conexion =null;
    }
    public function sentencia_sql($sql){
        $validar=0;
        $consulta=$this->conexion->prepare($sql);
        if($consulta->execute()){
            $validar=1;
        }
        return $validar;
    }
    public function sentencia_sql_retorno($sql){
        $array=array();
        $consulta=$this->conexion->prepare($sql);
        $consulta->execute();
        while($filas=$consulta->fetch(PDO::FETCH_ASSOC)){
            $array[]=$filas;
        }
      
        return $array;
    }
}