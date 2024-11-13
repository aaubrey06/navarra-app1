@extends('layouts.owner_layout')

@section('contents')
    <h1 class="text-center">Add New Employee</h1>

    <div class="d-flex justify-content-center mt-4">
        <div class="card p-4" style="width: 100%; max-width: 600px;">
            <form action="{{ route('owner.employee.store') }}" method="POST">
                @csrf

                <!-- Employee Name -->
                <div class="form-group mb-3">
                    <label for="name">Employee Name</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <!-- Position -->
                <div class="form-group mb-3">
                    <label for="position">Position</label>
                    <input type="text" id="position" name="position" class="form-control" required>
                </div>

                <!-- Gender -->
                <div class="form-group mb-3">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" class="form-control">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <!-- Date of Birth -->
                <div class="form-group mb-3">
                    <label for="dob">Date of Birth</label>
                    <input type="date" id="dob" name="dob" class="form-control">
                </div>

                <!-- Email -->
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>

                <!-- Phone -->
                <div class="form-group mb-3">
                    <label for="phone">Phone</label>
                    <input type="text" id="phone" name="phone_number" class="form-control" required>
                </div>

                <!-- Address -->
                <div class="form-group mb-3">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" class="form-control">
                </div>

                <!-- City -->
                <div class="form-group mb-3">
                    <label for="city">City</label>
                    <input type="text" id="city" name="city" class="form-control">
                </div>

                <!-- Province -->
                <div class="form-group mb-3">
                    <label for="province">Province</label>
                    <input type="text" id="province" name="province" class="form-control">
                </div>

                <!-- Region -->
                <div class="form-group mb-3">
                    <label for="region">Region</label>
                    <input type="text" id="region" name="region" class="form-control">
                </div>

                <!-- Postal Code -->
                <div class="form-group mb-3">
                    <label for="postal_code">Postal Code</label>
                    <input type="text" id="postal_code" name="postal_code" class="form-control">
                </div>

                <!-- Nationality -->
                <div class="form-group mb-3">
                    <label for="nationality">Nationality</label>
                    <input type="text" id="nationality" name="nationality" class="form-control">
                </div>

                <!-- SSN -->
                <div class="form-group mb-3">
                    <label for="ssn">SSN</label>
                    <input type="text" id="ssn" name="ssn" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary mt-3 w-100">Add Employee</button>
            </form>
        </div>
    </div>
@endsection
