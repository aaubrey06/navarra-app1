@extends('layouts.store-manager_layout')
@section('contents')
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <div class="d-flex flex-column">

        <button data-bs-toggle="modal" data-bs-target="#newstockrequest">Request New Stock</button>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Stocks Request</h5>


                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Request Number</th>
                                        <th>Order Date</th>
                                        <th>Store Name</th>
                                        <th>Product</th>
                                        <th>Unit</th>
                                        <th>Quantity</th>
                                        <th>Delivery Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requests as $request)
                                        <tr>
                                            <td>
                                                {{ $request->request_id }}
                                            </td>
                                            <td>
                                                {{ $request->created_at->toDateString() }}
                                            </td>
                                            <td>
                                                <?php
                                                // $store = json_decode(json_encode($store), true);
                                                foreach ($stores as $key => $store) {
                                                    if ($store->store_id == $request->store_id) {
                                                        echo $store->store_name;
                                                    }
                                                }
                                                
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                // $store = json_decode(json_encode($store), true);
                                                foreach ($products as $key => $product) {
                                                    if ($product->product_id == $request->product_id) {
                                                        echo $product->rice_type;
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                {{ $request->unit }}
                                            </td>

                                            <td>

                                                {{ $request->quantity_requested }}
                                            </td>
                                            <td>

                                            </td>
                                            <td>

                                                {{ $request->status }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
        </section>
        <div class="modal fade" id="newstockrequest" tabindex="-1" aria-labelledby="newstockrequestLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action = "{{ url('store_manager/inventory/stockrequests/add') }}" method = "Post">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Request Stock</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="branchName" class="form-label">Branch Name</label>
                                <select class="form-select form-select-md mb-3" name="branchName" id="branchName"
                                    aria-label="Large select example">
                                    <option selected disabled>Select Branch Name</option>
                                    @foreach ($stores as $store)
                                        <option value="{{ $store['store_id'] }}">{{ $store['store_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="product" class="form-label">Product</label>
                                <select class="form-select form-select-md mb-3" id="product" name="product"
                                    aria-label="Large select example" onchange="selectRice(this)">
                                    <option selected disabled>Select Product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product['product_id'] }}">{{ $product['rice_type'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="unit" class="form-label">Unit</label>
                                <select class="form-select form-select-md mb-3" aria-label="Large select example"
                                    id="unit" name="unit">
                                    <option selected disabled>Select Unit</option>
                                </select>
                            </div>
                            <div class="mb-3 position-relative">
                                <label for="quantity" class="form-label">Quantity</label>
                                <span class="position-absolute top-0 end-0"
                                    style="width: max-content;font-size: 12px">Available
                                    Stock: <span id="availablestock">0</span></span>
                                <input type="number" class="form-control" name="quantity" id="quantity">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" value ="Send Request">
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"
            integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            const unit = document.getElementById('unit');
            var prods = {!! json_encode($products->toArray(), JSON_HEX_TAG) !!};
            var warehouse_stocks = {!! json_encode($warehouse_stocks, JSON_HEX_TAG) !!};
            var maxInput = 1000

            function selectRice(sel) {
                unit.options.length = 0;
                unit.add(new Option('Unit', 'Unit'))
                unit.options[0].disabled = true
                d = sel.options[sel.selectedIndex].text
                prods.forEach(element => {
                    if (element.rice_type == d) {
                        unit.add(new Option(element.unit, element.product_id))
                    }
                })
                warehouse_stocks.forEach(element => {
                    if (element.product_name == d) {
                        console.log(element.quantity)
                        $('#availablestock').text(element.quantity)
                        maxInput = element.quantity
                    }
                });

            }
        </script>
    @endsection
