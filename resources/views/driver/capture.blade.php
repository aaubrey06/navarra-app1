@extends('layouts.app')

@section('content')
<h3>Delivery Confirmation</h3>
<video id="video" autoplay></video>
<canvas id="canvas" style="display:none;"></canvas>

<button id="capture">Capture Image</button>
<button id="cancel">Cancel</button>

<script>
    const urlParams = new URLSearchParams(window.location.search);
    const orderId = urlParams.get('id');  // Retrieve the order ID from the query string

    const video = document.getElementById('video');
    navigator.mediaDevices.getUserMedia({ video: true })
        .then((stream) => {
            video.srcObject = stream;
            video.play();
            document.getElementById('capture').onclick = () => capturePhoto(orderId, stream);
        })
        .catch((error) => {
            console.error("Error accessing the camera:", error);
        });

    // Capture and confirm delivery
    function capturePhoto(id, stream) {
        const canvas = document.getElementById('canvas');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
        const imageData = canvas.toDataURL('image/png');
        stream.getTracks().forEach(track => track.stop());
        confirmDelivery(id, imageData);
    }

    // Redirect to the routes page on cancel
    document.getElementById('cancel').onclick = function() {
        window.location.href = '/driver/routes';
    };
</script>
@endsection
