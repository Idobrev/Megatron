/**
 * Requests free Dots on the map and draws them on succes with the gmOperator 
 */
function ajax_requestFSDots($lat, $lng) {
	var request = $.ajax({
	  url: "restAPI/getFreeSpots",
	  type: 'post',
	  data: {'lat': $lat, 'lng': $lng},
	  context: document.body,
	  dataType: 'json',
	});
	
	request.done(function(dots) {
		//debug
		//console.log(dots);
		//gubed
		try {
			for (var i in dots) {
				gmOperator.drawFreeSpot( dots[i], 30 , dots[i].fs_name, dots[i][0].level);
			}
		}catch (e) {
		    console.error(e.message);
		}
	});
	
	request.fail(function( jqXHR, textStatus ) {
		console.log( "Request failed: " + textStatus );
		return false;
	});
	
}
/*
var dots = [
	//{lat: 42.160639, lng: 24.753112},
	{lat: 42.160400, lng: 24.753600},
	//{lat: 42.160192, lng: 24.756990},
	{lat: 42.160192, lng: 24.753600},
];*/
try {
	gmOperator = new gmOperator(false);
	google.maps.event.addDomListener(window, 'load', gmOperator.initializeMap(42.160639, 24.753112, 16));
}catch(e) {
    console.error(e.message);
}

$(window).load(function() {
	ajax_requestFSDots(42.160400, 24.753600);
});



