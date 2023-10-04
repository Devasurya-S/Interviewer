<!-- resources/views/child.blade.php -->
@extends('employees.layout')
 
@section('title', 'Interviews')
 
@section('sidebar')
    @parent
@endsection

@section('interviewUpdate')
    <div class="bg-white rounded-xl mt-4 p-8 ml-4 mr-4 w-screen items-center">
        <x-link-buttons :viewHref="route('interview.view')" :addHref="route('employee.interview.add.page')" :item="'Interview'"/>
        <div class="w-full">
            <form action="{{ route('interview.update') }}" method="post" class="mt-2">
                @csrf
                <input hidden name="interviewId" value="{{ $interview->interview_id }}">    
                <div class="flex">
                        <div class="mr-2">
                            <label class="block">Interview Name</label>
                            <input class="border p-2 mt-1" name="interviewName" type="text" value="{{ $interview->interview_name }}">    
                        </div>
                        <div class="mr-2">
                            <label class="block">Question</label>
                            <input class="border p-2 mt-1" name="question" type="text" value="{{ $interview->question }}">    
                        </div>
                    <button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold mt-6 py-2 px-4 border border-gray-200 rounded" type="submit">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
