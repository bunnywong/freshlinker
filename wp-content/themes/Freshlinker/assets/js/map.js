
"use_strict";

// Google map functions
function initialize() {
	var latlng = new google.maps.LatLng( gmaps.latitude, gmaps.longitude ),
		zoom = parseInt(gmaps.zoom),
		target = gmaps.target;

	var mapOptions = {
		center: latlng,
		zoom: zoom,
		scrollwheel: false,
		disableDefaultUI: true
	};

	var map = new google.maps.Map(document.getElementById(target), mapOptions);

	/*
	var marker = new google.maps.Marker({
		position: latlng,
		map: map,
		title:"Hello World!"
	});

	var contentString = '<div id="content">'+
	'<div id="siteNotice">'+
	'</div>'+
	'<h1 id="firstHeading" class="firstHeading">Uluru</h1>'+
	'<div id="bodyContent">'+
	'<p><b>Uluru</b>, also referred to as <b>Ayers Rock</b>, is a large ' +
	'</div>'+
	'</div>';

	var infowindow = new google.maps.InfoWindow({
		content: contentString
	});

	google.maps.event.addListener(marker, 'click', function() {
		infowindow.open(map,marker);
	});
	*/


}
google.maps.event.addDomListener(window, 'load', initialize);
