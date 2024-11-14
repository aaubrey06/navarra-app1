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
                            <h5 class="card-title">Categorization</h5>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Rice Type</th>
                                        <th>Category</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($percentage_per_product as $item)
                                        <tr>
                                            <!-- Item -->
                                            <td>
                                                {{ $item['name'] }} - {{ $item['unit'] }} kg - {{ $item['percentage'] }}%
                                            </td>

                                            <!-- Category with color coding -->
                                            <td>
                                                @if ($item['category'] == 'category_a')
                                                    <span class="badge bg-success">Category A</span>
                                                @elseif ($item['category'] == 'category_b')
                                                    <span class="badge bg-warning text-dark">Category B</span>
                                                @elseif ($item['category'] == 'category_c')
                                                    <span class="badge bg-primary">Category C</span>
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
