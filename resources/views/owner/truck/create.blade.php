@extends('layouts.owner_layout')

@section('contents')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Add New Truck</h1>

        <!-- Adjusted card width to make the form larger -->
        <div class="card mx-auto" style="max-width: 750px; padding: 20px;">
            <div class="card-body">
                <form action="{{ route('owner.truck.store') }}" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="license_plate">License Plate</label>
                        <input type="text" id="license_plate" name="license_plate" class="form-control"
                            placeholder="Enter License Plate" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="model">Model</label>
                        <input type="text" id="model" name="model" class="form-control"
                            placeholder="Enter Truck Model" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="year">Year</label>
                        <input type="number" id="year" name="year" class="form-control"
                            placeholder="Enter Manufacturing Year" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="capacity">Capacity (kg)</label>
                        <input type="number" id="capacity" name="capacity" class="form-control"
                            placeholder="Enter Capacity in kg">
                    </div>

                    <div class="form-group mb-3">
                        <label for="color">Color</label>
                        <input type="text" id="color" name="color" class="form-control"
                            placeholder="Enter Truck Color">
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Add Truck</button>

                </form>
            </div>
        </div>
    </div>
@endsection
