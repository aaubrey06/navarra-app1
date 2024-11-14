@extends('layouts.warehouse-manager_layout')

@section('title', 'Outbound Stocks')


@section('contents')

    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <div class="d-flex flex-column">



        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Warehouse Outbound Stocks</h5>

                            <div class="table-responsive">
                                <!-- Table with stripped rows -->
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>Rice type</th>
                                            <th>Unit</th>
                                            <th>Outbound Quantity</th>
                                            <th>Outbound Date</th>
                                            {{-- <th>Product Code</th> --}}
                                            <th>Batch Code</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($warehouse_data['warehouse_history'] as $key => $warehouse)
                                            <tr>
                                                <?php
                                                $warehouse_stocks_arr = json_decode(json_encode($warehouse_data['warehouse_stocks']), true);
                                                foreach ($warehouse_stocks_arr as $key => $warehouse_stock) :
                                                    if($warehouse_stock['warehouse_stocks_id'] == $warehouse->warehouse_stocks_id):
                                                   
                                            ?>
                                                <td>
                                                    <?php
                                                    $products_arr = json_decode(json_encode($warehouse_data['products']), true);
                                                    foreach ($products_arr as $product) {
                                                        if ($warehouse_stock['product_id'] == $product['product_id']) {
                                                            echo $product['rice_type'];
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo $warehouse_stock['unit'];
                                                    ?>
                                                </td>
                                                <td>
                                                    {{ $warehouse->outbound_quantity }}
                                                </td>
                                                <td>
                                                    {{ $warehouse->created_at }}
                                                </td>
                                                {{-- <td>
                                                @php
                                                    echo $warehouse_stock['product_code'];
                                                @endphp
                                            </td> --}}
                                                <td>
                                                    @php
                                                        echo $warehouse_stock['batch_code'];
                                                    @endphp
                                                </td>
                                                <?php
                                                
                                                    endif;
                                        endforeach;
                                            ?>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
                    const text = element.textContent;
                    console.log(text)
                    const qrcodeDiv = element.querySelector('.qr_show');
                    this.innerHTML = '';
                    const qrcode = new QRCode(qrcodeDiv, {
                        text: text,
                        width: 128,
                        height: 128
                    });

                });
                // console.log(text)
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
