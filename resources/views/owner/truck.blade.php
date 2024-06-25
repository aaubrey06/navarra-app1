@extends('layouts.owner_layout')

@section('content')
    <div class="container">
        <h1>Trucks</h1>
        {{-- <a href="{{ route('truck.create') }}" class="btn btn-primary">Add Truck</a> --}}
        <a href="" class="btn btn-primary">Add Truck</a>
        <table class="table">
            <thead>
                <tr>
                    <th>License Plate</th>
                    <th>Model</th>
                    <th>Year</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($trucks as $truck)
                    <tr>
                        <td>{{ $truck->license_plate }}</td>
                        <td>{{ $truck->model }}</td>
                        <td>{{ $truck->year }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
