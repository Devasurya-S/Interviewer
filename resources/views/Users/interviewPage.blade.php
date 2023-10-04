<!-- resources/views/child.blade.php -->
@extends('users.layout')
 
@section('title', 'Interview')

@section('interviewPage')
    <h1>Question: {{ $interview->question }}</h1>
    <div>
        <video id="videoPreview" autoplay playsinline></video>

        <button id="startRecording">Start Recording</button>
        <button id="stopRecording" disabled>Stop Recording</button>

        <video id="recordedVideo" controls></video>

        <form id="uploadForm" action="{{ route('record.video') }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- <input type="hidden" id="videoInput" name="video" value="" accept="video/*"> --}}
            <input type="file" name="video" id="videoInput" accept="video/*">
            <input type="number" name="answerId" value="{{ $interview->id }}">
            <button type="submit" id="uploadButton" disabled>Upload Video</button>
        </form>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Access webcam and set up video stream
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(function (stream) {
                const videoPreview = document.getElementById('videoPreview');
                videoPreview.srcObject = stream;
            })
            .catch(function (error) {
                console.error('Error accessing webcam:', error);
            });

        // Initialize variables for video recording
        let mediaRecorder;
        let recordedChunks = [];

        // Handle Start Recording button click
        const startRecordingButton = document.getElementById('startRecording');
        const stopRecordingButton = document.getElementById('stopRecording');
        const recordedVideo = document.getElementById('recordedVideo');
        const uploadButton = document.getElementById('uploadButton');
        const videoInput = document.getElementById('videoInput');

        startRecordingButton.addEventListener('click', () => {
            mediaRecorder = new MediaRecorder(videoPreview.srcObject);

            mediaRecorder.ondataavailable = function (event) {
                if (event.data.size > 0) {
                    recordedChunks.push(event.data);
                }
            };

            mediaRecorder.onstop = function () {
                const blob = new Blob(recordedChunks, { type: 'video/webm' });
                recordedChunks = [];

                recordedVideo.src = window.URL.createObjectURL(blob);
                recordedVideo.controls = true;

                // Enable the Upload button and set video input value
                uploadButton.disabled = false;
                videoInput.files = blob;
            };

            mediaRecorder.start();
            startRecordingButton.disabled = true;
            stopRecordingButton.disabled = false;
        });

        // Handle Stop Recording button click
        stopRecordingButton.addEventListener('click', () => {
            mediaRecorder.stop();
            startRecordingButton.disabled = false;
            stopRecordingButton.disabled = true;
        });
    });
</script>
@endsection