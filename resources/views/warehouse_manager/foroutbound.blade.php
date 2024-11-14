@extends('layouts.warehouse-manager_layout')

@section('contents')
    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="">



                        {{-- <div id="printable" class="container"
                            style="padding: 3px; max-width: 100%; margin: 0 auto; font-size: 10px;">

                            <!-- Left-aligned Invoice Title and Date -->
                            <div style="text-align: left; font-size: 12px; margin-bottom: 5px;">
                                <strong style="font-size: 16px;">Invoice</strong><br>
                                {{ date('M. d, Y') }}
                            </div>

                            <!-- Table Section -->
                            <div class="table-responsive">
                                <table class="table"
                                    style="width: 100%; font-size: 10px; margin-bottom: 5px; border-collapse: collapse;">
                                    <thead>
                                        <tr>
                                            <th style="width: 30%; text-align: left; font-size: 10px; padding: 2px;">Rice
                                                Type</th>
                                            <th style="width: 20%; text-align: left; font-size: 10px; padding: 2px;">Unit
                                            </th>
                                            <th style="width: 20%; text-align: left; font-size: 10px; padding: 2px;">
                                                Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="font-size: 10px; padding: 2px;">{{ $data['products'][0]->rice_type }}
                                            </td>
                                            <td style="font-size: 10px; padding: 2px;">{{ $data['products'][0]->unit }} kg
                                            </td>
                                            <td style="font-size: 10px; padding: 2px;">
                                                {{ $data['stock_requests'][0]->quantity_requested }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>


                            <!-- Signature Section -->
                            <div class="mt-4" style="padding-bottom: 20px; font-size: 10px;">
                                <div class="mb-2">Received by: ______________________</div>
                                <div>Delivered by: _____________________</div>
                            </div>
                        </div>

                        <!-- Buttons Section -->
                        <div class="row mb-3" style="padding: 5px 10px; font-size: 10px;">
                            <div class="col-6 col-md-4">
                                <a class="btn btn-primary w-100" href="{{ route('warehouse') }}"
                                    style="font-size: 10px; padding: 6px 10px;">
                                    Cancel
                                </a>
                            </div>
                            <div class="col-6 col-md-4">
                                <button onclick="save()" class="btn btn-primary w-100"
                                    style="font-size: 10px; padding: 6px 10px;">
                                    Confirm Outbound
                                </button>
                            </div>
                        </div>

                        <!-- Hidden Form for Submission -->
                        <form action="{{ url('warehouse_manager/sendoutbound') }}" id="sendoutbound" method="POST"
                            style="visibility: hidden; height: 0;">
                            @csrf

                            <div class="row mb-3" style="font-size: 10px;">
                                <label for="outbound_quantity" class="col-12 col-md-10 col-form-label"><b>Quantity to
                                        Outbound</b></label>
                                <div class="col-12 col-md-5">
                                    <input type="number" class="form-control" id="outbound_quantity"
                                        name="outbound_quantity"
                                        value="{{ $data['stock_requests'][0]->quantity_requested }}" required
                                        style="font-size: 10px;">
                                    <input type="text" class="form-control mt-2" id="previous_value"
                                        name="previous_value" value="{{ $data['warehouse_stock'][0]->quantity }}" required
                                        style="font-size: 10px;">
                                    <input type="text" class="form-control mt-2" id="warehouse_stocks_id"
                                        name="warehouse_stocks_id"
                                        value="{{ $data['warehouse_stock'][0]->warehouse_stocks_id }}" required
                                        style="font-size: 10px;">
                                    <input type="number" class="form-control mt-2" id="stock_request_id"
                                        name="stock_request_id" value="{{ $data['stock_requests'][0]->request_id }}"
                                        required style="font-size: 10px;">
                                </div>
                            </div>
                        </form> --}}




















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
                                        name="outbound_quantity"
                                        value="{{ $data['stock_requests'][0]->quantity_requested }}" required>
                                    <input type="text" class="form-control" id="previous_value" name="previous_value"
                                        value=" {{ $data['warehouse_stock'][0]->quantity }}" required>
                                    <input type="text" class="form-control" id="warehouse_stocks_id"
                                        name="warehouse_stocks_id"
                                        value=" {{ $data['warehouse_stock'][0]->warehouse_stocks_id }}" required>
                                    <input type="number" class="form-control" id="stock_request_id" name="stock_request_id"
                                        value="{{ $data['stock_requests'][0]->request_id }}" required>


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
        function save() {
            var h = document.getElementById('printable').offsetHeight;
            var w = document.getElementById('printable').offsetWidth;

            // Adjust the image size manually (in mm, 1 inch = 25.4mm)
            var imageWidth = 168; // Example width in mm (adjust as needed)
            var imageHeight = 105; // Example height in mm (adjust as needed)

            html2canvas(document.getElementById('printable'), {
                scale: 2,
                width: w,
                height: h,

            }).then(function(canvas) {
                const {
                    jsPDF
                } = window.jspdf;
                const doc = new jsPDF('p', 'mm', 'letter'); // Letter size (8.5 x 11 inches)

                // Add the image to PDF with custom width and height
                doc.addImage(canvas.toDataURL("image/png"), 'PNG', 10, 10, imageWidth, imageHeight);

                // Save the PDF
                doc.save('warehouse_invoice.pdf');

                // Trigger outbound link click and form submit
                var a = document.createElement('a');
                a.href = doc.output('bloburl'); // This opens the PDF in a new tab
                a.download = "warehouse_invoice.pdf";
                a.click();
                document.getElementById("sendoutbound").submit();
            });
        }
    </script>




    {{-- <script>
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
    </script> --}}
@endsection
