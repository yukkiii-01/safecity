<!DOCTYPE html>
<html>
<head>
	<title>Safe City</title>
	<link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
	<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900' rel='stylesheet' type='text/css'>	
  <meta name="viewport" content="width=device-width, initial-scale=1">		
  <style type="text/css">
    #social-login ul{
      margin:0;
      padding:0;
      list-style-type:none;
      border-radius: 50%;
    }
    #social-login ul li{
      width:100%; 
    }
    #social-login ul li a{
      font-size:13px;
      color:#fff;
      text-decoration:none;
      padding:10px 0;
      display:block;
      background:#3b5998;
      border-radius: 10px;
    }

  }
</style>										
</head>

<body>

  <div class="header">								
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
					<a class="navbar-brand" href="index.php"><b>Safe City</b></a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li class="active"><a href="index.php?c=home&a=view_home">Inicio</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="index.php?c=home&a=view_register">Registrar</a></li>
						<li><a href="index.php?c=home&a=view_login">Login</a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
	</div>

	<div class="container">

	    <div class="page-header text-center">
	      <h1>Logueate</h1>
	    </div>

	    <div class="form-group col-md-12" align="center">
	
	        	<form action="index.php?c=home&a=ingresar" method="POST">
	 

		            <div class="form-group col-md-6">
		              	<div class="slider">
		                	<a><img src="images/logo.png" width="45%"></a>
		              	</div>
		            </div>

		            <div>

		                <div class="form-group col-md-6">
		                  <label>Usuario</label>
		                  <div class="input-group">
		                  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
		                  <input type="text" name="dni" class="form-control" placeholder="Documento Nacional de Identidad" aria-describedby="basic-addon1" >
		                  </div>
		                </div>
		                <div class="form-group col-md-6">
			                <label>Contraseña</label>
			                <div class="input-group">
			                  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-asterisk"></span></span>
			                  <input type="password" name="clave"   placeholder="Contraseña" class="form-control" aria-describedby="basic-addon1">
			                </div>
		                </div>
		                <div class="form-group col-md-6">
			                <div class="text-center"> 
			                  <button type="submit" value="Ingresar" name="opcion" id="opcion" class="btn btn-success" ><span class="glyphicon glyphicon-ok"></span> Ingresar </button>

			                  <button type="submit" value="Cancelar" name="opcion" id="opcion" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
			                </div>
			                <br>
			                <div id="social-login">
			                  <hr>
							<small>También puedes loguearte con facebook</small><br>
			                  <ul>
			                    <li><a href="<?php echo $out?>">Facebook</a></li>
			                  </ul>
			                </div>
		              	</div>
	            	</div>
	        	</form>
		</div>
	</div>
       
  	<script src="js/jquery-2.2.4.min.js"></script>
  	<script src="js/bootstrap.min.js"></script>
    </body>
</html>

