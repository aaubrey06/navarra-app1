@extends('layouts.warehouse-manager_layout')

@section('title', 'Categorization')


@section('contents')

    <div class="d-flex flex-column">


        <?php
        // echo json_encode($percentage_per_product);
        ?>
        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        Category A<br>
                        @foreach ($percentage_per_product as $key => $item)
                            @if ($item['category'] == 'category_a')
                                {{ $key }} {{ $item['percentage'] }}%<br>
                            @endif
                        @endforeach
                    </div>
                    <div class="col-sm">
                        Category B<br>
                        @foreach ($percentage_per_product as $key => $item)
                            @if ($item['category'] == 'category_b')
                                {{ $key }} {{ $item['percentage'] }}%<br>
                            @endif
                        @endforeach
                    </div>
                    <div class="col-sm">
                        Category C<br>
                        @foreach ($percentage_per_product as $key => $item)
                            @if ($item['category'] == 'category_c')
                                {{ $key }} {{ $item['percentage'] }}%<br>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <script></script>


    @endsection
