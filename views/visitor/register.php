<!DOCTYPE html>
<html>
<head>
	<title>Safe City</title>
	<link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
	<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900' rel='stylesheet' type='text/css'>	
    <meta name="viewport" content="width=device-width, initial-scale=1">													
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
						<li class="active"><a href="../../index.php?c=home&a=view_home">Inicio</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="index.php?c=home&a=view_register">Registrar</a></li>
						<li><a href="index.php?c=home&a=view_login">Login</a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
	</div>
	<div class="container banner text-center">
		<div class="row">
			<div class="page-header text-center">
				<h3>Regístrate</h3><small>Create una cuenta Safe City</small>
			</div>
			<form action="index.php?c=home&a=register_usuario" method="POST">
				<div class="form-group col-md-2"></div>
				<div class="form-group col-md-4">
					<label for="exampleInputEmail1">Nombres</label>
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
						<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombres" aria-describedby="basic-addon1" required="required">
					</div>
				</div>
				<div class="form-group col-md-4">
					<label for="exampleInputEmail1">Correo</label>
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
						<input type="text" class="form-control" name="correo" id="correo" placeholder="Correo Electronico" aria-describedby="basic-addon1" required="required">
					</div>
				</div>
				<div class="form-group col-md-12"></div>
				<div class="form-group col-md-2"></div>
				<div class="form-group col-md-4">
					<label for="exampleInputEmail1">DNI</label>
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-credit-card"></span></span>
						<input type="text" class="form-control" name="dni" id="dni" maxlength="8" placeholder="Documento Nacional de Identidad" aria-describedby="basic-addon1" required="required">
					</div>
				</div>
				<div class="form-group col-md-4">
					<label for="exampleInputEmail1">Teléfono</label>
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
						<input type="text" class="form-control" name="telefono" id="telefono" maxlength="9" placeholder="Número de Celular" aria-describedby="basic-addon1" required="required">
					</div>
				</div>
				<div class="form-group col-md-12"></div>
				<div class="form-group col-md-2"></div>
				<div class="form-group col-md-4">
					<label for="exampleInputEmail1">Contraseña</label>
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-asterisk"></span></span>
						<input type="password" class="form-control" name="clave" id="clave" placeholder="Contraseña" aria-describedby="basic-addon1" required="required">
					</div>
				</div>
				<div class="form-group col-md-12">
					<div class=" text-center">
						<button type="submit" class="btn btn-danger" value="Cancelar" name="opcion" id="opcion"><span class="glyphicon glyphicon-remove"></span> Cancelar </button>
						<button type="submit" class="btn btn-success" value="Registrar" name="opcion" id="opcion"><span class="glyphicon glyphicon-pencil"></span> Registrar </button>
					</div>
				</div>
			</form>
		</div>
		<hr>
		<small>También puedes iniciar sesión con facebook</small><br>
		<?php
			echo "<a  class='btn btn-primary' href='".$out."'>Iniciar sesión con facebook</a>";
		?>
	</div>
</div>
<script src="js/jquery-2.2.4.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/registro.js"></script>
</body>
</html>


