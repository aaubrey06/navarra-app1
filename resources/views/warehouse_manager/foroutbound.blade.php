@extends('layouts.warehouse-manager_layout')

@section('contents')
    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="">
                        <div id="printable" style="padding: 20px;">
                            <h5 class="card-title">Invoice</h5>

                            <div>
                                {{ date('M. d, Y') }}
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Rice Type</th>
                                        <th>Unit</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            {{ $data['products'][0]->rice_type }}
                                        </td>
                                        <td>
                                            {{ $data['products'][0]->unit }} kg
                                        </td>
                                        <td>
                                            {{ $data['stock_requests'][0]->quantity_requested }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="mt-5" style="padding-bottom: 20px">
                                <div>
                                    Received by: _________________________________
                                </div>
                                <div>
                                    Delivered by: _________________________________
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3" style="padding: 20px;">
                            <div class="col-sm-5">
                                <a class="btn btn-primary" href="{{ route('warehouse') }}">Cancel</a>
                            </div>
                            <div class="col-sm-5">
                                <button onclick="save()" class="btn btn-primary">Confirm Outbound</button>
                            </div>
                        </div>
                        <form action="{{ url('warehouse_manager/sendoutbound') }}" id="sendoutbound" method="POST"
                            style="visibility: hidden; height: 0">
                            @csrf

                            <div class="row mb-3">
                                <label for="outbound_quantity" class="col-sm-10 col-form-label"><b>Quantity to
                                        Outbound</b></label>
                                <div class="col-sm-5">
                                    <input type="number" class="form-control" id="outbound_quantity"
                                        name="outbound_quantity" value="{{ $data['stock_requests'][0]->quantity_requested }}" required>
                                    <input type="text" class="form-control" id="previous_value" name="previous_value"
                                     value=" {{ $data['warehouse_stock'][0]->quantity }}" required>
                                    <input type="text" class="form-control" id="warehouse_stocks_id"
                                        name="warehouse_stocks_id"
                                        value=" {{ $data['warehouse_stock'][0]->warehouse_stocks_id }}" required>
                                        <input type="number" class="form-control" id="stock_request_id"
                                        name="stock_request_id" value="{{ $data['stock_requests'][0]->request_id }}" required>
                                    

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
<script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.0.0-rc.7/dist/html2canvas.min.js"></script>
    <script>
        function save(){
            var h = document.getElementById('printable').offsetHeight
            var w = document.getElementById('printable').offsetWidth
            console.log(h)
            html2canvas(document.getElementById('printable'), {
                scale: 2,
        width: w,
        height: h,
            }).then(function (canvas) {
                         var a = document.createElement("a");
          // toDataURL defaults to png, so we need to request a jpeg, then convert for file download.
          a.href = canvas
            .toDataURL("image/jpeg")
            .replace("image/jpeg", "image/octet-stream");
          a.download = "warehouse_invoice.png";
          a.click();
          document.getElementById("sendoutbound").submit();
            });
        }
    </script>
@endsection
