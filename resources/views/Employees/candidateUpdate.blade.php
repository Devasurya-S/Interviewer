<!-- resources/views/child.blade.php -->

@extends('employees.layout')
 
@section('title', 'Candiates')
 
@section('sidebar')
    @parent
@endsection
 
@section('candidateUpdate')
    <div class="bg-white rounded-xl mt-4 p-8 ml-4 mr-4 w-screen items-center">
        <x-link-buttons :viewHref="route('candidate.groups')" :addHref="route('employee.candidate.add.page')" :item="'Candidate'"/>

        <form action="{{ route('candidate.update') }}" method="post" class="mt-2">
            <label class="block">Group Number</label>
            <input class="border p-2 mt-1" name="group" type="number" value="{{ $candidate->group }}" placeholder="eg:1"> 
            @csrf
            <div id="candidateInputsContainer">
                <div class="flex">
                    <div class="flex mt-2">
                        <input name="id" type="number" value="{{ $candidate->user_id }}" hidden>    
                        <div class="mr-2">
                            <label class="block">Name</label>
                            <input class="border p-2 mt-1" name="name" type="text" value="{{ $candidate->name }}" placeholder="Name">    
                        </div>
                        <div class="mr-2">
                            <label class="block">Email</label>
                            <input class="border p-2 mt-1" name="email" type="text" value="{{ $candidate->email }}" placeholder="Email">    
                        </div>
                        <div class="mr-2">
                            <label class="block">Mobile</label>
                            <input class="border p-2 mt-1" name="mobile" type="number" value="{{ $candidate->mobile_number }}" placeholder="Mobile">    
                        </div>  
                        <div class="mr-2">
                            <label class="block">Password</label>
                            <input class="border p-2 mt-1" name="password" type="text" value="{{ $candidate->password }}" placeholder="Password">    
                        </div>  
                        <div class="mr-2">
                            <label class="block">Status</label>
                            <select class="border p-2 mt-1" name="status">
                                <option value="1" {{ $candidate->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0 {{ $candidate->status == 0 ? 'selected' : '' }}">Deactive</option>
                            </select> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-2">
                <button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-200 rounded" type="submit">
                    Submit
                </button>
            </div>   
        </form>
    </div>
@endsection