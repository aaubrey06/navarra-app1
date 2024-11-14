@extends('layouts.warehouse-manager_layout')

@section('title', 'Warehouse Stocks')


@section('contents')

    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <div class="d-flex flex-column">



        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Warehouse Stocks</h5>

                            <div class="table-responsive">
                                <!-- Table with stripped rows -->
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>Rice type</th>
                                            <th>Unit</th>
                                            <th>Quantity</th>
                                            <th>Arrival Date</th>
                                            {{-- <th>Product Code</th> --}}
                                            <th>Batch Code</th>
                                            <th>Qr Code</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($warehouse_data['warehouse_stocks'] as $warehouse)
                                            {{-- @if ($warehouse->quantity > 0) --}}
                                            <tr>
                                                <td><?php
                                                // $jsonwarehouse = json_decode($warehouse['products'], true);
                                                // echo $jsonwarehouse;
                                                $products_arr = json_decode(json_encode($warehouse_data['products']), true);
                                                foreach ($products_arr as $product) {
                                                    $warehouse_arr = json_decode(json_encode($warehouse), true);
                                                    $product_arr = json_decode(json_encode($product), true);
                                                    if ($warehouse_arr['product_id'] == $product_arr['product_id']) {
                                                        echo $product_arr['rice_type'];
                                                    }
                                                }
                                                ?>
                                                </td>
                                                <td>{{ $warehouse->unit }}</td>
                                                <td>{{ $warehouse->quantity }}</td>
                                                <td>{{ $warehouse->arrival_date }}</td>
                                                {{-- <td>{{ $warehouse->product_code }}</td> --}}
                                                <td>{{ $warehouse->batch_code }}</td>
                                                <td>
                                                    <div class="qr_code"><span id ="{{ $warehouse->qr_code }}">
                                                      
                                                        </span>
                                                        <div class='qr_show'></div>

                                                    </div>
                                                    <a class="downloadqr" target="_blank" download>Download QR</a>

                                                </td>
                                            </tr>
                                            {{-- @endif --}}
                                        @endforeach
                                        </thead>
                                    </tbody>
                                </table>
                                {{-- <div class='qr_code'><span id="{{ $warehouse->qr_code }}"></span>
                                                            <div class='qr_show'></div>
                                                        </div>
                                                        <a class="downloadqr" target="_blank" download>Download QR</a> --}}

                                <!-- End Table with stripped rows -->

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <script>
            window.addEventListener('load', function() {
                var qr_code_div = document.querySelectorAll('.qr_code')
                var qr_code_array = [...qr_code_div];

               qr_code_array.forEach(element => {
                    // const text = element.textContent;
                    const qrcodeDiv = element.querySelector('.qr_show');
                    const text = element.getElementsByTagName("span")[0].id
                    console.log(text)
                    const qrcode = new QRCode(qrcodeDiv, {
                        text: text,
                        width: 128,
                        height: 128
                    });
                    setTimeout(() => {
                        let qelem = element.querySelector('.qr_show canvas')
                        var dataURL = qelem.toDataURL();
                        let dlink = element.parentElement.querySelector('.downloadqr')
                        let qr = qelem.getAttribute('src');
                        dlink.setAttribute('href', dataURL);
                        dlink.setAttribute('download', 'qrcode1.png');
                        dlink.removeAttribute('hidden');

                        element.text = '';
                    }, 1000);
                    // var canvas = element.querySelector('img')
                    // console.log(canvas)
                    // // image = canvas.toDataURL("image/png", 1.0).replace("image/png", "image/octet-stream");
                    // // console.log(element)
                    // var link = element.parentElement.querySelector('.downloadqr');
                    // link.download = "qr.png";
                    // link.href = canvas;
                    // link.click();
                    // console.log(text)
                });
                // if (text) {
                //     qrcodeDiv.innerHTML = '';
                //     const qrcode = new QRCode(qrcodeDiv, {
                //         text: text,
                //         width: 128,
                //         height: 128
                //     });
                // }


            })
        </script>


    @endsection
