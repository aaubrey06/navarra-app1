@extends('layouts.warehouse-manager_layout')

@section('title', 'Generate QR')


@section('contents')
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <script type="text/javascript" src="/assets/auth/js/instascan.min.js"></script>
    <div class="d-flex flex-column">
        <div class="scanner">
            <h2>Scan Your QR Code</h2>
            <button class="mb-3 p-2 rounded-3" id="StartScanBtn">Start Scanning</button>
            <video id="qrVideo" autoplay playinline></video>
            <div id="scanResult"></div>
        </div>

    </div>
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