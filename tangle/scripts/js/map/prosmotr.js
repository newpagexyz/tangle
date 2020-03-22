 window.onload=function(){
var platform = new H.service.Platform({
  apikey: 'LPmNvbdt1t_Qlp7NBD_6NdqoHUVS2Pw8ToCUQWfpq34',
  useHTTPS: true
});


var flag=1;
var  M=M_GLOBAL;//////////////////////////////////////////////////

var N=0;
 var flag2=0;
 var B=B_GLOBAL;/////////////////////////////////////////

button2.onclick=function(){
	for(var i=0;i<M.length;i++)
	{
		flag=1;
	addDraggableMarker(map, behavior,i);
	}
	
	
	if(M.length>1)
  {aaa();}



}

	
                  
/**
 * * Calculates and displays a public trasnsport route from the Fernsehturm in Berlin
 * to Kurfürstendamm in the west of the city
 *
 * A full list of available request parameters can be found in the Routing API documentation.
 * see:  http://developer.here.com/rest-apis/documentation/routing/topics/resource-calculate-route.html
 *
 * @param   {H.service.Platform} platform    A stub class to access HERE services
 */

// set up containers for the map  + panel
var mapContainer = document.getElementById('mapContainer'),
  routeInstructionsContainer = document.getElementById('panel');

//Step 1: initialize communication with the platform
// In your own code, replace variable window.apikey with your own apikey
var platform = new H.service.Platform({
  apikey: 'LPmNvbdt1t_Qlp7NBD_6NdqoHUVS2Pw8ToCUQWfpq34',
  useHTTPS: true
});
var defaultLayers = platform.createDefaultLayers();

//Step 2: initialize a map - this map is centered over Berlin
var map = new H.Map(mapContainer,
  defaultLayers.vector.normal.map,{
  center: {lat:M[0].lat, lng:M[0].lng},
  zoom: 13,
  pixelRatio: window.devicePixelRatio || 1
});
// add a resize listener to make sure that the map occupies the whole container
window.addEventListener('resize', () => map.getViewPort().resize());

//Step 3: make the map interactive
// MapEvents enables the event system
// Behavior implements default interactions for pan/zoom (also on mobile touch environments)
//var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));

// Create the default UI components
//var ui = H.ui.UI.createDefault(map, defaultLayers);

// Hold a reference to any infobubble opened
var bubble;

/**
 * Opens/Closes a infobubble
 * @param  {H.geo.Point} position     The location on the map.
 * @param  {String} text              The contents of the infobubble.
 */
function openBubble(position, text){
 if(!bubble){
    bubble =  new H.ui.InfoBubble(
      position,
      // The FO property holds the province name.
      {content: text});
    ui.addBubble(bubble);
  } else {
    bubble.setPosition(position);
    bubble.setContent(text);
    bubble.open();
  }
}


/**
 * Creates a H.map.Polyline from the shape of the route and adds it to the map.
 * @param {Object} route A route as received from the H.service.RoutingService
 */

                  
             

 
 // Obtain the default map types from the platform object:
var defaultLayers = platform.createDefaultLayers();

// Instantiate (and display) a map object:
/*var map = new H.Map(
    document.getElementById('mapContainer'),
    defaultLayers.vector.normal.map,
    {
      zoom: 10,
      center: { lat: 52.5, lng: 13.4 }
    });
	*/
/*	var mapContainer = document.getElementById('mapContainer'),
  routeInstructionsContainer = document.getElementById('panel');
  var map = new H.Map(mapContainer,
  defaultLayers.vector.normal.map,{
  center: {lat:52.5160, lng:13.3779},
  zoom: 13,
  pixelRatio: window.devicePixelRatio || 1
});*/

	var mapEvents = new H.mapevents.MapEvents(map);
var behavior = new H.mapevents.Behavior(mapEvents);
	var ui = H.ui.UI.createDefault(map, defaultLayers, 'ru-RU');

group = new H.map.Group();

map.addObject(group);



function addDraggableMarker(map, behavior,i){

group.addEventListener('tap', function (evt) {
	
	console.log(i);
	
    // event target is the marker itself, group is a parent event target
    // for all objects that it contains
	
	var target = evt.target;
	if(target instanceof H.map.Marker){
    var bubble =  new H.ui.InfoBubble(evt.target.getGeometry(), {
      // read custom data
      content: evt.target.getData()
    });console.log(evt.target.getData())
    // show info bubble
    ui.addBubble(bubble);
	
	}
  }, false);
if(flag==1)
{
	
	
	
   var  marker = new H.map.Marker({lat:M[i].lat, lng:M[i].lng});

flag=0;
console.log('create');



var svgMarkup = '<svg width="24" height="24" ' +
    'xmlns="http://www.w3.org/2000/svg">' +
    '<rect stroke="white" fill="#1b468d" x="1" y="1" width="22" ' +
    'height="22" /><text x="12" y="18" font-size="12pt" ' +
    'font-family="Arial" font-weight="bold" text-anchor="middle" ' +
    'fill="white">'+(i+1).toString()+'</text></svg>';
/// здесь дожен создаваться  html из которых заберетсяя текст в пузырики
 My_window.style.visibility='visible';
 My_window.style.height = '100px';
 My_window.style.width = '100px';
  console.log(marker.viewportX);
  var icon = new H.map.Icon(svgMarkup);

   marker = new H.map.Marker({lat:M[i].lat, lng:M[i].lng}, {icon: icon});

	 marker.setData(B[i]);   /// здесь дожен забрать надписи из html файлов
  // Ensure that the marker can receive drag events
 
 marker.draggable = false;
  group.addObject(marker);
  

}



  
  
   




  // disable the default draggability of the underlying map
  // and calculate the offset between mouse and target's position
  // when starting to drag a marker object:
  map.addEventListener('dragstart', function(ev) {
    var target = ev.target,
        pointer = ev.currentPointer;
		
    if (target instanceof H.map.Marker) {
      var targetPosition = map.geoToScreen(target.getGeometry());
      target['offset'] = new H.math.Point(pointer.viewportX - targetPosition.x, pointer.viewportY - targetPosition.y);
      console.log(target.getGeometry());
	  behavior.disable();
    }
  }, false);


  // re-enable the default draggability of the underlying map
  // when dragging has completed
  map.addEventListener('dragend', function(ev) {
    var target = ev.target;
    if (target instanceof H.map.Marker) {
      behavior.enable();
    }
  }, false);

  // Listen to the drag event and move the position of the marker
  // as necessary
   map.addEventListener('drag', function(ev) {
    var target = ev.target,
        pointer = ev.currentPointer;
		
    if (target instanceof H.map.Marker) {
		var c=target.getGeometry();
      target.setGeometry(map.screenToGeo(pointer.viewportX - target['offset'].x, pointer.viewportY - target['offset'].y));
	
	for(var i=0;i<M.length;i++)
	{
		
		if(c.lat==M[i].lat && c.lng==M[i].lng)
		{
			M[i]=target.getGeometry();
			break;
		}
	}
	}
  }, false);
}


var svgMarkup = '<svg width="24" height="24" ' +
    'xmlns="http://www.w3.org/2000/svg">' +
    '<rect stroke="white" fill="#1b468d" x="1" y="1" width="22" ' +
    'height="22" /><text x="12" y="18" font-size="12pt" ' +
    'font-family="Arial" font-weight="bold" text-anchor="middle" ' +
    'fill="white">H</text></svg>';
	


function aaa(){    


console.log('aaa');
         
/**
 * * Calculates and displays a public trasnsport route from the Fernsehturm in Berlin
 * to Kurfürstendamm in the west of the city
 *
 * A full list of available request parameters can be found in the Routing API documentation.
 * see:  http://developer.here.com/rest-apis/documentation/routing/topics/resource-calculate-route.html
 *
 * @param   {H.service.Platform} platform    A stub class to access HERE services
 */
function calculateRouteFromAtoB (platform, lat1, lng1, lat2, lng2) {
	
  var router = platform.getRoutingService(),
    routeRequestParams = {
      mode: 'fastest;publicTransport',
      representation: 'display',
      waypoint0: lat1.toString()+','+lng1.toString(), // Fernsehturm
      waypoint1: lat2.toString()+','+lng2.toString(),  // Kurfürstendamm
	  routeattributes: 'waypoints,summary,shape,legs',
      maneuverattributes: 'direction,action'
    };
	


  router.calculateRoute(
    routeRequestParams,
    onSuccess,
    onError
  );
}
/**
 * This function will be called once the Routing REST API provides a response
 * @param  {Object} result          A JSONP object representing the calculated route
 *
 * see: http://developer.here.com/rest-apis/documentation/routing/topics/resource-type-calculate-route.html
 */
function onSuccess(result) {
  var route = result.response.route[0];
 /*
  * The styling of the route response on the map is entirely under the developer's control.
  * A representitive styling can be found the full JS + HTML code of this example
  * in the functions below:
  */
  addRouteShapeToMap(route);
  addManueversToMap(route);

  addWaypointsToPanel(route.waypoint);
  addManueversToPanel(route);
  addSummaryToPanel(route.summary);
  // ... etc.
}

/**
 * This function will be called if a communication error occurs during the JSON-P request
 * @param  {Object} error  The error message received.
 */
function onError(error) {
  alert('Can\'t reach the remote server');
}

/**
 * Boilerplate map initialization code starts below:
 */

// set up containers for the map  + panel

// add a resize listener to make sure that the map occupies the whole container


/**
 * Opens/Closes a infobubble
 * @param  {H.geo.Point} position     The location on the map.
 * @param  {String} text              The contents of the infobubble.
 */
function openBubble(position, text){
 if(!bubble){
    bubble =  new H.ui.InfoBubble(
      position,
      // The FO property holds the province name.
      {content: text});
    ui.addBubble(bubble);
  } else {
    bubble.setPosition(position);
    bubble.setContent(text);
    bubble.open();
  }
}


/**
 * Creates a H.map.Polyline from the shape of the route and adds it to the map.
 * @param {Object} route A route as received from the H.service.RoutingService
 */
function addRouteShapeToMap(route){
  var lineString = new H.geo.LineString(),
    routeShape = route.shape,
    polyline;

  routeShape.forEach(function(point) {
    var parts = point.split(',');
    lineString.pushLatLngAlt(parts[0], parts[1]);
  });

  polyline = new H.map.Polyline(lineString, {
    style: {
      lineWidth: 4,
      strokeColor: 'rgba(0, 128, 255, 0.7)'
    }
  });
  // Add the polyline to the map
  map.addObject(polyline);
  // And zoom to its bounding rectangle
  map.getViewModel().setLookAtData({
    bounds: polyline.getBoundingBox()
  });
}


/**
 * Creates a series of H.map.Marker points from the route and adds them to the map.
 * @param {Object} route  A route as received from the H.service.RoutingService
 */
function addManueversToMap(route){
  var svgMarkup = '',
    dotIcon = new H.map.Icon(svgMarkup, {anchor: {x:8, y:8}}),
    group = new  H.map.Group(),i,j;

  // Add a marker for each maneuver
  for (i = 0;  i < route.leg.length; i += 1) {
    for (j = 0;  j < route.leg[i].maneuver.length; j += 1) {
      // Get the next maneuver.
      maneuver = route.leg[i].maneuver[j];
      // Add a marker to the maneuvers group
      var marker =  new H.map.Marker({
        lat: maneuver.position.latitude,
        lng: maneuver.position.longitude} ,{icon: dotIcon});
      marker.instruction = maneuver.instruction;
      group.addObject(marker);
    }
  }

  group.addEventListener('tap', function (evt) {
    map.setCenter(evt.target.getGeometry());
    openBubble(
       evt.target.getGeometry(), evt.target.instruction);
  }, false);

  // Add the maneuvers group to the map
  map.addObject(group);
}


/**
 * Creates a series of H.map.Marker points from the route and adds them to the map.
 * @param {Object} route  A route as received from the H.service.RoutingService
 */
function addWaypointsToPanel(waypoints){
  var nodeH3 = document.createElement('h3'),
    waypointLabels = [],i;
   for (i = 0;  i < waypoints.length; i += 1) {
    waypointLabels.push(waypoints[i].label)
   }

   nodeH3.textContent = waypointLabels.join(' - ');

  routeInstructionsContainer.innerHTML = '';
  routeInstructionsContainer.appendChild(nodeH3);
}

/**
 * Creates a series of H.map.Marker points from the route and adds them to the map.
 * @param {Object} route  A route as received from the H.service.RoutingService
 */
function addSummaryToPanel(summary){
  var summaryDiv = document.createElement('div'),
   content = '';
   content += 'Total distance: ' + summary.distance  + 'm.';
   content += 'Travel Time: ' + summary.travelTime.toMMSS() + ' (in current traffic)';


  summaryDiv.style.fontSize = 'small';
  summaryDiv.style.marginLeft ='5%';
  summaryDiv.style.marginRight ='5%';
  summaryDiv.innerHTML = content;
  routeInstructionsContainer.appendChild(summaryDiv);
}

/**
 * Creates a series of H.map.Marker points from the route and adds them to the map.
 * @param {Object} route  A route as received from the H.service.RoutingService
 */
function addManueversToPanel(route){



  var nodeOL = document.createElement('ol'),i,j;

  nodeOL.style.fontSize = 'small';
  nodeOL.style.marginLeft ='5%';
  nodeOL.style.marginRight ='5%';
  nodeOL.className = 'directions';

     // Add a marker for each maneuver
  for (i = 0;  i < route.leg.length; i += 1) {
    for (j = 0;  j < route.leg[i].maneuver.length; j += 1) {
      // Get the next maneuver.
      maneuver = route.leg[i].maneuver[j];

      var li = document.createElement('li'),
        spanArrow = document.createElement('span'),
        spanInstruction = document.createElement('span');

      spanArrow.className = 'arrow '  + maneuver.action;
      spanInstruction.innerHTML = maneuver.instruction;
      li.appendChild(spanArrow);
      li.appendChild(spanInstruction);

      nodeOL.appendChild(li);
    }
  }

  routeInstructionsContainer.appendChild(nodeOL);
}


Number.prototype.toMMSS = function () {
  return  Math.floor(this / 60)  +' minutes '+ (this % 60)  + ' seconds.';
}

// Now use the map as required...
for(var i=0; i<M.length-1;i++)
{

	calculateRouteFromAtoB (platform,M[i].lat,M[i].lng,M[i+1].lat,M[i+1].lng);
}

} 



	







 }
