<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Safe City</title>
	<link href="../../css/bootstrap/bootstrap.min.css" rel="stylesheet">
</head>
<body onload="initialize()">
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
	
	<div class="container" style="padding-top: 90px;padding-bottom: 30px;">	

		<form action="../../index.php?c=acontecimiento&a=registrar" method="POST">
			<div class="col-md-4" style="margin:auto;">
				<b><h3>Registra tu acontecimiento</h3></b>
				<hr>
				<textarea class="form-control" type="text" name="descripcion" placeholder="Describe tu acontecimiento"></textarea>
				<br>
				<select class="form-control" name="tipo" required>
					<option default value="0"> tipo de alerta</option>
					<option value="Asalto">Asalto</option>
					<option value="Robo">Robo</option>
					<option value="Clonacion de tarjeta">Clonación de tarjeta</option>
					<option value="Estafa">Estafa</option>
					<option value="Extorsion">Extorsión</option>
					<option value="Secuestro al paso">Secuestro al paso</option>
					<option value="Asesinato">Asesinato</option>
				</select>
				<br>
				<input class="form-control" type="time" name="hora"/>
				<br>
				<input class="form-control" type="date" name="fecha"/>
				<br>
				¿Dónde ocurrió el acontecimiento?
				<br>
				<div class="input-group">
					<input class="form-control" id="address" type="textbox" placeholder="Dirección de referencia">
					<span class="input-group-btn">
						<input class="btn btn-primary" type="button" value="Buscar en el mapa" onclick="codeAddress()">
					</span>
				</div>
			</div>
			<div class="col-md-8">
				<div>
					<center><p style="background: black;color: white; width: 100%">Latitud - longitud - referencia<p></center>
				</div>
				<div style="background: #F0ECEC; padding: 2px;">
					<div>
						<div id="latitud">
							...
						</div>
					</div>
					<div>
						<div id="longitud">
							...   	
						</div>
					</div>
					<div>
						<div id="callereferencia">
							...   	
						</div>
					</div>

					<div id="map" style="background: #F0ECEC;height: 300px;width: 100%;margin:0;padding: 0px;">

					</div> 
				</div>
			</div>
			<br>
			<div class="col-md-12">
			<hr>
				<center>
					<input class="btn btn-success btn-lg" id="submit" type="submit" value="Registra acontecimiento">
				</center>
			</div>
			
		</form>
	</div>
	<div class="col-md-6">
	</div>



</div>


<script type="text/javascript" src="../../js/obtenerubicacion"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAhu8LbMrgD2NZiz6-xoaVtsy7PKLJMu3Q&signed_in=true" async defer></script>
<script src="../../js/jquery-2.2.4.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script type="text/javascript">
	function initMap() {

		var geocoder = new google.maps.Geocoder;

		document.getElementById('submit').addEventListener('click', function() {
			geocodeLatLng(geocoder, map, infowindow);
		});
	}

	function geocodeLatLng(geocoder, map, infowindow) {
		var lng = document.getElementById('longitud').value;
		var lat = document.getElementById('latitud').value;

		var latlng = {lat: parseFloat(lat), lng: parseFloat(lng)};
		geocoder.geocode({'location': latlng}, function(results, status) {
			if (status === google.maps.GeocoderStatus.OK) {
				if (results[1]) {

					results[1].formatted_address;

				} else {
					window.alert('No results found');
				}
			} else {
				window.alert('Geocoder failed due to: ' + status);
			}
		});
	}
</script>
<script type="text/javascript">
	var geocoder;
	var map;
	var markers = [];

	function initialize() {
		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(-6.7798517, -79.8356509);
		var mapOptions = {
			zoom:11,
			center: latlng
		}
		map = new google.maps.Map(document.getElementById("map"), mapOptions);
	}

	function codeAddress() {
		var address = document.getElementById("address").value;
		geocoder.geocode( { 'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				addMarker(results[0].geometry.location);
			} else {
				alert("Geocode was not successful for the following reason: " + status);
			}
		});

			// This event listener will call addMarker() when the map is clicked.
			map.addListener('click', function(event) {
				addMarker(event.latLng);
			});

			// Adds a marker to the map and push to the array.
			function addMarker(location) {
				deleteMarkers();
				var nuevamarker = new google.maps.Marker({
					position: location,
					map: map,
					draggable: true,
					animation: google.maps.Animation.DROP
				});
				nuevamarker.addListener('click', toggleBounce);
				markers.push(nuevamarker);
				var latitud= location.lat();
				var longitud= location.lng();

				var bloc = document.getElementById("latitud");
				bloc.innerHTML="<div class='col-sm-8'><input type='text' class='form-control' name='latitud' value='"+latitud+"' required>";
				var bloc1 = document.getElementById("longitud"); 
				bloc1.innerHTML="<div class='col-sm-8'><input type='text' class='form-control' name='longitud' value='"+longitud+"' required>";



				var latlng = {lat: parseFloat(latitud), lng: parseFloat(longitud)};
				geocoder.geocode({'location': latlng}, function(results, status) {
					if (status === google.maps.GeocoderStatus.OK) {
						if (results[1]) {

							var referencia=results[0].formatted_address;
							var bloc2 = document.getElementById("callereferencia"); 
							bloc2.innerHTML="<div class='col-sm-8'><input type='text' class='form-control' name='referencia' value='"+referencia+"' required>";

						} else {

							window.alert('No results found');
						}
					} else {
						window.alert('Geocoder failed due to: ' + status);
					}
				});

			}

			function toggleBounce() {
				if (marker.getAnimation() !== null) {
					marker.setAnimation(null);
				} else {
					marker.setAnimation(google.maps.Animation.BOUNCE);
				}
			}

				// Sets the map on all markers in the array.
				function setMapOnAll(map) {
					for (var i = 0; i < markers.length; i++) {
						markers[i].setMap(map);
					}
				}

				// Removes the markers from the map, but keeps them in the array.
				function clearMarkers() {
					setMapOnAll(null);
				}

				// Deletes all markers in the array by removing references to them.
				function deleteMarkers() {
					clearMarkers();
					markers = [];
				}

			}
		</script>

	</body>
	</html>
