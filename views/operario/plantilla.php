<?php
	session_start();		
	if($_SESSION['tipoauth']==="operador"){
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">  
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link href="../../css/bootstrap.min.css" rel="stylesheet">
	<script src="../../js/jquery-2.2.4.min.js"></script>
	<script src="../../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCtRoq15lyhkXsDJe37xYRRuN9ainNC2ys"></script>  	
	<meta http-equiv=”Content-Type” content=”text/html; charset=iso-8859-2″>
	<style type="text/css">
	body{
		background-color: #F8E0F7;
	}
	hr{
		color: #000000;
		font-size: 10px;
	}
	.btn-group a{
		height: 60px;
		font-size: 27px;
	}
	</style>
</head>


<body>
	<nav class="navbar navbar-inverse" style="margin-bottom: 0em;border-radius:0px">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Mapa del Delito</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">            
        <ul class="nav navbar-nav navbar-right">        
          <?php
          	foreach ($_SESSION['datos_usuario'] as $value) {        	
          ?>
          <li><a href="#"><?php echo "Perfil ( ".$value['nombre']." )"; ?></a></li>  
          <?php 
          	}
          ?>
          <li><a href="../usuario/plantilla.php?v=home">Home</a></li>
          <li><a href="../../index.php?c=auth&a=cerrar_session">Salir</a></li>        
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->  
  </nav>

<div class="col-md-12">
	<hr>	
</div>
<div class="container" id="cuerpo">
	  <div class="row" style="text-align:right;padding-bottom:5px;padding-right:20px;">
        <?php
          date_default_timezone_set('America/Lima');
          $f=explode("-",date("Y-m-d", time()));
          setlocale(LC_TIME, 'spanish');  
          $mes=strftime("%B",mktime(0, 0, 0, $f[1], 1, 2000));
          $fecha="Lambayeque, $f[2] de $mes del $f[0]";
          unset($f,$mes);
          echo "<small><strong>$fecha</strong></small>"
        ?>
    </div>
    <div>
      <?php
        if(isset($_SESSION["msm"])){
        ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong> <span class="glyphicon glyphicon-envelope"></span> </strong>
        <?php
              echo $_SESSION["msm"];
        ?>
            </div>
        <?php
            unset($_SESSION['msm']);
          }
        ?>
    </div>	 
    <div class="row">
      <div class="col-md-2">
          <div class="panel panel-default" >
              <div class="panel-heading">
                <button type="button" style="color:black;padding:0px;margin-top:0px;" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navegador">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="caret" style="color:black;padding:0px"></span>
                </button>                      
                <center><strong>"Mapa Del Delito"<br></strong></center>
              </div>
            <div  class="collapse navbar-collapse" id="navegador" style="padding:0px">
              <ul class="nav nav-pills nav-stacked">
                  <li>
                    <a class="btn btn-default" href="../../index.php?c=auxilio&a=ver">
                    Delitos Tiempo Real
                    </a>
                  </li>
                  <li>
                    <a class="btn btn-default" href="../../index.php?c=profesor&a=config_Profesores">
                    Confirmaciones
                    </a>
                  </li>                        
                  <li>
                    <a class="btn btn-default" href="../../index.php?c=profesor&a=config_grado_docentes">
                      Comisarias
                    </a>
                   </li>                        
              </ul>
            </div>
        </div>
      </div>
      <div class="col-md-10">
        <?php          
          if(isset($_GET['v'])){
            if(file_exists($_GET['v'].".php")){
              include_once($_GET['v'].".php");
            }else{
              echo '<div class="alert alert-danger alert-dismissible" role="alert">';
              echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
              echo '<span aria-hidden="true">&times;</span>';
              echo '</button>';
              echo '<strong>URL modificada:</strong> Usted a sido direccionado a la página principal.';
              echo '</div>';
              include_once("home.php");
            } 
          }else{
            include_once("home.php");
          }
        ?>
      </div>
    </div>
<div class="col-md-12">
	<hr>	
</div>
  
</div>
<div class="col-md-12">
	<hr>	
</div>
<div class="col-md-12"  style="padding:10px;background:#000">
	
	<center> <p class="text-muted"> Copyright © 2016 </p></center>

</div>
</body>
</html>
<?php
}else{
   header('Location: errores/error_404.php');
}
?>