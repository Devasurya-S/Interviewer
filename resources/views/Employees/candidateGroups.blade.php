<!-- resources/views/child.blade.php -->
 
@extends('employees.layout')
 
@section('title', 'Candiate Groups')
 
@section('sidebar')
    @parent
@endsection
 
@section('candidateGroups')
    <div class="bg-white rounded-xl mt-4 p-8 ml-4 mr-4 w-screen items-center">
        <x-link-buttons :viewHref="route('candidate.groups')" :addHref="route('employee.candidate.add.page')" :item="'Candidate'"/>
        @include('components.group-table', ['groups' => $groups])
    </div>
@endsection