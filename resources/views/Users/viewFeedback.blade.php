<!-- resources/views/child.blade.php -->
@extends('users.layout')
 
@section('title', 'Feedback')

@section('feedback')
    <h1 class="font-semibold text-2xl">Feedback</h1>
    <div class="box-border bg-white rounded-xl shadow-md p-8 ml-4 mt-5 mr-4 mb-12 h-3/5">
        <h1>{{ $data->question }}</h1>
        <p class="my-2">{{ $data->feedback }}</p>
        <a href="{{ route('candidate.home') }}" class="text-white font-poppins text-sm bg-[#0560FD] hover:bg-blue-500 py-2 px-4 rounded-xl mx-auto h-9">Go Back</a>
    </div>
@endsection