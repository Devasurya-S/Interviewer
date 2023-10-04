<!-- resources/views/child.blade.php -->
@extends('users.layout')
 
@section('title', 'Home')

@section('home')

    <h2 class="font-semibold text-2xl ml-4 mt-10 mb-11">Interviews</h2>
    <div class="flex px-4">
        @php
            $hasItems = false;
        @endphp
        @foreach ($datas as $data)
            @if (!$data->video_path)
                <x-interview-feedback-grids :name="$data->question" :itemCode="1" :itemId="$data->id" :viewStatus="0"/>   
                @php
                    $hasItems = true;
                @endphp
            @endif
        @endforeach
        @if (!$hasItems)
            <p>No Interviews Shceduled For Now</p>
        @endif
    </div>
    <h2 class="font-semibold text-2xl ml-4 mt-10 mb-11">Feedback</h2>
    <div class="flex px-4">
        @foreach ($datas as $data)
        <x-interview-feedback-grids :name="$data->feedback" :itemCode="0" :itemId="$data->id" :viewStatus="$data->fb_view_status"/>    
        @endforeach
    </div>
@endsection
