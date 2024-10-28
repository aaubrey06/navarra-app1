@extends('layouts.customer_layout')

@section('title', 'Edit Profile')


@section('contents')

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSV1H3B9U0Ze4jyL05cJliB9CR7Zk14d4&libraries=places">
    </script>

    <section class="section">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-4">Edit Profile</h5>

                    <!-- Edit Profile Form -->
                    <form action="{{ route('customer.updateProfile') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <!-- First Name -->
                            <div class="col-md-6">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="first_name"
                                       name="first_name" value="{{ $user->first_name ?? '' }}"
                                       required placeholder="Enter your first name">
                            </div>

                            <!-- Last Name -->
                            <div class="col-md-6">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="last_name"
                                       name="last_name" value="{{ $user->last_name ?? '' }}"
                                       required placeholder="Enter your last name">
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="md-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email"
                            name="email" value="{{ $user->email ?? '' }}"
                            required placeholder="Enter your email">
                        </div>

                        <br>

                        <div class="mb-3">
                            <!-- Phone Number -->
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone"
                                   name="phone" value="{{ $user->phone ?? '' }}"
                                   required placeholder="Enter your phone number">
                        </div>

                        <!-- Address Fields -->
                        <!-- Region -->
                        {{-- <div class="mb-3">
                            <label for="region" class="form-label">Region</label>
                            <select id="region" name="region" class="form-control" required>
                                <option value="">Select Region</option>
                                <option value="Region I" data-provinces='["Ilocos Norte", "Ilocos Sur"]'>Region I – Ilocos Region</option>
                                <option value="Region VI" data-provinces='["Iloilo", "Negros Occidental"]'>Region VI – Western Visayas</option>
                                <option value="Region VII" data-provinces='["Cebu", "Bohol"]'>Region VII – Central Visayas</option>
                            </select>
                        </div> --}}

                        <!-- Region Textbox -->
                        <div class="mb-3">
                            <label for="region" class="form-label">Region</label>
                            <input type="text" class="form-control" id="region"
                                   name="region" value="{{ $user->region ?? '' }}"
                                   required placeholder="Enter region">
                        </div>

                        <!-- Province -->
                        {{-- <div class="mb-3">
                            <label for="province" class="form-label">Province</label>
                            <select id="province" name="province" class="form-control" required>
                                <option value="">Select Province</option>
                            </select>
                        </div> --}}

                        <!-- Province Textbox -->
                        <div class="mb-3">
                            <label for="province" class="form-label">Province</label>
                            <input type="text" class="form-control" id="province"
                                   name="province" value="{{ $user->province ?? '' }}"
                                   required placeholder="Enter province">
                        </div>

                        <!-- City -->
                        {{-- <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <select id="city" name="city" class="form-control" required>
                                <option value="">Select City</option>
                            </select>
                        </div> --}}

                        <!-- City Textbox -->
                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city"
                                   name="city" value="{{ $user->city ?? '' }}"
                                   required placeholder="Enter city">
                        </div>

                        <!--Barangay -->
                        {{-- <div class="mb-3">
                            <label for="barangay" class="form-label">Barangay</label>
                            <select id="barangay" name="barangay" class="form-control" required>
                                <option value="">Select Barangay</option>
                            </select>
                        </div> --}}

                        <!-- Barangay Textbox -->
                        <div class="mb-3">
                            <label for="barangay" class="form-label">Barangay</label>
                            <input type="text" class="form-control" id="barangay"
                                   name="barangay" value="{{ $user->barangay ?? '' }}"
                                   required placeholder="Enter barangay">
                        </div>

                        <input type="hidden" id="latitude" name="latitude" value="{{ $user->latitude ?? '' }}">
                        <input type="hidden" id="longitude" name="longitude" value="{{ $user->longitude ?? '' }}">

                        {{-- Map --}}
                        {{-- <div class="mb-3">
                            <label for="map" class="form-label">Pin Your Location on the Map</label>
                            <div id="map" style="height: 300px; border-radius: 8px;"></div>
                            <input type="hidden" id="latitude" name="latitude" value="{{ $user->latitude ?? '' }}">
                            <input type="hidden" id="longitude" name="longitude" value="{{ $user->longitude ?? '' }}">
                        </div> --}}

                        {{-- <div class="mb-3">
                            <div id="map"></div>
                            <div id="controls">
                                <input id="start-input" type="text" placeholder="Enter start location">
                                <input id="waypoint-input" type="text" placeholder="Enter waypoint">
                                <button id="add-waypoint">Add Waypoint</button>
                                <ul id="waypoints-list"></ul>
                                <input id="end-input" type="text" placeholder="Enter end location">
                                <button id="find-route">Find Route</button>
                                <button id="clear-fields">Clear Fields</button>
                            </div>

                            <script src="{{ asset('js/maps.js') }}"></script>
                        </div> --}}

                        {{-- <div class="mb-3">
                            <h10>City</h10>
                                <select class="form-control" id="city" name="city" required>
                                    <option value="">Select your city</option>
                                    <option value="Iloilo City" {{ (isset($user->city) && $user->city == 'Iloilo City') ? 'selected' : '' }}>Iloilo City</option>
                                    <option value="San Miguel" {{ (isset($user->city) && $user->city == 'San Miguel') ? 'selected' : '' }}>San Miguel</option>
                                    <option value="Arevalo" {{ (isset($user->city) && $user->city == 'Arevalo') ? 'selected' : '' }}>Arevalo</option>
                                    <option value="Jaro" {{ (isset($user->city) && $user->city == 'Jaro') ? 'selected' : '' }}>Jaro</option>
                                    <option value="La Paz" {{ (isset($user->city) && $user->city == 'La Paz') ? 'selected' : '' }}>La Paz</option>
                                    <option value="Molo" {{ (isset($user->city) && $user->city == 'Molo') ? 'selected' : '' }}>Molo</option>
                                    <option value="Lapaz" {{ (isset($user->city) && $user->city == 'Lapaz') ? 'selected' : '' }}>Lapaz</option>
                                    <option value="Leganes" {{ (isset($user->city) && $user->city == 'Leganes') ? 'selected' : '' }}>Leganes</option>
                                    <option value="Pavia" {{ (isset($user->city) && $user->city == 'Pavia') ? 'selected' : '' }}>Pavia</option>
                                </select>
                        </div> --}}


                        <!-- Save Button -->
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" style="width: 150px;">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
<script>

    // Initialize Google Map
    function initMap() {
        const map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: 10.7202, lng: 122.5621 },
            zoom: 13,
        });

        const marker = new google.maps.Marker({
            position: { lat: 10.7202, lng: 122.5621 },
            map: map,
            draggable: true,
        });

        google.maps.event.addListener(marker, 'dragend', function (event) {
            $('#latitude').val(event.latLng.lat());
            $('#longitude').val(event.latLng.lng());
        });
    }

    // Load Google Maps
    window.onload = initMap;
</script>
@endsection
