@extends('layouts.owner_layout')

@section('contents')
    <div class="container mt-5">
        <h3 class="text-center mb-4">Add New Store</h3>

        <!-- Add Store Form -->
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('owner.store.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <!-- Store Name -->
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Store Name</label>
                            <input type="text" class="form-control" id="name" name="store_name"
                                placeholder="Enter store name" required>
                        </div>

                        <!-- Store Location -->
                        <div class="col-md-6 mb-3">
                            <label for="location" class="form-label">Store Location</label>
                            <input type="text" class="form-control" id="location" name="store_location"
                                placeholder="Enter store location" required>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Latitude -->
                        <div class="col-md-6 mb-3">
                            <label for="latitude" class="form-label">Latitude</label>
                            <input type="text" class="form-control" id="latitude" name="store_latitude"
                                placeholder="Enter latitude" required>
                        </div>

                        <!-- Longitude -->
                        <div class="col-md-6 mb-3">
                            <label for="longitude" class="form-label">Longitude</label>
                            <input type="text" class="form-control" id="longitude" name="store_longitude"
                                placeholder="Enter longitude" required>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Contact Number -->
                        <div class="col-md-6 mb-3">
                            <label for="contact" class="form-label">Contact Number</label>
                            <input type="text" class="form-control" id="contact" name="contact"
                                placeholder="Enter contact number" required>
                        </div>

                        <!-- Working Hours -->
                        <div class="col-md-6 mb-3">
                            <label for="working_hours" class="form-label">Working Hours</label>
                            <input type="text" class="form-control" id="working_hours" name="working_hours"
                                placeholder="Enter working hours" required>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Store Status -->
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="open">Open</option>
                                <option value="closed">Closed</option>
                            </select>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Save Store
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
