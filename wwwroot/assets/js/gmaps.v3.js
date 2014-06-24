$(function() {
	if($("#destino").length){
		var script = document.createElement("script");
		script.type = "text/javascript";
		script.src = "http://maps.googleapis.com/maps/api/js?sensor=false&callback=inicializaMapa";
		document.body.appendChild(script);
	}
});

function inicializaMapa(){
	showAddress($("#destino").val());
}

function showAddress(address) {
	var map;
	var geocoder;
	var addressMarker;	
	
	geocoder = new google.maps.Geocoder();
	var myOptions = {
	  zoom: 15,
	  scrollwheel: false,
	  mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	map = new google.maps.Map(document.getElementById("map"), myOptions);
	
	geocoder.geocode( { 'address': address}, function(results, status) {
	  if (status == google.maps.GeocoderStatus.OK) {
		map.setCenter(results[0].geometry.location);
		var marker = new google.maps.Marker({
			map: map, 
			position: results[0].geometry.location
		});
	  } else {
		alert("Falha no carregamento do mapa: " + status);
	  }
	});

}

function showTrace(origem, destino) {
	var directionDisplay;
	var directionsService = new google.maps.DirectionsService();
	var map;
	
	/*clean*/
	document.getElementById("directions").innerHTML = '';
	
	directionsDisplay = new google.maps.DirectionsRenderer();
	var myOptions = {
	  zoom:7,
	  scrollwheel: false,
	  mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	map = new google.maps.Map(document.getElementById("map"), myOptions);
	directionsDisplay.setMap(map);
	directionsDisplay.setPanel(document.getElementById("directions"));
	
	var start = origem;
	var end = destino;
	var request = {
		origin:start, 
		destination:end,
		travelMode: google.maps.DirectionsTravelMode.DRIVING
	};
	directionsService.route(request, function(response, status) {
	  if (status == google.maps.DirectionsStatus.OK) {
		directionsDisplay.setDirections(response);
	  }
	  else {
		alert("Não foi possivel encontrar o endereço digitado. \nVerifique se o endereço esta correto ou se possui alguma abreviação");  
		showAddress($("#destino").val());
	  }
	});
}