@extends('layouts.customer_layout')

@section('title', 'Profile')

@section('contents')
<section class="section">
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-4">My Profile</h5>

                @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="row">
                    {{-- <div class="col-md-4 text-center"> --}}
                    <div class="col-md-4 d-flex flex-column align-items-center">
                        <!-- Profile Picture -->
                        <img src="{{ asset('admin_assets/assets/img/profile-img.jpg') }}" alt="Profile Picture" class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                        <!-- Edit Profile Button -->
                        <a href="{{ route('customer.editProfile') }}"
                           class="btn btn-primary mt-auto"
                           style="width: 150px;">Edit Profile</a>
                    </div>

                    <!-- User Information Section -->
                    <div class="col-md-8">
                        <div class="mb-3">
                            <span><strong>Name:</strong>
                                {{ $user->first_name }} {{ $user->last_name }}
                            </span>
                        </div>

                        <div class="mb-3">
                            <span><strong>Email:</strong>
                                {{ $user->email }}
                            </span>
                        </div>

                        <div class="mb-3">
                            <span><strong>Phone:</strong>
                                {{ $customer->phone }}
                            </span>
                        </div>

                        <div class="mb-3">
                            <span><strong>Address:</strong>
                                {{ $customer->barangay }}, {{ $customer->city }},
                                {{ $customer->province }}, {{ $customer->region }}
                            </span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
    .card {
        border-radius: 8px;
        border: none;
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: 600;
    }

    .container {
        max-width: 800px;
    }

    .img-fluid {
        max-width: 100%;
        height: auto;
    }

    .col-md-4 {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
        height: 100%; /* Ensure full height for alignment */
    }
</style>
@endsection
