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
                                    <tr>
                                        <td>
                                            @foreach ($percentage_per_product as $key => $item)
                                                @if ($item['category'] == 'category_a')
                                                    {{ $key }} {{ $item['percentage'] }}%<br>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($percentage_per_product as $key => $item)
                                                @if ($item['category'] == 'category_b')
                                                    {{ $key }} {{ $item['percentage'] }}%<br>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($percentage_per_product as $key => $item)
                                                @if ($item['category'] == 'category_c')
                                                    {{ $key }} {{ $item['percentage'] }}%<br>
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
        </section>

        <script></script>


    @endsection
