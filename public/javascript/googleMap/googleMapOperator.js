function gmOperator () {
	//each on will contain only the center of the circle
	this.dotMap = undefined;
	this.radius = undefined;
	this.gmCircleObj = new Array;
	this.map = undefined; 
	this.initializeMap = function (lat, lng, zoom){
		//initialize the map
		var mapProp = {
			center: new google.maps.LatLng(lat, lng),
			zoom:zoom,
			mapTypeId:google.maps.MapTypeId.ROADMAP
		};
		this.map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
	};
	
    this.drawCirclesOnMap = function(dotMap, radius) {
        for (var i in dotMap) {
			var circleOptions = {
			    map: this.map,
			    center: new google.maps.LatLng(dotMap[i].fs_lat, dotMap[i].fs_lng),
			    radius: radius,
			};
			circle = new google.maps.Circle(circleOptions);
	    	//this.gmCircleObj[this.gmCircleObj.length] = circle;
	    	circle.setMap(this.map);
		}
    };
    this.drawFreeSpot = function (dotMap, radius, freeSpotName, drawCircles){
    	freeSpotName = freeSpotName ? freeSpotName : 'Free Spot';
    	radius = radius ? radius : 25;
    	drawCircles = drawCircles ? true : false;
    	//console.log(freeSpotName, radius, drawCircles);
    	var length = dotMap.length;
    	var tmpSpots = new Array();
    	for (var i = 1; i < length; i++){
    		if (!this.checkForIntersection(dotMap[0], dotMap[i], radius)) { 
    			//TODO send delete request for any dots that do not intersect for the current FreeSpot
    			continue;
    		}
    		tmpSpots[tmpSpots.length] = dotMap[i]; 
    	}
    	tmpSpots[tmpSpots.length]= dotMap[0];
    	if (drawCircles) {
    		this.drawCirclesOnMap(tmpSpots, radius);
    	}
    	polygon = this.createPolygon(tmpSpots);
    	this.createMarker(polygon.getCenter(), freeSpotName);
    };
    this.createMarker = function (LatLngObj, freeSpotName){
    	var marker = new google.maps.Marker({
	      position: LatLngObj,
	      map: this.map,
	      title: freeSpotName,
	  	});
	  	marker.setMap(this.map);
    };
    
    this.createPolygon = function(polygonEdges) {
    	var polygon = new google.maps.LatLngBounds();
    	for (var i in polygonEdges) {
    		polygon.extend(new google.maps.LatLng(polygonEdges[i].fs_lat, polygonEdges[i].fs_lng));
    	}
		return polygon;
    };
    
    this.checkForIntersection = function(pointA, pointB, radius){
		 /* 
	     * Find the points of intersection of two google maps circles or equal radius
	     * pointA: a google.maps.LatLng object 
	     * pointB: a google.maps.LatLng object
	     * returns: null if 
	     *    the two radii are not equal 
	     *    the two points are coincident
	     *    the two "circles" don't intersect
	     * otherwise returns: true
	     */
		var D;
		pointA = new google.maps.LatLng(pointA.fs_lat, pointA.fs_lng);
		pointB = new google.maps.LatLng(pointB.fs_lat, pointB.fs_lng);
	    if(pointA === pointB) {
	        throw( new Error("Points centres are coincident.") );
	    }
	    D = google.maps.geometry.spherical.computeDistanceBetween(pointA, pointB); //Distance between the two centres (in meters)
	    // Check that the two circles intersect
	    if(D > (2 * radius)) {
	        return false;
	    }
	    return true;
    };
}
/* This function can find the points of intercetion
function checkForIntersection(circleA, circleB) {
   

    var R, centerA, centerB, D, h, h_;

    try {

        R = circleA.getRadius();
        centerA = circleA.getCenter();
        centerB = circleB.getCenter();

        if(R !== circleB.getRadius()) {
            throw( new Error("Radii are not equal.") );
        }
        if(centerA.equals(centerB)) {
            throw( new Error("Circle centres are coincident.") );
        }

        D = google.maps.geometry.spherical.computeDistanceBetween(centerA, centerB); //Distance between the two centres (in meters)

        // Check that the two circles intersect
        if(D > (2 * R)) {
            throw( new Error("Circles do not intersect.") );
        }

        h = google.maps.geometry.spherical.computeHeading(centerA, centerB); //Heading from centre of circle A to centre of circle B. (in degrees)
        h_ = Math.acos(D / 2 / R) * 180 / Math.PI; //Included angle between the intersections (for either of the two circles) (in degrees). This is trivial only because the two radii are equal.

        //Return an array containing the two points of intersection as google.maps.latLng objects
        return [
            google.maps.geometry.spherical.computeOffset(centerA, R, h + h_),
            google.maps.geometry.spherical.computeOffset(centerA, R, h - h_)
        ];
    }
    catch(e) {
        console.error("getIntersections() :: " + e.message);
        return null;
    }
}*/