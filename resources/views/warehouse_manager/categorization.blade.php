@extends('layouts.warehouse-manager_layout')

@section('title', 'Generate QR')


@section('contents')

    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <div class="d-flex flex-column">



     <section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Warehouse Stocks Categorization</h5>

                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Category A</th>
                                <th>Category B</th>
                                <th>Category C</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($percentage_per_product as $item)
                                <tr>
                                    <!-- Category A -->
                                    <td>
                                        @if ($item['category'] == 'category_a')
                                            {{ $item['name'] }} - {{ $item['unit'] }} kg - {{ $item['percentage'] }}%
                                        @endif
                                    </td>

                                    <!-- Category B -->
                                    <td>
                                        @if ($item['category'] == 'category_b')
                                            {{ $item['name'] }} - {{ $item['unit'] }} kg - {{ $item['percentage'] }}%
                                        @endif
                                    </td>

                                    <!-- Category C -->
                                    <td>
                                        @if ($item['category'] == 'category_c')
                                            {{ $item['name'] }} - {{ $item['unit'] }} kg - {{ $item['percentage'] }}%
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>


        <script></script>


    @endsection
