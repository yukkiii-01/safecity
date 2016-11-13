<?php
class conexion {
   static function conectar(){
       $root='u916924156_sc';
       $password='safecity';
       $host='mysql.hostinger.es';
       $dbname='u916924156_safec';
       $conexion=new PDO("mysql:host=$host;dbname=$dbname;",$root,$password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
   
       return $conexion;
   }
}