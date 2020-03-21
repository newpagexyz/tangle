 window.onload=function(){
 var platform = new H.service.Platform({
  'apikey': '{Xr86olRRYlJEGra77BlgSuDnyQaiQKvkjqZ_L88aFoo}'
});
 
 // Obtain the default map types from the platform object:
var defaultLayers = platform.createDefaultLayers();

// Instantiate (and display) a map object:
var map = new H.Map(
    document.getElementById('mapContainer'),
    defaultLayers.vector.normal.map,
    {
      zoom: 10,
      center: { lat: 52.5, lng: 13.4 }
    });
	
	
	var mapEvents = new H.mapevents.MapEvents(map);

// Add event listener:
map.addEventListener('tap', function(evt) {
    // Log 'tap' and 'mouse' events:
	
console.log(evt.type, evt.geo.Latitude); });

var behavior = new H.mapevents.Behavior(mapEvents);

	var ui = H.ui.UI.createDefault(map, defaultLayers, 'ru-RU');
	
	// Create a group that can hold map objects:
group = new H.map.Group();

// Add the group to the map object (created earlier):
map.addObject(group);

// Create a marker:
marker = new H.map.Marker(map.getCenter());

// Add the marker to the group (which causes 
// it to be displayed on the map)
group.addObject(marker);


var svgMarkup = '<svg width="24" height="24" ' +
    'xmlns="http://www.w3.org/2000/svg">' +
    '<rect stroke="white" fill="#1b468d" x="1" y="1" width="22" ' +
    'height="22" /><text x="12" y="18" font-size="12pt" ' +
    'font-family="Arial" font-weight="bold" text-anchor="middle" ' +
    'fill="white">H</text></svg>';
	


// Create an icon, an object holding the latitude and longitude, and a marker:
var icon = new H.map.Icon(svgMarkup),
 coords = {lat: 52.53075, lng: 13.3851},
   marker = new H.map.Marker(coords, {icon: icon});

// Add the marker to the map and center the map at the location of the marker:
map.addObject(marker);
map.setCenter(coords);

 }