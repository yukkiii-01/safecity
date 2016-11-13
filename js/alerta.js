function alerta(id){
	var id = id;
	var content = document.getElementById("geolocation-test");	
	if (navigator.geolocation)
	{
		navigator.geolocation.getCurrentPosition(function(objPosition)
		{
			var lon = objPosition.coords.longitude;
			var lat = objPosition.coords.latitude;
			var dir = "";
			
			var glatlng = new google.maps.LatLng(lat,lon);
						
			geocoder = new google.maps.Geocoder();
			geocoder.geocode({"latLng": glatlng}, function(results, status)
			{
				if (status == google.maps.GeocoderStatus.OK)
				{
					if (results[0])
					{
						dir = results[0].formatted_address;
					}
					else
					{
						dir = "<p>No se ha podido obtener ninguna dirección en esas coordenadas.</p>";
					}
				}
				else
				{
					dir = "<p>El Servicio de Codificación Geográfica ha fallado con el siguiente error: " + status + ".</p>";
				}								
				location.href="../../index.php?c=auxilio&a=registro&id="+id+"&coor="+dir+"&lon="+lon+"&lat="+lat;
			});			
		}, function(objPositionError)
		{
			switch (objPositionError.code)
			{
				case objPositionError.PERMISSION_DENIED:
					var retur = "No se ha permitido el acceso a la posición del usuario.";
				break;
				case objPositionError.POSITION_UNAVAILABLE:
					var retur = "No se ha podido acceder a la información de su posición.";
				break;
				case objPositionError.TIMEOUT:
					var retur = "El servicio ha tardado demasiado tiempo en responder.";
				break;
				default:
					var retur = "Error desconocido.";
			}
		}, {
			maximumAge: 75000,
			timeout: 15000
		});		
	}
	else
	{
		var retur = "Su navegador no soporta la API de geolocalización.";

	}
}