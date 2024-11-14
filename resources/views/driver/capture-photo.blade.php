@extends('layouts.driver_layout')

@section('title', 'Capture Photo')

@section('contents')

<video id="video" width="320" height="240" autoplay></video>
<canvas id="canvas" width="320" height="240" style="display: none;"></canvas>
<button id="capture-button">Capture Photo</button>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const captureButton = document.getElementById('capture-button');
    const deliveryId = {{ $id }};

    // Access the camera
    navigator.mediaDevices.getUserMedia({ video: true })
        .then((stream) => {
            video.srcObject = stream;
        })
        .catch((err) => {
            console.error('Error accessing camera:', err);
            alert('Please allow camera access to capture the delivery photo.');
        });

    // Capture the photo when the button is clicked
    captureButton.onclick = function() {
        const context = canvas.getContext('2d');
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        const dataURL = canvas.toDataURL('image/png');

        // Stop the video stream after capture
        video.srcObject.getTracks().forEach(track => track.stop());

        // Send the captured image to the server
        $.ajax({
            url: '/driver/confirmDeliveryWithPhoto/' + deliveryId,
            method: 'POST',
            data: {
                image: dataURL,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                alert('Delivery confirmed with photo!');
                window.location.href = '/driver/routes'; // Redirect back to the routes page
            },
            error: function() {
                alert('Failed to confirm delivery.');
            }
        });
    };
</script>

@endsection
