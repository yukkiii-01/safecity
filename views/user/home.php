<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Safe City</title>
		<link href="../../css/bootstrap/bootstrap.min.css" rel="stylesheet">
</head>
<body>
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
                <li class="active"><a href="../../index.php">Inicio</a></li>
                <li><a href="../../index.php?c=acontecimiento&a=misacontecimientos">Mis acontecimientos</a></li>
			    <li><a href="../../index.php?c=acontecimiento&a=view_registrar">Registar acontecimiento</a></li>
				<li><a href='javascript:obtenerubicacion()'>Ver mi zona</a></li>
				<li><a href='../../index.php?c=acontecimiento&a=all'>Muro</a></li>
				<li><a href="javascript:alerta('<?php echo $_SESSION['id_auth']; ?>')" style="color:red;" data-toggle="tooltip" data-placement="left">Botón del pánico</a></li>
              	
              	<li><a href="javascript:leertodoslosauxilios()">ver alertas</a></li>
		         
				<li><div id="cantidadalertas" style="background: red;color:white;padding: 15px;border-radius: 15px;" ></div></li>

              </ul>
              <ul class="nav navbar-nav navbar-right">
              	<li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['name'];?> <span class="caret"></span></a>
		          <ul class="dropdown-menu">
		            <li><a href="../../index.php?c=auth&a=logout">Cerrar Sesión</a></li>
		          </ul>
		        </li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
    </div>
    
	<div class="container banner text-center" style="padding-top: 90px;padding-bottom: 30px;">
		<div id="viewalertas">         
		</div>
	
		<?php 
		if(!empty($_SESSION['msm'])){
			echo $_SESSION['msm'];
			unset($_SESSION['msm']);
		}
		?>
		<div class="row">
			<div class="col-sm-6 col-md-4">
				<div class="thumbnail"  >
					<br>
					<img src="../../images/iconoinicio.png" width="20%" height="80px"/>
					<br>
					<div class="caption" style="background-color:#3B799B">
						<p><a href="../../index.php" class="btn btn-default" role="button">Inicio</a> 
					</div>
				</div>
			</div>

		
			<div class="col-sm-6 col-md-4">
				<div class="thumbnail">
					<br>
					<img src="../../images/mialerta.png" width="24%" height="80px"/>
					<br>
						<div class="caption" style="background-color:#50C987">
							<p><a href="../../index.php?c=acontecimiento&a=misacontecimientos" class="btn btn-default" role="button">Mis Acontecimientos</a> 
						</div>
				</div>
			</div>

			<div class="col-sm-6 col-md-4">
				<div class="thumbnail">
				<br>
					<img src="../../images/registraralert.png" width="20%" height="80px"/>
					<br>
					<div class="caption" style="background-color:#FB6648">
						<p><a href="../../index.php?c=acontecimiento&a=view_registrar" class="btn btn-default" role="button">Registrar Acontecimientos</a>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-md-4" >
				<div class="thumbnail" >
					<br>
					<img src="../../images/zona.png" width="20%" height="80px"/>
					<br>
					<div class="caption" style="background-color:#F2AE30">
						<p><a href='javascript:obtenerubicacion()' class="btn btn-default" role="button">Ver mi Zona</a> 
					</div>
				</div>
			</div>

		
			<div class="col-sm-6 col-md-4">
				<div class="thumbnail">
					<img src="../../images/user.png" width="54%" height="80px"/>	
				</div>
			</div>

			<div class="col-sm-6 col-md-4">
				<div class="thumbnail" >
					<br>
					<img src="../../images/muro.png" width="18%" height="80px"/>
					<br>
					<div class="caption" style="background-color:#66E4DC">
						<p><a href='../../index.php?c=acontecimiento&a=all' class="btn btn-default" role="button">Muro</a>
					</div>
				</div>
			</div>
		</div>
			
		</div>
	<script type="text/javascript" src="../../js/obtenerubicacion.js"></script>
	<script src="../../js/jquery-2.2.4.min.js"></script>
	<script src="../../js/bootstrap.min.js"></script>
	<script src="../../js/alerta.js"></script>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyAhu8LbMrgD2NZiz6-xoaVtsy7PKLJMu3Q&sensor=false"></script>
	<script type="text/javascript">
		
	    $(document).on("ready", function(){
			setInterval("nuevasalertas()",1000);
			
    	});
	    var nuevasalertas=function(){
	           
	                    $.ajax({
	                        type: "POST",
	                        url: "../../index.php?c=auxilio&a=cantidadauxilio",
	                    }).done(function(info){
	                        $("#cantidadalertas").html(info);
	                    });
	    };
	    
	</script>
	<script type="text/javascript">
		function leertodoslosauxilios(){
                $.ajax({
                    type: "POST",
                    url: "../../index.php?c=auxilio&a=verallalertas",
                }).done(function(info){
                    $("#viewalertas").html(info);
                });
        };
	</script>
</body>
</html>



