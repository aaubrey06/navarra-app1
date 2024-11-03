@extends('layouts.warehouse-manager_layout')

@section('title', 'Generate QR')


@section('contents')

    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <div class="d-flex flex-column">
        <h2>Generate QR Code</h2>
        <form action="{{ url('warehouse_manager/add_stocks') }}" method="POST" enctype="multipart/form-data"
            class="d-flex flex-column">
            @csrf
            {{-- <input class="mb-3 p-2 rounded-3" type="text" name="rice_type" id="rice_type"> --}}
            <select class="mb-3 p-2 rounded-3 w-100" name="rice_type" id="rice_type" onchange="selectRice(this)">
                <option value="" disabled selected>Rice Type</option>
                @foreach ($products as $product)
                    <option value="{{ $product->product_id }}">{{ $product->rice_type }}</option>
                @endforeach
            </select>

            <input class="mb-3 p-2 rounded-3 w-100" type="date" name="arrival_date" id="arrival_date"
                placeholder="Arrival Date">
            {{-- <input class="mb-3 p-2 rounded-3 w-100" type="number" name="unit" id="unit" placeholder="Unit"> --}}

            <select class="mb-3 p-2 rounded-3 w-100" name="unit" id="unit">
                <option value="" disabled selected>Unit </option>
                {{-- @foreach ($products as $product)
                    <option value="{{ $product->product_id }}">{{ $product->unit }}</option>
                @endforeach --}}
            </select>


            <input class="mb-3 p-2 rounded-3" type="number" name="quantity" id="quantity" placeholder="Quantity">
            <input class="mb-3 p-2 rounded-3" type="text" name="suppleir" id="supplier" placeholder="Supplier">

            <button type="submit" id="generateBtn" class=" btn-primary mb-3 p-2 rounded-3">Add Product</button>
        </form>
        <div id="qrcode"></div>
    </div>



    <script>
        const rice_type = document.getElementById('rice_type');
        const arrival_date = document.getElementById('arrival_date');
        const unit = document.getElementById('unit');
        const quantity = document.getElementById('quantity');
        const generateBtn = document.getElementById('generateBtn');
        const qrcodeDiv = document.getElementById('qrcode');
        var prods = {!! json_encode($products->toArray(), JSON_HEX_TAG) !!};

        function selectRice(sel) {
            unit.options.length = 0;
            unit.add(new Option('Unit', 'Unit'))
            unit.options[0].disabled = true
            d = sel.options[sel.selectedIndex].text
            prods.forEach(element => {
                if (element.rice_type == d) {
                    unit.add(new Option(element.unit, element.unit))
                }
            })
        }

        generateBtn.addEventListener('click', (event) => {
            if (!confirm('Are you sure you want to add this product?')) {
                event.preventDefault(); // Prevent form submission if the user cancels
                return;
            }
            const text = rice_type.value + arrival_date.value;
            console.log(text)
            if (text) {
                qrcodeDiv.innerHTML = '';

                qrcodeDiv.style.display = 'flex';
                qrcodeDiv.style.justifyContent = 'center';
                qrcodeDiv.style.alignItems = 'center';


                const qrcode = new QRCode(qrcodeDiv, {
                    text: text,
                    width: 300,
                    height: 300
                });
            }
        });




        
    </script>
@endsection
