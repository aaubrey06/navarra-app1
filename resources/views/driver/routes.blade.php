@extends('layouts.driver_layout')

@section('title', 'Routes')

@section('contents')

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSV1H3B9U0Ze4jyL05cJliB9CR7Zk14d4&libraries=places"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div id="map" style="height: 500px; width: 100%;"></div>
<div id="controls">
    <input type="text" id="waypoint-input" placeholder="Enter waypoint address" />
    <button id="add-waypoint">Add Waypoint</button>
    <button id="find-route">Find Shortest Route</button>
</div>
<div id="directions-panel"></div>

<script>
    // Initialize global variables
    var map, directionsService, directionsRenderer, userLocation;
    var waypoints = []; // Array to store waypoints
    var geocoder; // Geocoder for converting addresses to lat/lng

    // Function to initialize the map
    function initMap() {
        var iloiloCity = { lat: 10.720986774017764, lng: 122.56177996419011 };
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 13,
            center: iloiloCity
        });

        directionsService = new google.maps.DirectionsService();
        directionsRenderer = new google.maps.DirectionsRenderer();
        directionsRenderer.setMap(map);
        directionsRenderer.setPanel(document.getElementById('directions-panel'));

        // Initialize the geocoder
        geocoder = new google.maps.Geocoder();

        // Get user's current location
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                userLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                map.setCenter(userLocation);
                new google.maps.Marker({
                    position: userLocation,
                    map: map,
                    title: 'Your Location'
                });
            }, function () {
                console.error('Error: The Geolocation service failed.');
            });
        } else {
            console.error('Error: Your browser doesn\'t support geolocation.');
        }

        // Add waypoint button functionality
        document.getElementById('add-waypoint').addEventListener('click', function() {
            var input = document.getElementById('waypoint-input').value;

            if (input) {
                // Geocode the address to get lat/lng
                geocoder.geocode({ 'address': input }, function(results, status) {
                    if (status === 'OK') {
                        var location = results[0].geometry.location;

                        // Add marker for the waypoint
                        new google.maps.Marker({
                            position: location,
                            map: map,
                            title: 'Waypoint'
                        });

                        // Add to waypoints array
                        waypoints.push(location);
                        document.getElementById('waypoint-input').value = ''; // Clear input
                    } else {
                        alert('Geocode was not successful for the following reason: ' + status);
                    }
                });
            } else {
                alert('Please enter an address.');
            }
        });

        // Add find route functionality
        document.getElementById('find-route').addEventListener('click', function() {
            if (waypoints.length > 0) {
                var shortestPath = dijkstra(waypoints);
                calculateAndDisplayRoute(directionsService, directionsRenderer, userLocation, shortestPath);
            } else {
                alert('Please add waypoints to calculate the route.');
            }
        });
    }

    // Dijkstra's Algorithm to find the shortest path
    function dijkstra(waypoints) {
        let shortestPath = [userLocation]; // Start with user's location
        shortestPath = shortestPath.concat(waypoints); // Append the waypoints
        return shortestPath; // Return the path (this should be modified for actual distance calculation)
    }

    // Function to calculate and display the route
    function calculateAndDisplayRoute(directionsService, directionsRenderer, origin, waypoints) {
        var waypointsArray = waypoints.map(function(location) {
            return {
                location: location,
                stopover: true
            };
        });

        directionsService.route({
            origin: origin,
            destination: waypoints[waypoints.length - 1], // Last waypoint as the end
            waypoints: waypointsArray.slice(1), // Skip the origin
            travelMode: 'DRIVING'
        }, function(response, status) {
            if (status === 'OK') {
                directionsRenderer.setDirections(response);
            } else {
                console.error('Directions request failed due to ' + status);
            }
        });
    }

    // Load the map after the page is fully loaded
    google.maps.event.addDomListener(window, 'load', initMap);
</script>

@endsection