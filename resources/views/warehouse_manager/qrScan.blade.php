@extends('layouts.warehouse-manager_layout')

@section('title', 'Scan QR')


@section('contents')
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <script type="text/javascript" src="/assets/auth/js/instascan.min.js"></script>
    <div class="d-flex flex-column">
        <div class="scanner">
            <h2
                style="font-size: 24px; color: #2E86C1; text-align: center; font-weight: bold; padding: 10px; margin-top: 20px; border-bottom: 2px solid #2E86C1;">
                Scan QR code
            </h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div style="text-align: center;">
                <button id="StartScanBtn"
                    style="background-color: #2E86C1; color: white; font-size: 16px; padding: 10px 20px; border: 2px solid #1F618D; border-radius: 8px; cursor: pointer; transition: background-color 0.3s, border-color 0.3s; margin-top: 20px;"
                    onmouseover="this.style.backgroundColor='#1F618D'; this.style.borderColor='#154360';"
                    onmouseout="this.style.backgroundColor='#2E86C1'; this.style.borderColor='#1F618D';">
                    Start Scanning
                </button>
            </div>


            <video id="qrVideo" autoplay playinline></video>
            <div id="scanResult"></div>
            <form id="foroutbound" action = "{{ url('warehouse_manager/foroutbound') }}" style="visibility: hidden">
                <input type="text" id="qrData" name="qrData">
                <input type="text" id="requestId" name="requestId" value="{{ $request_details }}">
                <input type="submit" id="submit">
            </form>
        </div>




    </div>
    <?php
    $warehouse_stocks_id['id'] = '';
    ?>
    <script>
        const qrVideo = document.getElementById('qrVideo');
        const startScanBtn = document.getElementById('StartScanBtn')
        const scanResult = document.getElementById('scanResult');

        startScanBtn.addEventListener('click', () => {
            qrVideo.style.display = 'block';


            navigator.mediaDevices.getUserMedia({
                    video: {
                        facingMode: 'environment'
                    }
                })
                .then(stream => {
                    qrVideo.srcObject = stream;
                    const scanner = new Instascan.Scanner({
                        video: qrVideo
                    });
                    scanner.addListener('scan', content => {
                        scanResult.innerHTML = `scanned QR Code: ${content}`;

                        document.getElementById('qrData').value = content;
                        document.getElementById('submit').click()

                    });
                    Instascan.Camera.getCameras()
                        .then(cameras => {
                            if (cameras.length != 0) {
                                scanner.start(cameras[0]);

                            } else {
                                console.error('No Cameras Found.');
                            }
                        })
                        .catch(error => console.error('Error Accessing Cameras:', error));

                });

        });
    </script>
@endsection
