@extends('layouts.driver_layout')

@section('title', 'Schedule')

@section('contents')
    <div class="d-flex flex-column">
    </div>
    <div></div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Delivery Schedule</h5>

                        <!-- Table to display orders within Iloilo City -->
                        <h6>Deliveries within Iloilo City</h6>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Order No.</th>
                                    <th>Customer Name</th>
                                    <th>Location</th>
                                    <th>Contact Number</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="orderDetailsBodyIloilo">
                                <!-- Data for Iloilo City will be populated here by AJAX -->
                            </tbody>
                        </table>

                        <!-- Table to display orders outside Iloilo City -->
                        <h6>Deliveries Outside Iloilo City (Scheduled for Saturday)</h6>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Order No.</th>
                                    <th>Customer Name</th>
                                    <th>Location</th>
                                    <th>Contact Number</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="orderDetailsBodyOutsideIloilo">
                                <!-- Data for Outside Iloilo City will be populated here by AJAX -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<!-- Include jQuery and Bootstrap JS for modal functionality -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSV1H3B9U0Ze4jyL05cJliB9CR7Zk14d4&libraries=places"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    // Function to check if the location is inside Iloilo City using Google Maps Geocoding API
    function isOutsideIloilo(address) {
        // Google Maps Geocoding API to get location data
        var geocoder = new google.maps.Geocoder();
        return new Promise((resolve, reject) => {
            geocoder.geocode({ 'address': address }, function(results, status) {
                if (status === 'OK') {
                    // Check if Iloilo City is in the returned address components
                    let components = results[0].address_components;
                    let isIloilo = components.some(component => component.long_name.toLowerCase() === 'iloilo city');
                    resolve(!isIloilo);  // Return true if outside Iloilo City, false otherwise
                } else {
                    reject('Geocode was not successful for the following reason: ' + status);
                }
            });
        });
    }

    // Fetch orders when the page is loaded
    $.ajax({
        url: "{{ route('driver.orders') }}",  // Ensure this route is correct in your application
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            let orderDetailsBodyIloilo = $('#orderDetailsBodyIloilo');
            let orderDetailsBodyOutsideIloilo = $('#orderDetailsBodyOutsideIloilo');
            orderDetailsBodyIloilo.empty();  // Clear any previous data
            orderDetailsBodyOutsideIloilo.empty();  // Clear any previous data

            // Loop through each order and append to the appropriate table
            data.forEach(async function(order) {
                let orderRow = ` 
                    <tr>
                        <td>${order.order_id}</td>
                        <td>${order.customer_name}</td>
                        <td>${order.location}</td>
                        <td>${order.phone_number}</td>
                        <td>${order.order_status}</td>
                    </tr>
                `;

                // Check if the address is outside Iloilo City
                try {
                    let isOutside = await isOutsideIloilo(order.location);
                    if (isOutside) {
                        // Append to the outside Iloilo table (Scheduled for Saturday)
                        orderDetailsBodyOutsideIloilo.append(orderRow);
                    } else {
                        // Append to the Iloilo City table
                        orderDetailsBodyIloilo.append(orderRow);
                    }
                } catch (error) {
                    console.error('Error with Google Maps API:', error);
                }
            });
        },
        error: function(error) {
            console.error('Error fetching orders:', error);
        }
    });
});
</script>
