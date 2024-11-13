@extends('layouts.owner_layout')

@section('contents')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Truck</h1>

        <!-- Adjusted card width to make the form larger -->
        <div class="card mx-auto" style="max-width: 750px; padding: 20px;">
            <div class="card-body">
                <form action="{{ route('owner.truck.update', $truck->truck_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="license_plate">License Plate</label>
                        <input type="text" id="license_plate" name="license_plate" class="form-control"
                            value="{{ old('license_plate', $truck->license_plate) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="model">Model</label>
                        <input type="text" id="model" name="model" class="form-control"
                            value="{{ old('model', $truck->model) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="year">Year</label>
                        <input type="number" id="year" name="year" class="form-control"
                            value="{{ old('year', $truck->year) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="capacity">Capacity (kg)</label>
                        <input type="number" id="capacity" name="capacity" class="form-control"
                            value="{{ old('capacity', $truck->capacity) }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="color">Color</label>
                        <input type="text" id="color" name="color" class="form-control"
                            value="{{ old('color', $truck->color) }}">
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Update Truck</button>
                </form>
            </div>
        </div>
    </div>
@endsection
