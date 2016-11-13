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
    <div class="container" style="padding-top: 60px;padding-bottom: 30px;">
    	<div>
    		
			<div class="col-md-4 col-md-offset-8" style="padding: 10px;">
				    <div class="input-group">
				      <input class="form-control"  id="address" type="textbox" placeholder="Ingresa ubicación de referencia">
				      <span class="input-group-btn">
				        <input class="btn btn-primary" type="button" value="Buscar" onclick="codeAddress()">
				      </span>
				    </div>
			</div>
			<div class="col-md-12" style="padding:5px; border: solid 1px #e7e7e7;">
    		<center>
    		<div class="table-responsive">
    			<table width="100%">
					<tr>
						<td><img src="../../images/robbery1.png"/></td>
						<td><b>Asalto</b></td>
						<td><img src="../../images/robbery2.png"/></td>
						<td><b>Robo</b></td>
						<td><img src="../../images/robbery3.png"/></td>
						<td><b>Clonación de tarjeta</b></td>
						<td><img src="../../images/robbery4.png"/></td>
						<td><b>Estafa</b></td>
						<td><img src="../../images/robbery5.png"/></td>
						<td><b>Extorsión</b></td>
						<td><img src="../../images/robbery6.png"/></td>
						<td><b>Secuestro al paso</b></td>
						<td><img src="../../images/robbery7.png"/></td>
						<td><b>Asesinato</b></td>
					</tr>
				</table>
			</div>
			</center>
    		</div>
			<div class="col-md-12" style="color:green;padding: 12px;">
				<b>Importante: </b>Da click en los marcadores para poder visualizar la descripcion del delito
			</div>
			<div class="col-md-12">
				<div style="background: black;width: 100%;padding: 6px;">
				    <div style="float: left;">
				    	<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" style="color: white;"><small>Página anterior</small></a>
				    </div>
				    <div style="text-align: right;"> 
				        <b style="color: white;">Zonas peligrosas - Google maps</b>
				    </div>
				</div>
				<div id="mapa" style="width: 100%; height: 500px;">
					<div id="loading">
				        <img src="../../images/110.gif" style="margin: 0 auto; position:absolute; top: 50%; left: 50%; margin: -30px 0 0 -30px">
				    </div>
				</div>
			</div>
		</div>
    </div>	

</body>
<?php
	$varphp="[";
	foreach ($_SESSION['calles_inseguras']  as $k) {
		$varphp=$varphp."['".$k['descripcion']."','".$k['hora']."','".$k['fecha']."','".$k['tipo']."',".$k['latitud'].",".$k['longitud']."],";
	}
	$varphp=$varphp."]";
?>

<script src="../../js/jquery-2.2.4.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../js/obtenerubicacion.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyAhu8LbMrgD2NZiz6-xoaVtsy7PKLJMu3Q&sensor=false"></script>
<script type="text/javascript">
	 function codeAddress() {
	 	
	 		var geocoder = new google.maps.Geocoder;
		    var address = document.getElementById("address").value;
		    geocoder.geocode( { 'address': address}, function(results, status) {
		      if (status == google.maps.GeocoderStatus.OK) {

		        var location=results[0].geometry.location;
		        var latitud= location.lat();
		        var longitud= location.lng();
		        window.location="../../index.php?c=acontecimiento&a=radiodeterminado&latitud="+latitud+"&longitud="+longitud;
				  
		      } else {
		        alert("Geocode was not successful for the following reason: " + status);
		      }
		    });		
		  }
</script>
    <script type="text/javascript">
    function initialize() {
      var marcadores = <?php echo $varphp ?>;
      
      var map = new google.maps.Map(document.getElementById('mapa'), {
        zoom: 15,
        center: new google.maps.LatLng(<?php echo $_REQUEST['la']?>,<?php echo $_REQUEST['lo']?>),
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });
      var latlng = {lat: parseFloat(<?php echo $_REQUEST['la']?>), lng: parseFloat(<?php echo $_REQUEST['lo']?>)};
      var nuevamarker = new google.maps.Marker({
				    position: latlng,
				    map: map,
					draggable: true,
	   				animation: google.maps.Animation.DROP
	  });
	  nuevamarker.addListener('click', toggleBounce);
      var infowindow = new google.maps.InfoWindow();

      var marker, i;
      for (i = 0; i < marcadores.length; i++) {  
        marker = new google.maps.Marker({
          position: new google.maps.LatLng(marcadores[i][4], marcadores[i][5]),
          map: map
        });
        if(marcadores[i][3]== "Asalto"){
        	marker.setIcon('../../images/robbery1.png');
        }else{
        	if(marcadores[i][3]== "Robo"){
        		marker.setIcon('../../images/robbery2.png');
        	}else{
        		if(marcadores[i][3]=="Clonacion de tarjeta"){
        			marker.setIcon('../../images/robbery3.png');
        		}else{
	        		if(marcadores[i][3]=="Estafa"){
	        			marker.setIcon('../../images/robbery4.png');
	        		}else{
		        		if(marcadores[i][3]=="Extorsion"){
		        			marker.setIcon('../../images/robbery5.png');
		        		}else{
			        		if(marcadores[i][3]=="Secuestro al paso"){
			        			marker.setIcon('../../images/robbery6.png');
			        		}else{
				        		if(marcadores[i][3]=="Asesinato"){
				        			marker.setIcon('../../images/robbery7.png');
				        		}
				        	}
			        	}
        			}
	        	}
        	}
        }
        
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
            infowindow.setContent("<b>¿Qué pasó?: <small style='color:green'>"+marcadores[i][0]+"</small></b><br><b>Fecha: <small style='color:red'>"+marcadores[i][2]+"</small></b><br><b>Hora: <small style='color:black'>"+marcadores[i][1]+"</small></b>");
            infowindow.open(map, marker);
          }
        })(marker, i));
      }
    }
    function toggleBounce() {
				  if (marker.getAnimation() !== null) {
				    marker.setAnimation(null);
				  } else {
				    marker.setAnimation(google.maps.Animation.BOUNCE);
				  }
				}
    google.maps.event.addDomListener(window, 'load', initialize);
    </script>
</html>




