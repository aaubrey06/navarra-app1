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

<script>
   var map, directionsService, directionsRenderer, userLocationMarker;
  var geocoder;
  var locations = [];
  var markers = []; // To store the markers for locations
  var routePolyline;
  var userLocation;
  var routePath = [];

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

  // Fetch orders and prepare the locations for the route
  async function fetchScheduledWaypoints() {
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
              markers = []; // Clear any existing markers

              data.forEach(function(order, index) {
                  if (isInIloiloCity(order.location) || (isSaturday && !isInIloiloCity(order.location))) {
                      // Add the order to the table
                      orderDetailsBody.append(
                          `<tr>
                              <td>${order.customer_name}</td>
                              <td>${order.phone_number || 'No contact number available.'}</td>
                              <td>${order.location || 'No location available.'}</td>
                              <td id="status-${order.id}">Pending</td>
                              <td>
                                  <button onclick="checkLocationAndDeclareDelivered('${order.id}', '${order.location}', ${index})">Delivered</button>
                                  <button onclick="checkLocationAndDeclareFailed('${order.id}', '${order.location}', ${index})">Failed</button>
                              </td>
                          </tr>`
                      );

                      // Add location to locations array for routing setup
                      geocoder.geocode({ 'address': order.location }, function(results, status) {
                          if (status === 'OK') {
                              const location = results[0].geometry.location;
                              locations.push({
                                  id: order.id,
                                  position: location,
                                  title: order.location
                              });

                              // Add marker for each location with numbers instead of letters
                              const marker = new google.maps.Marker({
                                  position: location,
                                  map: map,
                                  title: order.location,
                              });

                              markers.push(marker); // Store markers for future reference

                              // Enable the route generation button only if there are multiple locations
                              if (locations.length > 1) {
                                  $('#find-route').prop('disabled', false);
                              }
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

  // Function to check the driver's location before declaring delivery as delivered
  function checkLocationAndDeclareDelivered(orderId, orderLocation, index) {
      const orderLatLng = new google.maps.LatLng(orderLocation.lat, orderLocation.lng);

      // Calculate distance between the user's location and the order's location
      const distance = google.maps.geometry.spherical.computeDistanceBetween(userLocation, orderLatLng);

      // If the distance is less than 100 meters (or set your own threshold), allow delivery
      if (distance < 100) {
          confirmDelivery(orderId);
      } else {
          alert('You must be within the delivery location to confirm delivery.');
      }
  }

  // Function to check the driver's location before declaring the order as failed
  function checkLocationAndDeclareFailed(orderId, orderLocation, index) {
      const orderLatLng = new google.maps.LatLng(orderLocation.lat, orderLocation.lng);

      // Calculate distance between the user's location and the order's location
      const distance = google.maps.geometry.spherical.computeDistanceBetween(userLocation, orderLatLng);

      // If the driver is within a reasonable range (e.g., 100 meters), allow marking it as Failed
      if (distance < 100) {
          const reason = prompt("Please enter the reason for the failure:");

          if (reason) {
              updateStatus(orderId, 'Failed', reason);
          }
      } else {
          alert('You must be within the delivery location to mark the order as failed.');
      }
  }

  // Function to confirm delivery and update order status
  function confirmDelivery(id) {
      $.ajax({
          url: `/driver/confirm-delivery/${id}`,
          method: 'POST',
          data: {
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
  function updateStatus(id, status, reason = '') {
      if (status === 'Failed' && !reason) {
          alert('Please provide a reason for the failure.');
          return;
      }

      // Update the status cell with the status and reason
      const statusCell = document.getElementById(`status-${id}`);
      statusCell.innerText = `${status}${reason ? ` - ${reason}` : ''}`;
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
          }
      });
  }

  // Find the shortest route and generate the path
  $('#find-route').on('click', function() {
      const waypoints = locations.map(function(location) {
          return {
              location: location.position,
              stopover: true
          };
      });

      const request = {
          origin: userLocation,
          destination: locations[locations.length - 1].position,
          waypoints: waypoints,
          travelMode: 'DRIVING'
      };

      directionsService.route(request, function(result, status) {
          if (status === 'OK') {
              directionsRenderer.setDirections(result);
              routePolyline = result.routes[0].overview_path; // Store the polyline for further use
          } else {
              alert('Directions request failed due to ' + status);
          }
      });
  });

  // Initialize the map when the window loads
  window.onload = initMap;
</script>

@endsection