<!-- resources/views/child.blade.php -->
@extends('employees.layout')
 
@section('title', 'Interviews')
 
@section('sidebar')
    @parent
@endsection

@section('interviewGroups')
    <div class="bg-white rounded-xl mt-4 p-8 ml-4 mr-4 w-screen items-center">
        <x-link-buttons :viewHref="route('interview.view')" :addHref="route('employee.interview.add.page')" :item="'Interview'"/>
        @include('components.interview-table', ['interviews' => $interviews])
    </div>
@endsection
