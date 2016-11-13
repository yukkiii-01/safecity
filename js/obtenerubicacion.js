var options = {
  enableHighAccuracy: true,
  timeout: 5000,
  maximumAge: 0
};

function lacalizame() {
    var map = new google.maps.Map(document.getElementById('map'), {
    	zoom: 20
    });
    var infoWindow = new google.maps.InfoWindow({map: map});

    // Try HTML5 geolocation.
    if (navigator.geolocation) {
        navigator.geolocation.watchPosition(function(position) {
	        var pos = {
	            lat: position.coords.latitude,
	            lng: position.coords.longitude, 
	        };
	        
	        infoWindow.setPosition(pos);
	        infoWindow.setContent('<b><small style="color:green">Aquí te encuentras</small></b>');
	        map.setCenter(pos);
            var bloc = document.getElementById("latitud");
            
            bloc.innerHTML="<div class='col-sm-8'><input type='text' class='form-control' name='latitud' value='"+pos['lat']+"' required>";
            var bloc1 = document.getElementById("longitud");
             
            bloc1.innerHTML="<div class='col-sm-8'><input type='text' class='form-control' name='longitud' value='"+pos['lng']+"' required>";
            
      	}, function() {
              handleLocationError(true, infoWindow, map.getCenter());
        });
    } else {
        // Browser doesn't support Geolocation
    	handleLocationError(false, infoWindow, map.getCenter());
    }
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
}


function obtenerubicacion(){ 
    if (navigator.geolocation) { /* Si el navegador tiene geolocalizacion */
        watchID=navigator.geolocation.watchPosition(viewMap, errores,options);
        //navigator.geolocation.clearWatch(watchID);
    }else{
        alert('Oops! Tu navegador no soporta geolocalización. Bájate Chrome, que es gratis!');
    }
    
 }       
function viewMap (position) {
    var lon = position.coords.longitude;    //guardamos la longitud
    var lat = position.coords.latitude;     //guardamos la latitud

    location.href="../../index.php?c=acontecimiento&a=radiodeterminado&latitud="+lat+"&longitud="+lon;
    
}
function errores(err) {
        /*Controlamos los posibles errores */
        if (err.code == 0) {
            alert("Oops! Algo ha salido mal");
        }
        if (err.code == 1) {
            alert("Oops! No has aceptado compartir tu posición");
        }
        if (err.code == 2) {
            alert("Oops! No se puede obtener la posición actual");
        }
        if (err.code == 3) {
            alert("Oops! Hemos superado el tiempo de espera");
        }
    }     
