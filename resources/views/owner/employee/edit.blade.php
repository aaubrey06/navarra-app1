@extends('layouts.owner_layout')

@section('contents')
    <h1 class="text-center">Edit Employee</h1>

    <div class="d-flex justify-content-center mt-4">
        <div class="card p-4" style="width: 100%; max-width: 600px;">
            <form action="{{ route('owner.employee.update', $employee->employee_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="name">Employee Name</label>
                    <input type="text" id="name" name="name" class="form-control"
                        value="{{ old('name', $employee->name) }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" class="form-control">
                        <option value="male" {{ old('gender', $employee->gender) == 'male' ? 'selected' : '' }}>Male
                        </option>
                        <option value="female" {{ old('gender', $employee->gender) == 'female' ? 'selected' : '' }}>Female
                        </option>
                        <option value="other" {{ old('gender', $employee->gender) == 'other' ? 'selected' : '' }}>Other
                        </option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="dob">Date of Birth</label>
                    <input type="date" id="dob" name="dob" class="form-control"
                        value="{{ old('dob', $employee->dob) }}">
                </div>

                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control"
                        value="{{ old('email', $employee->email) }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="phone">Phone</label>
                    <input type="text" id="phone" name="phone_number" class="form-control"
                        value="{{ old('phone_number', $employee->phone_number) }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" class="form-control"
                        value="{{ old('address', $employee->address) }}">
                </div>

                <div class="form-group mb-3">
                    <label for="city">City</label>
                    <input type="text" id="city" name="city" class="form-control"
                        value="{{ old('city', $employee->city) }}">
                </div>

                <div class="form-group mb-3">
                    <label for="province">Province</label>
                    <input type="text" id="province" name="province" class="form-control"
                        value="{{ old('province', $employee->province) }}">
                </div>

                <div class="form-group mb-3">
                    <label for="region">Region</label>
                    <input type="text" id="region" name="region" class="form-control"
                        value="{{ old('region', $employee->region) }}">
                </div>

                <div class="form-group mb-3">
                    <label for="postal_code">Postal Code</label>
                    <input type="text" id="postal_code" name="postal_code" class="form-control"
                        value="{{ old('postal_code', $employee->postal_code) }}">
                </div>

                <div class="form-group mb-3">
                    <label for="nationality">Nationality</label>
                    <input type="text" id="nationality" name="nationality" class="form-control"
                        value="{{ old('nationality', $employee->nationality) }}">
                </div>

                <div class="form-group mb-3">
                    <label for="ssn">SSN</label>
                    <input type="text" id="ssn" name="ssn" class="form-control"
                        value="{{ old('ssn', $employee->ssn) }}">
                </div>

                <div class="form-group mb-3">
                    <label for="position">Position</label>
                    <input type="text" id="position" name="position" class="form-control"
                        value="{{ old('position', $employee->position) }}" required>
                </div>

                <button type="submit" class="btn btn-primary mt-3 w-100">Update Employee</button>
            </form>
        </div>
    </div>
@endsection
