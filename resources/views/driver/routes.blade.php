@extends('layouts.driver_layout')

@section('title', 'Routes')

@section('contents')

<!-- Include Google Maps API and jQuery -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSV1H3B9U0Ze4jyL05cJliB9CR7Zk14d4&libraries=places"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Map container -->
<div id="map" style="height: 500px; width: 100%;"></div>

<!-- Locations table for displaying scheduled locations -->
<table id="locations-table" style="width: 100%; margin-top: 20px; text-align: left;">
    <thead>
        <tr>
            <th>Customer Name</th>
            <th>Contact Number</th>
            <th>Location</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <!-- Location rows will be added here dynamically -->
    </tbody>
</table>

<!-- Controls for finding the shortest route -->
<div id="controls">
    <button id="find-route">Find Shortest Route</button>
</div>

<!-- Directions panel -->
<div id="directions-panel"></div>

<!-- Camera capture modal (hidden initially) -->
<div id="cameraModal" style="display: none;">
    <video id="video" autoplay style="width: 100%; height: auto;"></video>
    <button id="capture">Capture Photo</button>
</div>
<canvas id="canvas" style="display: none;"></canvas>

<script>
    var map, directionsService, directionsRenderer, userLocationMarker;
    var geocoder;
    var locations = [];
    var distanceMatrix = {};

    // Initialize the map and fetch orders
    function initMap() {
        const iloiloCity = { lat: 10.720986774017764, lng: 122.56177996419011 };
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 13,
            center: iloiloCity
        });

        directionsService = new google.maps.DirectionsService();
        directionsRenderer = new google.maps.DirectionsRenderer();
        directionsRenderer.setMap(map);
        directionsRenderer.setPanel(document.getElementById('directions-panel'));

        geocoder = new google.maps.Geocoder();

        // Geolocation to get user's current location
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                userLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                map.setCenter(userLocation);

                // Add a green marker for the user's current location
                userLocationMarker = new google.maps.Marker({
                    position: userLocation,
                    map: map,
                    title: 'Your Location',
                    icon: {
                        path: google.maps.SymbolPath.CIRCLE,
                        scale: 8,
                        fillColor: 'green',
                        fillOpacity: 1,
                        strokeWeight: 1,
                        strokeColor: 'white'
                    }
                });

                // Start fetching waypoints after setting the user location
                fetchScheduledWaypoints();
            }, function() {
                console.error('Geolocation service failed.');
            });
        } else {
            console.error('Your browser doesn\'t support geolocation.');
        }
    }

    // Fetch orders and prepare the graph for Dijkstra’s algorithm
    function fetchScheduledWaypoints() {
        const today = new Date().getDay(); // 0 = Sunday, 6 = Saturday
        const isSaturday = today === 6;

        $.ajax({
            url: "{{ route('driver.orders') }}",
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                const orderDetailsBody = $('#locations-table tbody');
                orderDetailsBody.empty();
                locations = [];

                data.forEach(function(order) {
                    if (isInIloiloCity(order.location) || (isSaturday && !isInIloiloCity(order.location))) {
                        // Add the order to the table
                        orderDetailsBody.append(`
                            <tr>
                                <td>${order.customer_name}</td>
                                <td>${order.contact_number || 'No contact number available.'}</td>
                                <td>${order.location || 'No location available.'}</td>
                                <td id="status-${order.id}">Pending</td>
                                <td>
                                    <button onclick="openCamera('${order.id}')">Delivered</button>
                                    <button onclick="updateStatus('${order.id}', 'Failed')">Failed</button>
                                </td>
                            </tr>
                        `);

                        // Add location to locations array for graph setup
                        geocoder.geocode({ 'address': order.location }, function(results, status) {
                            if (status === 'OK') {
                                const location = results[0].geometry.location;
                                locations.push({
                                    id: order.id,
                                    position: location,
                                    title: order.location
                                });

                                // Add marker on the map
                                new google.maps.Marker({
                                    position: location,
                                    map: map,
                                    title: order.location
                                });

                                // Calculate distance from current location to each location and store in distanceMatrix
                                if (locations.length > 1) calculateDistanceMatrix();
                            } else {
                                console.error('Geocode failed for location:', order.location);
                            }
                        });
                    }
                });
            },
            error: function(error) {
                console.error('Error fetching orders:', error);
            }
        });
    }

    // Check if a location is within Iloilo City
    function isInIloiloCity(address) {
        return address.includes("Iloilo City");
    }

    // Calculate the distance matrix for Dijkstra's algorithm
    function calculateDistanceMatrix() {
        // Include user location as the starting node in the matrix
        locations.unshift({
            id: 'current',
            position: userLocation,
            title: 'Your Location'
        });

        for (let i = 0; i < locations.length; i++) {
            for (let j = 0; j < locations.length; j++) {
                if (i !== j) {
                    const origin = locations[i].position;
                    const destination = locations[j].position;

                    directionsService.route({
                        origin: origin,
                        destination: destination,
                        travelMode: 'DRIVING'
                    }, function(response, status) {
                        if (status === 'OK') {
                            const distance = response.routes[0].legs[0].distance.value;
                            distanceMatrix[`${i}-${j}`] = distance;
                        } else {
                            console.error('Directions request failed due to ' + status);
                        }
                    });
                }
            }
        }
    }

    // Implement Dijkstra's algorithm to find the shortest path
    function dijkstra(startIndex) {
        const distances = {};
        const visited = {};
        const previous = {};

        // Initialize distances and previous
        for (let i = 0; i < locations.length; i++) {
            distances[i] = Infinity;
            previous[i] = null;
        }
        distances[startIndex] = 0;

        // Dijkstra's algorithm
        for (let i = 0; i < locations.length - 1; i++) {
            let minDistNode = null;

            // Find the closest unvisited node
            for (let node in distances) {
                if (!visited[node] && (minDistNode === null || distances[node] < distances[minDistNode])) {
                    minDistNode = node;
                }
            }

            if (distances[minDistNode] === Infinity) break;
            visited[minDistNode] = true;

            // Update distances for neighbors
            for (let neighbor in distances) {
                if (!visited[neighbor] && distanceMatrix[`${minDistNode}-${neighbor}`] !== undefined) {
                    const newDist = distances[minDistNode] + distanceMatrix[`${minDistNode}-${neighbor}`];
                    if (newDist < distances[neighbor]) {
                        distances[neighbor] = newDist;
                        previous[neighbor] = minDistNode;
                    }
                }
            }
        }

        // Build the shortest path
        const path = [];
        let currentNode = Object.keys(distances).reduce((minNode, node) => distances[node] < distances[minNode] ? node : minNode, startIndex);
        while (currentNode !== null) {
            path.unshift(currentNode);
            currentNode = previous[currentNode];
        }

        displayShortestPath(path);
    }

    // Display the shortest path on the map
    function displayShortestPath(path) {
        const route = path.map(index => locations[index].position);
        const origin = route[0];
        const destination = route[route.length - 1];
        const waypoints = route.slice(1, -1).map(position => ({ location: position, stopover: true }));

        directionsService.route({
            origin: origin,
            destination: destination,
            waypoints: waypoints,
            travelMode: 'DRIVING'
        }, function(response, status) {
            if (status === 'OK') {
                directionsRenderer.setDirections(response);
            } else {
                console.error('Directions request failed due to ' + status);
            }
        });
    }

    // Execute Dijkstra's algorithm after all locations have been fetched and distances are calculated
    function findShortestRoute() {
        dijkstra(0);  // Start from the driver's current location (index 0 after unshift)
    }

    // Attach the findShortestRoute function to the "Find Route" button
    document.getElementById('find-route').addEventListener('click', findShortestRoute);

    // Function to open camera for delivery confirmation
    function openCamera(id) {
        const video = document.getElementById('video');
        const cameraModal = document.getElementById('cameraModal');
        cameraModal.style.display = 'block';

        navigator.mediaDevices.getUserMedia({ video: true }).then((stream) => {
            video.srcObject = stream;
            video.play();
            document.getElementById('capture').onclick = () => capturePhoto(id, stream);
        }).catch((error) => {
            console.error("Error accessing the camera:", error);
        });
    }

    // Function to capture photo and confirm delivery
    function capturePhoto(id, stream) {
        const canvas = document.getElementById('canvas');
        const video = document.getElementById('video');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
        const imageData = canvas.toDataURL('image/png');
        stream.getTracks().forEach(track => track.stop());
        document.getElementById('cameraModal').style.display = 'none';
        confirmDelivery(id, imageData);
    }

    // Function to confirm delivery and update order status
    function confirmDelivery(id, imageData) {
        $.ajax({
            url: `/driver/confirm-delivery/${id}`,
            method: 'POST',
            data: {
                image: imageData,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                alert(response.message);
                const statusCell = document.getElementById(`status-${id}`);
                statusCell.innerText = 'Delivered';
                statusCell.style.color = 'green';
            },
            error: function(xhr, status, error) {
                console.error("Failed to confirm delivery:", error);
                alert('Failed to confirm delivery');
            }
        });
    }

    // Function to update the order status
    // Function to update the order status with reason for failure
function updateStatus(id, status) {
    if (status === 'Failed') {
        const reason = prompt("Please enter the reason for the failure:");

        if (reason) {
            // Update the status cell with the status and reason
            const statusCell = document.getElementById(`status-${id}`);
            statusCell.innerText = `${status}`;
            statusCell.style.color = 'red';

            // Optionally, send the failure reason to the server if you need to store it
            $.ajax({
                url: `/driver/update-status/${id}`,
                method: 'POST',
                data: {
                    status: status,
                    reason: reason,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert(response.message);
                },
                error: function(xhr, status, error) {
                    console.error("Failed to update status:", error);
                    alert('Failed to update status');
                }
            });
        }
    } else {
        // For other statuses like 'Delivered', just update the status text
        const statusCell = document.getElementById(`status-${id}`);
        statusCell.innerText = status;
        statusCell.style.color = 'green';
    }
}


    // Load the map after the page is ready
    google.maps.event.addDomListener(window, 'load', initMap);

</script>

@endsection
