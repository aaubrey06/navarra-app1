@extends('layouts.owner_layout')

@section('contents')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <!-- Section Title -->
            <h3 class="text-center">Store Branches</h3>

            <!-- Add Store Button -->
            <a href="{{ route('owner.store.create') }}" class="btn btn-success">
                <i class="bi bi-plus"></i> Add Store
            </a>
        </div>

        <div class="row">
            {{-- Loop through the stores from the database --}}
            @foreach ($stores as $store)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $store->store_name }}</h5>
                            <p class="card-text">
                                <strong>Location:</strong> {{ $store->store_location }} <br>
                                <strong>Contact:</strong> {{ $store->contact ?? 'N/A' }} <br>
                                <strong>Working Hours:</strong> {{ $store->working_hours ?? 'N/A' }} <br>
                                <strong>Status:</strong>
                                <span class="badge {{ $store->status == 'open' ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst($store->status) }}
                                </span>
                            </p>
                            <div class="d-flex justify-content-between">
                                <!-- Edit Button -->
                                <a href="{{ route('owner.store.edit', $store->store_id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>

                                <!-- View on Map Button -->
                                <a href="https://www.google.com/maps?q={{ urlencode($store->store_location) }}"
                                    class="btn btn-info btn-sm" target="_blank">View on Map</a>

                                <!-- Delete Button (Form method POST for DELETE) -->
                                <form action="{{ route('owner.store.destroy', $store->store_id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this store?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
