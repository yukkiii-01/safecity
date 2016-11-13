<!DOCTYPE html>
<html>
<head>
	<title>Safe City</title>
	<link href="../../css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900' rel='stylesheet' type='text/css'>	
    <meta name="viewport" content="width=device-width, initial-scale=1">												
</head>
<body style="background-image: url(../../images/fondo2.png);">
    <div style="background:rgba(0,0,0,.7);">
       <div class="header" style="margin-top: 0px;width: 100%;position: fixed;z-index: 100;">
          <nav class="navbar navbar-default">
              <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../../index.php"><b>Safe City</b></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li class="active"><a href="../../index.php?c=home&a=view_home">Inicio</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="../../index.php?c=home&a=view_register">Registrar</a></li>
                <li><a href="../../index.php?c=home&a=view_login">Login</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
</div>
<div class="container" style="padding-top: 100px;padding-bottom: 30px;color: white;">

    <?php 
    if(!empty($_REQUEST['m'] ) ){
        echo "<div class='col-md-12'>";
        echo base64_decode($_REQUEST['m']);
        echo "</div>";
    }
    ?>
    <div class="col-md-10 col-md-offset-1" >
        <div class="col-md-12" >
            <center><img class="img-circle" src="../../images/logo.png" width="30%" style="background: white;padding: 25px;"></center>
        </div>
        <div>
            <center>
                <h1> BIENVENIDOS </h1>
                <h3>La seguridad en Lambayeque es Responsabilidad de Todos</h3>
                <h1 style="color:#d43f3a;"> ¡Actuemos Ya! </h1>
            </center>
        </div>
    </div>
</div>  	
<div id="col-md-12" style="right:0px; bottom:0px; z-index:10;width: 100%;padding: 20px;color:white;">

    <div class='row' style="padding-right: 40px;padding-left: 40px;padding-bottom: 40px;">
        <div class="col-md-6" style="text-align: justify;padding: 15px;">
            <h3 style="color:#FF5733">¿Importancia de la seguridad ciudadana?</h3>
            <p>La seguridad en estos últimos años, ha cobrado vital importancia en el Departamento de Lambayeque, pues se está viendo afectada uno de los principales derechos del hombre “El derecho de vivir en paz”. La criminalidad en la actualidad constituye un problema político social de gran importancia, que exige la necesidad de implementar medidas concretas para disminuir el porcentaje de crimen y violencia en las calles.
            </p>
        </div>
        <div class="col-md-6" style="text-align: justify;padding: 15px;">
            <h3 style="color:#FF5733">¿Cómo lograrlo?</h3>
            <p>El uso de esta aplicación proporciona a los ciudadanos la información para que ellos puedan tomar las medidas necesarias ante un acto delictivo, asiéndolo conocedor en tiempo real a la población de los acontecimientos delictivos que ocurren en la ciudad.</p>
        </div>

    </div>

</div>

<footer style="background:rgba(0,0,0,.7);">
    <div >
        <center>
            <b style="color:#37CB83;">Hacker Safe</b> -
            <small style="color:#37CB83;"> Copyright © 2016</small>
        </center>

    </div>
</footer>


</body>
<script src="../../js/jquery-2.2.4.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
</html>

