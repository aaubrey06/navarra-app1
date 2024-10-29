@extends('layouts.warehouse-manager_layout')

@section('title', 'Scan QR')


@section('contents')
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <script type="text/javascript" src="/assets/auth/js/instascan.min.js"></script>
    <div class="d-flex flex-column">
        <div class="scanner">
            <h2>Scan Your QR Code</h2>
            <button class="mb-3 p-2 rounded-3" id="StartScanBtn">Start Scanning</button>
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
                        console.log(content)
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
