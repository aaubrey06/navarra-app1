@extends('layouts.owner_layout')

@section('contents')
    <h1 class="text-center mb-5 text-primary">Sales Overview</h1>

    <!-- Filter Options -->
    <div class="row mb-5 justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form method="GET" action="{{ route('owner.sales.sales') }}">
                        <div class="form-group mb-3">
                            <label for="sales_type" class="form-label text-secondary fw-bold">Choose Sales Type:</label>
                            <select name="sales_type" id="sales_type" class="form-select">
                                <option value="all" {{ $salesType == 'all' ? 'selected' : '' }}>Overall Sales</option>
                                <option value="instore" {{ $salesType == 'instore' ? 'selected' : '' }}>In-Store Sales
                                </option>
                                <option value="online" {{ $salesType == 'online' ? 'selected' : '' }}>Online Orders</option>
                                <option value="walkin" {{ $salesType == 'walkin' ? 'selected' : '' }}>Walk-in Orders
                                </option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Apply Filter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Sales Summary -->
    <div class="sales-summary">
        @if ($salesType == 'all')
            <div class="card shadow-lg border-0 mb-4">
                <div class="card-body">
                    <h3 class="card-title text-center text-primary">Overall Sales</h3>
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <p class="fs-5"><strong>Total Sales:</strong> ₱{{ number_format($overallSales, 2) }}</p>
                            <p class="fs-5"><strong>Total Orders:</strong> {{ $overallOrders }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Sales Progress:</h6>
                            <div class="progress mb-3 rounded-pill">
                                <div class="progress-bar progress-bar-striped bg-primary" role="progressbar"
                                    style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">70%</div>
                            </div>
                            <h6 class="text-muted">Orders Progress:</h6>
                            <div class="progress rounded-pill">
                                <div class="progress-bar progress-bar-striped bg-secondary" role="progressbar"
                                    style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($salesType == 'instore')
            <div class="card shadow-lg border-0 mb-4">
                <div class="card-body">
                    <h3 class="card-title text-center text-primary">In-Store Sales</h3>
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <p class="fs-5"><strong>Total In-Store Sales:</strong> ₱{{ number_format($instoreSales, 2) }}
                            </p>
                            <p class="fs-5"><strong>Total In-Store Orders:</strong> {{ $instoreOrders }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Sales Progress:</h6>
                            <div class="progress mb-3 rounded-pill">
                                <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                                    style="width: {{ ($instoreSales / $overallSales) * 100 }}%"
                                    aria-valuenow="{{ ($instoreSales / $overallSales) * 100 }}" aria-valuemin="0"
                                    aria-valuemax="100">{{ number_format(($instoreSales / $overallSales) * 100, 1) }}%
                                </div>
                            </div>
                            <h6 class="text-muted">Orders Progress:</h6>
                            <div class="progress rounded-pill">
                                <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                                    style="width: {{ ($instoreOrders / $overallOrders) * 100 }}%"
                                    aria-valuenow="{{ ($instoreOrders / $overallOrders) * 100 }}" aria-valuemin="0"
                                    aria-valuemax="100">{{ number_format(($instoreOrders / $overallOrders) * 100, 1) }}%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($salesType == 'online')
            <div class="card shadow-lg border-0 mb-4">
                <div class="card-body">
                    <h3 class="card-title text-center text-primary">Online Orders</h3>
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <p class="fs-5"><strong>Total Online Sales:</strong> ₱{{ number_format($onlineSales, 2) }}
                            </p>
                            <p class="fs-5"><strong>Total Online Orders:</strong> {{ $onlineOrders }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Sales Progress:</h6>
                            <div class="progress mb-3 rounded-pill">
                                <div class="progress-bar progress-bar-striped bg-info" role="progressbar"
                                    style="width: {{ ($onlineSales / $overallSales) * 100 }}%"
                                    aria-valuenow="{{ ($onlineSales / $overallSales) * 100 }}" aria-valuemin="0"
                                    aria-valuemax="100">{{ number_format(($onlineSales / $overallSales) * 100, 1) }}%</div>
                            </div>
                            <h6 class="text-muted">Orders Progress:</h6>
                            <div class="progress rounded-pill">
                                <div class="progress-bar progress-bar-striped bg-info" role="progressbar"
                                    style="width: {{ ($onlineOrders / $overallOrders) * 100 }}%"
                                    aria-valuenow="{{ ($onlineOrders / $overallOrders) * 100 }}" aria-valuemin="0"
                                    aria-valuemax="100">{{ number_format(($onlineOrders / $overallOrders) * 100, 1) }}%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($salesType == 'walkin')
            <div class="card shadow-lg border-0 mb-4">
                <div class="card-body">
                    <h3 class="card-title text-center text-primary">Walk-in Orders</h3>
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <p class="fs-5"><strong>Total Walk-in Sales:</strong> ₱{{ number_format($walkinSales, 2) }}
                            </p>
                            <p class="fs-5"><strong>Total Walk-in Orders:</strong> {{ $walkinOrders }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Sales Progress:</h6>
                            <div class="progress mb-3 rounded-pill">
                                <div class="progress-bar progress-bar-striped bg-warning" role="progressbar"
                                    style="width: {{ ($walkinSales / $overallSales) * 100 }}%"
                                    aria-valuenow="{{ ($walkinSales / $overallSales) * 100 }}" aria-valuemin="0"
                                    aria-valuemax="100">{{ number_format(($walkinSales / $overallSales) * 100, 1) }}%
                                </div>
                            </div>
                            <h6 class="text-muted">Orders Progress:</h6>
                            <div class="progress rounded-pill">
                                <div class="progress-bar progress-bar-striped bg-warning" role="progressbar"
                                    style="width: {{ ($walkinOrders / $overallOrders) * 100 }}%"
                                    aria-valuenow="{{ ($walkinOrders / $overallOrders) * 100 }}" aria-valuemin="0"
                                    aria-valuemax="100">{{ number_format(($walkinOrders / $overallOrders) * 100, 1) }}%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
