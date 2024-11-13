@extends('layouts.owner_layout')

@section('contents')
    <div class="container mt-5">
        <h3 class="text-center mb-4">Edit Store</h3>

        <!-- The form action now correctly passes store_id as a parameter -->
        <form action="{{ route('owner.store.update', $store->store_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row justify-content-center">
                <div class="col-md-8"> <!-- Adjusted column size to make the form wider -->

                    <!-- Store Name -->
                    <div class="form-group mb-4">
                        <label for="store_name">Store Name</label>
                        <input type="text" class="form-control form-control-lg" id="store_name" name="store_name"
                            value="{{ old('store_name', $store->store_name) }}" required>
                    </div>

                    <!-- Store Location -->
                    <div class="form-group mb-4">
                        <label for="store_location">Location</label>
                        <input type="text" class="form-control form-control-lg" id="store_location" name="store_location"
                            value="{{ old('store_location', $store->store_location) }}" required>
                    </div>

                    <!-- Contact -->
                    <div class="form-group mb-4">
                        <label for="contact">Contact</label>
                        <input type="text" class="form-control form-control-lg" id="contact" name="contact"
                            value="{{ old('contact', $store->contact) }}">
                    </div>

                    <!-- Working Hours -->
                    <div class="form-group mb-4">
                        <label for="working_hours">Working Hours</label>
                        <input type="text" class="form-control form-control-lg" id="working_hours" name="working_hours"
                            value="{{ old('working_hours', $store->working_hours) }}">
                    </div>

                    <!-- Status -->
                    <div class="form-group mb-4">
                        <label for="status">Status</label>
                        <select class="form-select form-select-lg" id="status" name="status" required>
                            <option value="open" {{ $store->status == 'open' ? 'selected' : '' }}>Open</option>
                            <option value="closed" {{ $store->status == 'closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                    </div>

                    <!-- Save Changes Button -->
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="bi bi-save"></i> Save Changes
                        </button>
                    </div>

                </div>
            </div>
        </form>
    </div>
@endsection
