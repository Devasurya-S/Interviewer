<!-- resources/views/child.blade.php -->
 
@extends('employees.layout')
 
@section('title', 'Page Title')
 
@section('sidebar')
    @parent
@endsection
 
@section('answerGroups')
    <div class="bg-white rounded-xl mt-4 p-8 ml-4 mr-4 w-screen items-center">
        @include('components.answer-group', ['groups' => $groups])
    </div>
@endsection