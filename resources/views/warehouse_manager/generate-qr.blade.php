@extends('layouts.warehouse-manager_layout')

@section('title', 'Add Products')


@section('contents')

    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <div class="d-flex flex-column">
        <h2 style="font-size: 24px; color: #080669; font-weight: bold; text-align: left; margin-bottom: 20px;">Add Products
        </h2>

        <form action="{{ url('warehouse_manager/add_stocks') }}" method="POST" enctype="multipart/form-data"
            class="d-flex flex-column" id="addProductForm">
            @csrf
            {{-- <input class="mb-3 p-2 rounded-3" type="text" name="rice_type" id="rice_type"> --}}
            {{-- <select class="mb-3 p-2 rounded-3 w-100" name="rice_type" id="rice_type" onchange="selectRice(this)">
                <option value="" disabled selected>Rice Type</option>
                @foreach ($products as $product)
                    <option value="{{ $product->product_id }}">{{ $product->rice_type }}</option>
                @endforeach
            </select> --}}
            <select class="mb-3 p-2 rounded-3 w-100" name="rice_type" id="rice_type" onchange="selectRice(this)"
                style="border: 1px solid #ccc;" onfocus="this.style.borderColor='#000000';"
                onblur="this.style.borderColor=this.value ? '#000000' : '#ccc';">
                <option value="" disabled selected>Rice Type</option>
                @foreach ($products->unique('rice_type') as $product)
                    <option value="{{ $product->product_id }}">{{ $product->rice_type }}</option>
                @endforeach
            </select>



            <input class="mb-3 p-2 rounded-3 w-100" type="date" name="arrival_date" id="arrival_date"
                placeholder="Arrival Date" style="border: 1px solid #ccc; outline: none;"
                onfocus="this.style.borderColor='#080669';" onfocus="this.style.borderColor='#000000';"
                onblur="this.style.borderColor=this.value ? '#000000' : '#ccc';">

            {{-- <input class="mb-3 p-2 rounded-3 w-100" type="number" name="unit" id="unit" placeholder="Unit"> --}}

            <select class="mb-3 p-2 rounded-3 w-100" name="unit" id="unit" style="border: 1px solid #ccc;"
                onfocus="this.style.borderColor='#080669';" onfocus="this.style.borderColor='#000000';"
                onblur="this.style.borderColor=this.value ? '#000000' : '#ccc';">
                <option value="" disabled selected>Unit</option>
                {{-- @foreach ($products as $product)
                    <option value="{{ $product->product_id }}">{{ $product->unit }}</option>
                @endforeach --}}
            </select>



            <input class="mb-3 p-2 rounded-3" type="number" name="quantity" id="quantity" placeholder="Quantity"
                style="border: 1px solid #ccc;" onfocus="this.style.borderColor='#000000';"
                onblur="this.style.borderColor=this.value ? '#000000' : '#ccc';">

            <input class="mb-3 p-2 rounded-3" type="text" name="supplier" id="supplier" placeholder="Supplier"
                style="border: 1px solid #ccc;" onfocus="this.style.borderColor='#000000';"
                onblur="this.style.borderColor=this.value ? '#000000' : '#ccc';">



            <!-- Display error message for quantity -->
            @if ($errors->has('quantity'))
                <div class="alert alert-danger">
                    <strong>{{ $errors->first('quantity') }}</strong>
                </div>
            @endif


            <button type="submit" id="generateBtn" class="btn-primary mb-3"
                style=" color: #000000; border: 1px solid #080808; font-weight: bold; font-size: 14px; padding: 4px 8px; border-radius: 10px; cursor: pointer; width: 50%; max-width: 200px; display: block; margin: 0 auto; transition: background-color 0.3s;">
                Add Product
            </button>
            <style>
                /* Hover effect for the button */
                #generateBtn:hover {
                    background-color: #08095286;
                    /* Change the background color when hovered */
                }
            </style>

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
                    unit.add(new Option(element.unit, element.product_id))
                }
            })
        }


        // Validation before form submission
        generateBtn.addEventListener('click', function(event) {
            // Client-side validation: Check if all required fields are filled
            if (!rice_type.value || !arrival_date.value || !unit.value || !quantity.value || !supplier.value) {
                event.preventDefault(); // Prevent form submission
                alert('Please fill in all required fields.');
                return;
            }

            // Confirm before submission
            if (!confirm('Are you sure you want to add this product?')) {
                event.preventDefault(); // Prevent form submission if the user cancels
                return;
            }

            // generateBtn.addEventListener('click', (event) => {
            //     if (!confirm('Are you sure you want to add this product?')) {
            //         event.preventDefault(); // Prevent form submission if the user cancels
            //         return;
            //     }

            qrcodeDiv.innerHTML = ''; // Clear any previous QR code
            new QRCode(qrcodeDiv, {
                text: qrText,
                width: 300,
                height: 300
            });
            qrcodeDiv.style.display = 'block'; // Show the QR code
        });


        // qrcodeDiv.style.display = 'flex';
        // qrcodeDiv.style.justifyContent = 'center';
        // qrcodeDiv.style.alignItems = 'center';

        // const text = rice_type.value + arrival_date.value;
        // console.log(text)
        // if (text) {
        //     qrcodeDiv.innerHTML = '';
        //     const qrcode = new QRCode(qrcodeDiv, {
        //         text: text,
        //         width: 128,
        //         height: 128
        //     });
    </script>
@endsection
