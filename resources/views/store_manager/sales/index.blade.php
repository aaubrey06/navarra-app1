@extends('layouts.store-manager_layout')

@section('contents')
    <h1 class="text-center mb-5 text-primary">Sales Overview</h1>

    <!-- Sales Summary: Overall Sales -->
    <div class="card shadow-lg border-0 mb-4">
        <div class="card-body">
            <h3 class="card-title text-center text-primary">Overall Sales</h3>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="fs-5"><strong>Total Sales:</strong> ₱{{ number_format($sales, 2) }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
