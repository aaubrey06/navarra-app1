@extends('layouts.driver_layout')

@section('title', 'Delivery Orders')

@section('contents')
    <div class="d-flex flex-column">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Delivery Orders</h5>

                            <!-- Order details table -->
                            <table class="table table-striped table-bordered" id="ordersTable">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Order Date</th>
                                        <th>Customer Name</th>
                                        <th>Rice Type</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Location</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="orderDetailsBody">
                                    <!-- Order details will be populated here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal to show order details -->
    <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">Order Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Order details table -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Date</th>
                                <th>Customer Name</th>
                                <th>Rice Type</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Location</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="orderDetailsBodyModal">
                            <!-- Order details will be populated here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- Include jQuery and Bootstrap JS for modal functionality -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    // Fetch orders and display them
    $.ajax({
        url: "{{ route('driver.orders') }}",  // Ensure this route is correct in your application
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            const orderDetailsBody = $('#orderDetailsBody');
            orderDetailsBody.empty();  // Clear previous data

            // Loop through each order and create a row for each order
            data.forEach(function(order) {
                let orderRow = `
                    <tr>
                        <td>${order.order_id}</td>  <!-- Corrected field reference -->
                        <td>${order.order_date}</td>
                        <td>${order.customer_name}</td>
                        <td>${order.product_id}</td>  <!-- Corrected field reference -->
                        <td>${order.quantity}</td>
                        <td>${order.price}</td>
                        <td>${order.location}</td>
                        <td>${order.order_status}</td>  <!-- Corrected field reference -->
                    </tr>
                `;
                orderDetailsBody.append(orderRow);  // Append each row to the table
            });
        },
        error: function(error) {
            console.error('Error fetching orders:', error);
        }
    });
});
</script>
